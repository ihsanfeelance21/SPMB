<?= $this->extend('layouts/user_layout') ?>

<?= $this->section('content') ?>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Welcome Card -->
    <div class="card col-span-1 md:col-span-2 p-8 bg-gradient-to-br from-brand to-brand-dark text-white relative overflow-hidden">
        <div class="relative z-10">
            <h2 class="text-2xl font-bold mb-2">Selamat Datang, <?= esc($user['username']) ?>!</h2>
            <p class="text-brand-light mb-6">Sistem Penerimaan Murid Baru <?= esc($settings['nama_sekolah'] ?? '') ?> Tahun Ajaran <?= esc($settings['tahun_pelajaran'] ?? '') ?></p>
            
            <?php if($user['status_pendaftaran'] === 'Belum Dikirim'): ?>
                <div class="bg-white/20 inline-block px-4 py-2 rounded-lg backdrop-blur-sm border border-white/30">
                    <span class="font-medium">Status:</span> <span class="font-bold text-yellow-300">Belum Dikirim</span>
                </div>
            <?php elseif($user['status_pendaftaran'] === 'Menunggu Verifikasi'): ?>
                <div class="bg-white/20 inline-block px-4 py-2 rounded-lg backdrop-blur-sm border border-white/30">
                    <span class="font-medium">Status:</span> <span class="font-bold text-blue-200">Sedang Diverifikasi Admin</span>
                </div>
            <?php elseif($user['status_pendaftaran'] === 'Lolos Seleksi'): ?>
                <div class="bg-emerald-500/80 inline-block px-4 py-2 rounded-lg backdrop-blur-sm border border-emerald-300">
                    <span class="font-medium text-white">Status:</span> <span class="font-bold text-white">Lolos Seleksi! 🎉</span>
                </div>
                <div class="mt-4">
                    <button class="bg-white text-emerald-600 px-6 py-3 rounded-xl font-bold shadow-lg hover:bg-emerald-50 transition-colors">
                        Lakukan Daftar Ulang Sekarang
                    </button>
                </div>
            <?php elseif($user['status_pendaftaran'] === 'Tidak Lolos'): ?>
                <div class="bg-red-500/80 inline-block px-4 py-2 rounded-lg backdrop-blur-sm border border-red-300">
                    <span class="font-medium text-white">Status:</span> <span class="font-bold text-white">Tidak Lolos Seleksi</span>
                </div>
            <?php endif; ?>
        </div>
        <!-- Decorative circle -->
        <div class="absolute -right-16 -top-16 w-64 h-64 bg-white/10 rounded-full blur-2xl"></div>
    </div>

    <!-- Countdown Card -->
    <div class="card p-6 flex flex-col justify-center items-center text-center">
        <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-4">Penutupan Pendaftaran</h3>
        <div id="countdown" class="grid grid-cols-4 gap-2 w-full max-w-xs">
            <div class="bg-slate-50 border border-slate-100 rounded-lg p-2">
                <span id="cd-days" class="block text-2xl font-bold text-brand-dark">00</span>
                <span class="text-[10px] text-slate-400 uppercase font-bold">Hari</span>
            </div>
            <div class="bg-slate-50 border border-slate-100 rounded-lg p-2">
                <span id="cd-hours" class="block text-2xl font-bold text-brand-dark">00</span>
                <span class="text-[10px] text-slate-400 uppercase font-bold">Jam</span>
            </div>
            <div class="bg-slate-50 border border-slate-100 rounded-lg p-2">
                <span id="cd-minutes" class="block text-2xl font-bold text-brand-dark">00</span>
                <span class="text-[10px] text-slate-400 uppercase font-bold">Mnt</span>
            </div>
            <div class="bg-slate-50 border border-slate-100 rounded-lg p-2">
                <span id="cd-seconds" class="block text-2xl font-bold text-brand-dark">00</span>
                <span class="text-[10px] text-slate-400 uppercase font-bold">Dtk</span>
            </div>
        </div>
    </div>
</div>

<div class="card p-8">
    <div class="flex justify-between items-end mb-4">
        <div>
            <h3 class="text-xl font-bold text-slate-800">Progres Pengisian Data</h3>
            <p class="text-sm text-slate-500 mt-1">Lengkapi form pendaftaran hingga 100% untuk mengirimkan data.</p>
        </div>
        <span class="text-3xl font-black text-brand"><?= $progress ?>%</span>
    </div>
    
    <div class="w-full bg-slate-100 rounded-full h-4 mb-8 overflow-hidden border border-slate-200">
        <div class="bg-gradient-to-r from-brand to-brand-dark h-4 rounded-full transition-all duration-1000 ease-out" style="width: <?= $progress ?>%"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <?php
            $steps = [
                ['name' => 'Data Diri & Orang Tua', 'url' => 'user/biodata', 'done' => $progress >= 50],
                ['name' => 'Data Akademik', 'url' => 'user/akademik', 'done' => $progress >= 75],
                ['name' => 'Berkas Pendukung', 'url' => 'user/berkas', 'done' => $progress == 100],
                ['name' => 'Progres & Kirim', 'url' => 'user/resume', 'done' => false]
            ];
        ?>
        <?php foreach($steps as $step): ?>
            <a href="<?= base_url($step['url']) ?>" class="border border-slate-200 rounded-xl p-4 hover:border-brand hover:shadow-md transition-all flex items-center justify-between group bg-slate-50 hover:bg-white">
                <span class="text-sm font-semibold text-slate-700 group-hover:text-brand"><?= $step['name'] ?></span>
                <?php if($step['done']): ?>
                    <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <?php else: ?>
                    <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <?php endif; ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Countdown Timer Logic
    const endDate = new Date("<?= esc($settings['tanggal_tutup'] ?? date('Y-m-d', strtotime('+30 days'))) ?>T23:59:59").getTime();
    
    const x = setInterval(function() {
        const now = new Date().getTime();
        const distance = endDate - now;
        
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("countdown").innerHTML = "<div class='col-span-4 text-red-500 font-bold'>PENDAFTARAN DITUTUP</div>";
            return;
        }
        
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        document.getElementById("cd-days").innerText = days < 10 ? '0' + days : days;
        document.getElementById("cd-hours").innerText = hours < 10 ? '0' + hours : hours;
        document.getElementById("cd-minutes").innerText = minutes < 10 ? '0' + minutes : minutes;
        document.getElementById("cd-seconds").innerText = seconds < 10 ? '0' + seconds : seconds;
    }, 1000);
</script>
<?= $this->endSection() ?>
