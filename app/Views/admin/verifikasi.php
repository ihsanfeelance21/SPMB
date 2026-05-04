<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>

<div class="card p-6">
    <div class="mb-6 border-b border-slate-100 pb-4">
        <h2 class="text-xl font-bold text-slate-800">Verifikasi Akun Pendaftar</h2>
        <p class="text-sm text-slate-500 mt-1">Daftar akun baru yang telah mendaftar di sistem. Verifikasi akun agar mereka dapat melanjutkan proses pengisian data.</p>
    </div>

    <table class="datatable w-full text-sm text-left text-slate-600">
        <thead class="text-xs text-slate-700 uppercase bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-4 py-3 rounded-tl-lg">Tgl Daftar</th>
                <th class="px-4 py-3">Email</th>
                <th class="px-4 py-3">Nama Lengkap</th>
                <th class="px-4 py-3">No Identitas</th>
                <th class="px-4 py-3 text-center">Status</th>
                <th class="px-4 py-3 text-center rounded-tr-lg">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($pendaftar as $p): ?>
            <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors">
                <td class="px-4 py-3 whitespace-nowrap"><?= date('d M Y H:i', strtotime($p['created_at'])) ?></td>
                <td class="px-4 py-3 font-medium text-slate-800"><?= esc($p['email']) ?></td>
                <td class="px-4 py-3"><?= esc($p['nama_lengkap'] ?? '-') ?></td>
                <td class="px-4 py-3">
                    <?= esc($p['no_identitas'] ?? '-') ?>
                    <?php if(!empty($p['jenis_identitas'])): ?>
                        <span class="text-[10px] bg-slate-200 text-slate-600 px-1.5 py-0.5 rounded ml-1"><?= esc($p['jenis_identitas']) ?></span>
                    <?php endif; ?>
                </td>
                <td class="px-4 py-3 text-center">
                    <?php if($p['is_verified']): ?>
                        <span class="bg-emerald-100 text-emerald-700 text-xs font-bold px-2.5 py-1 rounded-full border border-emerald-200">Terverifikasi</span>
                    <?php else: ?>
                        <span class="bg-amber-100 text-amber-700 text-xs font-bold px-2.5 py-1 rounded-full border border-amber-200">Menunggu</span>
                    <?php endif; ?>
                </td>
                <td class="px-4 py-3 text-center">
                    <?php if(!$p['is_verified']): ?>
                        <form action="<?= base_url('admin/verifikasi/ubah') ?>" method="POST" class="inline-block">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id" value="<?= $p['id'] ?>">
                            <button type="submit" name="action" value="approve" class="bg-emerald-500 hover:bg-emerald-600 text-white p-1.5 rounded-lg shadow-sm transition-colors" title="Setujui Verifikasi">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </button>
                        </form>
                    <?php else: ?>
                        <span class="text-xs text-slate-400 italic">Selesai</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
