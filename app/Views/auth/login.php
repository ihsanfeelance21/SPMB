<?= $this->extend('layouts/auth_layout') ?>

<?= $this->section('content') ?>

<div class="w-full max-w-md relative z-10">
    <div class="bg-white/80 backdrop-blur-[20px] rounded-xl border border-slate-200 shadow-xl shadow-[#003d9b]/5 p-8 flex flex-col gap-8 relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1 bg-linear-to-r from-[#c0e8ff] via-[#0052cc] to-[#7bd1fa]"></div>
        <div class="text-center flex flex-col items-center gap-2">
            <div class="w-16 h-16 bg-[#f0f3ff] rounded-full flex items-center justify-center mb-4 border border-[#d8e3fb]">
                <i class="fa-solid fa-school text-2xl text-[#003d9b]"></i>
            </div>
            <h1 class="font-display text-2xl font-bold text-[#003d9b]">Selamat Datang di SPMB</h1>
            <p class="text-base text-slate-600">Silakan masuk untuk melanjutkan pendaftaran Anda.</p>
        </div>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-md">
                <div class="flex items-center">
                    <i class="fa-solid fa-triangle-exclamation text-red-500 mr-2"></i>
                    <p class="text-sm text-red-700"><?= session()->getFlashdata('error') ?></p>
                </div>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-md">
                <div class="flex items-center">
                    <i class="fa-regular fa-circle-check text-emerald-500 mr-2"></i>
                    <p class="text-sm text-emerald-700"><?= session()->getFlashdata('success') ?></p>
                </div>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('login') ?>" method="POST" id="loginForm" class="space-y-5">
            <?= csrf_field() ?>

            <div class="flex flex-col gap-2">
                <label for="email" class="text-sm font-semibold text-slate-900">Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fa-solid fa-user text-slate-400"></i>
                    </div>
                    <input type="email" name="email" id="email" class="w-full pl-10 pr-4 py-3 bg-[#f9f9ff] border border-slate-300 rounded-lg text-base text-slate-900 placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-[#0052cc] focus:border-[#0052cc] transition-all shadow-inner shadow-slate-900/5" placeholder="Masukkan email Anda" value="<?= old('email') ?>" required autofocus>
                </div>
                <?php if (session('errors.email')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= session('errors.email') ?></p>
                <?php endif; ?>
            </div>

            <div class="flex flex-col gap-2">
                <div class="flex justify-between items-center">
                    <label for="password" class="text-sm font-semibold text-slate-900">Password</label>
                    <a href="<?= base_url('forgot-password') ?>" class="text-xs text-[#0052cc] hover:text-[#003d9b] transition-colors">Lupa Password?</a>
                </div>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fa-solid fa-lock text-slate-400"></i>
                    </div>
                    <input type="password" name="password" id="password" class="w-full pl-10 pr-10 py-3 bg-[#f9f9ff] border border-slate-300 rounded-lg text-base text-slate-900 placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-[#0052cc] focus:border-[#0052cc] transition-all shadow-inner shadow-slate-900/5" placeholder="Masukkan password Anda" required>
                    <button class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-700 transition-colors focus:outline-none" type="button" onclick="const p = document.getElementById('password'); p.type = p.type === 'password' ? 'text' : 'password'; this.querySelector('span').innerText = p.type === 'password' ? 'visibility_off' : 'visibility';">
                        <i class="fa-solid fa-eye-slash"></i>
                    </button>
                </div>
                <?php if (session('errors.password')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= session('errors.password') ?></p>
                <?php endif; ?>
            </div>

            <div class="pt-1">
                <button type="submit" id="submitBtn" class="mt-4 w-full py-3 bg-[#0052cc] text-white font-semibold text-sm rounded-lg shadow-md shadow-[#003d9b]/20 hover:shadow-lg hover:shadow-[#003d9b]/30 hover:-translate-y-0.5 hover:bg-[#003d9b] transition-all duration-200 flex justify-center items-center gap-2">
                    <span id="btnText">Login</span>
                </button>
            </div>
        </form>

        <div class="text-center pt-4 border-t border-[#d8e3fb]">
            <p class="text-base text-slate-600">
                Belum punya akun?
                <a href="<?= base_url('register') ?>" class="text-sm font-semibold text-[#0052cc] hover:text-[#003d9b] transition-colors">Daftar sekarang</a>
            </p>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    document.getElementById('loginForm').addEventListener('submit', function() {
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