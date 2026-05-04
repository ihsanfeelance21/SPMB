<?= $this->extend('layouts/auth_layout') ?>

<?= $this->section('content') ?>

    <div class="w-full max-w-md bg-surface-light rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
        <div class="p-8">
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-brand-light text-brand rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-brand-dark mb-2">Lupa Password?</h1>
                <p class="text-slate-500 text-sm">Masukkan email yang terdaftar, kami akan mengirim permohonan reset password ke Admin.</p>
            </div>

            <?php if(session()->getFlashdata('success')): ?>
                <div class="bg-green-50 text-green-700 p-4 rounded-xl mb-6 text-sm border border-green-100 text-center">
                    <?= session()->getFlashdata('success') ?>
                </div>
                <div class="mt-6 text-center">
                    <a href="<?= base_url('login') ?>" class="btn-primary">Kembali ke Halaman Login</a>
                </div>
            <?php else: ?>

                <?php if(session()->getFlashdata('error')): ?>
                    <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-6 text-sm border border-red-100">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('forgot-password') ?>" method="POST" id="forgotForm" class="space-y-5">
                    <?= csrf_field() ?>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-600 mb-1">Email Aktif</label>
                        <input type="email" name="email" id="email" class="input-field" placeholder="contoh@email.com" value="<?= old('email') ?>" required autofocus>
                        <?php if(session('errors.email')): ?>
                            <p class="text-red-500 text-xs mt-1"><?= session('errors.email') ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="pt-2">
                        <button type="submit" id="submitBtn" class="btn-primary">
                            <span id="btnText">Kirim Permohonan</span>
                            <svg id="btnLoader" class="animate-spin ml-2 h-5 w-5 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </div>
                </form>
                
                <div class="mt-8 text-center">
                    <a href="<?= base_url('login') ?>" class="text-sm font-semibold text-slate-500 hover:text-brand transition-colors flex items-center justify-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali ke Login
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    let form = document.getElementById('forgotForm');
    if (form) {
        form.addEventListener('submit', function() {
            var btn = document.getElementById('submitBtn');
            var btnText = document.getElementById('btnText');
            var btnLoader = document.getElementById('btnLoader');
            
            btn.disabled = true;
            btn.classList.add('opacity-75', 'cursor-not-allowed');
            btnText.textContent = 'Mengirim...';
            btnLoader.classList.remove('hidden');
        });
    }
</script>
<?= $this->endSection() ?>
