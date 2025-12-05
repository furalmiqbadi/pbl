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
        body { 
            font-family: 'Poppins', sans-serif; 
        }

        /* Animasi untuk page load */
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

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .scale-in {
            animation: scaleIn 0.5s ease-out forwards;
        }

        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }

        /* Glassmorphism effect */
        .glass {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #1f2937 0%, #f97316 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-orange-50/30 to-gray-50 text-gray-800">

    <main class="max-w-6xl mx-auto px-4 py-12 pt-24">
        
        <!-- Breadcrumb -->
        <div class="mb-6 fade-in-up">
            <a href="index.php?page=gallery" 
               class="inline-flex items-center text-sm font-semibold text-gray-500 hover:text-orange-500 transition-colors group">
                <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Galeri
            </a>
        </div>

        <!-- Header Section -->
        <div class="text-center mb-6 fade-in-up delay-100">
            <span class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-gradient-to-r from-orange-50 to-pink-50 text-orange-700 font-semibold text-sm shadow-lg border border-orange-200/50 backdrop-blur-sm hover:shadow-xl transition-all duration-300">
                <span class="h-2 w-2 rounded-full bg-orange-500 animate-pulse"></span>
                Dokumentasi & Galeri
            </span>
        </div>

        <h1 class="text-3xl md:text-4xl font-bold text-center mb-4 leading-tight max-w-4xl mx-auto gradient-text fade-in-up delay-200">
            <?= h($judulBuatan) ?>
        </h1>

        <div class="text-center text-gray-500 text-sm mb-10 font-medium fade-in-up delay-300">
            Oleh <span class="text-orange-600 font-semibold">Admin Lab MMT</span> • Dokumentasi Kegiatan
        </div>

        <!-- Main Image -->
        <div class="w-full mb-12 scale-in delay-200">
            <div class="rounded-3xl overflow-hidden shadow-2xl aspect-video relative group">
                <img src="<?= $gambarUtama ?>" 
                     alt="Detail Galeri" 
                     class="w-full h-full object-cover transform group-hover:scale-105 transition-all duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <!-- Main Content -->
            <div class="lg:col-span-8 fade-in-up delay-400">
                <div class="glass rounded-3xl p-8 shadow-xl border border-white/50">
                    <div class="prose prose-lg text-gray-700 leading-relaxed text-justify max-w-none">
                        <p class="mb-6 font-semibold text-gray-800 text-lg">
                            Berikut adalah detail dokumentasi dari kegiatan yang telah dilaksanakan di Laboratorium Multimedia JTI Polinema.
                        </p>
                        <p class="text-base leading-loose">
                            <?= nl2br(h($detail['deskripsi'])) ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-4 space-y-8 fade-in-up delay-500">
                
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 gradient-text">Lihat Juga</h3>
                    
                    <div class="space-y-6">
                        <?php if (!empty($sidebarGallery)): ?>
                            <?php foreach ($sidebarGallery as $index => $sideItem): ?>
                                <?php 
                                    $descSide = implode(' ', array_slice(explode(' ', $sideItem['deskripsi']), 0, 8)) . '...';
                                ?>
                                <div class="group glass rounded-2xl overflow-hidden border border-white/50 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1 scale-in delay-<?php echo ($index + 6) * 100; ?>">
                                    <div class="h-40 overflow-hidden relative">
                                        <img src="<?= assetUrl($sideItem['gambar_galeri']) ?>" 
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    </div>
                                    <div class="p-5 bg-white/90">
                                        <h4 class="font-bold text-gray-800 text-sm mb-2 line-clamp-2 group-hover:text-orange-600 transition-colors">
                                            <?= h($descSide) ?>
                                        </h4>
                                        <div class="text-xs text-gray-400 mb-4">Galeri Lainnya</div>
                                        
                                        <a href="index.php?page=detailGallery&id=<?= $sideItem['id'] ?>" 
                                           class="block w-full text-center bg-gradient-to-r from-orange-500 to-orange-600 text-white text-xs font-bold py-2.5 rounded-lg hover:from-orange-600 hover:to-orange-700 transition-all duration-300 shadow-md hover:shadow-xl hover:scale-105 group/btn">
                                            <span class="inline-flex items-center gap-2">
                                                Lihat Selengkapnya
                                                <span class="group-hover/btn:translate-x-1 transition-transform duration-300">→</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="glass p-6 rounded-2xl text-center text-sm text-gray-500 italic border border-white/50">
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
