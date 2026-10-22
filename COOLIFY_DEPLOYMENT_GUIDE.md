# Panduan Deployment Coolify (PT. Permana Putra Mandiri)

Aplikasi ini telah dimodernisasi ke **PHP 8 (8.3 - 8.5)** dan telah dikonfigurasi agar dapat langsung di-deploy ke **Coolify** menggunakan **Docker Compose** dengan menghubungkan ke instance **MariaDB Shared / Eksternal**.

Repositori Git telah dioptimalkan khusus untuk kode sumber (**Source Code Only**), sedangkan file media besar (PDF katalog & gambar) dikelola melalui **Docker Persistent Volume** agar proses clone dan redeploy di Coolify super cepat.

---

## 1. Persiapan Database (Shared MariaDB)
Karena aplikasi menggunakan container database MariaDB sharing, pastikan database dan user telah dibuat di server MariaDB Anda:

```sql
CREATE DATABASE IF NOT EXISTS ptppmid_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS 'ptppmid_user'@'%' IDENTIFIED BY 'PasswordKuatAnda';
GRANT ALL PRIVILEGES ON ptppmid_db.* TO 'ptppmid_user'@'%';
FLUSH PRIVILEGES;
```

Impor skema dan data database awal ke database `ptppmid_db`.

---

## 2. Langkah Deployment di Coolify Dashboard

1. **Buka Dashboard Coolify**: Masuk ke project / environment Anda.
2. **Tambah Aplikasi Baru (Add New Resource)**:
   - Pilih **Public / Private Repository** (GitHub).
   - Masukkan Repository URL: `https://github.com/permanacorp/ptppmid.git`.
   - Pilih Branch: `main`.
3. **Pilih Build Pack**:
   - Pilih **Docker Compose**.
   - Coolify akan otomatis mendeteksi file [`docker-compose.yml`](docker-compose.yml) dan [`Dockerfile`](Dockerfile) di root direktori.
4. **Isi Environment Variables di Coolify Dashboard**:
   Buka tab **Environment Variables** pada aplikasi di Coolify, lalu masukkan variabel berikut:

   | Variable | Contoh Nilai | Keterangan |
   |---|---|---|
   | `CI_ENV` | `production` | Mode lingkungan aplikasi |
   | `APP_BASE_URL` | `https://ptppm.id/` | URL publik website (dengan trailing slash) |
   | `ENCRYPTION_KEY` | `95663a0bd72aa3268fc30fa5e7515eaeb21af4143ed4003f5c4bd54ac9c13ff7` | Kunci enkripsi sesi 64 karakter hex |
   | `DB_HOSTNAME` | `mariadb-shared` atau `10.0.0.5` | Hostname / IP MariaDB shared |
   | `DB_PORT` | `3306` | Port MariaDB |
   | `DB_USERNAME` | `ptppmid_user` | User MariaDB |
   | `DB_PASSWORD` | `PasswordKuatAnda` | Password MariaDB |
   | `DB_DATABASE` | `ptppmid_db` | Nama database |
   | `DB_DRIVER` | `mysqli` | Driver database |
   | `SMTP_HOST` | `ssl://smtp.googlemail.com` | Host SMTP |
   | `SMTP_USER` | `info.ptppm@gmail.com` | Akun email pengirim |
   | `SMTP_PASS` | `xxxx xxxx xxxx xxxx` | Google App Password (16 karakter) |
   | `SMTP_PORT` | `465` | Port SMTP SSL |
   | `SMTP_CRYPTO` | `ssl` | Protokol enkripsi mail |
   | `RECAPTCHA_SECRET` | `your_recaptcha_secret_key_here` | Secret Key Google reCAPTCHA v2 |
   | `GOOGLE_MAPS_API_KEY` | `your_google_maps_api_key_here` | API Key Google Maps Javascript (opsional) |

5. **Pengaturan Domain & SSL**:
   - Di tab **General / Domains**, masukkan domain website: `https://ptppm.id` (Coolify / Traefik akan otomatis membuat sertifikat SSL Let's Encrypt).
6. **Klik "Deploy"**:
   - Coolify akan mengunduh repository, melakukan build image Docker, membuat persistent volume, dan menjalankan aplikasi.

---

## 3. Fitur Persistent Storage
File `docker-compose.yml` telah dilengkapi dengan 4 Docker Named Volumes:
- `ptppmid_uploads`: Menyimpan file PDF spesifikasi dan dokumen unduhan.
- `ptppmid_images`: Menyimpan gambar produk, banner slider, berita, dan thumbnail.
- `ptppmid_cache`: Menyimpan sesi user dan cache sistem.
- `ptppmid_logs`: Menyimpan catatan log aplikasi.

Dengan adanya named volume ini, **gambar dan dokumen yang diunggah tidak akan pernah hilang** saat Anda melakukan redeploy atau push pembaruan kode baru ke GitHub.

---

## 4. Cara Menyalin Berkas Media Awal ke Server Coolify

File arsip media telah kami siapkan di lokal Anda dengan nama:
`ptppmid_media_initial.zip` (berisi folder `uploads/` dan `img/` lengkap).

Berikut langkah mudah menyalinnya ke server Coolify (cukup dilakukan **1 kali saja** saat inisialisasi awal):

### Opsi 1: Menggunakan `docker cp` langsung ke container (Paling Mudah)
1. Unggah file `ptppmid_media_initial.zip` ke server VPS Anda menggunakan SCP / SFTP / rsync:
   ```bash
   scp ptppmid_media_initial.zip user@ip-server-anda:/root/
   ```
2. SSH ke server VPS Anda, lalu ekstrak filenya:
   ```bash
   cd /root
   unzip ptppmid_media_initial.zip -d media_temp
   ```
3. Salin isi folder ke container aplikasi yang sedang berjalan di Coolify:
   ```bash
   # Salin PDF katalog/spesifikasi
   docker cp media_temp/uploads/. ptppmid_app:/var/www/html/assets/uploads/

   # Salin gambar produk
   docker cp media_temp/img/. ptppmid_app:/var/www/html/assets/img/

   # Pastikan permission www-data sudah benar
   docker exec -it ptppmid_app chown -R www-data:www-data /var/www/html/assets/uploads /var/www/html/assets/img
   docker exec -it ptppmid_app chmod -R 775 /var/www/html/assets/uploads /var/www/html/assets/img

   # Hapus folder temporary
   rm -rf media_temp ptppmid_media_initial.zip
   ```

### Opsi 2: Menggunakan Host Directory Bind Mount (Alternatif)
Jika Anda lebih menyukai folder fisik langsung di VPS (misalnya `/data/ptppmid/uploads` dan `/data/ptppmid/img`), Anda cukup mengubah bagian `volumes` di `docker-compose.yml` menjadi:
```yaml
    volumes:
      - /data/ptppmid/uploads:/var/www/html/assets/uploads
      - /data/ptppmid/img:/var/www/html/assets/img
      - ptppmid_cache:/var/www/html/application/cache
      - ptppmid_logs:/var/www/html/application/logs
```
Lalu di VPS:
```bash
mkdir -p /data/ptppmid
unzip ptppmid_media_initial.zip -d /data/ptppmid/
chown -R 33:33 /data/ptppmid/   # UID 33 adalah user www-data di Ubuntu/Debian
chmod -R 775 /data/ptppmid/
```

Setelah langkah ini selesai, seluruh gambar dan PDF akan langsung tampil sempurna di website, dan tersimpan permanen di server!
