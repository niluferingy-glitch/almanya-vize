<div class="wrap" style="padding-top:40px;padding-bottom:80px;max-width:900px" id="admin">
  <h1 class="h2" style="margin-bottom:16px">Kayıt yönetimi</h1>
  <form class="field" style="flex-direction:row;gap:8px;align-items:center;flex-wrap:wrap;margin-bottom:24px" onsubmit="return false">
    <label class="sr" for="adm-tok">Yönetici anahtarı</label>
    <input type="password" id="adm-tok" placeholder="Yönetici anahtarı" style="max-width:320px">
    <button class="btn" type="button" id="adm-go">Yükle</button>
    <span class="small muted" id="adm-msg"></span>
  </form>
  <h2 style="font-size:16px;font-weight:600;margin:24px 0 8px">Onay bekleyen notlar</h2>
  <div id="adm-pending"></div>
  <h2 style="font-size:16px;font-weight:600;margin:32px 0 8px">Son kayıtlar</h2>
  <div id="adm-all"></div>
</div>
