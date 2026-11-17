<?php $c = countries()[$country]; $last = last_assignment($country); ?>
<section class="hero">
  <h1 class="h1">Vize randevun ne zaman gelir?</h1>
  <p class="lead">Başvuru sahiplerinin paylaştığı tarihlerden hesaplanan güncel bekleme süreleri.</p>
  <form class="searchbar" data-calc data-country="<?= h($country) ?>" aria-label="Bekleme süresi hesapla">
    <label><span>Ülke</span><select name="country" aria-label="Ülke"><option value="almanya">Almanya</option></select></label>
    <label><span>Merkez</span><select name="center">
      <?php foreach ($c['centers'] as $slug => $cc): ?><option value="<?= h($slug) ?>"><?= h($cc['name']) ?></option><?php endforeach; ?>
    </select></label>
    <label><span>Kategori</span><select name="cat"><?php foreach (CATS_SHORT as $k => $v): ?><option value="<?= h($k) ?>"><?= h($v) ?></option><?php endforeach; ?></select></label>
    <label><span>Kayıt tarihin</span><input type="date" name="kayit" max="<?= today() ?>"></label>
    <button class="btn" type="submit">Hesapla</button>
  </form>
  <div class="calc-result" role="status" aria-live="polite" data-calc-out hidden></div>
  <script type="application/json" id="calc-data"><?= json_script(['country' => $country, 'data' => calc_data($country), 'today' => today()]) ?></script>
  <p class="small muted" style="margin-top:16px">Son güncelleme: <?= h(tr_date(today())) ?><?= $last ? ' · Son gelen atama: ' . h(tr_date($last)) : '' ?> · <a href="/yontem/">Nasıl hesaplıyoruz?</a></p>
  <div class="chips">
    <?php foreach (countries() as $slug => $cc): ?>
      <?php if ($cc['active']): ?><a class="chip on" href="/ulkeler/<?= h($slug) ?>/vize/"><?= h($cc['name']) ?></a>
      <?php else: ?><span class="chip"><?= h($cc['name']) ?> · yakında</span><?php endif; ?>
    <?php endforeach; ?>
  </div>
</section>

<section class="wrap" style="padding-bottom:72px" aria-labelledby="bugun">
  <div class="section-head">
    <h2 id="bugun" class="h2">Bugünkü bekleme süreleri</h2>
    <a href="/ulkeler/almanya/vize/">Tüm merkezler ve kategoriler</a>
  </div>
  <p class="serif muted" style="font-size:var(--fs-3);margin-bottom:24px;max-width:680px">Almanya turistik vize. Süre, bekleme listesine kaydolduğun günden randevu atama mailine kadar geçen zamandır.</p>
  <?= center_table_html($country, 'turistik') ?>
</section>

<section class="section section-paper">
  <div class="narrow">
    <h2 class="h2" style="margin-bottom:20px">Vizesel nasıl çalışır?</h2>
    <ol class="prose prose-steps">
      <li>Bekleme listesine kaydolduğun günü, merkezini ve kategorini paylaşırsın. Ad, e-posta ya da pasaport bilgisi istemeyiz.</li>
      <li>Ataması gelen kayıtlardan ortalama bekleme süresini çıkarırız. Birkaç uç kayıt sonucu bozmasın diye ortanca değeri kullanırız. <a href="/yontem/">Yöntemi oku</a></li>
      <li>Yeni bir atama geldiğinde süreler aynı gün değişir. Hangi ayın kayıtlarının işlendiği de görünür.</li>
    </ol>
    <a class="btn btn-line" style="margin-top:8px" href="/paylas/">Kendi tarihlerini ekle</a>
  </div>
</section>

<?php $ps = posts(); if ($ps): ?>
<section class="wrap section" aria-labelledby="seyahatname">
  <div class="section-head"><h2 id="seyahatname" class="h2">Seyahatname'den</h2><a href="/seyahatname/">Tüm yazılar</a></div>
  <?= post_list_html(array_slice($ps, 0, 3, true), 'h3') ?>
</section>
<?php endif; ?>

<section class="narrow" style="padding-bottom:72px">
  <p class="colophon">Vizesel resmî bir kurum değildir; konsolosluk ya da randevu şirketleriyle bağı yoktur. Kişisel veri toplamaz, paylaşımlar anonimdir ve istediğin an silinebilir. Sayıların nasıl hesaplandığı <a href="/yontem/">yöntem sayfasında</a> açıkça yazılıdır.</p>
</section>
