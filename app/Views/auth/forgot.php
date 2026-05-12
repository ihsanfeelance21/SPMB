<!DOCTYPE html>
<html lang="id">
<head>
    <title>Lupa Sandi - <?= esc($settings['nama_sekolah'] ?? 'SPMB') ?></title>
    <?= $this->include('layouts/components/auth_head') ?>
</head>
<body class="font-sans antialiased bg-[#F8FAFC] text-[#1F2937]">
    <div class="min-h-screen flex flex-col lg:flex-row">

        <?= $this->include('layouts/components/auth_left_panel') ?>

        <!-- ===================== RIGHT PANEL: Form Lupa Sandi ===================== -->
        <div class="flex-1 flex items-center justify-center p-6 sm:p-10 lg:p-16 bg-[#F8FAFC] relative">
            <div class="absolute top-0 right-0 w-80 h-80 bg-[#2D3FAF]/[0.02] rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-60 h-60 bg-[#F4D000]/[0.03] rounded-full blur-3xl translate-y-1/3 -translate-x-1/3"></div>

            <div class="w-full max-w-md relative z-10">
                <div class="relative bg-white rounded-2xl shadow-[0_4px_40px_rgba(0,0,0,0.06)] border border-[#E5E7EB]/80 overflow-hidden">
                    <div class="absolute top-0 left-0 bottom-0 w-1 bg-gradient-to-b from-[#F4D000] via-[#F4D000] to-[#F4D000]/40"></div>

                    <div class="p-8 sm:p-10 pl-9 sm:pl-11">

                        <!-- Header with Icon -->
                        <div class="mb-8">
                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#F59E0B]/10 to-[#F4D000]/10 flex items-center justify-center mb-5 border border-[#F4D000]/20">
                                <i class="fa-solid fa-key text-xl text-[#F59E0B]"></i>
                            </div>
                            <h2 class="text-2xl sm:text-[1.65rem] font-bold text-[#1D2671] leading-snug">
                                Lupa Kata Sandi?
                            </h2>
                            <p class="mt-2.5 text-[15px] text-[#6B7280] leading-relaxed">
                                Masukkan Email atau NISN yang terdaftar. Kami akan mengirimkan instruksi untuk mereset kata sandi Anda.
                            </p>
                        </div>

                        <?php if (session()->getFlashdata('success')): ?>
                            <!-- Success State -->
                            <div class="mb-6 flex items-start gap-3 p-4 bg-[#F0FDF4] border border-[#BBF7D0] rounded-xl" id="alertSuccess">
                                <div class="flex-shrink-0 w-5 h-5 mt-0.5 rounded-full bg-[#22C55E] flex items-center justify-center"><i class="fa-solid fa-check text-white text-xs"></i></div>
                                <p class="flex-1 text-sm font-medium text-[#166534]"><?= session()->getFlashdata('success') ?></p>
                            </div>

                            <a href="<?= base_url('login') ?>" class="relative w-full py-3.5 bg-[#1D2671] text-white font-semibold text-[15px] rounded-xl shadow-lg shadow-[#1D2671]/20 hover:shadow-xl hover:shadow-[#1D2671]/30 hover:bg-[#2D3FAF] hover:-translate-y-0.5 active:translate-y-0 transition-all duration-250 flex justify-center items-center gap-2.5 overflow-hidden group">
                                <i class="fa-solid fa-arrow-left relative z-10 text-sm group-hover:-translate-x-0.5 transition-transform duration-200"></i>
                                <span class="relative z-10">Kembali ke Login</span>
                                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                            </a>

                        <?php else: ?>

                            <!-- Error Flash -->
                            <?php if (session()->getFlashdata('error')): ?>
                                <div class="mb-6 flex items-start gap-3 p-4 bg-[#FEF2F2] border border-[#FECACA] rounded-xl" id="alertError">
                                    <div class="flex-shrink-0 w-5 h-5 mt-0.5 rounded-full bg-[#EF4444] flex items-center justify-center"><i class="fa-solid fa-xmark text-white text-xs"></i></div>
                                    <p class="flex-1 text-sm font-medium text-[#991B1B]"><?= session()->getFlashdata('error') ?></p>
                                    <button onclick="this.parentElement.remove()" class="text-[#EF4444]/60 hover:text-[#EF4444]"><i class="fa-solid fa-times text-sm"></i></button>
                                </div>
                            <?php endif; ?>

                            <!-- Forgot Form -->
                            <form action="<?= base_url('forgot-password') ?>" method="POST" id="forgotForm" class="space-y-5" autocomplete="off">
                                <?= csrf_field() ?>

                                <div class="space-y-1.5">
                                    <label for="email" class="block text-sm font-semibold text-[#374151]">Email atau NISN</label>
                                    <div class="relative group">
                                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                            <i class="fa-solid fa-envelope text-[#9CA3AF] group-focus-within:text-[#2D3FAF] transition-colors duration-200"></i>
                                        </div>
                                        <input type="email" name="email" id="email" class="w-full pl-11 pr-4 py-3 bg-white border border-[#E5E7EB] rounded-xl text-[15px] text-[#1F2937] placeholder:text-[#9CA3AF] focus:outline-none focus:ring-2 focus:ring-[#2D3FAF]/20 focus:border-[#2D3FAF] transition-all duration-200 hover:border-[#D1D5DB]" placeholder="Masukkan email atau NISN terdaftar" value="<?= old('email') ?>" required autofocus>
                                    </div>
                                    <?php if (session('errors.email')): ?>
                                        <p class="text-[#EF4444] text-xs mt-1 flex items-center gap-1"><i class="fa-solid fa-circle-exclamation"></i> <?= session('errors.email') ?></p>
                                    <?php endif; ?>
                                </div>

                                <div class="pt-2">
                                    <button type="submit" id="submitBtn" class="relative w-full py-3.5 bg-[#1D2671] text-white font-semibold text-[15px] rounded-xl shadow-lg shadow-[#1D2671]/20 hover:shadow-xl hover:shadow-[#1D2671]/30 hover:bg-[#2D3FAF] hover:-translate-y-0.5 active:translate-y-0 transition-all duration-250 flex justify-center items-center gap-2.5 overflow-hidden group">
                                        <span id="btnText" class="relative z-10">Kirim Instruksi Reset</span>
                                        <i class="fa-solid fa-paper-plane relative z-10 text-sm group-hover:translate-x-0.5 transition-transform duration-200" id="btnArrow"></i>
                                        <svg id="btnLoader" class="animate-spin h-5 w-5 text-white hidden relative z-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                                    </button>
                                </div>
                            </form>

                            <!-- Back to Login -->
                            <div class="mt-8 pt-6 border-t border-[#F3F4F6] text-center">
                                <a href="<?= base_url('login') ?>" class="inline-flex items-center gap-2 text-sm font-semibold text-[#2D3FAF] hover:text-[#1D2671] transition-colors duration-200 hover:underline underline-offset-2 group">
                                    <i class="fa-solid fa-arrow-left text-xs group-hover:-translate-x-0.5 transition-transform duration-200"></i>
                                    Kembali ke halaman Login
                                </a>
                            </div>

                        <?php endif; ?>
                    </div>
                </div>
                <div class="mt-8 text-center">
                    <p class="text-xs text-[#9CA3AF]">© <?= date('Y') ?> <?= esc($settings['nama_sekolah'] ?? 'SPMB') ?>. Seluruh hak cipta dilindungi.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const form = document.getElementById('forgotForm');
        if (form) {
            form.addEventListener('submit', function () {
                const btn = document.getElementById('submitBtn'); btn.disabled = true;
                btn.classList.add('opacity-80', 'cursor-not-allowed'); btn.classList.remove('hover:-translate-y-0.5');
                document.getElementById('btnText').textContent = 'Mengirim...';
                document.getElementById('btnArrow').classList.add('hidden');
                document.getElementById('btnLoader').classList.remove('hidden');
            });
        }
        setTimeout(function () {
            ['alertError'].forEach(function (id) {
                const el = document.getElementById(id);
                if (el) { el.style.transition = 'opacity 0.4s ease, transform 0.4s ease'; el.style.opacity = '0'; el.style.transform = 'translateY(-8px)'; setTimeout(function () { el.remove(); }, 400); }
            });
        }, 6000);
    </script>
</body>
</html>