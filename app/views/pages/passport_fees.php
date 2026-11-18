<?php
/** @var array $fees @var array $cur @var array $crumbs @var int $ten @var int $six @var string $title */
$f27 = $fees[2027];
$rows = [[6, '6 ay', 0.5], [12, '1 yıl', 1], [24, '2 yıl', 2], [36, '3 yıl', 3], [37, '4 ile 10 yıl', 10]];
$types = passport_types();
$calcData = ['fees' => $fees, 'types' => $types];
?>
<link rel="stylesheet" href="/assets/css/pasaport.css?v=20261118">
<div class="wrap" style="padding-top:40px"><?= crumbs_html($crumbs) ?></div>
<div class="wrap doc">
  <aside class="doc-aside" aria-label="Bu sayfada">
    <details open><summary>Bu sayfada</summary>
    <ol>
      <li><a href="#kisa-cevap">Kısa cevap</a></li>
      <li><a href="#hesapla">Ücret hesaplama</a></li>
      <li><a href="#tablo">2026 ücret tablosu</a></li>
      <li><a href="#sure">Hangi süreyi seçmeli?</a></li>
      <li><a href="#muafiyet">Kimler harç ödemez?</a></li>
      <li><a href="#cikis-harci">Yurt dışı çıkış harcı</a></li>
      <li><a href="#odeme">Nasıl ödenir?</a></li>
      <li><a href="#ucretler-2027">2027'de ne kadar olacak?</a></li>
      <li><a href="#basvuru">Randevu ve başvuru</a></li>
      <li><a href="#teslim">Teslim ve kayıp pasaport</a></li>
      <li><a href="#resmi">Resmî sayfalar</a></li>
      <li><a href="#sss">Sık sorulanlar</a></li>
      <li><a href="#kaynaklar">Kaynaklar</a></li>
    </ol>
    </details>
  </aside>

  <article class="doc-main">
    <p class="eyebrow">Pasaport</p>
    <h1 class="h1" style="margin-bottom:20px"><?= h($title) ?></h1>
    <div class="byline-bar"><?= byline_html(PASAPORT_UPDATED, 'Tutarlar NVİ ve Resmî Gazete\'ye göre') ?></div>

    <section id="kisa-cevap" class="answer" aria-labelledby="kisa-h">
      <h2 id="kisa-h" class="sr">Kısa cevap</h2>
      <p>Bordo pasaportun 10 yıllığı 2026'da <strong><?= tl($ten) ?></strong>: <?= tl($cur['harc'][37]) ?> harç ve <?= tl($cur['defter'], false) ?> defter bedeli. En kısa süreli olan 6 aylık pasaport <?= tl($six) ?>. 25 yaşını doldurmamış öğrenciler ile yeşil ve gri pasaport alanlar harç ödemez, yalnız <?= tl($cur['defter'], false) ?> defter bedeli öder.</p>
    </section>

    <section id="hesapla" aria-labelledby="hesapla-h">
      <h2 id="hesapla-h" class="h2">Pasaport ücreti hesaplama</h2>
      <p class="sub">Türü, süreyi ve kişi sayısını seç. Kişi başı seyahat sayısını girersen yurt dışı çıkış harcı da toplama eklenir.</p>
      <form class="pp-form" data-pp>
        <fieldset class="pp-year">
          <legend class="sr">Ücret yılı</legend>
          <label><input type="radio" name="yil" value="2026" checked><span>2026 ücretleri</span></label>
          <label><input type="radio" name="yil" value="2027"><span>2027 tahmini</span></label>
        </fieldset>
        <div class="pp-grid">
          <label class="field">Pasaport türü<select name="tur">
            <?php foreach ($types as $k => $t): ?><option value="<?= h($k) ?>"><?= h($t['label']) ?></option><?php endforeach; ?>
          </select></label>
          <label class="field">Süre<select name="sure">
            <?php foreach (passport_durations() as $m => $label): ?><option value="<?= $m ?>"<?= $m === 120 ? ' selected' : '' ?>><?= h($label) ?></option><?php endforeach; ?>
          </select></label>
          <label class="field">Kişi sayısı<input type="number" name="kisi" value="1" min="1" max="20" inputmode="numeric"></label>
          <label class="field">Seyahat sayısı<input type="number" name="cikis" value="0" min="0" max="50" inputmode="numeric"></label>
        </div>
      </form>
      <div class="pp-out" role="status" aria-live="polite" data-pp-out>
        <div class="pp-total">
          <p class="small" data-o="label">Ödeyeceğin toplam</p>
          <p class="big" data-o="total"><?= tl($ten) ?></p>
          <p class="small" data-o="peryear">Yıl başına <?= tl(intdiv($ten, 10)) ?></p>
        </div>
        <dl class="pp-lines">
          <div><dt data-o="harc-l">Pasaport harcı</dt><dd data-o="harc"><?= tl($cur['harc'][37]) ?></dd></div>
          <div><dt data-o="defter-l">Defter bedeli</dt><dd data-o="defter"><?= tl($cur['defter']) ?></dd></div>
          <div data-o="cikis-row" hidden><dt data-o="cikis-l">Yurt dışı çıkış harcı</dt><dd data-o="cikis"></dd></div>
        </dl>
        <p class="pp-note" data-o="note">Harç ve defter bedeli iki ayrı ödemedir. Başvurudan önce ikisini de ödemiş olman gerekir.</p>
      </div>
      <script type="application/json" id="pp-data"><?= json_encode($calcData, JSON_UNESCAPED_UNICODE) ?></script>
    </section>

    <section id="tablo" aria-labelledby="tablo-h">
      <h2 id="tablo-h" class="h2">2026 pasaport ücretleri tablosu</h2>
      <p class="sub">Bordo (umuma mahsus) pasaport için 1 Ocak 2026'dan beri geçerli tutarlar. Son sütun, pasaportun yıllık maliyetini gösterir.</p>
      <div class="table-box">
        <table class="data pp-table">
          <thead><tr><th scope="col">Süre</th><th scope="col" class="pp-hm">Harç</th><th scope="col" class="pp-hm">Defter bedeli</th><th scope="col">Toplam</th><th scope="col">Yıl başına</th></tr></thead>
          <tbody>
          <?php foreach ($rows as [$k, $label, $years]): $t = $cur['harc'][$k] + $cur['defter']; ?>
            <tr><th scope="row"><?= h($label) ?></th><td class="pp-hm"><?= tl($cur['harc'][$k]) ?></td><td class="pp-hm"><?= tl($cur['defter']) ?></td><td class="num"><?= tl($t) ?></td><td><?= tl((int)round($t / $years)) ?><?= $k === 37 ? ' <span class="muted small">(10 yıl)</span>' : '' ?></td></tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <p class="note">Tutarlar <a href="https://randevu.nvi.gov.tr/pages/applicationprices" rel="noopener" target="_blank">NVİ başvuru ücretleri tablosu</a> ile aynıdır. Harçlar her yıl yeniden değerleme oranıyla artırılır. 2026'da oran %25,49 olarak açıklandı, pasaport harçlarına Cumhurbaşkanı kararıyla %18,95 artış uygulandı.</p>
    </section>

    <section id="sure" aria-labelledby="sure-h">
      <h2 id="sure-h" class="h2">Hangi süreyi seçmeli?</h2>
      <div class="prose">
        <p>3 yıldan uzun her süre için aynı harç ödenir. 4 yıllık ile 10 yıllık pasaport aynı fiyattır, bu yüzden 3 yıldan uzun bir pasaport alacaksan 10 yılı seç.</p>
        <p>10 yıllık pasaport, 3 yıllıktan <?= tl($cur['harc'][37] - $cur['harc'][36]) ?> daha pahalı ama 7 yıl daha uzun geçerli. Yıl başına maliyeti <?= tl((int)round($ten / 10)) ?> ile tablodaki en düşük tutardır. Kısa süreli pasaport, yalnız kısa süre sonra yeniden başvuracağını biliyorsan mantıklıdır.</p>
        <p>Vize başvurusu yapacaksan süreyi dar tutma. Schengen vizesi için pasaportun son 10 yıl içinde verilmiş olması ve Schengen bölgesinden çıkış tarihinden sonra en az 3 ay daha geçerli olması gerekir.</p>
      </div>
    </section>

    <section id="muafiyet" aria-labelledby="muaf-h">
      <h2 id="muaf-h" class="h2">Kimler harç ödemez?</h2>
      <div class="prose">
        <p><a href="https://www.gib.gov.tr/node/81016" rel="noopener" target="_blank">492 sayılı Harçlar Kanunu'nun 85. maddesine</a> göre şu pasaportlardan harç alınmaz:</p>
        <ul>
          <li>Diplomatik, hususi (yeşil) ve hizmet (gri) pasaportlar.</li>
          <li>Öğrenim görmekte olup 25 yaşını doldurmamış olanlara verilen pasaportlar. Okula giden çocuklar da öğrenci belgesiyle bu kapsama girer.</li>
          <li>Yalnızca öğrenim için yurt dışına gidenlere, yurt dışındaki öğrenimleri bitene kadar verilen pasaportlar.</li>
        </ul>
        <p>Muafiyet yalnız harcı kapsar. Defter bedeli (2026'da <?= tl($cur['defter'], false) ?>) herkesten alınır. Harçsız öğrenci pasaportu için randevuda "Umuma Mahsus Pasaport (Bordo)" seçilir, başvuruda güncel öğrenci belgesi verilir. <a href="https://www.turkiye.gov.tr" rel="noopener" target="_blank">e-Devlet</a>'ten alınan barkodlu belge kabul edilir. 18 yaşından küçüklere harçsız pasaport en fazla 5 yıllık verilir. Harçsız pasaportta süre ücreti değiştirmez, izin verilen en uzun süreyi iste.</p>
      </div>
    </section>

    <section id="cikis-harci" aria-labelledby="cikis-h">
      <h2 id="cikis-h" class="h2">Yurt dışı çıkış harcı</h2>
      <div class="prose">
        <p>Yurt dışı çıkış harcı pasaport ücretinden ayrıdır ve her çıkışta kişi başı ödenir. 1 Ocak 2026'dan beri tutarı <strong><?= tl($cur['cikis'], false) ?></strong>. Pasaport harcından muaf olan öğrenciler de çıkış harcı öder.</p>
        <p>Harcı yurt dışına çıkmadan önce <a href="https://dijital.gib.gov.tr" rel="noopener" target="_blank">Dijital Vergi Dairesi</a>'nden, GİB Mobil uygulamasından, anlaşmalı bankaların internet ve mobil şubelerinden ya da PTT ve vergi dairelerinden ödeyebilirsin. Ayrıntılar GİB'in <a href="https://gib.gov.tr/sites/default/files/fileadmin/beyannamerehberi/2025/2025_yurtdisicikisharci.pdf" rel="noopener" target="_blank">yurt dışına çıkış harcı rehberinde</a>.</p>
        <p>Çıkış harcı alınmayanlar: 7 yaşını doldurmamış çocuklar, çıkış tarihinde yurt dışında oturma izni bulunanlar, Kuzey Kıbrıs Türk Cumhuriyeti'ne kimlik belgesiyle çıkanlar ve pasavanla çıkanlar.</p>
        <p>Hesaplama aracında "Seyahat sayısı" alanına kişi başı seyahat sayısını yazarsan çıkış harcı toplama eklenir. Grupta 7 yaşından küçük çocuk varsa onları kişi sayısından düşerek ayrıca hesapla.</p>
      </div>
    </section>

    <section id="odeme" aria-labelledby="odeme-h">
      <h2 id="odeme-h" class="h2">Pasaport ücreti nasıl ödenir?</h2>
      <ol class="timeline">
        <li><div class="dot"><span>1</span><i></i></div><div><h3>Harcı öde</h3><p><a href="https://dijital.gib.gov.tr" rel="noopener" target="_blank">Dijital Vergi Dairesi</a>'ne gir. Üye girişi yapmadan "Hızlı Ödemeler" bölümündeki pasaport harcı seçeneğini aç, T.C. kimlik numaranı ve pasaport süresini gir, kartla öde. İstersen e-Devlet şifrenle giriş yapıp aynı ödemeyi oradan da yapabilirsin.</p></div></li>
        <li><div class="dot"><span>2</span><i></i></div><div><h3>Defter bedelini ayrıca öde</h3><p>Defter bedeli (değerli kâğıt bedeli) aynı menüde ayrı bir seçenektir. Harçsız pasaport alacaksan yalnız bunu ödersin.</p></div></li>
        <li><div class="dot"><span>3</span><i></i></div><div><h3>Dekontu sakla</h3><p>Ödeme kimlik numarana işlenir ve nüfus müdürlüğü sistemden görür. Yine de dekontu randevuya kadar sakla.</p></div></li>
      </ol>
      <p class="note">İnternet dışında GİB Mobil uygulaması, anlaşmalı bankaların şube, internet ve mobil kanalları, PTT şubeleri ve vergi daireleri de bu ödemeleri alır. Ödeme yapıp başvurmazsan ödediğin tutarı vergi dairesinden geri isteyebilirsin.</p>
    </section>

    <section id="ucretler-2027" aria-labelledby="y27-h">
      <h2 id="y27-h" class="h2">2027'de pasaport ücretleri ne kadar olacak?</h2>
      <p class="sub">2027 yeniden değerleme oranı 3 Kasım 2026'da %<?= number_format($f27['oran'], 2, ',', '') ?> olarak açıklandı. Oran tam uygulanırsa tutarlar yaklaşık şöyle olur:</p>
      <div class="table-box">
        <table class="data pp-table">
          <thead><tr><th scope="col">Kalem</th><th scope="col">2026</th><th scope="col">2027 tahmini</th><th scope="col" class="pp-hm">Fark</th></tr></thead>
          <tbody>
          <?php foreach ($rows as [$k, $label]): ?>
            <tr><th scope="row"><?= h($label) ?> harcı</th><td><?= tl($cur['harc'][$k]) ?></td><td class="num"><?= tl($f27['harc'][$k]) ?></td><td class="pp-hm"><?= tl($f27['harc'][$k] - $cur['harc'][$k]) ?></td></tr>
          <?php endforeach; ?>
            <tr><th scope="row">Defter bedeli</th><td><?= tl($cur['defter']) ?></td><td class="num"><?= tl($f27['defter']) ?></td><td class="pp-hm"><?= tl($f27['defter'] - $cur['defter']) ?></td></tr>
            <tr><th scope="row">Yurt dışı çıkış harcı</th><td><?= tl($cur['cikis']) ?></td><td class="num"><?= tl($f27['cikis']) ?></td><td class="pp-hm"><?= tl($f27['cikis'] - $cur['cikis']) ?></td></tr>
          </tbody>
        </table>
      </div>
      <div class="prose" style="margin-top:24px">
        <p>Bunlar kesin tutar değil. 2026'da Cumhurbaşkanı, pasaport harçlarında açıklanan oranın altında bir artış uyguladı; 2027'de de benzer bir karar çıkabilir. Kesin tutarlar Aralık sonunda Resmî Gazete'de yayımlanır, tutarlar yayımlandığında bu sayfa güncellenir.</p>
        <p>Pasaportu 2026 ücretiyle almak istiyorsan ödemeyi de başvuruyu da Aralık bitmeden tamamla. Aralıkta ödeyip ocakta başvuranlardan yeni yılın farkı istenebilir.</p>
      </div>
    </section>

    <section id="basvuru" aria-labelledby="basvuru-h">
      <h2 id="basvuru-h" class="h2">Randevu ve başvuru</h2>
      <div class="prose">
        <p>Pasaport başvurusu il ve ilçe nüfus müdürlüklerine randevuyla yapılır. Randevuyu <a href="https://randevu.nvi.gov.tr" rel="noopener" target="_blank">randevu.nvi.gov.tr</a>, NVİ Mobil uygulaması, e-Devlet ya da ALO 199 üzerinden alabilirsin.</p>
        <p>Randevuya kimlik kartın, son 6 ay içinde çekilmiş biyometrik fotoğrafın ve varsa eski pasaportunla git. Harçsız başvuruda öğrenci belgesini de ekle. 18 yaşından küçükler için anne ve babanın birlikte başvurması ya da muvafakatname gerekir.</p>
      </div>
    </section>

    <section id="teslim" aria-labelledby="teslim-h">
      <h2 id="teslim-h" class="h2">Teslim ve kayıp pasaport</h2>
      <div class="prose">
        <p>Başvurudan sonra pasaportun basılır ve PTT ile başvuruda verdiğin adrese gönderilir. Pasaportun hangi aşamada olduğunu <a href="https://www.turkiye.gov.tr" rel="noopener" target="_blank">e-Devlet</a>'teki pasaport başvuru durumu sorgulama hizmetinden ya da ALO 199'dan öğrenebilirsin.</p>
        <p>Pasaportunu kaybettiysen ya da çaldırdıysan önce kayıp bildirimi yap. Bildirim yapılan pasaport bulunsa bile bir daha kullanılamaz. Yeni pasaport için ilk başvurudaki gibi süre seçilir ve aynı harç ile defter bedeli ödenir.</p>
      </div>
    </section>

    <section id="resmi" aria-labelledby="resmi-h">
      <h2 id="resmi-h" class="h2">Resmî sayfalar</h2>
      <p class="sub">Ödeme ve randevu için kullanacağın kurum sayfaları:</p>
      <ul class="sources">
        <li><a href="https://dijital.gib.gov.tr" rel="noopener" target="_blank">Dijital Vergi Dairesi</a>: pasaport harcı, defter bedeli ve yurt dışı çıkış harcı ödemesi (GİB)</li>
        <li><a href="https://randevu.nvi.gov.tr" rel="noopener" target="_blank">NVİ randevu sistemi</a>: pasaport randevusu (Nüfus ve Vatandaşlık İşleri)</li>
        <li><a href="https://randevu.nvi.gov.tr/pages/applicationprices" rel="noopener" target="_blank">NVİ başvuru ücretleri</a>: pasaport, kimlik ve ehliyet ücret tablosu</li>
        <li><a href="https://gib.gov.tr/sites/default/files/fileadmin/beyannamerehberi/2025/2025_yurtdisicikisharci.pdf" rel="noopener" target="_blank">GİB yurt dışına çıkış harcı rehberi</a>: kimlerin ödeyeceği, muafiyetler, ödeme kanalları</li>
        <li><a href="https://www.gib.gov.tr/node/81016" rel="noopener" target="_blank">Harçlar Kanunu, madde 85</a>: harçtan muaf pasaportlar (GİB)</li>
        <li><a href="https://www.turkiye.gov.tr" rel="noopener" target="_blank">e-Devlet</a>: randevu, öğrenci belgesi ve başvuru durumu</li>
      </ul>
    </section>

    <section id="sss" aria-labelledby="sss-h">
      <h2 id="sss-h" class="h2" style="margin-bottom:16px">Sık sorulanlar</h2>
      <?= faq_html(faq_pasaport()) ?>
    </section>

    <section class="cta" aria-labelledby="vize-h">
      <h2 id="vize-h" class="h2" style="font-size:var(--fs-5);margin-bottom:8px">Pasaportun hazırsa sıradaki adım vize</h2>
      <p class="serif" style="font-size:var(--fs-3);color:var(--body);margin-bottom:20px">Ülkelere ve merkezlere göre güncel vize randevu bekleme sürelerine bak.</p>
      <a class="btn" href="/ulkeler/">Bekleme süreleri</a>
    </section>

    <section id="kaynaklar" aria-labelledby="kay-h">
      <h2 id="kay-h" class="h2" style="font-size:var(--fs-5);margin-bottom:12px">Kaynaklar</h2>
      <?= sources_html(sources_pasaport()) ?>
    </section>
  </article>
</div>
<script src="/assets/js/pasaport.js?v=20261118" defer></script>
