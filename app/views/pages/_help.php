<?php
$crumbs = [['Ana sayfa', '/'], ['Yardım', '/yardim/']];
render('help', compact('crumbs'), ['title' => 'Yardım merkezi | Vizesel', 'desc' => 'Vizesel\'i kullanmakla ilgili sorular: tarihlerini nasıl paylaşırsın, kaydını nasıl silersin, terimler ne anlama gelir.', 'canonical' => '/yardim/', 'nav' => 'yardim', 'crumbs' => $crumbs]);
