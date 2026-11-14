<?php $c = countries()[$preCountry]; ?>
<div class="narrow" style="padding-top:40px;padding-bottom:96px">
  <?= crumbs_html($crumbs) ?>
  <h1 class="h1" style="margin-bottom:16px">Tarihlerini paylaş</h1>
  <p class="lead" style="margin-bottom:32px">Bir dakika sürer. Ad, e-posta ya da pasaport bilgisi istemiyoruz. Paylaşımın bir sonraki başvuranın tahminini netleştirir.</p>
  <form id="share" class="share-form box" novalidate>
    <input type="hidden" name="country" value="<?= h($preCountry) ?>">
    <label class="field">Merkez<select name="center" required>
      <?php foreach ($c['centers'] as $slug => $cc): ?><option value="<?= h($slug) ?>"<?= $slug === $preCenter ? ' selected' : '' ?>><?= h($cc['name']) ?></option><?php endforeach; ?>
    </select></label>
    <label class="field">Kategori<select name="cat" required><?php foreach (CATS as $k => $v): ?><option value="<?= h($k) ?>"><?= h($v) ?></option><?php endforeach; ?></select></label>
    <label class="field">Bekleme listesine kayıt tarihi<input type="date" name="kayit" required max="<?= today() ?>"></label>
    <label class="field">Atama maili tarihi <span class="opt">(geldiyse)</span><input type="date" name="atama" max="<?= today() ?>"></label>
    <label class="field">Randevu tarihi <span class="opt">(varsa)</span><input type="date" name="randevu"></label>
    <label class="field">Sonuç <span class="opt">(varsa)</span><select name="sonuc"><option value="">Henüz yok</option><option value="onay">Vize verildi</option><option value="ret">Ret</option></select></label>
    <label class="field">Takma ad <span class="opt">(isteğe bağlı)</span><input type="text" name="u" maxlength="24" placeholder="anonim" autocomplete="off"></label>
    <div class="hp" aria-hidden="true"><label>Web sitesi<input type="text" name="web" tabindex="-1" autocomplete="off"></label></div>
    <label class="field full">Kısa not <span class="opt">(isteğe bağlı, kontrol edildikten sonra yayınlanır)</span><textarea name="text" maxlength="280" placeholder="Örn: 6 ay multi verildi, evrakları 4 günde topladım"></textarea></label>
    <label class="consent full"><input type="checkbox" name="consent" required><span>Girdiğim tarihlerin anonim olarak yayınlanmasını ve bekleme süresi istatistiklerinde kullanılmasını kabul ediyorum. <a href="/gizlilik/">Aydınlatma metni</a></span></label>
    <div class="full">
      <button class="btn" type="submit" id="share-btn">Ekle</button>
      <p class="msg" id="share-msg" role="status" aria-live="polite"></p>
      <p class="note">Her kişinin bir kaydı olur. Atama gelince bu sayfaya aynı tarayıcıdan dönüp tarihini güncelleyebilirsin. Bu tarayıcıdan eklediğin kaydı <a href="#" id="share-del">silebilirsin</a>.</p>
    </div>
  </form>
</div>
