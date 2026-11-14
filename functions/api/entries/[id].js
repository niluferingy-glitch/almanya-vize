import { json, validate, sha256, isAdmin } from "../../_lib.js";

async function owns(request, env, id) {
  if (isAdmin(request, env)) return true;
  const token = request.headers.get("x-edit-token") || "";
  if (!token) return false;
  const row = await env.DB.prepare("SELECT token_hash FROM entries WHERE id = ?").bind(id).first();
  return !!row && row.token_hash === (await sha256(token));
}

export async function onRequestPut({ request, env, params }) {
  const id = String(params.id);
  if (!(await owns(request, env, id))) return json({ error: "forbidden" }, 403);
  let body; try { body = await request.json(); } catch { return json({ error: "invalid" }, 400); }
  const v = validate(body);
  if (typeof v === "string") return json({ error: v }, 400);
  const old = await env.DB.prepare("SELECT text, approved FROM entries WHERE id = ?").bind(id).first();
  if (!old) return json({ error: "notfound" }, 404);
  // Metin değiştiyse yeniden onaya düşer
  const approved = v.text === old.text ? old.approved : (v.text ? 0 : 1);
  await env.DB.prepare(
    "UPDATE entries SET center=?, cat=?, kayit=?, atama=?, randevu=?, sonuc=?, u=?, text=?, approved=?, updated_at=? WHERE id=?"
  ).bind(v.center, v.cat, v.kayit, v.atama, v.randevu, v.sonuc, v.u, v.text, approved, new Date().toISOString(), id).run();
  return json({ ok: true });
}

export async function onRequestDelete({ request, env, params }) {
  const id = String(params.id);
  if (!(await owns(request, env, id))) return json({ error: "forbidden" }, 403);
  await env.DB.prepare("DELETE FROM entries WHERE id = ?").bind(id).run();
  return json({ ok: true });
}
