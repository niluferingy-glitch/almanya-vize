<?php
$crumbs = [['Ana sayfa', '/'], ['Kullanım koşulları', '/kullanim-kosullari/']];
render('terms', compact('crumbs'), ['title' => 'Kullanım koşulları | Vizesel', 'desc' => 'Vizesel\'i kullanırken geçerli koşullar.', 'canonical' => '/kullanim-kosullari/', 'crumbs' => $crumbs]);
