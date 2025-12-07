<?php
include '../lib/Connection.php';
include '../layouts/header.php'; 

// --- Ambil ID Proyek dari URL ---
$proyek_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($proyek_id === 0) {
    echo "<div class='max-w-6xl mx-auto px-4 py-8'><h1 class='text-center text-red-500 mt-10 text-xl font-bold'>ID Proyek tidak ditemukan atau tidak valid.</h1></div>";
    include '../layouts/footer.php';
    exit;
}

$pdo = Connection::getConnection();
$karya = [];

// --- Query Detail Proyek Utama ---
$sql_detail = "
    SELECT 
        dp.judul, 
        dp.isi_proyek, 
        dp.gambar_proyek,
        dp.tahun,
        dp.nama_tim,
        k.nama_kategori
    FROM public.daftar_proyek dp
    LEFT JOIN public.kategori k ON dp.kategori_id = k.id
    WHERE dp.id = :id";

try {
    $stmt_detail = $pdo->prepare($sql_detail);
    $stmt_detail->execute([':id' => $proyek_id]);
    $karya_db = $stmt_detail->fetch();

    if (!$karya_db) {
        echo "<div class='max-w-6xl mx-auto px-4 py-8'><h1 class='text-center text-red-500 mt-10 text-xl font-bold'>Proyek dengan ID $proyek_id tidak ditemukan.</h1></div>";
        include '../layouts/footer.php';
        exit;
    }

    // Mapping data DB ke struktur array yang dibutuhkan di HTML
    $karya = [
        "judul" => $karya_db["judul"],
        "kategori" => $karya_db["nama_kategori"] ?? 'Tidak Ada Kategori',
        "deskripsi" => $karya_db["isi_proyek"], 
        "thumbnail" => $karya_db["gambar_proyek"],
        "tahun" => $karya_db["tahun"] ?? 'Tahun T/A', 
        "nama_tim" => $karya_db["nama_tim"] ?? 'Tim Kreatif',
        "anggota" => [] 
    ];

} catch (PDOException $e) {
    die("Error mengambil detail proyek: " . $e->getMessage());
}

// --- Query Anggota Tim (Mahasiswa) ---
$sql_anggota = "
    SELECT 
        m.nama
    FROM public.mahasiswa_proyek mp
    JOIN public.mahasiswa m ON mp.mahasiswa_id = m.id
    WHERE mp.proyek_id = :id
    ORDER BY m.nama ASC";

try {
    $stmt_anggota = $pdo->prepare($sql_anggota);
    $stmt_anggota->execute([':id' => $proyek_id]);
    $karya["anggota"] = $stmt_anggota->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    $karya["anggota"] = [];
}

// --- Query Karya Lainnya ---
$sql_karya_lain = "
    SELECT 
        dp.id, dp.judul, dp.gambar_proyek, k.nama_kategori
    FROM public.daftar_proyek dp
    LEFT JOIN public.kategori k ON dp.kategori_id = k.id
    WHERE dp.id != :id
    ORDER BY dp.id DESC
    LIMIT 3";

$karya_lain = [];
try {
    $stmt_lain = $pdo->prepare($sql_karya_lain);
    $stmt_lain->execute([':id' => $proyek_id]);
    $karya_lain = $stmt_lain->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    
}

//--- Tampilan ---
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($karya["judul"]); ?></title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-in-up { animation: fadeInUp 0.6s ease-out forwards; opacity: 0; }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
    </style>
</head>

<body class="bg-gray-50">

<main class="max-w-6xl mx-auto px-4 pt-24 pb-16">

    <!-- Tombol Kembali -->
    <div class="mb-8 fade-in-up">
        <a href="../index.php?page=catalog"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-orange-500 text-white font-semibold rounded-lg hover:bg-orange-600 transition-all duration-300 shadow-md hover:shadow-lg group">
            <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Karya
        </a>
    </div>

    <!-- Hero Image -->
    <div class="fade-in-up delay-100 mb-12">
        <div class="rounded-2xl overflow-hidden shadow-lg">
            <div class="w-full h-64 md:h-96 bg-gray-100 overflow-hidden group">
                <img src="<?= !empty($karya['thumbnail']) ? '../'.htmlspecialchars($karya['thumbnail']) : 'https://placehold.co/900x520?text=Gambar' ?>"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
            </div>
        </div>
    </div>

    <!-- Konten 2 Kolom -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 fade-in-up delay-200">

        <!-- Sidebar -->
        <div class="lg:col-span-4">
            <div class="bg-white rounded-xl border border-gray-200 p-6 sticky top-24 shadow-sm">
                <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-4 pb-3 border-b">
                    Detail Proyek
                </h3>

                <div class="space-y-4 text-sm">

                    <div>
                        <p class="text-gray-500 mb-1">Kategori</p>
                        <p class="font-semibold"><?= htmlspecialchars($karya['kategori']) ?></p>
                    </div>

                    <div>
                        <p class="text-gray-500 mb-1">Tahun</p>
                        <p class="font-semibold"><?= htmlspecialchars($karya['tahun']) ?></p>
                    </div>

                    <div>
                        <p class="text-gray-500 mb-1">Nama Tim</p>
                        <p class="font-semibold"><?= htmlspecialchars($karya['nama_tim']) ?></p>
                    </div>

                    <div>
                        <p class="text-gray-500 mb-2">Anggota Tim</p>
                        <ul class="space-y-1">
                            <?php if (!empty($karya["anggota"])): ?>
                                <?php foreach ($karya["anggota"] as $m): ?>
                                    <li class="font-semibold"><?= htmlspecialchars($m) ?></li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li class="text-gray-400 italic">Tidak ada anggota</li>
                            <?php endif; ?>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="lg:col-span-8">
            <h1 class="text-3xl md:text-4xl font-bold mb-6">
                <?= htmlspecialchars($karya['judul']); ?>
            </h1>

            <div class="space-y-6">
                <div>
                    <h2 class="text-xl font-bold mb-3">Deskripsi</h2>
                    <p class="text-gray-700 leading-relaxed text-justify">
                        <?= nl2br(htmlspecialchars($karya['deskripsi'])); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Karya Lainnya -->
    <?php if (!empty($karya_lain)): ?>
        <section class="fade-in-up delay-300 mt-20">
            <h2 class="text-2xl font-bold text-center mb-6">Lihat Karya Lainnya</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <?php foreach ($karya_lain as $k): ?>
                    <a href="detailKarya.php?id=<?= $k['id']; ?>"
                       class="group bg-white rounded-xl border-2 border-gray-200 overflow-hidden hover:border-orange-400 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">

                        <div class="h-44 bg-gray-100 overflow-hidden">
                            <img src="<?= !empty($k['gambar_proyek']) ? '../'.htmlspecialchars($k['gambar_proyek']) : 'https://placehold.co/600x300?text=Gambar'; ?>"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>

                        <div class="p-5 space-y-3">
                            <h3 class="font-bold text-gray-900 group-hover:text-orange-600 transition-colors line-clamp-2">
                                <?= htmlspecialchars($k['judul']); ?>
                            </h3>

                            <span class="inline-block bg-orange-500 text-white px-3 py-1 text-xs rounded">
                                <?= htmlspecialchars($k['nama_kategori'] ?? 'N/A'); ?>
                            </span>

                            <button class="w-full bg-orange-500 text-white text-sm font-semibold py-2.5 rounded-lg hover:bg-orange-600 transition">
                                Lihat Detail
                            </button>
                        </div>
                    </a>
                <?php endforeach; ?>

            </div>
        </section>
    <?php endif; ?>

</main>

<?php include '../layouts/footer.php'; ?>

</body>
</html>