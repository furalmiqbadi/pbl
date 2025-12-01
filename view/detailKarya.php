<?php
include '../lib/Connection.php';
include '../layouts/header.php'; 

// --- 1. Ambil ID Proyek dari URL ---
$proyek_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($proyek_id === 0) {
    echo "<div class='max-w-6xl mx-auto px-4 py-8'><h1 class='text-center text-red-500 mt-10 text-xl font-bold'>ID Proyek tidak ditemukan atau tidak valid.</h1></div>";
    include '../layouts/footer.php';
    exit;
}

$pdo = Connection::getConnection();
$karya = [];

// --- Query Detail Proyek Utama ---
// Mengambil data proyek, join dengan tabel kategori
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

// --- 3. Query Anggota Tim (Mahasiswa) ---
// Mengambil daftar nama mahasiswa untuk proyek ini
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
</head>

<body class="bg-gray-50">

<div class="max-w-6xl mx-auto px-4 mt-24 mb-6">

    <a href="catalog.php"
       class="inline-flex items-center gap-2 bg-orange-500 text-white px-6 py-2 
          rounded-xl font-semibold shadow-md hover:bg-orange-600 
          transition mb-8">
        <span class="text-lg">←</span> 
        <span>Kembali ke Karya</span>
    </a>

    <div class="w-full rounded-xl overflow-hidden border border-gray-300 shadow-sm">
        <?php 
            $gambar_path = !empty($karya['thumbnail']) ? '../assets/images/uploads/' . htmlspecialchars($karya['thumbnail']) : 'https://via.placeholder.com/1200x420?text=Gambar+Tidak+Tersedia';
        ?>
        <img src="<?= $gambar_path; ?>" 
             alt="<?= htmlspecialchars($karya['judul']) ?>"
             class="w-full h-[420px] object-cover" />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-10">

        <div class="bg-white p-6 rounded-xl border shadow-sm text-sm space-y-3">
            <div>
                <p class="text-gray-500">Kategori</p>
                <p class="font-semibold"><?= htmlspecialchars($karya["kategori"]) ?></p>
            </div>

            <div>
                <p class="text-gray-500">Tahun</p>
                <p class="font-semibold"><?= htmlspecialchars($karya["tahun"]) ?></p>
            </div>

            <div>
                <p class="text-gray-500">Nama Tim</p>
                <p class="font-semibold">"<?= htmlspecialchars($karya["nama_tim"]) ?>"</p>
            </div>

            <div>
                <p class="text-gray-500">Anggota Tim</p>
                <ul class="list-disc ml-5">
                    <?php if (count($karya["anggota"]) > 0): ?>
                        <?php foreach ($karya["anggota"] as $mhs): ?>
                            <li><?= htmlspecialchars($mhs) ?></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>Tidak ada anggota tercatat</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <div class="md:col-span-2 space-y-6">
            <h1 class="text-3xl font-bold"><?= htmlspecialchars($karya["judul"]) ?></h1>

            <div>
                <h2 class="text-xl font-bold mb-2">Deskripsi</h2>
                <p class="text-gray-700 leading-relaxed">
                    <?= nl2br(htmlspecialchars($karya["deskripsi"])) ?>
                </p>
            </div>

        </div>

    </div>

    <div class="mt-20">
        <h2 class="text-2xl font-bold text-center mb-6">Lihat Karya Lainnya</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <?php if (count($karya_lain) > 0): ?>
                <?php foreach ($karya_lain as $k): ?>
                    <div 
                        class="bg-white border rounded-xl shadow-sm overflow-hidden p-4 cursor-pointer hover:shadow-md transition"
                        onclick="window.location.href='pbl/view/detailKarya.php?id=<?= $k['id'] ?>'"
                    >
                        <?php 
                            $img_path_lain = !empty($k['gambar_proyek']) ? '../assets/images/uploads/' . htmlspecialchars($k['gambar_proyek']) : 'https://via.placeholder.com/400x160?text=No+Image';
                        ?>
                        <div class="w-full h-40 bg-gray-200 rounded overflow-hidden">
                            <img src="<?= $img_path_lain ?>" alt="<?= htmlspecialchars($k['judul']) ?>" class="w-full h-full object-cover">
                        </div>
                        <h3 class="font-semibold mt-3"><?= htmlspecialchars($k["judul"]) ?></h3>
                        <span class="inline-block bg-orange-500 text-white text-xs px-3 py-1 rounded mt-2">
                            <?= htmlspecialchars($k["nama_kategori"] ?? 'N/A') ?>
                        </span>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                 <p class="text-gray-500 col-span-full text-center">Tidak ada karya lain yang tersedia.</p>
            <?php endif; ?>
        </div>
    </div>

</div>

<?php include '../layouts/footer.php'; ?>

</body>
</html>