<?php
$country = 'almanya';
render('home', ['country' => $country], [
    'title' => 'Vize randevu bekleme süreleri | Vizesel',
    'desc' => 'Vize randevun ne zaman gelir? Almanya için merkezlere göre güncel randevu bekleme süreleri, başvuru sahiplerinin paylaştığı tarihlerden her gün hesaplanır.',
    'canonical' => '/',
]);
