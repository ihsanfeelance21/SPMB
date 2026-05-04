# Panduan Inisialisasi Awal & Instalasi SPMB

Dokumen ini berisi panduan langkah demi langkah untuk menginisialisasi sistem Penerimaan Murid Baru (SPMB) menggunakan CodeIgniter 4 dan TailwindCSS di Laragon.

## 1. Instalasi CodeIgniter 4 via Composer
Jika belum menginstal CodeIgniter 4, Anda dapat melakukannya dengan perintah berikut di dalam terminal Laragon (`Menu > Terminal`):

```bash
cd c:\laragon\www
composer create-project codeigniter4/appstarter spmb
```
*Catatan: Pastikan ekstensi `intl` dan `mbstring` sudah aktif di PHP Laragon Anda.*

## 2. Konfigurasi Lingkungan (`.env`)
1. Salin file `env` menjadi `.env` di direktori root aplikasi.
2. Ubah beberapa baris konfigurasi berikut:

```ini
# Ubah environment menjadi development untuk melihat pesan error
CI_ENVIRONMENT = development

# Atur Base URL (sesuaikan dengan virtual host Laragon Anda)
app.baseURL = 'http://spmb.test/'

# Konfigurasi Database
database.default.hostname = localhost
database.default.database = spmb_app
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
```

## 3. Menjalankan Database Migrations
Kita telah membuat arsitektur database untuk 7 tabel (users, biodata, orang_tua, akademik, prestasi, berkas_pendukung, settings).
1. Pastikan database `spmb_app` sudah dibuat di MySQL/HeidiSQL.
2. Buka terminal Laragon dan jalankan perintah:

```bash
cd c:\laragon\www\spmb
php spark migrate
```
Perintah ini akan secara otomatis membuat seluruh tabel di dalam database `spmb_app` sesuai urutan referensi relasionalnya (Foreign Key).

## 4. Integrasi Tailwind CSS (Mobile-First)
Kita telah mengonfigurasi proyek ini untuk menggunakan TailwindCSS. Jika Anda mengatur proyek ini di komputer baru, ikuti langkah berikut:

### a. Instalasi Dependencies
Jalankan perintah ini di terminal (pastikan Node.js sudah terinstal di Laragon atau sistem Anda):

```bash
npm install
```

*(Ini akan membaca file `package.json` yang sudah disiapkan dan menginstal TailwindCSS, PostCSS, serta Autoprefixer)*.

### b. Menjalankan Proses Build Tailwind
Selama masa *development* (pembuatan tampilan), jalankan script ini di terminal yang terpisah agar Tailwind memantau perubahan pada file PHP/HTML Anda:

```bash
npm run dev
```

Untuk *production* (saat aplikasi akan dideploy):
```bash
npm run build
```

## 5. Integrasi Fitur PDF (Dompdf)
Untuk fitur *Download Laporan PPDB (PDF)* di panel Admin, kita menggunakan pustaka Dompdf. Karena Composer mungkin tidak terdeteksi secara otomatis di beberapa environment global Laragon, Anda wajib menjalankan perintah berikut melalui terminal Laragon (atau Command Prompt yang sudah mengenali Composer) di dalam direktori `c:\laragon\www\spmb`:

```bash
composer require dompdf/dompdf
```

Jika tidak diinstal, fitur cetak PDF akan menampilkan error class not found.

### c. Menggunakan CSS di Tampilan (Views)
Panggil file CSS hasil build dari Tailwind ke dalam view CodeIgniter Anda (misalnya di `app/Views/layout/default.php`):

```html
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPMB App</title>
    <!-- Memanggil CSS yang digenerate oleh Tailwind -->
    <link rel="stylesheet" href="<?= base_url('css/app.css') ?>">
</head>
<body class="bg-surface-dark text-slate-800 font-sans antialiased">
    <!-- Konten Anda -->
</body>
</html>
```

## 5. Best Practices CodeIgniter 4
1. **Gunakan Entities & Models:** Pisahkan logika bisnis di Model dan representasi data di Entity. Jangan letakkan kueri database langsung di Controller.
2. **Validasi Request:** Selalu gunakan fitur validasi bawaan CI4 (di dalam Controller atau Model) sebelum memproses input dari form.
3. **Gunakan Route Grouping:** Kelompokkan route di `app/Config/Routes.php` (misal: `/admin`, `/user`) dan gunakan Filter untuk proteksi otentikasi.
4. **Hindari Hardcode URL:** Selalu gunakan fungsi `base_url('path')` atau `site_url('path')` untuk mencegah URL rusak saat berpindah server.
5. **Simpan File Upload Aman:** Gunakan folder `writable/uploads` untuk file rahasia/private (seperti file KK/Akte) dan hanya buat route khusus (yang dicek aksesnya) untuk membaca file tersebut. Folder `public/` hanya untuk aset umum (CSS, JS, logo).
