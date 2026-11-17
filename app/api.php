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
function client_key(string $scope): string {
    return hash('sha256', cfg('salt') . ':' . $scope . ':' . ($_SERVER['REMOTE_ADDR'] ?? '0') . ':' . today());
}
// Yönetici anahtarı: en az 32 karakter, isteğe bağlı IP listesi, günde 5 hatalı denemeden sonra kilit.
function is_admin(): bool {
    $t = (string)($_SERVER['HTTP_X_ADMIN_TOKEN'] ?? '');
    if ($t === '') return false;
    $a = (string)cfg('admin_token');
    if (strlen($a) < 32 || $a === 'DEGISTIR') return false;
    $ips = (array)cfg('admin_ips', []);
    if ($ips && !in_array($_SERVER['REMOTE_ADDR'] ?? '', $ips, true)) return false;
    if (count_of('adm-fail') >= 5) json_out(['error' => 'locked'], 429);
    if (hash_equals($a, $t)) return true;
    bump('adm-fail');
    error_log('vizesel: hatalı yönetici anahtarı denemesi');
    return false;
}
function owns(string $id): bool {
    if (is_admin()) return true;
    $t = $_SERVER['HTTP_X_EDIT_TOKEN'] ?? '';
    if ($t === '') return false;
    $st = db()->prepare('SELECT token_hash FROM entries WHERE id = ?'); $st->execute([$id]);
    $h = $st->fetchColumn();
    return $h && hash_equals($h, hash('sha256', $t));
}
// Sayaçlar: IP adresi tuzlu özet olarak, gün bazında tutulur; ertesi gün silinir.
function count_of(string $scope, bool $perIp = true): int {
    $day = today();
    db()->prepare('DELETE FROM limits WHERE day < ?')->execute([$day]);
    $k = $perIp ? client_key($scope) : hash('sha256', $scope . ':' . $day);
    $st = db()->prepare('SELECT n FROM limits WHERE k = ?'); $st->execute([$k]);
    return (int)$st->fetchColumn();
}
function bump(string $scope, bool $perIp = true): void {
    $day = today();
    $k = $perIp ? client_key($scope) : hash('sha256', $scope . ':' . $day);
    $up = db()->prepare('UPDATE limits SET n = n + 1 WHERE k = ?'); $up->execute([$k]);
    if ($up->rowCount() === 0) {
        try { db()->prepare('INSERT INTO limits (k, day, n) VALUES (?, ?, 1)')->execute([$k, $day]); }
        catch (PDOException $e) { db()->prepare('UPDATE limits SET n = n + 1 WHERE k = ?')->execute([$k]); }
    }
}
// Kişi başı günlük sınır + tüm site için günlük üst sınır (IP değiştirerek doldurmaya karşı)
function rate_ok(string $scope, int $limit, int $globalCap = 0): bool {
    if (count_of($scope) >= $limit) return false;
    if ($globalCap && count_of($scope . ':tum', false) >= $globalCap) return false;
    bump($scope);
    if ($globalCap) bump($scope . ':tum', false);
    return true;
}
// Yazma isteklerini başka sitelerden gönderilmeye karşı koru (CSRF).
function same_origin_write(string $method): void {
    if (in_array($method, ['GET', 'HEAD', 'OPTIONS'], true)) return;
    $site = rtrim((string)cfg('site_url'), '/');
    $origin = $_SERVER['HTTP_ORIGIN'] ?? '';
    if ($origin !== '' && $origin !== $site) json_out(['error' => 'forbidden'], 403);
    if (($_SERVER['HTTP_SEC_FETCH_SITE'] ?? 'same-origin') === 'cross-site') json_out(['error' => 'forbidden'], 403);
    if (in_array($method, ['POST', 'PUT'], true) && !str_starts_with(strtolower($_SERVER['CONTENT_TYPE'] ?? ''), 'application/json')) json_out(['error' => 'invalid'], 415);
}
function pub(array $r): array {
    return ['id' => $r['id'], 'country' => $r['country'], 'center' => $r['center'], 'cat' => $r['cat'], 'kayit' => $r['kayit'],
            'atama' => $r['atama'], 'randevu' => $r['randevu'], 'sonuc' => $r['sonuc'], 'u' => $r['u'],
            'text' => (int)$r['approved'] ? $r['text'] : '', 'at' => substr((string)$r['created_at'], 0, 10)];
}

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$p = preg_replace('#/+$#', '', $path);

try {
    same_origin_write($method);
    if ($p === '/api/entries') {
        if ($method === 'GET') {
            $rows = db()->query('SELECT * FROM entries ORDER BY created_at DESC LIMIT 5000')->fetchAll();
            json_out(array_map('pub', $rows));
        }
        if ($method === 'POST') {
            $v = validate_entry(body_json());
            if ($v === 'spam') json_out(['ok' => true]);
            if (is_string($v)) json_out(['error' => $v], 400);
            if (!rate_ok('ekle', 3, (int)cfg('daily_cap', 300))) json_out(['error' => 'limit'], 429);
            $id = rand_hex(8); $token = rand_hex(16); $now = date('Y-m-d H:i:s');
            db()->prepare('INSERT INTO entries (id, token_hash, country, center, cat, kayit, atama, randevu, sonuc, u, text, approved, created_at, updated_at) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)')
                ->execute([$id, hash('sha256', $token), $v['country'], $v['center'], $v['cat'], $v['kayit'], $v['atama'], $v['randevu'], $v['sonuc'], $v['u'], $v['text'], $v['text'] === '' ? 1 : 0, $now, $now]);
            json_out(['id' => $id, 'token' => $token], 201);
        }
        json_out(['error' => 'method'], 405);
    }

    if (preg_match('#^/api/entries/([a-f0-9]{16})$#', $p, $m)) {
        $id = $m[1];
        if ($method !== 'GET' && !rate_ok('duzenle', 30)) json_out(['error' => 'limit'], 429);
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
            if (!preg_match('/^[a-f0-9]{16}$/', $id)) json_out(['error' => 'invalid'], 400);
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
