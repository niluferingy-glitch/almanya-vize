<div class="narrow" style="padding-top:40px;padding-bottom:80px">
  <?= crumbs_html($crumbs) ?>
  <h1 class="h1" style="margin-bottom:16px">Yardım merkezi</h1>
  <p class="lead" style="margin-bottom:40px">Vizesel'i kullanmakla ilgili kısa cevaplar.</p>
  <ul class="rows">
    <?php foreach (help_pages() as $slug => $hp): ?>
      <li><div><a href="/yardim/<?= h($slug) ?>/" class="serif" style="font-size:20px"><?= h($hp['title']) ?></a><p class="small muted"><?= h($hp['desc']) ?></p></div></li>
    <?php endforeach; ?>
  </ul>
  <div class="box box-paper" style="margin-top:40px"><p style="font-weight:600;margin-bottom:6px">Cevabını bulamadın mı?</p><p class="serif" style="color:var(--body)"><a href="/iletisim/">Bize yaz</a>, genelde birkaç gün içinde dönüyoruz. Vize başvurusu hakkında resmî sorular için Alman temsilciliklerine ve iDATA'ya başvurman gerekir.</p></div>
</div>
