<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'SPMB' ?> - SPMB</title>
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
            .input-field { @apply w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-brand-light focus:border-brand outline-none transition-shadow text-slate-700 bg-slate-50 focus:bg-white; }
            .btn-primary { @apply w-full bg-brand text-white px-4 py-3 rounded-xl shadow-md hover:bg-brand-dark transition-all duration-200 focus:ring-4 focus:ring-brand-light outline-none font-semibold flex justify-center items-center; }
        }
    </style>
</head>

<body class="bg-pattern min-h-screen flex items-center justify-center p-6 font-sans text-slate-900 antialiased">
    <main class="w-full max-w-md relative z-10">
        <?= $this->renderSection('content') ?>

        <?= $this->renderSection('scripts') ?>
        <div class="mt-10 text-center opacity-70">
            <p class="text-xs text-slate-600">© <?= date('Y') ?> Sistem Penerimaan Peserta Didik Baru.</p>
        </div>
    </main>
</body>

</html>