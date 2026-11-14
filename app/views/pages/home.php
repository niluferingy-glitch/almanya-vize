<?php $c = countries()[$country]; $last = last_assignment($country); ?>
<section class="hero">
  <h1 class="h1">Vize randevun ne zaman gelir?</h1>
  <p class="lead">Başvuru sahiplerinin paylaştığı tarihlerden hesaplanan güncel bekleme süreleri.</p>
  <form class="searchbar" data-calc data-country="<?= h($country) ?>" onsubmit="return false" aria-label="Bekleme süresi hesapla">
    <label><span>Ülke</span><select name="country" aria-label="Ülke"><option value="almanya">Almanya</option></select></label>
    <label><span>Merkez</span><select name="center">
      <?php foreach ($c['centers'] as $slug => $cc): ?><option value="<?= h($slug) ?>"><?= h($cc['name']) ?></option><?php endforeach; ?>
    </select></label>
    <label><span>Kategori</span><select name="cat"><?php foreach (CATS_SHORT as $k => $v): ?><option value="<?= h($k) ?>"><?= h($v) ?></option><?php endforeach; ?></select></label>
    <label><span>Kayıt tarihin</span><input type="date" name="kayit" max="<?= today() ?>"></label>
    <button class="btn" type="submit">Hesapla</button>
  </form>
  <div class="calc-result" role="status" aria-live="polite" data-calc-out hidden></div>
  <script type="application/json" id="calc-data"><?= json_encode(['country' => $country, 'data' => calc_data($country), 'today' => today()], JSON_UNESCAPED_UNICODE) ?></script>
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
  <p class="serif muted" style="font-size:17px;margin-bottom:24px;max-width:680px">Almanya turistik vize. Süre, bekleme listesine kaydolduğun günden randevu atama mailine kadar geçen zamandır.</p>
  <?= center_table_html($country, 'turistik', false) ?>
  <p class="note">Başlangıç tahmini: Kasım 2026'da kamuya açık yorumlardan anonim olarak derlendi. Bir merkezde <?= MIN_REAL ?> kullanıcı kaydı birikince yerini gerçek veriye bırakır.</p>
</section>

<section class="section section-paper">
  <div class="wrap">
    <h2 class="h2" style="margin-bottom:36px">Vizesel nasıl çalışır?</h2>
    <div class="steps3">
      <div><p class="num">1</p><h3>Tarihlerini paylaşırsın</h3><p>Merkez, kategori ve bekleme listesine kaydolduğun günü girersin. Ad, e-posta ya da pasaport bilgisi istemeyiz.</p></div>
      <div><p class="num">2</p><h3>Ortanca süre hesaplanır</h3><p>Ataması gelen kayıtların ortanca değerini kullanırız. Uç değerler sonucu bozmaz. <a href="/yontem/">Yöntemi oku</a></p></div>
      <div><p class="num">3</p><h3>Herkes her gün günceli görür</h3><p>Yeni bir atama geldiğinde süreler aynı gün değişir. Hangi ayın kayıtlarının işlendiği de görünür.</p></div>
    </div>
    <a class="btn btn-line" style="margin-top:40px" href="/paylas/">Kendi tarihlerini ekle</a>
  </div>
</section>

<?php $ps = posts(); if ($ps): ?>
<section class="wrap section" aria-labelledby="seyahatname">
  <div class="section-head"><h2 id="seyahatname" class="h2">Seyahatname'den</h2><a href="/seyahatname/">Tüm yazılar</a></div>
  <?= post_list_html(array_slice($ps, 0, 3, true), 'h3') ?>
</section>
<?php endif; ?>

<section class="wrap" style="padding-bottom:72px">
  <div class="trust">
    <div><svg aria-hidden="true" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#1C1B19" stroke-width="1.6" stroke-linecap="round"><circle cx="12" cy="12" r="9"/><path d="M12 8v4M12 16h.01"/></svg><p><strong>Resmî bir kurum değiliz.</strong> Konsolosluk ya da randevu şirketiyle bağımız yok.</p></div>
    <div><svg aria-hidden="true" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#1C1B19" stroke-width="1.6" stroke-linecap="round"><rect x="5" y="11" width="14" height="9" rx="2"/><path d="M8 11V8a4 4 0 0 1 8 0v3"/></svg><p><strong>Kişisel veri toplamayız.</strong> Paylaşımlar anonimdir, istediğin an silebilirsin.</p></div>
    <div><svg aria-hidden="true" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#1C1B19" stroke-width="1.6" stroke-linecap="round"><path d="M4 5h16v14H4z"/><path d="M8 9h8M8 13h5"/></svg><p><strong>Yöntemimiz açık.</strong> Hangi veriyi nasıl hesapladığımızı <a href="/yontem/">yazıyla anlatıyoruz</a>.</p></div>
  </div>
</section>
