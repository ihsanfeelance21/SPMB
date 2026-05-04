<?= $this->extend('layouts/user_layout') ?>

<?= $this->section('content') ?>

<div class="card p-8">
    <div class="mb-6 flex justify-between items-center border-b border-slate-200 pb-4">
        <div>
            <h2 class="text-xl font-bold text-slate-800">Data Prestasi (Opsional)</h2>
            <p class="text-sm text-slate-500 mt-1">Tambahkan prestasi akademik maupun non-akademik yang pernah Anda raih.</p>
        </div>
        <button type="button" id="addPrestasiBtn" class="bg-brand-light text-brand-dark px-4 py-2 rounded-lg font-medium hover:bg-blue-200 transition-colors flex items-center text-sm">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tambah Prestasi
        </button>
    </div>

    <?php if(count($prestasi) > 0): ?>
        <div class="mb-8">
            <h3 class="text-sm font-bold text-slate-700 mb-3">Prestasi Tersimpan:</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <?php foreach($prestasi as $p): ?>
                    <div class="border border-slate-200 rounded-xl p-4 flex items-start bg-slate-50">
                        <div class="bg-emerald-100 text-emerald-600 p-2 rounded-lg mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800"><?= esc($p['nama_prestasi']) ?></h4>
                            <p class="text-xs text-slate-500"><?= esc($p['kategori']) ?> &bull; <?= esc($p['tahun']) ?> &bull; <?= esc($p['pelaksana']) ?></p>
                            <?php if(!empty($p['file_sertifikat'])): ?>
                                <span class="inline-block mt-2 text-xs font-medium bg-emerald-100 text-emerald-700 px-2 py-1 rounded">Sertifikat Diunggah</span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('user/prestasi') ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div id="prestasiContainer" class="space-y-6 mb-8">
            <!-- Dynamic rows will be appended here -->
        </div>

        <!-- Template for empty state if user wants to add one -->
        <div id="emptyState" class="text-center py-10 bg-slate-50 border border-dashed border-slate-300 rounded-xl mb-8">
            <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            <p class="text-slate-500 font-medium">Belum ada prestasi baru yang akan ditambahkan.</p>
            <p class="text-sm text-slate-400 mt-1">Klik tombol "Tambah Prestasi" di kanan atas jika ada.</p>
        </div>

        <div class="flex justify-between pt-4 border-t border-slate-100">
            <a href="<?= base_url('user/akademik') ?>" class="btn-secondary">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
            <button type="submit" class="btn-primary">
                Simpan & Lanjutkan
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </button>
        </div>
    </form>
</div>

<!-- Template Script -->
<template id="prestasiTemplate">
    <div class="prestasi-row bg-white border border-brand-light rounded-xl p-6 relative shadow-sm">
        <button type="button" class="remove-btn absolute top-4 right-4 text-slate-400 hover:text-red-500 transition-colors" title="Hapus Baris">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
        </button>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
            <div>
                <label class="block text-xs font-bold text-slate-600 mb-1">Kategori Tingkat</label>
                <select name="kategori[]" class="input-field !py-2 !text-sm" required>
                    <option value="Kabupaten/Kota">Kabupaten/Kota</option>
                    <option value="Provinsi">Provinsi</option>
                    <option value="Nasional">Nasional</option>
                    <option value="Internasional">Internasional</option>
                </select>
            </div>
            <div class="lg:col-span-2">
                <label class="block text-xs font-bold text-slate-600 mb-1">Nama Prestasi</label>
                <input type="text" name="nama_prestasi[]" class="input-field !py-2 !text-sm" placeholder="Contoh: Juara 1 OSN Matematika" required>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-600 mb-1">Tahun</label>
                <input type="number" name="tahun[]" min="2010" max="2030" class="input-field !py-2 !text-sm" placeholder="2023" required>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-600 mb-1">Penyelenggara / Pelaksana</label>
                <input type="text" name="pelaksana[]" class="input-field !py-2 !text-sm" placeholder="Contoh: Kemendikbud" required>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-600 mb-1">Upload Sertifikat (Max 2MB, PDF/JPG)</label>
                <input type="file" name="file_sertifikat[]" class="w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 border border-slate-300 rounded bg-slate-50" accept=".pdf,.jpg,.jpeg,.png" required>
            </div>
        </div>
    </div>
</template>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('prestasiContainer');
        const template = document.getElementById('prestasiTemplate');
        const addBtn = document.getElementById('addPrestasiBtn');
        const emptyState = document.getElementById('emptyState');

        function toggleEmptyState() {
            if (container.children.length === 0) {
                emptyState.style.display = 'block';
            } else {
                emptyState.style.display = 'none';
            }
        }

        addBtn.addEventListener('click', function() {
            const clone = template.content.cloneNode(true);
            
            // Add remove event listener
            clone.querySelector('.remove-btn').addEventListener('click', function(e) {
                e.target.closest('.prestasi-row').remove();
                toggleEmptyState();
            });

            container.appendChild(clone);
            toggleEmptyState();
        });

        // Initialize state
        toggleEmptyState();
    });
</script>
<?= $this->endSection() ?>
