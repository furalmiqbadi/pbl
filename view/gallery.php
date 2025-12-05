<?php 

$pageNum = isset($currentPage) ? (int)$currentPage : 1;
$totalPageNum = isset($totalPages) ? (int)$totalPages : 1;

include __DIR__ . '/../layouts/header.php'; 

$dataGallery = $data ?? [];
$currPage = max(1, $pageNum); 
$pages = max(1, $totalPageNum);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Multimedia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { display: flex; flex-direction: column; min-height: 100vh; }
        main { flex: 1; }
        .gallery-card:hover .overlay { opacity: 1; }
        .gallery-card:hover img { transform: scale(1.1); }
    </style>
</head>

<body class="bg-gray-50 font-sans text-gray-800">

    <section class="bg-white pt-28 pb-10 shadow-sm border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <span class="inline-block py-1 px-3 rounded-full bg-orange-100 text-orange-600 text-xs font-bold tracking-widest uppercase mb-3">
                Dokumentasi
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-2">
                Galeri <span class="text-orange-600">Multimedia</span>
            </h1>
            <p class="text-gray-500">Kumpulan karya dan aktivitas terbaru Lab MMT.</p>
        </div>
    </section>

    <main class="w-full max-w-7xl mx-auto px-4 py-12">
        
        <?php if (!empty($dataGallery)): ?>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                <?php foreach ($dataGallery as $item): ?>
                    <?php
                        $deskripsi = strip_tags($item['deskripsi'] ?? '');
                        $gambar = assetUrl($item['gambar_galeri']);
                    ?>
                    <div class="gallery-card group relative bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 h-72 border border-gray-100 cursor-pointer">
                        <img src="<?= $gambar ?>" alt="Galeri" class="w-full h-full object-cover transition-transform duration-700">
                        
                        <div class="overlay absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent opacity-0 transition-opacity duration-300 flex flex-col justify-end p-6">
                            
                            <?php if (!empty($deskripsi)): ?>
                                <p class="text-white text-sm font-medium line-clamp-2 mb-4">
                                    <?= htmlspecialchars($deskripsi) ?>
                                </p>
                            <?php endif; ?>

                            <a href="index.php?page=detailGallery&id=<?= $item['id'] ?>" 
                               class="inline-flex items-center justify-center bg-orange-600 hover:bg-orange-700 text-white text-xs font-bold py-3 px-4 rounded-xl transition shadow-lg translate-y-2 group-hover:translate-y-0 duration-300">
                                Lihat Detail <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="flex flex-col items-center justify-center gap-6 mt-10 mb-10 pb-10 border-t border-gray-200 pt-10">
                
                <div class="flex items-center gap-3 bg-white p-2 rounded-2xl shadow-sm border border-gray-200">
                    
                    <?php if ($currPage > 1): ?>
                        <a href="index.php?page=gallery&p=<?= $currPage - 1 ?>" 
                           class="flex items-center px-5 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-xl font-bold hover:bg-orange-50 hover:text-orange-600 hover:border-orange-200 transition">
                           <i class="fas fa-arrow-left mr-2"></i> Sebelumnya
                        </a>
                    <?php else: ?>
                        <span class="flex items-center px-5 py-2.5 bg-gray-100 border border-gray-200 text-gray-400 rounded-xl font-bold cursor-not-allowed">
                           <i class="fas fa-arrow-left mr-2"></i> Sebelumnya
                        </span>
                    <?php endif; ?>

                    <div class="hidden md:flex gap-1 px-2">
                        <?php for($i = 1; $i <= $pages; $i++): ?>
                            <a href="index.php?page=gallery&p=<?= $i ?>" 
                               class="w-10 h-10 flex items-center justify-center rounded-lg font-bold transition <?= $i == $currPage ? 'bg-orange-600 text-white shadow-md' : 'bg-gray-50 text-gray-600 hover:bg-gray-100' ?>">
                                <?= $i ?>
                            </a>
                        <?php endfor; ?>
                    </div>

                    <?php if ($currPage < $pages): ?>
                        <a href="index.php?page=gallery&p=<?= $currPage + 1 ?>" 
                           class="flex items-center px-5 py-2.5 bg-orange-600 border border-orange-600 text-white rounded-xl font-bold hover:bg-orange-700 hover:shadow-lg transition">
                           Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    <?php else: ?>
                        <span class="flex items-center px-5 py-2.5 bg-gray-100 border border-gray-200 text-gray-400 rounded-xl font-bold cursor-not-allowed">
                           Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                        </span>
                    <?php endif; ?>
                </div>

                <p class="text-sm text-gray-400 font-medium bg-gray-100 px-4 py-1.5 rounded-full">
                    Menampilkan Halaman <span class="text-orange-600 font-bold"><?= $currPage ?></span> dari <?= $pages ?>
                </p>

            </div>

        <?php else: ?>
            <div class="flex flex-col items-center justify-center py-20 bg-white rounded-3xl border-2 border-dashed border-gray-200 text-center">
                <i class="far fa-images text-6xl text-gray-200 mb-4"></i>
                <h3 class="text-xl font-bold text-gray-800">Belum Ada Galeri</h3>
                <p class="text-gray-500 text-sm mt-2">Data galeri belum diunggah oleh admin.</p>
                <a href="index.php?page=home" class="mt-6 px-6 py-2 bg-gray-800 text-white rounded-full text-sm font-bold hover:bg-black transition">
                    Kembali ke Beranda
                </a>
            </div>
        <?php endif; ?>

    </main>

    <?php include __DIR__ . '/../layouts/footer.php'; ?>

</body>
</html>