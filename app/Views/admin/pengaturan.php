<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>

<div class="card p-6 max-w-3xl">
    <div class="mb-6 border-b border-slate-100 pb-4">
        <h2 class="text-xl font-bold text-slate-800">Pengaturan Sistem PPDB</h2>
        <p class="text-sm text-slate-500 mt-1">Ubah nama sekolah, tahun pelajaran, serta timeline pendaftaran.</p>
    </div>

    <form action="<?= base_url('admin/pengaturan') ?>" method="POST">
        <?= csrf_field() ?>
        <input type="hidden" name="id" value="<?= esc($settings['id'] ?? '') ?>">

        <div class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-1">Nama Sekolah</label>
                    <input type="text" name="nama_sekolah" class="input-field" value="<?= esc($settings['nama_sekolah'] ?? '') ?>" placeholder="Contoh: SMA Negeri 1 Nusantara" required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Tahun Pelajaran</label>
                    <input type="text" name="tahun_pelajaran" class="input-field" value="<?= esc($settings['tahun_pelajaran'] ?? '') ?>" placeholder="Contoh: 2024/2025" required>
                </div>

                <!-- Logo placeholder for future extension -->
                <div class="hidden">
                    <label class="block text-sm font-bold text-slate-700 mb-1">Logo Sekolah</label>
                    <input type="file" name="logo" class="input-field bg-white" accept="image/*">
                </div>
            </div>

            <div class="border-t border-slate-100 pt-6">
                <h3 class="text-lg font-bold text-slate-800 mb-4">Timeline Pendaftaran</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Tanggal Dibuka</label>
                        <input type="date" name="tanggal_buka" class="input-field" value="<?= esc($settings['tanggal_buka'] ?? '') ?>" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Tanggal Ditutup</label>
                        <input type="date" name="tanggal_tutup" class="input-field" value="<?= esc($settings['tanggal_tutup'] ?? '') ?>" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 flex justify-end">
            <button type="submit" class="btn-primary">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                Simpan Pengaturan
            </button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
