export const CENTERS = ["İstanbul Gayrettepe","İstanbul Altunizade","İstanbul Beyoğlu","Ankara","İzmir","Antalya","Bursa","Trabzon","Gaziantep","Belirtilmemiş"];
export const CATS = ["turistik","ziyaret","ticari"];
export const SONUC = ["onay","ret"];

export const json = (data, status = 200, headers = {}) =>
  new Response(JSON.stringify(data), { status, headers: { "content-type": "application/json; charset=utf-8", "cache-control": "no-store", ...headers } });

const isDate = (s) => typeof s === "string" && /^\d{4}-\d{2}-\d{2}$/.test(s) && !Number.isNaN(Date.parse(s));
const today = () => new Date().toISOString().slice(0, 10);

// Gelen formu doğrular; hata varsa string, yoksa temiz satır döner.
export function validate(body) {
  if (!body || typeof body !== "object") return "invalid";
  if (body.web) return "spam"; // honeypot
  const { center, cat, kayit } = body;
  if (!CENTERS.includes(center) || !CATS.includes(cat) || !isDate(kayit)) return "invalid";
  const atama = isDate(body.atama) ? body.atama : null;
  const randevu = isDate(body.randevu) ? body.randevu : null;
  const sonuc = SONUC.includes(body.sonuc) ? body.sonuc : null;
  const t = today();
  if (kayit > t || kayit < "2023-01-01") return "invalid";
  if (atama && (atama < kayit || atama > t)) return "invalid";
  if (randevu && randevu < kayit) return "invalid";
  // 3 yıldan uzun bekleme ya da atamadan 1 yıl sonraya randevu: hatalı giriş say
  if (atama && (Date.parse(atama) - Date.parse(kayit)) > 3 * 365 * 864e5) return "invalid";
  if (randevu && atama && (Date.parse(randevu) - Date.parse(atama)) > 365 * 864e5) return "invalid";
  const text = String(body.text || "").replace(/\s+/g, " ").trim().slice(0, 280);
  let u = String(body.u || "").replace(/[^\p{L}\p{N} _.\-]/gu, "").trim().slice(0, 24) || "anonim";
  return { center, cat, kayit, atama, randevu, sonuc, text, u };
}

export const rand = (n = 16) => {
  const b = new Uint8Array(n); crypto.getRandomValues(b);
  return [...b].map((x) => x.toString(16).padStart(2, "0")).join("");
};

export async function sha256(s) {
  const d = await crypto.subtle.digest("SHA-256", new TextEncoder().encode(s));
  return [...new Uint8Array(d)].map((x) => x.toString(16).padStart(2, "0")).join("");
}

// IP özeti + gün: günde en fazla LIMIT ekleme. Özetler 24 saat sonra silinir.
export async function rateLimit(env, request, limit = 3) {
  const ip = request.headers.get("cf-connecting-ip") || "0";
  const day = today();
  const key = await sha256(`${env.SALT || "vize"}:${ip}:${day}`);
  await env.DB.prepare("DELETE FROM limits WHERE day < ?").bind(day).run();
  const row = await env.DB.prepare("SELECT n FROM limits WHERE k = ?").bind(key).first();
  if (row && row.n >= limit) return false;
  await env.DB.prepare("INSERT INTO limits (k, day, n) VALUES (?, ?, 1) ON CONFLICT(k) DO UPDATE SET n = n + 1").bind(key, day).run();
  return true;
}

export const publicRow = (r) => ({
  id: r.id, center: r.center, cat: r.cat, kayit: r.kayit, atama: r.atama, randevu: r.randevu, sonuc: r.sonuc,
  u: r.u, text: r.approved ? r.text : "", at: r.created_at.slice(0, 10), updated: r.updated_at.slice(0, 10),
});

export function isAdmin(request, env) {
  const t = request.headers.get("x-admin-token");
  return !!env.ADMIN_TOKEN && t === env.ADMIN_TOKEN;
}
