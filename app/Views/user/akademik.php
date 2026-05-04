<?= $this->extend('layouts/user_layout') ?>

<?= $this->section('content') ?>

<div class="card p-8">
    <form action="<?= base_url('user/akademik') ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="mb-8">
            <h2 class="text-xl font-bold text-slate-800 border-b border-slate-200 pb-2 mb-6">Informasi Asal Sekolah</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-600 mb-1">Nama Asal Sekolah (SMP/MTs sederajat)</label>
                    <input type="text" name="asal_sekolah" class="input-field" value="<?= old('asal_sekolah', $akademik['asal_sekolah'] ?? '') ?>" required>
                    <?php if(session('errors.asal_sekolah')): ?><p class="text-red-500 text-xs mt-1"><?= session('errors.asal_sekolah') ?></p><?php endif; ?>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1">NPSN Sekolah Asal</label>
                    <input type="text" name="npsn" class="input-field" value="<?= old('npsn', $akademik['npsn'] ?? '') ?>" required>
                    <?php if(session('errors.npsn')): ?><p class="text-red-500 text-xs mt-1"><?= session('errors.npsn') ?></p><?php endif; ?>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1">Total Nilai Rapor (Semester 1-5)</label>
                    <input type="number" step="0.01" name="total_nilai" class="input-field" value="<?= old('total_nilai', $akademik['total_nilai'] ?? '') ?>" required>
                    <?php if(session('errors.total_nilai')): ?><p class="text-red-500 text-xs mt-1"><?= session('errors.total_nilai') ?></p><?php endif; ?>
                </div>
            </div>
        </div>

        <div class="mb-8">
            <h2 class="text-xl font-bold text-slate-800 border-b border-slate-200 pb-2 mb-6">Unggah Berkas Akademik</h2>
            <p class="text-sm text-slate-500 mb-6">Format yang diizinkan: PDF, JPG, PNG. Ukuran maksimal per file: 2MB.</p>

            <div class="space-y-6">
                <!-- Rapor -->
                <div class="p-4 rounded-xl border border-slate-200 bg-slate-50">
                    <label class="block text-sm font-bold text-slate-700 mb-2">1. Scan Rapor (Semester 1-5) digabung 1 File</label>
                    <input type="file" name="file_rapor" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-brand-light file:text-brand-dark hover:file:bg-blue-100 transition-colors bg-white rounded-xl border border-slate-300" accept=".pdf,.jpg,.jpeg,.png" <?= empty($akademik['file_rapor']) ? 'required' : '' ?>>
                    <?php if(session('errors.file_rapor')): ?><p class="text-red-500 text-xs mt-1"><?= session('errors.file_rapor') ?></p><?php endif; ?>
                    <?php if(!empty($akademik['file_rapor'])): ?>
                        <p class="text-xs text-emerald-600 mt-2 font-medium flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> File sudah diunggah. Abaikan jika tidak ingin mengganti.
                        </p>
                    <?php endif; ?>
                </div>

                <!-- Ijazah/SKL -->
                <div class="p-4 rounded-xl border border-slate-200 bg-slate-50">
                    <label class="block text-sm font-bold text-slate-700 mb-2">2. Scan Ijazah / Surat Keterangan Lulus (SKL)</label>
                    <input type="file" name="file_ijazah" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-brand-light file:text-brand-dark hover:file:bg-blue-100 transition-colors bg-white rounded-xl border border-slate-300" accept=".pdf,.jpg,.jpeg,.png" <?= empty($akademik['file_ijazah']) ? 'required' : '' ?>>
                    <?php if(session('errors.file_ijazah')): ?><p class="text-red-500 text-xs mt-1"><?= session('errors.file_ijazah') ?></p><?php endif; ?>
                    <?php if(!empty($akademik['file_ijazah'])): ?>
                        <p class="text-xs text-emerald-600 mt-2 font-medium flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> File sudah diunggah. Abaikan jika tidak ingin mengganti.
                        </p>
                    <?php endif; ?>
                </div>

                <!-- SKKB -->
                <div class="p-4 rounded-xl border border-slate-200 bg-slate-50">
                    <label class="block text-sm font-bold text-slate-700 mb-2">3. Surat Keterangan Kelakuan Baik (SKKB) / SKCK</label>
                    <input type="file" name="file_skkb" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-brand-light file:text-brand-dark hover:file:bg-blue-100 transition-colors bg-white rounded-xl border border-slate-300" accept=".pdf,.jpg,.jpeg,.png" <?= empty($akademik['file_skkb']) ? 'required' : '' ?>>
                    <?php if(session('errors.file_skkb')): ?><p class="text-red-500 text-xs mt-1"><?= session('errors.file_skkb') ?></p><?php endif; ?>
                    <?php if(!empty($akademik['file_skkb'])): ?>
                        <p class="text-xs text-emerald-600 mt-2 font-medium flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> File sudah diunggah. Abaikan jika tidak ingin mengganti.
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="flex justify-between pt-4 border-t border-slate-100">
            <a href="<?= base_url('user/biodata') ?>" class="btn-secondary">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
            <button type="submit" class="btn-primary">
                Simpan & Lanjutkan
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
