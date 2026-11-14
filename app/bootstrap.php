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
    return $pdo;
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
