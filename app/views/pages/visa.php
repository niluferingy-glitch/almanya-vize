<?php $base = '/ulkeler/' . $country . '/vize/'; $entries = public_entries($country, null, 10); ?>
<div class="wrap" style="padding-top:40px"><?= crumbs_html($crumbs) ?></div>
<div class="wrap doc">
  <aside class="doc-aside" aria-label="Bu sayfada">
    <details open><summary>Bu sayfada</summary>
    <ol>
      <li><a href="#kisa-cevap">Kısa cevap</a></li>
      <li><a href="#sureler">Merkezlere göre süreler</a></li>
      <li><a href="#hesapla">Atamam ne zaman gelir?</a></li>
      <li><a href="#surec">Süreç adım adım</a></li>
      <li><a href="#sss">Sık sorulanlar</a></li>
      <li><a href="#paylasimlar">Paylaşımlar</a></li>
      <li><a href="#kaynaklar">Kaynaklar</a></li>
    </ol>
    </details>
  </aside>

  <article class="doc-main">
    <p class="eyebrow">Schengen vizesi, <?= h($c['name']) ?></p>
    <h1 class="h1" style="margin-bottom:20px"><?= h($c['name']) ?> vize randevu bekleme süreleri</h1>
    <div class="byline-bar"><?= byline_html(today(), count(all_entries($country)) . ' kullanıcı kaydı') ?></div>

    <section id="kisa-cevap" class="answer" aria-labelledby="kisa-h">
      <h2 id="kisa-h" class="sr">Kısa cevap</h2>
      <?php if ($fast && $slow): ?>
      <p><?= h($c['name']) ?> turistik vize için randevu ataması şu an <strong><?= months_text($fast['med']) ?> ile <?= months_text($slow['med']) ?> ay</strong> arasında geliyor. En hızlı merkez <?= h($fast['name']) ?> (<?= $fast['med'] ?> gün), en yavaşı <?= h($slow['name']) ?> (<?= $slow['approx'] ? 'yaklaşık ' : '' ?><?= $slow['med'] ?> gün). Aile ziyareti kategorisi genelde turistikten daha kısa sürüyor.</p>
      <?php else: ?><p>Henüz yeterli veri yok.</p><?php endif; ?>
    </section>

    <section id="sureler" aria-labelledby="sureler-h">
      <h2 id="sureler-h" class="h2">Merkezlere göre süreler</h2>
      <p class="sub">Bekleme listesine kaydolduğun günden randevu atama mailine kadar geçen ortalama süre. Merkez adına tıklayarak ayrıntılarını görebilirsin.</p>
      <div class="tabs" role="tablist" aria-label="Kategori">
        <?php $i = 0; foreach (CATS as $k => $v): ?>
          <button type="button" role="tab" id="tab-<?= $k ?>" aria-controls="panel-<?= $k ?>" aria-selected="<?= $i === 0 ? 'true' : 'false' ?>"><?= h($v) ?></button>
        <?php $i++; endforeach; ?>
      </div>
      <?php $i = 0; foreach (CATS as $k => $v): ?>
        <div role="tabpanel" id="panel-<?= $k ?>" aria-labelledby="tab-<?= $k ?>"<?= $i ? ' hidden' : '' ?>><?= center_table_html($country, $k) ?></div>
      <?php $i++; endforeach; ?>
      <p class="note"><a href="/yontem/">Bu sayıları nasıl hesaplıyoruz?</a></p>
    </section>

    <section id="hesapla" aria-labelledby="hesapla-h">
      <h2 id="hesapla-h" class="h2" style="margin-bottom:20px">Atamam ne zaman gelir?</h2>
      <?= calc_html($country) ?>
    </section>

    <section id="surec" aria-labelledby="surec-h">
      <h2 id="surec-h" class="h2">Süreç adım adım</h2>
      <p class="sub">Ara süreler, kullanıcıların paylaştığı tarihlerden derlenmiştir. Ayrıntılı anlatım: <a href="<?= h($base) ?>randevu-nasil-alinir/">Almanya vize randevusu nasıl alınır?</a></p>
      <ol class="timeline">
        <li><div class="dot"><span>1</span><i></i></div><div><h3>Bekleme listesine kayıt</h3><p>iDATA'nın sitesinden ücretsiz olarak sıraya girersin. Bekleme bu günden başlar.</p></div></li>
        <li><div class="dot"><span>2</span><i></i></div><div><h3>Randevu atama maili</h3><p>Sıran geldiğinde randevu tarihi bildirilir. Bu sayfadaki süreler bu ana kadar geçen zamanı ölçer.</p></div></li>
        <li><div class="dot"><span>3</span><i></i></div><div><h3>Randevu ve evrak teslimi</h3><p>Paylaşımlarda randevu, atama mailinden 3 ile 15 gün sonraya veriliyor. Randevuyu onaylamak için hizmet bedelinin kısa sürede ödenmesi gerekiyor.</p></div></li>
        <li><div class="dot"><span>4</span><i></i></div><div><h3>Sonuç ve pasaport</h3><p>Paylaşımlara göre sonuç, evrak tesliminden 2 ile 4 hafta sonra geliyor.</p></div></li>
      </ol>
    </section>

    <section id="sss" aria-labelledby="sss-h">
      <h2 id="sss-h" class="h2" style="margin-bottom:16px">Sık sorulanlar</h2>
      <?= faq_html(faq_almanya()) ?>
    </section>

    <section id="paylasimlar" aria-labelledby="pay-h">
      <div class="section-head"><h2 id="pay-h" class="h2">Paylaşımlar</h2><a href="/paylas/?ulke=<?= h($country) ?>">Tarihlerini ekle</a></div>
      <?= entries_html($entries) ?>
    </section>

    <section class="cta" aria-labelledby="ekle-h">
      <h2 id="ekle-h" class="h2" style="font-size:var(--fs-5);margin-bottom:8px">Tarihlerini paylaş</h2>
      <p class="serif" style="font-size:var(--fs-3);color:var(--body);margin-bottom:20px">Bir dakika sürer, ad veya e-posta istemez. Paylaşımın bir sonraki başvuranın tahminini netleştirir.</p>
      <a class="btn" href="/paylas/?ulke=<?= h($country) ?>">Formu aç</a>
    </section>

    <section id="kaynaklar" aria-labelledby="kay-h">
      <h2 id="kay-h" class="h2" style="font-size:var(--fs-5);margin-bottom:12px">Kaynaklar</h2>
      <?= sources_html(array_merge(sources_almanya(), [['Vizesel yöntem ve veri temizleme kuralları', '/yontem/']])) ?>
    </section>
  </article>
</div>
