<?php
// Menü, yazar, Seyahatname yazıları, yardım sayfaları ve sık sorulanlar.

function nav_items(): array {
    // Pasaport ve Gezi rehberi bölümleri içerik dolunca 'on' => true yapılacak.
    return [
        ['label' => 'Vize',         'href' => '/ulkeler/almanya/vize/', 'key' => 'vize',        'on' => true],
        ['label' => 'Pasaport',     'href' => '/pasaport/',             'key' => 'pasaport',    'on' => false],
        ['label' => 'Gezi rehberi', 'href' => '/gezi/',                 'key' => 'gezi',        'on' => false],
        ['label' => 'Seyahatname',  'href' => '/seyahatname/',          'key' => 'seyahatname', 'on' => true],
        ['label' => 'Yardım',       'href' => '/yardim/',               'key' => 'yardim',      'on' => true],
    ];
}

function author(): array {
    return [
        'name' => 'Nilüfer Tekin',
        'slug' => 'nilufer-tekin',
        'url'  => '/yazar/nilufer-tekin/',
        'role' => 'Kurucu ve editör',
        'city' => 'İstanbul',
        'avatar' => '/assets/img/nilufer-tekin-avatar.webp',
        'portrait' => '/assets/img/nilufer-tekin-portre.webp',
        'short' => 'Vizesel\'in kurucusu. Kendisi de şu an Almanya vizesi başvuru sürecinde.',
        'bio' => 'Şu an Almanya vizesi başvuru sürecinde. Bekleme sürelerini kendi başvurusu için takip ederken Vizesel\'i kurdu.',
        'same_as' => [],  // LinkedIn, GitHub gibi profiller eklenebilir
    ];
}

function sources_almanya(): array {
    return [
        ['Almanya\'nın Türkiye\'deki Dış Temsilcilikleri, vize bilgileri', 'https://tuerkei.diplo.de/'],
        ['iDATA, Almanya vize başvuruları ve randevu bekleme listesi', 'https://www.idata.com.tr/'],
    ];
}

function faq_almanya(): array {
    return [
        ['Atama maili gelince randevuya kaç gün kalıyor?',
         'Vizesel\'deki paylaşımlarda randevu, atama mailinden 3 ile 15 gün sonraya veriliyor. Bazı başvuru sahipleri evrakı 4 günde toplamak zorunda kaldığını yazdı. Belge listesini sıraya girdiğin gün hazırlamaya başlamak en güvenli yol.'],
        ['Bekleme listesine kayıt ücretli mi?',
         'Hayır. Randevu bekleme listesine kayıt ücretsizdir ve kayıt sırasına göre randevu atanır. Atama geldikten sonra randevuyu onaylamak için iDATA hizmet bedelinin kısa süre içinde ödenmesi gerekir. Güncel süre ve tutar için iDATA\'nın sitesine bak.'],
        ['Hangi iDATA ofisine başvurabilirim?',
         'Yaşadığın şehir ile başvurduğun iDATA ofisinin aynı Alman temsilciliğinin (büyükelçilik ya da başkonsolosluk) yetki alanında olması gerekir. Şehrinin hangi temsilciliğe bağlı olduğunu Alman temsilciliklerinin sitesinden kontrol edebilirsin.'],
        ['Randevu almak için aracı firmaya gerek var mı?',
         'Hayır. Alman temsilcilikleri randevu için acente ya da aracı şirkete başvurmanın gerekmediğini duyurdu. Bekleme listesine kaydı kendin yapabilirsin.'],
        ['Bu süreler resmî mi?',
         'Hayır. Süreler başvuru sahiplerinin kendi paylaştığı tarihlerden hesaplanır. Konsolosluk ya da randevu sağlayıcısı bekleme süresi yayınlamadığı için bu sayfa bir tahmin sunar.'],
    ];
}

function sources_danimarka(): array {
    return [
        ['Danimarka Ankara Büyükelçiliği, turistik vize bekleme listesi hakkında bilgi', 'https://um.dk/tyrkiet/tr/vize-ve-oturum/vizeler/bekleme-listesi-hakkinda-bilgi/'],
        ['Danimarka Ankara Büyükelçiliği, vize ve oturum', 'https://um.dk/tyrkiet/tr/vize-ve-oturum/'],
        ['ApplyVisa, Danimarka Dışişleri Bakanlığı çevrim içi vize başvurusu', 'https://applyvisa.um.dk/'],
        ['VFS Global, Türkiye\'deki Danimarka vize başvuru merkezleri', 'https://visa.vfsglobal.com/one-pager/denmark/turkey/turkish/'],
    ];
}

function faq_danimarka(): array {
    return [
        ['Bekleme listesi kimleri kapsıyor?',
         'Yalnızca seyahatinin asıl amacı turizm olan başvuruları. İş seyahati, aile ya da arkadaş ziyareti, kültür ve spor etkinlikleri ile AB vatandaşlarının aile üyelerinin başvuruları listeye girmiyor, bunlar eskisi gibi VFS Global randevusuyla ilerliyor.'],
        ['Listeye girmemek için başka bir kategori seçersem ne olur?',
         'Büyükelçilik, aslında turistik olan bir başvuruyu işleme almadan kapatıyor ve turizm kategorisinden yeniden başvurup listeye kaydolmanı istiyor. Yanlış kategoride ısrar edilirse başvuru reddedilebiliyor.'],
        ['Sıram gelince ne kadar sürem var?',
         'VFS Global sana e-posta gönderiyor. Devam etmek istediğini bildirip randevu almak için 48 saatin var. Bu yüzden listeye kaydolduğun e-posta adresini sık kontrol et.'],
        ['Beklerken pasaportum kimde kalıyor?',
         'Sende. Giriş şartlarını karşıladığın sürece başka seyahatler için kullanabilirsin. Randevu günü orijinal pasaportunu getirmen yeterli.'],
        ['Vazgeçersem vize ücretini geri alabilir miyim?',
         'Listedeyken ve Büyükelçilik başvurunu henüz işleme almadıysa ApplyVisa üzerinden başvurunu iptal edip iade isteyebilirsin.'],
        ['Uçak bileti ve otel almam gerekiyor mu?',
         'Hayır, karar çıkmadan ödeme yapman gerekmiyor. Seyahat planı ve gidiş dönüş rezervasyonu belge olarak istenebilir. Önceden rezervasyon yaptırmak sıranı öne almıyor, randevular kayıt sırasına göre veriliyor.'],
        ['Karar ne kadar sürüyor?',
         'Büyükelçilik, dosya kendisine ulaştıktan sonra en fazla 15 takvim günü içinde karar vermeyi hedefliyor. Ek inceleme gerekirse ya da dosya Danimarka Göçmenlik Dairesi\'ne gönderilirse bu süre 45 güne kadar çıkabiliyor. Süre, VFS\'ye teslim gününden değil dosyanın Büyükelçiliğe ulaştığı günden başlıyor.'],
        ['Bu süreler resmî mi?',
         'Hayır. Büyükelçilik listede ne kadar bekleneceğini garanti etmiyor ve bekleme süresi yayınlamıyor. Bu sayfadaki süreler başvuru sahiplerinin paylaştığı tarihlerden hesaplanır.'],
    ];
}

function sources(string $country): array { return $country === 'danimarka' ? sources_danimarka() : sources_almanya(); }
function faq(string $country): array { return $country === 'danimarka' ? faq_danimarka() : faq_almanya(); }

// Ülke sayfasındaki "Süreç adım adım" bölümü
function steps(string $country): array {
    if ($country === 'danimarka') return [
        'intro' => 'Turistik başvurular için 17 Kasım 2026\'dan beri geçerli süreç, Danimarka Büyükelçiliği\'nin duyurusuna göre.',
        'items' => [
            ['ApplyVisa\'da başvuru', 'Hesap açarsın, formu doldurursun ve 90 avro vize ücretini çevrim içi ödersin. Ön yazı kimlik numarası olan makbuzu yazdırıp imzalarsın.'],
            ['VFS bekleme listesine kayıt', 'Makbuzdaki kimlik numarasıyla VFS Global\'in Türkiye sayfasından listeye kaydolur, amaç olarak turizmi seçersin. Bekleme bu günden başlar.'],
            ['VFS bildirim maili', 'Sıran geldiğinde VFS mail atar. 48 saat içinde devam etmek istediğini bildirip randevu alırsın. Bu sayfadaki süreler bu ana kadar geçen zamanı ölçer.'],
            ['Randevu ve evrak teslimi', 'Form, makbuz, orijinal pasaport ve kontrol listesindeki belgelerle merkeze kendin gidersin. Dosya buradan Ankara\'daki Büyükelçiliğe gönderilir.'],
            ['Karar', 'Büyükelçilik dosya kendisine ulaştıktan sonra en fazla 15 takvim günü hedefliyor, ek inceleme gerekirse 45 güne kadar.'],
        ],
    ];
    return [
        'intro' => 'Ara süreler, kullanıcıların paylaştığı tarihlerden derlenmiştir.',
        'items' => [
            ['Bekleme listesine kayıt', 'iDATA\'nın sitesinden ücretsiz olarak sıraya girersin. Bekleme bu günden başlar.'],
            ['Randevu atama maili', 'Sıran geldiğinde randevu tarihi bildirilir. Bu sayfadaki süreler bu ana kadar geçen zamanı ölçer.'],
            ['Randevu ve evrak teslimi', 'Paylaşımlarda randevu, atama mailinden 3 ile 15 gün sonraya veriliyor. Randevuyu onaylamak için hizmet bedelinin kısa sürede ödenmesi gerekiyor.'],
            ['Sonuç ve pasaport', 'Paylaşımlara göre sonuç, evrak tesliminden 2 ile 4 hafta sonra geliyor.'],
        ],
    ];
}

function posts(): array {
    return [
        'atama-maili-geldi-ne-yapmali' => [
            'title' => 'Atama maili geldi: randevu gününe kadar ne yapmalı?',
            'desc'  => 'Aylarca beklenen mail geldiğinde randevuya bazen yalnız birkaç gün kalır. Bu yazı o birkaç günü sırayla kullanmak için.',
            'kat'   => 'Rehber', 'published' => '2026-11-14', 'updated' => '2026-11-14', 'minutes' => 6,
            'cover' => 'atama', 'cover_alt' => 'Atama maili ve takvim illüstrasyonu', 'cover_credit' => 'İllüstrasyon: Vizesel',
            'country' => 'almanya',
            'summary' => [
                'İlk gün maildeki tarih, saat ve merkezi kontrol et, randevuyu onaylamak için gereken ödemeyi süresi içinde yap.',
                'Belge listesini resmî sayfadan indir, eksikleri işaretle.',
                'Uzun süren belgeleri, yani banka ve işyeri yazılarını, ilk gün iste.',
            ],
            'body' => <<<'HTML'
<h2>1. Maildeki bilgileri kontrol et ve randevuyu onayla</h2>
<p>Randevu tarihini, saatini ve hangi merkezde olduğunu not al. Alman temsilciliklerinin duyurusuna göre atanan randevuyu onaylamak için iDATA hizmet bedelinin atamadan sonraki 48 saat içinde ödenmesi gerekiyor. Ödenmeyen randevu geçerli olmayabilir. Güncel süre ve tutarı iDATA'nın sitesinden kontrol et.</p>
<h2>2. Belge listesini çıkar</h2>
<p>Schengen başvurularında genelde şu belgeler istenir. Kategoriye göre liste değişir, güncel hali için Alman temsilciliklerinin ve iDATA'nın sayfalarına bak.</p>
<ul>
<li>Geçerli pasaport ve eski pasaportlar</li>
<li>Biyometrik fotoğraf</li>
<li>Doldurulmuş başvuru formu</li>
<li>Seyahat sağlık sigortası</li>
<li>Banka hesap dökümü</li>
<li>İşyeri ya da okul yazısı</li>
<li>Ziyaret vizesinde davet mektubu</li>
</ul>
<blockquote><p>Hazırlanması en uzun süren belgeleri ilk gün iste. Fotoğraf ve form bir saatte biter, işyeri yazısının ne zaman geleceğini bilemezsin.</p></blockquote>
<h2>3. Günlere böl</h2>
<dl class="plan">
<div><dt>1. gün</dt><dd>Mail kontrolü, hizmet bedeli ödemesi, belge listesi, banka ve işyeri yazısı talebi</dd></div>
<div><dt>2. gün</dt><dd>Fotoğraf, başvuru formu, sigorta poliçesi</dd></div>
<div><dt>3. gün</dt><dd>Konaklama ve ulaşım planı, varsa davet mektubu</dd></div>
<div><dt>Son gün</dt><dd>Dosyayı listeye göre sırala, fotokopileri ayır</dd></div>
</dl>
<h2>4. Randevu günü</h2>
<p>Randevu saatinden önce merkezde ol. Dosyayı listeye göre sıralı götürmek teslimi hızlandırır. Başvuru seçtiğin kategoriyle uyuşmazsa dosya kabul edilmeyebilir, bu yüzden kategoriyi son kez kontrol et.</p>
<p>Sonuç geldiğinde tarihlerini <a href="/paylas/?ulke=almanya">Vizesel'e eklersen</a> bir sonraki başvuran için tahmin netleşir.</p>
HTML,
            'sources' => [
                ['Almanya\'nın Türkiye\'deki Dış Temsilcilikleri, vize bilgileri', 'https://tuerkei.diplo.de/'],
                ['iDATA, başvuru ve randevu bilgileri', 'https://www.idata.com.tr/'],
            ],
        ],
    ];
}

function guides(): array {
    return [
        'danimarka' => [
            'randevu-nasil-alinir' => [
                'title' => 'Danimarka vize randevusu nasıl alınır?',
                'desc'  => 'Danimarka turistik vizesinde 17 Kasım 2026\'da başlayan bekleme listesi: ApplyVisa\'dan randevu gününe kadar süreç, adım adım.',
                'updated' => '2026-11-17',
                'body' => <<<'HTML'
<p>Danimarka'nın Ankara Büyükelçiliği, Türkiye'den yapılan turistik vize başvuruları için 17 Kasım 2026'da geçici bir bekleme listesi başlattı. Artık turistik başvuruda önce sıraya giriyor, sıran gelince randevu alıyorsun. Başvurular Türkiye'de yalnızca VFS Global üzerinden alınıyor.</p>
<h2>Kimler listeye giriyor?</h2>
<p>Sadece seyahatinin asıl amacı turizm olanlar. İş seyahati, aile ya da arkadaş ziyareti, kültür ve spor etkinlikleri ile AB vatandaşlarının aile üyeleri listeye girmiyor, bu başvurular eskisi gibi doğrudan VFS randevusuyla ilerliyor.</p>
<p>Listeyi atlamak için farklı bir kategori seçmek işe yaramıyor. Büyükelçilik turistik olduğunu düşündüğü başvuruyu kapatıp turizm kategorisinden yeniden başvurmanı istiyor. Israr edilirse başvuru reddedilebiliyor.</p>
<h2>Adım adım</h2>
<ol>
<li><strong>ApplyVisa'da başvur.</strong> Danimarka Dışişleri Bakanlığı'nın ApplyVisa sitesinde hesap aç, formu doldur ve 90 avro vize ücretini öde.</li>
<li><strong>Makbuzu yazdır.</strong> Ödemeden sonra ön yazı kimlik numarası olan bir makbuz oluşuyor. Bunu yazdırıp imzala, randevu günü lazım olacak.</li>
<li><strong>VFS bekleme listesine kaydol.</strong> Makbuzdaki kimlik numarasıyla VFS Global'in Türkiye sayfasından listeye kaydol ve seyahat amacı olarak turizmi seç.</li>
<li><strong>Bildirim mailini bekle.</strong> Sıran geldiğinde VFS mail atıyor. Devam etmek istediğini bildirip randevu almak için 48 saatin var.</li>
<li><strong>Randevuya git.</strong> Form, makbuz, orijinal pasaport ve kontrol listesindeki belgelerle, güncel seyahat planın dahil, merkeze kendin git. VFS kimlik numarasıyla belgelerin uyuştuğunu yerinde kontrol ediyor.</li>
</ol>
<h2>Merkezler</h2>
<p>Danimarka'nın Türkiye'de dört vize başvuru merkezi var: İstanbul, Ankara, İzmir ve Antalya. Hepsini VFS Global işletiyor, kararı Ankara'daki Büyükelçilik veriyor.</p>
<h2>Beklerken bilmen gerekenler</h2>
<ul>
<li>Pasaportun sende kalıyor. Başka seyahatler için kullanabilirsin, randevu günü getirmen yeterli.</li>
<li>Bilet ya da otel için ödeme yapman gerekmiyor. Rezervasyon belgesi istenebilir ama önceden rezervasyon sıranı öne almıyor.</li>
<li>Listeye kaydolmak, randevunun seyahat tarihinden önce geleceği anlamına gelmiyor. Büyükelçilik bekleme süresi için garanti vermiyor, erken kaydolmak en güvenli yol.</li>
<li>Vazgeçersen, başvurun henüz işleme alınmadıysa ApplyVisa'dan iptal edip ücret iadesi isteyebilirsin.</li>
<li>Randevular kişiye özel. Randevu satan aracılardan uzak dur. Büyükelçilik de acente kullanılmamasını öneriyor.</li>
</ul>
<h2>Karar ne kadar sürer?</h2>
<p>Büyükelçilik, dosya kendisine ulaştıktan sonra en fazla 15 takvim günü içinde karar vermeyi hedefliyor. Ek inceleme gerekirse ya da dosya Danimarka Göçmenlik Dairesi'ne gönderilirse bu süre 45 güne kadar çıkabiliyor. Süre, VFS'ye teslim ettiğin günden değil, dosyanın Büyükelçiliğe ulaştığı günden sayılıyor.</p>
<h2>Listede ne kadar bekleniyor?</h2>
<p>Liste yeni başladığı için henüz bildiğimiz bir süre yok. Kaydolduysan <a href="/paylas/?ulke=danimarka">kayıt tarihini Vizesel'e ekle</a>, bildirim maili geldiğinde de o tarihi güncelle. Paylaşımlar biriktikçe merkezlere göre bekleme süresini bu sitede gösteriyoruz.</p>
HTML,
            ],
        ],
        'almanya' => [
            'randevu-nasil-alinir' => [
                'title' => 'Almanya vize randevusu nasıl alınır?',
                'desc'  => 'Bekleme listesine kayıttan randevu gününe kadar Almanya Schengen vizesinde randevu süreci, adım adım.',
                'updated' => '2026-11-14',
                'body' => <<<'HTML'
<p>Almanya, Türkiye'deki Schengen vize randevularını iki aşamalı bir sistemle veriyor: önce bekleme listesine kaydolursun, sonra sıran geldiğinde sana bir randevu tarihi atanır.</p>
<h2>1. Bekleme listesine kayıt</h2>
<p>Kayıt, Almanya'nın Türkiye'deki tek yetkili hizmet sağlayıcısı iDATA'nın sitesinden yapılır ve ücretsizdir. Kayıt sırasında başvuracağın ofisi ve vize kategorisini (turistik, ziyaret, ticari gibi) seçersin. Kaydın alındığına dair e-posta gelir.</p>
<p>Yaşadığın şehir ile seçtiğin iDATA ofisinin aynı Alman temsilciliğinin yetki alanında olması gerekir.</p>
<h2>2. Randevu ataması</h2>
<p>Randevular, bekleme listesindeki kayıtların sırasına göre atanır. Sıran geldiğinde randevu tarihini bildiren bir e-posta gelir. Vizesel'deki bekleme süreleri, kayıttan bu e-postaya kadar geçen zamanı ölçer.</p>
<h2>3. Randevuyu onaylama</h2>
<p>Atanan randevuyu onaylamak için iDATA hizmet bedelinin kısa bir süre içinde ödenmesi gerekir. Alman temsilciliklerinin duyurusunda bu süre 48 saat olarak belirtiliyor. Güncel süre ve tutarı iDATA'nın sitesinden kontrol et.</p>
<h2>4. Başvuru günü</h2>
<p>Randevu günü belgelerini iDATA ofisine teslim edersin, parmak izin ve fotoğrafın alınır. Sonuç ve pasaport daha sonra bildirilir. Paylaşımlara göre sonuç genelde 2 ile 4 hafta içinde geliyor.</p>
<h2>Dikkat edilecekler</h2>
<ul>
<li>Randevu için acente ya da aracı firmaya gerek yok. Kaydı kendin yapabilirsin.</li>
<li>Kişisel bilgilerini yalnız resmî iDATA sitesine gir. Benzer adlı sitelere dikkat et.</li>
<li>Başvuru dosyan seçtiğin kategoriyle uyuşmazsa kabul edilmeyebilir.</li>
</ul>
HTML,
            ],
        ],
    ];
}

function help_pages(): array {
    return [
        'tarih-nasil-paylasilir' => [
            'title' => 'Tarihlerimi nasıl paylaşırım?',
            'desc'  => 'Vizesel\'e bekleme tarihlerini eklemek bir dakika sürer. Hangi bilgilerin istendiği ve sonra nasıl güncelleneceği.',
            'body' => <<<'HTML'
<ol>
<li><a href="/paylas/">Paylaş sayfasını</a> aç.</li>
<li>Ülkeyi, başvurduğun merkezi ve kategoriyi seç.</li>
<li>Bekleme listesine kaydolduğun günü gir. Atama maili geldiyse onun tarihini de ekle.</li>
<li>İstersen bir takma ad ve kısa bir not yaz. Not, yayınlanmadan önce kontrol edilir.</li>
<li>Onay kutusunu işaretleyip Ekle'ye bas.</li>
</ol>
<p>Ad, e-posta ya da pasaport bilgisi istemiyoruz. Atama maili geldiğinde aynı tarayıcıdan Paylaş sayfasına dönersen kaydın formda hazır olur, yalnız yeni tarihi ekleyip Güncelle'ye basman yeterli.</p>
HTML,
        ],
        'kaydimi-silmek-istiyorum' => [
            'title' => 'Kaydımı nasıl silerim?',
            'desc'  => 'Vizesel\'e eklediğin kaydı istediğin zaman silebilirsin. Aynı tarayıcıdan ya da e-postayla.',
            'body' => <<<'HTML'
<p>Kaydını eklediğin tarayıcıdan <a href="/paylas/">Paylaş sayfasına</a> git ve formun altındaki "kaydımı sil" bağlantısına iki kez tıkla. Kayıt kalıcı olarak silinir.</p>
<p>Başka bir cihazdan ya da tarayıcının verilerini temizledikten sonra silmek istersen bize yaz. Kaydı bulabilmemiz için merkezi, kategoriyi ve kayıt tarihini belirtmen yeterli.</p>
HTML,
        ],
        'sozluk' => [
            'title' => 'Vize sözlüğü',
            'desc'  => 'Bekleme listesi, atama, ortalama süre ve Vizesel\'de geçen diğer terimlerin kısa açıklamaları.',
            'body' => <<<'HTML'
<dl class="glossary">
<dt>Bekleme listesi</dt><dd>Randevu almak için kaydolduğun sıra. Almanya için kayıt iDATA'nın sitesinden yapılır.</dd>
<dt>Kayıt tarihi</dt><dd>Bekleme listesine kaydolduğun gün. Vizesel'deki süreler bu günden başlar.</dd>
<dt>Atama maili</dt><dd>Sıran geldiğinde gelen ve randevu tarihini bildiren e-posta.</dd>
<dt>Randevu</dt><dd>Belgelerini teslim etmek için başvuru merkezine gittiğin gün.</dd>
<dt>Kategori</dt><dd>Seyahat amacına göre seçtiğin vize türü: turistik, aile ya da arkadaş ziyareti, ticari gibi.</dd>
<dt>Ortalama süre</dt><dd>Sitede gösterilen bekleme süresi. Kayıtlar küçükten büyüğe sıralandığında ortada kalan değerdir (ortanca), bu yüzden birkaç uç kayıt sonucu bozmaz.</dd>
<dt>Şu an işlenen kayıtlar</dt><dd>Ataması gelen en yeni kaydın ayı. Sıranın hangi aya kadar ilerlediğini gösterir.</dd>
<dt>Başlangıç tahmini</dt><dd>Site açılırken kamuya açık yorumlardan derlenen toplu sayılar. Bir merkezde 3 kullanıcı kaydı birikince kaldırılır.</dd>
</dl>
HTML,
        ],
    ];
}
