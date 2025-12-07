<main class="max-w-6xl mx-auto px-4 pt-14 pb-12 space-y-16">
    <!-- Bagian Hero / Pembuka -->
    <section class="relative grid md:grid-cols-2 gap-12 items-center py-8">
        <!-- Dekorasi background -->
        <div class="absolute inset-0 -z-10 pointer-events-none">
            <!-- Titik-titik kanan atas -->
            <div class="absolute top-10 right-20 grid grid-cols-3 gap-3 opacity-20 scale-in delay-500">
                <div class="w-2 h-2 rounded-full bg-orange-400"></div>
                <div class="w-2 h-2 rounded-full bg-orange-500"></div>
                <div class="w-2 h-2 rounded-full bg-orange-400"></div>
                <div class="w-2 h-2 rounded-full bg-orange-500"></div>
                <div class="w-2 h-2 rounded-full bg-orange-400"></div>
                <div class="w-2 h-2 rounded-full bg-orange-500"></div>
                <div class="w-2 h-2 rounded-full bg-orange-400"></div>
                <div class="w-2 h-2 rounded-full bg-orange-500"></div>
                <div class="w-2 h-2 rounded-full bg-orange-400"></div>
            </div>
            
            <!-- Lingkaran kiri bawah -->
            <div class="absolute bottom-20 left-10 w-32 h-32 border-2 border-orange-200 rounded-full opacity-30 scale-in delay-400"></div>
            <div class="absolute bottom-28 left-18 w-16 h-16 border-2 border-orange-300 rounded-full opacity-40 scale-in delay-600"></div>
            
            <!-- Garis aksen kiri atas -->
            <div class="absolute top-32 left-10 w-20 h-1 bg-gradient-to-r from-orange-400 to-transparent opacity-30 slide-in-left delay-300"></div>
            <div class="absolute top-40 left-10 w-16 h-1 bg-gradient-to-r from-orange-300 to-transparent opacity-20 slide-in-left delay-400"></div>
            
            <!-- Titik-titik kanan tengah -->
            <div class="absolute top-1/2 right-10 flex flex-col gap-4 opacity-20 slide-in-right delay-500">
                <div class="w-3 h-3 rounded-full bg-orange-400"></div>
                <div class="w-2 h-2 rounded-full bg-orange-500"></div>
                <div class="w-3 h-3 rounded-full bg-orange-400"></div>
            </div>
            
            <!-- Lingkaran kecil kanan bawah -->
            <div class="absolute bottom-10 right-32 w-20 h-20 border border-orange-200 rounded-full opacity-25 scale-in delay-600"></div>
        </div>

        <!-- Konten teks hero (animasi masuk dari kiri) -->
        <div class="space-y-4 slide-in-left">
            <!-- Badge selamat datang dengan dot berkedip -->
            <span
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#feedd8] text-orange-700 font-semibold text-sm shadow-sm border border-orange-200 hover:shadow-md hover:scale-105 transition-all duration-300">
                <!-- Dot merah berkedip -->
                <span class="h-2 w-2 rounded-full bg-orange-500 animate-pulse"></span>
                Selamat Datang di
            </span>
            <!-- Judul Utama -->
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight text-gray-900">
                <?php echo h($hero['title'] ?? 'Lab Multimedia'); ?>
            </h1>
            <p class="text-gray-600 max-w-xl"><?php echo h($hero['subtitle'] ?? ''); ?></p>

            <!-- Button CTA (zoom saat hover) -->
            <a href="index.php?page=about"
                class="inline-flex items-center gap-2 bg-orange-500 text-white px-6 py-3 rounded-lg font-semibold smooth hover:bg-orange-600 shadow-md hover:shadow-xl hover:scale-105 transition-all duration-300 group">
                <?php echo h($hero['cta'] ?? 'Kenali Kami'); ?>
                <!-- Arrow bergerak ke kanan saat hover -->
                <span class="text-xl leading-none group-hover:translate-x-1 transition-transform duration-300">&rarr;</span>
            </a>
        </div>
        
        <!-- Logo/Maskot Hero (animasi masuk dari kanan, naik-turun) -->
        <div class="flex justify-center slide-in-right delay-200">
            <img src="<?php echo h($hero['image'] ?? 'assets/images/mmtLogo.png'); ?>" alt="Hero"
                class="parallax w-96 h-96 md:w-[540px] md:h-[540px] object-contain drop-shadow-[0_25px_45px_rgba(0,0,0,0.08)] animate-float" id="hero-logo">
        </div>
    </section>

    <!-- Bagian Fokus Utama (Game, UI/UX, AR/VR) -->
    <section class="relative space-y-12 scroll-reveal">
        <div class="text-center space-y-4">
            <span
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-gradient-to-r from-orange-50 to-pink-50 text-orange-700 font-semibold text-sm shadow-lg border border-orange-200/50 backdrop-blur-sm hover:shadow-xl transition-all duration-300">
                <span class="h-2 w-2 rounded-full bg-orange-500 animate-pulse"></span>
                Apa yang kami dalami
            </span>
            <h2 class="text-4xl font-bold bg-gradient-to-r from-gray-800 to-orange-600 bg-clip-text text-transparent">Fokus Utama Kami</h2>
            <p class="text-gray-600 text-lg">Game, UI/UX, dan AR/VR yang saling melengkapi.</p>
        </div>
        <div class="grid md:grid-cols-3 gap-8 items-stretch pt-6">
            <?php
            $fokusItems = [
                [
                    'title' => 'Game Development',
                    //'text' => 'Menciptakan pengalaman interaktif dan mendalam melalui pengembangan game lintas platform.',
                    'image' => 'https://asset.kompas.com/crops/axklqfTkw8vxDlOxmkxk7fO_K5k=/0x0:780x520/750x500/data/photo/2021/02/25/6037b83b20b08.jpg'
                ],
                [
                    'title' => 'UI/UX Design',
                    //'text' => 'Merancang antarmuka yang intuitif dan menarik.',
                    'image' => 'https://zegen.id/compro/wp-content/uploads/2023/02/Frame-44-5.jpg'
                ],
                [
                    'title' => 'AR/VR',
                    //'text' => 'Mengembangkan pengalaman imersif dengan teknologi AR dan VR.',
                    'image' => 'https://tse2.mm.bing.net/th/id/OIP.uJaJsfyJtgJLQRJ6A21fxgHaE8?pid=Api&P=0&h=180'
                ],
            ]
            ?>
            <?php foreach ($fokusItems as $index => $fokus): ?>
                <!-- Card fokus (naik saat hover, animasi muncul dengan zoom) -->
                <div
                    class="group relative bg-white/80 backdrop-blur-sm rounded-3xl p-8 pt-16 flex flex-col items-center text-center h-full border border-gray-200/50 shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:shadow-[0_20px_60px_rgb(251,146,60,0.25)] transition-all duration-500 hover:-translate-y-2 scale-in delay-<?php echo ($index + 1) * 100; ?>">
                    <!-- Gradient muncul saat hover -->
                    <div class="absolute inset-0 bg-gradient-to-br from-orange-50/50 via-transparent to-pink-50/30 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    
                    <!-- Icon di atas card (zoom & rotasi saat hover) -->
                    <div
                        class="absolute -top-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl w-20 h-20 flex items-center justify-center shadow-xl overflow-hidden group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                        <?php if (!empty($fokus['image'])): ?>
                            <img src="<?php echo h($fokus['image']); ?>" alt="<?php echo h($fokus['title'] ?? ''); ?>"
                                class="w-full h-full object-cover">
                        <?php else: ?>
                            <span class="text-2xl text-white drop-shadow-lg">★</span>
                        <?php endif; ?>
                        <div class="absolute inset-0 bg-gradient-to-t from-orange-600/30 to-transparent"></div>
                    </div>
                    <h3 class="relative text-xl font-bold mb-3 mt-2 bg-gradient-to-r from-gray-800 to-orange-600 bg-clip-text text-transparent"><?php echo h($fokus['title'] ?? ''); ?></h3>
                    <p class="relative text-gray-600 text-sm leading-relaxed"><?php echo h($fokus['text'] ?? ''); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Bagian Galeri -->
    <!-- Galeri dengan scroll otomatis -->
    <section class="relative space-y-6 scroll-reveal delay-100">
        <div class="text-center space-y-3">
            <span
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-gradient-to-r from-orange-50 to-pink-50 text-orange-700 font-semibold text-sm shadow-lg border border-orange-200/50 backdrop-blur-sm hover:shadow-xl transition-all duration-300">
                <span class="h-2 w-2 rounded-full bg-orange-500 animate-pulse"></span>
                Tangkap Momen
            </span>
            <h2 class="text-4xl font-bold bg-gradient-to-r from-gray-800 to-orange-600 bg-clip-text text-transparent">Galeri</h2>
            <p class="text-gray-600 text-lg">Cuplikan karya, eksperimen, dan aktivitas terbaru.</p>
        </div>
        <!-- Container galeri 2 baris -->
        <div class="space-y-4">
            <!-- Baris 1: scroll ke kanan -->
            <div class="gallery-row rounded-3xl border border-orange-200/40 bg-gradient-to-r from-white/90 via-orange-50/30 to-white/90 backdrop-blur-md shadow-lg"
                id="gallery-row-top">
                <div id="gallery-track-top" class="gallery-track"></div>
            </div>
            <!-- Baris 2: scroll ke kiri -->
            <div class="gallery-row rounded-3xl border border-orange-200/40 bg-gradient-to-r from-white/90 via-pink-50/30 to-white/90 backdrop-blur-md shadow-lg"
                id="gallery-row-bottom">
                <div id="gallery-track-bottom" class="gallery-track"></div>
            </div>
        </div>
        <!-- Button lihat selengkapnya -->
        <div class="text-center">
            <a href="index.php?page=gallery"
                class="inline-flex items-center gap-2 bg-gradient-to-r from-orange-500 to-orange-600 text-white px-8 py-4 rounded-xl font-semibold hover:from-orange-600 hover:to-orange-700 shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-300 group">
                Lihat Selengkapnya
                <!-- Arrow bergerak saat hover -->
                <span class="text-xl leading-none group-hover:translate-x-1 transition-transform duration-300">&rarr;</span>
            </a>
        </div>
    </section>

    <!-- Bagian Karya Unggulan -->
    <section class="space-y-6 scroll-reveal delay-200">
        <?php
        $categories = ['Semua'];
        foreach ($karyaItems as $item) {
            $cat = $item['category'] ?? 'Lainnya';
            if (!in_array($cat, $categories, true)) {
                $categories[] = $cat;
            }
        }
        ?>
        <div class="space-y-4 text-center">
            <div class="flex items-center justify-center">
                <span
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-gradient-to-r from-orange-50 to-pink-50 text-orange-700 font-semibold text-sm shadow-lg border border-orange-200/50 backdrop-blur-sm hover:shadow-xl transition-all duration-300">
                    <span class="h-2 w-2 rounded-full bg-orange-500 animate-pulse"></span>
                    Karya Unggulan
                </span>
            </div>
            <h2 class="text-4xl font-bold bg-gradient-to-r from-gray-800 to-orange-600 bg-clip-text text-transparent">Karya Unggulan Kami</h2>
            <p class="text-gray-600 text-lg">Pilihan project terbaik dari Game, UI/UX, dan AR/VR.</p>
            <!-- Tombol filter kategori (zoom saat hover) -->
            <div class="flex flex-wrap gap-3 justify-center">
                <?php foreach ($categories as $index => $cat): ?>
                    <button data-filter="<?php echo h($cat); ?>"
                        class="karya-filter px-6 py-2.5 rounded-full text-sm font-semibold border-2 transition-all duration-300 hover:scale-105 <?php echo $index === 0 ? 'bg-orange-500 text-white border-orange-500 shadow-md' : 'bg-white text-orange-600 border-orange-500 hover:bg-orange-500 hover:text-white hover:shadow-md'; ?>">
                        <?php echo h($cat); ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Grid karya unggulan -->
        <div class="grid md:grid-cols-3 gap-6" id="karya-grid">
            <?php foreach (array_slice($karyaItems, 0, 3) as $karya): ?>
                <?php
                $karyaLink = 'index.php?page=detailKarya';
                if (!empty($karya['id'])) {
                    $karyaLink .= '&id=' . urlencode((string) $karya['id']);
                }
                ?>
                <!-- Card karya (naik saat hover) -->
                <a href="<?php echo h($karyaLink); ?>"
                    class="group block bg-white rounded-2xl shadow-[0_12px_35px_-18px_rgba(15,23,42,0.35)] overflow-hidden border border-slate-200/70 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                    <!-- Gambar karya -->
                    <div class="w-full h-44 bg-gray-200 overflow-hidden">
                        <?php if (!empty($karya['image'])): ?>
                            <!-- group-hover = zoom gambar saat hover -->
                            <img src="<?php echo h($karya['image']); ?>" alt="<?php echo h($karya['title'] ?? ''); ?>"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <?php endif; ?>
                    </div>
                    <div class="p-4 space-y-2">
                        <span
                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#feedd8] text-orange-700 text-xs font-semibold border border-orange-200">
                            <span class="h-2 w-2 rounded-full bg-orange-500"></span>
                            <?php echo h($karya['category'] ?? ''); ?>
                        </span>
                        <h3 class="text-lg font-semibold text-gray-800 group-hover:text-orange-600 transition-colors"><?php echo h($karya['title'] ?? ''); ?></h3>
                        <p class="text-sm text-gray-500 line-clamp-2"><?php echo h($karya['excerpt'] ?? 'Detail singkat akan tampil di sini.'); ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        <div class="text-center">
            <a href="index.php?page=catalog"
                class="inline-flex items-center gap-2 bg-gradient-to-r from-orange-500 to-orange-600 text-white px-8 py-4 rounded-xl font-semibold hover:from-orange-600 hover:to-orange-700 shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-300 group">
                Lihat Selengkapnya
                <span class="text-xl leading-none group-hover:translate-x-1 transition-transform duration-300">&rarr;</span>
            </a>
        </div>

    </section>

    <!-- Bagian Artikel & Berita -->
    <section class="relative space-y-6 scroll-reveal delay-300">
        <div class="text-center space-y-4">
            <span
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-gradient-to-r from-orange-50 to-pink-50 text-orange-700 font-semibold text-sm shadow-lg border border-orange-200/50 backdrop-blur-sm hover:shadow-xl transition-all duration-300">
                <span class="h-2 w-2 rounded-full bg-orange-500 animate-pulse"></span>
                Cerita Kami
            </span>
            <h2 class="text-4xl font-bold bg-gradient-to-r from-gray-800 to-orange-600 bg-clip-text text-transparent">Artikel & Berita</h2>
            <p class="text-gray-600 text-lg">Update terbaru dari Lab Multimedia</p>
            <div class="flex flex-wrap gap-3 justify-center">
                <?php foreach ($newsCategories as $index => $newsCat): ?>
                    <button data-filter-news="<?php echo h($newsCat); ?>"
                        class="news-filter px-6 py-2.5 rounded-full text-sm font-semibold border-2 transition-all duration-300 hover:scale-105 <?php echo $index === 0 ? 'bg-orange-500 text-white border-orange-500 shadow-md' : 'bg-white text-orange-600 border-orange-500 hover:bg-orange-500 hover:text-white hover:shadow-md'; ?>">
                        <?php echo h($newsCat); ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- Grid artikel & berita -->
        <div class="grid md:grid-cols-3 gap-6" id="news-grid">
            <?php foreach ($artikelItems as $artikel): ?>
                <?php
                $artikelLink = 'index.php?page=news_detail';
                if (!empty($artikel['id'])) {
                    $artikelLink .= '&id=' . urlencode((string) $artikel['id']);
                }
                ?>
                <!-- Card artikel (naik saat hover) -->
                <a href="<?php echo h($artikelLink); ?>"
                    class="group block bg-white rounded-2xl shadow-[0_12px_35px_-18px_rgba(15,23,42,0.35)] overflow-hidden border border-slate-200/70 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                    <?php if (!empty($artikel['image'])): ?>
                        <!-- Gambar artikel -->
                        <div class="w-full h-44 bg-gray-200 overflow-hidden">
                            <!-- group-hover = zoom gambar saat hover -->
                            <img src="<?php echo h($artikel['image']); ?>" alt="<?php echo h($artikel['title'] ?? ''); ?>"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                    <?php else: ?>
                        <div class="w-full h-44 bg-gray-200"></div>
                    <?php endif; ?>
                    <div class="p-4 space-y-2">
                        <!-- Badge kategori berita (mirip dengan karya) -->
                        <?php if (!empty($artikel['category'])): ?>
                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#feedd8] text-orange-700 text-xs font-semibold border border-orange-200">
                                <span class="h-2 w-2 rounded-full bg-orange-500"></span>
                                <?php echo h($artikel['category']); ?>
                            </span>
                        <?php endif; ?>
                        <h3 class="text-lg font-semibold text-gray-800 group-hover:text-orange-600 transition-colors"><?php echo h($artikel['title'] ?? ''); ?></h3>
                        <p class="text-sm text-gray-500 line-clamp-2"><?php echo h($artikel['excerpt'] ?? 'Detail singkat akan tampil di sini.'); ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        <div class="text-center">
            <a href="index.php?page=news"
                class="inline-flex items-center gap-2 bg-gradient-to-r from-orange-500 to-orange-600 text-white px-8 py-4 rounded-xl font-semibold hover:from-orange-600 hover:to-orange-700 shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-300 group">
                Lihat Selengkapnya
                <span class="text-xl leading-none group-hover:translate-x-1 transition-transform duration-300">&rarr;</span>
            </a>
        </div>
    </section>
</main>
