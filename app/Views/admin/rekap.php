<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>

<div class="card p-6">
    <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between border-b border-slate-100 pb-4 gap-4">
        <div>
            <h2 class="text-xl font-bold text-slate-800">Rekapitulasi Kelulusan</h2>
            <p class="text-sm text-slate-500 mt-1">Daftar calon siswa yang dinyatakan lolos seleksi penerimaan.</p>
        </div>
        <a href="<?= base_url('admin/rekap/pdf') ?>" target="_blank" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-bold flex items-center justify-center transition-colors shadow-sm whitespace-nowrap">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            Download PDF
        </a>
    </div>

    <table class="datatable w-full text-sm text-left text-slate-600">
        <thead class="text-xs text-slate-700 uppercase bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-4 py-3 rounded-tl-lg">No</th>
                <th class="px-4 py-3">No. Pendaftaran</th>
                <th class="px-4 py-3">Nama Lengkap</th>
                <th class="px-4 py-3">No Identitas</th>
                <th class="px-4 py-3">Asal Sekolah</th>
                <th class="px-4 py-3 text-center rounded-tr-lg">Nilai</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach($pendaftar as $p): ?>
            <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors">
                <td class="px-4 py-3 text-center"><?= $no++ ?></td>
                <td class="px-4 py-3 font-bold text-brand-dark">#<?= str_pad($p['id'], 4, '0', STR_PAD_LEFT) ?></td>
                <td class="px-4 py-3 font-bold text-slate-800"><?= esc($p['nama_lengkap']) ?></td>
                <td class="px-4 py-3"><?= esc($p['no_identitas']) ?></td>
                <td class="px-4 py-3"><?= esc($p['asal_sekolah']) ?></td>
                <td class="px-4 py-3 text-center font-bold"><?= esc($p['total_nilai']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
