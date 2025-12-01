<?php 
if (!function_exists('h')) { function h($v) { return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8'); } }
include __DIR__ . '/../layouts/header.php'; 

$gambarUtama = assetUrl($detail['gambar_galeri']);

$deskripsiFull = $detail['deskripsi'];
$judulBuatan = implode(' ', array_slice(explode(' ', $deskripsiFull), 0, 10)) . '...';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Galeri - Lab MMT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-white text-gray-800">

    <main class="max-w-6xl mx-auto px-4 py-12 pt-24">
        
        <div class="text-center mb-4">
            <span class="text-orange-500 font-bold uppercase tracking-widest text-xs">Dokumentasi & Galeri</span>
        </div>

        <h1 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-4 leading-tight max-w-4xl mx-auto">
            <?= h($judulBuatan) ?>
        </h1>

        <div class="text-center text-gray-400 text-xs mb-10 font-medium">
            Oleh <span class="text-gray-600">Admin Lab MMT</span> &bull; Dokumentasi Kegiatan
        </div>

        <div class="w-full mb-12">
            <div class="rounded-3xl overflow-hidden shadow-xl aspect-video relative group">
                <img src="<?= $gambarUtama ?>" 
                     alt="Detail Galeri" 
                     class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <div class="lg:col-span-8">
                <div class="prose prose-lg text-gray-600 leading-relaxed text-justify max-w-none">
                    <p class="mb-6 font-semibold text-gray-800">
                        Berikut adalah detail dokumentasi dari kegiatan yang telah dilaksanakan di Laboratorium Multimedia JTI Polinema.
                    </p>
                    <p>
                        <?= nl2br(h($detail['deskripsi'])) ?>
                    </p>
                </div>
            </div>

            <div class="lg:col-span-4 space-y-8">
                
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Lihat Juga</h3>
                    
                    <div class="space-y-6">
                        <?php if (!empty($sidebarGallery)): ?>
                            <?php foreach ($sidebarGallery as $sideItem): ?>
                                <?php 
                                    $descSide = implode(' ', array_slice(explode(' ', $sideItem['deskripsi']), 0, 8)) . '...';
                                ?>
                                <div class="bg-gray-50 border border-gray-200 rounded-xl overflow-hidden hover:shadow-md transition group">
                                    <div class="h-40 overflow-hidden relative">
                                        <img src="<?= assetUrl($sideItem['gambar_galeri']) ?>" 
                                             class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                    </div>
                                    <div class="p-5">
                                        <h4 class="font-bold text-gray-800 text-sm mb-2 line-clamp-2">
                                            <?= h($descSide) ?>
                                        </h4>
                                        <div class="text-xs text-gray-400 mb-4">Galeri Lainnya</div>
                                        
                                        <a href="index.php?page=detailGallery&id=<?= $sideItem['id'] ?>" 
                                           class="block w-full text-center bg-orange-500 text-white text-xs font-bold py-2.5 rounded-lg hover:bg-orange-600 transition shadow-sm">
                                            Lihat Selengkapnya
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="p-4 bg-gray-50 rounded-lg text-center text-sm text-gray-500 italic">
                                Tidak ada galeri lain saat ini.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>

        </div>
    </main>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</body>
</html>