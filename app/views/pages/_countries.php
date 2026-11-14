<?php
$crumbs = [['Ana sayfa', '/'], ['Ülkeler', '/ulkeler/']];
render('countries', compact('crumbs'), [
    'title' => 'Ülkelere göre vize randevu bekleme süreleri | Vizesel',
    'desc' => 'Schengen ülkeleri için vize randevu bekleme süreleri. Almanya için merkezlere göre güncel süreler, diğer ülkeler yakında.',
    'canonical' => '/ulkeler/', 'nav' => 'vize', 'crumbs' => $crumbs,
]);
