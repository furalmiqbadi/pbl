<?php include __DIR__ . '/../layouts/header.php'; ?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Multimedia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .hover-zoom-img {
            transition: transform 0.5s ease;
        }
        .group:hover .hover-zoom-img {
            transform: scale(1.1);
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen font-sans">

    <section class="relative bg-white pt-32 pb-20 text-center overflow-hidden">
        <div class="absolute top-0 left-0 w-64 h-64 bg-orange-100 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2 opacity-60"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-blue-100 rounded-full blur-3xl translate-x-1/3 translate-y-1/3 opacity-60"></div>

        <div class="relative z-10 max-w-4xl mx-auto px-4">
            <span class="inline-block py-1 px-3 rounded-full bg-orange-50 text-orange-600 text-xs font-bold tracking-widest uppercase mb-4 border border-orange-100">
                Dokumentasi & Karya
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-6 leading-tight">
                Galeri Laboratorium <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-600">Multimedia</span>
            </h1>
            <p class="text-gray-500 text-lg md:text-xl max-w-2xl mx-auto leading-relaxed">
                Menjelajahi momen terbaik, inovasi teknologi, dan kreativitas mahasiswa dalam satu bingkai visual.
            </p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 py-12 pb-24">
        
        <?php if (!empty($data)): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($data as $item): ?>
                    <?php
                    $deskripsiRaw = strip_tags($item['deskripsi'] ?? '');
                    $deskripsi = mb_substr($deskripsiRaw, 0, 100) . (strlen($deskripsiRaw) > 100 ? '...' : '');
                    $gambar = assetUrl($item['gambar_galeri']);
                    ?>

                    <div class="group relative bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 overflow-hidden flex flex-col transition-all duration-300 transform hover:-translate-y-2">
                        
                        <div class="relative h-64 overflow-hidden bg-gray-200">
                            <img src="<?= $gambar ?>" 
                                 alt="Galeri"
                                 loading="lazy"
                                 class="hover-zoom-img object-cover w-full h-full">
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            <a href="index.php?page=detailGallery&id=<?= $item['id'] ?>" 
                               class="absolute bottom-4 right-4 bg-white/20 backdrop-blur-md border border-white/40 text-white w-10 h-10 rounded-full flex items-center justify-center translate-y-10 group-hover:translate-y-0 transition-transform duration-300 hover:bg-orange-500 hover:border-orange-500">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>

                        <div class="p-6 flex flex-col flex-1">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="w-2 h-2 rounded-full bg-orange-500"></span>
                                <span class="text-xs font-bold text-gray-400 uppercase tracking-wide">Dokumentasi</span>
                            </div>
                            
                            <p class="text-gray-700 text-sm leading-relaxed mb-4 flex-1">
                                <?= $deskripsi ?: 'Tidak ada deskripsi tersedia.' ?>
                            </p>

                            <div class="pt-4 border-t border-gray-50 flex justify-between items-center mt-auto">
                                <span class="text-xs text-gray-400">Lab MMT JTI</span>
                                <a href="index.php?page=detailGallery&id=<?= $item['id'] ?>" 
                                   class="text-sm font-bold text-orange-600 hover:text-orange-700 group-hover:underline decoration-2 underline-offset-4 transition">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if (isset($totalPages) && $totalPages > 1): ?>
                <div class="mt-16 flex justify-center">
                    <nav class="inline-flex rounded-xl shadow-sm bg-white p-1 border border-gray-100 gap-1">
                        
                        <a href="?page=gallery&p=<?= max(1, $currentPage - 1) ?>" 
                           class="px-4 py-2 rounded-lg text-sm font-medium transition-colors <?= $currentPage <= 1 ? 'text-gray-300 cursor-not-allowed' : 'text-gray-600 hover:bg-orange-50 hover:text-orange-600' ?>">
                           <i class="fas fa-chevron-left mr-1"></i> Prev
                        </a>

                        <?php 
                        $start = max(1, $currentPage - 2);
                        $end = min($totalPages, $currentPage + 2);
                        
                        if($start > 1) echo '<span class="px-3 py-2 text-gray-400">...</span>';
                        
                        for ($i = $start; $i <= $end; $i++): 
                        ?>
                            <a href="?page=gallery&p=<?= $i ?>" 
                               class="w-9 h-9 flex items-center justify-center rounded-lg text-sm font-bold transition-all <?= $i == $currentPage ? 'bg-orange-500 text-white shadow-md' : 'text-gray-600 hover:bg-gray-100' ?>">
                                <?= $i ?>
                            </a>
                        <?php endfor; ?>

                        <?php if($end < $totalPages) echo '<span class="px-3 py-2 text-gray-400">...</span>'; ?>

                        <a href="?page=gallery&p=<?= min($totalPages, $currentPage + 1) ?>" 
                           class="px-4 py-2 rounded-lg text-sm font-medium transition-colors <?= $currentPage >= $totalPages ? 'text-gray-300 cursor-not-allowed' : 'text-gray-600 hover:bg-orange-50 hover:text-orange-600' ?>">
                           Next <i class="fas fa-chevron-right ml-1"></i>
                        </a>
                    </nav>
                </div>
                <div class="text-center mt-4 text-xs text-gray-400">
                    Halaman <?= $currentPage ?> dari <?= $totalPages ?>
                </div>
            <?php endif; ?>

        <?php else: ?>
            <div class="flex flex-col items-center justify-center py-20 bg-white rounded-3xl border border-dashed border-gray-200">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                    <i class="far fa-images text-3xl text-gray-300"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Belum ada Galeri</h3>
                <p class="text-gray-500 mt-2">Dokumentasi kegiatan akan segera ditambahkan.</p>
            </div>
        <?php endif; ?>

    </div>

    <?php include __DIR__ . '/../layouts/footer.php'; ?>
</body>
</html>