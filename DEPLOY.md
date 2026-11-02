# Deploy UNIK ke mini PC "Unik-Server" (Docker + Nginx + Cloudflare Tunnel)

**Domain:** `unikcomunication.com`  |  **Registrar:** Rumahweb  |  **Folder di server:** `/var/www/unik`

Susunannya:

```
Pengunjung -> Cloudflare -> (Tunnel, koneksi keluar) -> Nginx host 127.0.0.1:8080 -> PHP-FPM (container) 127.0.0.1:9000
```
Nginx memakai yang sudah terpasang di mini PC. Docker hanya menjalankan **PHP-FPM** dan **cloudflared**. Tidak ada port yang dibuka di router.

## Alur

1. **Staging dulu:** domain hidup tapi dikunci (Cloudflare Access) dan belum boleh diindeks Google (`SITE_INDEXABLE=false`).
2. Lengkapi konten, client mengecek.
3. **Go-live.**

---

## 0. Cek kondisi mini PC

```bash
cat /etc/os-release | head -2
docker --version && docker compose version
nginx -v
sudo ss -ltnp | grep -E ':(8080|9000)\b' || echo "port 8080 dan 9000 bebas"
```
Kalau `docker compose` tidak dikenali tapi `docker-compose` ada, ganti semua `docker compose` di panduan ini menjadi `docker-compose`.
Kalau port 8080 sudah dipakai, pakai 8081 (ubah di `deploy/nginx-unik.conf` dan di Public Hostname Cloudflare).

## 1. Domain Rumahweb -> Cloudflare

1. Buat akun Cloudflare (gratis), **Add a site** `unikcomunication.com`, pilih paket **Free**.
2. Cloudflare memindai record DNS yang ada. **Pastikan record email (MX/TXT/SPF) ikut terbaca**, jangan sampai email domain putus. Record email harus berstatus **DNS only** (awan abu-abu).
3. **Hapus record `A`/`CNAME` untuk `@` dan `www`** yang menunjuk ke hosting Rumahweb. Tunnel akan membuat record sendiri, dan record lama bisa bentrok.
4. Cloudflare menampilkan **dua nameserver**. Di Client Area Rumahweb: Domain > kelola domain > **Nameserver** > pilih nameserver kustom > isi dua nameserver Cloudflare. Perubahan butuh beberapa menit sampai 24 jam. Statusnya "Active" di dashboard Cloudflare.

## 2. Siapkan mini PC

```bash
sudo apt update && sudo apt full-upgrade -y
sudo timedatectl set-timezone Asia/Jakarta
sudo apt install -y sqlite3 rsync unattended-upgrades ufw
sudo dpkg-reconfigure -plow unattended-upgrades
```
Firewall. Docker **melewati UFW** untuk port yang dipublikasikan, itu sebabnya `docker-compose.yml` mengikat port PHP hanya ke `127.0.0.1`. Jangan pernah mengubahnya jadi `0.0.0.0`.
```bash
sudo ufw default deny incoming
sudo ufw default allow outgoing
sudo ufw allow from 192.168.0.0/16 to any port 22 proto tcp     # SSH dari jaringan rumah saja
# kalau mini PC juga melayani hal lain di LAN (mis. Nginx port 80), izinkan portnya dari 192.168.0.0/16
sudo ufw enable
```
Agar website hidup terus: BIOS **Restore on AC Power Loss = Power On**, pakai **UPS**, dan matikan mode tidur:
```bash
sudo systemctl mask sleep.target suspend.target hibernate.target hybrid-sleep.target
sudo systemctl enable docker nginx
```

## 3. Kirim project dari Mac

Di Mac, pasang semua kit ke folder project dulu (`unzip -o ...`), lalu:
```bash
rsync -av --exclude .env --exclude vendor --exclude node_modules --exclude .git \
  --exclude 'storage/logs/*' --exclude 'storage/framework/*/*' \
  --rsync-path="sudo rsync" --chown=www-data:www-data \
  ~/Documents/Unik-Web2/ USER@IP-UNIK-SERVER:/var/www/unik/
```
`database/database.sqlite` dan `storage/app/public` ikut terbawa, jadi data dan foto event yang sudah ada tidak hilang.

## 4. Jalankan PHP dan pasang aplikasi (di mini PC)

```bash
cd /var/www/unik
sudo -u www-data cp .env.production.example .env
sudo nano .env                                   # cek APP_URL=https://unikcomunication.com
sudo -u www-data mkdir -p storage/framework/{cache/data,sessions,views} storage/logs storage/app/public bootstrap/cache
sudo -u www-data touch database/database.sqlite   # aman walau sudah ada
sudo -u www-data cp deploy/cloudflared.env.example deploy/cloudflared.env
sudo chmod 600 deploy/cloudflared.env

docker compose build app
docker compose up -d app

A="docker compose exec -T -u www-data app"
$A composer install --no-dev --optimize-autoloader --no-interaction
$A php artisan key:generate --force
$A php artisan migrate --force
$A php artisan storage:link
sudo rm -f public/robots.txt
$A php artisan optimize

sudo chown root:www-data .env && sudo chmod 640 .env     # kunci .env setelah key:generate
```
Kalau mulai dari database kosong (bukan memindahkan data dari Mac):
```bash
$A php artisan db:seed --class=ProjectSeeder
docker compose exec -u www-data app php artisan make:filament-user
```

## 5. Nginx (host)

```bash
sudo cp deploy/nginx-unik.conf /etc/nginx/sites-available/unik
sudo ln -s /etc/nginx/sites-available/unik /etc/nginx/sites-enabled/unik
sudo nginx -t && sudo systemctl reload nginx
curl -s -o /dev/null -w "%{http_code}\n" -H "Host: unikcomunication.com" http://127.0.0.1:8080/
```
Harus tercetak `200`. **Jangan menghapus site Nginx lain** yang sudah ada di mini PC.
**Mode staging:** di `deploy/nginx-unik.conf` hapus tanda `#` di baris `X-Robots-Tag`, lalu `sudo systemctl reload nginx`.

## 6. Cloudflare Tunnel (pakai token)

1. Dashboard Cloudflare > **Zero Trust** > **Networks > Tunnels** > **Create a tunnel** > **Cloudflared** > nama `unik-web`.
2. Salin **token** dari perintah instalasi yang ditampilkan (teks panjang setelah `--token` atau `service install`).
3. Di mini PC: `sudo nano /var/www/unik/deploy/cloudflared.env`, ganti isinya menjadi `TUNNEL_TOKEN=<token>`.
4. Jalankan dan cek:
```bash
cd /var/www/unik && docker compose up -d cloudflared
docker compose logs --tail 20 cloudflared        # harus ada "Registered tunnel connection"
```
5. Di dashboard tunnel > **Public Hostname**, tambahkan dua entri:
   - `unikcomunication.com` -> Type **HTTP** -> URL `127.0.0.1:8080`
   - `www.unikcomunication.com` -> Type **HTTP** -> URL `127.0.0.1:8080`
   Cloudflare membuat record DNS-nya otomatis.

## 7. Setelan Cloudflare

- SSL/TLS: **Always Use HTTPS** aktif.
- Security: **Bot Fight Mode** aktif, WAF managed rules aktif.
- Speed: **Brotli** aktif.
- Rules > Redirect Rules: `www.unikcomunication.com/*` -> `https://unikcomunication.com/${1}` (301). Satu alamat resmi bagus untuk SEO.

## 8. Cloudflare Access (gratis sampai 50 pengguna)

Zero Trust > Access > Applications > Add > **Self-hosted**:
- **Aplikasi 1 (permanen):** domain `unikcomunication.com`, path `admin*`. Policy Allow, email admin saja, metode **One-time PIN**.
- **Aplikasi 2 (hanya staging):** domain `unikcomunication.com` tanpa path. Allow email tim dan client. **Hapus saat go-live.**

## 9. Periksa sebelum go-live

Nginx memakai `server_name` ketat, jadi tes lokal memakai nama domain:
```bash
echo "127.0.0.1 unikcomunication.com" | sudo tee -a /etc/hosts
cd /var/www/unik && ./deploy/preflight.sh http://unikcomunication.com:8080
```
Semua **[FAIL]** harus nol, dan baca setiap **[WARN]**. Setelah selesai, hapus baris itu dari `/etc/hosts`.
Lalu uji **mati-hidup**: `sudo reboot`, tunggu beberapa menit, dan pastikan `docker compose ps` menunjukkan `app` dan `cloudflared` berjalan serta website terbuka sendiri.

## 10. Go-live

1. Preflight tanpa [FAIL].
2. Hapus Aplikasi 2 di Cloudflare Access (sisakan `admin*`).
3. Nginx: beri `#` lagi di baris `X-Robots-Tag`, lalu `sudo systemctl reload nginx`.
4. `.env`: `SITE_INDEXABLE=true`, lalu:
   `docker compose exec -T -u www-data app php artisan optimize:clear && docker compose exec -T -u www-data app php artisan optimize`
5. Jalankan preflight dari luar: `./deploy/preflight.sh https://unikcomunication.com`.
6. **Google Search Console:** properti **Domain**, verifikasi lewat TXT di DNS Cloudflare, kirim `https://unikcomunication.com/sitemap.xml`, lalu "Request indexing" untuk beranda dan 2-3 halaman event.
7. Klaim **Google Business Profile**, daftar **Bing Webmaster Tools**, tambahkan semua profil sosial ke `same_as` di `config/seo.php`.
8. Uji dengan Rich Results Test dan PageSpeed Insights.

## 11. Perawatan

- **Backup harian:** `sudo mkdir -p /var/backups/unik`, lalu `sudo crontab -e` dan tambahkan
  `0 3 * * * /var/www/unik/deploy/backup.sh >> /var/log/unik-backup.log 2>&1`.
  Salin folder backup ke disk lain atau cloud secara berkala. **Uji restore sekali.**
- **Update kode:** kirim ulang lewat rsync, lalu `./deploy/update.sh` di mini PC.
- **Mengubah file `config/*.php`:** jalankan `optimize:clear` lalu `optimize` (perintah di langkah 10 nomor 4).
- **Update container:** sebulan sekali `docker compose pull cloudflared && docker compose build --pull app && docker compose up -d`.
- **Monitoring:** UptimeRobot (gratis) untuk `https://unikcomunication.com` tiap 5 menit dengan notifikasi.
- **Log:** `docker compose logs --tail 50 app`, dan `storage/logs/` (disimpan 14 hari).

## Masalah umum

| Gejala | Penyebab biasa |
|---|---|
| 502 dari Nginx | container `app` mati. Cek `docker compose ps` dan `docker compose up -d app` |
| Cloudflare error 1033 / 502 | tunnel mati atau Nginx tidak mendengarkan di `127.0.0.1:8080`. Cek `docker compose logs cloudflared` dan `curl -H "Host: unikcomunication.com" http://127.0.0.1:8080/` |
| Halaman 500 | izin folder (`sudo chown -R www-data:www-data storage bootstrap/cache database`), `APP_KEY` kosong, atau lihat `storage/logs` |
| Foto 404 di `/storage/...` | `php artisan storage:link` belum dijalankan |
| Upload foto gagal | `client_max_body_size` (Nginx) atau `upload_max_filesize` (`deploy/php-unik.ini`) terlalu kecil. Setelah mengubah ini: `docker compose restart app` |
| Gambar diblokir (mixed content) | `fastcgi_param HTTPS on` hilang dari Nginx |
| Login admin ditolak (403) | `canAccessPanel` belum dipasang di `app/Models/User.php` |
| Perubahan teks tidak muncul | `optimize:clear` lalu `optimize` |
