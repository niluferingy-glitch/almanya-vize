<?php
$crumbs = [['Ana sayfa', '/'], ['Kullanım koşulları', '/kullanim-kosullari/']];
render('terms', compact('crumbs'), ['title' => 'Kullanım koşulları | Vizesel', 'desc' => 'Vizesel\'i kullanırken geçerli koşullar: sitedeki verilerin niteliği, paylaşım kuralları ve sorumluluk sınırları.', 'canonical' => '/kullanim-kosullari/', 'crumbs' => $crumbs]);
