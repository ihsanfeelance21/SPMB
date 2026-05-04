<?= $this->extend('layouts/user_layout') ?>

<?= $this->section('content') ?>

<div class="card p-8">
    <div class="text-center mb-10">
        <div class="w-20 h-20 bg-brand-light text-brand rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
        </div>
        <h2 class="text-2xl font-bold text-slate-800">Progres & Finalisasi Pendaftaran</h2>
        <p class="text-slate-500 mt-2">Pastikan seluruh data dan berkas yang Anda masukkan sudah benar sebelum dikirim.</p>
    </div>

    <div class="mb-10 max-w-2xl mx-auto">
        <h3 class="text-lg font-bold text-slate-700 mb-4">Status Pengisian Form</h3>
        <div class="space-y-3">
            <div class="flex justify-between items-center p-4 <?= $progress >= 25 ? 'bg-emerald-50 border-emerald-200' : 'bg-red-50 border-red-200' ?> border rounded-xl">
                <span class="font-medium <?= $progress >= 25 ? 'text-emerald-800' : 'text-red-800' ?>">1. Data Diri & Orang Tua</span>
                <?php if($progress >= 25): ?>
                    <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <?php else: ?>
                    <span class="text-xs font-bold bg-red-100 text-red-600 px-2 py-1 rounded">BELUM LENGKAP</span>
                <?php endif; ?>
            </div>
            
            <div class="flex justify-between items-center p-4 <?= $progress >= 50 ? 'bg-emerald-50 border-emerald-200' : 'bg-red-50 border-red-200' ?> border rounded-xl">
                <span class="font-medium <?= $progress >= 50 ? 'text-emerald-800' : 'text-red-800' ?>">2. Data Akademik</span>
                <?php if($progress >= 50): ?>
                    <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <?php else: ?>
                    <span class="text-xs font-bold bg-red-100 text-red-600 px-2 py-1 rounded">BELUM LENGKAP</span>
                <?php endif; ?>
            </div>

            <div class="flex justify-between items-center p-4 bg-emerald-50 border-emerald-200 border rounded-xl">
                <span class="font-medium text-emerald-800">3. Data Prestasi <span class="text-xs font-normal bg-emerald-200 px-2 py-0.5 rounded ml-1">Opsional</span></span>
                <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>

            <div class="flex justify-between items-center p-4 <?= $progress == 100 ? 'bg-emerald-50 border-emerald-200' : 'bg-red-50 border-red-200' ?> border rounded-xl">
                <span class="font-medium <?= $progress == 100 ? 'text-emerald-800' : 'text-red-800' ?>">4. Berkas Pendukung (KK & Akte)</span>
                <?php if($progress == 100): ?>
                    <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <?php else: ?>
                    <span class="text-xs font-bold bg-red-100 text-red-600 px-2 py-1 rounded">BELUM LENGKAP</span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if($user['status_pendaftaran'] !== 'Belum Dikirim'): ?>
        <div class="text-center p-6 bg-brand-light rounded-2xl max-w-2xl mx-auto border border-brand/20">
            <h3 class="text-xl font-bold text-brand-dark mb-2">Pendaftaran Telah Dikirim!</h3>
            <p class="text-slate-600">Status saat ini: <span class="font-bold text-brand-dark"><?= esc($user['status_pendaftaran']) ?></span></p>
            <p class="text-sm text-slate-500 mt-2">Anda tidak dapat lagi mengubah data. Pantau terus dashboard untuk mengetahui hasil seleksi.</p>
        </div>
    <?php else: ?>
        <div class="flex flex-col items-center justify-center pt-8 border-t border-slate-100 max-w-2xl mx-auto">
            <?php if($progress == 100): ?>
                <div class="bg-amber-50 border border-amber-200 text-amber-800 p-4 rounded-xl mb-6 text-sm">
                    <strong>Peringatan:</strong> Pastikan semua data sudah valid. Setelah menekan tombol kirim, data tidak dapat diubah lagi!
                </div>
                <form action="<?= base_url('user/kirim') ?>" method="POST" id="submitForm" class="w-full">
                    <?= csrf_field() ?>
                    <button type="submit" id="submitBtn" class="btn-primary w-full !py-4 !text-lg !rounded-2xl !bg-emerald-500 hover:!bg-emerald-600 focus:!ring-emerald-200">
                        <span id="btnText">Kirim Pendaftaran Sekarang</span>
                        <svg id="btnLoader" class="animate-spin ml-2 h-6 w-6 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </form>
            <?php else: ?>
                <button disabled class="w-full bg-slate-200 text-slate-400 py-4 text-lg rounded-2xl font-bold cursor-not-allowed">
                    Kirim Pendaftaran (Data Belum Lengkap)
                </button>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    const form = document.getElementById('submitForm');
    if (form) {
        form.addEventListener('submit', function() {
            var btn = document.getElementById('submitBtn');
            var btnText = document.getElementById('btnText');
            var btnLoader = document.getElementById('btnLoader');
            
            btn.disabled = true;
            btn.classList.add('opacity-75', 'cursor-not-allowed');
            btnText.textContent = 'Memproses Pengiriman...';
            btnLoader.classList.remove('hidden');
        });
    }
</script>
<?= $this->endSection() ?>
