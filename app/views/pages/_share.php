<?php
$crumbs = [['Ana sayfa', '/'], ['Tarihlerini paylaş', '/paylas/']];
$preCountry = isset($_GET['ulke']) && country((string)$_GET['ulke']) ? (string)$_GET['ulke'] : 'almanya';
$preCenter = (string)($_GET['merkez'] ?? '');
render('share', compact('crumbs', 'preCountry', 'preCenter'), [
    'title' => 'Vize bekleme tarihlerini paylaş | Vizesel',
    'desc' => 'Vize randevu bekleme tarihlerini bir dakikada paylaş, bir sonraki başvuranın tahminini netleştir. Ad ya da e-posta istemez.',
    'canonical' => '/paylas/', 'crumbs' => $crumbs,
]);
