<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>

<div class="card p-6">
    <div class="mb-6 border-b border-slate-100 pb-4">
        <h2 class="text-xl font-bold text-slate-800">Seleksi Calon Siswa Baru</h2>
        <p class="text-sm text-slate-500 mt-1">Daftar pendaftar yang telah melengkapi data dan mengirimkan pendaftaran. Tentukan status kelulusan mereka.</p>
    </div>

    <table class="datatable w-full text-sm text-left text-slate-600">
        <thead class="text-xs text-slate-700 uppercase bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-4 py-3 rounded-tl-lg">ID</th>
                <th class="px-4 py-3">Nama Lengkap</th>
                <th class="px-4 py-3">Asal Sekolah</th>
                <th class="px-4 py-3 text-center">Nilai Rapor</th>
                <th class="px-4 py-3 text-center">Status Saat Ini</th>
                <th class="px-4 py-3 text-center rounded-tr-lg">Aksi Seleksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($pendaftar as $p): ?>
            <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors">
                <td class="px-4 py-3 font-medium">#<?= str_pad($p['id'], 4, '0', STR_PAD_LEFT) ?></td>
                <td class="px-4 py-3 font-bold text-slate-800"><?= esc($p['nama_lengkap'] ?? 'Data Belum Lengkap') ?></td>
                <td class="px-4 py-3"><?= esc($p['asal_sekolah'] ?? '-') ?></td>
                <td class="px-4 py-3 text-center font-bold text-brand-dark"><?= esc($p['total_nilai'] ?? '-') ?></td>
                <td class="px-4 py-3 text-center">
                    <?php if($p['status_pendaftaran'] === 'Lolos Seleksi'): ?>
                        <span class="bg-emerald-100 text-emerald-700 text-xs font-bold px-2.5 py-1 rounded-full border border-emerald-200">Lolos</span>
                    <?php elseif($p['status_pendaftaran'] === 'Tidak Lolos'): ?>
                        <span class="bg-red-100 text-red-700 text-xs font-bold px-2.5 py-1 rounded-full border border-red-200">Tidak Lolos</span>
                    <?php else: ?>
                        <span class="bg-blue-100 text-blue-700 text-xs font-bold px-2.5 py-1 rounded-full border border-blue-200">Menunggu</span>
                    <?php endif; ?>
                </td>
                <td class="px-4 py-3 text-center">
                    <form action="<?= base_url('admin/seleksi/ubah') ?>" method="POST" class="flex justify-center gap-2">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id" value="<?= $p['id'] ?>">
                        <button type="submit" name="status" value="Lolos Seleksi" class="bg-emerald-500 hover:bg-emerald-600 text-white p-1.5 rounded-lg shadow-sm transition-colors" title="Nyatakan Lolos">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </button>
                        <button type="submit" name="status" value="Tidak Lolos" class="bg-red-500 hover:bg-red-600 text-white p-1.5 rounded-lg shadow-sm transition-colors" title="Nyatakan Tidak Lolos">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
