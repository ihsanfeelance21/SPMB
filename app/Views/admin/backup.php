<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>

<div class="mb-8">
    <h1 class="text-2xl font-bold text-[#003d9b] mb-1">Backup & Restore System</h1>
    <p class="text-[14px] text-slate-500">Kelola cadangan data dan pemulihan sistem untuk menjaga keamanan informasi.</p>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 text-sm">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6 text-sm">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

    <div class="bg-white rounded-xl p-8 shadow-[0_2px_10px_rgb(0,0,0,0.04)] border border-slate-100 flex flex-col h-full">
        <div class="w-12 h-12 bg-blue-50 text-[#0052cc] rounded-lg flex items-center justify-center mb-6">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
            </svg>
        </div>

        <h2 class="text-xl font-bold text-slate-800 mb-2">Cadangkan Data Sekarang</h2>
        <p class="text-[14px] text-slate-500 mb-8 grow">Buat salinan data terbaru termasuk pendaftar, dokumen, dan pengaturan sistem.</p>

        <form action="<?= base_url('admin/backup/create') ?>" method="POST">
            <?= csrf_field() ?>
            <button type="submit" class="bg-[#0052cc] hover:bg-[#0047b3] text-white px-6 py-2.5 rounded-lg font-medium text-[14px] transition-colors" onclick="this.innerHTML='Memproses...'; this.classList.add('opacity-75');">
                Mulai Backup
            </button>
        </form>
    </div>

    <div class="bg-white rounded-xl p-8 shadow-[0_2px_10px_rgb(0,0,0,0.04)] border border-slate-100 flex flex-col h-full">
        <div class="w-12 h-12 bg-red-50 text-red-600 rounded-lg flex items-center justify-center mb-6">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
        </div>

        <h2 class="text-xl font-bold text-slate-800 mb-4">Pulihkan Data</h2>

        <div class="bg-[#fff9e6] border border-[#ffeb99] p-4 rounded-lg mb-6 flex gap-3">
            <svg class="w-5 h-5 text-amber-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
            <p class="text-[13px] text-amber-800 leading-snug">
                Peringatan: Pemulihan data akan menimpa data sistem saat ini. Pastikan file backup valid sebelum melanjutkan.
            </p>
        </div>

        <form action="<?= base_url('admin/backup/restore') ?>" method="POST" enctype="multipart/form-data" class="grow flex flex-col">
            <?= csrf_field() ?>

            <div class="border-2 border-dashed border-slate-200 bg-[#f8fafc] rounded-lg p-6 flex flex-col items-center justify-center text-center cursor-pointer hover:border-[#0052cc] hover:bg-[#f0f4ff] transition-all mb-6 relative group" onclick="document.getElementById('file_sql').click()">
                <svg class="w-8 h-8 text-slate-400 group-hover:text-[#0052cc] mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                </svg>
                <p class="text-[14px] font-medium text-slate-700 mb-1">Unggah file backup (.sql, .zip)</p>
                <p class="text-[12px] text-slate-500">Tarik dan lepas file ke sini atau klik untuk memilih</p>
                <input type="file" name="file_sql" id="file_sql" accept=".sql" class="hidden" required onchange="showFileName(this)">
                <p id="filename_display" class="text-[13px] font-bold text-[#0052cc] mt-2 hidden"></p>
            </div>

            <div>
                <button type="submit" class="bg-[#cc0000] hover:bg-[#b30000] text-white px-6 py-2.5 rounded-lg font-medium text-[14px] transition-colors" onclick="return confirm('Peringatan!\nSemua data saat ini akan ditimpa. Anda yakin ingin memulihkan database?')">
                    Jalankan Restore
                </button>
            </div>
        </form>
    </div>
</div>

<div class="bg-white rounded-xl shadow-[0_2px_10px_rgb(0,0,0,0.04)] border border-slate-100 overflow-hidden">
    <div class="p-6 border-b border-slate-100 flex justify-between items-center">
        <h2 class="text-lg font-bold text-slate-800">Riwayat Backup</h2>
        <a href="#" class="text-[14px] font-medium text-[#0052cc] hover:underline flex items-center gap-1">
            Lihat Semua
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-[#f8fafc] text-[13px] text-slate-500 font-semibold border-b border-slate-100">
                    <th class="py-4 px-6">Nama File</th>
                    <th class="py-4 px-6">Tanggal</th>
                    <th class="py-4 px-6">Ukuran</th>
                    <th class="py-4 px-6">Status</th>
                    <th class="py-4 px-6 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-[14px] text-slate-700">
                <?php if (empty($backups)): ?>
                    <tr>
                        <td colspan="5" class="py-8 text-center text-slate-500">Belum ada riwayat backup.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($backups as $row): ?>
                        <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
                            <td class="py-4 px-6 font-medium text-slate-800"><?= $row['name'] ?></td>
                            <td class="py-4 px-6"><?= $row['date'] ?></td>
                            <td class="py-4 px-6"><?= $row['size'] ?></td>
                            <td class="py-4 px-6">
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-[12px] font-medium">
                                    <?= $row['status'] ?>
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right flex justify-end gap-3">
                                <a href="<?= base_url('admin/backup/download/' . $row['name']) ?>" class="text-slate-400 hover:text-[#0052cc] transition-colors" title="Download">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                    </svg>
                                </a>
                                <form action="<?= base_url('admin/backup/delete/' . $row['name']) ?>" method="POST" class="inline" onsubmit="return confirm('Hapus file backup ini?')">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="text-slate-400 hover:text-red-500 transition-colors" title="Hapus">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function showFileName(input) {
        const display = document.getElementById('filename_display');
        if (input.files && input.files[0]) {
            display.textContent = input.files[0].name;
            display.classList.remove('hidden');
        } else {
            display.classList.add('hidden');
        }
    }
</script>
<?= $this->endSection() ?>