<?= $this->extend('layouts/user_layout') ?>

<?= $this->section('content') ?>

<div class="card p-8 max-w-2xl">
    <div class="mb-8 border-b border-slate-200 pb-4">
        <h2 class="text-xl font-bold text-slate-800">Ubah Password</h2>
        <p class="text-sm text-slate-500 mt-1">Ganti password secara berkala untuk menjaga keamanan akun Anda.</p>
    </div>

    <form action="<?= base_url('user/account') ?>" method="POST" id="formUbahPassword">
        <?= csrf_field() ?>

        <div class="space-y-6">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1">Password Lama</label>
                <div class="relative">
                    <input type="password" id="password_lama" name="password_lama" class="w-full pl-4 pr-12 py-3 bg-[#f9f9ff] border border-slate-300 rounded-lg text-base text-slate-900 placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-[#0052cc] focus:border-[#0052cc] transition-all shadow-inner shadow-slate-900/5" placeholder="Masukkan password saat ini" required>
                    <button class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-[#0052cc] transition-colors focus:outline-none" type="button" onclick="togglePassword('password_lama', this)">
                        <i class="fa-solid fa-eye-slash"></i>
                    </button>
                </div>
                <?php if (session('errors.password_lama')): ?><p class="text-red-500 text-xs mt-1"><?= session('errors.password_lama') ?></p><?php endif; ?>
            </div>

            <div class="border-t border-slate-100 pt-6">
                <label class="block text-sm font-bold text-slate-700 mb-1">Password Baru</label>
                <div class="relative">
                    <input type="password" id="password_baru" name="password_baru" class="w-full pl-4 pr-12 py-3 bg-[#f9f9ff] border border-slate-300 rounded-lg text-base text-slate-900 placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-[#0052cc] focus:border-[#0052cc] transition-all shadow-inner shadow-slate-900/5" placeholder="Minimal 6 karakter" required minlength="6">
                    <button class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-[#0052cc] transition-colors focus:outline-none" type="button" onclick="togglePassword('password_baru', this)">
                        <i class="fa-solid fa-eye-slash"></i>
                    </button>
                </div>
                <?php if (session('errors.password_baru')): ?><p class="text-red-500 text-xs mt-1"><?= session('errors.password_baru') ?></p><?php endif; ?>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1">Konfirmasi Password Baru</label>
                <div class="relative">
                    <input type="password" id="konfirmasi" name="konfirmasi" class="w-full pl-4 pr-12 py-3 bg-[#f9f9ff] border border-slate-300 rounded-lg text-base text-slate-900 placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-[#0052cc] focus:border-[#0052cc] transition-all shadow-inner shadow-slate-900/5" placeholder="Ketik ulang password baru" required minlength="6">
                    <button class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-[#0052cc] transition-colors focus:outline-none" type="button" onclick="togglePassword('konfirmasi', this)">
                        <i class="fa-solid fa-eye-slash"></i>
                    </button>
                </div>
                <?php if (session('errors.konfirmasi')): ?><p class="text-red-500 text-xs mt-1"><?= session('errors.konfirmasi') ?></p><?php endif; ?>
            </div>
        </div>

        <div class="mt-8">
            <button type="submit" id="submitBtn" class="btn-primary w-full md:w-auto flex items-center justify-center">
                <svg id="btnIcon" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path>
                </svg>
                <svg id="btnLoader" class="animate-spin ml-2 h-5 w-5 text-white hidden mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span id="btnText">Perbarui Password</span>
            </button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Fungsi baru untuk mengatur toggle on/off visibility password secara dinamis
    function togglePassword(inputId, button) {
        const input = document.getElementById(inputId);
        const icon = button.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    }

    // Script loading diperbaiki agar memanggil ID form dan elemen yang benar
    const formUbah = document.getElementById('formUbahPassword');
    if (formUbah) {
        formUbah.addEventListener('submit', function() {
            var btn = document.getElementById('submitBtn');
            var btnText = document.getElementById('btnText');
            var btnLoader = document.getElementById('btnLoader');
            var btnIcon = document.getElementById('btnIcon');

            btn.disabled = true;
            btn.classList.add('opacity-75', 'cursor-not-allowed');
            btnText.textContent = 'Memproses...';
            btnIcon.classList.add('hidden'); // Sembunyikan icon gembok
            btnLoader.classList.remove('hidden'); // Tampilkan icon spinner
        });
    }
</script>
<?= $this->endSection() ?>