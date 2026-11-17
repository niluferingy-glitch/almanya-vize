<?php $base = '/ulkeler/' . $country . '/vize/'; $entries = public_entries($country, null, 10); $cats = country_cats($country); $steps = steps($country); $atamaLabel = $c['atama_text'] ?? 'randevu atama maili'; ?>
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
      <p><?= h($c['name']) ?> turistik vize için randevu ataması şu an <strong><?= months_text($fast['med']) ?> ile <?= months_text($slow['med']) ?> ay</strong> arasında geliyor. En hızlı merkez <?= h($fast['name']) ?> (<?= $fast['med'] ?> gün), en yavaşı <?= h($slow['name']) ?> (<?= $slow['approx'] ? 'yaklaşık ' : '' ?><?= $slow['med'] ?> gün).<?= count($cats) > 1 ? ' Aile ziyareti kategorisi genelde turistikten daha kısa sürüyor.' : '' ?></p>
      <?php elseif (!empty($c['list_since'])): ?>
      <p><?= h($c['name']) ?> turistik vize için bekleme listesi <strong><?= h(tr_date($c['list_since'])) ?></strong> tarihinde başladı. Liste yeni olduğu için henüz bekleme süresi hesaplayacak kadar paylaşım yok. Kaydolduysan <a href="/paylas/?ulke=<?= h($country) ?>">kayıt tarihini ekle</a>, <?= h($atamaLabel) ?> geldiğinde güncelle. Paylaşımlar biriktikçe merkezlere göre süreler burada görünecek.</p>
      <?php else: ?><p>Henüz yeterli veri yok.</p><?php endif; ?>
    </section>

    <section id="sureler" aria-labelledby="sureler-h">
      <h2 id="sureler-h" class="h2">Merkezlere göre süreler</h2>
      <p class="sub">Bekleme listesine kaydolduğun günden <?= h($atamaLabel) ?>ne kadar geçen ortalama süre<?= count($cats) === 1 ? ', ' . h(mb_strtolower(reset($cats))) . ' vize' : '' ?>. Merkez adına tıklayarak ayrıntılarını görebilirsin.</p>
      <?php if (count($cats) > 1): ?>
      <div class="tabs" role="tablist" aria-label="Kategori">
        <?php $i = 0; foreach ($cats as $k => $v): ?>
          <button type="button" role="tab" id="tab-<?= $k ?>" aria-controls="panel-<?= $k ?>" aria-selected="<?= $i === 0 ? 'true' : 'false' ?>"><?= h($v) ?></button>
        <?php $i++; endforeach; ?>
      </div>
      <?php $i = 0; foreach ($cats as $k => $v): ?>
        <div role="tabpanel" id="panel-<?= $k ?>" aria-labelledby="tab-<?= $k ?>"<?= $i ? ' hidden' : '' ?>><?= center_table_html($country, $k) ?></div>
      <?php $i++; endforeach; ?>
      <?php else: ?>
        <?= center_table_html($country, array_key_first($cats)) ?>
      <?php endif; ?>
      <p class="note"><a href="/yontem/">Bu sayıları nasıl hesaplıyoruz?</a></p>
    </section>

    <section id="hesapla" aria-labelledby="hesapla-h">
      <h2 id="hesapla-h" class="h2" style="margin-bottom:20px">Atamam ne zaman gelir?</h2>
      <?= calc_html($country) ?>
    </section>

    <section id="surec" aria-labelledby="surec-h">
      <h2 id="surec-h" class="h2">Süreç adım adım</h2>
      <p class="sub"><?= h($steps['intro']) ?> Ayrıntılı anlatım: <a href="<?= h($base) ?>randevu-nasil-alinir/"><?= h($c['name']) ?> vize randevusu nasıl alınır?</a></p>
      <ol class="timeline">
        <?php foreach ($steps['items'] as $i => [$st, $sd]): ?>
        <li><div class="dot"><span><?= $i + 1 ?></span><i></i></div><div><h3><?= h($st) ?></h3><p><?= h($sd) ?></p></div></li>
        <?php endforeach; ?>
      </ol>
    </section>

    <section id="sss" aria-labelledby="sss-h">
      <h2 id="sss-h" class="h2" style="margin-bottom:16px">Sık sorulanlar</h2>
      <?= faq_html(faq($country)) ?>
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
      <?= sources_html(array_merge(sources($country), [['Vizesel yöntem ve veri temizleme kuralları', '/yontem/']])) ?>
    </section>
  </article>
</div>
