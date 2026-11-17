<?php
/** @var string $body @var array $meta */
$canonical = $meta['canonical'] ?? null;
$schemas = array_merge([schema_site()], $meta['schema']);
$v = '20261117a';
?><!doctype html>
<html lang="tr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= h($meta['title']) ?></title>
<meta name="description" content="<?= h($meta['desc']) ?>">
<meta name="robots" content="<?= h($meta['robots']) ?>,max-image-preview:large">
<?php if ($canonical && str_starts_with($meta['robots'], 'index')): ?><link rel="canonical" href="<?= h(url($canonical)) ?>">
<?php endif; ?>
<meta property="og:site_name" content="Vizesel">
<meta property="og:locale" content="tr_TR">
<meta property="og:type" content="<?= h($meta['og_type']) ?>">
<meta property="og:title" content="<?= h($meta['og_title'] ?? $meta['title']) ?>">
<meta property="og:description" content="<?= h($meta['desc']) ?>">
<?php if ($canonical): ?><meta property="og:url" content="<?= h(url($canonical)) ?>">
<?php endif; ?>
<meta property="og:image" content="<?= h(url($meta['og_image'])) ?>">
<meta name="twitter:card" content="summary_large_image">
<link rel="preload" href="/assets/fonts/literata-latin-wght-normal.woff2" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="/assets/fonts/inter-latin-wght-normal.woff2" as="font" type="font/woff2" crossorigin>
<link rel="stylesheet" href="/assets/css/site.css?v=<?= $v ?>">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="icon" href="/favicon-32.png" sizes="32x32" type="image/png">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">
<link rel="alternate" type="application/rss+xml" title="Seyahatname" href="/seyahatname/rss.xml">
<?php foreach ($schemas as $s): ?>
<script type="application/ld+json"><?= json_encode($s, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?></script>
<?php endforeach; ?>
</head>
<body>
<a class="skip" href="#icerik">İçeriğe geç</a>
<header class="site-header">
  <div class="wrap header-in">
    <a class="logo" href="/" aria-label="Vizesel ana sayfa">vizesel<span>.</span></a>
    <nav class="main-nav" aria-label="Ana menü">
      <?php foreach (nav_items() as $n): if (!$n['on']) continue; ?>
        <a href="<?= h($n['href']) ?>"<?= $meta['nav'] === $n['key'] ? ' aria-current="page"' : '' ?>><?= h($n['label']) ?></a>
      <?php endforeach; ?>
    </nav>
    <button class="menu-btn" type="button" aria-expanded="false" aria-controls="mobil-menu" aria-label="Menüyü aç">
      <svg aria-hidden="true" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
    </button>
  </div>
  <div class="mobile-menu" id="mobil-menu" hidden>
    <nav aria-label="Mobil menü">
      <?php foreach (nav_items() as $n): if (!$n['on']) continue; ?>
        <a class="mm-big" href="<?= h($n['href']) ?>"><?= h($n['label']) ?></a>
      <?php endforeach; ?>
      <div class="mm-small">
        <a href="/hakkinda/">Hakkında</a><a href="/yontem/">Yöntem</a><a href="/iletisim/">İletişim</a><a href="/gizlilik/">Gizlilik</a>
      </div>
      <a class="btn btn-block" href="/paylas/">Tarihlerini paylaş</a>
    </nav>
  </div>
</header>

<main id="icerik">
<?= $body ?>
</main>

<footer class="site-footer">
  <div class="wrap">
    <div class="footer-top">
      <div class="footer-brand">
        <p class="logo">vizesel<span>.</span></p>
        <p>Vize randevu bekleme süreleri, başvuru sahiplerinin paylaştığı tarihlerden. Vize, pasaport ve seyahat üzerine kaynaklı rehberler.</p>
      </div>
      <nav class="footer-cols" aria-label="Alt menü">
        <div><p class="fh">Bekleme süreleri</p>
          <?php foreach (countries() as $slug => $c): if (!$c['active']) continue; ?><a href="/ulkeler/<?= h($slug) ?>/vize/"><?= h($c['name']) ?></a><?php endforeach; ?>
          <a href="/ulkeler/">Tüm ülkeler</a>
        </div>
        <div><p class="fh">Rehberler</p>
          <?php foreach (nav_items() as $n): if (!$n['on'] || $n['key'] === 'yardim') continue; ?><a href="<?= h($n['href']) ?>"><?= h($n['label']) ?></a><?php endforeach; ?>
          <a href="/ulkeler/almanya/vize/randevu-nasil-alinir/">Almanya randevusu nasıl alınır?</a>
          <a href="/ulkeler/danimarka/vize/randevu-nasil-alinir/">Danimarka randevusu nasıl alınır?</a>
        </div>
        <div><p class="fh">Vizesel</p>
          <a href="/hakkinda/">Hakkında</a><a href="/yontem/">Yöntem</a><a href="/yardim/">Yardım merkezi</a><a href="/paylas/">Tarihlerini paylaş</a><a href="/iletisim/">İletişim</a>
        </div>
        <div><p class="fh">Yasal</p>
          <a href="/gizlilik/">Gizlilik ve KVKK</a><a href="/kullanim-kosullari/">Kullanım koşulları</a>
        </div>
      </nav>
    </div>
    <div class="footer-bottom">
      <p>Bilgiler kullanıcı beyanına dayanır ve resmî değildir. Vizesel; konsolosluklar, büyükelçilikler ve randevu sağlayıcılarıyla bağlantılı değildir.</p>
      <p>© <?= date('Y') ?> Vizesel</p>
    </div>
  </div>
</footer>
<script src="/assets/js/site.js?v=<?= $v ?>" defer></script>
</body>
</html>
