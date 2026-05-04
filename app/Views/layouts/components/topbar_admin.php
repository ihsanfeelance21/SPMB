<!-- Top Nav Desktop -->
<header class="bg-white border-b border-slate-200 h-20 px-8 flex items-center justify-between lg:flex sticky top-0 z-30">
    <h1 class="text-2xl font-bold text-slate-800"><?= $title ?? 'Dashboard' ?></h1>
    <div class="flex items-center gap-4">
        <?php if (session()->get('role') === 'superadmin'): ?>
            <span class="text-sm font-medium text-violet-700 bg-violet-100 px-3 py-1.5 rounded-full border border-violet-200">
                <svg class="w-3.5 h-3.5 inline mr-1 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
                Superadmin
            </span>
        <?php else: ?>
            <span class="text-sm font-medium text-slate-600 bg-slate-100 px-3 py-1.5 rounded-full border border-slate-200">
                Administrator
            </span>
        <?php endif; ?>
        <?php
        $initials = 'AD';
        $uname = session()->get('username');
        if ($uname) {
            $initials = strtoupper(substr($uname, 0, 2));
        }
        ?>
        <div class="w-10 h-10 <?= session()->get('role') === 'superadmin' ? 'bg-gradient-to-br from-violet-500 to-purple-600' : 'bg-brand' ?> text-white rounded-full flex items-center justify-center font-bold shadow-md">
            <?= $initials ?>
        </div>
    </div>
</header>