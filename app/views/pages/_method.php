<?php
$crumbs = [['Ana sayfa', '/'], ['Yöntem', '/yontem/']];
render('method', compact('crumbs'), ['title' => 'Bekleme sürelerini nasıl hesaplıyoruz? | Vizesel', 'desc' => 'Vizesel\'deki her sayının nereden geldiği, hangi kayıtların dışarıda bırakıldığı ve tahminlerin nerede yanılabileceği.', 'canonical' => '/yontem/', 'crumbs' => $crumbs]);
