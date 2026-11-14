<?php $ps = posts(); $fslug = array_key_first($ps); $f = $ps[$fslug] ?? null; $rest = array_slice($ps, 1, null, true); $a = author(); ?>
<div class="wrap" style="padding-top:40px;padding-bottom:80px">
  <?= crumbs_html($crumbs) ?>
  <h1 class="sr">Seyahatname</h1>
  <?php if ($f): ?>
  <article style="margin-bottom:56px">
    <a class="cover" href="/seyahatname/<?= h($fslug) ?>/" style="display:block;margin-bottom:28px" tabindex="-1" aria-hidden="true"><?= cover_img($f, '(max-width: 760px) 100vw, 1072px', false, '') ?></a>
    <div style="max-width:760px">
      <p class="eyebrow">Öne çıkan · <?= h($f['kat']) ?></p>
      <h2 class="h1" style="margin-bottom:14px"><a href="/seyahatname/<?= h($fslug) ?>/" style="color:var(--ink)"><?= h($f['title']) ?></a></h2>
      <p class="lead" style="color:var(--body);margin-bottom:16px"><?= h($f['desc']) ?></p>
      <p class="byline"><img src="<?= h($a['avatar']) ?>" alt="" width="28" height="28" style="width:28px;height:28px"><?= h($a['name']) ?> · <time datetime="<?= h($f['published']) ?>"><?= h(tr_date($f['published'])) ?></time> · <?= (int)$f['minutes'] ?> dk okuma</p>
    </div>
  </article>
  <?php endif; ?>
  <div class="doc" style="border-top:1px solid var(--line);padding-top:16px">
    <div class="doc-main" style="max-width:720px">
      <?php if ($rest): ?><h2 class="small muted" style="font-weight:600;text-transform:uppercase;letter-spacing:.06em;margin:16px 0 8px">Son yazılar</h2><?= post_list_html($rest, 'h3') ?>
      <?php else: ?><p class="serif muted" style="font-size:17px;margin-top:24px">Yeni yazılar hazırlanıyor. Vize, pasaport ve seyahat hazırlığı üzerine yazılar burada yayınlanacak.</p><?php endif; ?>
    </div>
    <aside class="doc-aside" style="max-width:300px;border:0;padding:0">
      <p>Seyahatname nedir?</p>
      <p class="serif" style="font-weight:400;color:var(--body);font-size:16px;margin-bottom:10px">Vize, pasaport ve seyahat hazırlığı üzerine sade, kaynaklı ve tarihli yazılar.</p>
      <a href="/hakkinda/#ilkeler" style="font-weight:600">Yayın ilkelerimiz</a>
      <div class="box box-accent" style="margin-top:32px">
        <p style="margin-bottom:6px">Randevun ne zaman gelir?</p>
        <p class="serif" style="font-weight:400;color:var(--body);margin-bottom:14px">Merkezine göre güncel bekleme süresine bak.</p>
        <a class="btn" href="/ulkeler/almanya/vize/" style="min-height:44px">Süreleri gör</a>
      </div>
    </aside>
  </div>
</div>
