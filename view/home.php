<main class="max-w-6xl mx-auto px-4 pt-14 pb-12 space-y-16">
    <section class="grid md:grid-cols-2 gap-12 items-center">
        <div class="space-y-4">
            <span
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#feedd8] text-orange-700 font-semibold text-sm shadow-sm border border-orange-200">
                <span class="h-2 w-2 rounded-full bg-orange-500"></span>
                Selamat Datang di
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight text-gray-900">
                <?php echo h($hero['title'] ?? 'Lab Multimedia'); ?>
            </h1>
            <p class="text-gray-600 max-w-xl"><?php echo h($hero['subtitle'] ?? ''); ?></p>

            <a href="index.php?page=about"
                class="inline-flex items-center gap-2 bg-orange-500 text-white px-6 py-3 rounded-lg font-semibold smooth hover:bg-orange-600 shadow-md">
                <?php echo h($hero['cta'] ?? 'Kenali Kami'); ?>
                <span class="text-xl leading-none">&rarr;</span>
            </a>
        </div>
        <div class="flex justify-center">
            <img src="<?php echo h($hero['image'] ?? 'assets/images/mmtLogo.png'); ?>" alt="Hero"
                class="w-96 h-96 md:w-[540px] md:h-[540px] object-contain drop-shadow-[0_25px_45px_rgba(0,0,0,0.08)]">
        </div>
    </section>

    <section class="space-y-10">
        <div class="text-center space-y-2">
            <span
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#feedd8] text-orange-700 font-semibold text-sm shadow-sm border border-orange-200">
                <span class="h-2 w-2 rounded-full bg-orange-500"></span>
                Apa yang kami dalami
            </span>
            <h2 class="text-3xl font-bold text-gray-800">Fokus Utama Kami</h2>
            <p class="text-gray-600">Game, UI/UX, dan AR/VR yang saling melengkapi.</p>
        </div>
        <div class="grid md:grid-cols-3 gap-6 items-stretch">
            <?php foreach ($fokusItems as $fokus): ?>
                <div
                    class="relative bg-white rounded-2xl card-outline p-8 pt-14 flex flex-col items-center text-center h-full">
                    <div
                        class="absolute -top-8 bg-orange-500 rounded-full w-16 h-16 flex items-center justify-center shadow-lg overflow-hidden">
                        <?php if (!empty($fokus['image'])): ?>
                            <img src="<?php echo h($fokus['image']); ?>" alt="<?php echo h($fokus['title'] ?? ''); ?>"
                                class="w-full h-full object-cover">
                        <?php else: ?>
                            <span class="text-xl text-white">★</span>
                        <?php endif; ?>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 mt-4 text-gray-800"><?php echo h($fokus['title'] ?? ''); ?></h3>
                    <p class="text-gray-600 text-sm leading-relaxed"><?php echo h($fokus['text'] ?? ''); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="space-y-6">
        <div class="text-center space-y-2">
            <span
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#feedd8] text-orange-700 font-semibold text-sm shadow-sm border border-orange-200">
                <span class="h-2 w-2 rounded-full bg-orange-500"></span>
                Tangkap Momen
            </span>
            <h2 class="text-3xl font-bold text-center text-gray-800">Galeri</h2>
            <p class="text-gray-600">Cuplikan karya, eksperimen, dan aktivitas terbaru.</p>
        </div>
        <div class="space-y-3">
            <div class="gallery-row rounded-2xl border border-slate-200/60 bg-white/70 backdrop-blur"
                id="gallery-row-top">
                <div id="gallery-track-top" class="gallery-track"></div>
            </div>
            <div class="gallery-row rounded-2xl border border-slate-200/60 bg-white/70 backdrop-blur"
                id="gallery-row-bottom">
                <div id="gallery-track-bottom" class="gallery-track"></div>
            </div>
        </div>
        <div class="text-center">
            <a href="index.php?page=gallery"
                class="inline-flex items-center gap-2 bg-orange-500 text-white px-6 py-3 rounded-lg font-semibold smooth hover:bg-orange-600 shadow-md">
                Lihat Selengkapnya
                <span class="text-xl leading-none">&rarr;</span>
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
        <div class="space-y-3 text-center">
            <div class="flex items-center justify-center">
                <span
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#feedd8] text-orange-700 font-semibold text-sm shadow-sm border border-orange-200">
                    <span class="h-2 w-2 rounded-full bg-orange-500"></span>
                    Karya Unggulan
                </span>
            </div>
            <h2 class="text-3xl font-bold text-gray-800">Karya Unggulan Kami</h2>
            <p class="text-gray-600">Pilihan project terbaik dari Game, UI/UX, dan AR/VR.</p>
            <div class="flex flex-wrap gap-2 justify-center">
                <?php foreach ($categories as $index => $cat): ?>
                    <button data-filter="<?php echo h($cat); ?>"
                        class="karya-filter px-4 py-2 rounded-full text-sm font-semibold border <?php echo $index === 0 ? 'bg-orange-500 text-white border-orange-500 shadow-sm' : 'bg-white text-gray-700 border-gray-200 hover:border-orange-200'; ?>">
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
                        <p class="text-sm text-gray-500">Detail singkat akan tampil di sini.</p>
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

    <section class="space-y-6">
        <div class="text-center space-y-2">
            <span
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#feedd8] text-orange-700 font-semibold text-sm shadow-sm border border-orange-200">
                <span class="h-2 w-2 rounded-full bg-orange-500"></span>
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
                        <p class="text-gray-600 text-sm leading-relaxed"><?php echo h($artikel['excerpt'] ?? ''); ?></p>
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