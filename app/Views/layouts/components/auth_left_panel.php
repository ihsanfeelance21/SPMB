<!-- ===================== LEFT PANEL: Branding & Identitas ===================== -->
<div class="relative lg:w-[48%] xl:w-[45%] bg-gradient-to-br from-[#1D2671] via-[#2D3FAF] to-[#1D2671] flex flex-col items-center justify-center p-8 sm:p-12 lg:p-16 overflow-hidden">
    <div class="absolute inset-0 dot-pattern opacity-60"></div>
    <div class="absolute top-[12%] left-[8%] w-40 h-40 rounded-full bg-[#F4D000]/10 blur-3xl float-1"></div>
    <div class="absolute bottom-[18%] right-[10%] w-56 h-56 rounded-full bg-white/5 blur-3xl float-2"></div>
    <div class="absolute top-[55%] left-[60%] w-24 h-24 rounded-full bg-[#2D3FAF]/40 blur-2xl float-3"></div>
    <div class="absolute top-1/3 left-0 right-0 h-px shimmer-line"></div>
    <div class="absolute top-2/3 left-0 right-0 h-px shimmer-line" style="animation-delay: 3s;"></div>
    <div class="absolute top-0 left-0 w-32 h-32">
        <div class="absolute top-4 left-4 w-12 h-px bg-[#F4D000]/40"></div>
        <div class="absolute top-4 left-4 w-px h-12 bg-[#F4D000]/40"></div>
    </div>
    <div class="absolute bottom-0 right-0 w-32 h-32">
        <div class="absolute bottom-4 right-4 w-12 h-px bg-white/20"></div>
        <div class="absolute bottom-4 right-4 w-px h-12 bg-white/20"></div>
    </div>
    <div class="relative z-10 flex flex-col items-center text-center max-w-md space-y-8">
        <div class="relative group">
            <div class="absolute -inset-1 bg-gradient-to-br from-[#F4D000]/30 to-white/10 rounded-2xl blur-sm group-hover:blur-md transition-all duration-500"></div>
            <div class="relative w-24 h-24 sm:w-28 sm:h-28 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl flex items-center justify-center shadow-lg shadow-black/10 overflow-hidden">
                <?php if (!empty($settings['logo'])): ?>
                    <img src="<?= base_url('uploads/' . esc($settings['logo'])) ?>" alt="Logo <?= esc($settings['nama_sekolah'] ?? 'Sekolah') ?>" class="w-16 h-16 sm:w-20 sm:h-20 object-contain drop-shadow-md">
                <?php else: ?>
                    <i class="fa-solid fa-school text-4xl sm:text-5xl text-white/90"></i>
                <?php endif; ?>
            </div>
        </div>
        <div class="space-y-3">
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-white leading-tight tracking-tight">
                <?= esc($settings['nama_sekolah'] ?? 'Sistem PPDB Online') ?>
            </h1>
            <p class="text-base sm:text-lg text-white/70 leading-relaxed font-light">
                Sistem Penerimaan Peserta Didik Baru
                <?php if (!empty($settings['tahun_pelajaran'])): ?>
                    <br><span class="text-[#F4D000] font-semibold">Tahun Pelajaran <?= esc($settings['tahun_pelajaran']) ?></span>
                <?php endif; ?>
            </p>
        </div>
        <div class="inline-flex items-center gap-2.5 px-5 py-2.5 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full text-white/90 text-sm font-medium shadow-inner shadow-white/5 hover:bg-white/15 transition-colors duration-300">
            <i class="fa-solid fa-graduation-cap text-[#F4D000]"></i>
            <span>Membangun Generasi Unggul</span>
        </div>
        <div class="hidden lg:flex items-center gap-3 pt-4 opacity-40">
            <div class="w-8 h-px bg-white"></div>
            <div class="w-2 h-2 rounded-full border border-white/60"></div>
            <div class="w-16 h-px bg-white"></div>
            <div class="w-2 h-2 rounded-full border border-white/60"></div>
            <div class="w-8 h-px bg-white"></div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-8 bg-gradient-to-t from-[#1D2671] to-transparent lg:hidden"></div>
</div>
