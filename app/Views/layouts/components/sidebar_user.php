<!-- Sidebar -->
<aside id="sidebar" class="w-64 bg-white border-r border-slate-200 flex flex-col fixed md:sticky top-0 h-screen z-30 transition-transform transform -translate-x-full md:translate-x-0">
    <div class="p-6 border-b border-slate-100 flex justify-between items-center hidden md:flex">
        <div class="font-bold text-brand-dark text-2xl tracking-tight">SPMB App</div>
    </div>
    
    <div class="p-4 md:hidden flex justify-end">
        <button id="closeMenuBtn" class="text-slate-500 hover:text-slate-800">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>

    <div class="px-6 py-4 border-b border-slate-100">
        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider mb-2">Menu Utama</p>
        <nav class="space-y-1">
            <a href="<?= base_url('user/dashboard') ?>" class="flex items-center px-3 py-2.5 rounded-xl text-sm font-medium <?= current_url() == base_url('user/dashboard') || current_url() == base_url('user') ? 'bg-brand-light text-brand-dark' : 'text-slate-600 hover:bg-slate-50 hover:text-brand' ?>">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Dashboard
            </a>
        </nav>
    </div>

    <div class="px-6 py-4 border-b border-slate-100 flex-1 overflow-y-auto">
        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider mb-2">Form Pendaftaran</p>
        <nav class="space-y-1">
            <a href="<?= base_url('user/biodata') ?>" class="flex items-center px-3 py-2.5 rounded-xl text-sm font-medium <?= current_url() == base_url('user/biodata') ? 'bg-brand-light text-brand-dark' : 'text-slate-600 hover:bg-slate-50 hover:text-brand' ?>">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                Data Diri &amp; Orang Tua
            </a>
            <a href="<?= base_url('user/akademik') ?>" class="flex items-center px-3 py-2.5 rounded-xl text-sm font-medium <?= current_url() == base_url('user/akademik') ? 'bg-brand-light text-brand-dark' : 'text-slate-600 hover:bg-slate-50 hover:text-brand' ?>">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                Data Akademik
            </a>
            <a href="<?= base_url('user/prestasi') ?>" class="flex items-center px-3 py-2.5 rounded-xl text-sm font-medium <?= current_url() == base_url('user/prestasi') ? 'bg-brand-light text-brand-dark' : 'text-slate-600 hover:bg-slate-50 hover:text-brand' ?>">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                Data Prestasi
            </a>
            <a href="<?= base_url('user/berkas') ?>" class="flex items-center px-3 py-2.5 rounded-xl text-sm font-medium <?= current_url() == base_url('user/berkas') ? 'bg-brand-light text-brand-dark' : 'text-slate-600 hover:bg-slate-50 hover:text-brand' ?>">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                Berkas Pendukung
            </a>
            <a href="<?= base_url('user/resume') ?>" class="flex items-center px-3 py-2.5 rounded-xl text-sm font-medium <?= current_url() == base_url('user/resume') ? 'bg-brand-light text-brand-dark' : 'text-slate-600 hover:bg-slate-50 hover:text-brand' ?>">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Progres &amp; Kirim
            </a>
        </nav>
    </div>

    <div class="px-6 py-4">
        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider mb-2">Pengaturan</p>
        <nav class="space-y-1">
            <a href="<?= base_url('user/account') ?>" class="flex items-center px-3 py-2.5 rounded-xl text-sm font-medium <?= current_url() == base_url('user/account') ? 'bg-brand-light text-brand-dark' : 'text-slate-600 hover:bg-slate-50 hover:text-brand' ?>">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                Manajemen Akun
            </a>
            <a href="<?= base_url('logout') ?>" class="flex items-center px-3 py-2.5 rounded-xl text-sm font-medium text-red-600 hover:bg-red-50">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                Logout
            </a>
        </nav>
    </div>
</aside>
