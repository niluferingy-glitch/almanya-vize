<?php
require_once APP_DIR . '/pasaport.php';
$fees = passport_fees();
$cur = $fees[2026];
$path = '/pasaport/ucretler/';
$crumbs = [['Ana sayfa', '/'], ['Pasaport ücretleri', $path]];
$ten = $cur['harc'][37] + $cur['defter'];
$six = $cur['harc'][6] + $cur['defter'];
$title = 'Pasaport ücretleri 2026: harç ve defter bedeli hesaplama';
$desc = '2026\'da 10 yıllık pasaport ' . tl($ten) . ', 6 aylık ' . tl($six) . '. Süreye, pasaport türüne ve kişi sayısına göre harç, defter bedeli ve yurt dışı çıkış harcını hesapla. 2027 tahmini tutarlar da var.';
render('passport_fees', compact('fees', 'cur', 'crumbs', 'ten', 'six', 'title'), [
    'title' => $title . ' | Vizesel', 'og_title' => $title, 'desc' => $desc,
    'canonical' => $path, 'nav' => 'pasaport', 'crumbs' => $crumbs, 'og_type' => 'article',
    'schema' => [
        ['@context' => 'https://schema.org', '@type' => 'Article', 'headline' => $title, 'description' => $desc,
         'dateModified' => PASAPORT_UPDATED, 'datePublished' => PASAPORT_UPDATED, 'inLanguage' => 'tr-TR',
         'author' => schema_person(), 'publisher' => ['@id' => url('/') . '#kurum'], 'mainEntityOfPage' => url($path),
         'image' => url('/assets/img/og-vizesel.png')],
        faq_schema(faq_pasaport()),
    ],
]);
