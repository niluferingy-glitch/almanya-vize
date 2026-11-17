<?php
declare(strict_types=1);
mb_internal_encoding('UTF-8');
date_default_timezone_set('Europe/Istanbul');

define('APP_DIR', __DIR__);
$cfgFile = getenv('VIZESEL_CONFIG') ?: APP_DIR . '/config.php';
$GLOBALS['CFG'] = require $cfgFile;

if (!empty($GLOBALS['CFG']['debug'])) {
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', '0');
}

function cfg(string $k, $default = null) { return $GLOBALS['CFG'][$k] ?? $default; }

function db(): PDO {
    static $pdo = null;
    if ($pdo) return $pdo;
    $pdo = new PDO(cfg('db_dsn'), cfg('db_user'), cfg('db_pass'), [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    migrate($pdo);
    return $pdo;
}

// Var olan veritabanını yeni sürüme getirir. Bir kez çalışır, app/ içine işaret dosyası bırakır.
const SCHEMA_VERSION = 2;
function migrate(PDO $pdo): void {
    $mark = APP_DIR . '/.schema-v' . SCHEMA_VERSION;
    if (is_file($mark)) return;
    $mysql = $pdo->getAttribute(PDO::ATTR_DRIVER_NAME) === 'mysql';
    try { $pdo->query('SELECT held FROM entries LIMIT 1'); $hadHeld = true; } catch (Throwable $e) { $hadHeld = false; }
    if (!$hadHeld) {
        $pdo->exec('ALTER TABLE entries ADD COLUMN held TINYINT(1) NOT NULL DEFAULT 0');
        $pdo->exec("ALTER TABLE entries ADD COLUMN held_reason VARCHAR(160) NOT NULL DEFAULT ''");
    }
    $cols = "id CHAR(16) NOT NULL PRIMARY KEY, entry_id CHAR(16) NOT NULL, reply_to CHAR(16) NULL, token_hash CHAR(64) NOT NULL,
             u VARCHAR(40) NOT NULL DEFAULT 'anonim', text VARCHAR(1000) NOT NULL, is_owner TINYINT(1) NOT NULL DEFAULT 0,
             approved TINYINT(1) NOT NULL DEFAULT 0, created_at DATETIME NOT NULL";
    if ($mysql) {
        $pdo->exec("CREATE TABLE IF NOT EXISTS comments ($cols, KEY idx_entry (entry_id, approved, created_at)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
    } else {
        $pdo->exec("CREATE TABLE IF NOT EXISTS comments ($cols)");
        $pdo->exec('CREATE INDEX IF NOT EXISTS idx_entry ON comments (entry_id, approved, created_at)');
    }
    // Sütun yeni eklendiyse var olan kayıtları da şüphe kurallarından geçir; şüpheliler panelde beklemeye düşer.
    if (!$hadHeld) {
        $rows = $pdo->query('SELECT * FROM entries')->fetchAll();
        $up = $pdo->prepare('UPDATE entries SET held = 1, held_reason = ? WHERE id = ?');
        foreach ($rows as $r) { $why = suspect_reason($r, false); if ($why !== '') $up->execute([$why, $r['id']]); }
    }
    @file_put_contents($mark, date('c'));
}

function h($s): string { return htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
function url(string $path = '/'): string { return rtrim(cfg('site_url'), '/') . $path; }
function today(): string { return date('Y-m-d'); }

const TR_MONTHS = ['', 'Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'];
function tr_date(string $iso): string {
    [$y, $m, $d] = array_map('intval', explode('-', substr($iso, 0, 10)));
    return $d . ' ' . TR_MONTHS[$m] . ' ' . $y;
}
function tr_month(string $isoOrYm): string {
    [$y, $m] = array_map('intval', explode('-', substr($isoOrYm, 0, 7)));
    return TR_MONTHS[$m] . ' ' . $y;
}
function days_between(string $a, string $b): int {
    return (int)round((strtotime($b . ' 12:00') - strtotime($a . ' 12:00')) / 86400);
}
function months_text(int $days): string {
    return number_format($days / 30.4, 1, ',', '');
}

require APP_DIR . '/data.php';
require APP_DIR . '/content.php';
require APP_DIR . '/views/partials.php';
