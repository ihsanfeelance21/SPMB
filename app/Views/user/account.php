<?= $this->extend('layouts/user_layout') ?>

<?= $this->section('content') ?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

    <div class="lg:col-span-2 card p-8 bg-white rounded-xl shadow-[0_2px_10px_rgb(0,0,0,0.04)] border border-slate-100">
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
                        <input type="password" id="password_baru" name="password_baru" class="w-full pl-4 pr-12 py-3 bg-[#f9f9ff] border border-slate-300 rounded-lg text-base text-slate-900 placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-[#0052cc] focus:border-[#0052cc] transition-all shadow-inner shadow-slate-900/5" placeholder="Minimal 8 karakter" required minlength="8">
                        <button class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-[#0052cc] transition-colors focus:outline-none" type="button" onclick="togglePassword('password_baru', this)">
                            <i class="fa-solid fa-eye-slash"></i>
                        </button>
                    </div>
                    <?php if (session('errors.password_baru')): ?><p class="text-red-500 text-xs mt-1"><?= session('errors.password_baru') ?></p><?php endif; ?>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Konfirmasi Password Baru</label>
                    <div class="relative">
                        <input type="password" id="konfirmasi" name="konfirmasi" class="w-full pl-4 pr-12 py-3 bg-[#f9f9ff] border border-slate-300 rounded-lg text-base text-slate-900 placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-[#0052cc] focus:border-[#0052cc] transition-all shadow-inner shadow-slate-900/5" placeholder="Ketik ulang password baru" required minlength="8">
                        <button class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-[#0052cc] transition-colors focus:outline-none" type="button" onclick="togglePassword('konfirmasi', this)">
                            <i class="fa-solid fa-eye-slash"></i>
                        </button>
                    </div>
                    <?php if (session('errors.konfirmasi')): ?><p class="text-red-500 text-xs mt-1"><?= session('errors.konfirmasi') ?></p><?php endif; ?>
                </div>
            </div>

            <div class="mt-8">
                <button type="submit" id="submitBtn" class="btn-primary w-full md:w-auto flex items-center justify-center bg-[#0052cc] hover:bg-[#0047b3] text-white px-6 py-3 rounded-lg font-medium transition-colors">
                    <svg id="btnIcon" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path>
                    </svg>
                    <svg id="btnLoader" class="animate-spin h-5 w-5 text-white hidden mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span id="btnText">Perbarui Password</span>
                </button>
            </div>
        </form>
    </div>

    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl shadow-[0_2px_10px_rgb(0,0,0,0.04)] border border-slate-100 border-t-4 border-t-[#006b75] p-6 sticky top-6">

            <div class="flex items-center gap-3 mb-4">
                <svg class="w-6 h-6 text-[#006b75]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
                <h3 class="text-lg font-bold text-[#006b75]">Tips Keamanan</h3>
            </div>

            <p class="text-[14px] text-slate-600 mb-6 leading-relaxed">
                Pastikan password Anda kuat untuk melindungi data pribadi dan akademik Anda.
            </p>

            <ul class="space-y-4">
                <li class="flex items-start">
                    <svg class="w-5 h-5 text-[#006b75] mr-3 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-[14px] text-slate-700 leading-relaxed">Gunakan kombinasi huruf besar, huruf kecil, angka, dan simbol.</span>
                </li>
                <li class="flex items-start">
                    <svg class="w-5 h-5 text-[#006b75] mr-3 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-[14px] text-slate-700 leading-relaxed">Minimal panjang password adalah 8 karakter.</span>
                </li>
                <li class="flex items-start">
                    <svg class="w-5 h-5 text-[#006b75] mr-3 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-[14px] text-slate-700 leading-relaxed">Hindari menggunakan informasi pribadi yang mudah ditebak seperti tanggal lahir.</span>
                </li>
            </ul>
        </div>
    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Fungsi Toggle Password
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

    // Fungsi Loading saat form disubmit
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
            btnIcon.classList.add('hidden');
            btnLoader.classList.remove('hidden');
        });
    }
</script>
<?= $this->endSection() ?>