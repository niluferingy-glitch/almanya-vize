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
    <p class="eyebrow"><?= h($c['name']) ?> · <?= h($c['provider'] ?? '') ?> başvuru merkezi</p>
    <h1 class="h1" style="margin-bottom:20px"><?= h($cname) ?> <?= h($c['name']) ?> vize randevusu ne zaman gelir?</h1>
    <div class="byline-bar"><?= byline_html(today()) ?></div>

    <section aria-labelledby="ozet-h" style="margin-top:32px">
      <h2 id="ozet-h" class="sr">Kategorilere göre bekleme süresi</h2>
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px">
        <?php foreach (CATS as $k => $v): $s = $stats[$k]; ?>
          <div class="box">
            <p class="small" style="font-weight:600;margin-bottom:6px"><?= h($v) ?></p>
            <?php if ($s && $s['med'] !== null): ?>
              <p class="serif" style="font-size:36px;line-height:1.1;color:var(--ink)"><?= $s['approx'] ? '≈ ' : '' ?><?= $s['med'] ?> <span style="font-size:18px" class="muted">gün</span></p>
              <p class="small muted" style="margin-top:4px">yaklaşık <?= months_text($s['med']) ?> ay</p>
              <?php if ($s['frontier']): ?><p class="small" style="margin-top:12px;padding-top:10px;border-top:1px dashed var(--line)">Şu an işlenen: <strong><?= h(tr_month($s['frontier'])) ?></strong></p><?php endif; ?>
              <p class="small muted" style="margin-top:6px"><?= stat_note($s) ?><?= $s['waiting'] ? ' · ' . $s['waiting'] . ' bekleyen' : '' ?></p>
            <?php elseif ($s): ?>
              <p class="small muted">Henüz ataması gelen paylaşım yok<?= $s['waiting'] ? ', ' . $s['waiting'] . ' kişi bekliyor' : '' ?>.</p>
            <?php else: ?>
              <p class="small muted">Henüz paylaşım yok.</p>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
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

    <section class="box" aria-labelledby="ekle-h">
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
