<?php
header('Content-Type: application/rss+xml; charset=utf-8');
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?><rss version="2.0"><channel>
<title>Seyahatname · Vizesel</title><link><?= h(url('/seyahatname/')) ?></link>
<description>Vize, pasaport ve seyahat hazırlığı üzerine yazılar.</description><language>tr</language>
<?php foreach (posts() as $slug => $p): ?>
<item><title><?= h($p['title']) ?></title><link><?= h(url('/seyahatname/' . $slug . '/')) ?></link><guid><?= h(url('/seyahatname/' . $slug . '/')) ?></guid>
<pubDate><?= date(DATE_RSS, strtotime($p['published'] . ' 09:00')) ?></pubDate><description><?= h($p['desc']) ?></description></item>
<?php endforeach; ?>
</channel></rss>
