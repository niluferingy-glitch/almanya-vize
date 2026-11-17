<?php
// Ülkeler, merkezler, başlangıç tahmini ve istatistik hesabı.

const CATS = ['turistik' => 'Turistik', 'ziyaret' => 'Aile/arkadaş ziyareti', 'ticari' => 'Ticari'];
const CATS_SHORT = ['turistik' => 'Turistik', 'ziyaret' => 'Ziyaret', 'ticari' => 'Ticari'];
const MIN_REAL = 3;         // Bir merkezde başlangıç tahminini kaldırmak için gereken kullanıcı kaydı
const SEED_DATE = '2026-11-06';

function countries(): array {
    return [
        'almanya' => [
            'name' => 'Almanya', 'active' => true, 'provider' => 'iDATA',
            'atama_label' => 'Atama maili', 'atama_text' => 'randevu atama maili',
            'centers' => [
                'istanbul-gayrettepe' => ['name' => 'İstanbul Gayrettepe', 'city' => 'İstanbul'],
                'istanbul-altunizade' => ['name' => 'İstanbul Altunizade', 'city' => 'İstanbul'],
                'ankara'              => ['name' => 'Ankara',              'city' => 'Ankara'],
                'izmir'               => ['name' => 'İzmir',               'city' => 'İzmir'],
                'antalya'             => ['name' => 'Antalya',             'city' => 'Antalya'],
                'bursa'               => ['name' => 'Bursa',               'city' => 'Bursa'],
                'trabzon'             => ['name' => 'Trabzon',             'city' => 'Trabzon'],
                'gaziantep'           => ['name' => 'Gaziantep',           'city' => 'Gaziantep'],
            ],
        ],
        'danimarka' => [
            // 17.11.2026: Ankara Büyükelçiliği turistik başvurular için geçici bekleme listesi başlattı.
            // Diğer kategoriler listeye girmiyor, bu yüzden yalnızca turistik takip ediliyor.
            'name' => 'Danimarka', 'active' => true, 'provider' => 'VFS Global',
            'cats' => ['turistik'], 'list_since' => '2026-11-17',
            'atama_label' => 'VFS bildirim maili', 'atama_text' => 'VFS bildirim maili',
            'centers' => [
                'istanbul' => ['name' => 'İstanbul', 'city' => 'İstanbul'],
                'ankara'   => ['name' => 'Ankara',   'city' => 'Ankara'],
                'izmir'    => ['name' => 'İzmir',    'city' => 'İzmir'],
                'antalya'  => ['name' => 'Antalya',  'city' => 'Antalya'],
            ],
        ],
        'italya'     => ['name' => 'İtalya',     'active' => false, 'centers' => []],
        'fransa'     => ['name' => 'Fransa',     'active' => false, 'centers' => []],
        'hollanda'   => ['name' => 'Hollanda',   'active' => false, 'centers' => []],
        'ispanya'    => ['name' => 'İspanya',    'active' => false, 'centers' => []],
        'yunanistan' => ['name' => 'Yunanistan', 'active' => false, 'centers' => []],
    ];
}
function country(string $slug): ?array { $c = countries()[$slug] ?? null; return ($c && $c['active']) ? $c : null; }
// Ülkede takip edilen kategoriler (varsayılan: hepsi)
function country_cats(string $country): array {
    $keys = countries()[$country]['cats'] ?? array_keys(CATS);
    return array_intersect_key(CATS, array_flip($keys));
}
function center_name(string $country, string $center): string { return countries()[$country]['centers'][$center]['name'] ?? $center; }

// Kasım 2026'da kamuya açık yorumlardan anonim derlenmiş toplu sayılar. Kişi bazlı veri içermez.
function seed(): array {
    return [
        'almanya' => [
            'istanbul-gayrettepe' => ['turistik' => ['med' => 321, 'n' => 5, 'waiting' => 6, 'frontier' => '2025-12'],
                                      'ziyaret'  => ['med' => 222, 'n' => 1, 'waiting' => 1, 'frontier' => '2026-03']],
            'istanbul-altunizade' => ['turistik' => ['med' => 416, 'n' => 1, 'waiting' => 6, 'frontier' => '2025-09', 'approx' => true],
                                      'ziyaret'  => ['med' => null, 'n' => 0, 'waiting' => 1],
                                      'ticari'   => ['med' => 27,  'n' => 1, 'waiting' => 0, 'frontier' => '2026-09']],
            'izmir'               => ['turistik' => ['med' => 371, 'n' => 2, 'waiting' => 1, 'frontier' => '2025-11'],
                                      'ziyaret'  => ['med' => 209, 'n' => 1, 'waiting' => 1, 'frontier' => '2026-03']],
            'antalya'             => ['turistik' => ['med' => 372, 'n' => 4, 'waiting' => 1, 'frontier' => '2025-10']],
            'ankara'              => ['turistik' => ['med' => 291, 'n' => 1, 'waiting' => 1, 'frontier' => '2026-01'],
                                      'ziyaret'  => ['med' => 108, 'n' => 1, 'waiting' => 0, 'frontier' => '2026-06']],
            'bursa'               => ['turistik' => ['med' => null, 'n' => 0, 'waiting' => 1]],
            'gaziantep'           => ['ziyaret'  => ['med' => null, 'n' => 0, 'waiting' => 1]],
        ],
    ];
}

function all_entries(string $country): array {
    static $cache = [];
    if (isset($cache[$country])) return $cache[$country];
    try {
        $st = db()->prepare('SELECT id, country, center, cat, kayit, atama, randevu, sonuc, u, text, approved, created_at FROM entries WHERE country = ? ORDER BY created_at DESC');
        $st->execute([$country]);
        $cache[$country] = $st->fetchAll();
    } catch (Throwable $e) {
        error_log('entries: ' . $e->getMessage());
        $cache[$country] = [];
    }
    return $cache[$country];
}

function median(array $a): ?int {
    if (!$a) return null;
    sort($a); $n = count($a); $m = intdiv($n, 2);
    return $n % 2 ? $a[$m] : (int)round(($a[$m - 1] + $a[$m]) / 2);
}

function raw_stats(array $list): array {
    $days = []; $approxAll = true; $frontier = null; $waiting = 0; $longest = null;
    foreach ($list as $e) {
        $end = $e['atama'] ?: $e['randevu'];
        if ($end) {
            $days[] = days_between($e['kayit'], $end);
            if ($e['atama']) $approxAll = false;
            if (!$frontier || $e['kayit'] > $frontier) $frontier = $e['kayit'];
        } else {
            $waiting++;
            $w = days_between($e['kayit'], today());
            $longest = max($longest ?? 0, $w);
        }
    }
    return ['med' => median($days), 'n' => count($days), 'approx' => $days && $approxAll,
            'frontier' => $frontier ? substr($frontier, 0, 7) : null, 'waiting' => $waiting, 'longest' => $longest];
}

// Bir merkez + kategori için gösterilecek sayı: yeterli kullanıcı kaydı varsa onlar, yoksa başlangıç tahmini.
function center_stat(string $country, string $center, string $cat): ?array {
    $mine = array_filter(all_entries($country), fn($e) => $e['center'] === $center && $e['cat'] === $cat);
    $r = raw_stats($mine);
    $sd = seed()[$country][$center][$cat] ?? null;
    if ($r['n'] >= MIN_REAL || !$sd || ($r['med'] !== null && $sd['med'] === null)) {
        if ($r['n'] === 0 && $r['waiting'] === 0) return null;
        return $r + ['seed' => false, 'real' => $r['n']];
    }
    return ['med' => $sd['med'], 'n' => $sd['n'], 'approx' => !empty($sd['approx']), 'frontier' => $sd['frontier'] ?? null,
            'waiting' => $sd['waiting'] + $r['waiting'], 'longest' => $r['longest'], 'seed' => true, 'real' => $r['n']];
}

// Kategoriye göre tüm merkezler, ortanca süreye göre sıralı
function country_table(string $country, string $cat): array {
    $rows = [];
    foreach (countries()[$country]['centers'] as $slug => $c) {
        $s = center_stat($country, $slug, $cat);
        if ($s) $rows[] = ['slug' => $slug, 'name' => $c['name']] + $s;
    }
    usort($rows, fn($a, $b) => ($a['med'] ?? PHP_INT_MAX) <=> ($b['med'] ?? PHP_INT_MAX));
    return $rows;
}

function center_has_data(string $country, string $center): bool {
    foreach (array_keys(country_cats($country)) as $cat) { $s = center_stat($country, $center, $cat); if ($s && $s['med'] !== null) return true; }
    return false;
}

// Hesaplama aracı için sayfaya gömülen veri
function calc_data(string $country): array {
    $out = [];
    foreach (countries()[$country]['centers'] as $slug => $c) {
        foreach (array_keys(country_cats($country)) as $cat) {
            $s = center_stat($country, $slug, $cat);
            if ($s && $s['med'] !== null) $out[$slug][$cat] = ['med' => $s['med'], 'n' => $s['n'], 'seed' => $s['seed']];
        }
    }
    return $out;
}

function last_assignment(string $country): ?string {
    $last = null;
    foreach (all_entries($country) as $e) if ($e['atama'] && (!$last || $e['atama'] > $last)) $last = $e['atama'];
    return $last;
}

function public_entries(string $country, ?string $center = null, int $limit = 20): array {
    $out = [];
    foreach (all_entries($country) as $e) {
        if ($center && $e['center'] !== $center) continue;
        $out[] = $e;
        if (count($out) >= $limit) break;
    }
    return $out;
}

// ---- Form doğrulama (API) ----
function validate_entry(array $b) {
    if (!empty($b['web'])) return 'spam';
    $isDate = fn($s) => is_string($s) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $s) && strtotime($s) !== false;
    $country = (string)($b['country'] ?? '');
    $center = (string)($b['center'] ?? '');
    $cat = (string)($b['cat'] ?? '');
    $c = country($country);
    if (!$c || !isset($c['centers'][$center]) || !isset(country_cats($country)[$cat]) || !$isDate($b['kayit'] ?? null)) return 'invalid';
    $kayit = $b['kayit'];
    $atama = $isDate($b['atama'] ?? null) ? $b['atama'] : null;
    $randevu = $isDate($b['randevu'] ?? null) ? $b['randevu'] : null;
    $sonuc = in_array($b['sonuc'] ?? '', ['onay', 'ret'], true) ? $b['sonuc'] : null;
    $t = today();
    if ($kayit > $t || $kayit < '2023-01-01') return 'invalid';
    if ($atama && ($atama < $kayit || $atama > $t)) return 'invalid';
    if ($randevu && $randevu < $kayit) return 'invalid';
    if ($atama && days_between($kayit, $atama) > 3 * 365) return 'invalid';
    if ($randevu && $atama && days_between($atama, $randevu) > 365) return 'invalid';
    $text = mb_substr(trim(preg_replace('/\s+/u', ' ', (string)($b['text'] ?? ''))), 0, 280);
    $u = mb_substr(trim(preg_replace('/[^\p{L}\p{N} _.\-]/u', '', (string)($b['u'] ?? ''))), 0, 24);
    return compact('country', 'center', 'cat', 'kayit', 'atama', 'randevu', 'sonuc', 'text') + ['u' => $u !== '' ? $u : 'anonim'];
}
