<?php
// Sayfalarda tekrar kullanılan parçalar.

function crumbs_html(array $crumbs): string {
    $o = '<nav class="crumbs" aria-label="Konum"><ol>';
    $last = count($crumbs) - 1;
    foreach ($crumbs as $i => [$name, $path]) {
        $o .= '<li>' . ($i === $last ? '<span aria-current="page">' . h($name) . '</span>' : '<a href="' . h($path) . '">' . h($name) . '</a>') . '</li>';
    }
    return $o . '</ol></nav>';
}

function byline_html(string $updated, string $extra = ''): string {
    $a = author();
    return '<div class="byline"><img src="' . h($a['avatar']) . '" alt="" width="40" height="40" loading="lazy">'
        . '<span>Hazırlayan <a href="' . h($a['url']) . '"><strong>' . h($a['name']) . '</strong></a></span><span aria-hidden="true">·</span>'
        . '<span>Güncellendi <time datetime="' . h($updated) . '">' . h(tr_date($updated)) . '</time></span>'
        . ($extra ? '<span aria-hidden="true">·</span><span>' . $extra . '</span>' : '') . '</div>';
}

function stat_note(array $s): string {
    if ($s['med'] === null) return $s['waiting'] ? $s['waiting'] . ' kişi bekliyor' : 'veri yok';
    $parts = [];
    if ($s['seed']) $parts[] = 'başlangıç tahmini';
    $parts[] = $s['n'] . ' kayıt';
    if ($s['n'] < MIN_REAL && $s['med'] !== null) $parts[] = '<span class="low">az veri</span>';
    return implode(' · ', $parts);
}

function days_html(array $s): string {
    if ($s['med'] === null) return '<span class="muted">Henüz ataması gelen yok</span>';
    return '<span class="num">' . ($s['approx'] ? '≈ ' : '') . $s['med'] . ' gün</span> <span class="muted">· ' . months_text($s['med']) . ' ay</span>';
}

// Kitaptaki içindekiler sayfası gibi: ad, noktalı çizgi, sayı. Dipnot işaretleri satırın sonunda.
function marks(array $r): string {
    $m = '';
    if ($r['med'] !== null && $r['n'] < MIN_REAL) $m .= '*';
    if (!empty($r['seed'])) $m .= '†';
    return $m ? '<sup class="fn">' . $m . '</sup>' : '';
}
function ledger_row(string $name, ?string $href, array $r, string $meta): string {
    $val = $r['med'] !== null ? ($r['approx'] ? '≈ ' : '') . $r['med'] . ' <span class="l-unit">gün</span>' : '<span class="l-none">henüz yok</span>';
    $label = $href ? '<a href="' . h($href) . '">' . h($name) . '</a>' : h($name);
    return '<li><div class="l-line"><span class="l-name">' . $label . '</span><span class="l-dots" aria-hidden="true"></span>'
        . '<span class="l-val">' . $val . marks($r) . '</span></div>' . ($meta ? '<p class="l-meta">' . $meta . '</p>' : '') . '</li>';
}
function ledger_meta(array $r): string {
    $p = [];
    if ($r['med'] !== null && $r['frontier']) $p[] = h(tr_month($r['frontier'])) . ' kayıtları işleniyor';
    if ($r['med'] !== null) $p[] = $r['n'] . ' paylaşım';
    if ($r['waiting']) $p[] = $r['waiting'] . ' kişi bekliyor';
    return implode(' · ', $p);
}
function ledger_notes(array $rows): string {
    $n = []; $low = $seed = $approx = false;
    foreach ($rows as $r) { if ($r['med'] !== null && $r['n'] < MIN_REAL) $low = true; if (!empty($r['seed'])) $seed = true; if ($r['approx']) $approx = true; }
    if ($low) $n[] = '* ' . MIN_REAL . '\'ten az paylaşıma dayanır, kesin değildir.';
    if ($seed) $n[] = '† Başlangıç tahmini: Kasım 2026\'da kamuya açık yorumlardan anonim olarak derlendi, yeterli paylaşım gelince kalkar.';
    if ($approx) $n[] = '≈ Yalnız randevu tarihi bilinen kayıtlardan hesaplandı.';
    return $n ? '<p class="footnotes">' . implode('<br>', $n) . '</p>' : '';
}
function center_table_html(string $country, string $cat, bool $withMeta = true): string {
    $rows = country_table($country, $cat);
    if (!$rows) return '<p class="muted">Bu kategoride henüz paylaşım yok. <a href="/paylas/?ulke=' . h($country) . '">İlk paylaşımı sen yap.</a></p>';
    $base = '/ulkeler/' . $country . '/vize/';
    $o = '<ol class="ledger">';
    foreach ($rows as $r) $o .= ledger_row($r['name'], $base . $r['slug'] . '/', $r, $withMeta ? ledger_meta($r) : '');
    return $o . '</ol>' . ledger_notes($rows);
}

function calc_html(string $country, ?string $center = null, ?string $cat = null): string {
    $c = countries()[$country];
    $o = '<form class="calc-form" data-calc data-country="' . h($country) . '">';
    $o .= '<label class="field">Merkez<select name="center">';
    foreach ($c['centers'] as $slug => $cc) $o .= '<option value="' . h($slug) . '"' . ($slug === $center ? ' selected' : '') . '>' . h($cc['name']) . '</option>';
    $o .= '</select></label><label class="field">Kategori<select name="cat">';
    foreach (country_cats($country) as $k => $v) $o .= '<option value="' . h($k) . '"' . ($k === $cat ? ' selected' : '') . '>' . h($v) . '</option>';
    $o .= '</select></label><label class="field">Kayıt tarihin<input type="date" name="kayit" max="' . today() . '"></label></form>';
    $o .= '<div class="calc-out" role="status" aria-live="polite" data-calc-out><p class="why">Merkezini, kategorini ve bekleme listesine kaydolduğun günü seç.</p></div>';
    $o .= '<script type="application/json" id="calc-data">' . json_script(['country' => $country, 'data' => calc_data($country), 'today' => today()]) . '</script>';
    return $o;
}

function entries_html(array $list, bool $showCenter = true): string {
    if (!$list) return '<p class="muted">Henüz kullanıcı paylaşımı yok. <a href="/paylas/">İlk paylaşımı sen yap</a>, bir dakika sürer.</p>';
    $o = '<div class="entries">';
    foreach ($list as $e) {
        $end = $e['atama'] ?: $e['randevu'];
        $days = $end ? days_between($e['kayit'], $end) : days_between($e['kayit'], today());
        $o .= '<article class="entry"><p class="who"><strong>' . h($e['u'] ?: 'anonim') . '</strong>'
            . ($showCenter ? ' · ' . h(center_name($e['country'], $e['center'])) : '') . ' · ' . h(CATS_SHORT[$e['cat']] ?? $e['cat']) . '</p>';
        if ($e['approved'] && $e['text'] !== '') $o .= '<p class="txt">' . h($e['text']) . '</p>';
        $o .= '<p class="facts"><span>Kayıt ' . h(tr_date($e['kayit'])) . '</span>'
            . ($e['atama'] ? '<span>Atama ' . h(tr_date($e['atama'])) . '</span>' : '')
            . ($e['randevu'] ? '<span>Randevu ' . h(tr_date($e['randevu'])) . '</span>' : '')
            . ($end ? '<span class="good">' . $days . ' günde geldi</span>' : '<span class="wait">' . $days . ' gündür bekliyor</span>')
            . ($e['sonuc'] === 'onay' ? '<span class="good">Vize verildi</span>' : ($e['sonuc'] === 'ret' ? '<span class="wait">Ret</span>' : ''))
            . '</p></article>';
    }
    return $o . '</div>';
}

function faq_html(array $faq): string {
    $o = '';
    foreach ($faq as $i => [$q, $a]) $o .= '<details class="faq"' . ($i === 0 ? ' open' : '') . '><summary>' . h($q) . '</summary><p>' . h($a) . '</p></details>';
    return $o;
}
function faq_schema(array $faq): array {
    return ['@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => array_map(fn($f) => [
        '@type' => 'Question', 'name' => $f[0], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f[1]]], $faq)];
}

function sources_html(array $sources): string {
    $o = '<ul class="sources">';
    foreach ($sources as [$name, $href]) $o .= '<li><a href="' . h($href) . '"' . (str_starts_with($href, 'http') ? ' rel="noopener" target="_blank"' : '') . '>' . h($name) . '</a></li>';
    return $o . '</ul>';
}

function cover_src(string $key, string $ratio = '16x9', int $w = 1200): string { return '/assets/img/kapak/' . $key . '-' . $ratio . '-' . $w . '.webp'; }
function cover_img(array $p, string $sizes = '(max-width: 760px) 100vw, 1072px', bool $lazy = true, string $alt = null): string {
    $k = $p['cover'];
    return '<img src="' . h(cover_src($k)) . '" srcset="' . h(cover_src($k, '16x9', 600)) . ' 600w, ' . h(cover_src($k)) . ' 1200w" sizes="' . h($sizes) . '"'
        . ' width="1200" height="675" alt="' . h($alt ?? $p['cover_alt']) . '"' . ($lazy ? ' loading="lazy"' : ' fetchpriority="high"') . '>';
}

function post_list_html(array $posts, string $tag = 'h2'): string {
    $o = '<div class="post-list">';
    foreach ($posts as $slug => $p) {
        $u = '/seyahatname/' . $slug . '/';
        $o .= '<article><div class="pl-text"><p class="pl-kat">' . h($p['kat']) . '</p><' . $tag . '><a href="' . h($u) . '">' . h($p['title']) . '</a></' . $tag . '>'
            . '<p class="pl-desc">' . h($p['desc']) . '</p><p class="small muted"><time datetime="' . h($p['published']) . '">' . h(tr_date($p['published'])) . '</time> · ' . (int)$p['minutes'] . ' dk okuma</p></div>'
            . '<a class="pl-thumb" href="' . h($u) . '" tabindex="-1" aria-hidden="true">' . cover_img($p, '200px', true, '') . '</a></article>';
    }
    return $o . '</div>';
}
