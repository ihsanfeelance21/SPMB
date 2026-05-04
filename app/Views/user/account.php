<?= $this->extend('layouts/user_layout') ?>

<?= $this->section('content') ?>

<div class="card p-8 max-w-2xl">
    <div class="mb-8 border-b border-slate-200 pb-4">
        <h2 class="text-xl font-bold text-slate-800">Ubah Password</h2>
        <p class="text-sm text-slate-500 mt-1">Ganti password secara berkala untuk menjaga keamanan akun Anda.</p>
    </div>

    <form action="<?= base_url('user/account') ?>" method="POST">
        <?= csrf_field() ?>

        <div class="space-y-6">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1">Password Lama</label>
                <input type="password" name="password_lama" class="input-field" placeholder="Masukkan password saat ini" required>
                <?php if(session('errors.password_lama')): ?><p class="text-red-500 text-xs mt-1"><?= session('errors.password_lama') ?></p><?php endif; ?>
            </div>

            <div class="border-t border-slate-100 pt-6">
                <label class="block text-sm font-bold text-slate-700 mb-1">Password Baru</label>
                <input type="password" name="password_baru" class="input-field" placeholder="Minimal 6 karakter" required minlength="6">
                <?php if(session('errors.password_baru')): ?><p class="text-red-500 text-xs mt-1"><?= session('errors.password_baru') ?></p><?php endif; ?>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1">Konfirmasi Password Baru</label>
                <input type="password" name="konfirmasi" class="input-field" placeholder="Ketik ulang password baru" required minlength="6">
                <?php if(session('errors.konfirmasi')): ?><p class="text-red-500 text-xs mt-1"><?= session('errors.konfirmasi') ?></p><?php endif; ?>
            </div>
        </div>

        <div class="mt-8">
            <button type="submit" class="btn-primary w-full md:w-auto">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path></svg>
                Perbarui Password
            </button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
