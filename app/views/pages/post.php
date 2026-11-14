<article>
  <header class="article-head">
    <?= crumbs_html([['Seyahatname', '/seyahatname/'], [$p['kat'], '/seyahatname/']]) ?>
    <h1 class="h1" style="margin-bottom:16px"><?= h($p['title']) ?></h1>
    <p class="lead" style="margin-bottom:32px"><?= h($p['desc']) ?></p>
    <div class="byline byline-bar">
      <img src="<?= h($a['avatar']) ?>" alt="" width="44" height="44" style="width:44px;height:44px">
      <div><p><a href="<?= h($a['url']) ?>"><strong><?= h($a['name']) ?></strong></a></p>
      <p>Yayın <time datetime="<?= h($p['published']) ?>"><?= h(tr_date($p['published'])) ?></time> · Güncelleme <time datetime="<?= h($p['updated']) ?>"><?= h(tr_date($p['updated'])) ?></time> · <?= (int)$p['minutes'] ?> dk okuma</p></div>
    </div>
  </header>
  <figure class="article-cover">
    <div class="cover"><?= cover_img($p, '(max-width: 760px) 100vw, 1072px', false) ?></div>
    <figcaption><?= h($p['cover_credit']) ?></figcaption>
  </figure>
  <div class="article-body">
    <aside class="summary" aria-label="Kısaca"><p>Kısaca</p><ul><?php foreach ($p['summary'] as $s): ?><li><?= h($s) ?></li><?php endforeach; ?></ul></aside>
    <div class="prose"><?= $p['body'] ?></div>
    <section style="padding-top:24px;border-top:1px solid var(--line);font-size:var(--fs-2)">
      <h2 style="font-size:var(--fs-2);font-weight:600;margin-bottom:10px">Kaynaklar</h2>
      <?= sources_html($p['sources']) ?>
    </section>
    <div class="author-box" style="margin-top:40px">
      <img src="<?= h($a['avatar']) ?>" alt="" width="64" height="64" loading="lazy">
      <div class="ab-text"><p class="small muted">Yazan</p><p style="font-size:var(--fs-4);font-weight:600;margin-bottom:8px"><?= h($a['name']) ?></p>
      <p class="serif" style="color:var(--body);margin-bottom:10px"><?= h($a['short']) ?></p><a href="<?= h($a['url']) ?>" style="font-size:var(--fs-2);font-weight:600">Yazar hakkında</a></div>
    </div>
  </div>
</article>
<?php $others = array_filter(posts(), fn($k) => $k !== $pslug, ARRAY_FILTER_USE_KEY); if ($others): ?>
<section style="border-top:1px solid var(--line)"><div class="wrap section"><h2 class="h2" style="font-size:var(--fs-5);margin-bottom:12px">Seyahatname'den başka yazılar</h2><?= post_list_html(array_slice($others, 0, 3, true), 'h3') ?></div></section>
<?php endif; ?>
