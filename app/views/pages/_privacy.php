<?php
$crumbs = [['Ana sayfa', '/'], ['Gizlilik ve KVKK', '/gizlilik/']];
render('privacy', compact('crumbs'), ['title' => 'Gizlilik ve KVKK aydınlatma metni | Vizesel', 'desc' => 'Vizesel hangi bilgileri saklar, ne kadar süre tutar ve haklarını nasıl kullanabilirsin.', 'canonical' => '/gizlilik/', 'crumbs' => $crumbs]);
