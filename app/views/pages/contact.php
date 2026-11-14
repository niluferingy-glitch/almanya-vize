<div class="narrow" style="padding-top:40px;padding-bottom:96px">
  <?= crumbs_html($crumbs) ?>
  <h1 class="h1" style="margin-bottom:16px">İletişim</h1>
  <p class="lead" style="margin-bottom:32px">Düzeltme, öneri ya da kayıt silme talebi için e-posta gönderebilirsin.</p>
  <div class="box box-paper" style="margin-bottom:32px">
    <p class="small muted" style="margin-bottom:4px">E-posta</p>
    <p style="font-size:var(--fs-4);font-weight:600"><a href="mailto:<?= h(cfg('contact_email')) ?>"><?= h(cfg('contact_email')) ?></a></p>
  </div>
  <div class="prose">
    <p>Kayıt silme talebinde kaydı bulabilmemiz için merkezi, kategoriyi ve kayıt tarihini yazman yeterli. Ad ya da pasaport bilgisi gönderme.</p>
    <p>Vizesel resmî bir kurum değildir ve başvurular hakkında bilgi veremez. Başvurunla ilgili sorular için <a href="https://www.idata.com.tr/" rel="noopener" target="_blank">iDATA</a> ve <a href="https://tuerkei.diplo.de/" rel="noopener" target="_blank">Almanya'nın Türkiye'deki temsilcilikleri</a> ile iletişime geçmen gerekir.</p>
  </div>
</div>
