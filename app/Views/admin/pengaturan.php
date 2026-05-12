<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>

<div class="card p-6 max-w-3xl">
    <div class="mb-6 border-b border-slate-100 pb-4">
        <h2 class="text-xl font-bold text-slate-800">Pengaturan Sistem PPDB</h2>
        <p class="text-sm text-slate-500 mt-1">Ubah nama sekolah, tahun pelajaran, logo sekolah, serta timeline pendaftaran.</p>
    </div>

    <form action="<?= base_url('admin/pengaturan') ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="id" value="<?= esc($settings['id'] ?? '') ?>">

        <div class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-1">Nama Sekolah</label>
                    <input type="text" name="nama_sekolah" class="input-field" value="<?= esc($settings['nama_sekolah'] ?? '') ?>" placeholder="Contoh: SMA Negeri 1 Nusantara" required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Tahun Pelajaran</label>
                    <input type="text" name="tahun_pelajaran" class="input-field" value="<?= esc($settings['tahun_pelajaran'] ?? '') ?>" placeholder="Contoh: 2024/2025" required>
                </div>
            </div>

            <!-- Logo Upload Section -->
            <div class="border-t border-slate-100 pt-6">
                <h3 class="text-lg font-bold text-slate-800 mb-4">Logo Sekolah</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                    <!-- Current Logo Preview -->
                    <?php if (!empty($settings['logo'])): ?>
                        <div class="flex flex-col items-center gap-3 p-4 bg-slate-50 rounded-xl border border-slate-200">
                            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Logo Saat Ini</p>
                            <div class="w-28 h-28 rounded-xl overflow-hidden border-2 border-slate-200 bg-white flex items-center justify-center shadow-sm">
                                <img src="<?= base_url('uploads/' . esc($settings['logo'])) ?>" alt="Logo Sekolah" class="max-w-full max-h-full object-contain">
                            </div>
                            <?php if (!empty($settings['favicon'])): ?>
                                <div class="flex items-center gap-2 text-xs text-slate-500">
                                    <img src="<?= base_url('uploads/' . esc($settings['favicon'])) ?>" alt="Favicon" class="w-4 h-4">
                                    <span>Favicon (32×32px) auto-generated</span>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <div class="flex flex-col items-center gap-3 p-4 bg-slate-50 rounded-xl border border-dashed border-slate-300">
                            <div class="w-28 h-28 rounded-xl bg-slate-100 flex items-center justify-center">
                                <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <p class="text-xs text-slate-400">Belum ada logo</p>
                        </div>
                    <?php endif; ?>

                    <!-- Upload Input -->
                    <div>
                        <label for="logoUpload" class="block text-sm font-bold text-slate-700 mb-2">Upload Logo Baru</label>
                        <div class="relative group" id="dropZone">
                            <input type="file" name="logo" id="logoUpload" accept="image/png,image/jpeg,image/jpg"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            <div class="border-2 border-dashed border-slate-300 group-hover:border-brand rounded-xl p-6 text-center transition-all duration-200 group-hover:bg-brand/5">
                                <svg class="w-10 h-10 mx-auto text-slate-400 group-hover:text-brand transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                <p class="mt-2 text-sm text-slate-600 group-hover:text-slate-800" id="dropZoneText">
                                    <span class="font-semibold text-brand">Klik untuk upload</span> atau drag & drop
                                </p>
                                <p class="mt-1 text-xs text-slate-400">PNG, JPG, JPEG • Maks. 2MB</p>
                            </div>
                        </div>

                        <!-- File Preview -->
                        <div id="filePreview" class="mt-3 hidden">
                            <div class="flex items-center gap-3 p-3 bg-emerald-50 border border-emerald-200 rounded-lg">
                                <img id="previewImage" src="" alt="Preview" class="w-10 h-10 rounded-lg object-contain border border-emerald-200 bg-white">
                                <div class="flex-1 min-w-0">
                                    <p id="fileName" class="text-sm font-medium text-emerald-800 truncate"></p>
                                    <p id="fileSize" class="text-xs text-emerald-600"></p>
                                </div>
                                <button type="button" id="removeFile" class="text-emerald-600 hover:text-red-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <p class="mt-2 text-xs text-slate-500">
                            <svg class="w-3.5 h-3.5 inline-block mr-1 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Logo akan otomatis dikonversi menjadi favicon 32×32 piksel.
                        </p>
                    </div>
                </div>
            </div>

            <div class="border-t border-slate-100 pt-6">
                <h3 class="text-lg font-bold text-slate-800 mb-4">Timeline Pendaftaran</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Tanggal Dibuka</label>
                        <input type="date" name="tanggal_buka" class="input-field" value="<?= esc($settings['tanggal_buka'] ?? '') ?>" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Tanggal Ditutup</label>
                        <input type="date" name="tanggal_tutup" class="input-field" value="<?= esc($settings['tanggal_tutup'] ?? '') ?>" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 flex justify-end">
            <button type="submit" class="btn-primary">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                Simpan Pengaturan
            </button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    const logoInput = document.getElementById('logoUpload');
    const dropZone = document.getElementById('dropZone');
    const dropZoneText = document.getElementById('dropZoneText');
    const filePreview = document.getElementById('filePreview');
    const previewImage = document.getElementById('previewImage');
    const fileNameEl = document.getElementById('fileName');
    const fileSizeEl = document.getElementById('fileSize');
    const removeBtn = document.getElementById('removeFile');

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
    }

    function showPreview(file) {
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
            };
            reader.readAsDataURL(file);

            fileNameEl.textContent = file.name;
            fileSizeEl.textContent = formatFileSize(file.size);
            filePreview.classList.remove('hidden');
            dropZoneText.innerHTML = '<span class="font-semibold text-emerald-600">File dipilih!</span> Klik untuk mengganti';
        }
    }

    logoInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            showPreview(this.files[0]);
        }
    });

    // Drag and drop handlers
    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, function(e) {
            e.preventDefault();
            dropZone.querySelector('div').classList.add('border-brand', 'bg-brand/5');
            dropZone.querySelector('div').classList.remove('border-slate-300');
        });
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, function(e) {
            e.preventDefault();
            dropZone.querySelector('div').classList.remove('border-brand', 'bg-brand/5');
            dropZone.querySelector('div').classList.add('border-slate-300');
        });
    });

    removeBtn.addEventListener('click', function() {
        logoInput.value = '';
        filePreview.classList.add('hidden');
        previewImage.src = '';
        dropZoneText.innerHTML = '<span class="font-semibold text-brand">Klik untuk upload</span> atau drag & drop';
    });
</script>
<?= $this->endSection() ?>
