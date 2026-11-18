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
         'Vizesel\'deki paylaşımlarda randevu, atama mailinden 3 ile 15 gün sonraya veriliyor. Bazı başvuru sahipleri evrakı 4 günde toplamak zorunda kaldıklarını yazdı. Belge listesini sıraya girdiğin gün hazırlamaya başlamak en güvenli yol.'],
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
         'VFS Global sana e-posta gönderiyor. Mailden sonraki 48 saat içinde devam etmek istediğini VFS\'ye bildirip randevu alman gerekiyor. Bu yüzden listeye kaydolduğun e-posta adresini sık kontrol et.'],
        ['Beklerken pasaportum kimde kalıyor?',
         'Sende. Giriş şartlarını karşıladığın sürece başka seyahatler için kullanabilirsin. Randevu günü orijinal pasaportunu getirmen yeterli.'],
        ['Vazgeçersem vize ücretini geri alabilir miyim?',
         'Listedeyken ve Büyükelçilik başvurunu henüz işleme almadıysa ApplyVisa üzerinden başvurunu iptal edip iade isteyebilirsin.'],
        ['Uçak bileti ve otel almam gerekiyor mu?',
         'Hayır, karar çıkmadan ödeme yapman gerekmiyor. Seyahat planı ve gidiş dönüş rezervasyonu belge olarak istenebilir. Önceden rezervasyon yaptırmak sıranı öne almıyor, randevular kayıt sırasına göre veriliyor.'],
        ['Karar ne kadar sürüyor?',
         'Büyükelçilik, dosya kendisine ulaştıktan sonra en fazla 15 takvim günü içinde karar vermeyi hedefliyor. Ek inceleme gerekirse ya da dosya Danimarka Göçmenlik Dairesine gönderilirse bu süre 45 güne kadar çıkabiliyor. Süre, VFS\'ye teslim gününden değil dosyanın Büyükelçiliğe ulaştığı günden başlıyor.'],
        ['Bu süreler resmî mi?',
         'Hayır. Büyükelçilik listede ne kadar bekleneceğini garanti etmiyor ve bekleme süresi yayınlamıyor. Bu sayfadaki süreler başvuru sahiplerinin paylaştığı tarihlerden hesaplanır.'],
    ];
}

function sources(string $country): array { return $country === 'danimarka' ? sources_danimarka() : sources_almanya(); }
function faq(string $country): array { return $country === 'danimarka' ? faq_danimarka() : faq_almanya(); }

// Ülke sayfasındaki "Süreç adım adım" bölümü
function steps(string $country): array {
    if ($country === 'danimarka') return [
        'intro' => 'Danimarka Büyükelçiliğinin 17 Kasım 2026 tarihli duyurusuna göre turistik başvurularda süreç.',
        'items' => [
            ['ApplyVisa\'da başvuru', 'Hesap açarsın, formu doldurursun ve 90 avro vize ücretini çevrim içi ödersin. Ön yazı kimlik numarası olan makbuzu yazdırıp imzalarsın.'],
            ['VFS bekleme listesine kayıt', 'Makbuzdaki kimlik numarasıyla VFS Global\'in Türkiye sayfasından listeye kaydolur, amaç olarak turizmi seçersin. Bekleme bu günden başlar.'],
            ['VFS bildirim maili', 'Sıran geldiğinde VFS mail atar. 48 saat içinde devam etmek istediğini VFS\'ye bildirip randevu alırsın. Bu sayfadaki süreler bu ana kadar geçen zamanı ölçer.'],
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
        'schengen-vizesi-hangi-ulkeye-basvurulur' => [
            'title' => 'Schengen vizesi için hangi ülkeye başvurmalıyım?',
            'desc'  => 'Ana varış ülkesi kuralı, örnek rotalar ve karar şemasıyla ilk Schengen başvurusunda doğru ülkeyi seçmek. Adım adım ilk Schengen vizesi serisinin ilk bölümü.',
            'kat'   => 'Rehber', 'published' => '2026-11-18', 'updated' => '2026-11-18', 'minutes' => 7,
            'cover' => 'schengen-ulke', 'cover_alt' => 'Üç yöne bakan yol tabelası illüstrasyonu', 'cover_credit' => 'İllüstrasyon: Vizesel',
            'summary' => [
                'Tek bir Schengen ülkesine gidiyorsan o ülkeye, birden fazla ülkeye gidiyorsan asıl amacının olduğu ya da en uzun kalacağın ülkeye başvurursun.',
                'Her ülkede eşit süre kalacaksan Schengen\'e ilk gireceğin ülkeye başvurursun.',
                'Ret oranı düşük diye başka bir ülkeye başvurmak kurallara aykırı. Başvurun reddedilebilir ya da vizen iptal edilebilir.',
            ],
            'body' => <<<'HTML'
<p class="seri">Adım adım ilk Schengen vizesi · Bölüm 1 / 11</p>
<p>İlk kez Schengen vizesine başvuracaksan kafandaki soruların çoğu aynı yerden başlar: Nereye başvuracağım, hangi belgeleri toplayacağım, randevuyu nasıl bulacağım? Bu seride bu soruları sırayla, bir başvuruyu baştan sona yürütür gibi cevaplıyoruz. Her bölüm bir adımı anlatıyor ve sonunda o adımda yapman gerekenlerin kısa bir listesi var.</p>
<p>İlk adım, hangi ülkeye başvuracağını belirlemek. Basit görünüyor ama yanlış ülkeye başvurmak dosyanın geri gönderilmesine, ret almana ya da vizeyi aldıktan sonra sınırda sorun yaşamana yol açabiliyor. Bu yazının sonunda kendi rotana bakıp hangi ülkeye başvuracağını kesin olarak bilmiş olacaksın.</p>
<h2>Kısa cevap</h2>
<p>Schengen vizesine, seyahatinin ana varış ülkesi olan ülkeye başvurursun. Bunu üç adımda bulursun:</p>
<ol>
<li>Tek bir Schengen ülkesine gidiyorsan o ülkeye başvurursun.</li>
<li>Birden fazla ülkeye gidiyorsan seyahatin asıl amacının olduğu ya da en uzun kalacağın ülkeye başvurursun.</li>
<li>Ana ülke belirlenemiyorsa, yani her ülkede eşit süre kalacaksan, Schengen bölgesine ilk giriş yapacağın ülkeye başvurursun.</li>
</ol>
<p>Bu sıralama bir tavsiye değil, AB Vize Kodu'nda yazan kural. Hangi ülkeden vize almak daha kolay diye seçim yapma şansın yok.</p>
<h2>Schengen bölgesinde hangi ülkeler var?</h2>
<p>Başvuru ülkesini seçmeden önce rotandaki ülkelerin gerçekten Schengen'de olup olmadığına bak. 2026 itibarıyla Schengen bölgesinde 29 ülke var:</p>
<p>Almanya, Avusturya, Belçika, Bulgaristan, Çekya, Danimarka, Estonya, Finlandiya, Fransa, Hırvatistan, Hollanda, İspanya, İsveç, İsviçre, İtalya, İzlanda, Letonya, Lihtenştayn, Litvanya, Lüksemburg, Macaristan, Malta, Norveç, Polonya, Portekiz, Romanya, Slovakya, Slovenya ve Yunanistan.</p>
<p>Bunlardan dördü, yani İzlanda, Lihtenştayn, Norveç ve İsviçre, AB üyesi değil ama Schengen'de. Bulgaristan ve Romanya ise 1 Ocak 2025'ten beri tam üye, bu yüzden Schengen vizesiyle bu iki ülkeye de girebilirsin.</p>
<p>Karıştırılan birkaç ülke de var:</p>
<ul>
<li><strong>İrlanda ve Kıbrıs Cumhuriyeti</strong> AB üyesi ama Schengen'de değil. Schengen vizen buraları kapsamaz.</li>
<li><strong>İngiltere</strong> Schengen'de değil, ayrı vize ister.</li>
<li><strong>Bazı Yunan adaları için ayrı bir yol var.</strong> Türk vatandaşları Ege'deki 12 Yunan adasına kapı vizesiyle 7 güne kadar gidebiliyor. Yunanistan bu uygulamayı Mart 2026'da bir yıl daha uzattı. Kapı vizesi sadece girdiğin adada geçerli. Anakaraya ya da başka bir Schengen ülkesine geçeceksen normal Schengen vizesi alman gerekir.</li>
</ul>
<h2>Ana varış ülkesi kuralı tam olarak ne diyor?</h2>
<p>Kuralın kaynağı AB Vize Kodu'nun (810/2009 sayılı tüzük) 5. maddesi. Madde, başvuruna hangi ülkenin bakacağını şu sırayla belirliyor: Tek varış yeri varsa o ülke, birden fazla varsa kalış süresi ya da amaç bakımından ana varış yeri olan ülke, ana varış yeri belirlenemiyorsa dış sınırını geçerek Schengen'e gireceğin ülke.</p>
<p>Pratikte bunu şöyle okuyabilirsin:</p>
<ul>
<li><strong>Amaç:</strong> Seyahatini tek bir ülkedeki bir sebep belirliyorsa, örneğin bir fuar, bir düğün ya da bir konferans, ana ülke orasıdır.</li>
<li><strong>Süre:</strong> Turistik bir gezide amaç her yerde aynıdır, bu yüzden geceleri sayarsın. En çok gece kalacağın ülke ana ülkedir. Aynı ülkedeki farklı şehirler toplanır.</li>
<li><strong>İlk giriş:</strong> Gece sayıları eşitse Schengen'e ilk adım attığın ülkeye başvurursun. Uçakla gidiyorsan bu, dışarıdan gelip indiğin ilk Schengen havalimanının ülkesidir.</li>
</ul>
<p>Bilmen gereken iki ayrıntı daha var. İlki, ilk giriş kuralı sadece bir eşitlik bozucu. Ana ülken belliyse, uçağın başka bir ülkeye inse bile başvurunu ana ülkeye yaparsın. İkincisi, başvuruyu yaşadığın ülkedeki temsilciliğe yaparsın. Türkiye'de yaşıyorsan başvurun Türkiye'deki büyükelçilik, konsolosluk ya da yetkili başvuru merkezi üzerinden olur. Hangi şehrin hangi konsolosluğa bağlı olduğunu bir sonraki bölümde anlatıyoruz.</p>
<p>Yanlış ülkeye başvurursan ne olur? Vize Kodu'na göre yetkisiz konsolosluk dosyanı geri vermeli, vize ücretini iade etmeli ve hangi konsolosluğa başvurman gerektiğini söylemeli. Yani paranı geri alırsın ama zamanını ve belki de zor bulduğun randevuyu kaybedersin.</p>
<h2>Adım adım karar şeması</h2>
<figure class="karar" aria-labelledby="karar-baslik">
<p class="karar-baslik" id="karar-baslik">Başvuru ülkeni üç soruda bulursun</p>
<div class="karar-satir">
<div class="karar-soru"><span class="karar-no">1</span><span>Kaç Schengen ülkesine gidiyorsun?</span></div>
<div class="karar-ok"><span>Tek ülke</span></div>
<div class="karar-sonuc"><strong>O ülkeye başvur</strong><span>Sadece İtalya'ya gidiyorsan İtalya</span></div>
</div>
<p class="karar-gecis">Birden fazlaysa 2. soruya geç</p>
<div class="karar-satir">
<div class="karar-soru"><span class="karar-no">2</span><span>Asıl amaç tek bir ülkede mi?</span></div>
<div class="karar-ok"><span>Evet</span></div>
<div class="karar-sonuc"><strong>Amacın olduğu ülkeye başvur</strong><span>Fuar, düğün, konferans gibi</span></div>
</div>
<p class="karar-gecis">Hayırsa 3. soruya geç</p>
<div class="karar-satir">
<div class="karar-soru"><span class="karar-no">3</span><span>En uzun kalacağın ülke belli mi?</span></div>
<div class="karar-ok"><span>Evet</span></div>
<div class="karar-sonuc"><strong>En uzun kalacağın ülkeye başvur</strong><span>Aynı ülkedeki şehirler toplanır</span></div>
</div>
<p class="karar-gecis">Hayırsa, yani geceler eşitse</p>
<div class="karar-satir karar-tek">
<div class="karar-sonuc"><strong>İlk gireceğin ülkeye başvur</strong><span>Uçakla gidiyorsan ilk indiğin Schengen havalimanının ülkesi</span></div>
</div>
<figcaption>Şemayı yukarıdan aşağıya oku ve ilk vardığın kutuda dur. O kutu, başvuracağın ülkeyi söylüyor.</figcaption>
</figure>
<h2>Örnek rotalarla hangi ülkeye başvurulur?</h2>
<p>Kuralı en iyi örneklerle anlarsın. Aşağıdaki rotalar ilk başvuruda en çok kafa karıştıran durumlar. Kendi rotanı en çok hangisine benziyorsa ona bak.</p>
<div class="tablo">
<table>
<thead><tr><th>Rota</th><th>Gece dağılımı</th><th>Başvuracağın ülke</th><th>Neden</th></tr></thead>
<tbody>
<tr><td>Amsterdam ve Brüksel</td><td>Hollanda 4, Belçika 2</td><td>Hollanda</td><td>En uzun kalış Hollanda'da.</td></tr>
<tr><td>Roma, Floransa ve Paris</td><td>İtalya 5 (Roma 3, Floransa 2), Fransa 3</td><td>İtalya</td><td>Aynı ülkedeki şehirler toplanır. Paris tek başına en uzun durak olsa da İtalya'da toplam 5 gece var.</td></tr>
<tr><td>Berlin'de kardeşinin düğünü, sonra Prag</td><td>Almanya 3, Çekya 2</td><td>Almanya</td><td>Seyahatin amacı düğün ve en uzun kalış da Almanya'da.</td></tr>
<tr><td>Viyana aktarmalı uçuşla Barselona</td><td>İspanya 5</td><td>İspanya</td><td>Aktarma yaptığın ülke ana varış ülkesi olmaz.</td></tr>
<tr><td>Atina'ya uçak, sonra Roma</td><td>Yunanistan 3, İtalya 3</td><td>Yunanistan</td><td>Geceler eşit, Schengen'e ilk giriş Atina'dan.</td></tr>
<tr><td>Sadece Midilli</td><td>Yunanistan 4</td><td>Yunanistan ya da kapı vizesi</td><td>Ada kapı vizesi kapsamındaysa ve 7 günü geçmiyorsan Schengen vizesine gerek kalmayabilir.</td></tr>
</tbody>
</table>
</div>
<p>Rotan bu tablodakilerden karışıksa önce kendine şu soruyu sor: “Bu seyahati neden yapıyorum?” Cevap tek bir ülkeyi gösteriyorsa başvuru ülken orasıdır. Göstermiyorsa geceleri say.</p>
<h2>“En kolay vize veren ülke” hangisi?</h2>
<p>Bu soru çok aranıyor ve cevabı seni şaşırtabilir: Ret oranı düşük diye bir ülkeye başvuramazsın. Başvuru ülkesini rotan belirler. Yine de merak edenler için Avrupa Komisyonu'nun 2025 verilerinden bazı rakamlar şöyle:</p>
<div class="tablo">
<table>
<thead><tr><th>Ülke</th><th class="sayi">Türkiye'den başvuru (2025)</th><th class="sayi">Ret oranı</th></tr></thead>
<tbody>
<tr><td>Yunanistan</td><td class="sayi">310.920</td><td class="sayi">%10,7</td></tr>
<tr><td>Almanya</td><td class="sayi">217.627</td><td class="sayi">%21,1</td></tr>
<tr><td>Fransa</td><td class="sayi">143.379</td><td class="sayi">%15,2</td></tr>
<tr><td>İtalya</td><td class="sayi">79.470</td><td class="sayi">%14,8</td></tr>
<tr><td>Danimarka</td><td class="sayi">44.253</td><td class="sayi">%19,2</td></tr>
<tr><td>Macaristan</td><td class="sayi">35.605</td><td class="sayi">%18,1</td></tr>
<tr><td>Portekiz</td><td class="sayi">3.921</td><td class="sayi">%3,5</td></tr>
</tbody>
</table>
</div>
<p>2025'te Türkiye'den toplam 1.268.376 Schengen başvurusu yapıldı ve ret oranı %14,6 oldu. En yüksek ret oranı %34,8 ile Malta'da görüldü.</p>
<p>Bu tabloyu okurken iki şeye dikkat et. Birincisi, düşük ret oranı o ülkenin “kolay” olduğu anlamına gelmiyor. Portekiz'e çok az kişi başvuruyor ve başvuranların profili farklı olabilir. İkincisi, gitmeyeceğin ya da kısa uğrayacağın bir ülkeden vize almaya çalışmak, AB'nin Türkiye'deki resmî sayfasında açıkça yapılmaması gerekenler arasında sayılıyor. Kurallara uymayanların başvurusu reddedilebiliyor, vizesi iptal edilebiliyor ya da sınırda geri çevrilebiliyor. Bu kayıt sonraki başvurularında da karşına çıkar.</p>
<p>Vizeyi kolaylaştıran şey ülke seçimi değil, dosyanın tutarlı olması. Rotan, otel rezervasyonun, uçuşun ve başvurduğun ülke aynı hikâyeyi anlatmalı.</p>
<h2>Ne zaman başvurmalı ve nelere dikkat etmeli?</h2>
<p>Ülkeyi belirledikten sonra takvimi kur. Başvurunu seyahatinden en erken 6 ay, en geç 15 takvim günü önce yapabilirsin. 15 gün yasal alt sınır ama randevu bulmak haftalar sürebiliyor. Bu yüzden seyahat tarihin belli olur olmaz başvuru ülkenin randevu durumuna bak. Güncel bekleme sürelerini Vizesel'de <a href="/ulkeler/">ülke ve merkez bazında</a> takip edebilirsin.</p>
<p>Vize ücreti yetişkinler için 90 avro, 6 ile 12 yaş arası çocuklar için en fazla 45 avro. 6 yaşından küçük çocuklardan vize ücreti alınmıyor. Başvuru merkezleri bunun üstüne ayrıca hizmet bedeli alıyor.</p>
<p>Aklında olsun: Başvuru için bir acenteye ya da aracıya ihtiyacın yok. AB'nin Türkiye'deki resmî sayfası, bu hizmetleri kullanmanın vize alma şansını artırmadığını ve sadece bir randevu alman gerektiğini açıkça yazıyor.</p>
<p>Bu adımda en sık yapılan hatalar şunlar:</p>
<ul>
<li><strong>Şehir sayısına bakmak.</strong> Belirleyici olan şehir sayısı değil, ülkede geçirdiğin gece sayısı.</li>
<li><strong>Aktarma ülkesine başvurmak.</strong> Viyana'da uçak değiştirmek seni Avusturya'ya başvurmak zorunda bırakmaz.</li>
<li><strong>Randevu yok diye başka ülkeye geçmek.</strong> Ana ülken Almanya ise Almanya'ya başvurman gerekir. Randevu bulamıyorsan rotanı gerçekten değiştirmen ve otelini, uçuşunu buna göre ayarlaman gerekir.</li>
<li><strong>Vizeyi aldıktan sonra rotayı tamamen değiştirmek.</strong> Sınırda doğru bilgi vermen gerekiyor ve kurallara uymayanların vizesi iptal edilebiliyor.</li>
<li><strong>Rotaya Schengen dışı ülke eklemek.</strong> İngiltere, İrlanda ya da Kıbrıs Cumhuriyeti için ayrı vize gerekir.</li>
</ul>
<h2>Bu adımda yapacakların</h2>
<ul class="kontrol">
<li>Rotanı gün gün kâğıda dök: Hangi gece hangi şehirdesin?</li>
<li>Rotandaki bütün ülkelerin Schengen'de olduğunu kontrol et.</li>
<li>Seyahatin tek bir ülkedeki bir sebebe bağlı mı, karar ver.</li>
<li>Değilse her ülkedeki gece sayısını topla.</li>
<li>Geceler eşitse Schengen'e ilk gireceğin ülkeyi yaz.</li>
<li>Başvuru ülkeni belirle ve randevu bekleme süresine bak.</li>
<li>Seyahat tarihine göre başvuru aralığını hesapla: En erken 6 ay, en geç 15 gün önce.</li>
</ul>
<h2>Sıradaki bölüm</h2>
<p>Başvuru ülkeni belirledin. Sırada o ülkenin randevusunu bulmak var. <strong>Bölüm 2: Vize randevusu nasıl alınır, ne kadar beklenir?</strong> yazısında hangi ülkenin hangi başvuru merkeziyle çalıştığını, şehrinin hangi konsolosluğa bağlı olduğunu ve randevu bulma şansını nasıl artıracağını anlatıyoruz. Almanya ya da Danimarka'ya başvuracaksan randevu adımlarını şimdiden okuyabilirsin: <a href="/ulkeler/almanya/vize/randevu-nasil-alinir/">Almanya vize randevusu</a>, <a href="/ulkeler/danimarka/vize/randevu-nasil-alinir/">Danimarka vize randevusu</a>.</p>
<h3>Serinin bölümleri</h3>
<ol class="seri-liste">
<li class="bu">Schengen vizesi için hangi ülkeye başvurmalıyım? (bu yazı)</li>
<li>Vize randevusu nasıl alınır, ne kadar beklenir?</li>
<li>Hangi belgeyi nereden alacaksın?</li>
<li>Banka hesabı ve masrafları kim karşılayacak?</li>
<li>Bilet ve otel almadan başvuru yapılır mı?</li>
<li>Seyahat sağlık sigortası nasıl yapılır?</li>
<li>Vize dilekçesi nasıl yazılır?</li>
<li>Başvuru günü merkezde neler oluyor?</li>
<li>Başvurudan sonra bekleme ve pasaport takibi</li>
<li>Vize çıktı, etiketteki bilgiler ne anlama geliyor?</li>
<li>Vize reddedilirse ne yapmalı?</li>
</ol>
HTML,
            'sources' => [
                ['AB Türkiye Delegasyonu, Schengen vizesi rehberi', 'https://www.eeas.europa.eu/delegations/turkiye/vize_tr'],
                ['EUR-Lex, Vize Kodu özeti', 'https://eur-lex.europa.eu/EN/legal-content/summary/visa-code.html'],
                ['AB Konseyi, Schengen bölgesi', 'https://www.consilium.europa.eu/policies/schengen-area/'],
                ['Euronews, Türklerin Schengen tercihi ve ret oranları (2025 verileri)', 'https://tr.euronews.com/my-europe/2026/08/29/turklerin-schengen-tercihi-en-cok-basvurulan-ulkeler-ve-ret-oranlari'],
                ['Rudaw, Yunanistan başvuru ve ret sayıları', 'https://rudaw.net/turkish/categories/world/959750'],
                ['Karar, 2025 başvuru sayısı ve Malta ret oranı', 'https://www.karar.com/guncel-haberler/turklerin-schengen-basvurulari-2025te-yuzde-8-artti-2050840'],
                ['Euronews, Yunanistan kapı vizesini bir yıl uzattı', 'https://tr.euronews.com/travel/2026/03/31/yunanistan-turklere-yonelik-kapida-vize-programini-1-yil-daha-uzatti'],
            ],
        ],
        'atama-maili-geldi-ne-yapmali' => [
            'title' => 'Atama maili geldi: Randevu gününe kadar ne yapmalı?',
            'desc'  => 'Aylarca beklenen mail geldiğinde randevuya bazen yalnız birkaç gün kalır. Bu yazı o birkaç günü sırayla kullanmak için.',
            'kat'   => 'Rehber', 'published' => '2026-11-14', 'updated' => '2026-11-14', 'minutes' => 6,
            'cover' => 'atama', 'cover_alt' => 'Atama maili ve takvim illüstrasyonu', 'cover_credit' => 'İllüstrasyon: Vizesel',
            'country' => 'almanya',
            'summary' => [
                'İlk gün maildeki tarih, saat ve merkezi kontrol et, randevuyu onaylamak için gereken ödemeyi süresi içinde yap.',
                'Belge listesini resmî sayfadan indir, eksikleri işaretle.',
                'Uzun süren belgeleri, yani banka ve iş yeri yazılarını, ilk gün iste.',
            ],
            'body' => <<<'HTML'
<h2>1. Maildeki bilgileri kontrol et ve randevuyu onayla</h2>
<p>Randevu tarihini, saatini ve hangi merkezde olduğunu not al. Alman temsilciliklerinin duyurusuna göre atanan randevuyu onaylamak için iDATA hizmet bedelinin atamadan sonraki 48 saat içinde ödenmesi gerekiyor. Ödenmeyen randevu geçerli olmayabilir. Güncel süre ve tutarı iDATA'nın sitesinden kontrol et.</p>
<h2>2. Belge listesini çıkar</h2>
<p>Schengen başvurularında genelde şu belgeler istenir. Kategoriye göre liste değişir, güncel hâli için Alman temsilciliklerinin ve iDATA'nın sayfalarına bak.</p>
<ul>
<li>Geçerli pasaport ve eski pasaportlar</li>
<li>Biyometrik fotoğraf</li>
<li>Doldurulmuş başvuru formu</li>
<li>Seyahat sağlık sigortası</li>
<li>Banka hesap dökümü</li>
<li>İş yeri ya da okul yazısı</li>
<li>Ziyaret vizesinde davet mektubu</li>
</ul>
<blockquote><p>Hazırlanması en uzun süren belgeleri ilk gün iste. Fotoğraf ve form bir saatte biter, iş yeri yazısının ne zaman geleceğini bilemezsin.</p></blockquote>
<h2>3. Günlere böl</h2>
<dl class="plan">
<div><dt>1. gün</dt><dd>Mail kontrolü, hizmet bedeli ödemesi, belge listesi, banka ve iş yeri yazısı talebi</dd></div>
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
                'desc'  => 'Danimarka turistik vizesinde 17 Kasım 2026\'da duyurulan bekleme listesi: ApplyVisa\'dan randevu gününe kadar süreç, adım adım.',
                'updated' => '2026-11-17',
                'body' => <<<'HTML'
<p>Danimarka'nın Ankara Büyükelçiliği, 17 Kasım 2026'da Türkiye'den yapılan turistik vize başvuruları için geçici bir bekleme listesine geçtiğini duyurdu. Bu sistemde turistik başvuruda önce sıraya giriyor, sıran gelince randevu alıyorsun. Başvurular Türkiye'de yalnızca VFS Global üzerinden alınıyor.</p>
<h2>Kimler listeye giriyor?</h2>
<p>Sadece seyahatinin asıl amacı turizm olanlar. İş seyahati, aile ya da arkadaş ziyareti, kültür ve spor etkinlikleri ile AB vatandaşlarının aile üyeleri listeye girmiyor, bu başvurular eskisi gibi doğrudan VFS randevusuyla ilerliyor.</p>
<p>Listeyi atlamak için farklı bir kategori seçmek işe yaramıyor. Büyükelçilik turistik olduğunu düşündüğü başvuruyu kapatıp turizm kategorisinden yeniden başvurmanı istiyor. Israr edilirse başvuru reddedilebiliyor.</p>
<h2>Adım adım</h2>
<ol>
<li><strong>ApplyVisa'da başvur.</strong> Danimarka Dışişleri Bakanlığının ApplyVisa sitesinde hesap aç, formu doldur ve 90 avro vize ücretini öde.</li>
<li><strong>Makbuzu yazdır.</strong> Ödemeden sonra ön yazı kimlik numarası olan bir makbuz oluşuyor. Bunu yazdırıp imzala, randevu günü lazım olacak.</li>
<li><strong>VFS bekleme listesine kaydol.</strong> Makbuzdaki kimlik numarasıyla VFS Global'in Türkiye sayfasından listeye kaydol ve seyahat amacı olarak turizmi seç.</li>
<li><strong>Bildirim mailini bekle.</strong> Sıran geldiğinde VFS mail atıyor. Mailden sonraki 48 saat içinde devam etmek istediğini VFS'ye bildirip randevu alman gerekiyor.</li>
<li><strong>Randevuya git.</strong> Form, makbuz, orijinal pasaport ve kontrol listesindeki belgelerle, güncel seyahat planın dâhil, merkeze kendin git. VFS kimlik numarasıyla belgelerin uyuştuğunu yerinde kontrol ediyor.</li>
</ol>
<h2>Merkezler</h2>
<p>Danimarka'nın Türkiye'de dört vize başvuru merkezi var: İstanbul, Ankara, İzmir ve Antalya. Hepsini VFS Global işletiyor, kararı Ankara'daki Büyükelçilik veriyor.</p>
<h2>Beklerken bilmen gerekenler</h2>
<ul>
<li>Pasaportun sende kalıyor. Başka seyahatler için kullanabilirsin, randevu günü getirmen yeterli.</li>
<li>Bilet ya da otel için ödeme yapman gerekmiyor. Rezervasyon belgesi istenebilir ama önceden rezervasyon sıranı öne almıyor.</li>
<li>Listeye kaydolmak, randevunun seyahat tarihinden önce geleceği anlamına gelmiyor. Büyükelçilik bekleme süresi için garanti vermiyor, erken kaydolmak en güvenli yol.</li>
<li>Vazgeçersen, başvurun henüz işleme alınmadıysa ApplyVisa'dan iptal edip ücret iadesi isteyebilirsin.</li>
<li>Randevular başvuru sahibine özel bağlanıyor, Büyükelçilik bununla randevuların aracılar tarafından alınıp satılmasını önlemeyi amaçlıyor. Büyükelçilik ayrıca acente kullanılmamasını öneriyor.</li>
</ul>
<h2>Karar ne kadar sürer?</h2>
<p>Büyükelçilik, dosya kendisine ulaştıktan sonra en fazla 15 takvim günü içinde karar vermeyi hedefliyor. Ek inceleme gerekirse ya da dosya Danimarka Göçmenlik Dairesine gönderilirse bu süre 45 güne kadar çıkabiliyor. Süre, VFS'ye teslim ettiğin günden değil, dosyanın Büyükelçiliğe ulaştığı günden sayılıyor.</p>
<h2>Listede ne kadar bekleniyor?</h2>
<p>Liste yeni olduğu için henüz bildiğimiz bir süre yok. Kaydolduysan <a href="/paylas/?ulke=danimarka">kayıt tarihini Vizesel'e ekle</a>, bildirim maili geldiğinde de o tarihi güncelle. Paylaşımlar biriktikçe merkezlere göre bekleme süresini bu sitede gösteriyoruz.</p>
HTML,
            ],
        ],
        'almanya' => [
            'randevu-nasil-alinir' => [
                'title' => 'Almanya vize randevusu nasıl alınır?',
                'desc'  => 'Bekleme listesine kayıttan randevu gününe kadar Almanya Schengen vizesinde randevu süreci, adım adım.',
                'updated' => '2026-11-14',
                'body' => <<<'HTML'
<p>Almanya, Türkiye'deki Schengen vize randevularını iki aşamalı bir sistemle veriyor: Önce bekleme listesine kaydolursun, sonra sıran geldiğinde sana bir randevu tarihi atanır.</p>
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
<li>Onay kutusunu işaretleyip “Ekle” düğmesine bas.</li>
</ol>
<p>Ad, e-posta ya da pasaport bilgisi istemiyoruz. Atama maili geldiğinde aynı tarayıcıdan Paylaş sayfasına dönersen kaydın formda hazır olur, yalnız yeni tarihi ekleyip “Güncelle” düğmesine basman yeterli.</p>
HTML,
        ],
        'kaydimi-silmek-istiyorum' => [
            'title' => 'Kaydımı nasıl silerim?',
            'desc'  => 'Vizesel\'e eklediğin kaydı istediğin zaman silebilirsin. Aynı tarayıcıdan ya da e-postayla.',
            'body' => <<<'HTML'
<p>Kaydını eklediğin tarayıcıdan <a href="/paylas/">Paylaş sayfasına</a> git ve formun altındaki “silebilirsin” bağlantısına iki kez tıkla. Kayıt kalıcı olarak silinir.</p>
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
