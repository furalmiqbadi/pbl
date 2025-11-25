<?php 
include '../layouts/header.php';

// Dummy karya
$karya = [
    ["judul" => "Aplikasi Smart Kampus", "kategori" => "mobile Dev"],
    ["judul" => "Aplikasi Smart Kampus", "kategori" => "mobile Dev"],
    ["judul" => "Aplikasi Smart Kampus", "kategori" => "mobile Dev"],
    ["judul" => "Aplikasi Smart Kampus", "kategori" => "uiux"],
    ["judul" => "Aplikasi Smart Kampus", "kategori" => "web"],
    ["judul" => "Aplikasi Smart Kampus", "kategori" => "iot"],
];
?>

<!-- Tailwind CDN -->
<script src="https://cdn.tailwindcss.com"></script>

<div class="px-4 py-10 max-w-7xl mx-auto">

    <!-- Judul -->
    <h1 class="text-3xl font-bold text-center">Galeri Karya Mahasiswa</h1>
    <p class="text-sm text-gray-500 text-center mb-8">
        Telusuri inovasi terbaru dari mahasiswa Lab MMT
    </p>

        <!-- Filter -->
        <div class="flex flex-wrap gap-3 justify-center items-center mb-10">
            <input id="searchInput" type="text" placeholder="Cari judul proyek..." 
            class="px-4 py-2 border rounded-lg text-sm w-60">

            <select id="categoryFilter" 
                class="px-4 py-2 border rounded-lg text-sm">
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
            <div 
                class="gallery-item bg-white border rounded-xl shadow-sm overflow-hidden cursor-pointer hover:shadow-md transition"
                data-category="<?= $k["kategori"] ?>"
                data-title="<?= strtolower($k["judul"]) ?>"
                onclick="window.location.href='detailKarya.php'"
            >
                <!-- Thumbnail -->
                <div class="w-full h-44 bg-gray-200"></div>

                <!-- Content -->
                <div class="p-4">
                    <h3 class="text-lg font-semibold"><?= $k["judul"] ?></h3>

                    <!-- Badge kategori -->
                    <?php 
                        $color = [
                            "mobile Dev" => "bg-orange-500",
                            "web" => "bg-blue-500",
                            "uiux" => "bg-purple-500",
                            "iot" => "bg-green-600"
                        ][$k["kategori"]];
                    ?>

                    <span class="text-xs text-white px-3 py-1 rounded mt-2 inline-block <?= $color ?>">
                        <?= strtoupper($k["kategori"]) ?>
                    </span>
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

            if(matchSearch && matchCategory){
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