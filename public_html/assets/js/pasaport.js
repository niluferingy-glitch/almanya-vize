// Pasaport ücreti hesaplama aracı. Tutarlar sayfadaki #pp-data içinde kuruş cinsindendir.
(function () {
  'use strict';
  var el = document.getElementById('pp-data'), form = document.querySelector('[data-pp]'), out = document.querySelector('[data-pp-out]');
  if (!el || !form || !out) return;
  var D = JSON.parse(el.textContent);
  var o = function (k) { return out.querySelector('[data-o="' + k + '"]'); };
  var fmt = new Intl.NumberFormat('tr-TR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
  var tl = function (kurus) { return fmt.format(kurus / 100) + ' TL'; };
  var int = function (v, min, max) { v = parseInt(v, 10); if (isNaN(v)) v = min; return Math.min(max, Math.max(min, v)); };
  var sureOpt = form.elements.sure;

  var run = function () {
    var yil = (form.querySelector('[name=yil]:checked') || {}).value || '2026';
    var F = D.fees[yil], tur = form.elements.tur.value, T = D.types[tur];
    var months = +sureOpt.value, kisi = int(form.elements.kisi.value, 1, 20), cikis = int(form.elements.cikis.value, 0, 50);

    var harcKisi = T.harc ? F.harc[months > 36 ? 37 : months] : 0;
    var harc = harcKisi * kisi, defter = F.defter * kisi, cikisT = F.cikis * kisi * cikis;
    var total = harc + defter + cikisT, pass = harc + defter;
    var x = kisi > 1 ? ' (' + kisi + ' kişi)' : '';

    o('label').textContent = (F.kesin ? 'Ödeyeceğin toplam' : 'Tahmini toplam, ' + yil) + x;
    o('total').textContent = tl(total);
    o('peryear').textContent = 'Pasaportun yıl başına maliyeti ' + tl(Math.round(pass / kisi / (months / 12))) + (kisi > 1 ? ' (kişi başı)' : '');
    o('harc-l').textContent = 'Pasaport harcı' + (kisi > 1 && T.harc ? ' · ' + kisi + ' × ' + tl(harcKisi) : '');
    o('harc').textContent = T.harc ? tl(harc) : 'Muaf';
    o('defter-l').textContent = 'Defter bedeli' + (kisi > 1 ? ' · ' + kisi + ' × ' + tl(F.defter) : '');
    o('defter').textContent = tl(defter);
    o('cikis-row').hidden = !cikis;
    o('cikis-l').textContent = 'Yurt dışı çıkış harcı · ' + (kisi * cikis) + ' × ' + tl(F.cikis);
    o('cikis').textContent = tl(cikisT);

    var note = [];
    if (!F.kesin) note.push('2027 tutarları, %' + String(F.oran).replace('.', ',') + ' yeniden değerleme oranı tam uygulanırsa çıkacak tahmini rakamlardır. Kesin tutarlar Aralık sonunda belli olur.');
    if (tur === 'ogrenci') note.push('Harçsız pasaportta süre ücreti değiştirmez. 18 yaşından küçüklere en fazla 5 yıllık verilir.');
    else if (!T.harc) note.push('Yeşil ve gri pasaportta harç alınmaz, süre ücreti değiştirmez.');
    else if (months > 36 && months < 120) note.push('3 yıldan uzun her süre için harç aynıdır. Aynı ücrete 10 yıllık alabilirsin.');
    if (cikis) note.push('7 yaşını doldurmamış çocuklar çıkış harcı ödemez.');
    if (!note.length) note.push('Harç ve defter bedeli iki ayrı ödemedir. Başvurudan önce ikisini de ödemiş olman gerekir.');
    o('note').textContent = note.join(' ');
  };
  form.addEventListener('input', run);
  form.addEventListener('change', run);
  form.addEventListener('submit', function (e) { e.preventDefault(); run(); });
  run();
})();
