<?php
// Bu dosyayı config.php adıyla kopyalayıp değerleri doldurun. config.php git'e girmez.
return [
    'site_url'    => 'https://www.vizesel.com',
    // Veritabanı. Hosting'de MySQL, yerelde test için SQLite kullanılabilir.
    'db_dsn'      => 'mysql:host=localhost;dbname=KULLANICI_vizesel;charset=utf8mb4',
    'db_user'     => 'KULLANICI_vizesel',
    'db_pass'     => 'SIFRE',
    // Yönetim paneli (/yonetim/) anahtarı. Uzun ve rastgele olsun.
    'admin_token' => 'DEGISTIR',
    // IP özetleri için rastgele bir dizi.
    'salt'        => 'DEGISTIR',
    'contact_email' => 'iletisim@vizesel.com',
    // Hata ayrıntılarını ekrana yaz (yalnız yerelde true).
    'debug'       => false,
];
