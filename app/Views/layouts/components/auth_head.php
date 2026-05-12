<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php if (!empty($settings['favicon'])): ?>
    <link rel="icon" type="image/png" href="<?= base_url('uploads/' . esc($settings['favicon'])) ?>">
<?php else: ?>
    <link rel="icon" href="<?= base_url('favicon.ico') ?>">
<?php endif; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: { extend: { fontFamily: { sans: ['Inter', 'system-ui', 'sans-serif'] } } }
    }
</script>
<style>
    @keyframes float { 0%, 100% { transform: translateY(0px) rotate(0deg); } 33% { transform: translateY(-12px) rotate(2deg); } 66% { transform: translateY(6px) rotate(-1deg); } }
    @keyframes float-delayed { 0%, 100% { transform: translateY(0px) rotate(0deg); } 33% { transform: translateY(8px) rotate(-2deg); } 66% { transform: translateY(-14px) rotate(1deg); } }
    @keyframes shimmer { 0% { background-position: -200% 0; } 100% { background-position: 200% 0; } }
    .float-1 { animation: float 8s ease-in-out infinite; }
    .float-2 { animation: float-delayed 10s ease-in-out infinite; }
    .float-3 { animation: float 12s ease-in-out infinite 2s; }
    .shimmer-line { background: linear-gradient(90deg, transparent, rgba(255,255,255,0.08), transparent); background-size: 200% 100%; animation: shimmer 6s ease-in-out infinite; }
    .dot-pattern { background-image: radial-gradient(rgba(255,255,255,0.07) 1px, transparent 1px); background-size: 24px 24px; }
</style>
