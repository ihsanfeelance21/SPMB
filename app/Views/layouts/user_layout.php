<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard' ?> - SPMB</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            light: '#e0f2fe',
                            DEFAULT: '#0ea5e9',
                            dark: '#0369a1'
                        },
                        surface: {
                            light: '#ffffff',
                            dark: '#f8fafc'
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        @layer components {
            .input-field { @apply w-full border border-slate-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-brand-light focus:border-brand outline-none transition-shadow text-slate-700 bg-slate-50 focus:bg-white; }
            .btn-primary { @apply bg-brand text-white px-5 py-2.5 rounded-xl shadow-md hover:bg-brand-dark transition-all duration-200 focus:ring-4 focus:ring-brand-light outline-none font-medium flex justify-center items-center; }
            .btn-secondary { @apply bg-slate-200 text-slate-700 px-5 py-2.5 rounded-xl hover:bg-slate-300 transition-all duration-200 font-medium flex justify-center items-center; }
            .card { @apply bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden; }
        }
    </style>
</head>

<body class="bg-surface-dark font-sans text-slate-800 antialiased min-h-screen flex flex-col md:flex-row">

    <!-- Mobile Header -->
    <div class="md:hidden bg-white border-b border-slate-200 p-4 flex justify-between items-center sticky top-0 z-20 shadow-sm">
        <div class="font-bold text-brand-dark text-xl">SPMB</div>
        <button id="mobileMenuBtn" class="text-slate-600 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>

    <!-- Sidebar Component -->
    <?= $this->include('layouts/components/sidebar_user') ?>

    <!-- Overlay for mobile sidebar -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-slate-900 bg-opacity-50 z-20 hidden md:hidden"></div>

    <!-- Main Content -->
    <main class="flex-1 p-6 lg:p-10 max-w-7xl mx-auto w-full overflow-x-hidden">

        <header class="mb-8">
            <h1 class="text-3xl font-bold text-slate-800 tracking-tight"><?= $title ?? 'Dashboard' ?></h1>
        </header>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm mb-6 flex items-start">
                <svg class="w-5 h-5 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 p-4 rounded shadow-sm mb-6 flex items-start">
                <svg class="w-5 h-5 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>

        <footer class="mt-12 text-center text-sm text-slate-500 border-t border-slate-200 pt-6">
            &copy; <?= date('Y') ?> SPMB Sistem Penerimaan Murid Baru.
        </footer>
    </main>

    <script>
        // Mobile Sidebar Toggle — with null checks to prevent errors
        const btn = document.getElementById('mobileMenuBtn');
        const closeBtn = document.getElementById('closeMenuBtn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');

        function toggleMenu() {
            if (sidebar) sidebar.classList.toggle('-translate-x-full');
            if (overlay) overlay.classList.toggle('hidden');
        }

        if (btn) btn.addEventListener('click', toggleMenu);
        if (closeBtn) closeBtn.addEventListener('click', toggleMenu);
        if (overlay) overlay.addEventListener('click', toggleMenu);
    </script>
    <?= $this->renderSection('scripts') ?>
</body>

</html>