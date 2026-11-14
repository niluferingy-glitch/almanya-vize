<div class="narrow" style="padding-top:40px;padding-bottom:64px">
  <?= crumbs_html($crumbs) ?>
  <p class="eyebrow"><?= h($c['name']) ?> rehberi</p>
  <h1 class="h1" style="margin-bottom:16px"><?= h($g['title']) ?></h1>
  <p class="lead" style="margin-bottom:24px"><?= h($g['desc']) ?></p>
  <div class="byline-bar" style="margin-bottom:40px"><?= byline_html($g['updated']) ?></div>
  <div class="prose"><?= $g['body'] ?></div>
  <div class="box box-accent" style="margin:40px 0">
    <p style="font-weight:600;margin-bottom:6px">Randevun ne zaman gelir?</p>
    <p class="serif" style="color:var(--body);margin-bottom:14px">Merkezine göre güncel bekleme süresine bak.</p>
    <a class="btn" href="/ulkeler/<?= h($country) ?>/vize/">Bekleme süreleri</a>
  </div>
  <h2 class="h2" style="font-size:var(--fs-5);margin-bottom:12px">Kaynaklar</h2>
  <?= sources_html(sources_almanya()) ?>
</div>
