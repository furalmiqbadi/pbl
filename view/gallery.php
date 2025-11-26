<?php include '../layouts/header.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Multimedia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .text-brand-dark { color: #1f2937; }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">

<section class="bg-white pt-24 pb-12 text-center">
    <div class="max-w-screen-xl mx-auto px-4"> <h1 class="font-heading font-bold text-3xl md:text-4xl text-brand-dark mb-2">
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
                    $judul = htmlspecialchars($item['judul']);
                    $deskripsi = htmlspecialchars($item['deskripsi']);
                    $gambar = htmlspecialchars($item['gambar_galeri']);
                    $tanggal = !empty($item['tanggal_upload'])
                               ? date('d F Y', strtotime($item['tanggal_upload']))
                               : 'N/A';
                ?>
                
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 transform hover:scale-[1.02] hover:shadow-2xl">
                    
                    <div class="h-56"> <img src="<?= $gambar ?>" alt="<?= $judul ?>" class="object-cover w-full h-full">
                    </div>

                    <div class="bg-gray-800 p-5">
                        <h3 class="text-xl font-bold text-white mb-2 line-clamp-2" title="<?= $judul ?>"><?= $judul ?></h3>
                        <p class="text-sm text-gray-300 mb-4 line-clamp-3"><?= $deskripsi ?></p> <div class="flex justify-between items-center border-t border-gray-600 pt-4">
                            <span class="text-xs font-medium text-red-400">📅 <?= $tanggal ?></span>
                            <a href="#" class="text-sm font-semibold text-blue-300 hover:text-blue-200 transition duration-150">Lihat Detail &rarr;</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="col-span-full text-center text-gray-500 py-12 text-lg">
                Tidak ada data galeri yang tersedia saat ini.
            </p>
        <?php endif; ?>
    </div>
    </div>
<?php include '../layouts/footer.php'; ?>
</body>
</html>