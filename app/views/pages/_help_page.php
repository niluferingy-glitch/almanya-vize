<?php
$hp = help_pages()[$hslug];
$crumbs = [['Ana sayfa', '/'], ['Yardım', '/yardim/'], [$hp['title'], '/yardim/' . $hslug . '/']];
render('help_page', compact('hp', 'crumbs'), ['title' => $hp['title'] . ' | Vizesel', 'desc' => $hp['desc'], 'canonical' => '/yardim/' . $hslug . '/', 'nav' => 'yardim', 'crumbs' => $crumbs]);
