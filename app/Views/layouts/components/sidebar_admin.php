<!-- Sidebar -->
<aside id="sidebar" class="w-64 bg-slate-900 text-slate-300 flex flex-col fixed lg:sticky top-0 h-screen z-50 transition-transform transform -translate-x-full lg:translate-x-0">
    <div class="p-6 border-b border-slate-800 flex justify-between items-center h-16 lg:h-20">
        <div class="font-bold text-white text-2xl tracking-tight flex items-center">
            <svg class="w-7 h-7 text-brand mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            AdminPanel
        </div>
        <button id="closeMenuBtn" class="lg:hidden text-slate-400 hover:text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>

    <div class="px-4 py-6 flex-1 overflow-y-auto">
        <p class="text-xs text-slate-500 font-semibold uppercase tracking-wider mb-3 px-2">Menu Utama</p>
        <nav class="space-y-1 mb-8">
            <a href="<?= base_url('admin') ?>" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium <?= current_url() == base_url('admin') || current_url() == base_url('admin/dashboard') ? 'bg-brand text-white' : 'hover:bg-slate-800 hover:text-white transition-colors' ?>">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>
        </nav>

        <p class="text-xs text-slate-500 font-semibold uppercase tracking-wider mb-3 px-2">Manajemen PPDB</p>
        <nav class="space-y-1 mb-8">
            <a href="<?= base_url('admin/verifikasi') ?>" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium <?= current_url() == base_url('admin/verifikasi') ? 'bg-brand text-white' : 'hover:bg-slate-800 hover:text-white transition-colors' ?>">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Data Pendaftar (Verifikasi)
            </a>
            <a href="<?= base_url('admin/seleksi') ?>" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium <?= current_url() == base_url('admin/seleksi') ? 'bg-brand text-white' : 'hover:bg-slate-800 hover:text-white transition-colors' ?>">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                Seleksi Kelulusan
            </a>
            <a href="<?= base_url('admin/rekap') ?>" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium <?= current_url() == base_url('admin/rekap') ? 'bg-brand text-white' : 'hover:bg-slate-800 hover:text-white transition-colors' ?>">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Rekap Lolos &amp; Unduh PDF
            </a>
        </nav>

        <p class="text-xs text-slate-500 font-semibold uppercase tracking-wider mb-3 px-2">Sistem</p>
        <nav class="space-y-1">
            <a href="<?= base_url('admin/pengaturan') ?>" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium <?= current_url() == base_url('admin/pengaturan') ? 'bg-brand text-white' : 'hover:bg-slate-800 hover:text-white transition-colors' ?>">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                Pengaturan
            </a>
            <a href="<?= base_url('admin/akun') ?>" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium <?= current_url() == base_url('admin/akun') ? 'bg-brand text-white' : 'hover:bg-slate-800 hover:text-white transition-colors' ?>">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Manajemen Akun
            </a>
            <a href="<?= base_url('admin/backup') ?>" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium <?= current_url() == base_url('admin/backup') ? 'bg-brand text-white' : 'hover:bg-slate-800 hover:text-white transition-colors' ?>">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path></svg>
                Backup &amp; Restore
            </a>
        </nav>
    </div>
    
    <div class="p-4 border-t border-slate-800">
        <a href="<?= base_url('logout') ?>" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium text-red-400 hover:bg-slate-800 hover:text-red-300 transition-colors w-full">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            Logout Sistem
        </a>
    </div>
</aside>
