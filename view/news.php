<?php include '../layouts/header.php'; ?>

<!-- Tailwind CDN -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- 1. HERO SECTION -->
<section class="bg-white pt-24 pb-12 text-center">
    <div class="max-w-screen-md mx-auto px-4">
        <h1 class="font-heading font-bold text-3xl md:text-4xl text-brand-dark mb-2">
            Artikel & Berita Terkini
        </h1>
        <p class="font-sans text-gray-500 text-sm md:text-base">
            Ikuti kegiatan terbaru, prestasi mahasiswa, dan wawasan <br class="hidden md:block"> teknologi dari Lab MMT
        </p>
    </div>
</section>

<!-- 2. SEARCH & FILTER BAR (Form GET ke index.php?page=news) -->
<section class="bg-white pb-10 relative z-20">
    <div class="max-w-screen-xl mx-auto px-4">

        <form action="index.php" method="GET" class="flex flex-col md:flex-row gap-4 max-w-4xl mx-auto">
            <!-- Hidden Input agar tetap di halaman news -->
            <input type="hidden" name="page" value="news">

            <!-- Input Pencarian -->
            <div class="relative flex-grow">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" name="search"
                    value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                    class="block w-full pl-10 p-3 text-sm text-gray-900 bg-white border border-gray-200 rounded-lg focus:ring-brand-orange focus:border-brand-orange shadow-sm outline-none transition-all"
                    placeholder="Cari judul berita...">
            </div>

            <!-- Dropdown Kategori -->
            <div class="relative min-w-[180px]">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="text-gray-400 text-xs font-medium capitalize tracking-wide">Kategori:</span>
                </div>

                <select name="category" onchange="this.form.submit()"
                    class="block w-full pl-20 p-3 text-sm text-brand-dark font-semibold bg-white border border-gray-200 rounded-lg focus:ring-brand-orange focus:border-brand-orange shadow-sm cursor-pointer appearance-none outline-none transition-all">
                    <option value="semua">Semua</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo $cat['nama_kategori']; ?>" <?php echo (isset($_GET['category']) && $_GET['category'] == $cat['nama_kategori']) ? 'selected' : ''; ?>>
                            <?php echo $cat['nama_kategori']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <!-- Custom Arrow Icon -->
                <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-gray-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
            </div>
        </form>

    </div>
</section>

<!-- 3. FEATURED POST (Artikel Terbaru) -->
<?php if (!empty($featuredNews) && !isset($_GET['search'])): // Hanya tampil jika tidak sedang mencari ?>
    <section class="bg-white pb-12">
        <div class="max-w-screen-xl mx-auto px-4">

            <div
                class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden p-6 md:p-8 hover:shadow-md transition-shadow duration-300">
                <div class="flex flex-col lg:flex-row gap-8 items-center">

                    <!-- Gambar -->
                    <div class="w-full lg:w-1/2 h-64 lg:h-80 rounded-xl overflow-hidden bg-gray-100 relative group">
                        <img src="<?php echo !empty($featuredNews['gambar_berita']) ? $featuredNews['gambar_berita'] : 'https://placehold.co/800x500?text=No+Image'; ?>"
                            class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                    </div>

                    <!-- Konten Teks -->
                    <div class="w-full lg:w-1/2 flex flex-col items-start text-left">
                        <div
                            class="text-xs font-bold text-brand-orange mb-3 uppercase tracking-wider flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-brand-orange animate-pulse"></span>
                            Terbaru • <?php echo date('d M Y', strtotime($featuredNews['created_at'])); ?>
                        </div>

                        <h2
                            class="font-heading font-bold text-2xl md:text-3xl text-brand-dark mb-4 leading-tight hover:text-brand-orange transition-colors cursor-pointer">
                            <a href="#"><?php echo $featuredNews['judul']; ?></a>
                        </h2>

                        <p class="text-gray-500 text-sm leading-relaxed mb-6 line-clamp-3">
                            <?php echo substr(strip_tags($featuredNews['isi_berita']), 0, 150) . '...'; ?>
                        </p>

                        <a href="#"
                            class="inline-flex items-center justify-center bg-brand-orange hover:bg-orange-600 text-white text-sm font-semibold py-3 px-6 rounded-lg transition-all shadow-md shadow-orange-200 transform hover:-translate-y-0.5">
                            Lihat Selengkapnya
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </section>
<?php endif; ?>

<!-- 4. GRID ARTIKEL LAINNYA -->
<section class="bg-white pb-24">
    <div class="max-w-screen-xl mx-auto px-4">

        <?php if (empty($newsList)): ?>
            <div class="text-center py-10">
                <p class="text-gray-500 text-lg">Belum ada berita yang ditemukan.</p>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <?php foreach ($newsList as $news): ?>
                    <!-- Kartu Artikel -->
                    <article
                        class="flex flex-col h-full bg-white border border-gray-100 rounded-2xl p-5 shadow-sm hover:shadow-lg transition-all duration-300 group">
                        <!-- Gambar -->
                        <div class="h-48 rounded-xl overflow-hidden bg-gray-100 mb-4 relative">
                            <img src="<?php echo !empty($news['gambar_berita']) ? $news['gambar_berita'] : 'https://placehold.co/600x400?text=No+Image'; ?>"
                                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                            <!-- Badge Kategori -->
                            <span
                                class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-brand-dark text-[10px] font-bold px-2 py-1 rounded shadow-sm">
                                <?php echo $news['nama_kategori'] ?? 'Umum'; ?>
                            </span>
                        </div>
                        <!-- Konten -->
                        <div class="flex flex-col flex-grow">
                            <h3
                                class="font-heading font-bold text-lg text-brand-dark mb-2 group-hover:text-brand-orange transition-colors line-clamp-2">
                                <a href="#"><?php echo $news['judul']; ?></a>
                            </h3>
                            <div class="text-xs font-medium text-gray-400 mb-3 flex items-center gap-1">
                                <i class="ph ph-calendar-blank"></i>
                                <?php echo date('d M Y', strtotime($news['created_at'])); ?>
                            </div>
                            <p class="text-gray-500 text-sm line-clamp-3 mb-4 flex-grow">
                                <?php echo substr(strip_tags($news['isi_berita']), 0, 100) . '...'; ?>
                            </p>
                            <a href="#"
                                class="inline-block w-full text-center bg-brand-orange hover:bg-orange-600 text-white text-xs font-semibold py-3 px-4 rounded-lg transition-colors mt-auto">
                                Lihat Selengkapnya →
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>

            </div>
        <?php endif; ?>

    </div>
</section>

<?php include '../layouts/footer.php'; ?>