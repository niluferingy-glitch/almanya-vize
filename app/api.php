<?php
// JSON API: /api/entries, /api/entries/{id}, /api/admin

function json_out($data, int $status = 200): void {
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    header('Cache-Control: no-store');
    header('X-Robots-Tag: noindex');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}
function body_json(): array {
    $raw = file_get_contents('php://input', false, null, 0, 8192) ?: '';
    $b = json_decode($raw, true);
    return is_array($b) ? $b : [];
}
function rand_hex(int $bytes): string { return bin2hex(random_bytes($bytes)); }
function is_admin(): bool {
    $t = $_SERVER['HTTP_X_ADMIN_TOKEN'] ?? '';
    $a = (string)cfg('admin_token');
    return $a !== '' && $a !== 'DEGISTIR' && hash_equals($a, $t);
}
function owns(string $id): bool {
    if (is_admin()) return true;
    $t = $_SERVER['HTTP_X_EDIT_TOKEN'] ?? '';
    if ($t === '') return false;
    $st = db()->prepare('SELECT token_hash FROM entries WHERE id = ?'); $st->execute([$id]);
    $h = $st->fetchColumn();
    return $h && hash_equals($h, hash('sha256', $t));
}
function rate_ok(int $limit = 3): bool {
    $ip = $_SERVER['REMOTE_ADDR'] ?? '0';
    $day = today();
    $k = hash('sha256', cfg('salt') . ':' . $ip . ':' . $day);
    $pdo = db();
    $pdo->prepare('DELETE FROM limits WHERE day < ?')->execute([$day]);
    $st = $pdo->prepare('SELECT n FROM limits WHERE k = ?'); $st->execute([$k]);
    $n = $st->fetchColumn();
    if ($n !== false && (int)$n >= $limit) return false;
    if ($n === false) $pdo->prepare('INSERT INTO limits (k, day, n) VALUES (?, ?, 1)')->execute([$k, $day]);
    else $pdo->prepare('UPDATE limits SET n = n + 1 WHERE k = ?')->execute([$k]);
    return true;
}
function pub(array $r): array {
    return ['id' => $r['id'], 'country' => $r['country'], 'center' => $r['center'], 'cat' => $r['cat'], 'kayit' => $r['kayit'],
            'atama' => $r['atama'], 'randevu' => $r['randevu'], 'sonuc' => $r['sonuc'], 'u' => $r['u'],
            'text' => (int)$r['approved'] ? $r['text'] : '', 'at' => substr((string)$r['created_at'], 0, 10)];
}

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$p = preg_replace('#/+$#', '', $path);

try {
    if ($p === '/api/entries') {
        if ($method === 'GET') {
            $rows = db()->query('SELECT * FROM entries ORDER BY created_at DESC LIMIT 5000')->fetchAll();
            json_out(array_map('pub', $rows));
        }
        if ($method === 'POST') {
            $v = validate_entry(body_json());
            if ($v === 'spam') json_out(['ok' => true]);
            if (is_string($v)) json_out(['error' => $v], 400);
            if (!rate_ok()) json_out(['error' => 'limit'], 429);
            $id = rand_hex(8); $token = rand_hex(16); $now = date('Y-m-d H:i:s');
            db()->prepare('INSERT INTO entries (id, token_hash, country, center, cat, kayit, atama, randevu, sonuc, u, text, approved, created_at, updated_at) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)')
                ->execute([$id, hash('sha256', $token), $v['country'], $v['center'], $v['cat'], $v['kayit'], $v['atama'], $v['randevu'], $v['sonuc'], $v['u'], $v['text'], $v['text'] === '' ? 1 : 0, $now, $now]);
            json_out(['id' => $id, 'token' => $token], 201);
        }
        json_out(['error' => 'method'], 405);
    }

    if (preg_match('#^/api/entries/([a-f0-9]{16})$#', $p, $m)) {
        $id = $m[1];
        if (!owns($id)) json_out(['error' => 'forbidden'], 403);
        $st = db()->prepare('SELECT * FROM entries WHERE id = ?'); $st->execute([$id]); $old = $st->fetch();
        if (!$old) json_out(['error' => 'notfound'], 404);
        if ($method === 'GET') { $o = pub($old); $o['text'] = $old['text']; json_out($o); }
        if ($method === 'PUT') {
            $v = validate_entry(body_json());
            if (is_string($v)) json_out(['error' => $v === 'spam' ? 'invalid' : $v], 400);
            $approved = $v['text'] === $old['text'] ? (int)$old['approved'] : ($v['text'] === '' ? 1 : 0);
            db()->prepare('UPDATE entries SET country=?, center=?, cat=?, kayit=?, atama=?, randevu=?, sonuc=?, u=?, text=?, approved=?, updated_at=? WHERE id=?')
                ->execute([$v['country'], $v['center'], $v['cat'], $v['kayit'], $v['atama'], $v['randevu'], $v['sonuc'], $v['u'], $v['text'], $approved, date('Y-m-d H:i:s'), $id]);
            json_out(['ok' => true]);
        }
        if ($method === 'DELETE') { db()->prepare('DELETE FROM entries WHERE id = ?')->execute([$id]); json_out(['ok' => true]); }
        json_out(['error' => 'method'], 405);
    }

    if ($p === '/api/admin') {
        if (!is_admin()) json_out(['error' => 'forbidden'], 403);
        if ($method === 'GET') {
            json_out(db()->query('SELECT id, country, center, cat, kayit, atama, randevu, sonuc, u, text, approved, created_at FROM entries ORDER BY approved ASC, created_at DESC LIMIT 500')->fetchAll());
        }
        if ($method === 'POST') {
            $b = body_json(); $id = (string)($b['id'] ?? '');
            $sql = ['approve' => 'UPDATE entries SET approved = 1 WHERE id = ?', 'reject' => "UPDATE entries SET text = '', approved = 1 WHERE id = ?", 'delete' => 'DELETE FROM entries WHERE id = ?'][$b['action'] ?? ''] ?? null;
            if (!$sql) json_out(['error' => 'invalid'], 400);
            db()->prepare($sql)->execute([$id]);
            json_out(['ok' => true]);
        }
        json_out(['error' => 'method'], 405);
    }
    json_out(['error' => 'notfound'], 404);
} catch (Throwable $e) {
    error_log('api: ' . $e->getMessage());
    json_out(['error' => 'server'], 500);
}
