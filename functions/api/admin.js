import { json, isAdmin } from "../_lib.js";

// GET  /api/admin            -> onay bekleyen ve son kayıtlar
// POST /api/admin {id, action: "approve" | "reject" | "delete"}
export async function onRequestGet({ request, env }) {
  if (!isAdmin(request, env)) return json({ error: "forbidden" }, 403);
  const { results } = await env.DB.prepare(
    "SELECT id, center, cat, kayit, atama, randevu, sonuc, u, text, approved, created_at FROM entries ORDER BY approved ASC, created_at DESC LIMIT 500"
  ).all();
  return json(results);
}

export async function onRequestPost({ request, env }) {
  if (!isAdmin(request, env)) return json({ error: "forbidden" }, 403);
  let b; try { b = await request.json(); } catch { return json({ error: "invalid" }, 400); }
  const id = String(b.id || "");
  if (b.action === "approve") await env.DB.prepare("UPDATE entries SET approved = 1 WHERE id = ?").bind(id).run();
  else if (b.action === "reject") await env.DB.prepare("UPDATE entries SET text = '', approved = 1 WHERE id = ?").bind(id).run();
  else if (b.action === "delete") await env.DB.prepare("DELETE FROM entries WHERE id = ?").bind(id).run();
  else return json({ error: "invalid" }, 400);
  return json({ ok: true });
}
