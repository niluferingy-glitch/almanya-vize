<?php
header('Content-Type: application/xml; charset=utf-8');
require_once APP_DIR . '/pasaport.php';
$urls = [['/', today()], ['/ulkeler/', today()], ['/seyahatname/', null], ['/yardim/', null], ['/paylas/', null],
         ['/yontem/', '2026-11-14'], ['/hakkinda/', '2026-11-14'], ['/iletisim/', null], ['/gizlilik/', '2026-11-14'],
         ['/kullanim-kosullari/', '2026-11-14'], [author()['url'], null], ['/pasaport/ucretler/', PASAPORT_UPDATED]];
foreach (countries() as $cs => $c) {
    if (!$c['active']) continue;
    $urls[] = ['/ulkeler/' . $cs . '/', today()];
    $urls[] = ['/ulkeler/' . $cs . '/vize/', today()];
    foreach ($c['centers'] as $slug => $cc) if (center_has_data($cs, $slug)) $urls[] = ['/ulkeler/' . $cs . '/vize/' . $slug . '/', today()];
    foreach (guides()[$cs] ?? [] as $gs => $g) $urls[] = ['/ulkeler/' . $cs . '/vize/' . $gs . '/', $g['updated']];
}
foreach (posts() as $ps => $p) $urls[] = ['/seyahatname/' . $ps . '/', $p['updated']];
foreach (help_pages() as $hs => $hp) $urls[] = ['/yardim/' . $hs . '/', null];
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
foreach ($urls as [$u, $mod]) echo '<url><loc>' . h(url($u)) . '</loc>' . ($mod ? '<lastmod>' . $mod . '</lastmod>' : '') . "</url>\n";
echo '</urlset>';
