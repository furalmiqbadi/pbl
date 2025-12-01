<?php 
if (!function_exists('h')) { function h($v) { return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8'); } }
include __DIR__ . '/../layouts/header.php'; 
$mainImage = assetUrl($detail['gambar_galeri']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Galeri - Lab MMT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .content-body p { margin-bottom: 1.5rem; line-height: 1.8; color: #4b5563; }
        .sidebar-card { transition: all 0.3s ease; }
        .sidebar-card:hover { transform: translateY(-3px); box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); }
    </style>
</head>
<body class="bg-white text-gray-800 font-sans">

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 pt-24">
        
        <div class="mb-8">
            <a href="index.php?page=gallery" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-orange-600 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Galeri
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <div class="lg:col-span-2">
                
                <div class="text-center mb-4">
                    <span class="text-orange-500 font-bold tracking-wider text-xs uppercase">Dokumentasi Lab MMT</span>
                </div>

                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 text-center mb-4 leading-tight">
                    Kegiatan & Dokumentasi Laboratorium
                </h1>

                <div class="text-center text-gray-400 text-sm mb-10">
                    Oleh Admin &bull; Galeri ID #<?= h($detail['id']) ?>
                </div>

                <div class="w-full rounded-3xl overflow-hidden shadow-lg mb-10">
                    <img src="<?= $mainImage ?>" 
                         alt="Detail Galeri" 
                         class="w-full h-auto object-cover max-h-[500px]">
                </div>

                <div class="content-body text-lg text-justify border-b border-gray-100 pb-10">
                    <?php 
                        echo nl2br(h($detail['deskripsi'])); 
                    ?>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="sticky top-24">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 border-l-4 border-orange-500 pl-3">
                        Lihat Juga
                    </h3>

                    <div class="space-y-6">
                        <?php if (!empty($sidebarGallery)): ?>
                            <?php foreach ($sidebarGallery as $sideItem): ?>
                                <div class="bg-white border border-gray-200 rounded-2xl p-4 sidebar-card flex flex-col gap-3">
                                    <div class="h-40 bg-gray-200 rounded-xl overflow-hidden relative">
                                        <img src="<?= assetUrl($sideItem['gambar_galeri']) ?>" 
                                             class="w-full h-full object-cover" 
                                             alt="Thumbnail">
                                    </div>
                                    
                                    <div>
                                        <div class="text-xs text-gray-400 mb-1">Dokumentasi</div>
                                        <p class="font-bold text-gray-800 line-clamp-2 text-sm mb-3">
                                            <?= h(mb_substr($sideItem['deskripsi'], 0, 60)) ?>...
                                        </p>
                                        
                                        <a href="index.php?page=detailGallery&id=<?= $sideItem['id'] ?>" 
                                           class="inline-block w-full text-center bg-orange-500 text-white text-xs font-bold py-2 rounded-lg hover:bg-orange-600 transition">
                                            Lihat Foto
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-gray-500 text-sm italic">Belum ada galeri lain.</p>
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