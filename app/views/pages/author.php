<div class="narrow" style="padding-top:40px;padding-bottom:80px">
  <?= crumbs_html($crumbs) ?>
  <div style="display:flex;gap:28px;align-items:flex-start;flex-wrap:wrap;margin-bottom:40px">
    <img src="<?= h($a['portrait']) ?>" alt="<?= h($a['name']) ?>" width="160" height="200" style="width:160px;height:200px;border-radius:12px;object-fit:cover">
    <div style="flex:1 1 320px">
      <p class="eyebrow"><?= h($a['role']) ?></p>
      <h1 class="h1" style="margin-bottom:12px"><?= h($a['name']) ?></h1>
      <p class="serif" style="font-size:19px;line-height:1.6;color:var(--body)"><?= h($a['bio']) ?></p>
    </div>
  </div>
  <h2 class="h2" style="font-size:24px;margin-bottom:12px">Yazıları ve sayfaları</h2>
  <ul class="sources">
    <?php foreach (posts() as $ps => $p): ?><li><a href="/seyahatname/<?= h($ps) ?>/"><?= h($p['title']) ?></a></li><?php endforeach; ?>
    <?php foreach (guides() as $cs => $gs) foreach ($gs as $gslug => $g): ?><li><a href="/ulkeler/<?= h($cs) ?>/vize/<?= h($gslug) ?>/"><?= h($g['title']) ?></a></li><?php endforeach; ?>
    <li><a href="/ulkeler/almanya/vize/">Almanya vize randevu bekleme süreleri</a></li>
    <li><a href="/yontem/">Bekleme sürelerini nasıl hesaplıyoruz?</a></li>
  </ul>
</div>
