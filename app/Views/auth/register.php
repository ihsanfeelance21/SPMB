<!DOCTYPE html>
<html lang="id">
<head>
    <title>Registrasi - <?= esc($settings['nama_sekolah'] ?? 'SPMB') ?></title>
    <?= $this->include('layouts/components/auth_head') ?>
</head>
<body class="font-sans antialiased bg-[#F8FAFC] text-[#1F2937]">
    <div class="min-h-screen flex flex-col lg:flex-row">

        <?= $this->include('layouts/components/auth_left_panel') ?>

        <!-- ===================== RIGHT PANEL: Form Registrasi ===================== -->
        <div class="flex-1 flex items-center justify-center p-6 sm:p-10 lg:p-12 bg-[#F8FAFC] relative">
            <div class="absolute top-0 right-0 w-80 h-80 bg-[#2D3FAF]/[0.02] rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-60 h-60 bg-[#F4D000]/[0.03] rounded-full blur-3xl translate-y-1/3 -translate-x-1/3"></div>

            <div class="w-full max-w-lg relative z-10">
                <div class="relative bg-white rounded-2xl shadow-[0_4px_40px_rgba(0,0,0,0.06)] border border-[#E5E7EB]/80 overflow-hidden">
                    <div class="absolute top-0 left-0 bottom-0 w-1 bg-gradient-to-b from-[#F4D000] via-[#F4D000] to-[#F4D000]/40"></div>

                    <div class="p-8 sm:p-10 pl-9 sm:pl-11">

                        <!-- Header -->
                        <div class="mb-7">
                            <h2 class="text-2xl sm:text-[1.65rem] font-bold text-[#1D2671] leading-snug flex items-center gap-2.5">
                                <div class="w-9 h-9 rounded-lg bg-[#1D2671]/10 flex items-center justify-center flex-shrink-0">
                                    <i class="fa-solid fa-user-plus text-[#1D2671] text-sm"></i>
                                </div>
                                Registrasi Akun PPDB
                            </h2>
                            <p class="mt-2 text-[15px] text-[#6B7280] leading-relaxed">Pilih metode pendaftaran dan lengkapi data diri Anda.</p>
                        </div>

                        <!-- Flash Messages -->
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="mb-5 flex items-start gap-3 p-4 bg-[#FEF2F2] border border-[#FECACA] rounded-xl" id="alertError">
                                <div class="flex-shrink-0 w-5 h-5 mt-0.5 rounded-full bg-[#EF4444] flex items-center justify-center"><i class="fa-solid fa-xmark text-white text-xs"></i></div>
                                <p class="flex-1 text-sm font-medium text-[#991B1B]"><?= session()->getFlashdata('error') ?></p>
                                <button onclick="this.parentElement.remove()" class="text-[#EF4444]/60 hover:text-[#EF4444]"><i class="fa-solid fa-times text-sm"></i></button>
                            </div>
                        <?php endif; ?>

                        <!-- Tab Navigation -->
                        <div class="flex border-b border-[#E5E7EB] mb-7">
                            <button type="button" id="btn-ktp" onclick="switchTab('KTP')" class="flex-1 pb-3 text-sm font-semibold text-[#2D3FAF] border-b-2 border-[#2D3FAF] text-center transition-all duration-200 flex items-center justify-center gap-2">
                                <i class="fa-solid fa-id-card text-xs"></i> Kartu Pelajar (NISN)
                            </button>
                            <button type="button" id="btn-kk" onclick="switchTab('KK')" class="flex-1 pb-3 text-sm font-medium text-[#9CA3AF] hover:text-[#2D3FAF] border-b-2 border-transparent text-center transition-all duration-200 flex items-center justify-center gap-2">
                                <i class="fa-solid fa-users text-xs"></i> Kartu Keluarga (KK)
                            </button>
                        </div>

                        <!-- Register Form -->
                        <form action="<?= base_url('register') ?>" method="POST" enctype="multipart/form-data" id="registerForm" class="space-y-5" autocomplete="off">
                            <?= csrf_field() ?>
                            <input type="hidden" name="jenis_identitas" id="jenis_identitas" value="<?= old('jenis_identitas', 'KTP') ?>">

                            <!-- Nama Lengkap -->
                            <div class="space-y-1.5">
                                <label for="nama_lengkap" class="block text-sm font-semibold text-[#374151]">Nama Lengkap</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                        <i class="fa-solid fa-user text-[#9CA3AF] group-focus-within:text-[#2D3FAF] transition-colors duration-200"></i>
                                    </div>
                                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="w-full pl-11 pr-4 py-3 bg-white border border-[#E5E7EB] rounded-xl text-[15px] text-[#1F2937] placeholder:text-[#9CA3AF] focus:outline-none focus:ring-2 focus:ring-[#2D3FAF]/20 focus:border-[#2D3FAF] transition-all duration-200 hover:border-[#D1D5DB]" placeholder="Masukkan nama lengkap sesuai ijazah" value="<?= old('nama_lengkap') ?>" required>
                                </div>
                                <?php if (session('errors.nama_lengkap')): ?>
                                    <p class="text-[#EF4444] text-xs mt-1 flex items-center gap-1"><i class="fa-solid fa-circle-exclamation"></i> <?= session('errors.nama_lengkap') ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- No Identitas (NISN / NIK) -->
                            <div class="space-y-1.5">
                                <label for="no_identitas" id="label_no_identitas" class="block text-sm font-semibold text-[#374151]">NISN (Nomor Induk Siswa Nasional)</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                        <i class="fa-solid fa-hashtag text-[#9CA3AF] group-focus-within:text-[#2D3FAF] transition-colors duration-200"></i>
                                    </div>
                                    <input type="text" name="no_identitas" id="no_identitas" class="w-full pl-11 pr-4 py-3 bg-white border border-[#E5E7EB] rounded-xl text-[15px] text-[#1F2937] placeholder:text-[#9CA3AF] focus:outline-none focus:ring-2 focus:ring-[#2D3FAF]/20 focus:border-[#2D3FAF] transition-all duration-200 hover:border-[#D1D5DB]" placeholder="Masukkan 10 digit NISN" value="<?= old('no_identitas') ?>" required>
                                </div>
                                <?php if (session('errors.no_identitas')): ?>
                                    <p class="text-[#EF4444] text-xs mt-1 flex items-center gap-1"><i class="fa-solid fa-circle-exclamation"></i> <?= session('errors.no_identitas') ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- Email -->
                            <div class="space-y-1.5">
                                <label for="email" class="block text-sm font-semibold text-[#374151]">Alamat Email</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                        <i class="fa-solid fa-envelope text-[#9CA3AF] group-focus-within:text-[#2D3FAF] transition-colors duration-200"></i>
                                    </div>
                                    <input type="email" name="email" id="email" class="w-full pl-11 pr-4 py-3 bg-white border border-[#E5E7EB] rounded-xl text-[15px] text-[#1F2937] placeholder:text-[#9CA3AF] focus:outline-none focus:ring-2 focus:ring-[#2D3FAF]/20 focus:border-[#2D3FAF] transition-all duration-200 hover:border-[#D1D5DB]" placeholder="contoh@email.com" value="<?= old('email') ?>" required>
                                </div>
                                <?php if (session('errors.email')): ?>
                                    <p class="text-[#EF4444] text-xs mt-1 flex items-center gap-1"><i class="fa-solid fa-circle-exclamation"></i> <?= session('errors.email') ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- Password -->
                            <div class="space-y-1.5">
                                <label for="password" class="block text-sm font-semibold text-[#374151]">Kata Sandi</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                        <i class="fa-solid fa-lock text-[#9CA3AF] group-focus-within:text-[#2D3FAF] transition-colors duration-200"></i>
                                    </div>
                                    <input type="password" name="password" id="password" class="w-full pl-11 pr-12 py-3 bg-white border border-[#E5E7EB] rounded-xl text-[15px] text-[#1F2937] placeholder:text-[#9CA3AF] focus:outline-none focus:ring-2 focus:ring-[#2D3FAF]/20 focus:border-[#2D3FAF] transition-all duration-200 hover:border-[#D1D5DB]" placeholder="Minimal 6 karakter" required minlength="6">
                                    <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-[#9CA3AF] hover:text-[#2D3FAF] transition-colors duration-200 focus:outline-none">
                                        <i class="fa-solid fa-eye-slash text-base" id="eyeIcon"></i>
                                    </button>
                                </div>
                                <?php if (session('errors.password')): ?>
                                    <p class="text-[#EF4444] text-xs mt-1 flex items-center gap-1"><i class="fa-solid fa-circle-exclamation"></i> <?= session('errors.password') ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- File Upload -->
                            <div class="space-y-1.5 pt-1">
                                <label id="label_file_identitas" class="block text-sm font-semibold text-[#374151]">Upload Kartu Pelajar</label>
                                <div class="relative group cursor-pointer" onclick="document.getElementById('file_identitas').click()">
                                    <div class="border-2 border-dashed border-[#D1D5DB] group-hover:border-[#2D3FAF] rounded-xl p-6 sm:p-8 text-center transition-all duration-200 group-hover:bg-[#2D3FAF]/[0.02]">
                                        <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-[#F3F4F6] group-hover:bg-[#2D3FAF]/10 flex items-center justify-center transition-colors duration-200">
                                            <i class="fa-solid fa-cloud-arrow-up text-xl text-[#9CA3AF] group-hover:text-[#2D3FAF] transition-colors duration-200"></i>
                                        </div>
                                        <p class="text-sm text-[#6B7280]">
                                            <span class="font-semibold text-[#2D3FAF]">Pilih file</span> atau drag & drop
                                        </p>
                                        <p class="text-xs text-[#9CA3AF] mt-1">PNG, JPG, PDF (Maks. 2MB)</p>
                                        <p id="file-name" class="text-sm font-semibold text-[#22C55E] mt-3 hidden flex items-center justify-center gap-1.5">
                                            <i class="fa-solid fa-circle-check text-xs"></i>
                                            <span id="file-name-text"></span>
                                        </p>
                                    </div>
                                    <input class="sr-only" id="file_identitas" name="file_identitas" type="file" accept=".png,.jpg,.jpeg,.pdf" required>
                                </div>
                                <?php if (session('errors.file_identitas')): ?>
                                    <p class="text-[#EF4444] text-xs mt-1 flex items-center gap-1"><i class="fa-solid fa-circle-exclamation"></i> <?= session('errors.file_identitas') ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- Submit -->
                            <div class="pt-2">
                                <button type="submit" id="submitBtn" class="relative w-full py-3.5 bg-[#1D2671] text-white font-semibold text-[15px] rounded-xl shadow-lg shadow-[#1D2671]/20 hover:shadow-xl hover:shadow-[#1D2671]/30 hover:bg-[#2D3FAF] hover:-translate-y-0.5 active:translate-y-0 transition-all duration-250 flex justify-center items-center gap-2.5 overflow-hidden group">
                                    <span id="btnText" class="relative z-10">Daftar Sekarang</span>
                                    <i class="fa-solid fa-arrow-right relative z-10 text-sm group-hover:translate-x-0.5 transition-transform duration-200" id="btnArrow"></i>
                                    <svg id="btnLoader" class="animate-spin h-5 w-5 text-white hidden relative z-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                                </button>
                            </div>
                        </form>

                        <!-- Login Link -->
                        <div class="mt-7 pt-5 border-t border-[#F3F4F6] text-center">
                            <p class="text-sm text-[#6B7280]">Sudah punya akun? <a href="<?= base_url('login') ?>" class="font-semibold text-[#2D3FAF] hover:text-[#1D2671] transition-colors duration-200 hover:underline underline-offset-2 ml-1">Login</a></p>
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
        // ==================== Tab Switching ====================
        function switchTab(jenis) {
            const btnKTP = document.getElementById('btn-ktp');
            const btnKK = document.getElementById('btn-kk');
            const activeClass = "flex-1 pb-3 text-sm font-semibold text-[#2D3FAF] border-b-2 border-[#2D3FAF] text-center transition-all duration-200 flex items-center justify-center gap-2";
            const inactiveClass = "flex-1 pb-3 text-sm font-medium text-[#9CA3AF] hover:text-[#2D3FAF] border-b-2 border-transparent text-center transition-all duration-200 flex items-center justify-center gap-2";

            document.getElementById('jenis_identitas').value = jenis;

            if (jenis === 'KTP') {
                btnKTP.className = activeClass; btnKK.className = inactiveClass;
                document.getElementById('label_no_identitas').innerText = 'NISN (Nomor Induk Siswa Nasional)';
                document.getElementById('no_identitas').placeholder = 'Masukkan 10 digit NISN';
                document.getElementById('label_file_identitas').innerText = 'Upload Kartu Pelajar';
            } else {
                btnKK.className = activeClass; btnKTP.className = inactiveClass;
                document.getElementById('label_no_identitas').innerText = 'NIK (Nomor Induk Kependudukan)';
                document.getElementById('no_identitas').placeholder = 'Masukkan 16 digit NIK dari Kartu Keluarga';
                document.getElementById('label_file_identitas').innerText = 'Upload Kartu Keluarga (KK)';
            }
        }

        // ==================== File Upload Preview ====================
        document.getElementById('file_identitas').addEventListener('change', function (e) {
            const file = e.target.files[0];
            const display = document.getElementById('file-name');
            const nameText = document.getElementById('file-name-text');
            if (file) { nameText.textContent = 'File terpilih: ' + file.name; display.classList.remove('hidden'); }
            else { display.classList.add('hidden'); }
        });

        // ==================== Password Toggle ====================
        document.getElementById('togglePassword').addEventListener('click', function () {
            const p = document.getElementById('password'), icon = document.getElementById('eyeIcon');
            const isPass = p.type === 'password'; p.type = isPass ? 'text' : 'password';
            icon.classList.toggle('fa-eye-slash', !isPass); icon.classList.toggle('fa-eye', isPass);
        });

        // ==================== Form Submit Loading ====================
        document.getElementById('registerForm').addEventListener('submit', function () {
            const btn = document.getElementById('submitBtn'); btn.disabled = true;
            btn.classList.add('opacity-80', 'cursor-not-allowed'); btn.classList.remove('hover:-translate-y-0.5');
            document.getElementById('btnText').textContent = 'Memproses...';
            document.getElementById('btnArrow').classList.add('hidden');
            document.getElementById('btnLoader').classList.remove('hidden');
        });

        // ==================== Init Tab ====================
        document.addEventListener('DOMContentLoaded', function () {
            switchTab(document.getElementById('jenis_identitas').value || 'KTP');
        });

        // ==================== Auto-dismiss alerts ====================
        setTimeout(function () {
            const el = document.getElementById('alertError');
            if (el) { el.style.transition = 'opacity 0.4s ease, transform 0.4s ease'; el.style.opacity = '0'; el.style.transform = 'translateY(-8px)'; setTimeout(function () { el.remove(); }, 400); }
        }, 6000);
    </script>
</body>
</html>