# Portfolio Web & CMS — Alvin Nabil Saputra

Website Portofolio Pribadi & Content Management System (CMS) modern berbasis **Laravel 11 / 12 / 13 & Tailwind CSS**, dirancang khusus untuk mempublikasikan profil pengembang web, proyek unggulan, riwayat pengalaman, keahlian, testimoni, dan artikel catatan teknis dengan standar kompetensi Rekayasa Perangkat Lunak.

---

## 🌟 Fitur Utama

- **Halaman Beranda Interaktif**: Hero personal branding, avatar, tombol aksi (Lihat Portfolio, Lihat CV, Hubungi Saya).
- **Tentang Saya (About)**: Biodata ringkas, riwayat pendidikan, minat teknologi, pengalaman PLK/magang & organisasi, serta cita-cita/tujuan karir.
- **Keahlian (Skills)**: Hard skills & Soft skills dilengkapi visualisasi persentase dan tab filter interaktif.
- **Galeri Proyek**: Proyek unggulan (Ulangan Sekolah SDN TELUK DALAM 3 berbasis CBT online), modal detail komprehensif, fitur, alur proses, peran Full-Stack, link demo live, dan GitHub repository.
- **Pengalaman (Experience)**: Magang UMB Banjarmasin, Tim Modulia, Lomba Jagoan Hosting, dan Pengurus OSIS SMPN 14 Banjarmasin.
- **Testimoni & Kesan**: Ulasan terverifikasi, plus formulir publik bagi pengunjung untuk mengirimkan kesan dan pesan secara langsung.
- **Artikel / Blog**: Catatan pengalaman kerja magang 2 bulan di Universitas Muhammadiyah Banjarmasin (WordPress, kolaborasi rekan magang, mentor, dan Ruby on Rails).
- **CV Digital**: Halaman resume digital siap cetak / unduh format PDF (`/cv-digital`).
- **Mode Gelap & Terang (Dark / Light Mode)**: Dukungan tema adaptif dengan transisi halus dan penyimpanan preferensi lokal.
- **Dwi-Bahasa (Bilingual ID & EN)**: Penggantian bahasa langsung (Indonesia & Inggris).
- **Dashboard Admin CMS**:
  - URL Login: `/admin/masuk`
  - Ringkasan statistik terpadu
  - CRUD Proyek (termasuk upload & opsi hapus gambar)
  - Kelola Testimoni & moderasi persetujuan
  - Kelola Sertifikat & Prestasi
  - Kelola Pengalaman (PLK, Organisasi, Lomba)
  - Kelola Artikel / Catatan Ngoding
  - Kelola Keahlian (Hard Skills & Soft Skills dengan persentase)
  - Kelola Informasi Profil & Biodata tanpa menyentuh kode program
  - Kotak Masuk Pesan & Kesan Pengunjung

---

## 🚀 Panduan Instalasi & Deployment Hosting

Untuk menjalankan atau men-deploy website ini ke server hosting (cPanel, VPS, Cloud Hosting, atau shared hosting):

### 1. Clone Repository & Masuk ke Direktori
```bash
git clone https://github.com/avn20/Portofolio.git
cd Portofolio
```

### 2. Install Dependensi Composer
```bash
composer install --optimize-autoloader --no-dev
```
*(Gunakan `composer install` jika di lingkungan development lokal)*

### 3. Konfigurasi Environment (`.env`)
Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```
Sesuaikan konfigurasi database dan kredensial admin:
```env
APP_NAME="Portfolio Alvin Nabil Saputra"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://domain-anda.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=user_database
DB_PASSWORD=password_database

# Password Login Admin CMS
ADMIN_PASSWORD=admin123
```

### 4. Generate App Key
```bash
php artisan key:generate
```

### 5. Jalankan Migrasi & Database Seeder
Perintah ini akan membuat seluruh tabel dan mengisikan data awal portofolio, keahlian, proyek, pengalaman, artikel, dan pengaturan profil secara otomatis:
```bash
php artisan migrate --seed
```

### 6. Buat Symlink Storage (Jika Mengupload File Baru)
```bash
php artisan storage:link
```

### 7. Optimasi Cache (Opsional untuk Production)
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 🔐 Akses Panel Admin CMS

- **Halaman Login**: `http://domain-anda.com/admin/masuk` (atau klik tautan **⚙ Admin Panel** di bagian footer website).
- **Password Default**: `admin123`
*(Password dapat diubah kapan saja melalui file `.env` pada variabel `ADMIN_PASSWORD`)*

---

## 🧪 Pengujian Otomatis (Unit & Feature Testing)

Website ini dilengkapi dengan suite pengujian otomatis berbasis PHPUnit yang menguji seluruh fungsionalitas publik dan admin:
```bash
php artisan test
```

---

## 👤 Pengembang

**Alvin Nabil Saputra**  
- Email: [alvinnabilsaputraa3@gmail.com](mailto:alvinnabilsaputraa3@gmail.com)  
- GitHub: [github.com/avn20](https://github.com/avn20)  
- Instagram: [@avnns_](https://www.instagram.com/avnns_)  
- Domisili: Banjarmasin, Kalimantan Selatan, Indonesia  
