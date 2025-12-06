<?php
require_once __DIR__ . '/../lib/Connection.php';
include __DIR__ . '/../layouts/header.php';

$pdo = Connection::getConnection();

// Query mengambil semua data proyek beserta nama kategorinya
$sql = "SELECT dp.id, dp.judul, dp.gambar_proyek, k.nama_kategori
        FROM public.daftar_proyek dp
        LEFT JOIN public.kategori k ON dp.kategori_id = k.id
        ORDER BY dp.id DESC";
$karya = [];
try {
    $stmt = $pdo->query($sql);
    $karya = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "<p style='color: red;'>Error mengambil data proyek: " . $e->getMessage() . "</p>";
}

// Query mengambil semua kategori untuk filter
$sql_kategori = "SELECT nama_kategori FROM public.kategori ORDER BY nama_kategori ASC";
$kategori_list = [];
try {
    $stmt_kategori = $pdo->query($sql_kategori);
    $kategori_list = $stmt_kategori->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    echo "<p style='color: red;'>Error mengambil data kategori: " . $e->getMessage() . "</p>";
}
?>

<script src="https://cdn.tailwindcss.com"></script>

<div class="px-4 py-10 max-w-7xl mx-auto">

    <!-- Judul -->
    <section class="bg-white pt-24 pb-12 text-center">
        <div class="max-w-screen-xl mx-auto px-4">
            <h1 class="font-heading font-bold text-3xl md:text-4xl text-brand-dark mb-2">
                Galeri Karya Mahasiswa </h1>
            <p class="font-sans text-gray-500 text-sm md:text-base">
                Telusuri inovasi terbaru dari mahasiswa Lab MMT </p>
        </div>
    </section>

    <!-- Filter -->
    <div class="flex flex-wrap gap-3 justify-center items-center mb-10">
        <input id="searchInput" type="text" placeholder="Cari judul proyek..."
            class="px-4 py-2 border rounded-lg text-sm w-60">

        <select id="categoryFilter" 
            class="px-4 py-2 border rounded-lg text-sm">
            <option value="semua">Kategori: Semua</option>
            <?php foreach ($kategori_list as $nama_kategori): ?>
            <option value="<?= strtolower($nama_kategori) ?>"><?= ucwords($nama_kategori) ?></option>
            <?php endforeach; ?>
            </select>
    </div>

    <!-- Tampilan Karya -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <?php if (count($karya) > 0): ?>
                <?php foreach ($karya as $k): ?>
                    <div 
                        class="gallery-item bg-white border rounded-xl shadow-sm overflow-hidden p-4 cursor-pointer hover:shadow-md transition"
                        data-title="<?= strtolower(htmlspecialchars($k['judul'])) ?>"
                        data-category="<?= strtolower(htmlspecialchars($k['nama_kategori'])) ?>"
                        onclick="window.location.href='/pbl/view/karya_detail.php?id=<?= $k['id'] ?>'"
                    >
                        <?php 
                            $img_path_lain = !empty($k['gambar_proyek']) ? htmlspecialchars($k['gambar_proyek']) : 'https://via.placeholder.com/400x160?text=No+Image';                        ?>
                        <div class="w-full h-40 bg-gray-200 rounded overflow-hidden">
                            <img src="<?= $img_path_lain ?>" alt="<?= htmlspecialchars($k['judul']) ?>" class="w-full h-full object-cover">
                        </div>

                        <!-- Warna Kategori -->
                        <h3 class="font-semibold mt-3"><?= htmlspecialchars($k["judul"]) ?></h3>
                        <span class="inline-block bg-orange-500 text-white text-xs px-3 py-1 rounded mt-2">
                            <?= htmlspecialchars($k["nama_kategori"] ?? 'N/A') ?>
                        </span>

                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                 <p class="text-gray-500 col-span-full text-center">Belum ada karya yang tersedia.</p>
            <?php endif; ?>
        </div>

    </div>
</div>

<!-- Script Filter -->
<script>
    const searchInput = document.getElementById("searchInput");
    const categoryFilter = document.getElementById("categoryFilter");

    function filterGallery() {
        const searchText = searchInput.value.toLowerCase();
        const category = categoryFilter.value;
        const items = document.querySelectorAll(".gallery-item");

        items.forEach(item => {
            const title = item.getAttribute("data-title").toLowerCase();
            const cat = item.getAttribute("data-category");

            const matchSearch = title.includes(searchText);
            const matchCategory = category === "semua" || category === cat;

            if (matchSearch && matchCategory) {
                item.style.display = "block";
            } else {
                item.style.display = "none";
            }
        });
    }

    searchInput.addEventListener("input", filterGallery);
    categoryFilter.addEventListener("change", filterGallery);
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>