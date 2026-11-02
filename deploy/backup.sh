#!/usr/bin/env bash
# Backup harian: database SQLite, foto upload, dan .env. Simpan 14 hari terakhir.
# Cron (jam 03:00):  0 3 * * * /var/www/unik/deploy/backup.sh >> /var/log/unik-backup.log 2>&1
set -euo pipefail

APP="${APP_DIR:-/var/www/unik}"
DEST="${BACKUP_DIR:-/var/backups/unik}"
STAMP="$(date +%F)"
OUT="$DEST/$STAMP"
mkdir -p "$OUT"

DB="$APP/database/database.sqlite"
if [ -f "$DB" ]; then
  if command -v sqlite3 >/dev/null 2>&1; then
    sqlite3 "$DB" ".backup '$OUT/database.sqlite'"
  else
    cp "$DB" "$OUT/database.sqlite"
  fi
fi

tar -czf "$OUT/uploads.tar.gz" -C "$APP/storage/app" public
cp "$APP/.env" "$OUT/env.backup"
chmod 600 "$OUT/env.backup"

# hapus backup lebih dari 14 hari
find "$DEST" -mindepth 1 -maxdepth 1 -type d -mtime +14 -exec rm -rf {} +

# Opsional: salin ke tempat lain (disk eksternal / NAS / cloud) supaya tidak hanya ada di satu mesin
# rsync -a "$DEST/" user@host:/path/backup-unik/

echo "$(date -Is) backup OK -> $OUT"
