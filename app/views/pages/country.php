<?php $base = '/ulkeler/' . $country . '/vize/'; $rows = array_values(array_filter(country_table($country, 'turistik'), fn($x) => $x['med'] !== null)); ?>
<div class="narrow" style="padding-top:40px;padding-bottom:80px">
  <?= crumbs_html($crumbs) ?>
  <p class="eyebrow">Schengen vizesi</p>
  <h1 class="h1" style="margin-bottom:16px"><?= h($c['name']) ?> vizesi ve seyahat rehberi</h1>
  <p class="lead" style="margin-bottom:40px"><?= h($c['name']) ?> vizesi için randevu bekleme süreleri ve başvuru rehberleri.</p>

  <a class="box" href="<?= h($base) ?>" style="display:block;color:inherit;text-decoration:none;margin-bottom:16px">
    <p class="small" style="font-weight:600;color:var(--accent);margin-bottom:6px">Vize bekleme süreleri</p>
    <p class="serif" style="font-size:var(--fs-5);margin-bottom:6px"><?= $rows ? 'Turistik vize: ' . $rows[0]['med'] . ' ile ' . end($rows)['med'] . ' gün' : 'Merkezlere göre süreler' ?></p>
    <p class="small muted"><?= count($c['centers']) ?> merkez · her gün güncellenir</p>
  </a>

  <h2 class="h2" style="font-size:var(--fs-5);margin:40px 0 12px">Merkezler</h2>
  <ul class="rows">
    <?php foreach ($c['centers'] as $slug => $cc): $s = center_stat($country, $slug, 'turistik'); ?>
      <li><a href="<?= h($base . $slug . '/') ?>"><?= h($cc['name']) ?></a><span class="small muted"><?= $s && $s['med'] !== null ? 'Turistik ' . ($s['approx'] ? '≈ ' : '') . $s['med'] . ' gün' : 'veri toplanıyor' ?></span></li>
    <?php endforeach; ?>
  </ul>

  <h2 class="h2" style="font-size:var(--fs-5);margin:40px 0 12px">Rehberler</h2>
  <ul class="sources">
    <?php foreach (guides()[$country] ?? [] as $gs => $g): ?><li><a href="<?= h($base . $gs . '/') ?>"><?= h($g['title']) ?></a></li><?php endforeach; ?>
    <?php foreach (posts() as $ps => $p): if (($p['country'] ?? '') !== $country) continue; ?><li><a href="/seyahatname/<?= h($ps) ?>/"><?= h($p['title']) ?></a></li><?php endforeach; ?>
  </ul>
</div>
