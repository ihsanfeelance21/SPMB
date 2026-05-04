<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>

<div class="mb-6 border-b border-slate-100 pb-4">
    <h2 class="text-2xl font-bold text-[#003d9b]">Backup & Restore</h2>
    <p class="text-sm text-slate-500 mt-1">Kelola cadangan data dan pemulihan sistem untuk menjaga keamanan informasi.</p>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="bg-green-50 text-green-700 p-4 rounded-xl mb-6 text-sm border border-green-100">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-6 text-sm border border-red-100">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-8 flex flex-col justify-between">
        <div>
            <div class="w-12 h-12 bg-[#f0f4ff] text-[#0052cc] rounded-xl flex items-center justify-center mb-6">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-2">Cadangkan Data Sekarang</h3>
            <p class="text-sm text-slate-500 leading-relaxed">Buat salinan data terbaru termasuk pendaftar, dokumen, dan pengaturan sistem.</p>
        </div>

        <div class="mt-8">
            <a href="<?= base_url('admin/backup/generate') ?>" class="inline-flex items-center justify-center px-6 py-2.5 bg-[#0052cc] hover:bg-[#003d9b] text-white text-sm font-medium rounded-lg transition-colors">
                Mulai Backup
            </a>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-8 flex flex-col justify-between">
        <div>
            <div class="w-12 h-12 bg-red-50 text-red-600 rounded-xl flex items-center justify-center mb-6">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-4">Pulihkan Data</h3>

            <div class="bg-[#fff8e6] border border-[#ffebaa] p-4 rounded-lg mb-4 flex items-start gap-3">
                <svg class="w-5 h-5 text-[#d97706] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                <p class="text-xs text-[#92400e] leading-relaxed">Peringatan: Pemulihan data akan menimpa data sistem saat ini. Pastikan file backup valid sebelum melanjutkan.</p>
            </div>

            <form action="<?= base_url('admin/backup/restore') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="border-2 border-dashed border-[#e2e8f0] bg-[#f8fafc] rounded-xl p-6 text-center hover:bg-slate-50 transition-colors relative">
                    <input type="file" name="file_sql" accept=".sql,.zip" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="document.getElementById('fileName').innerText = this.files[0].name">
                    <svg class="w-8 h-8 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    <p class="text-sm font-medium text-slate-700">Unggah file backup (.sql, .zip)</p>
                    <p class="text-xs text-slate-500 mt-1" id="fileName">Tarik dan lepas file ke sini atau klik untuk memilih</p>
                </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 bg-[#dc2626] hover:bg-[#b91c1c] text-white text-sm font-medium rounded-lg transition-colors" onclick="return confirm('APAKAH ANDA YAKIN? Semua data saat ini akan ditimpa!')">
                Jalankan Restore
            </button>
            </form>
        </div>
    </div>
</div>

<div class="mt-8 bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="p-6 border-b border-slate-100 flex justify-between items-center">
        <h3 class="text-lg font-bold text-slate-800">Riwayat Backup</h3>
        <a href="#" class="text-sm text-[#0052cc] hover:underline flex items-center font-medium">
            Lihat Semua <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-[#f8fafc] text-slate-500 text-xs uppercase tracking-wider">
                    <th class="px-6 py-4 font-semibold">Nama File</th>
                    <th class="px-6 py-4 font-semibold">Tanggal</th>
                    <th class="px-6 py-4 font-semibold">Ukuran</th>
                    <th class="px-6 py-4 font-semibold">Status</th>
                    <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                <?php if (!empty($histories)): ?>
                    <?php foreach ($histories as $file): ?>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 text-slate-700 font-medium"><?= $file['name'] ?></td>
                            <td class="px-6 py-4 text-slate-500"><?= $file['date'] ?></td>
                            <td class="px-6 py-4 text-slate-500"><?= $file['size'] ?></td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">Sukses</span>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="<?= base_url('admin/backup/download_file/' . $file['name']) ?>" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-slate-400 hover:text-[#0052cc] hover:bg-blue-50 transition-colors" title="Download">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                    </svg>
                                </a>
                                <a href="<?= base_url('admin/backup/delete/' . $file['name']) ?>" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition-colors" title="Hapus" onclick="return confirm('Hapus file backup ini?')">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-slate-400">Belum ada riwayat backup.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>