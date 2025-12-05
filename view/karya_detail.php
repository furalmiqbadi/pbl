<?php
if (!function_exists('h')) {
    function h(?string $value): string
    {
        return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
    }
}

$detail = $karyaItem ?? null;
$imageSrc = $detail ? assetUrl($detail['gambar_proyek'] ?? '') : '';
$fallbackImage = 'https://placehold.co/900x520?text=Karya';

$relatedKarya = [];
if (!empty($allKarya) && is_array($allKarya)) {
    foreach ($allKarya as $item) {
        if (!isset($detail['id']) || (int) $item['id'] !== (int) $detail['id']) {
            $relatedKarya[] = $item;
        }
    }
    $relatedKarya = array_slice($relatedKarya, 0, 3);
}

// Detect referrer untuk dynamic back button
$from = $_GET['from'] ?? 'catalog';
$backUrl = 'index.php?page=catalog';
$backText = 'Kembali ke Karya';

if ($from === 'home') {
    $backUrl = 'index.php';
    $backText = 'Kembali ke Home';
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo h($detail['judul'] ?? 'Detail Karya'); ?> - Lab MMT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
    </style>
</head>
<body class="bg-white">

<main class="bg-white">
    <article class="max-w-5xl mx-auto px-4 pt-24 pb-14 space-y-8">
        <!-- Back Button - Bigger -->
        <div class="fade-in-up">
            <a href="<?= $backUrl ?>"
               class="inline-flex items-center gap-3 px-6 py-3 bg-orange-500 text-white font-semibold rounded-xl hover:bg-orange-600 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105 group">
                <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <?= $backText ?>
            </a>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden fade-in-up delay-100">
            <div class="w-full h-[320px] md:h-[460px] bg-gray-100 relative">
                <img src="<?php echo $imageSrc !== '' ? h($imageSrc) : $fallbackImage; ?>"
                     alt="<?php echo h($detail['judul'] ?? 'Karya'); ?>"
                     class="w-full h-full object-cover">
            </div>

            <div class="p-6 md:p-8 space-y-6">
                <div class="flex flex-wrap gap-3 text-sm text-gray-600">
                    <?php if (!empty($detail['nama_kategori'])): ?>
                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-orange-100 text-orange-700 font-semibold">
                            <?php echo h($detail['nama_kategori']); ?>
                        </span>
                    <?php endif; ?>
                    <?php if (!empty($detail['tahun'])): ?>
                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 font-semibold">
                            Tahun <?php echo h((string) $detail['tahun']); ?>
                        </span>
                    <?php endif; ?>
                    <?php if (!empty($detail['nama_tim'])): ?>
                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 font-semibold">
                            Tim: <?php echo h($detail['nama_tim']); ?>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="space-y-3">
                    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 leading-tight">
                        <?php echo h($detail['judul'] ?? 'Karya tidak ditemukan'); ?>
                    </h1>
                    <?php if (!empty($detail['isi_proyek'])): ?>
                        <p class="text-gray-700 leading-relaxed">
                            <?php echo nl2br(h($detail['isi_proyek'])); ?>
                        </p>
                    <?php else: ?>
                        <p class="text-gray-500">Detail karya belum tersedia.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php if (!empty($relatedKarya)): ?>
            <section class="space-y-4 fade-in-up delay-200">
                <h2 class="text-2xl font-bold text-gray-900">Detail Lainnya</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <?php foreach ($relatedKarya as $karya): ?>
                        <?php
                        $link = 'index.php?page=detailKarya';
                        if (!empty($karya['id'])) {
                            $link .= '&id=' . urlencode((string) $karya['id']);
                        }
                        $link .= '&from=' . $from;
                        $thumb = assetUrl($karya['gambar_proyek'] ?? ($karya['image'] ?? ''));
                        $text = trim(strip_tags($karya['isi_proyek'] ?? ($karya['excerpt'] ?? '')));
                        ?>
                        <a href="<?php echo h($link); ?>"
                           class="group bg-white border border-gray-100 rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition">
                            <div class="h-36 bg-gray-100 overflow-hidden">
                                <img src="<?php echo $thumb !== '' ? h($thumb) : $fallbackImage; ?>"
                                     alt="<?php echo h($karya['judul'] ?? 'Karya'); ?>"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="p-4 space-y-2">
                                <h3 class="font-semibold text-gray-900 group-hover:text-orange-600 transition-colors line-clamp-2">
                                    <?php echo h($karya['judul'] ?? ''); ?>
                                </h3>
                                <p class="text-sm text-gray-600 line-clamp-2">
                                    <?php echo h(mb_substr($text, 0, 120)); ?>
                                </p>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>
    </article>
</main>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
</body>
</html>
