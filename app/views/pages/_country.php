<?php
$country = $cslug;
$crumbs = [['Ana sayfa', '/'], ['Ülkeler', '/ulkeler/'], [$c['name'], '/ulkeler/' . $country . '/']];
render('country', compact('country', 'c', 'crumbs'), [
    'title' => $c['name'] . ' vizesi ve seyahat rehberi | Vizesel',
    'desc' => $c['name'] . ' vize randevu bekleme süreleri, randevu süreci ve ' . $c['name'] . ' için rehberler. Başvuru sahiplerinin paylaşımlarıyla güncel.',
    'canonical' => '/ulkeler/' . $country . '/', 'nav' => 'vize', 'crumbs' => $crumbs,
]);
