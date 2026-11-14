<?php
$crumbs = [['Ana sayfa', '/'], ['Hakkında', '/hakkinda/']];
render('about', compact('crumbs'), ['title' => 'Hakkında | Vizesel', 'desc' => 'Vizesel, vize randevusu bekleyenlerin kendi tarihlerini paylaşarak birbirine yol gösterdiği bağımsız bir sitedir. Kim hazırlıyor, nasıl çalışıyor.', 'canonical' => '/hakkinda/', 'crumbs' => $crumbs,
  'schema' => [['@context' => 'https://schema.org', '@type' => 'AboutPage', 'mainEntity' => ['@id' => url('/') . '#kurum']]]]);
