<!DOCTYPE html>
<html lang="id">

<head>
    <title>Login - <?= esc($settings['nama_sekolah'] ?? 'SPMB') ?></title>
    <?= $this->include('layouts/components/auth_head') ?>
</head>

<body class="font-sans antialiased bg-[#F8FAFC] text-[#1F2937]">
    <div class="min-h-screen flex flex-col lg:flex-row">

        <?= $this->include('layouts/components/auth_left_panel') ?>

        <!-- ===================== RIGHT PANEL: Form Login ===================== -->
        <div class="flex-1 flex items-center justify-center p-6 sm:p-10 lg:p-16 bg-[#F8FAFC] relative">
            <div class="absolute top-0 right-0 w-80 h-80 bg-[#2D3FAF]/[0.02] rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-60 h-60 bg-[#F4D000]/[0.03] rounded-full blur-3xl translate-y-1/3 -translate-x-1/3"></div>

            <div class="w-full max-w-md relative z-10">
                <div class="relative bg-white rounded-2xl shadow-[0_4px_40px_rgba(0,0,0,0.06)] border border-[#E5E7EB]/80 overflow-hidden">
                    <div class="absolute top-0 left-0 bottom-0 w-1 bg-gradient-to-b from-[#F4D000] via-[#F4D000] to-[#F4D000]/40"></div>
                    <div class="p-8 sm:p-10 pl-9 sm:pl-11">

                        <div class="mb-8">
                            <h2 class="text-2xl sm:text-[1.7rem] font-bold text-[#1F2937] leading-snug">Selamat Datang 👋</h2>
                            <p class="mt-2 text-[15px] text-[#6B7280] leading-relaxed">Masuk ke akun Anda untuk melanjutkan proses pendaftaran.</p>
                        </div>

                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="mb-6 flex items-start gap-3 p-4 bg-[#FEF2F2] border border-[#FECACA] rounded-xl" id="alertError">
                                <div class="flex-shrink-0 w-5 h-5 mt-0.5 rounded-full bg-[#EF4444] flex items-center justify-center"><i class="fa-solid fa-xmark text-white text-xs"></i></div>
                                <p class="flex-1 text-sm font-medium text-[#991B1B]"><?= session()->getFlashdata('error') ?></p>
                                <button onclick="this.parentElement.remove()" class="text-[#EF4444]/60 hover:text-[#EF4444]"><i class="fa-solid fa-times text-sm"></i></button>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="mb-6 flex items-start gap-3 p-4 bg-[#F0FDF4] border border-[#BBF7D0] rounded-xl" id="alertSuccess">
                                <div class="flex-shrink-0 w-5 h-5 mt-0.5 rounded-full bg-[#22C55E] flex items-center justify-center"><i class="fa-solid fa-check text-white text-xs"></i></div>
                                <p class="flex-1 text-sm font-medium text-[#166534]"><?= session()->getFlashdata('success') ?></p>
                                <button onclick="this.parentElement.remove()" class="text-[#22C55E]/60 hover:text-[#22C55E]"><i class="fa-solid fa-times text-sm"></i></button>
                            </div>
                        <?php endif; ?>

                        <form action="<?= base_url('login') ?>" method="POST" id="loginForm" class="space-y-5" autocomplete="off">
                            <?= csrf_field() ?>

                            <div class="space-y-1.5">
                                <label for="email" class="block text-sm font-semibold text-[#374151]">Email / NISN</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                        <i class="fa-solid fa-envelope text-[#9CA3AF] group-focus-within:text-[#2D3FAF] transition-colors duration-200"></i>
                                    </div>
                                    <input type="email" name="email" id="email" class="w-full pl-11 pr-4 py-3 bg-white border border-[#E5E7EB] rounded-xl text-[15px] text-[#1F2937] placeholder:text-[#9CA3AF] focus:outline-none focus:ring-2 focus:ring-[#2D3FAF]/20 focus:border-[#2D3FAF] transition-all duration-200 hover:border-[#D1D5DB]" placeholder="Masukkan email atau NISN" value="<?= old('email') ?>" required autofocus>
                                </div>
                                <?php if (session('errors.email')): ?>
                                    <p class="text-[#EF4444] text-xs mt-1 flex items-center gap-1"><i class="fa-solid fa-circle-exclamation"></i> <?= session('errors.email') ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="space-y-1.5">
                                <label for="password" class="block text-sm font-semibold text-[#374151]">Kata Sandi</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                        <i class="fa-solid fa-lock text-[#9CA3AF] group-focus-within:text-[#2D3FAF] transition-colors duration-200"></i>
                                    </div>
                                    <input type="password" name="password" id="password" class="w-full pl-11 pr-12 py-3 bg-white border border-[#E5E7EB] rounded-xl text-[15px] text-[#1F2937] placeholder:text-[#9CA3AF] focus:outline-none focus:ring-2 focus:ring-[#2D3FAF]/20 focus:border-[#2D3FAF] transition-all duration-200 hover:border-[#D1D5DB]" placeholder="Masukkan kata sandi" required>
                                    <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-[#9CA3AF] hover:text-[#2D3FAF] transition-colors duration-200 focus:outline-none" aria-label="Toggle password visibility">
                                        <i class="fa-solid fa-eye-slash text-base" id="eyeIcon"></i>
                                    </button>
                                </div>
                                <?php if (session('errors.password')): ?>
                                    <p class="text-[#EF4444] text-xs mt-1 flex items-center gap-1"><i class="fa-solid fa-circle-exclamation"></i> <?= session('errors.password') ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="flex items-center justify-between pt-0.5">
                                <label for="remember" class="flex items-center gap-2 cursor-pointer select-none group">
                                    <div class="relative">
                                        <input type="checkbox" name="remember" id="remember" class="peer sr-only">
                                        <div class="w-[18px] h-[18px] border-2 border-[#D1D5DB] rounded-[5px] bg-white peer-checked:bg-[#2D3FAF] peer-checked:border-[#2D3FAF] transition-all duration-200 flex items-center justify-center group-hover:border-[#2D3FAF]/50"></div>
                                        <i class="fa-solid fa-check text-[9px] text-white absolute top-[3px] left-[3px] opacity-0 peer-checked:opacity-100 transition-opacity pointer-events-none"></i>
                                    </div>
                                    <span class="text-sm text-[#6B7280] group-hover:text-[#374151] transition-colors">Ingat Saya</span>
                                </label>
                                <a href="<?= base_url('forgot-password') ?>" class="text-sm font-medium text-[#2D3FAF] hover:text-[#1D2671] transition-colors duration-200 hover:underline underline-offset-2">Lupa Sandi?</a>
                            </div>

                            <div class="pt-2">
                                <button type="submit" id="submitBtn" class="relative w-full py-3.5 bg-[#1D2671] text-white font-semibold text-[15px] rounded-xl shadow-lg shadow-[#1D2671]/20 hover:shadow-xl hover:shadow-[#1D2671]/30 hover:bg-[#2D3FAF] hover:-translate-y-0.5 active:translate-y-0 transition-all duration-250 flex justify-center items-center gap-2.5 overflow-hidden group">
                                    <span id="btnText" class="relative z-10">Masuk</span>
                                    <i class="fa-solid fa-arrow-right-to-bracket relative z-10 text-sm group-hover:translate-x-0.5 transition-transform duration-200" id="btnArrow"></i>
                                    <svg id="btnLoader" class="animate-spin h-5 w-5 text-white hidden relative z-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                                </button>
                            </div>
                        </form>

                        <div class="mt-8 pt-6 border-t border-[#F3F4F6] text-center">
                            <p class="text-sm text-[#6B7280]">Belum punya akun? <a href="<?= base_url('register') ?>" class="font-semibold text-[#2D3FAF] hover:text-[#1D2671] transition-colors duration-200 hover:underline underline-offset-2 ml-1">Registrasi Sekarang</a></p>
                        </div>
                    </div>
                </div>
                <div class="mt-8 text-center">
                    <p class="text-xs text-[#9CA3AF]">© <?= date('Y') ?> <?= esc($settings['nama_sekolah'] ?? 'SPMB') ?>. Seluruh hak cipta dilindungi.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const p = document.getElementById('password'),
                icon = document.getElementById('eyeIcon');
            const isPass = p.type === 'password';
            p.type = isPass ? 'text' : 'password';
            icon.classList.toggle('fa-eye-slash', !isPass);
            icon.classList.toggle('fa-eye', isPass);
        });
        document.getElementById('loginForm').addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.classList.add('opacity-80', 'cursor-not-allowed');
            btn.classList.remove('hover:-translate-y-0.5');
            document.getElementById('btnText').textContent = 'Memproses...';
            document.getElementById('btnArrow').classList.add('hidden');
            document.getElementById('btnLoader').classList.remove('hidden');
        });
        setTimeout(function() {
            ['alertError', 'alertSuccess'].forEach(function(id) {
                const el = document.getElementById(id);
                if (el) {
                    el.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                    el.style.opacity = '0';
                    el.style.transform = 'translateY(-8px)';
                    setTimeout(function() {
                        el.remove();
                    }, 400);
                }
            });
        }, 6000);
    </script>
</body>

</html>