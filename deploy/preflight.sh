#!/usr/bin/env bash
# Pemeriksa kesiapan sebelum go-live.
# Jalankan dari folder project:   ./deploy/preflight.sh https://domain-kamu.com
# (tanpa argumen = memeriksa http://127.0.0.1:8000)
BASE="${1:-http://127.0.0.1:8000}"; BASE="${BASE%/}"
PASS=0; WARN=0; FAIL=0
ok(){   echo "  [PASS] $1"; PASS=$((PASS+1)); }
warn(){ echo "  [WARN] $1"; WARN=$((WARN+1)); }
bad(){  echo "  [FAIL] $1"; FAIL=$((FAIL+1)); }
env_get(){ grep -E "^$1=" .env 2>/dev/null | tail -1 | cut -d= -f2- | sed -e 's/[[:space:]]*#.*$//' -e 's/^"//' -e 's/"$//' -e "s/^'//" -e "s/'$//"; }
perm(){ stat -c %a "$1" 2>/dev/null || stat -f %Lp "$1" 2>/dev/null; }
T="$(mktemp -d)"; trap 'rm -rf "$T"' EXIT
get(){ curl -sS -m 25 -o "$T/body" -D "$T/hdr" -w '%{http_code}' "$1" 2>/dev/null || echo 000; }
hdr(){ tr -d '\r' < "$T/hdr" | grep -i "^$1:" | head -1; }

echo "UNIK preflight -> $BASE"
echo
echo "== 1. Konfigurasi (.env)"
if [ ! -f .env ]; then bad ".env tidak ditemukan. Jalankan dari folder project."; else
  [ "$(env_get APP_DEBUG)" = "false" ] && ok "APP_DEBUG=false" || bad "APP_DEBUG harus false (kalau true, error membocorkan isi server)"
  [ "$(env_get APP_ENV)" = "production" ] && ok "APP_ENV=production" || warn "APP_ENV bukan production"
  [ -n "$(env_get APP_KEY)" ] && ok "APP_KEY terisi" || bad "APP_KEY kosong (php artisan key:generate)"
  URL="$(env_get APP_URL)"
  case "$URL" in
    https://*) ok "APP_URL memakai https ($URL)";;
    *) bad "APP_URL harus https://domain-kamu.com (sekarang: ${URL:-kosong}). Canonical dan sitemap memakai nilai ini";;
  esac
  case "$URL" in *localhost*|*127.0.0.1*|*trycloudflare*|*GANTI*) bad "APP_URL masih alamat sementara: $URL";; esac
  [ "$(env_get SESSION_SECURE_COOKIE)" = "true" ] && ok "SESSION_SECURE_COOKIE=true" || warn "SESSION_SECURE_COOKIE sebaiknya true"
  if [ "$(env_get SITE_INDEXABLE)" = "true" ]; then ok "SITE_INDEXABLE=true (mode go-live: boleh diindeks Google)"; else warn "SITE_INDEXABLE bukan true: mode STAGING (robots Disallow + noindex). Ubah ke true saat go-live"; fi
  P="$(perm .env)"; case "$P" in 600|640|400|440) ok ".env permission $P";; *) warn ".env permission $P (sebaiknya 640 atau 600)";; esac
fi

echo
echo "== 2. File dan folder"
[ -f public/index.php ] && ok "public/index.php ada" || bad "public/index.php hilang"
[ -e public/storage ] && ok "public/storage (storage:link) ada" || bad "public/storage belum ada: php artisan storage:link"
[ -f public/robots.txt ] && bad "public/robots.txt masih ada (menimpa robots.txt otomatis). Hapus: rm public/robots.txt" || ok "tidak ada public/robots.txt statis"
[ -d vendor ] && ok "folder vendor ada" || bad "vendor belum ada: composer install --no-dev"
if [ "$(env_get DB_CONNECTION)" = "sqlite" ]; then
  DB="$(env_get DB_DATABASE)"; [ -z "$DB" ] && DB="database/database.sqlite"
  [ -f "$DB" ] && ok "database SQLite ada ($DB)" || bad "file database tidak ditemukan: $DB"
  [ -f "$DB" ] && { P="$(perm "$DB")"; case "$P" in *[2367]) warn "database dapat ditulis semua pengguna (permission $P)";; *) ok "permission database $P";; esac; }
fi
[ -L .git ] || [ -d .git ] && [ -f .gitignore ] && { grep -q "^/\?\.env$" .gitignore && ok ".env ada di .gitignore" || warn ".env belum ada di .gitignore (jangan sampai ke GitHub)"; }

echo
echo "== 3. Halaman utama ($BASE/)"
C="$(get "$BASE/")"
if [ "$C" = "000" ]; then bad "tidak bisa terhubung ke $BASE"; echo; echo "Hasil: $PASS lolos, $WARN peringatan, $FAIL gagal"; exit 1; fi
[ "$C" = "200" ] && ok "HTTP 200" || bad "HTTP $C (seharusnya 200)"
cp "$T/body" "$T/home"; cp "$T/hdr" "$T/home.hdr"
[ "$(grep -o '<title>' "$T/home" | wc -l | tr -d ' ')" = "1" ] && ok "tepat satu <title>" || bad "jumlah <title> bukan 1"
grep -q '<meta name="description"' "$T/home" && ok "meta description ada" || bad "meta description tidak ada"
CAN="$(grep -o '<link rel="canonical" href="[^"]*"' "$T/home" | head -1 | sed 's/.*href="//;s/"//')"
[ -n "$CAN" ] && ok "canonical: $CAN" || bad "canonical tidak ada"
case "$CAN" in *localhost*|*127.0.0.1*|*trycloudflare*) bad "canonical menunjuk alamat sementara";; esac
grep -q 'application/ld+json' "$T/home" && ok "structured data (JSON-LD) ada" || bad "JSON-LD tidak ada"
grep -q 'property="og:image"' "$T/home" && ok "og:image ada" || warn "og:image tidak ada"
[ "$(grep -o '<h1' "$T/home" | wc -l | tr -d ' ')" = "1" ] && ok "tepat satu <h1>" || warn "jumlah <h1> bukan 1"
NOALT="$(grep -o '<img[^>]*>' "$T/home" | grep -v 'alt=' | wc -l | tr -d ' ')"; [ "$NOALT" = "0" ] && ok "semua gambar punya alt" || warn "$NOALT gambar tanpa alt"
if grep -Eq '(127\.0\.0\.1|localhost|trycloudflare)' "$T/home"; then bad "HTML memuat alamat sementara (localhost/127.0.0.1/trycloudflare)"; else ok "tidak ada alamat sementara di HTML"; fi
MIX="$(grep -Eo '(src|href)="http://[^"]*"' "$T/home" | grep -v 'w3.org' | wc -l | tr -d ' ')"; [ "$MIX" = "0" ] && ok "tidak ada aset http:// (mixed content)" || bad "$MIX aset memakai http:// (akan diblokir browser di HTTPS)"
grep -Eqi 'whoops|stack trace|illuminate\\' "$T/home" && bad "halaman memuat jejak error"

echo
echo "== 4. Header keamanan"
cp "$T/home.hdr" "$T/hdr"
for h in X-Content-Type-Options X-Frame-Options Referrer-Policy Content-Security-Policy; do
  [ -n "$(hdr $h)" ] && ok "$h ada" || warn "$h tidak ada (atur di Nginx: deploy/nginx-unik.conf)"
done
case "$BASE" in https://*) [ -n "$(hdr Strict-Transport-Security)" ] && ok "HSTS ada" || warn "Strict-Transport-Security tidak ada";; esac
SRV="$(hdr Server)"; echo "$SRV" | grep -Eq '[0-9]+\.[0-9]+' && warn "header Server membocorkan versi: $SRV" || ok "header Server tidak membocorkan versi"
[ -n "$(hdr X-Powered-By)" ] && warn "X-Powered-By tampil (matikan expose_php dan fastcgi_hide_header)" || ok "tidak ada X-Powered-By"

echo
echo
echo "== 5. robots.txt dan sitemap.xml"
C="$(get "$BASE/robots.txt")"; [ "$C" = "200" ] && ok "robots.txt HTTP 200" || bad "robots.txt HTTP $C"
if [ "$(env_get SITE_INDEXABLE)" = "true" ]; then
  grep -q 'Sitemap:' "$T/body" && ok "robots.txt menunjuk ke sitemap" || bad "robots.txt tidak memuat Sitemap:"
  grep -q 'Disallow: /admin' "$T/body" && ok "robots.txt memblokir /admin" || warn "robots.txt tidak memblokir /admin"
else
  grep -q '^Disallow: /$' "$T/body" && ok "mode staging: robots.txt memblokir semua" || warn "SITE_INDEXABLE bukan true tapi robots.txt belum memblokir semua"
fi
C="$(get "$BASE/sitemap.xml")"; [ "$C" = "200" ] && ok "sitemap.xml HTTP 200" || bad "sitemap.xml HTTP $C"
LOCS="$(grep -o '<loc>' "$T/body" | wc -l | tr -d ' ')"; [ "$LOCS" -ge 2 ] && ok "sitemap berisi $LOCS URL" || bad "sitemap hampir kosong ($LOCS URL)"
grep -Eq '(127\.0\.0\.1|localhost|trycloudflare)' "$T/body" && bad "sitemap memuat alamat sementara"
EV="$(grep -o '<loc>[^<]*/events/[^<]*</loc>' "$T/body" | head -1 | sed 's/<[^>]*>//g;s#https\?://[^/]*##')"

echo
echo "== 6. Halaman event"
if [ -n "$EV" ]; then
  C="$(get "$BASE$EV")"; [ "$C" = "200" ] && ok "$EV HTTP 200" || bad "$EV HTTP $C"
  grep -q 'rel="canonical"' "$T/body" && ok "canonical ada" || bad "canonical tidak ada"
  grep -q 'BreadcrumbList' "$T/body" && ok "breadcrumb JSON-LD ada" || warn "breadcrumb JSON-LD tidak ada"
else
  warn "belum ada halaman event di sitemap (tambahkan event dari admin)"
fi

echo
echo "== 7. Keamanan akses"
for path in /.env /.git/config /composer.json /vendor/autoload.php /storage/../.env /artisan; do
  C="$(get "$BASE$path")"
  case "$C" in 403|404) ok "$path -> $C";; *) bad "$path -> $C (seharusnya 403/404, file sensitif bisa terbaca)";; esac
done
C="$(get "$BASE/halaman-yang-tidak-ada-xyz")"
[ "$C" = "404" ] && ok "halaman tak dikenal -> 404" || bad "halaman tak dikenal -> $C (seharusnya 404)"
grep -Eqi 'whoops|stack trace|illuminate\\|vendor/' "$T/body" && bad "halaman 404 membocorkan detail teknis" || ok "halaman 404 bersih"
C="$(get "$BASE/admin")"; case "$C" in 200|301|302|401|403) ok "/admin merespons ($C)";; *) warn "/admin -> $C";; esac

echo
echo "== 8. Gambar utama"
for src in $(grep -Eo 'src="/[^"]+\.(jpg|jpeg|png|webp)"' "$T/home" | sed 's/src="//;s/"//' | sort -u | head -4); do
  C="$(get "$BASE$src")"; [ "$C" = "200" ] && ok "$src 200" || bad "$src -> $C"
done

echo
echo "================================================"
echo "Hasil: $PASS lolos, $WARN peringatan, $FAIL gagal"
[ "$FAIL" = "0" ] && echo "Tidak ada kegagalan. Tinjau peringatan di atas sebelum go-live." || echo "Perbaiki semua [FAIL] sebelum go-live."
[ "$FAIL" = "0" ]
