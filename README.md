# Almanya vize bekleme süreleri

Cloudflare Pages + D1 + Pages Functions. Aylık maliyet 0, yalnız alan adı ücreti.

## Yapı
- `public/index.html` – site
- `public/admin.html` – not onaylama paneli (yönetici anahtarı ister)
- `functions/api/entries/*` – kayıt ekleme, güncelleme, silme, listeleme
- `functions/api/admin.js` – onay/silme
- `schema.sql` – veritabanı tabloları

## İlk kurulum (bir kez)
```sh
npm i -g wrangler
export CLOUDFLARE_API_TOKEN=...   # Pages:Edit, D1:Edit yetkili token
wrangler d1 create almanya-vize   # çıkan database_id'yi wrangler.toml'a yaz
wrangler d1 execute almanya-vize --remote --file=schema.sql
wrangler pages project create almanya-vize --production-branch=main
wrangler pages secret put ADMIN_TOKEN --project-name=almanya-vize   # admin paneli şifresi
wrangler pages secret put SALT --project-name=almanya-vize          # rastgele bir dizi
```

## Her yayın
```sh
wrangler pages deploy public --project-name=almanya-vize
```

## Moderasyon
`/admin.html` adresine gir, yönetici anahtarını yaz. Tarihler onaysız hesaba girer; yalnız serbest metin notları onaydan sonra görünür.

## Veri
- Kişisel veri yok: ad, e-posta, telefon toplanmaz. Takma ad isteğe bağlı.
- IP yalnız günlük sınır için tuzlu SHA-256 özeti olarak tutulur, 24 saat sonra silinir.
- Her kayıt için bir düzenleme anahtarı üretilir, yalnız tarayıcıda saklanır; kullanıcı kaydını onunla günceller veya siler.
