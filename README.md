# vizesel.com

PHP 8 + MySQL. Paylaşımlı hostingde (cPanel / DirectAdmin) çalışır, derleme adımı yok.

## Klasörler
- `public_html/` sitenin kök klasörü: `index.php` (tüm istekler), `.htaccess`, `assets/`
- `app/` uygulama kodu. Hostingde `public_html` ile **aynı seviyeye** (dışına) konur, tarayıcıdan erişilemez.
- `schema.sql` veritabanı tabloları
- `tools/dev-router.php` yerel test için

## İlk kurulum (hosting)
1. Panelden MySQL veritabanı ve kullanıcısı oluştur, `schema.sql` dosyasını phpMyAdmin ile içe aktar.
2. `app/config.sample.php` dosyasını `app/config.php` olarak kopyala, veritabanı bilgilerini, `admin_token` ve `salt` değerlerini doldur.
3. `app/` klasörünü ev dizinine (public_html'in yanına), `public_html/` içeriğini sitenin kök klasörüne yükle.
4. Panelden ücretsiz SSL'i (Let's Encrypt / AutoSSL) aç. `.htaccess` http ve www isteklerini https://vizesel.com adresine yönlendirir.

## Yerel test
```sh
VIZESEL_CONFIG=/yol/config.test.php php -S localhost:8080 -t public_html tools/dev-router.php
```

## İçerik
- Merkezler, ülkeler, başlangıç tahmini: `app/data.php`
- Seyahatname yazıları, rehberler, yardım sayfaları, SSS, menü: `app/content.php`
- Pasaport ve Gezi rehberi menüde kapalı; içerik dolunca `nav_items()` içinde `'on' => true` yapılır.
- Yönetim paneli: `/yonetim/` (yönetici anahtarı ister). Tarihler onaysız hesaba girer, notlar onaydan sonra görünür.
