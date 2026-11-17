// Google Analytics: yalnız çerez onayı verilmişse yüklenir. (Satır içi script yerine ayrı dosya: CSP gereği.)
window.dataLayer = window.dataLayer || [];
function gtag() { dataLayer.push(arguments); }
(function () {
  var el = document.currentScript, id = el && el.getAttribute('data-ga');
  if (!id || !/^G-[A-Z0-9]+$/.test(id)) return;
  window.vzAnalitik = function () {
    if (window.vzGaYuklendi) return;
    window.vzGaYuklendi = true;
    gtag('js', new Date()); gtag('config', id);
    var s = document.createElement('script'); s.async = true;
    s.src = 'https://www.googletagmanager.com/gtag/js?id=' + encodeURIComponent(id);
    document.head.appendChild(s);
  };
  try { if (localStorage.getItem('vz_cerez') === 'kabul') window.vzAnalitik(); } catch (e) {}
})();
