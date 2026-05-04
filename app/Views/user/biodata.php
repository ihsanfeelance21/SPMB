<?= $this->extend('layouts/user_layout') ?>

<?= $this->section('content') ?>

<div class="card p-8">
    <form action="<?= base_url('user/biodata') ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="mb-8">
            <h2 class="text-xl font-bold text-slate-800 border-b border-slate-200 pb-2 mb-6">Data Diri Tambahan</h2>
            
            <!-- Pas Foto Upload -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-slate-600 mb-2">Pas Foto Resmi (Maks 2MB, JPG/PNG)</label>
                <div class="flex items-center gap-6">
                    <div class="w-24 h-32 bg-slate-100 rounded-lg border-2 border-dashed border-slate-300 flex items-center justify-center overflow-hidden flex-shrink-0">
                        <?php if(!empty($biodata['pas_foto'])): ?>
                            <!-- In a real app, you'd route this through a controller to protect the file, or if it's public, direct link. Let's assume direct link is disabled as per best practice, but for UI sake we show a placeholder icon -->
                            <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <?php else: ?>
                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <?php endif; ?>
                    </div>
                    <div class="flex-1">
                        <input type="file" name="pas_foto" class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-brand-light file:text-brand-dark hover:file:bg-blue-100 transition-colors border border-slate-300 rounded-xl bg-slate-50 cursor-pointer" accept=".jpg,.jpeg,.png">
                        <?php if(session('errors.pas_foto')): ?>
                            <p class="text-red-500 text-xs mt-1"><?= session('errors.pas_foto') ?></p>
                        <?php endif; ?>
                        <?php if(!empty($biodata['pas_foto'])): ?>
                            <p class="text-xs text-emerald-600 mt-2 font-medium flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                File pas foto sudah diunggah. Pilih file baru hanya jika ingin mengganti.
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-8">
            <h2 class="text-xl font-bold text-slate-800 border-b border-slate-200 pb-2 mb-6">Data Orang Tua / Wali</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1">Nama Ayah Kandung</label>
                    <input type="text" name="nama_ayah" class="input-field" value="<?= old('nama_ayah', $orangTua['nama_ayah'] ?? '') ?>" required>
                    <?php if(session('errors.nama_ayah')): ?><p class="text-red-500 text-xs mt-1"><?= session('errors.nama_ayah') ?></p><?php endif; ?>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1">Nama Ibu Kandung</label>
                    <input type="text" name="nama_ibu" class="input-field" value="<?= old('nama_ibu', $orangTua['nama_ibu'] ?? '') ?>" required>
                    <?php if(session('errors.nama_ibu')): ?><p class="text-red-500 text-xs mt-1"><?= session('errors.nama_ibu') ?></p><?php endif; ?>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1">Pekerjaan Utama Orang Tua</label>
                    <input type="text" name="pekerjaan" class="input-field" value="<?= old('pekerjaan', $orangTua['pekerjaan'] ?? '') ?>" required>
                    <?php if(session('errors.pekerjaan')): ?><p class="text-red-500 text-xs mt-1"><?= session('errors.pekerjaan') ?></p><?php endif; ?>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1">Penghasilan Gabungan (Per Bulan)</label>
                    <select name="penghasilan" class="input-field" required>
                        <option value="">-- Pilih Penghasilan --</option>
                        <option value="< 1.000.000" <?= old('penghasilan', $orangTua['penghasilan'] ?? '') == '< 1.000.000' ? 'selected' : '' ?>>< Rp 1.000.000</option>
                        <option value="1.000.000 - 3.000.000" <?= old('penghasilan', $orangTua['penghasilan'] ?? '') == '1.000.000 - 3.000.000' ? 'selected' : '' ?>>Rp 1.000.000 - Rp 3.000.000</option>
                        <option value="3.000.000 - 5.000.000" <?= old('penghasilan', $orangTua['penghasilan'] ?? '') == '3.000.000 - 5.000.000' ? 'selected' : '' ?>>Rp 3.000.000 - Rp 5.000.000</option>
                        <option value="> 5.000.000" <?= old('penghasilan', $orangTua['penghasilan'] ?? '') == '> 5.000.000' ? 'selected' : '' ?>>> Rp 5.000.000</option>
                    </select>
                    <?php if(session('errors.penghasilan')): ?><p class="text-red-500 text-xs mt-1"><?= session('errors.penghasilan') ?></p><?php endif; ?>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-600 mb-1">Nomor Telepon / WhatsApp Aktif</label>
                    <input type="text" name="no_telp" class="input-field" value="<?= old('no_telp', $orangTua['no_telp'] ?? '') ?>" required>
                    <?php if(session('errors.no_telp')): ?><p class="text-red-500 text-xs mt-1"><?= session('errors.no_telp') ?></p><?php endif; ?>
                </div>
            </div>
        </div>

        <div class="flex justify-end pt-4 border-t border-slate-100">
            <button type="submit" class="btn-primary">
                Simpan & Lanjutkan
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
