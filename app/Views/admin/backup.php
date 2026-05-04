<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>

<div class="mb-6 border-b border-slate-100 pb-4">
    <h2 class="text-xl font-bold text-slate-800">Utilitas Backup & Restore</h2>
    <p class="text-sm text-slate-500 mt-1">Lakukan pencadangan (backup) database secara berkala untuk mencegah kehilangan data. Berhati-hatilah saat menggunakan fitur Restore.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    
    <!-- Backup Section -->
    <div class="card p-6 border-t-4 border-t-brand">
        <div class="flex items-start mb-4">
            <div class="bg-brand-light text-brand p-3 rounded-xl mr-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-slate-800">Backup Database</h3>
                <p class="text-sm text-slate-500 mt-1">Unduh seluruh struktur dan data aplikasi SPMB ke dalam format <code class="bg-slate-100 px-1 py-0.5 rounded text-xs text-rose-500">.sql</code>.</p>
            </div>
        </div>
        
        <div class="bg-slate-50 p-4 rounded-xl border border-slate-200 mb-6 text-sm text-slate-600">
            <strong>Informasi:</strong> Proses ini akan mengekspor seluruh tabel (users, biodata, prestasi, akademik, dll). Waktu eksekusi bergantung pada seberapa besar data Anda saat ini.
        </div>

        <a href="<?= base_url('admin/backup/download') ?>" class="w-full btn-primary bg-brand hover:bg-brand-dark justify-center !py-3 !text-base">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
            Download File SQL Sekarang
        </a>
    </div>

    <!-- Restore Section -->
    <div class="card p-6 border-t-4 border-t-rose-500 relative overflow-hidden">
        <div class="flex items-start mb-4">
            <div class="bg-rose-100 text-rose-600 p-3 rounded-xl mr-4 relative z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
            </div>
            <div class="relative z-10">
                <h3 class="text-lg font-bold text-slate-800">Restore Database</h3>
                <p class="text-sm text-slate-500 mt-1">Pulihkan sistem menggunakan file <code class="bg-slate-100 px-1 py-0.5 rounded text-xs text-rose-500">.sql</code> yang pernah Anda unduh.</p>
            </div>
        </div>

        <!-- Warning Alert -->
        <div class="bg-rose-50 border border-rose-200 p-4 rounded-xl mb-6 relative z-10">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-rose-600 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                <div>
                    <h4 class="text-sm font-bold text-rose-800">PERINGATAN KERAS!</h4>
                    <p class="text-xs text-rose-700 mt-1">Proses restore akan <strong>MENGHAPUS SEMUA DATA SAAT INI</strong> dan menimpanya dengan data dari file yang Anda unggah. Pastikan file SQL berasal dari sumber yang valid (backup dari sistem ini).</p>
                </div>
            </div>
        </div>

        <form action="<?= base_url('admin/backup/restore') ?>" method="POST" enctype="multipart/form-data" class="relative z-10" id="restoreForm">
            <?= csrf_field() ?>
            <div class="mb-6">
                <label class="block text-sm font-bold text-slate-700 mb-2">Upload File SQL</label>
                <input type="file" name="file_sql" accept=".sql" required class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-rose-50 file:text-rose-700 hover:file:bg-rose-100 transition-colors border border-slate-300 rounded-lg bg-white cursor-pointer">
            </div>

            <button type="submit" class="w-full btn-primary bg-rose-600 hover:bg-rose-700 justify-center !py-3 !text-base focus:ring-rose-200" onclick="return confirm('APAKAH ANDA SANGAT YAKIN? \n\nTindakan ini TIDAK BISA DIBATALKAN. Semua data pendaftar dan pengaturan saat ini akan terhapus dan digantikan oleh file SQL yang Anda unggah.')">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                Jalankan Restore Database
            </button>
        </form>

        <!-- Decorative background -->
        <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-rose-50 rounded-full blur-3xl opacity-50 pointer-events-none"></div>
    </div>
</div>

<?= $this->endSection() ?>
