<?php
$country = $cslug;
$cname = $c['centers'][$center]['name'];
$stats = [];
foreach (array_keys(CATS) as $k) $stats[$k] = center_stat($country, $center, $k);
$main = $stats['turistik'] ?? null;
$crumbs = [['Ana sayfa', '/'], ['Ülkeler', '/ulkeler/'], [$c['name'], '/ulkeler/' . $country . '/'], ['Vize', '/ulkeler/' . $country . '/vize/'], [$cname, '/ulkeler/' . $country . '/vize/' . $center . '/']];
$desc = $main && $main['med'] !== null
    ? sprintf('%s %s turistik vize randevu ataması ortalama %s gün (%s ay) sürüyor. Şu an %s kayıtları işleniyor. Güncel süre, hesaplama aracı ve paylaşımlar.', $cname, $c['name'], $main['med'], months_text($main['med']), $main['frontier'] ? tr_month($main['frontier']) : 'yakın tarihli')
    : sprintf('%s %s vize randevu bekleme süresi: başvuru sahiplerinin paylaştığı tarihler ve hesaplama aracı.', $cname, $c['name']);
render('center', compact('country', 'c', 'center', 'cname', 'stats', 'crumbs'), [
    'title' => $cname . ' ' . $c['name'] . ' vize randevusu ne zaman gelir? | Vizesel',
    'desc' => $desc, 'canonical' => '/ulkeler/' . $country . '/vize/' . $center . '/', 'nav' => 'vize', 'crumbs' => $crumbs,
    'robots' => center_has_data($country, $center) ? 'index,follow' : 'noindex,follow',
]);
