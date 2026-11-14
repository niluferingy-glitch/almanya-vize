<?php $base = '/ulkeler/' . $country . '/vize/'; $entries = public_entries($country, $center, 20); ?>
<div class="wrap" style="padding-top:40px"><?= crumbs_html($crumbs) ?></div>
<div class="wrap doc">
  <aside class="doc-aside" aria-label="Diğer merkezler">
    <details open><summary><?= h($c['name']) ?> merkezleri</summary>
    <ol>
      <?php foreach ($c['centers'] as $slug => $cc): ?>
        <li><a href="<?= h($base . $slug . '/') ?>"<?= $slug === $center ? ' aria-current="page" style="color:var(--accent);font-weight:600"' : '' ?>><?= h($cc['name']) ?></a></li>
      <?php endforeach; ?>
    </ol>
    </details>
  </aside>

  <article class="doc-main">
    <p class="eyebrow"><?= h($c['name']) ?> vizesi, <?= h($c['provider'] ?? '') ?> başvuru merkezi</p>
    <h1 class="h1" style="margin-bottom:20px"><?= h($cname) ?> <?= h($c['name']) ?> vize randevusu ne zaman gelir?</h1>
    <div class="byline-bar"><?= byline_html(today()) ?></div>

    <section aria-labelledby="ozet-h" style="margin-top:32px">
      <h2 id="ozet-h" class="sr">Kategorilere göre bekleme süresi</h2>
      <?php $catRows = []; foreach (CATS as $k => $v) { if ($stats[$k]) $catRows[] = $stats[$k]; } ?>
      <ol class="ledger ledger-big">
        <?php foreach (CATS as $k => $v): $st = $stats[$k] ?: ['med' => null, 'n' => 0, 'approx' => false, 'frontier' => null, 'waiting' => 0, 'seed' => false]; ?>
          <?= ledger_row($v, null, $st, ledger_meta($st) ?: 'henüz paylaşım yok') ?>
        <?php endforeach; ?>
      </ol>
      <?= ledger_notes($catRows) ?>
      <p class="note">Süre, bekleme listesine kaydolduğun günden randevu atama mailine kadar geçen ortanca zamandır. <a href="/yontem/">Nasıl hesaplıyoruz?</a></p>
    </section>

    <section id="hesapla" aria-labelledby="hesapla-h">
      <h2 id="hesapla-h" class="h2" style="margin-bottom:20px">Atamam ne zaman gelir?</h2>
      <?= calc_html($country, $center, 'turistik') ?>
    </section>

    <section aria-labelledby="karsi-h">
      <h2 id="karsi-h" class="h2">Diğer merkezlerle karşılaştırma</h2>
      <p class="sub">Turistik vize, <?= h($c['name']) ?> merkezleri.</p>
      <?= center_table_html($country, 'turistik') ?>
    </section>

    <section aria-labelledby="pay-h">
      <div class="section-head"><h2 id="pay-h" class="h2"><?= h($cname) ?> paylaşımları</h2><a href="/paylas/?ulke=<?= h($country) ?>&amp;merkez=<?= h($center) ?>">Tarihlerini ekle</a></div>
      <?= entries_html($entries, false) ?>
    </section>

    <section class="cta" aria-labelledby="ekle-h">
      <h2 id="ekle-h" class="h2" style="font-size:26px;margin-bottom:8px">Bu merkezden mi başvurdun?</h2>
      <p class="serif" style="font-size:17px;color:var(--body);margin-bottom:20px">Tarihlerini paylaşırsan bu merkezin tahmini netleşir. Bir dakika sürer, ad veya e-posta istemez.</p>
      <a class="btn" href="/paylas/?ulke=<?= h($country) ?>&amp;merkez=<?= h($center) ?>">Tarihlerini paylaş</a>
    </section>

    <section aria-labelledby="ilgili-h">
      <h2 id="ilgili-h" class="h2" style="font-size:24px;margin-bottom:12px">İlgili sayfalar</h2>
      <ul class="sources">
        <li><a href="<?= h($base) ?>"><?= h($c['name']) ?> vize bekleme süreleri, tüm merkezler</a></li>
        <li><a href="<?= h($base) ?>randevu-nasil-alinir/"><?= h($c['name']) ?> vize randevusu nasıl alınır?</a></li>
        <?php foreach (posts() as $ps => $p): if (($p['country'] ?? '') !== $country) continue; ?>
          <li><a href="/seyahatname/<?= h($ps) ?>/"><?= h($p['title']) ?></a></li>
        <?php endforeach; ?>
      </ul>
    </section>
  </article>
</div>
