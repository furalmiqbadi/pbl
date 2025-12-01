<?php include __DIR__ . '/../layouts/header.php'; ?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Multimedia</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen">

    <section class="bg-white pt-24 pb-12 text-center">
        <div class="max-w-screen-xl mx-auto px-4">
            <h1 class="font-heading font-bold text-3xl md:text-4xl text-gray-800 mb-2">
                Galeri Multimedia
            </h1>
            <p class="font-sans text-gray-500 text-sm md:text-base">
                Kumpulan karya dan dokumentasi dari berbagai sesi pelatihan
            </p>
        </div>
    </section>

    <div class="max-w-screen-xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            <?php if (!empty($data)): ?>
                <?php foreach ($data as $item): ?>
                    <?php
                    $deskripsi = htmlspecialchars($item['deskripsi'] ?? '');
                    $gambar = assetUrl($item['gambar_galeri']);
                    ?>

                    <div
                        class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 transform hover:scale-[1.02] hover:shadow-2xl flex flex-col h-full">

                        <div class="h-56 relative group">
                            <img src="<?= $gambar ?>" alt="Galeri"
                                class="object-cover w-full h-full transition duration-500 group-hover:scale-110">
                            <div class="absolute inset-0 bg-black/20 group-hover:bg-black/0 transition duration-300"></div>
                        </div>

                        <div class="bg-white p-5 flex flex-col flex-1">
                            <h3 class="text-lg font-bold text-gray-800 mb-2">Dokumentasi</h3>

                            <p class="text-sm text-gray-600 mb-4 line-clamp-3 flex-1">
                                <?= $deskripsi ?>
                            </p>

                            <div class="flex justify-between items-center border-t border-gray-600 pt-4">
                                <span class="text-xs font-medium text-red-400">📷 Dokumentasi</span>

                                <a href="index.php?page=detailGallery&id=<?= $item['id'] ?>"
                                    class="text-sm font-semibold text-blue-300 hover:text-blue-200 transition duration-150">
                                    Lihat Detail &rarr;
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full flex flex-col items-center justify-center text-gray-500 py-12">
                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    <p class="text-lg">Tidak ada data galeri yang tersedia saat ini.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php include __DIR__ . '/../layouts/footer.php'; ?>
</body>

</html>