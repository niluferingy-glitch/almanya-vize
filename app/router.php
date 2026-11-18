<?php
// Tüm sayfa istekleri buradan geçer.

function render(string $view, array $vars, array $meta): void {
    extract($vars);
    ob_start();
    require APP_DIR . '/views/pages/' . $view . '.php';
    $body = ob_get_clean();
    $meta += ['robots' => 'index,follow', 'schema' => [], 'nav' => null, 'og_image' => '/assets/img/og-vizesel.png', 'og_type' => 'website', 'crumbs' => []];
    if ($meta['crumbs']) $meta['schema'][] = schema_breadcrumbs($meta['crumbs']);
    require APP_DIR . '/views/layout.php';
}

function not_found(): void {
    http_response_code(404);
    render('404', [], ['title' => 'Sayfa bulunamadı | Vizesel', 'desc' => 'Aradığın sayfa bulunamadı.', 'canonical' => null, 'robots' => 'noindex,follow']);
    exit;
}

// Yalnız kendi sitemize yönlendir: yol her zaman tam adresle (https://www.vizesel.com/...) birleştirilir,
// böylece /\\baska-site.com gibi hileli yollar dışarı çıkamaz.
function redirect(string $to, int $code = 301): void {
    if (!str_starts_with($to, '/') || str_starts_with($to, '//') || preg_match('/[\\\\\x00-\x1f\x7f]/', $to)) $to = '/';
    header('Location: ' . url($to), true, $code); exit;
}

// ---- Yapısal veri ----
function schema_breadcrumbs(array $crumbs): array {
    $items = []; $i = 1;
    foreach ($crumbs as [$name, $path]) $items[] = ['@type' => 'ListItem', 'position' => $i++, 'name' => $name, 'item' => url($path)];
    return ['@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => $items];
}
function schema_person(): array {
    $a = author();
    $p = ['@type' => 'Person', '@id' => url($a['url']) . '#kisi', 'name' => $a['name'], 'url' => url($a['url']),
          'image' => url($a['portrait']), 'jobTitle' => $a['role'], 'worksFor' => ['@id' => url('/') . '#kurum']];
    if ($a['same_as']) $p['sameAs'] = $a['same_as'];
    return $p;
}
function schema_site(): array {
    return ['@context' => 'https://schema.org', '@graph' => [
        ['@type' => 'Organization', '@id' => url('/') . '#kurum', 'name' => 'Vizesel', 'url' => url('/'),
         'logo' => url('/assets/img/logo-512.png'), 'founder' => ['@id' => url(author()['url']) . '#kisi'],
         'email' => cfg('contact_email')],
        ['@type' => 'WebSite', '@id' => url('/') . '#site', 'name' => 'Vizesel', 'url' => url('/'), 'inLanguage' => 'tr-TR',
         'publisher' => ['@id' => url('/') . '#kurum']],
    ]];
}

// ---- Rotalar ----
$uri = $_SERVER['REQUEST_URI'] ?? '/';
$path = rawurldecode(parse_url($uri, PHP_URL_PATH) ?: '/');
$query = parse_url($uri, PHP_URL_QUERY);

// Ters eğik çizgi, kontrol karakteri, '..' içeren yollar: doğrudan 404
if (preg_match('/[\\\\\x00-\x1f\x7f]/', $path) || str_contains($path, '..')) not_found();

if (str_starts_with($path, '/api/')) { require APP_DIR . '/api.php'; exit; }

// Sayfalar yalnız GET/HEAD ile açılır
if (!in_array($_SERVER['REQUEST_METHOD'] ?? 'GET', ['GET', 'HEAD'], true)) {
    http_response_code(405); header('Allow: GET, HEAD'); exit;
}
if ($path === '/sitemap.xml') { require APP_DIR . '/sitemap.php'; exit; }

// Büyük harf ve sondaki eğik çizgi düzeltmesi
$norm = mb_strtolower($path);
if ($norm !== '/' && !str_ends_with($norm, '/') && !preg_match('/\.[a-z0-9]{2,5}$/', $norm)) $norm .= '/';
$norm = preg_replace('#/+#', '/', $norm);
if ($norm !== $path) redirect($norm . ($query ? '?' . $query : ''));

$seg = array_values(array_filter(explode('/', $path)));

// Eski Cloudflare adreslerinden ve kısa yollardan yönlendirmeler
$aliases = ['/almanya/' => '/ulkeler/almanya/vize/', '/defter/' => '/seyahatname/', '/blog/' => '/seyahatname/', '/vize/' => '/ulkeler/almanya/vize/', '/ulkeler/almanya/vize/istanbul-beyoglu/' => '/ulkeler/almanya/vize/', '/pasaport/fiyatlar/' => '/pasaport/ucretler/'];
if (isset($aliases[$path])) redirect($aliases[$path]);

$pagesDir = APP_DIR . '/views/pages/';
switch ($seg[0] ?? '') {
    case '':
        require $pagesDir . '_home.php'; break;
    case 'ulkeler':
        if (count($seg) === 1) { require $pagesDir . '_countries.php'; break; }
        $cslug = $seg[1]; $c = country($cslug);
        if (!$c) not_found();
        if (count($seg) === 2) { require $pagesDir . '_country.php'; break; }
        if ($seg[2] !== 'vize') not_found();
        if (count($seg) === 3) { require $pagesDir . '_visa.php'; break; }
        if (count($seg) === 4) {
            if (isset($c['centers'][$seg[3]])) { $center = $seg[3]; require $pagesDir . '_center.php'; break; }
            if (isset(guides()[$cslug][$seg[3]])) { $gslug = $seg[3]; require $pagesDir . '_guide.php'; break; }
        }
        not_found();
    case 'seyahatname':
        if (count($seg) === 1) { require $pagesDir . '_blog.php'; break; }
        if (count($seg) === 2 && $seg[1] === 'rss.xml') { require APP_DIR . '/rss.php'; exit; }
        if (count($seg) === 2 && isset(posts()[$seg[1]])) { $pslug = $seg[1]; require $pagesDir . '_post.php'; break; }
        not_found();
    case 'yardim':
        if (count($seg) === 1) { require $pagesDir . '_help.php'; break; }
        if (count($seg) === 2 && isset(help_pages()[$seg[1]])) { $hslug = $seg[1]; require $pagesDir . '_help_page.php'; break; }
        not_found();
    case 'pasaport':
        // Pasaport ana sayfası hazır olana kadar ücretler sayfasına geçici yönlendirme.
        if (count($seg) === 1) redirect('/pasaport/ucretler/', 302);
        if (count($seg) === 2 && $seg[1] === 'ucretler') { require $pagesDir . '_passport_fees.php'; break; }
        not_found();
    case 'yazar':
        if (count($seg) === 2 && $seg[1] === author()['slug']) { require $pagesDir . '_author.php'; break; }
        not_found();
    case 'paylas':     if (count($seg) === 1) { require $pagesDir . '_share.php'; break; } not_found();
    case 'yontem':     if (count($seg) === 1) { require $pagesDir . '_method.php'; break; } not_found();
    case 'hakkinda':   if (count($seg) === 1) { require $pagesDir . '_about.php'; break; } not_found();
    case 'iletisim':   if (count($seg) === 1) { require $pagesDir . '_contact.php'; break; } not_found();
    case 'gizlilik':   if (count($seg) === 1) { require $pagesDir . '_privacy.php'; break; } not_found();
    case 'kullanim-kosullari': if (count($seg) === 1) { require $pagesDir . '_terms.php'; break; } not_found();
    case 'yonetim':    if (count($seg) === 1) { require $pagesDir . '_admin.php'; break; } not_found();
    default: not_found();
}
