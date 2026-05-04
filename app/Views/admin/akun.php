<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>

<?php if(session()->get('role') === 'superadmin'): ?>
<!-- Profil Superadmin -->
<div class="card p-6 mb-6 border-l-4 border-l-violet-500">
    <div class="mb-6 border-b border-slate-100 pb-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-gradient-to-br from-violet-500 to-purple-600 rounded-full flex items-center justify-center shadow-md">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            </div>
            <div>
                <h2 class="text-xl font-bold text-slate-800">Update Profil Superadmin</h2>
                <p class="text-sm text-slate-500 mt-0.5">Ubah username dan password akun superadmin Anda.</p>
            </div>
        </div>
    </div>

    <form action="<?= base_url('admin/akun/profil') ?>" method="POST" id="formProfilSuperadmin">
        <?= csrf_field() ?>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-slate-700 mb-1">Email <span class="text-slate-400 font-normal">(tidak dapat diubah)</span></label>
                <input type="email" value="<?= esc(session()->get('email')) ?>" class="input-field bg-slate-100 cursor-not-allowed" disabled>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-slate-700 mb-1">Username <span class="text-red-500">*</span></label>
                <input type="text" name="username" value="<?= old('username', session()->get('username')) ?>" class="input-field" required minlength="3" maxlength="255" id="inputUsernameSuperadmin">
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1">Password Baru <span class="text-slate-400 font-normal">(opsional)</span></label>
                <input type="password" name="password_baru" class="input-field" minlength="6" placeholder="Kosongkan jika tidak ingin ubah" id="inputPasswordBaru">
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1">Konfirmasi Password</label>
                <input type="password" name="konfirmasi_password" class="input-field" minlength="6" placeholder="Ulangi password baru" id="inputKonfirmasiPassword">
            </div>
        </div>
        <div class="mt-6 flex justify-end">
            <button type="submit" class="btn-primary">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
<?php endif; ?>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

    <!-- Ubah Password Admin -->
    <div class="card p-6">
        <div class="mb-6 border-b border-slate-100 pb-4">
            <h2 class="text-xl font-bold text-slate-800">Ubah Password Admin</h2>
            <p class="text-sm text-slate-500 mt-1">Ganti kata sandi akun administrator secara berkala.</p>
        </div>

        <form action="<?= base_url('admin/akun/password') ?>" method="POST">
            <?= csrf_field() ?>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Password Lama</label>
                    <input type="password" name="password_lama" class="input-field" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Password Baru</label>
                    <input type="password" name="password_baru" class="input-field" required minlength="6">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Konfirmasi Password</label>
                    <input type="password" name="konfirmasi" class="input-field" required minlength="6">
                </div>
            </div>
            <div class="mt-6 flex justify-end">
                <button type="submit" class="btn-primary">Perbarui Password</button>
            </div>
        </form>
    </div>

    <!-- Reset Password Users -->
    <div class="card p-6 border-l-4 border-l-red-500">
        <div class="mb-6 border-b border-slate-100 pb-4">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-bold text-slate-800">Permintaan Reset Password</h2>
                    <p class="text-sm text-slate-500 mt-1">Pengguna yang lupa password akan tampil di sini.</p>
                </div>
                <div class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-bold">
                    <?= count($resets) ?> Permintaan
                </div>
            </div>
        </div>

        <?php if(empty($resets)): ?>
            <div class="text-center py-10">
                <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p class="text-slate-500">Tidak ada permintaan reset saat ini.</p>
            </div>
        <?php else: ?>
            <div class="space-y-4">
                <?php foreach($resets as $r): ?>
                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-xl border border-slate-200">
                        <div>
                            <p class="font-bold text-slate-800"><?= esc($r['email']) ?></p>
                            <p class="text-xs text-slate-500">Diminta pada: <?= date('d M Y H:i', strtotime($r['created_at'])) ?></p>
                        </div>
                        <form action="<?= base_url('admin/akun/reset') ?>" method="POST">
                            <?= csrf_field() ?>
                            <input type="hidden" name="email" value="<?= esc($r['email']) ?>">
                            <input type="hidden" name="reset_id" value="<?= esc($r['id']) ?>">
                            <button type="submit" onclick="return confirm('Reset password untuk akun ini?')" class="bg-red-500 hover:bg-red-600 text-white text-xs font-bold px-3 py-2 rounded-lg transition-colors shadow-sm">
                                Reset Paksa
                            </button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Daftar Semua Akun -->
<div class="card p-6">
    <div class="mb-6 border-b border-slate-100 pb-4">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-slate-800">Daftar Semua Akun</h2>
                <p class="text-sm text-slate-500 mt-1">Kelola akun pengguna, admin, dan superadmin terdaftar.</p>
            </div>
            <div class="bg-brand-light text-brand-dark px-3 py-1 rounded-full text-xs font-bold">
                <?= count($users) ?> Akun
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="datatable w-full text-sm text-left" id="tableAkun">
            <thead>
                <tr class="bg-slate-50 text-slate-600 uppercase text-xs tracking-wider">
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Username</th>
                    <th class="px-4 py-3">Role</th>
                    <th class="px-4 py-3">Verifikasi</th>
                    <th class="px-4 py-3">Terdaftar</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach($users as $u): ?>
                <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors">
                    <td class="px-4 py-3 font-medium text-slate-600"><?= $no++ ?></td>
                    <td class="px-4 py-3 font-medium text-slate-800"><?= esc($u['email']) ?></td>
                    <td class="px-4 py-3 text-slate-600"><?= esc($u['username']) ?></td>
                    <td class="px-4 py-3">
                        <?php if($u['role'] === 'superadmin'): ?>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-violet-100 to-purple-100 text-violet-700 border border-violet-200">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                Superadmin
                            </span>
                        <?php elseif($u['role'] === 'admin'): ?>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700 border border-blue-200">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path></svg>
                                Admin
                            </span>
                        <?php else: ?>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200">
                                User
                            </span>
                        <?php endif; ?>
                    </td>
                    <td class="px-4 py-3">
                        <?php if($u['is_verified']): ?>
                            <span class="inline-flex items-center text-emerald-600 text-xs font-bold">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Terverifikasi
                            </span>
                        <?php else: ?>
                            <span class="inline-flex items-center text-amber-600 text-xs font-bold">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01"></path></svg>
                                Pending
                            </span>
                        <?php endif; ?>
                    </td>
                    <td class="px-4 py-3 text-slate-500 text-xs"><?= date('d M Y', strtotime($u['created_at'])) ?></td>
                    <td class="px-4 py-3 text-center">
                        <?php if((int)$u['id'] === (int)session()->get('id')): ?>
                            <span class="text-xs text-slate-400 italic">Akun Anda</span>
                        <?php elseif($u['role'] === 'superadmin'): ?>
                            <span class="inline-flex items-center text-xs text-violet-500 font-medium">
                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                Dilindungi
                            </span>
                        <?php else: ?>
                            <form action="<?= base_url('admin/akun/delete') ?>" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus akun <?= esc($u['email']) ?>? Data terkait juga akan dihapus.')">
                                <?= csrf_field() ?>
                                <input type="hidden" name="id" value="<?= $u['id'] ?>">
                                <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg text-xs font-bold transition-colors border border-red-200 hover:border-red-300">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    Hapus
                                </button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
