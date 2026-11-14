<?php
// Tüm istekler buradan geçer. Uygulama kodu public_html dışındaki app/ klasöründedir.
$appDir = is_dir(__DIR__ . '/../app') ? __DIR__ . '/../app' : __DIR__ . '/app';
require $appDir . '/bootstrap.php';
require $appDir . '/router.php';
