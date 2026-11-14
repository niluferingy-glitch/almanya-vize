<?php
$country = $cslug; $g = guides()[$country][$gslug];
$crumbs = [['Ana sayfa', '/'], ['Ülkeler', '/ulkeler/'], [$c['name'], '/ulkeler/' . $country . '/'], ['Vize', '/ulkeler/' . $country . '/vize/'], [$g['title'], '/ulkeler/' . $country . '/vize/' . $gslug . '/']];
$a = author();
render('guide', compact('country', 'c', 'g', 'crumbs'), [
    'title' => $g['title'] . ' | Vizesel', 'desc' => $g['desc'],
    'canonical' => '/ulkeler/' . $country . '/vize/' . $gslug . '/', 'nav' => 'vize', 'crumbs' => $crumbs, 'og_type' => 'article',
    'schema' => [['@context' => 'https://schema.org', '@type' => 'Article', 'headline' => $g['title'], 'description' => $g['desc'],
        'dateModified' => $g['updated'], 'datePublished' => $g['updated'], 'inLanguage' => 'tr-TR',
        'author' => schema_person(), 'publisher' => ['@id' => url('/') . '#kurum'], 'mainEntityOfPage' => url('/ulkeler/' . $country . '/vize/' . $gslug . '/'),
        'image' => url('/assets/img/og-vizesel.png')]],
]);
