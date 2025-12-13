<?php
include __DIR__ . '/../layouts/header.php';
?>

<script src="https://cdn.tailwindcss.com"></script>

<style>
    /* Fade In Animation */
    .fade-card {
        opacity: 0;
        transform: translateY(30px) scale(.96);
        transition: opacity .7s ease, transform .7s cubic-bezier(.25,1,.5,1);
    }
    .fade-card.show {
        opacity: 1;
        transform: translateY(0) scale(1);
    }

    /* Hover Card */
    .gallery-item {
        transition: transform .35s ease, box-shadow .35s ease;
    }
    .gallery-item:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 18px 35px rgba(0,0,0,.15);
    }

    /* Hover Image */
    .gallery-item img {
        transition: transform .5s ease, filter .4s ease;
    }
    .gallery-item:hover img {
        transform: scale(1.12);
        filter: brightness(1.05);
    }

    /* Pagination */
    .pagination-btn {
        padding: 6px 12px;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        font-size: 14px;
        transition: all .25s ease;
    }
    .pagination-btn:hover {
        background: #f97316;
        color: white;
    }
    .pagination-btn.active {
        background: #f97316;
        color: white;
        font-weight: bold;
    }

    /* === Next / Prev Button === */
    .slide-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 18px;
        border-radius: 14px;
        font-weight: 700;
        font-size: 14px;
        transition: all .3s ease;
        border: 1px solid #e5e7eb;
    }
    .slide-btn-prev {
        background: white;
        color: #374151;
    }
    .slide-btn-prev:hover {
        background: #fff7ed;
        color: #ea580c;
        border-color: #fed7aa;
    }
    .slide-btn-next {
        background: #ea580c;
        color: white;
        border-color: #ea580c;
    }
    .slide-btn-next:hover {
        background: #c2410c;
    }
</style>

<div class="px-4 py-10 max-w-7xl mx-auto">

    <!-- ================= JUDUL ================= -->
    <section class="bg-white pt-24 pb-12 text-center fade-card">
        <div class="max-w-screen-xl mx-auto px-4">
            <span class="inline-block py-1 px-3 rounded-full bg-orange-100 text-orange-600 text-sm font-bold mb-4">
                KATALOG KARYA
            </span>
            <h1 class="font-bold text-3xl md:text-5xl mb-3">
                Galeri <span class="text-orange-500">Karya Mahasiswa</span>
            </h1>
            <p class="text-gray-500 text-lg max-w-2xl mx-auto">
                Telusuri inovasi terbaru dari mahasiswa Lab MMT
            </p>
        </div>
    </section>

    <!-- ================= FILTER ================= -->
    <div class="flex flex-wrap gap-3 justify-center items-center mb-10 fade-card">
        <input id="searchInput" type="text" placeholder="Cari judul proyek..."
            class="px-4 py-2 border rounded-lg text-sm w-60">

        <select id="categoryFilter" class="px-4 py-2 border rounded-lg text-sm">
            <option value="semua">Semua Kategori</option>
            <?php foreach ($kategori_list as $nama_kategori): ?>
                <option value="<?= strtolower($nama_kategori) ?>">
                    <?= ucwords($nama_kategori) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- ================= GALERI ================= -->
    <div id="galleryGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

        <?php if (!empty($karya)): ?>
            <?php foreach ($karya as $k): ?>
                <div
                    class="gallery-item fade-card bg-white border rounded-xl shadow-sm p-4 cursor-pointer"
                    data-title="<?= strtolower(htmlspecialchars($k['judul'])) ?>"
                    data-category="<?= strtolower(htmlspecialchars($k['nama_kategori'])) ?>"
                    onclick="window.location.href='index.php?page=detailKarya&id=<?= $k['id'] ?>'"
                >
                    <?php
                        $img = !empty($k['gambar_proyek'])
                            ? htmlspecialchars($k['gambar_proyek'])
                            : 'https://via.placeholder.com/400x160?text=No+Image';
                    ?>
                    <div class="h-40 bg-gray-200 rounded overflow-hidden">
                        <img src="<?= $img ?>" alt="<?= htmlspecialchars($k['judul']) ?>"
                             class="w-full h-full object-cover">
                    </div>

                    <h3 class="font-semibold mt-3"><?= htmlspecialchars($k['judul']) ?></h3>
                    <span class="inline-block bg-orange-500 text-white text-xs px-3 py-1 rounded mt-2">
                        <?= htmlspecialchars($k['nama_kategori'] ?? 'N/A') ?>
                    </span>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-gray-500 col-span-full text-center fade-card">
                Belum ada karya yang tersedia.
            </p>
        <?php endif; ?>

    </div>

    <!-- ================= PAGINATION ================= -->
    <div id="pagination" class="flex flex-col items-center gap-6 mt-12">
        <div class="flex items-center gap-3 bg-white p-2 rounded-2xl shadow-sm border border-gray-200">
            <button id="prevBtn" class="slide-btn slide-btn-prev">
                <i class="fas fa-arrow-left"></i> Sebelumnya
            </button>

            <div id="pageNumbers" class="hidden md:flex gap-1 px-2"></div>

            <button id="nextBtn" class="slide-btn slide-btn-next">
                Selanjutnya <i class="fas fa-arrow-right"></i>
            </button>
        </div>

        <p class="text-sm text-gray-400 font-medium bg-gray-100 px-4 py-1.5 rounded-full">
            Halaman <span id="pageInfo" class="text-orange-600 font-bold"></span>
        </p>
    </div>
</div>

<!-- ================= SCRIPT ================= -->
<script>
    const searchInput = document.getElementById("searchInput");
    const categoryFilter = document.getElementById("categoryFilter");

    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");
    const pageInfo = document.getElementById("pageInfo");
    const pageNumbers = document.getElementById("pageNumbers");

    const allItems = Array.from(document.querySelectorAll(".gallery-item"));
    const ITEMS_PER_PAGE = 9;

    let currentPage = 1;
    let filteredItems = [...allItems];

    function renderPage() {
        const start = (currentPage - 1) * ITEMS_PER_PAGE;
        const end = start + ITEMS_PER_PAGE;

        allItems.forEach(item => {
            item.style.display = "none";
            item.classList.remove("show");
        });

        filteredItems.slice(start, end).forEach((item, i) => {
            item.style.display = "block";
            setTimeout(() => item.classList.add("show"), i * 100);
        });

        updateNav();
    }

    function updateNav() {
        const totalPages = Math.ceil(filteredItems.length / ITEMS_PER_PAGE) || 1;

        pageInfo.textContent = `${currentPage} dari ${totalPages}`;

        prevBtn.disabled = currentPage === 1;
        nextBtn.disabled = currentPage === totalPages;

        prevBtn.classList.toggle("opacity-50", prevBtn.disabled);
        nextBtn.classList.toggle("opacity-50", nextBtn.disabled);

        pageNumbers.innerHTML = "";

        for (let i = 1; i <= totalPages; i++) {
            const btn = document.createElement("button");
            btn.textContent = i;
            btn.className = `
                w-10 h-10 flex items-center justify-center rounded-lg font-bold transition
                ${i === currentPage
                    ? "bg-orange-600 text-white shadow-md"
                    : "bg-gray-50 text-gray-600 hover:bg-gray-100"}
            `;
            btn.onclick = () => {
                currentPage = i;
                renderPage();
                window.scrollTo({ top: 350, behavior: "smooth" });
            };
            pageNumbers.appendChild(btn);
        }
    }

    function applyFilter() {
        const search = searchInput.value.toLowerCase();
        const category = categoryFilter.value;

        filteredItems = allItems.filter(item => {
            const title = item.dataset.title;
            const cat = item.dataset.category;
            return title.includes(search) &&
                (category === "semua" || cat === category);
        });

        currentPage = 1;
        renderPage();
    }

    prevBtn.onclick = () => {
        if (currentPage > 1) {
            currentPage--;
            renderPage();
        }
    };

    nextBtn.onclick = () => {
        const totalPages = Math.ceil(filteredItems.length / ITEMS_PER_PAGE);
        if (currentPage < totalPages) {
            currentPage++;
            renderPage();
        }
    };

    searchInput.addEventListener("input", applyFilter);
    categoryFilter.addEventListener("change", applyFilter);

    /* Scroll animation */
    const observer = new IntersectionObserver(entries => {
        entries.forEach(e => e.isIntersecting && e.target.classList.add("show"));
    }, { threshold: 0.15 });

    document.querySelectorAll(".fade-card").forEach(el => observer.observe(el));

    // INIT
    renderPage();
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>