<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="card p-6 border-l-4 border-l-brand">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-slate-500 uppercase tracking-wide">Total Pendaftar</p>
                <h3 class="text-3xl font-bold text-slate-800 mt-1"><?= $totalPendaftar ?></h3>
            </div>
            <div class="bg-brand-light text-brand p-3 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
        </div>
    </div>

    <div class="card p-6 border-l-4 border-l-amber-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-slate-500 uppercase tracking-wide">Belum Verifikasi</p>
                <h3 class="text-3xl font-bold text-slate-800 mt-1"><?= $pendingVerifikasi ?></h3>
            </div>
            <div class="bg-amber-100 text-amber-600 p-3 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
        </div>
    </div>

    <div class="card p-6 border-l-4 border-l-blue-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-slate-500 uppercase tracking-wide">Menunggu Seleksi</p>
                <h3 class="text-3xl font-bold text-slate-800 mt-1"><?= $menungguSeleksi ?></h3>
            </div>
            <div class="bg-blue-100 text-blue-600 p-3 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
            </div>
        </div>
    </div>

    <div class="card p-6 border-l-4 border-l-red-500 relative overflow-hidden">
        <div class="flex items-center justify-between relative z-10">
            <div>
                <p class="text-sm font-semibold text-slate-500 uppercase tracking-wide">Reset Password</p>
                <h3 class="text-3xl font-bold text-slate-800 mt-1"><?= $permintaanReset ?></h3>
            </div>
            <div class="bg-red-100 text-red-600 p-3 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
            </div>
        </div>
        <?php if($permintaanReset > 0): ?>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-red-500 animate-pulse"></div>
        <?php endif; ?>
    </div>
</div>

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
    <!-- Chart Section -->
    <div class="card p-6 xl:col-span-2">
        <h3 class="text-lg font-bold text-slate-800 mb-4 border-b border-slate-100 pb-2">Grafik Pendaftar (7 Hari Terakhir)</h3>
        <div class="w-full h-72">
            <canvas id="registrationChart"></canvas>
        </div>
    </div>

    <!-- Info Section -->
    <div class="card p-6 flex flex-col justify-between">
        <div>
            <h3 class="text-lg font-bold text-slate-800 mb-4 border-b border-slate-100 pb-2">Informasi Sistem</h3>
            <ul class="space-y-4">
                <li class="flex justify-between items-center">
                    <span class="text-slate-500 text-sm">Nama Sekolah</span>
                    <span class="font-bold text-slate-800"><?= esc($settings['nama_sekolah'] ?? '-') ?></span>
                </li>
                <li class="flex justify-between items-center">
                    <span class="text-slate-500 text-sm">Tahun Pelajaran</span>
                    <span class="font-bold text-slate-800"><?= esc($settings['tahun_pelajaran'] ?? '-') ?></span>
                </li>
                <li class="flex justify-between items-center">
                    <span class="text-slate-500 text-sm">Tanggal Buka</span>
                    <span class="font-bold text-slate-800"><?= !empty($settings['tanggal_buka']) ? date('d M Y', strtotime($settings['tanggal_buka'])) : '-' ?></span>
                </li>
                <li class="flex justify-between items-center">
                    <span class="text-slate-500 text-sm">Tanggal Tutup</span>
                    <span class="font-bold text-red-600"><?= !empty($settings['tanggal_tutup']) ? date('d M Y', strtotime($settings['tanggal_tutup'])) : '-' ?></span>
                </li>
            </ul>
        </div>
        <div class="mt-6 pt-4 border-t border-slate-100">
            <a href="<?= base_url('admin/pengaturan') ?>" class="text-brand text-sm font-bold hover:underline flex items-center justify-center">
                Ubah Pengaturan Sistem
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    const ctx = document.getElementById('registrationChart').getContext('2d');
    
    // Parse PHP data to JS
    const labels = JSON.parse('<?= $chartLabels ?>');
    const dataPoints = JSON.parse('<?= $chartData ?>');

    // Create Gradient
    let gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(79, 70, 229, 0.5)'); // brand color with opacity
    gradient.addColorStop(1, 'rgba(79, 70, 229, 0.0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels.length > 0 ? labels : ['Belum ada data'],
            datasets: [{
                label: 'Jumlah Pendaftar Baru',
                data: dataPoints.length > 0 ? dataPoints : [0],
                borderColor: '#4f46e5', // brand
                backgroundColor: gradient,
                borderWidth: 3,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#4f46e5',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#1e293b',
                    padding: 12,
                    titleFont: { size: 13, family: 'Inter' },
                    bodyFont: { size: 14, family: 'Inter', weight: 'bold' },
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return context.parsed.y + ' Pendaftar';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        precision: 0,
                        font: { family: 'Inter' }
                    },
                    grid: {
                        color: '#f1f5f9',
                        drawBorder: false
                    }
                },
                x: {
                    grid: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        font: { family: 'Inter' }
                    }
                }
            }
        }
    });
</script>
<?= $this->endSection() ?>
