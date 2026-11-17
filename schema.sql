-- Vizesel veritabanı (MySQL / MariaDB)
CREATE TABLE IF NOT EXISTS entries (
  id CHAR(16) NOT NULL PRIMARY KEY,
  token_hash CHAR(64) NOT NULL,
  country VARCHAR(40) NOT NULL,
  center VARCHAR(60) NOT NULL,
  cat VARCHAR(20) NOT NULL,
  kayit DATE NOT NULL,
  atama DATE NULL,
  randevu DATE NULL,
  sonuc VARCHAR(10) NULL,
  u VARCHAR(40) NOT NULL DEFAULT 'anonim',
  text VARCHAR(400) NOT NULL DEFAULT '',
  approved TINYINT(1) NOT NULL DEFAULT 1,
  held TINYINT(1) NOT NULL DEFAULT 0,
  held_reason VARCHAR(160) NOT NULL DEFAULT '',
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL,
  KEY idx_country_center (country, center, cat),
  KEY idx_created (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Paylaşımların altındaki yorumlar. Onaylanana kadar görünmez.
CREATE TABLE IF NOT EXISTS comments (
  id CHAR(16) NOT NULL PRIMARY KEY,
  entry_id CHAR(16) NOT NULL,
  reply_to CHAR(16) NULL,
  token_hash CHAR(64) NOT NULL,
  u VARCHAR(40) NOT NULL DEFAULT 'anonim',
  text VARCHAR(1000) NOT NULL,
  is_owner TINYINT(1) NOT NULL DEFAULT 0,
  approved TINYINT(1) NOT NULL DEFAULT 0,
  created_at DATETIME NOT NULL,
  KEY idx_entry (entry_id, approved, created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS limits (
  k CHAR(64) NOT NULL PRIMARY KEY,
  day DATE NOT NULL,
  n INT NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
