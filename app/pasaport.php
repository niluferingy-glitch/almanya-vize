<?php
// Pasaport ücretleri: tutarlar, SSS ve kaynaklar. Yıl başında yalnız bu dosya güncellenir.

const PASAPORT_UPDATED = '2026-11-18';

// Tutarlar kuruş cinsinden. 'sure' anahtarı ay sayısıdır; 37 = 3 yıldan uzun (en fazla 10 yıl).
function passport_fees(): array {
    return [
        2026 => [
            'kesin' => true,
            'harc' => [6 => 280650, 12 => 410300, 24 => 669850, 36 => 951600, 37 => 1341040],
            'defter' => 135100,
            'cikis' => 125000,
        ],
        // 2027 tahmini: 2026 tutarları x 1,2783 (yeniden değerleme oranı %27,83).
        // Harçta 10 kuruşa, çıkış harcında 10 TL'ye kadarki kesirler atılır. Defter bedeli tam liraya yuvarlanır.
        2027 => [
            'kesin' => false,
            'oran' => 27.83,
            'harc' => [6 => 358750, 12 => 524480, 24 => 856260, 36 => 1216430, 37 => 1714250],
            'defter' => 172700,
            'cikis' => 159000,
        ],
    ];
}

function passport_durations(): array {
    $d = [6 => '6 ay', 12 => '1 yıl', 24 => '2 yıl', 36 => '3 yıl'];
    for ($y = 4; $y <= 10; $y++) $d[$y * 12] = $y . ' yıl';
    return $d;
}
function passport_harc_key(int $months): int { return $months > 36 ? 37 : $months; }

function passport_types(): array {
    return [
        'bordo'   => ['label' => 'Bordo (umuma mahsus)', 'harc' => true],
        'ogrenci' => ['label' => 'Bordo, harçsız öğrenci', 'harc' => false],
        'yesil'   => ['label' => 'Yeşil (hususi)', 'harc' => false],
        'gri'     => ['label' => 'Gri (hizmet)', 'harc' => false],
    ];
}

function tl(int $kurus, bool $dec = true): string {
    return number_format($kurus / 100, $dec ? 2 : 0, ',', '.') . ' TL';
}

function faq_pasaport(): array {
    return [
        ['10 yıllık pasaport ne kadar?', '2026\'da 10 yıllık bordo pasaport için 13.410,40 TL harç ve 1.351 TL defter bedeli, toplam 14.761,40 TL ödenir. 4 ile 10 yıl arasındaki her süre için harç aynıdır.'],
        ['Öğrenciler pasaport için ne öder?', 'Öğrenim görmekte olup 25 yaşını doldurmamış olanlar harç ödemez, yalnız 1.351 TL defter bedeli öder. Okula giden çocuklar da öğrenci belgesiyle bu kapsama girer. 18 yaşından küçüklere harçsız pasaport en fazla 5 yıllık verilir.'],
        ['Pasaport yenilerken aynı ücret mi ödenir?', 'Evet. Yenileme yeni pasaport almakla aynı ücrete tabidir: seçtiğin süreye göre harç ve defter bedeli ödenir.'],
        ['Pasaport harcı kredi kartıyla ödenir mi?', 'Evet. Dijital Vergi Dairesi\'ndeki (dijital.gib.gov.tr) Hızlı Ödemeler bölümünden, GİB Mobil\'den ve anlaşmalı bankaların internet ve mobil şubelerinden kredi kartıyla ödeyebilirsin. Harç ve defter bedeli iki ayrı ödemedir.'],
        ['Yurt dışı çıkış harcı pasaport ücretine dâhil mi?', 'Hayır. Çıkış harcı her yurt dışı çıkışta kişi başı ayrıca ödenir, 2026\'da 1.250 TL\'dir. 7 yaşını doldurmamış çocuklar ve yurt dışında oturma izni olanlar ödemez.'],
        ['Pasaportumu kaybettim, ne kadar öderim?', 'Kayıp ya da çalıntı bildiriminden sonra yeni pasaport için ilk başvurudaki gibi süre seçersin ve aynı harç ile defter bedelini ödersin. 2026\'da 10 yıllık pasaport için bu toplam 14.761,40 TL.'],
        ['Ödeme yaptım ama başvurmadım, param geri alınır mı?', 'Başvuru yapmadıysan ödediğin harç ve defter bedelini vergi dairesinden geri isteyebilirsin.'],
        ['Aralıkta ödeyip ocakta başvurursam fark öder miyim?', 'Yeni yılda başvuranlardan fark istenebilir. Ocak 2023\'te fark istendi, sonra bakanlık talimatıyla aralıkta ödeyenlerden alınmadı. Bunun her yıl aynı olacağının garantisi yok. En güvenlisi, ödediğin yıl içinde başvurmaktır.'],
    ];
}

function sources_pasaport(): array {
    return [
        ['NVİ, başvuru ücretleri tablosu', 'https://randevu.nvi.gov.tr/pages/applicationprices'],
        ['492 sayılı Harçlar Kanunu, madde 85: harçtan müstesna pasaportlar (GİB)', 'https://www.gib.gov.tr/node/81016'],
        ['5597 sayılı Yurt Dışına Çıkış Harcı Hakkında Kanun', 'https://www.mevzuat.gov.tr/mevzuatmetin/1.5.5597.pdf'],
        ['TÜRMOB, 1 Ocak 2026\'dan itibaren yurt dışı çıkış harcı 1.250 TL', 'https://www.turmob.org.tr/ekutuphane/Read/b422a57a-9752-4d7f-aea4-23d04e2bcf8f'],
        ['Bloomberg HT, 2027 yeniden değerleme oranı %27,83 (3 Kasım 2026)', 'https://bloomberght.com/2027-icin-yeniden-degerleme-orani-belli-oldu-3793170'],
        ['GİB, Yurt Dışına Çıkış Harcı rehberi', 'https://gib.gov.tr/sites/default/files/fileadmin/beyannamerehberi/2025/2025_yurtdisicikisharci.pdf'],
        ['Dijital Vergi Dairesi (ödeme)', 'https://dijital.gib.gov.tr'],
        ['NVİ randevu', 'https://randevu.nvi.gov.tr'],
    ];
}
