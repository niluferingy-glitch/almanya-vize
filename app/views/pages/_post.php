<?php
$p = posts()[$pslug]; $a = author();
$crumbs = [['Ana sayfa', '/'], ['Seyahatname', '/seyahatname/'], [$p['title'], '/seyahatname/' . $pslug . '/']];
$imgs = array_map(fn($r) => url(cover_src($p['cover'], $r)), ['16x9', '4x3', '1x1']);
render('post', compact('p', 'pslug', 'a', 'crumbs'), [
    'title' => $p['title'] . ' | Vizesel', 'desc' => $p['desc'], 'canonical' => '/seyahatname/' . $pslug . '/',
    'nav' => 'seyahatname', 'crumbs' => $crumbs, 'og_type' => 'article', 'og_image' => cover_src($p['cover']),
    'schema' => [['@context' => 'https://schema.org', '@type' => 'Article', 'headline' => $p['title'], 'description' => $p['desc'],
        'image' => $imgs, 'datePublished' => $p['published'], 'dateModified' => $p['updated'], 'inLanguage' => 'tr-TR',
        'author' => schema_person(), 'publisher' => ['@id' => url('/') . '#kurum'], 'mainEntityOfPage' => url('/seyahatname/' . $pslug . '/')]],
]);
