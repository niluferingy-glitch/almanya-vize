<div class="narrow" style="padding-top:40px;padding-bottom:96px">
  <?= crumbs_html($crumbs) ?>
  <p class="eyebrow">Yöntem</p>
  <h1 class="h1" style="margin-bottom:20px">Bekleme sürelerini nasıl hesaplıyoruz?</h1>
  <p class="lead" style="margin-bottom:24px">Bu sayfa, Vizesel'deki her sayının nereden geldiğini, hangi verileri dışarıda bıraktığımızı ve tahminlerin nerede yanılabileceğini anlatır.</p>
  <div class="byline-bar" style="margin-bottom:40px"><?= byline_html('2026-11-14') ?></div>
  <div class="prose">
    <h2>Neyi ölçüyoruz?</h2>
    <p>Tek bir aralığı: başvuru sahibinin randevu bekleme listesine kaydolduğu gün ile randevu atama mailinin geldiği gün arasındaki gün sayısı. Randevu sonrası evrak ve sonuç süreleri ayrıca, yalnız bilgi olarak gösterilir.</p>
    <h2>Veri nereden geliyor?</h2>
    <p>Başvuru sahipleri sitedeki formla merkez, kategori, kayıt tarihi ve varsa atama, randevu ve sonuç tarihlerini paylaşır. Konsolosluklar ve randevu sağlayıcıları bekleme süresi yayınlamadığı için resmî bir kaynakla karşılaştırma yapamıyoruz.</p>
    <h2>“Ortalama” derken neyi kastediyoruz?</h2>
    <p>Sitede “ortalama süre” olarak gösterdiğimiz sayı, istatistikte ortanca denen değerdir: kayıtları küçükten büyüğe sıraladığında ortada kalan sayı. Düz ortalama yerine bunu kullanıyoruz, çünkü birkaç hatalı ya da sıra dışı kayıt sonucu kaydırmaz. Örneğin 300, 310, 320, 330 ve 600 günlük beş varsayımsal kaydın düz ortalaması 372 gündür ve tek bir uç kayıt yüzünden kimsenin yaşamadığı bir süreyi gösterir. Sitede bu kayıtlar için 320 gün yazar.</p>
    <h2>Hangi kayıtları dışarıda bırakıyoruz?</h2>
    <ul>
      <li>Kayıt tarihi bugünden sonra olan kayıtlar.</li>
      <li>Atama ya da randevu tarihi, kayıt tarihinden önce olan kayıtlar.</li>
      <li>Kayıttan atamaya 3 yıldan uzun süre geçmiş görünen kayıtlar.</li>
      <li>Randevusu atamadan 1 yıldan daha sonraya verilmiş görünen kayıtlar.</li>
      <li>Aynı bağlantıdan bir günde 3'ten fazla gelen kayıtlar.</li>
    </ul>
    <h2>"Şu an işlenen kayıtlar" ne demek?</h2>
    <p>Bir merkezde ataması gelen en yeni kaydın kayıt ayıdır. Sıranın hangi aya kadar ilerlediğini gösterir. Senin kayıt ayın bundan sonraysa sıran henüz gelmemiştir.</p>
    <h2>Başlangıç tahmini nedir?</h2>
    <p>Site açılırken hiç kullanıcı kaydı yoktu. Boş görünmemesi için Kasım 2026'da kamuya açık yorumlardan merkez bazında toplu sayılar derledik. Bu sayılar kişi bazlı veri içermez ve "başlangıç tahmini" etiketiyle gösterilir. Bir merkezde en az <?= MIN_REAL ?> kullanıcı kaydı birikince o merkezin başlangıç tahmini kaldırılır.</p>
    <h2>Tahmin nerede yanılabilir?</h2>
    <ul>
      <li><strong>Az kayıt:</strong> <?= MIN_REAL ?>'ün altındaki merkezlerde tek bir kayıt sonucu belirler. Bu merkezler "az veri" etiketi taşır.</li>
      <li><strong>Kim paylaşıyor:</strong> Uzun bekleyenler paylaşmaya daha istekli olabilir. Bu, süreleri olduğundan uzun gösterebilir.</li>
      <li><strong>Kural değişiklikleri:</strong> Temsilcilikler kapasite ya da kural değiştirdiğinde geçmiş kayıtlar yeni durumu yansıtmaz.</li>
      <li><strong>Beyan:</strong> Tarihler kullanıcı beyanıdır. Belgeyle doğrulamıyoruz.</li>
    </ul>
    <h2>Hata görürsen</h2>
    <p>Bir sayının yanlış olduğunu düşünüyorsan <a href="/iletisim/">bize yaz</a>. Düzeltmeleri aşağıdaki değişiklik günlüğüne tarihleriyle ekliyoruz.</p>
  </div>
  <section style="border-top:1px solid var(--line);padding-top:32px;margin-top:24px">
    <h2 style="font-size:var(--fs-3);font-weight:600;margin-bottom:16px">Değişiklik günlüğü</h2>
    <dl style="margin:0;display:grid;grid-template-columns:140px 1fr;gap:10px 20px;color:var(--body);font-size:var(--fs-2)">
      <dt class="muted">17 Kasım 2026</dt><dd style="margin:0">Danimarka eklendi. Büyükelçiliğin aynı gün duyurduğu turistik vize bekleme listesi takip ediliyor, başlangıç tahmini yok.</dd>
      <dt class="muted">14 Kasım 2026</dt><dd style="margin:0">Site açıldı. Almanya için başlangıç tahmini eklendi.</dd>
    </dl>
  </section>
</div>
