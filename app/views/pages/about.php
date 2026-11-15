<?php $a = author(); ?>
<div class="narrow" style="padding-top:40px;padding-bottom:96px">
  <?= crumbs_html($crumbs) ?>
  <p class="eyebrow">Bağımsız bir başvuru defteri</p>
  <h1 class="h1" style="margin-bottom:24px">Vizesel hakkında</h1>
  <p class="lead" style="margin-bottom:48px">Vizesel, vize randevusu bekleyen insanların kendi tarihlerini paylaşarak birbirine yol gösterdiği bağımsız bir sitedir.</p>
  <div class="prose">
    <h2 style="margin-top:0">Neden var?</h2>
    <blockquote><p>Almanya vizesi için başvururken ne kadar bekleyeceğimi öğrenmek istedim. Bu bilgi hiçbir resmî sayfada yoktu. Sosyal medyadaki yorumları tek tek okuyup merkez merkez hesapladım. Vizesel, o hesabı herkes için her gün yapan sayfa.</p></blockquote>
    <p class="small muted" style="font-family:var(--sans);margin-top:-12px"><?= h($a['name']) ?>, kurucu</p>
    <p>Randevu bekleme süreleri hiçbir yerde resmî olarak yayınlanmıyor. Başvuranlar bu bilgiyi sosyal medya yorumlarından tek tek toplamaya çalışıyor. Vizesel bu dağınık bilgiyi tek yerde, açık bir yöntemle ve her gün güncel tutmak için kuruldu.</p>
    <h2>Kim hazırlıyor?</h2>
  </div>
  <div class="box" style="display:flex;gap:24px;align-items:flex-start;flex-wrap:wrap;margin-bottom:40px">
    <img src="<?= h($a['portrait']) ?>" alt="<?= h($a['name']) ?>" width="160" height="200" style="width:160px;height:200px;border-radius:12px;object-fit:cover">
    <div style="flex:1 1 300px">
      <p style="font-size:var(--fs-4);font-weight:600"><a href="<?= h($a['url']) ?>" style="color:var(--ink)"><?= h($a['name']) ?></a></p>
      <p class="small muted" style="margin-bottom:12px"><?= h($a['role']) ?> · <?= h($a['city']) ?></p>
      <p class="serif" style="font-size:var(--fs-3);color:var(--body)"><?= h($a['bio']) ?></p>
    </div>
  </div>
  <div class="prose">
    <h2>Bağımsızlık</h2>
    <p>Vizesel hiçbir konsolosluk, büyükelçilik, randevu şirketi ya da vize danışmanlık firmasıyla bağlantılı değildir. Kimseden randevu almak için ücret istemeyiz, randevu satmayız. Site şu an reklamsız ve ücretsizdir. İleride reklam ya da iş birliği olursa burada açıkça yazılacak ve içerikten ayrı işaretlenecektir.</p>
    <h2 id="ilkeler">Yayın ilkelerimiz</h2>
    <ul>
      <li>Her sayının yanında kaç kayda dayandığını gösteririz.</li>
      <li>Resmî kurallar hakkında yazarken kaynağa bağlantı veririz.</li>
      <li>Yazıların üstünde son güncelleme tarihini tutarız.</li>
      <li>Hataları sessizce değil, <a href="/yontem/">değişiklik günlüğünde</a> düzeltiriz.</li>
    </ul>
    <h2>İletişim</h2>
    <p>Düzeltme, öneri ya da kayıt silme talebi için: <a href="mailto:<?= h(cfg('contact_email')) ?>"><?= h(cfg('contact_email')) ?></a></p>
  </div>
</div>
