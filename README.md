# Sistem Penerimaan Murid Baru (SPMB) SMA

Aplikasi Sistem Penerimaan Murid Baru (SPMB) berbasis web modern untuk memudahkan proses pendaftaran, verifikasi, dan seleksi calon siswa baru di tingkat Sekolah Menengah Atas (SMA). Dibangun menggunakan CodeIgniter 4 dan TailwindCSS, sistem ini dirancang dengan antarmuka yang bersih (_clean layout_), responsif (_mobile-first_), dan aman.

---

## Tentang Pengembang

Proyek ini dikembangkan dengan keterlibatan saya sebagai **Junior Programmer**. Dalam pembuatan sistem SPMB ini, tanggung jawab dan kontribusi saya meliputi:

- **Pengembangan Frontend:** Menerjemahkan desain UI/UX menjadi antarmuka yang fungsional dan responsif menggunakan TailwindCSS dan Alpine.js/Vanilla JS.
- **Implementasi Backend & Routing:** Mengonfigurasi _routes_, merancang _Controllers_, dan memastikan alur data berjalan sesuai dengan _best practices_ CodeIgniter 4.
- **Manajemen Database:** Membuat _Migration_ dan _Seeder_ untuk membangun struktur _database_ yang relasional dan efisien.
- **Integrasi Fitur Utama:** Mengimplementasikan sistem autentikasi, manajemen sesi, _upload_ dokumen yang aman, serta integrasi pustaka pihak ketiga seperti Dompdf untuk pelaporan.

---

## Tech Stack

- **Backend:** CodeIgniter 4 (PHP Framework)
- **Frontend:** TailwindCSS (Utility-first CSS Framework), Alpine.js / Vanilla JS
- **Database:** MySQL
- **Local Development Environment:** Laragon v8
- **PDF Generator:** Dompdf

---

## Fitur Utama

### Akses Pendaftar (User)

- **Autentikasi Aman:** Pendaftaran menggunakan KTP/KK (NIK/NISN unik), Login dengan `password_hash()`, dan fitur Lupa Password.
- **Dashboard Interaktif:** _Countdown_ pendaftaran dan _progress bar_ kelengkapan data.
- **Manajemen Biodata:** Pengisian Data Diri, Data Orang Tua/Wali, dan Data Akademik.
- **Multi-upload Dinamis:** Unggah pas foto, rapor, ijazah, SKKB, dan dokumen pendukung lainnya (KK, PKH, KIP, Akte) dengan validasi ukuran file maksimal 2MB.
- **Form Prestasi Dinamis:** Pendaftar dapat menambahkan lebih dari 5 prestasi akademik/non-akademik.
- **Status Pendaftaran:** Cek status kelulusan dan instruksi daftar ulang.

### Akses Administrator & Superadmin

- **Dashboard Analitik:** Grafik pendaftar harian (Chart.js), notifikasi _pending_, dan _countdown_.
- **Verifikasi & Seleksi:** _Approve/Reject_ akun baru dan seleksi kelulusan calon siswa.
- **Rekapitulasi Laporan:** Cetak dan _download_ laporan PPDB dalam format PDF.
- **Manajemen Sistem:** Ubah pengaturan _timeline_ pendaftaran, tahun pelajaran, logo, dan nama sekolah.
- **Manajemen Akun:** Tambah admin baru secara manual, ubah _password_, dan _reset password_ pendaftar.
- **Utilitas Backup/Restore:** Amankan data dengan mengunduh `.sql` dan pulihkan data langsung dari _dashboard_.
- **Proteksi Superadmin:** Akun superadmin tidak dapat dihapus, dan hanya superadmin yang dapat menghapus akun berlevel admin.

---

## Persyaratan Sistem

Sebelum menjalankan aplikasi, pastikan sistem Anda memiliki:

- **Laragon v8** (atau web server lain seperti XAMPP)
- **PHP** versi 8.1 atau lebih baru (Pastikan ekstensi `intl` dan `mbstring` sudah aktif di pengaturan PHP Laragon Anda)
- **Composer** (untuk instalasi _library_ CodeIgniter 4 dan Dompdf)
- **Node.js & NPM** (untuk _build_ TailwindCSS)
- **MySQL** versi 5.7 atau lebih baru

---

## Panduan Instalasi (Localhost)

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di _local server_ (Laragon):

### 1. Persiapan Direktori & Repository

Kloning atau _extract_ proyek ini ke dalam folder _document root_ Laragon Anda:

```bash
cd C:\laragon\www
git clone https://github.com/ihsanfeelance21/SPMB.git
cd SPMB
```

### 2. Instalasi Dependensi PHP & Dompdf

Jalankan perintah Composer untuk mengunduh CodeIgniter 4 dan menginstal library Dompdf untuk fitur cetak PDF:

```bash
composer install
composer require dompdf/dompdf
```

### 3. Konfigurasi Environment (.env)

Salin file env bawaan CI4 menjadi .env:

```bash
cp env .env
```

Buka file .env dan sesuaikan baris berikut:

```bash
CI_ENVIRONMENT = development

# Konfigurasi URL Localhost

app.baseURL = 'http://localhost:8080/'

# Konfigurasi Database

database.default.hostname = localhost
database.default.database = spmb_app
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
```

### 4. Setup Database & Migrasi

1. Buka MySQL (melalui HeidiSQL bawaan Laragon atau phpMyAdmin) dan buat database kosong dengan nama spmb_app.

2. Buka terminal, jalankan perintah migrasi untuk membuat seluruh tabel (users, biodata, orang_tua, akademik, prestasi, berkas_pendukung, settings):

```bash
php spark migrate
```

3. Jalankan Seeder untuk membuat akun Superadmin default dan data Pengaturan awal:

```bash
php spark db:seed SuperadminSeeder
```

### 5. Build TailwindCSS (Opsional/Jika diubah)

1. Instal dependensi Node.js (TailwindCSS, PostCSS, Autoprefixer):

```bash
npm install
```

2. Untuk memantau perubahan CSS selama masa development, jalankan:

```bash
npm run dev
```

3. Untuk tahap production (saat aplikasi akan dideploy):

```bash
npm run build
```

Catatan: Pastikan CSS yang di-generate oleh Tailwind dipanggil di file master layout/view Anda dengan <?= base_url('css/app.css') ?>.

### 6. Jalankan Server Lokal

Gunakan server bawaan CodeIgniter 4 untuk menjalankan aplikasi:

```bash
php spark serve --port 8080
```

Buka browser Anda dan akses: http://localhost:8080

## Kredensial Default (Superadmin)

Setelah menjalankan seeder di atas, Anda dapat masuk ke Dashboard menggunakan kredensial berikut:

- URL Akses: http://localhost:8080/ (Halaman Login Utama)

- Email: superadmin@app.com

- Password: superadmin123
  (Penting: Segera ganti password ini melalui menu Manajemen Akun setelah berhasil login pertama kali)

## Struktur Direktori Penting

- app/Controllers/: Logika bisnis.

- app/Models/ & app/Entities/: Representasi data dan kueri database.

- app/Filters/: Middleware keamanan (AuthGuard, RoleGuard).

- app/Config/Routes.php: Pengelompokan rute (Route Grouping) aplikasi.

- app/Views/layouts/: Master template untuk antarmuka (admin_layout.php, user_layout.php, auth_layout.php).

- app/Views/layouts/components/: Komponen parsial seperti Sidebar dan Topbar.

- public/uploads/: Folder penyimpanan file yang diunggah.

- writable/uploads/: Folder penyimpanan file yang bersifat rahasia/private (KK, Akte, dll). Route khusus diperlukan untuk mengaksesnya.

- tailwind.config.js: Konfigurasi warna, font, dan breakpoints responsif aplikasi.

- public/: Direktori aset publik (CSS, JS, logo) dan file yang tidak sensitif.

## Keamanan

Aplikasi ini menerapkan standar keamanan best practice:

- Password Hashing: Menggunakan algoritma bcrypt bawaan PHP (password_hash dan password_verify).

- Session Hijacking Prevention: Mengaktifkan session()->regenerate() setiap kali user berhasil login.

- Cross-Site Request Forgery (CSRF): Semua form POST dilindungi dengan token <?= csrf_field() ?>.

- Validasi File: Pembatasan ketat tipe MIME (jpg, png, pdf) dan ukuran maksimum 2MB untuk mencegah upload skrip berbahaya.

- Pemisahan Logika (MVC): Menggunakan Entities & Models untuk manajemen basis data. Kueri tidak diletakkan langsung di dalam Controller.

- Route Grouping & Filter: Pengelompokan rute yang dilindungi secara ketat oleh Filter middleware untuk memisahkan hak akses Pendaftar, Admin, dan Superadmin.

- URL Dinamis: Menghindari hardcode URL dengan selalu menggunakan base_url() atau site_url().

- Manajemen File Aman: Berkas sensitif yang diunggah disimpan di folder writable/uploads/ yang tidak dapat diakses langsung secara publik, melainkan melalui rute yang divalidasi.

# Kontribusi

Jika Anda ingin berkontribusi pada proyek ini, silakan lakukan Fork repository ini, buat branch baru, dan ajukan Pull Request.
