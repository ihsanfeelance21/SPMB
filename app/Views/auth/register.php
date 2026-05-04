<?= $this->extend('layouts/auth_layout') ?>

<?= $this->section('content') ?>

<div class="w-full max-w-2xl mx-auto z-10 relative">
    <div class="text-center mb-10">
        <h1 class="font-display text-4xl font-semibold text-[#003d9b] mb-2">Registrasi Akun PPDB</h1>
        <p class="text-lg text-slate-600">Pilih metode pendaftaran dan lengkapi data diri Anda.</p>
    </div>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="bg-red-50 text-red-600 p-4 rounded-lg mb-6 text-sm border border-red-100">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <div class="bg-white/70 backdrop-blur-xl border border-blue-300 shadow-[0_10px_40px_-10px_rgba(0,82,204,0.08)] rounded-xl p-8">

        <div class="flex border-b border-slate-200 mb-8">
            <button type="button" id="btn-ktp" onclick="switchTab('KTP')" class="flex-1 pb-4 text-[14px] font-semibold text-[#0052cc] border-b-2 border-[#0052cc] text-center transition-all">
                Kartu Pelajar (NISN)
            </button>
            <button type="button" id="btn-kk" onclick="switchTab('KK')" class="flex-1 pb-4 text-[14px] font-medium text-slate-500 hover:text-[#0052cc] border-b-2 border-transparent text-center transition-all">
                Kartu Keluarga (KK)
            </button>
        </div>

        <form action="<?= base_url('register') ?>" method="POST" enctype="multipart/form-data" id="registerForm" class="space-y-6">
            <?= csrf_field() ?>

            <input type="hidden" name="jenis_identitas" id="jenis_identitas" value="<?= old('jenis_identitas', 'KTP') ?>">
            <?php if (session('errors.jenis_identitas')): ?>
                <p class="text-red-500 text-xs mt-1"><?= session('errors.jenis_identitas') ?></p>
            <?php endif; ?>

            <div class="space-y-2">
                <label for="nama_lengkap" class="block text-[13px] font-bold text-slate-800">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" class="w-full px-4 py-3 bg-white border border-slate-300 rounded-md focus:outline-none focus:border-[#0052cc] focus:ring-1 focus:ring-[#0052cc] text-sm text-slate-800 placeholder-slate-400 transition-all" placeholder="Masukkan nama lengkap sesuai ijazah" value="<?= old('nama_lengkap') ?>" required>
                <?php if (session('errors.nama_lengkap')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= session('errors.nama_lengkap') ?></p>
                <?php endif; ?>
            </div>

            <div class="space-y-2">
                <label for="no_identitas" id="label_no_identitas" class="block text-[13px] font-bold text-slate-800">NISN (Nomor Induk Siswa Nasional)</label>
                <input type="text" name="no_identitas" id="no_identitas" class="w-full px-4 py-3 bg-white border border-slate-300 rounded-md focus:outline-none focus:border-[#0052cc] focus:ring-1 focus:ring-[#0052cc] text-sm text-slate-800 placeholder-slate-400 transition-all" placeholder="Masukkan 10 digit NISN" value="<?= old('no_identitas') ?>" required>
                <?php if (session('errors.no_identitas')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= session('errors.no_identitas') ?></p>
                <?php endif; ?>
            </div>

            <div class="space-y-2">
                <label for="email" class="block text-[13px] font-bold text-slate-800">Alamat Email</label>
                <input type="email" name="email" id="email" class="w-full px-4 py-3 bg-white border border-slate-300 rounded-md focus:outline-none focus:border-[#0052cc] focus:ring-1 focus:ring-[#0052cc] text-sm text-slate-800 placeholder-slate-400 transition-all" placeholder="contoh@email.com" value="<?= old('email') ?>" required>
                <?php if (session('errors.email')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= session('errors.email') ?></p>
                <?php endif; ?>
            </div>

            <div class="space-y-2">
                <label for="password" class="block text-[13px] font-bold text-slate-800">Password</label>
                <input type="password" name="password" id="password" class="w-full px-4 py-3 bg-white border border-slate-300 rounded-md focus:outline-none focus:border-[#0052cc] focus:ring-1 focus:ring-[#0052cc] text-sm text-slate-800 placeholder-slate-400 transition-all" placeholder="Minimal 6 karakter" required minlength="6">
                <?php if (session('errors.password')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= session('errors.password') ?></p>
                <?php endif; ?>
            </div>

            <div class="space-y-2 pt-2">
                <label id="label_file_identitas" class="block text-[13px] font-bold text-slate-800">Upload Kartu Pelajar</label>
                <div class="mt-1 flex justify-center rounded-lg border-2 border-dashed border-slate-300 px-6 py-12 hover:border-[#0052cc] hover:bg-slate-50 transition-colors bg-white cursor-pointer group" onclick="document.getElementById('file_identitas').click()">
                    <div class="text-center">
                        <i class="fa-solid fa-file-arrow-up text-3xl text-slate-400 group-hover:text-[#0052cc] transition-colors mb-3"></i>
                        <div class="flex text-[13px] leading-6 text-slate-600 justify-center items-center">
                            <span class="font-semibold text-[#0052cc]">Pilih file</span>
                            <span class="pl-1">atau drag & drop</span>
                            <input class="sr-only" id="file_identitas" name="file_identitas" type="file" accept=".png, .jpg, .jpeg, .pdf" required />
                        </div>
                        <p class="text-[11px] text-slate-400 mt-1">PNG, JPG, PDF (Maks. 2MB)</p>
                        <p id="file-name" class="text-[13px] font-semibold text-[#0052cc] mt-3 hidden"></p>
                    </div>
                </div>
                <?php if (session('errors.file_identitas')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= session('errors.file_identitas') ?></p>
                <?php endif; ?>
            </div>

            <div class="pt-6">
                <button type="submit" id="submitBtn" class="w-full flex justify-center items-center py-3 px-8 border border-transparent rounded-lg text-white bg-[#0052cc] hover:bg-[#0047b3] focus:outline-none transition-all font-medium text-[15px]">
                    <span id="btnText">Daftar Sekarang</span>
                    <svg id="btnLoader" class="animate-spin ml-2 h-5 w-5 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>
            </div>
        </form>

        <div class="mt-8 text-center">
            <p class="text-[14px] text-slate-600">Sudah punya akun? <a href="<?= base_url('login') ?>" class="font-semibold text-[#0052cc] hover:text-[#0047b3] transition-colors">Login</a></p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function switchTab(jenis) {
        const btnKTP = document.getElementById('btn-ktp');
        const btnKK = document.getElementById('btn-kk');
        const jenisIdentitas = document.getElementById('jenis_identitas');

        const labelNoIdentitas = document.getElementById('label_no_identitas');
        const inputNoIdentitas = document.getElementById('no_identitas');
        const labelFileIdentitas = document.getElementById('label_file_identitas');

        // Style untuk tab aktif dan tidak aktif agar persis seperti gambar
        const activeClass = "flex-1 pb-4 text-[14px] font-semibold text-[#0052cc] border-b-2 border-[#0052cc] text-center transition-all";
        const inactiveClass = "flex-1 pb-4 text-[14px] font-medium text-slate-500 hover:text-[#0052cc] border-b-2 border-transparent text-center transition-all";

        jenisIdentitas.value = jenis;

        if (jenis === 'KTP') {
            btnKTP.className = activeClass;
            btnKK.className = inactiveClass;

            labelNoIdentitas.innerText = 'NISN (Nomor Induk Siswa Nasional)';
            inputNoIdentitas.placeholder = 'Masukkan 10 digit NISN';
            labelFileIdentitas.innerText = 'Upload Kartu Pelajar';
        } else {
            btnKK.className = activeClass;
            btnKTP.className = inactiveClass;

            labelNoIdentitas.innerText = 'NIK (Nomor Induk Kependudukan)';
            inputNoIdentitas.placeholder = 'Masukkan 16 digit NIK dari Kartu Keluarga';
            labelFileIdentitas.innerText = 'Upload Kartu Keluarga (KK)';
        }
    }

    // Tampilkan nama file saat file di-upload
    document.getElementById('file_identitas').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name;
        const fileNameDisplay = document.getElementById('file-name');
        if (fileName) {
            fileNameDisplay.innerText = "File terpilih: " + fileName;
            fileNameDisplay.classList.remove('hidden');
        } else {
            fileNameDisplay.classList.add('hidden');
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Panggil fungsi sekali saat halaman dimuat agar UI sesuai dengan nilai "old" session
        const currentJenis = document.getElementById('jenis_identitas').value;
        switchTab(currentJenis);
    });

    // Animasi Loading Submit Button
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