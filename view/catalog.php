<?php include '../layouts/header.php'; ?>
<?php include '../layouts/sidebar.php'; ?>

<!-- Tailwind CDN -->
<script src="https://cdn.tailwindcss.com"></script>

<div class="p-6 sm:ml-64 mt-14">
    <section class="max-w-7xl mx-auto">

        <h1 class="text-2xl font-bold text-center">Galeri Karya Mahasiswa</h1>
        <p class="text-sm text-gray-500 text-center mb-6">Telusuri inovasi terbaru dari mahasiswa Lab MMT</p>

        <!-- Filter -->
        <div class="flex flex-wrap gap-3 justify-center items-center mb-6">
            <input id="searchInput" type="text" placeholder="Cari judul proyek..." 
            class="px-3 py-2 border rounded-lg text-sm w-60">

            <select id="categoryFilter" class="px-3 py-2 border rounded-lg text-sm">
                <option value="semua">Kategori: Semua</option>
                <option value="mobile">Mobile Dev</option>
                <option value="web">Web Dev</option>
                <option value="uiux">UI/UX</option>
                <option value="iot">IoT</option>
            </select>
        </div>

        <!-- Galeri Grid -->
        <div id="galleryContainer" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            
            <!-- Card -->
            <div class="gallery-item border rounded-lg shadow-sm p-3" data-category="mobile" data-title="Aplikasi Smart Kampus">
                <div class="bg-gray-300 h-40 rounded-lg"></div>
                <h3 class="mt-2 text-sm font-semibold">Aplikasi Smart Kampus</h3>
                <span class="text-xs bg-orange-500 text-white px-2 py-1 rounded">Mobile Dev</span>
            </div>

            <div class="gallery-item border rounded-lg shadow-sm p-3" data-category="web" data-title="Sistem Akademik Online">
                <div class="bg-gray-300 h-40 rounded-lg"></div>
                <h3 class="mt-2 text-sm font-semibold">Sistem Akademik Online</h3>
                <span class="text-xs bg-blue-500 text-white px-2 py-1 rounded">Web Dev</span>
            </div>

            <div class="gallery-item border rounded-lg shadow-sm p-3" data-category="uiux" data-title="UI Aplikasi Edukasi">
                <div class="bg-gray-300 h-40 rounded-lg"></div>
                <h3 class="mt-2 text-sm font-semibold">UI Aplikasi Edukasi</h3>
                <span class="text-xs bg-purple-500 text-white px-2 py-1 rounded">UI/UX</span>
            </div>

            <div class="gallery-item border rounded-lg shadow-sm p-3" data-category="iot" data-title="Sistem Sensor Keamanan">
                <div class="bg-gray-300 h-40 rounded-lg"></div>
                <h3 class="mt-2 text-sm font-semibold">Sistem Sensor Keamanan</h3>
                <span class="text-xs bg-green-600 text-white px-2 py-1 rounded">IoT</span>
            </div>

            <div class="gallery-item border rounded-lg shadow-sm p-3" data-category="mobile" data-title="Aplikasi Absensi Mahasiswa">
                <div class="bg-gray-300 h-40 rounded-lg"></div>
                <h3 class="mt-2 text-sm font-semibold">Aplikasi Absensi Mahasiswa</h3>
                <span class="text-xs bg-orange-500 text-white px-2 py-1 rounded">Mobile Dev</span>
            </div>

            <div class="gallery-item border rounded-lg shadow-sm p-3" data-category="web" data-title="Website Pendaftaran Kegiatan">
                <div class="bg-gray-300 h-40 rounded-lg"></div>
                <h3 class="mt-2 text-sm font-semibold">Website Pendaftaran Kegiatan</h3>
                <span class="text-xs bg-blue-500 text-white px-2 py-1 rounded">Web Dev</span>
            </div>

        </div>
        
    </section>
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