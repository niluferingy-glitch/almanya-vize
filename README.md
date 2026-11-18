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
4. Panelden ücretsiz SSL'i (Let's Encrypt / AutoSSL) aç. `.htaccess` http ve www isteklerini https://www.vizesel.com adresine yönlendirir.

## Yerel test
```sh
VIZESEL_CONFIG=/yol/config.test.php php -S localhost:8080 -t public_html tools/dev-router.php
```

## İçerik
- Merkezler, ülkeler, başlangıç tahmini: `app/data.php`
- Seyahatname yazıları, rehberler, yardım sayfaları, SSS, menü: `app/content.php`
- Pasaport ücretleri: `app/pasaport.php` (tutarlar, SSS, kaynaklar). Yıl başında yalnız bu dosya güncellenir.
- Pasaport ve Gezi rehberi menüde kapalı; içerik dolunca `nav_items()` içinde `'on' => true` yapılır.
- Yönetim paneli: `/yonetim/` (yönetici anahtarı ister). Tarihler onaysız hesaba girer, notlar onaydan sonra görünür.

## Güvenlik
Kodda olanlar:
- Tüm sayfalarda güvenlik başlıkları: CSP (yalnız kendi dosyalarımız çalışır), HSTS, çerçeveye gömme yasağı, nosniff. Sayfalarda satır içi `<script>` ya da `onclick=` kullanılmaz; JavaScript yalnız `assets/js/` altındaki dosyalarda (`site.js`, pasaport ücretleri sayfası için `pasaport.js`).
- Veritabanı sorgularının hepsi hazır ifadeyle (SQL enjeksiyonuna kapalı), tüm çıktılar `h()` ile kaçışlı.
- API: başka sitelerden gelen yazma istekleri reddedilir (Origin / Sec-Fetch-Site / JSON zorunlu). Kişi başı günde 3 yeni kayıt, 30 düzenleme; tüm site için günde `daily_cap` yeni kayıt.
- Yönetim: anahtar en az 32 karakter olmalı, günde 5 hatalı denemeden sonra o IP kilitlenir, istenirse `admin_ips` ile yalnız belirli IP'lere açılır.
- Hatalar ekrana değil `app/logs/php-error.log` dosyasına yazılır. `error_log`, `.sql`, `.md`, `.yml`, yedek dosyaları ve `index.php` dışındaki `.php` dosyaları tarayıcıya kapalı.
- Yönlendirmeler yalnız kendi alan adımıza gider (açık yönlendirme yok).

Panelden bir kez yapılacaklar:
1. cPanel ve Güzel Hosting müşteri paneli için iki adımlı doğrulamayı (2FA) aç; GitHub ve Cloudflare hesaplarında da.
2. PHP sürümünü 8.2 veya üstüne al (cPanel > PHP sürümü seçici).
3. MySQL kullanıcısına yalnız SELECT, INSERT, UPDATE, DELETE yetkisi ver (cPanel > MySQL Veritabanları > ayrıcalıklar).
4. `admin_token` ve `salt` değerlerini yeniden üret: `php -r 'echo bin2hex(random_bytes(32)), PHP_EOL;'`
5. `public_html/error_log` dosyası varsa sil (artık oraya yazılmıyor).
6. Otomatik yedeklemeyi aç (JetBackup ya da panelin yedekleme bölümü), veritabanı dahil.
