<?php
// Bu dosyayı config.php adıyla kopyalayıp değerleri doldurun. config.php git'e girmez.
return [
    'site_url'    => 'https://www.vizesel.com',
    // Veritabanı. Hosting'de MySQL, yerelde test için SQLite kullanılabilir.
    'db_dsn'      => 'mysql:host=localhost;dbname=KULLANICI_vizesel;charset=utf8mb4',
    'db_user'     => 'KULLANICI_vizesel',
    'db_pass'     => 'SIFRE',
    // Yönetim paneli (/yonetim/) anahtarı. En az 32 karakter, yoksa panel açılmaz.
    // Üretmek için: php -r 'echo bin2hex(random_bytes(32)), PHP_EOL;'
    'admin_token' => 'DEGISTIR',
    // İsteğe bağlı: paneli yalnız bu IP adreslerine aç, örn. ['85.1.2.3']. Boş liste = her yerden.
    'admin_ips'   => [],
    // IP özetleri için rastgele bir dizi (yukarıdaki komutla üretilebilir).
    'salt'        => 'DEGISTIR',
    // Tüm site için günlük en fazla yeni kayıt (sahte kayıt yağmuruna karşı).
    'daily_cap'   => 300,
    'contact_email' => 'iletisim@vizesel.com',
    // Hata ayrıntılarını ekrana yaz (yalnız yerelde true).
    'debug'       => false,
];
