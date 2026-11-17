<?php
// JSON API: /api/entries, /api/entries/{id}, /api/comments, /api/admin

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
function rate_ok(int $limit = 3, string $scope = 'e'): bool {
    $ip = $_SERVER['REMOTE_ADDR'] ?? '0';
    $day = today();
    $k = hash('sha256', cfg('salt') . ':' . ($scope === 'e' ? '' : $scope . ':') . $ip . ':' . $day);
    $pdo = db();
    $pdo->prepare('DELETE FROM limits WHERE day < ?')->execute([$day]);
    $st = $pdo->prepare('SELECT n FROM limits WHERE k = ?'); $st->execute([$k]);
    $n = $st->fetchColumn();
    if ($n !== false && (int)$n >= $limit) return false;
    if ($n === false) $pdo->prepare('INSERT INTO limits (k, day, n) VALUES (?, ?, 1)')->execute([$k, $day]);
    else $pdo->prepare('UPDATE limits SET n = n + 1 WHERE k = ?')->execute([$k]);
    return true;
}
function delete_entry(string $id): void {
    db()->prepare('DELETE FROM comments WHERE entry_id = ?')->execute([$id]);
    db()->prepare('DELETE FROM entries WHERE id = ?')->execute([$id]);
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
            $rows = db()->query('SELECT * FROM entries WHERE held = 0 ORDER BY created_at DESC LIMIT 5000')->fetchAll();
            json_out(array_map('pub', $rows));
        }
        if ($method === 'POST') {
            $v = validate_entry(body_json());
            if ($v === 'spam') json_out(['ok' => true]);
            if (is_string($v)) json_out(['error' => $v], 400);
            if (!rate_ok()) json_out(['error' => 'limit'], 429);
            $id = rand_hex(8); $token = rand_hex(16); $now = date('Y-m-d H:i:s');
            $why = suspect_reason($v);
            db()->prepare('INSERT INTO entries (id, token_hash, country, center, cat, kayit, atama, randevu, sonuc, u, text, approved, held, held_reason, created_at, updated_at) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)')
                ->execute([$id, hash('sha256', $token), $v['country'], $v['center'], $v['cat'], $v['kayit'], $v['atama'], $v['randevu'], $v['sonuc'], $v['u'], $v['text'], $v['text'] === '' ? 1 : 0, $why === '' ? 0 : 1, $why, $now, $now]);
            json_out(['id' => $id, 'token' => $token, 'held' => $why !== ''], 201);
        }
        json_out(['error' => 'method'], 405);
    }

    if (preg_match('#^/api/entries/([a-f0-9]{16})$#', $p, $m)) {
        $id = $m[1];
        if (!owns($id)) json_out(['error' => 'forbidden'], 403);
        $st = db()->prepare('SELECT * FROM entries WHERE id = ?'); $st->execute([$id]); $old = $st->fetch();
        if (!$old) json_out(['error' => 'notfound'], 404);
        if ($method === 'GET') { $o = pub($old); $o['text'] = $old['text']; $o['held'] = (bool)(int)$old['held']; json_out($o); }
        if ($method === 'PUT') {
            $v = validate_entry(body_json());
            if (is_string($v)) json_out(['error' => $v === 'spam' ? 'invalid' : $v], 400);
            $approved = $v['text'] === $old['text'] ? (int)$old['approved'] : ($v['text'] === '' ? 1 : 0);
            // Tarih, ad ya da not değiştiyse şüphe kurallarından yeniden geçir; değişmediyse önceki karar kalır.
            $changed = false;
            foreach (['country', 'center', 'cat', 'kayit', 'atama', 'randevu', 'sonuc', 'u', 'text'] as $k) if ((string)$v[$k] !== (string)$old[$k]) $changed = true;
            $why = $changed ? suspect_reason($v) : (string)$old['held_reason'];
            $held = $changed ? ($why === '' ? 0 : 1) : (int)$old['held'];
            db()->prepare('UPDATE entries SET country=?, center=?, cat=?, kayit=?, atama=?, randevu=?, sonuc=?, u=?, text=?, approved=?, held=?, held_reason=?, updated_at=? WHERE id=?')
                ->execute([$v['country'], $v['center'], $v['cat'], $v['kayit'], $v['atama'], $v['randevu'], $v['sonuc'], $v['u'], $v['text'], $approved, $held, $why, date('Y-m-d H:i:s'), $id]);
            json_out(['ok' => true, 'held' => (bool)$held]);
        }
        if ($method === 'DELETE') { delete_entry($id); json_out(['ok' => true]); }
        json_out(['error' => 'method'], 405);
    }

    if ($p === '/api/comments') {
        if ($method !== 'POST') json_out(['error' => 'method'], 405);
        $v = validate_comment(body_json());
        if ($v === 'spam') json_out(['ok' => true, 'pending' => true]);
        if (is_string($v)) json_out(['error' => $v], 400);
        $st = db()->prepare('SELECT token_hash FROM entries WHERE id = ? AND held = 0'); $st->execute([$v['entry_id']]);
        $entryHash = $st->fetchColumn();
        if ($entryHash === false) json_out(['error' => 'notfound'], 404);
        if ($v['reply_to']) {
            $st = db()->prepare('SELECT 1 FROM comments WHERE id = ? AND entry_id = ? AND approved = 1'); $st->execute([$v['reply_to'], $v['entry_id']]);
            if (!$st->fetchColumn()) $v['reply_to'] = null;
        }
        if (!rate_ok(10, 'c')) json_out(['error' => 'limit'], 429);
        $et = $_SERVER['HTTP_X_EDIT_TOKEN'] ?? '';
        $isOwner = $et !== '' && hash_equals((string)$entryHash, hash('sha256', $et)) ? 1 : 0;
        $id = rand_hex(8); $token = rand_hex(16);
        db()->prepare('INSERT INTO comments (id, entry_id, reply_to, token_hash, u, text, is_owner, approved, created_at) VALUES (?,?,?,?,?,?,?,0,?)')
            ->execute([$id, $v['entry_id'], $v['reply_to'], hash('sha256', $token), $v['u'], $v['text'], $isOwner, date('Y-m-d H:i:s')]);
        json_out(['id' => $id, 'token' => $token, 'pending' => true], 201);
    }

    if ($p === '/api/admin') {
        if (!is_admin()) json_out(['error' => 'forbidden'], 403);
        if ($method === 'GET') {
            $entries = db()->query('SELECT id, country, center, cat, kayit, atama, randevu, sonuc, u, text, approved, held, held_reason, created_at FROM entries ORDER BY held DESC, approved ASC, created_at DESC LIMIT 500')->fetchAll();
            $comments = db()->query('SELECT c.id, c.entry_id, c.reply_to, c.u, c.text, c.is_owner, c.approved, c.created_at, e.center, e.u AS entry_u, e.kayit AS entry_kayit, e.country
                FROM comments c LEFT JOIN entries e ON e.id = c.entry_id ORDER BY c.approved ASC, c.created_at DESC LIMIT 300')->fetchAll();
            json_out(['entries' => $entries, 'comments' => $comments]);
        }
        if ($method === 'POST') {
            $b = body_json(); $id = (string)($b['id'] ?? ''); $a = (string)($b['action'] ?? '');
            if ($a === 'delete') { delete_entry($id); json_out(['ok' => true]); }
            $sql = [
                'approve'   => 'UPDATE entries SET approved = 1 WHERE id = ?',
                'reject'    => "UPDATE entries SET text = '', approved = 1 WHERE id = ?",
                'release'   => "UPDATE entries SET held = 0, held_reason = '' WHERE id = ?",
                'c_approve' => 'UPDATE comments SET approved = 1 WHERE id = ?',
                'c_delete'  => 'DELETE FROM comments WHERE id = ?',
            ][$a] ?? null;
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
