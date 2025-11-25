<main class="max-w-6xl mx-auto px-4 py-12 space-y-16">
    <!-- Awal -->
    <section class="grid md:grid-cols-2 gap-12 items-center">
        <div class="space-y-4">
            <p class="text-xl text-orange-600 font-semibold">Selamat Datang di</p>
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight text-gray-900">
                <?php echo h($hero['title'] ?? 'Lab Multimedia'); ?>
            </h1>
            <p class="text-gray-600 max-w-xl"><?php echo h($hero['subtitle'] ?? ''); ?></p>
            <a href="view/about.php" class="inline-block bg-orange-500 text-white px-6 py-3 rounded-lg font-semibold smooth hover:bg-orange-600">
                <?php echo h($hero['cta'] ?? 'Kenali Kami'); ?>
            </a>
        </div>
        <div class="flex justify-center">
            <img src="<?php echo h($hero['image'] ?? 'assets/images/mmtLogo.png'); ?>" alt="Hero" class="w-96 h-96 md:w-[500px] md:h-[500px] object-contain">
        </div>
    </section>

    <!-- Fokus Utama -->
    <section class="space-y-10">
        <h2 class="text-3xl font-bold text-center text-gray-800">Fokus Utama Kami</h2>
        <div class="grid md:grid-cols-3 gap-6 items-stretch">
            <?php foreach ($fokusItems as $fokus): ?>
            <div class="relative bg-white rounded-2xl card-outline p-8 pt-14 flex flex-col items-center text-center h-full">
                <div class="absolute -top-8 bg-orange-500 text-white rounded-full w-16 h-16 flex items-center justify-center shadow-lg">
                    <span class="text-xl">★</span>
                </div>
                <h3 class="text-xl font-semibold mb-2 mt-4 text-gray-800"><?php echo h($fokus['title'] ?? ''); ?></h3>
                <p class="text-gray-600 text-sm leading-relaxed"><?php echo h($fokus['text'] ?? ''); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Galeri -->
    <section class="space-y-6">
        <h2 class="text-3xl font-bold text-center text-gray-800">Galeri</h2>
        <?php
            $galleryTop = array_slice($galleryItems, 0, 8);
            $galleryBottom = array_slice($galleryItems, 8, 8);
            if (count($galleryBottom) < 8) {
                $galleryBottom = $galleryTop;
            }
        ?>
        <div class="space-y-3">
            <div class="gallery-row rounded-2xl border border-slate-200/60 bg-white/70 backdrop-blur" id="gallery-row-top">
                <div id="gallery-track-top" class="gallery-track"></div>
            </div>
            <div class="gallery-row rounded-2xl border border-slate-200/60 bg-white/70 backdrop-blur" id="gallery-row-bottom">
                <div id="gallery-track-bottom" class="gallery-track"></div>
            </div>
        </div>
    </section>

    <!-- Karya Unggulan -->
    <section class="space-y-6">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-bold text-gray-800">Karya Unggulan Kami</h2>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <?php foreach (array_slice($karyaItems, 0, 3) as $karya): ?>
            <div class="bg-white rounded-xl card-outline overflow-hidden">
                <?php if (!empty($karya['image'])): ?>
                    <img src="<?php echo h($karya['image']); ?>" alt="<?php echo h($karya['title'] ?? ''); ?>" class="w-full h-44 object-cover bg-gray-200">
                <?php else: ?>
                    <div class="w-full h-44 bg-gray-200"></div>
                <?php endif; ?>
                <div class="p-4 space-y-2">
                    <p class="pill text-xs inline-block"><?php echo h($karya['category'] ?? ''); ?></p>
                    <h3 class="text-lg font-semibold text-gray-800"><?php echo h($karya['title'] ?? ''); ?></h3>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center">
            <a href="view/catalog.php" class="bg-orange-500 text-white px-6 py-3 rounded-lg font-semibold smooth hover:bg-orange-600 inline-block">Lihat Selengkapnya →</a>
        </div>

    </section>

    <!-- Artikel & Berita -->
    <section class="space-y-6">
        <h2 class="text-3xl font-bold text-center text-gray-800">Artikel & Berita</h2>
        <div class="grid md:grid-cols-3 gap-6">
            <?php foreach ($artikelItems as $artikel): ?>
            <article class="bg-white rounded-xl card-outline overflow-hidden">
                <?php if (!empty($artikel['image'])): ?>
                    <img src="<?php echo h($artikel['image']); ?>" alt="<?php echo h($artikel['title'] ?? ''); ?>" class="w-full h-40 object-cover bg-gray-200">
                <?php else: ?>
                    <div class="w-full h-40 bg-gray-200"></div>
                <?php endif; ?>
                <div class="p-4 space-y-2">
                    <p class="text-sm text-orange-500 font-semibold"><?php echo h($artikel['date'] ?? ''); ?></p>
                    <h3 class="font-semibold text-lg text-gray-800"><?php echo h($artikel['title'] ?? ''); ?></h3>
                    <p class="text-gray-600 text-sm leading-relaxed"><?php echo h($artikel['excerpt'] ?? ''); ?></p>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
        <div class="text-center">
            <a href="view/news.php" class="bg-orange-500 text-white px-6 py-3 rounded-lg font-semibold smooth hover:bg-orange-600 inline-block">Lihat Selengkapnya →</a>
        </div>
    </section>
</main>
