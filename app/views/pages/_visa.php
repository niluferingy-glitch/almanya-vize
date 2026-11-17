<?php
$country = $cslug;
$rows = array_values(array_filter(country_table($country, 'turistik'), fn($r) => $r['med'] !== null));
$fast = $rows[0] ?? null; $slow = $rows ? end($rows) : null;
$month = tr_month(today());
$crumbs = [['Ana sayfa', '/'], ['Ülkeler', '/ulkeler/'], [$c['name'], '/ulkeler/' . $country . '/'], ['Vize bekleme süreleri', '/ulkeler/' . $country . '/vize/']];
$desc = $fast && $slow
    ? sprintf('%s turistik vize randevu ataması şu an %s ile %s gün arasında geliyor. Merkezlere göre güncel süreler ve hesaplama aracı.', $c['name'], $fast['med'], $slow['med'])
    : $c['name'] . ' vize randevu bekleme süreleri, merkezlere göre.';
render('visa', compact('country', 'c', 'fast', 'slow', 'crumbs'), [
    'title' => $c['name'] . ' vize randevu bekleme süreleri (' . $month . ') | Vizesel',
    'desc' => $desc, 'canonical' => '/ulkeler/' . $country . '/vize/', 'nav' => 'vize', 'crumbs' => $crumbs,
    'schema' => [faq_schema(faq($country))],
]);
