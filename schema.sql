CREATE TABLE IF NOT EXISTS entries (
  id TEXT PRIMARY KEY,
  token_hash TEXT NOT NULL,
  center TEXT NOT NULL,
  cat TEXT NOT NULL,
  kayit TEXT NOT NULL,
  atama TEXT,
  randevu TEXT,
  sonuc TEXT,
  u TEXT NOT NULL DEFAULT 'anonim',
  text TEXT NOT NULL DEFAULT '',
  approved INTEGER NOT NULL DEFAULT 1,
  created_at TEXT NOT NULL,
  updated_at TEXT NOT NULL
);
CREATE INDEX IF NOT EXISTS idx_entries_center_cat ON entries (center, cat);
CREATE INDEX IF NOT EXISTS idx_entries_created ON entries (created_at);

CREATE TABLE IF NOT EXISTS limits (
  k TEXT PRIMARY KEY,
  day TEXT NOT NULL,
  n INTEGER NOT NULL DEFAULT 0
);
