<main class="max-w-6xl mx-auto px-4 pt-14 pb-12 space-y-16">
    <!-- ========== HERO SECTION ========== -->
    <!-- Section utama halaman dengan grid 2 kolom (teks & gambar) -->
    <section class="relative grid md:grid-cols-2 gap-12 items-center py-8">
        <!-- Elemen Dekoratif Elegan (background) -->
        <!-- pointer-events-none agar tidak mengganggu klik -->
        <!-- opacity rendah (15-40%) untuk efek subtle -->
        <div class="absolute inset-0 -z-10 pointer-events-none">
            <!-- Top Right Dots Pattern -->
            <div class="absolute top-10 right-20 grid grid-cols-3 gap-3 opacity-20">
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
            
            <!-- Bottom Left Circle -->
            <div class="absolute bottom-20 left-10 w-32 h-32 border-2 border-orange-200 rounded-full opacity-30"></div>
            <div class="absolute bottom-28 left-18 w-16 h-16 border-2 border-orange-300 rounded-full opacity-40"></div>
            
            <!-- Top Left Accent Line -->
            <div class="absolute top-32 left-10 w-20 h-1 bg-gradient-to-r from-orange-400 to-transparent opacity-30"></div>
            <div class="absolute top-40 left-10 w-16 h-1 bg-gradient-to-r from-orange-300 to-transparent opacity-20"></div>
            
            <!-- Right Side Dots -->
            <div class="absolute top-1/2 right-10 flex flex-col gap-4 opacity-20">
                <div class="w-3 h-3 rounded-full bg-orange-400"></div>
                <div class="w-2 h-2 rounded-full bg-orange-500"></div>
                <div class="w-3 h-3 rounded-full bg-orange-400"></div>
            </div>
            
            <!-- Bottom Right Small Circles -->
            <div class="absolute bottom-10 right-32 w-20 h-20 border border-orange-200 rounded-full opacity-25"></div>
        </div>

        <!-- Konten Hero: Teks & CTA Button -->
        <div class="space-y-4">
            <!-- Badge "Selamat Datang" dengan gradient background -->
            <!-- hover:scale-105 = zoom 105% saat hover -->
            <!-- animate-pulse pada dot merah untuk efek berkedip -->
            <span
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#feedd8] text-orange-700 font-semibold text-sm shadow-sm border border-orange-200">
                <span class="h-2 w-2 rounded-full bg-orange-500 animate-pulse"></span>
                Selamat Datang di
            </span>
            <!-- Judul Utama -->
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight text-gray-900">
                <?php echo h($hero['title'] ?? 'Lab Multimedia'); ?>
            </h1>
            <p class="text-gray-600 max-w-xl"><?php echo h($hero['subtitle'] ?? ''); ?></p>

            <!-- CTA Button -->
            <a href="index.php?page=about"
                class="inline-flex items-center gap-2 bg-orange-500 text-white px-6 py-3 rounded-lg font-semibold smooth hover:bg-orange-600 shadow-md">
                <?php echo h($hero['cta'] ?? 'Kenali Kami'); ?>
                <span class="text-xl leading-none">&rarr;</span>
            </a>
        </div>
        
        <!-- Logo/Maskot Hero dengan animasi float (naik-turun) -->
        <div class="flex justify-center">
            <img src="<?php echo h($hero['image'] ?? 'assets/images/mmtLogo.png'); ?>" alt="Hero"
                class="w-96 h-96 md:w-[540px] md:h-[540px] object-contain drop-shadow-[0_25px_45px_rgba(0,0,0,0.08)] animate-float">
        </div>
    </section>

    <!-- ========== SECTION FOKUS UTAMA ========== -->
    <!-- Menampilkan 3 fokus utama: Game, UI/UX, AR/VR -->
    <section class="relative space-y-10 scroll-reveal">
        <div class="text-center space-y-3">
            <span
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-gradient-to-r from-orange-50 to-pink-50 text-orange-700 font-semibold text-sm shadow-lg border border-orange-200/50 backdrop-blur-sm hover:shadow-xl transition-all duration-300">
                <span class="h-2 w-2 rounded-full bg-orange-500 animate-pulse"></span>
                Apa yang kami dalami
            </span>
            <h2 class="text-4xl font-bold bg-gradient-to-r from-gray-800 to-orange-600 bg-clip-text text-transparent">Fokus Utama Kami</h2>
            <p class="text-gray-600 text-lg">Game, UI/UX, dan AR/VR yang saling melengkapi.</p>
        </div>
        <div class="grid md:grid-cols-3 gap-6 items-stretch">
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
            <?php foreach ($fokusItems as $fokus): ?>
                <div
                    class="group relative bg-white/80 backdrop-blur-sm rounded-3xl p-8 pt-16 flex flex-col items-center text-center h-full border border-gray-200/50 shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:shadow-[0_20px_60px_rgb(251,146,60,0.25)] transition-all duration-500 hover:-translate-y-2" style="animation-delay: <?php echo $index * 100; ?>ms">
                    <!-- Background gradient yang muncul saat hover -->
                    <div class="absolute inset-0 bg-gradient-to-br from-orange-50/50 via-transparent to-pink-50/30 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <!-- Icon container di atas card (posisi absolute -top-10) -->
                    <!-- group-hover:scale-110 = zoom 110% saat hover -->
                    <!-- group-hover:rotate-6 = rotasi 6 derajat saat hover -->
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

    <!-- ========== SECTION GALERI ========== -->
    <!-- Galeri dengan marquee animation (scroll otomatis) -->
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
        <!-- Container untuk 2 baris gallery -->
        <!-- Baris 1: scroll ke kanan, Baris 2: scroll ke kiri -->
        <!-- Hover untuk pause animation, Klik gambar untuk buka lightbox -->
        <div class="space-y-4">
            <div class="gallery-row rounded-3xl border border-orange-200/40 bg-gradient-to-r from-white/90 via-orange-50/30 to-white/90 backdrop-blur-md shadow-lg"
                id="gallery-row-top">
                <div id="gallery-track-top" class="gallery-track"></div>
            </div>
            <div class="gallery-row rounded-3xl border border-orange-200/40 bg-gradient-to-r from-white/90 via-pink-50/30 to-white/90 backdrop-blur-md shadow-lg"
                id="gallery-row-bottom">
                <div id="gallery-track-bottom" class="gallery-track"></div>
            </div>
        </div>
        <div class="text-center">
            <a href="index.php?page=gallery"
                class="inline-flex items-center gap-2 bg-gradient-to-r from-orange-500 to-orange-600 text-white px-8 py-4 rounded-xl font-semibold hover:from-orange-600 hover:to-orange-700 shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-300 group">
                Lihat Selengkapnya
                <span class="text-xl leading-none group-hover:translate-x-1 transition-transform duration-300">&rarr;</span>
            </a>
        </div>
    </section>

    <section class="space-y-6">
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
            <div class="flex flex-wrap gap-3 justify-center">
                <?php foreach ($categories as $index => $cat): ?>
                    <button data-filter="<?php echo h($cat); ?>"
                        class="karya-filter px-6 py-2.5 rounded-full text-sm font-semibold border transition-all duration-300 <?php echo $index === 0 ? 'bg-gradient-to-r from-orange-500 to-orange-600 text-white border-orange-500 shadow-lg scale-105' : 'bg-white text-gray-700 border-gray-300 hover:border-orange-300 hover:shadow-md hover:scale-105'; ?>">
                        <?php echo h($cat); ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-6" id="karya-grid">
            <?php foreach (array_slice($karyaItems, 0, 3) as $karya): ?>
                <?php
                $karyaLink = 'index.php?page=detailKarya';
                if (!empty($karya['id'])) {
                    $karyaLink .= '&id=' . urlencode((string) $karya['id']);
                }
                ?>
                <a href="<?php echo h($karyaLink); ?>"
                    class="block bg-white rounded-2xl shadow-[0_12px_35px_-18px_rgba(15,23,42,0.35)] overflow-hidden border border-slate-200/70 hover:shadow-lg hover:-translate-y-1 transition">
                    <div class="w-full h-44 bg-gray-200 overflow-hidden">
                        <?php if (!empty($karya['image'])): ?>
                            <img src="<?php echo h($karya['image']); ?>" alt="<?php echo h($karya['title'] ?? ''); ?>"
                                class="w-full h-full object-cover">
                        <?php endif; ?>
                    </div>
                    <div class="p-4 space-y-2">
                        <span
                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#feedd8] text-orange-700 text-xs font-semibold border border-orange-200">
                            <span class="h-2 w-2 rounded-full bg-orange-500"></span>
                            <?php echo h($karya['category'] ?? ''); ?>
                        </span>
                        <h3 class="text-lg font-semibold text-gray-800"><?php echo h($karya['title'] ?? ''); ?></h3>
                        <p class="text-sm text-gray-500 line-clamp-2"><?php echo h($karya['excerpt'] ?? 'Detail singkat akan tampil di sini.'); ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        <div class="text-center">
            <a href="index.php?page=catalog"
                class="bg-orange-500 text-white px-6 py-3 rounded-lg font-semibold smooth hover:bg-orange-600 inline-block">Lihat
                Selengkapnya &rarr;</a>
        </div>

    </section>

    <!-- ========== SECTION ARTIKEL & BERITA ========== -->\n    <section class=\"relative space-y-6 scroll-reveal delay-300\">
        <div class=\"text-center space-y-2\">
            <span
                class=\"inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#feedd8] text-orange-700 font-semibold text-sm shadow-sm border border-orange-200\">
                <span class="h-2 w-2 rounded-full bg-orange-500 animate-pulse"></span>
                Cerita Kami
            </span>
            <h2 class="text-3xl font-bold text-center text-gray-800">Artikel & Berita</h2>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            <?php foreach ($artikelItems as $artikel): ?>
                <?php
                $artikelLink = 'index.php?page=news_detail';
                if (!empty($artikel['id'])) {
                    $artikelLink .= '&id=' . urlencode((string) $artikel['id']);
                }
                ?>
                <a href="<?php echo h($artikelLink); ?>"
                    class="bg-white rounded-xl card-outline overflow-hidden block hover:shadow-lg hover:-translate-y-1 transition">
                    <?php if (!empty($artikel['image'])): ?>
                        <img src="<?php echo h($artikel['image']); ?>" alt="<?php echo h($artikel['title'] ?? ''); ?>"
                            class="w-full h-40 object-cover bg-gray-200">
                    <?php else: ?>
                        <div class="w-full h-40 bg-gray-200"></div>
                    <?php endif; ?>
                    <div class="p-4 space-y-2">
                        <p class="text-sm text-orange-500 font-semibold"><?php echo h($artikel['date'] ?? ''); ?></p>
                        <h3 class="font-semibold text-lg text-gray-800"><?php echo h($artikel['title'] ?? ''); ?></h3>
                        <p class="text-gray-600 text-sm leading-relaxed line-clamp-2"><?php echo h($artikel['excerpt'] ?? ''); ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        <div class="text-center">
            <a href="index.php?page=news"
                class="bg-orange-500 text-white px-6 py-3 rounded-lg font-semibold smooth hover:bg-orange-600 inline-block">Lihat
                Selengkapnya &rarr;</a>
        </div>
    </section>
</main>
