(function () {
  'use strict';
  var $ = function (s, r) { return (r || document).querySelector(s); };
  var $$ = function (s, r) { return Array.prototype.slice.call((r || document).querySelectorAll(s)); };
  var MONTHS = ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'];
  var DAY = 864e5;
  var parse = function (s) { var p = s.split('-').map(Number); return new Date(p[0], p[1] - 1, p[2], 12); };
  var esc = function (s) { return String(s == null ? '' : s).replace(/[&<>"']/g, function (c) { return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]; }); };

  // Mobil menü
  var mb = $('.menu-btn'), mm = $('#mobil-menu');
  if (mb && mm) mb.addEventListener('click', function () {
    var open = mm.hidden; mm.hidden = !open; mb.setAttribute('aria-expanded', String(open));
    mb.setAttribute('aria-label', open ? 'Menüyü kapat' : 'Menüyü aç');
  });

  // Mobilde içindekiler kapalı başlasın
  if (window.matchMedia('(max-width: 760px)').matches) $$('.doc-aside details').forEach(function (d) { d.open = false; });

  // Sekmeler
  $$('[role=tablist]').forEach(function (list) {
    var tabs = $$('[role=tab]', list);
    tabs.forEach(function (t) {
      t.addEventListener('click', function () {
        tabs.forEach(function (x) { x.setAttribute('aria-selected', String(x === t)); var p = document.getElementById(x.getAttribute('aria-controls')); if (p) p.hidden = x !== t; });
      });
    });
  });

  // Hesaplama aracı
  var dataEl = $('#calc-data');
  if (dataEl) {
    var D = JSON.parse(dataEl.textContent), today = parse(D.today);
    $$('[data-calc]').forEach(function (form) {
      var out = $('[data-calc-out]');
      var run = function () {
        var center = form.elements.center.value, cat = form.elements.cat.value, kayit = form.elements.kayit.value;
        if (!kayit) { if (out.hasAttribute('hidden')) return; out.innerHTML = '<p class="why">Bekleme listesine kaydolduğun günü seç.</p>'; return; }
        var s = (D.data[center] || {})[cat], basis = form.elements.center.selectedOptions[0].text;
        if (!s) {
          var vals = Object.keys(D.data).map(function (k) { return (D.data[k][cat] || {}).med; }).filter(Boolean).sort(function (a, b) { return a - b; });
          if (!vals.length) { out.hidden = false; out.innerHTML = '<p class="why">Bu kategori için henüz yeterli veri yok.</p>'; return; }
          s = { med: vals[Math.floor(vals.length / 2)], n: vals.length, seed: false }; basis = 'tüm merkezler (bu merkezde henüz veri yok)';
        }
        var k = parse(kayit), est = new Date(k.getTime() + s.med * DAY);
        var waited = Math.round((today - k) / DAY), left = Math.round((est - today) / DAY);
        var when = MONTHS[est.getMonth()] + ' ' + est.getFullYear();
        out.hidden = false;
        out.innerHTML = '<div><p class="small" style="color:var(--body)">Tahmini atama</p><p class="big">' + esc(when) + '</p></div>'
          + '<p class="why">' + (waited >= 0 ? waited + ' gündür bekliyorsun. ' : '')
          + (left > 0 ? 'Yaklaşık ' + left + ' gün kaldı. ' : 'Ortalama süreyi geçtin, atama her an gelebilir. ')
          + 'Hesap: ' + esc(basis) + ' için ' + s.n + ' kayda göre ortalama ' + s.med + ' gün' + (s.seed ? ', başlangıç tahmini' : '') + '.</p>';
      };
      form.addEventListener('input', run); form.addEventListener('submit', function (e) { e.preventDefault(); run(); });
    });
  }

  // Paylaşım formu
  var share = $('#share');
  if (share) {
    var KEY = 'vizesel-kayit', mine = null, msg = $('#share-msg'), btn = $('#share-btn'), del = $('#share-del');
    try { mine = JSON.parse(localStorage.getItem(KEY) || 'null'); } catch (e) {}
    var f = share.elements;
    var fill = function (e) {
      ['center', 'cat', 'kayit', 'atama', 'randevu', 'sonuc'].forEach(function (k) { if (f[k]) f[k].value = e[k] || ''; });
      f.u.value = e.u && e.u !== 'anonim' ? e.u : ''; f.text.value = e.text || (mine && mine.text) || ''; f.consent.checked = true; btn.textContent = 'Güncelle';
    };
    if (mine && mine.id) {
      fetch('/api/entries/' + encodeURIComponent(mine.id), { headers: { 'x-edit-token': mine.token } })
        .then(function (r) { if (r.status === 404) throw 'gone'; return r.ok ? r.json() : null; })
        .then(function (e) { if (e) fill(e); })
        .catch(function (x) { if (x === 'gone') { mine = null; try { localStorage.removeItem(KEY); } catch (e) {} } });
    }
    var ERR = { limit: 'Bugün için ekleme sınırına ulaştın, yarın tekrar dene.', invalid: 'Tarihleri kontrol et.', forbidden: 'Bu kayıt bu tarayıcıdan eklenmemiş.' };
    share.addEventListener('submit', function (ev) {
      ev.preventDefault();
      var k = f.kayit.value, a = f.atama.value, r = f.randevu.value;
      if (!k) { msg.textContent = 'Kayıt tarihini gir.'; return; }
      if (a && a < k) { msg.textContent = 'Atama tarihi kayıt tarihinden önce olamaz.'; return; }
      if (r && r < k) { msg.textContent = 'Randevu tarihi kayıt tarihinden önce olamaz.'; return; }
      if (!f.consent.checked) { msg.textContent = 'Devam etmek için onay kutusunu işaretle.'; return; }
      var row = { country: f.country.value, center: f.center.value, cat: f.cat.value, kayit: k, atama: a || null, randevu: r || null,
        sonuc: f.sonuc.value || null, u: f.u.value.trim(), text: f.text.value.trim(), web: f.web.value };
      btn.disabled = true; msg.textContent = 'Kaydediliyor…';
      fetch(mine ? '/api/entries/' + encodeURIComponent(mine.id) : '/api/entries', {
        method: mine ? 'PUT' : 'POST',
        headers: Object.assign({ 'content-type': 'application/json' }, mine ? { 'x-edit-token': mine.token } : {}),
        body: JSON.stringify(row)
      }).then(function (res) { return res.json().catch(function () { return {}; }).then(function (o) { if (!res.ok) throw new Error(o.error || 'hata'); return o; }); })
        .then(function (o) {
          mine = { id: mine ? mine.id : o.id, token: mine ? mine.token : o.token, text: row.text };
          try { localStorage.setItem(KEY, JSON.stringify(mine)); } catch (e) {}
          btn.textContent = 'Güncelle';
          msg.innerHTML = (o.held ? 'Teşekkürler. Tarihlerin alışılmışın dışında göründüğü için kontrol edildikten sonra hesaba girecek. '
            : row.text ? 'Teşekkürler. Tarihlerin hesaba girdi, notun kontrol edildikten sonra görünecek. ' : 'Teşekkürler, tarihlerin hesaba girdi. ')
            + '<a href="/ulkeler/' + esc(row.country) + '/vize/' + esc(row.center) + '/">Merkezinin sayfasına git</a>';
        })
        .catch(function (e) { msg.textContent = ERR[e.message] || 'Kaydedilemedi, birazdan tekrar dene.'; })
        .then(function () { btn.disabled = false; });
    });
    del.addEventListener('click', function (ev) {
      ev.preventDefault();
      if (!mine) { msg.textContent = 'Bu tarayıcıdan eklenmiş bir kayıt yok.'; return; }
      if (!del.dataset.sure) { del.dataset.sure = '1'; del.textContent = 'emin misin? silmek için tekrar tıkla'; return; }
      fetch('/api/entries/' + encodeURIComponent(mine.id), { method: 'DELETE', headers: { 'x-edit-token': mine.token } })
        .then(function (r) { if (!r.ok) throw 0; mine = null; try { localStorage.removeItem(KEY); } catch (e) {}
          share.reset(); btn.textContent = 'Ekle'; del.textContent = 'silebilirsin'; delete del.dataset.sure; msg.textContent = 'Kaydın silindi.'; })
        .catch(function () { msg.textContent = 'Silinemedi, birazdan tekrar dene.'; });
    });
  }

  // Paylaşımların altındaki yorumlar
  $$('.reply-form').forEach(function (form) {
    var f = form.elements, msg = $('.msg', form), btn = $('button[type=submit]', form), rep = $('.replying', form), details = form.closest('details');
    var NAME = 'vizesel-ad';
    try { f.u.value = localStorage.getItem(NAME) || ''; } catch (e) {}
    var setReply = function (id, name) {
      f.reply_to.value = id || '';
      rep.hidden = !id;
      if (id) $('span', rep).textContent = name + ' adlı kişiye cevap yazıyorsun.';
    };
    var thread = form.closest('.thread');
    thread.addEventListener('click', function (ev) {
      var b = ev.target.closest('[data-reply]');
      if (b) { setReply(b.dataset.reply, b.dataset.name); details.open = true; f.text.focus(); return; }
      if (ev.target.closest('[data-cancel]')) setReply('', '');
    });
    var ERR = { limit: 'Bugün için yorum sınırına ulaştın, yarın tekrar dene.', short: 'Yorumunu yaz.', notfound: 'Bu paylaşım artık yok.', invalid: 'Gönderilemedi, sayfayı yenileyip tekrar dene.' };
    form.addEventListener('submit', function (ev) {
      ev.preventDefault();
      var text = f.text.value.trim();
      if (text.length < 2) { msg.textContent = ERR.short; return; }
      var mine = null; try { mine = JSON.parse(localStorage.getItem('vizesel-kayit') || 'null'); } catch (e) {}
      var headers = { 'content-type': 'application/json' };
      if (mine && mine.id === form.dataset.entry) headers['x-edit-token'] = mine.token;
      btn.disabled = true; msg.textContent = 'Gönderiliyor…';
      fetch('/api/comments', { method: 'POST', headers: headers,
        body: JSON.stringify({ entry_id: form.dataset.entry, reply_to: f.reply_to.value, u: f.u.value.trim(), text: text, web: f.web.value }) })
        .then(function (res) { return res.json().catch(function () { return {}; }).then(function (o) { if (!res.ok) throw new Error(o.error || 'hata'); return o; }); })
        .then(function () {
          try { if (f.u.value.trim()) localStorage.setItem(NAME, f.u.value.trim()); } catch (e) {}
          f.text.value = ''; setReply('', '');
          msg.textContent = 'Teşekkürler. Yorumun kontrol edildikten sonra burada görünecek.';
        })
        .catch(function (e) { msg.textContent = ERR[e.message] || 'Gönderilemedi, birazdan tekrar dene.'; })
        .then(function () { btn.disabled = false; });
    });
  });

  // Yönetim
  var adm = $('#admin');
  if (adm) {
    var tok = ''; try { tok = sessionStorage.getItem('vz-adm') || ''; } catch (e) {}
    $('#adm-tok').value = tok;
    var api = function (method, body) {
      return fetch('/api/admin', { method: method, headers: { 'x-admin-token': tok, 'content-type': 'application/json' }, body: body ? JSON.stringify(body) : undefined })
        .then(function (r) { if (!r.ok) throw new Error(r.status); return r.json(); });
    };
    var B = function (a, id, label, ghost, danger) {
      return '<button class="btn' + (ghost ? ' btn-ghost' : '') + '" style="min-height:36px' + (danger ? ';color:var(--stamp)' : '') + '" data-a="' + a + '" data-id="' + esc(id) + '">' + label + '</button>';
    };
    var card = function (e) {
      return '<div class="entry"><p class="who"><strong>' + esc(e.u) + '</strong> · ' + esc(e.country) + ' / ' + esc(e.center) + ' · ' + esc(e.cat) + ' · kayıt ' + esc(e.kayit)
        + (e.atama ? ' · atama ' + esc(e.atama) : '') + (e.randevu ? ' · randevu ' + esc(e.randevu) : '') + (e.sonuc ? ' · ' + esc(e.sonuc) : '') + ' · eklendi ' + esc(String(e.created_at).slice(0, 10)) + '</p>'
        + (+e.held ? '<p class="small wait">Hesaba girmedi: ' + esc(e.held_reason || 'kontrol bekliyor') + '</p>' : '')
        + (e.text ? '<p class="txt">' + esc(e.text) + '</p>' : '')
        + '<p class="facts">'
        + (+e.held ? B('release', e.id, 'Tarihleri onayla') : '')
        + (+e.approved ? '' : B('approve', e.id, 'Notu onayla') + B('reject', e.id, 'Notu sil, tarihleri tut', true))
        + B('delete', e.id, 'Kaydı tamamen sil', true, true) + '</p></div>';
    };
    var ccard = function (c) {
      return '<div class="entry"><p class="who"><strong>' + esc(c.u) + '</strong>' + (+c.is_owner ? ' <span class="tag-owner">paylaşım sahibi</span>' : '')
        + ' · ' + esc(String(c.created_at).slice(0, 16)) + ' · paylaşım: ' + esc(c.entry_u || '?') + ', ' + esc(c.center || '?') + ', kayıt ' + esc(c.entry_kayit || '?')
        + (c.reply_to ? ' · bir yoruma cevap' : '') + '</p>'
        + '<p class="txt" style="white-space:pre-line">' + esc(c.text) + '</p><p class="facts">'
        + (+c.approved ? '' : B('c_approve', c.id, 'Yorumu onayla'))
        + B('c_delete', c.id, 'Yorumu sil', true, true)
        + (c.country && c.center ? ' <a class="small" target="_blank" rel="noopener" href="/ulkeler/' + esc(c.country) + '/vize/' + esc(c.center) + '/#p-' + esc(c.entry_id) + '">sayfada gör</a>' : '')
        + '</p></div>';
    };
    var none = '<p class="muted small">Bekleyen yok.</p>';
    var load = function () {
      tok = $('#adm-tok').value.trim(); try { sessionStorage.setItem('vz-adm', tok); } catch (e) {}
      $('#adm-msg').textContent = '…';
      api('GET').then(function (d) {
        var rows = d.entries, cm = d.comments;
        var held = rows.filter(function (r) { return +r.held; });
        var notes = rows.filter(function (r) { return !+r.held && !+r.approved; });
        var cp = cm.filter(function (c) { return !+c.approved; });
        $('#adm-held').innerHTML = held.map(card).join('') || none;
        $('#adm-comments').innerHTML = cp.map(ccard).join('') || none;
        $('#adm-pending').innerHTML = notes.map(card).join('') || none;
        $('#adm-all').innerHTML = rows.filter(function (r) { return !+r.held && +r.approved; }).slice(0, 100).map(card).join('');
        $('#adm-cdone').innerHTML = cm.filter(function (c) { return +c.approved; }).slice(0, 50).map(ccard).join('') || '<p class="muted small">Henüz yok.</p>';
        $('#adm-msg').textContent = rows.length + ' kayıt, ' + cm.length + ' yorum · bekleyen: ' + held.length + ' tarih, ' + cp.length + ' yorum, ' + notes.length + ' not';
      }).catch(function (e) { $('#adm-msg').textContent = e.message === '403' ? 'Anahtar yanlış.' : 'Yüklenemedi.'; });
    };
    $('#adm-go').addEventListener('click', load);
    adm.addEventListener('click', function (ev) {
      var b = ev.target.closest('button[data-a]'); if (!b) return;
      if ((b.dataset.a === 'delete' || b.dataset.a === 'c_delete') && !b.dataset.sure) { b.dataset.sure = '1'; b.textContent = 'Emin misin? Tekrar tıkla'; return; }
      api('POST', { id: b.dataset.id, action: b.dataset.a }).then(load).catch(function () { $('#adm-msg').textContent = 'İşlem başarısız.'; });
    });
    if (tok) load();
  }
})();
