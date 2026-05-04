<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Dashboard' ?> - SPMB</title>

    <!-- Tailwind CSS (CDN for dev) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            light: '#e0e7ff',
                            DEFAULT: '#4f46e5',
                            dark: '#3730a3'
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

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS for DataTables to match Tailwind -->
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #4f46e5 !important;
            color: white !important;
            border: none !important;
            border-radius: 0.5rem;
        }

        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 0.25rem 0.5rem;
            margin-left: 0.5rem;
        }

        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 0.25rem 2rem 0.25rem 0.5rem;
        }
    </style>

    <style type="text/tailwindcss">
        @layer components {
            .input-field { @apply w-full border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-brand-light focus:border-brand outline-none transition-shadow text-slate-700 bg-slate-50 focus:bg-white; }
            .btn-primary { @apply bg-brand text-white px-4 py-2 rounded-lg shadow hover:bg-brand-dark transition-all duration-200 font-medium flex justify-center items-center; }
            .btn-secondary { @apply bg-slate-200 text-slate-700 px-4 py-2 rounded-lg hover:bg-slate-300 transition-all duration-200 font-medium flex justify-center items-center; }
            .card { @apply bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden; }
        }
    </style>
</head>

<body class="bg-slate-100 font-sans text-slate-800 antialiased min-h-screen flex flex-col lg:flex-row overflow-x-hidden">

    <!-- Mobile Header -->
    <div class="lg:hidden bg-slate-900 text-white p-4 flex justify-between items-center sticky top-0 z-40 shadow-md">
        <div class="font-bold text-xl flex items-center">
            <svg class="w-6 h-6 text-brand-light mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
            SPMB Admin
        </div>
        <button id="mobileMenuBtn" class="text-slate-300 hover:text-white focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>

    <!-- Sidebar Component -->
    <?= $this->include('layouts/components/sidebar_admin') ?>

    <!-- Overlay for mobile sidebar -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-slate-900 bg-opacity-50 z-40 hidden lg:hidden"></div>

    <!-- Main Content -->
    <main class="flex-1 w-full overflow-x-hidden">

        <!-- Topbar Component -->
        <?= $this->include('layouts/components/topbar_admin') ?>

        <div class="p-4 lg:p-8">
            <h1 class="text-2xl font-bold text-slate-800 mb-6 lg:hidden"><?= $title ?? 'Dashboard' ?></h1>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl shadow-sm mb-6 flex items-start">
                    <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-xl shadow-sm mb-6 flex items-start">
                    <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?= $this->renderSection('content') ?>
        </div>

    </main>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Mobile Sidebar Toggle
        const btn = document.getElementById('mobileMenuBtn');
        const closeBtn = document.getElementById('closeMenuBtn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');

        function toggleMenu() {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        if (btn) btn.addEventListener('click', toggleMenu);
        if (closeBtn) closeBtn.addEventListener('click', toggleMenu);
        if (overlay) overlay.addEventListener('click', toggleMenu);

        // Initialize DataTables automatically if table has class .datatable
        $(document).ready(function() {
            if ($('.datatable').length > 0) {
                $('.datatable').DataTable({
                    responsive: true,
                    language: {
                        search: "Cari:",
                        lengthMenu: "Tampilkan _MENU_ data",
                        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                        paginate: {
                            first: "Awal",
                            last: "Akhir",
                            next: "Selanjutnya",
                            previous: "Sebelumnya"
                        }
                    }
                });
            }
        });
    </script>

    <?= $this->renderSection('scripts') ?>
</body>

</html>