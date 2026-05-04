<?= $this->extend('layouts/user_layout') ?>

<?= $this->section('content') ?>

<div class="card p-8">
    <form action="<?= base_url('user/berkas') ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="mb-8">
            <h2 class="text-xl font-bold text-slate-800 border-b border-slate-200 pb-2 mb-6">Unggah Berkas Pendukung</h2>
            <p class="text-sm text-slate-500 mb-6">Format dokumen yang diizinkan: PDF, JPG, PNG. Ukuran maksimal per file: 2MB.</p>

            <div class="space-y-6">
                <!-- Kartu Keluarga (KK) -->
                <div class="p-4 rounded-xl border border-slate-200 bg-slate-50">
                    <label class="block text-sm font-bold text-slate-700 mb-2">1. Scan Kartu Keluarga (Wajib)</label>
                    <input type="file" name="file_kk" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-brand-light file:text-brand-dark hover:file:bg-blue-100 transition-colors bg-white rounded-xl border border-slate-300" accept=".pdf,.jpg,.jpeg,.png" <?= empty($berkas['file_kk']) ? 'required' : '' ?>>
                    <?php if(session('errors.file_kk')): ?><p class="text-red-500 text-xs mt-1"><?= session('errors.file_kk') ?></p><?php endif; ?>
                    <?php if(!empty($berkas['file_kk'])): ?>
                        <p class="text-xs text-emerald-600 mt-2 font-medium flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> File Kartu Keluarga sudah diunggah.
                        </p>
                    <?php endif; ?>
                </div>

                <!-- Akte Kelahiran -->
                <div class="p-4 rounded-xl border border-slate-200 bg-slate-50">
                    <label class="block text-sm font-bold text-slate-700 mb-2">2. Scan Akte Kelahiran (Wajib)</label>
                    <input type="file" name="file_akte" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-brand-light file:text-brand-dark hover:file:bg-blue-100 transition-colors bg-white rounded-xl border border-slate-300" accept=".pdf,.jpg,.jpeg,.png" <?= empty($berkas['file_akte']) ? 'required' : '' ?>>
                    <?php if(session('errors.file_akte')): ?><p class="text-red-500 text-xs mt-1"><?= session('errors.file_akte') ?></p><?php endif; ?>
                    <?php if(!empty($berkas['file_akte'])): ?>
                        <p class="text-xs text-emerald-600 mt-2 font-medium flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> File Akte Kelahiran sudah diunggah.
                        </p>
                    <?php endif; ?>
                </div>

                <!-- PKH (Opsional) -->
                <div class="p-4 rounded-xl border border-slate-200 bg-slate-50">
                    <label class="block text-sm font-bold text-slate-700 mb-2">3. Scan Kartu PKH <span class="text-xs font-normal text-slate-500 bg-slate-200 px-2 py-0.5 rounded ml-2">Opsional</span></label>
                    <p class="text-xs text-slate-500 mb-3">Hanya diisi jika Anda memiliki Program Keluarga Harapan (PKH).</p>
                    <input type="file" name="file_pkh" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-brand-light file:text-brand-dark hover:file:bg-blue-100 transition-colors bg-white rounded-xl border border-slate-300" accept=".pdf,.jpg,.jpeg,.png">
                    <?php if(session('errors.file_pkh')): ?><p class="text-red-500 text-xs mt-1"><?= session('errors.file_pkh') ?></p><?php endif; ?>
                    <?php if(!empty($berkas['file_pkh'])): ?>
                        <p class="text-xs text-emerald-600 mt-2 font-medium flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> File PKH sudah diunggah.
                        </p>
                    <?php endif; ?>
                </div>

                <!-- KIP (Opsional) -->
                <div class="p-4 rounded-xl border border-slate-200 bg-slate-50">
                    <label class="block text-sm font-bold text-slate-700 mb-2">4. Scan Kartu KIP <span class="text-xs font-normal text-slate-500 bg-slate-200 px-2 py-0.5 rounded ml-2">Opsional</span></label>
                    <p class="text-xs text-slate-500 mb-3">Hanya diisi jika Anda memiliki Kartu Indonesia Pintar (KIP).</p>
                    <input type="file" name="file_kip" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-brand-light file:text-brand-dark hover:file:bg-blue-100 transition-colors bg-white rounded-xl border border-slate-300" accept=".pdf,.jpg,.jpeg,.png">
                    <?php if(session('errors.file_kip')): ?><p class="text-red-500 text-xs mt-1"><?= session('errors.file_kip') ?></p><?php endif; ?>
                    <?php if(!empty($berkas['file_kip'])): ?>
                        <p class="text-xs text-emerald-600 mt-2 font-medium flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> File KIP sudah diunggah.
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="flex justify-between pt-4 border-t border-slate-100">
            <a href="<?= base_url('user/prestasi') ?>" class="btn-secondary">
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
