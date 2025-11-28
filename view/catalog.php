<?php
include '../layouts/header.php';
include '../lib/Connection.php';

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

<!-- Tailwind CDN -->
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

        <select id="categoryFilter" class="px-4 py-2 border rounded-lg text-sm">
            <option value="semua">Kategori: Semua</option>
            <option value="mobile dev">Mobile Dev</option>
            <option value="web">Web Dev</option>
            <option value="uiux">UI/UX</option>
            <option value="iot">IoT</option>
        </select>
    </div>

    <!-- Galeri Grid -->
    <div id="galleryContainer" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">

        <!-- Card -->
        <?php foreach ($karya as $k): ?>
            <div class="gallery-item bg-white border rounded-xl shadow-sm overflow-hidden cursor-pointer hover:shadow-md transition"
                data-category="<?= $k["kategori"] ?>" data-title="<?= strtolower($k["judul"]) ?>"
                onclick="window.location.href='detailKarya.php'">
                <!-- Thumbnail -->
                <div class="w-full h-44 bg-gray-200"></div>

                    <!-- Content -->
                    <div class="p-4">
                        <h3 class="text-lg font-semibold"><?= htmlspecialchars($k["judul"]) ?></h3>

                    <!-- Badge kategori -->
                    <?php
                    $color = [
                        "mobile dev" => "bg-orange-500",
                        "web" => "bg-blue-500",
                        "uiux" => "bg-purple-500",
                        "iot" => "bg-green-600"
                    ][$k["kategori"]];
                    ?>

                        <span class="text-xs text-white px-3 py-1 rounded mt-2 inline-block <?= $color ?>">
                            <?= strtoupper($kategori_display) ?>
                        </span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>

<!-- Script Filter -->
<script>
    const searchInput = document.getElementById("searchInput");
    const categoryFilter = document.getElementById("categoryFilter");
    const items = document.querySelectorAll(".gallery-item");

    function filterGallery() {
        const searchText = searchInput.value.toLowerCase();
        const category = categoryFilter.value;

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

<?php include '../layouts/footer.php'; ?>