<?php
// --- DATA DUMMY (sementara tanpa database) ---
$karya = [
    "judul" => "Sistem Informasi Akademik Pintar",
    "kategori" => "Mobile Application",
    "tahun" => 2025,
    "nama_tim" => "Nama Tim",
    "anggota" => [
        "Mahasiswa 1",
        "Mahasiswa 2",
        "Mahasiswa 3",
        "Mahasiswa 4"
    ],
    "thumbnail" => "https://sl.bing.net/fh7GkLR12Qu",
    "deskripsi" => "
        Sistem informasi akademik pintar adalah sebuah inovasi terbaru dari mahasiswa Politeknik Negeri Malang 
        dengan mengkombinasikan teknologi modern...
    ",
    "latar_belakang" => "
        Pernahkah Anda merasa frustrasi karena melewatkan kelas akibat perubahan jadwal mendadak?
        Atau bingung menghitung jatah absen yang tersisa? 
        Kesenjangan antara kebutuhan mahasiswa modern dan sistem birokrasi lama membuat kami mencari solusi.
    "
];

// Dummy karya lainnya
$karya_lain = [
    ["judul" => "Aplikasi Smart Kampus", "kategori" => "Mobile Dev"],
    ["judul" => "Aplikasi Smart Kampus", "kategori" => "Mobile Dev"],
    ["judul" => "Aplikasi Smart Kampus", "kategori" => "Mobile Dev"],
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $karya["judul"]; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

<!-- HEADER -->
<?php include '../layouts/header.php'; ?>

<!-- MAIN CONTENT -->
<div class="max-w-6xl mx-auto px-4 py-8">

    <!-- Tombol Kembali -->
    <a href="karya.php"
       class="inline-block bg-orange-500 text-white px-5 py-2 rounded-lg font-medium mb-6 hover:bg-orange-600">
        ← Kembali ke Karya
    </a>

    <!-- Gambar Utama -->
    <div class="w-full rounded-xl overflow-hidden border border-gray-300 shadow-sm">
        <img src="<?= $karya['thumbnail']; ?>" 
             class="w-full h-[420px] object-cover" />
    </div>

    <!-- Konten Utama -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-10">

        <!-- Info Kiri -->
        <div class="bg-white p-6 rounded-xl border shadow-sm text-sm space-y-3">
            <div>
                <p class="text-gray-500">Kategori</p>
                <p class="font-semibold"><?= $karya["kategori"] ?></p>
            </div>

            <div>
                <p class="text-gray-500">Tahun</p>
                <p class="font-semibold"><?= $karya["tahun"] ?></p>
            </div>

            <div>
                <p class="text-gray-500">Nama Tim</p>
                <p class="font-semibold">"<?= $karya["nama_tim"] ?>"</p>
            </div>

            <div>
                <p class="text-gray-500">Anggota Tim</p>
                <ul class="list-disc ml-5">
                    <?php foreach ($karya["anggota"] as $mhs): ?>
                        <li><?= $mhs ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <!-- Konten Kanan -->
        <div class="md:col-span-2 space-y-6">
            <h1 class="text-3xl font-bold"><?= $karya["judul"] ?></h1>

            <p class="text-gray-700 leading-relaxed"><?= $karya["deskripsi"] ?></p>

            <div>
                <h2 class="text-xl font-bold mb-2">Latar Belakang</h2>
                <p class="text-gray-700 leading-relaxed">
                    <?= nl2br(trim($karya["latar_belakang"])) ?>
                </p>
            </div>
        </div>

    </div>

    <!-- Karya Lainnya -->
    <div class="mt-20">
        <h2 class="text-2xl font-bold text-center mb-6">Lihat Karya Lainnya</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <?php foreach ($karya_lain as $k): ?>
                <div class="bg-white border rounded-xl shadow-sm overflow-hidden p-4">
                    <div class="w-full h-40 bg-gray-200 rounded"></div>
                    <h3 class="font-semibold mt-3"><?= $k["judul"] ?></h3>
                    <span class="inline-block bg-orange-500 text-white text-xs px-3 py-1 rounded mt-2">
                        <?= $k["kategori"] ?>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>

<!-- FOOTER -->
<?php include '../layouts/footer.php'; ?>

</body>
</html>
