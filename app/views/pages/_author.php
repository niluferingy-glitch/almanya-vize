<?php
$a = author();
$crumbs = [['Ana sayfa', '/'], ['Yazarlar', '/hakkinda/'], [$a['name'], $a['url']]];
render('author', compact('a', 'crumbs'), [
    'title' => $a['name'] . ' | Vizesel', 'desc' => $a['name'] . ', Vizesel\'in kurucusu ve editörü. ' . $a['bio'],
    'canonical' => $a['url'], 'crumbs' => $crumbs, 'og_type' => 'profile', 'og_image' => $a['portrait'],
    'schema' => [['@context' => 'https://schema.org', '@type' => 'ProfilePage', 'mainEntity' => schema_person()]],
]);
