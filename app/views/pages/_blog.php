<?php
$crumbs = [['Ana sayfa', '/'], ['Seyahatname', '/seyahatname/']];
render('blog', compact('crumbs'), [
    'title' => 'Seyahatname: vize, pasaport ve seyahat yazıları | Vizesel',
    'desc' => 'Vize başvurusu, pasaport ve seyahat hazırlığı üzerine sade, kaynaklı ve tarihli yazılar.',
    'canonical' => '/seyahatname/', 'nav' => 'seyahatname', 'crumbs' => $crumbs,
]);
