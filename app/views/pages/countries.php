<div class="narrow" style="padding-top:40px;padding-bottom:80px">
  <?= crumbs_html($crumbs) ?>
  <h1 class="h1" style="margin-bottom:16px">Ülkeler</h1>
  <p class="lead" style="margin-bottom:40px">Vize randevu bekleme sürelerini ülke ülke topluyoruz. Bir ülkede yeterli paylaşım birikince sayfası açılıyor.</p>
  <ul class="rows">
    <?php foreach (countries() as $slug => $c): ?>
      <li>
        <?php if ($c['active']): $r = array_values(array_filter(country_table($slug, 'turistik'), fn($x) => $x['med'] !== null)); ?>
          <div><a href="/ulkeler/<?= h($slug) ?>/vize/" style="font-size:var(--fs-4)" class="serif"><?= h($c['name']) ?></a><p class="small muted"><?= count($c['centers']) ?> başvuru merkezi</p></div>
          <p class="small"><?= $r ? 'Turistik: ' . $r[0]['med'] . ' ile ' . end($r)['med'] . ' gün' : '' ?></p>
        <?php else: ?>
          <div><span class="serif" style="font-size:var(--fs-4);color:var(--muted)"><?= h($c['name']) ?></span><p class="small muted">Yakında</p></div>
        <?php endif; ?>
      </li>
    <?php endforeach; ?>
  </ul>
  <p class="note" style="margin-top:24px">Başka bir ülke için bekleme tarihlerini paylaşmak istersen <a href="/iletisim/">bize yaz</a>, öncelik sırasını buna göre belirliyoruz.</p>
</div>
