import { json, validate, rand, sha256, rateLimit, publicRow } from "../../_lib.js";

export async function onRequestGet({ env }) {
  const { results } = await env.DB.prepare(
    "SELECT id, center, cat, kayit, atama, randevu, sonuc, u, text, approved, created_at, updated_at FROM entries ORDER BY created_at DESC LIMIT 5000"
  ).all();
  return json(results.map(publicRow), 200, { "cache-control": "public, max-age=60" });
}

export async function onRequestPost({ request, env }) {
  let body; try { body = await request.json(); } catch { return json({ error: "invalid" }, 400); }
  const v = validate(body);
  if (typeof v === "string") return json({ error: v }, v === "spam" ? 200 : 400);
  if (!(await rateLimit(env, request))) return json({ error: "limit" }, 429);
  const id = rand(8), token = rand(16), hash = await sha256(token), now = new Date().toISOString();
  await env.DB.prepare(
    "INSERT INTO entries (id, token_hash, center, cat, kayit, atama, randevu, sonuc, u, text, approved, created_at, updated_at) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)"
  ).bind(id, hash, v.center, v.cat, v.kayit, v.atama, v.randevu, v.sonuc, v.u, v.text, v.text ? 0 : 1, now, now).run();
  return json({ id, token }, 201);
}
