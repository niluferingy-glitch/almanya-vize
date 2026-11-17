<?php
declare(strict_types=1);
mb_internal_encoding('UTF-8');
date_default_timezone_set('Europe/Istanbul');

define('APP_DIR', __DIR__);
$cfgFile = getenv('VIZESEL_CONFIG') ?: APP_DIR . '/config.php';
$GLOBALS['CFG'] = require $cfgFile;

// Hatalar ekrana değil, tarayıcıdan erişilemeyen app/logs/ klasörüne yazılır.
// (Hosting varsayılanı public_html/error_log dosyasıdır ve herkes okuyabilir.)
error_reporting(E_ALL);
ini_set('log_errors', '1');
if (is_dir(APP_DIR . '/logs') || @mkdir(APP_DIR . '/logs', 0750)) ini_set('error_log', APP_DIR . '/logs/php-error.log');
ini_set('display_errors', !empty($GLOBALS['CFG']['debug']) ? '1' : '0');

function cfg(string $k, $default = null) { return $GLOBALS['CFG'][$k] ?? $default; }

// ---- Güvenlik başlıkları (tüm PHP yanıtları) ----
// Dışarıdan yalnız Google Analytics adreslerine izin var (çerez onayı verilince yüklenir).
header_remove('X-Powered-By');
if (PHP_SAPI !== 'cli') {
    $https = str_starts_with((string)cfg('site_url'), 'https://');
    header("Content-Security-Policy: default-src 'self'; script-src 'self' https://www.googletagmanager.com; style-src 'self' 'unsafe-inline'; img-src 'self' data: https://*.google-analytics.com https://*.googletagmanager.com; font-src 'self'; connect-src 'self' https://*.google-analytics.com https://*.analytics.google.com https://*.googletagmanager.com; object-src 'none'; base-uri 'self'; form-action 'self'; frame-ancestors 'none'" . ($https ? '; upgrade-insecure-requests' : ''));
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: DENY');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('Permissions-Policy: camera=(), microphone=(), geolocation=(), payment=(), usb=()');
    header('Cross-Origin-Opener-Policy: same-origin');
    header('Cross-Origin-Resource-Policy: same-origin');
    if ($https) header('Strict-Transport-Security: max-age=31536000');
}

// Beklenmeyen hata: ayrıntı kayda, ziyaretçiye sade bir sayfa.
set_exception_handler(function (Throwable $e) {
    error_log('vizesel: ' . get_class($e) . ': ' . $e->getMessage() . ' @ ' . $e->getFile() . ':' . $e->getLine());
    if (!headers_sent()) { http_response_code(500); header('Content-Type: text/html; charset=utf-8'); header('Cache-Control: no-store'); }
    if (!empty($GLOBALS['CFG']['debug'])) { echo '<pre>' . htmlspecialchars((string)$e) . '</pre>'; return; }
    echo '<!doctype html><meta charset="utf-8"><title>Geçici sorun | Vizesel</title><p style="font-family:sans-serif;max-width:32em;margin:4em auto">Şu an sayfayı gösteremiyoruz. Birkaç dakika sonra tekrar dene.</p>';
});

function db(): PDO {
    static $pdo = null;
    if ($pdo) return $pdo;
    $pdo = new PDO(cfg('db_dsn'), cfg('db_user'), cfg('db_pass'), [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
    return $pdo;
}

// JSON'u <script> içine güvenle gömmek için (< ve > kaçışlı, </script> ile kapatılamaz)
function json_script($data): string {
    return json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG);
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
