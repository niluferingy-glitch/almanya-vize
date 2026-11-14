<?php
$crumbs = [['Ana sayfa', '/'], ['İletişim', '/iletisim/']];
render('contact', compact('crumbs'), ['title' => 'İletişim | Vizesel', 'desc' => 'Vizesel ile iletişim: düzeltme, öneri ve kayıt silme talepleri.', 'canonical' => '/iletisim/', 'crumbs' => $crumbs,
  'schema' => [['@context' => 'https://schema.org', '@type' => 'ContactPage', 'mainEntity' => ['@id' => url('/') . '#kurum']]]]);
