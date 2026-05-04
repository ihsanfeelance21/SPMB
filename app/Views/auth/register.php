<?= $this->extend('layouts/auth_layout') ?>

<?= $this->section('content') ?>

    <div class="w-full max-w-lg bg-surface-light rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
        <div class="p-8">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-brand-dark mb-2">Pendaftaran Baru</h1>
                <p class="text-slate-500">Buat akun untuk memulai pendaftaran</p>
            </div>

            <?php if(session()->getFlashdata('error')): ?>
                <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-6 text-sm border border-red-100">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('register') ?>" method="POST" enctype="multipart/form-data" id="registerForm" class="space-y-5">
                <?= csrf_field() ?>

                <!-- Pilihan Identitas -->
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-2">Jenis Identitas Pendaftaran</label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="relative flex cursor-pointer rounded-xl border border-slate-300 bg-white p-4 shadow-sm hover:bg-slate-50 focus:outline-none">
                            <input type="radio" name="jenis_identitas" value="KTP" class="peer sr-only" <?= old('jenis_identitas', 'KTP') === 'KTP' ? 'checked' : '' ?> onchange="updateFormFields()">
                            <div class="peer-checked:border-brand peer-checked:ring-1 peer-checked:ring-brand absolute inset-0 rounded-xl border-2 border-transparent transition"></div>
                            <div class="flex items-center gap-3">
                                <div class="w-5 h-5 rounded-full border-2 border-slate-300 peer-checked:border-brand flex items-center justify-center">
                                    <div class="w-2.5 h-2.5 rounded-full bg-brand opacity-0 peer-checked:opacity-100 transition"></div>
                                </div>
                                <span class="text-sm font-medium text-slate-900">KTP</span>
                            </div>
                        </label>
                        
                        <label class="relative flex cursor-pointer rounded-xl border border-slate-300 bg-white p-4 shadow-sm hover:bg-slate-50 focus:outline-none">
                            <input type="radio" name="jenis_identitas" value="KK" class="peer sr-only" <?= old('jenis_identitas') === 'KK' ? 'checked' : '' ?> onchange="updateFormFields()">
                            <div class="peer-checked:border-brand peer-checked:ring-1 peer-checked:ring-brand absolute inset-0 rounded-xl border-2 border-transparent transition"></div>
                            <div class="flex items-center gap-3">
                                <div class="w-5 h-5 rounded-full border-2 border-slate-300 peer-checked:border-brand flex items-center justify-center">
                                    <div class="w-2.5 h-2.5 rounded-full bg-brand opacity-0 peer-checked:opacity-100 transition"></div>
                                </div>
                                <span class="text-sm font-medium text-slate-900">Kartu Keluarga (KK)</span>
                            </div>
                        </label>
                    </div>
                    <?php if(session('errors.jenis_identitas')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= session('errors.jenis_identitas') ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <label for="nama_lengkap" class="block text-sm font-medium text-slate-600 mb-1">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="input-field" placeholder="Sesuai dokumen" value="<?= old('nama_lengkap') ?>" required>
                    <?php if(session('errors.nama_lengkap')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= session('errors.nama_lengkap') ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <label for="no_identitas" id="label_no_identitas" class="block text-sm font-medium text-slate-600 mb-1">Nomor Identitas</label>
                    <input type="text" name="no_identitas" id="no_identitas" class="input-field" placeholder="Masukkan nomor identitas" value="<?= old('no_identitas') ?>" required>
                    <?php if(session('errors.no_identitas')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= session('errors.no_identitas') ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-600 mb-1">Email Aktif</label>
                    <input type="email" name="email" id="email" class="input-field" placeholder="Email untuk komunikasi" value="<?= old('email') ?>" required>
                    <?php if(session('errors.email')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= session('errors.email') ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-600 mb-1">Password (Minimal 6 karakter)</label>
                    <input type="password" name="password" id="password" class="input-field" placeholder="Buat password" required minlength="6">
                    <?php if(session('errors.password')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= session('errors.password') ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <label for="file_identitas" id="label_file_identitas" class="block text-sm font-medium text-slate-600 mb-1">Upload Dokumen Identitas (Max 2MB)</label>
                    <input type="file" name="file_identitas" id="file_identitas" class="w-full text-sm text-slate-500 file:mr-4 file:py-3 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-brand-light file:text-brand-dark hover:file:bg-blue-100 transition-colors border border-slate-300 rounded-xl bg-slate-50 cursor-pointer" accept=".jpg,.jpeg,.png,.pdf" required>
                    <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG, atau PDF.</p>
                    <?php if(session('errors.file_identitas')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= session('errors.file_identitas') ?></p>
                    <?php endif; ?>
                </div>

                <div class="pt-4">
                    <button type="submit" id="submitBtn" class="btn-primary">
                        <span id="btnText">Daftar Akun</span>
                        <svg id="btnLoader" class="animate-spin ml-2 h-5 w-5 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </div>
            </form>
            
            <div class="mt-8 text-center">
                <p class="text-sm text-slate-600">Sudah punya akun? <a href="<?= base_url('login') ?>" class="font-semibold text-brand hover:text-brand-dark transition-colors">Login di sini</a></p>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function updateFormFields() {
        var jenis = document.querySelector('input[name="jenis_identitas"]:checked').value;
        var labelNoIdentitas = document.getElementById('label_no_identitas');
        var inputNoIdentitas = document.getElementById('no_identitas');
        var labelFileIdentitas = document.getElementById('label_file_identitas');

        if (jenis === 'KTP') {
            labelNoIdentitas.innerText = 'Nomor Induk Kependudukan (NIK)';
            inputNoIdentitas.placeholder = 'Masukkan NIK (16 digit)';
            labelFileIdentitas.innerText = 'Upload Scan/Foto KTP (Max 2MB)';
        } else {
            labelNoIdentitas.innerText = 'Nomor Induk Siswa Nasional (NISN)';
            inputNoIdentitas.placeholder = 'Masukkan NISN (10 digit)';
            labelFileIdentitas.innerText = 'Upload Scan/Foto Kartu Keluarga (Max 2MB)';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        updateFormFields();
    });

    document.getElementById('registerForm').addEventListener('submit', function() {
        var btn = document.getElementById('submitBtn');
        var btnText = document.getElementById('btnText');
        var btnLoader = document.getElementById('btnLoader');
        
        btn.disabled = true;
        btn.classList.add('opacity-75', 'cursor-not-allowed');
        btnText.textContent = 'Memproses...';
        btnLoader.classList.remove('hidden');
    });
</script>
<?= $this->endSection() ?>
