<?php
include __DIR__ . '/../lib/helpers.php';
include __DIR__ . '/../layouts/header.php';
?>

<script src="https://cdn.tailwindcss.com"></script>

<main class="max-w-7xl mx-auto px-4 py-12 space-y-10 min-h-screen">
    
    <section class="bg-white pt-24 pb-8 text-center">
        <div class="max-w-screen-xl mx-auto px-4">
            <h1 class="font-heading font-bold text-3xl md:text-4xl text-brand-dark mb-2">
                Artikel & Berita Terkini
            </h1>
            <p class="font-sans text-gray-500 text-sm md:text-base">
                Ikuti kegiatan terbaru, prestasi mahasiswa, dan wawasan teknologi dari Lab MMT
            </p>
        </div>
    </section>

    <section class="bg-white border border-gray-200 rounded-xl shadow-sm p-4">
        <form action="index.php" method="GET" class="flex flex-col md:flex-row gap-4 items-center justify-center">
            
            <input type="hidden" name="page" value="news">

            <div class="relative w-full md:flex-1">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input type="text" name="search" value="<?php echo h($search ?? ''); ?>" placeholder="Cari judul berita..."
                    class="w-full pl-11 pr-4 py-3 text-sm rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>

            <div class="relative w-full md:w-64">
                <select name="category" onchange="this.form.submit()"
                    class="w-full pl-4 pr-10 py-3 text-sm font-semibold bg-white text-gray-700 border border-gray-200 rounded-lg appearance-none focus:outline-none focus:ring-2 focus:ring-orange-400 cursor-pointer">
                    <option value="semua">Semua Kategori</option>
                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?php echo (int) $cat['id']; ?>" <?php echo (isset($categoryId) && $categoryId === (int) $cat['id']) ? 'selected' : ''; ?>>
                                <?php echo h($cat['nama_kategori']); ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </span>
            </div>
        </form>
    </section>

    <?php if (!empty($sliderNews)): ?>
        <section class="relative bg-white border border-gray-100 rounded-2xl shadow-md overflow-hidden group">
            
            <div class="overflow-hidden relative">
                <div id="slider-track" class="flex transition-transform duration-500 ease-in-out">
                    <?php foreach ($sliderNews as $index => $item): ?>
                    <div class="w-full flex-shrink-0 p-6 md:p-8">
                        <div class="flex flex-col lg:flex-row gap-8 items-center">
                            <div class="w-full lg:w-1/2 h-64 lg:h-80 rounded-xl overflow-hidden bg-gray-100 relative shadow-sm">
                                <img src="<?php echo assetUrl($item['gambar_berita'] ?? ''); ?>" 
                                     class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-700">
                                
                                </div>
                            <div class="w-full lg:w-1/2 flex flex-col items-start text-left space-y-4">
                                <div class="text-xs font-bold text-orange-500 uppercase tracking-wider flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></span>
                                    <?php echo !empty($item['created_at']) ? h(date('d M Y', strtotime($item['created_at']))) : ''; ?>
                                    &bull; <?php echo h($item['nama_kategori'] ?? 'Umum'); ?>
                                </div>
                                <h2 class="text-2xl md:text-4xl font-extrabold text-gray-900 leading-tight">
                                    <a href="index.php?page=news_detail&id=<?php echo $item['id']; ?>" class="hover:text-orange-500 transition">
                                        <?php echo h($item['judul']); ?>
                                    </a>
                                </h2>
                                <p class="text-gray-500 text-sm md:text-base leading-relaxed line-clamp-3">
                                    <?php echo h(mb_substr(strip_tags($item['isi_berita'] ?? ''), 0, 200) . '...'); ?>
                                </p>
                                <a href="index.php?page=news_detail&id=<?php echo $item['id']; ?>"
                                   class="inline-flex items-center justify-center bg-gray-900 hover:bg-orange-600 text-white text-sm font-semibold py-3 px-8 rounded-lg transition-all shadow-lg hover:shadow-orange-500/30 transform hover:-translate-y-1">
                                    Baca Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php if(count($sliderNews) > 1): ?>
                <button id="prevBtn" class="absolute top-1/2 left-4 -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 p-3 rounded-full shadow-lg backdrop-blur-sm transition opacity-0 group-hover:opacity-100 focus:opacity-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                <button id="nextBtn" class="absolute top-1/2 right-4 -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 p-3 rounded-full shadow-lg backdrop-blur-sm transition opacity-0 group-hover:opacity-100 focus:opacity-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
                <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
                    <?php foreach ($sliderNews as $i => $v): ?>
                        <button class="slider-dot w-2.5 h-2.5 rounded-full bg-gray-300 hover:bg-orange-400 transition-all <?php echo $i === 0 ? 'bg-orange-500 w-6' : ''; ?>" data-index="<?php echo $i; ?>"></button>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </section>
    <?php endif; ?>

    <section class="bg-white">
        <div class="max-w-screen-xl mx-auto px-0">
            <?php if (empty($newsList)): ?>
                <div class="text-center py-10">
                    <p class="text-gray-500 text-lg">Belum ada berita yang ditemukan.</p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php foreach ($newsList as $news): ?>
                        <article class="flex flex-col h-full bg-white border border-gray-100 rounded-2xl p-5 shadow-sm hover:shadow-lg transition-all duration-300 group">
                            <div class="h-48 rounded-xl overflow-hidden bg-gray-100 mb-4 relative">
                                <img src="<?php echo assetUrl($news['gambar_berita'] ?? ''); ?>" 
                                     class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-gray-800 text-[10px] font-bold px-2 py-1 rounded shadow-sm">
                                    <?php echo h($news['nama_kategori'] ?? 'Umum'); ?>
                                </span>
                            </div>
                            <div class="flex flex-col flex-grow">
                                <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-orange-500 transition line-clamp-2">
                                    <a href="index.php?page=news_detail&id=<?php echo $news['id']; ?>"><?php echo h($news['judul'] ?? ''); ?></a>
                                </h3>
                                <div class="text-xs font-medium text-gray-400 mb-3 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <?php echo !empty($news['created_at']) ? h(date('d M Y', strtotime($news['created_at']))) : ''; ?>
                                </div>
                                <p class="text-gray-500 text-sm line-clamp-3 mb-4 flex-grow">
                                    <?php echo h(mb_substr(strip_tags($news['isi_berita'] ?? ''), 0, 100) . '...'); ?>
                                </p>
                                <a href="index.php?page=news_detail&id=<?php echo $news['id']; ?>"
                                   class="inline-flex items-center justify-center gap-2 w-full bg-orange-50 bg-opacity-50 hover:bg-orange-500 hover:text-white text-orange-600 text-xs font-semibold py-3 px-4 rounded-lg transition-all mt-auto shadow-sm">
                                    Lihat Selengkapnya &rarr;
                                </a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if(isset($totalPages) && $totalPages > 1): ?>
                <?php
                $link = function (int $p) use ($search, $categoryId): string {
                    $params = ['page' => 'news', 'p' => $p];
                    if (!empty($search)) $params['search'] = $search;
                    if (!empty($categoryId)) $params['category'] = $categoryId;
                    return 'index.php?' . http_build_query($params);
                };
                $currPage = $page ?? 1;
                $prev = max(1, $currPage - 1);
                $next = min($totalPages, $currPage + 1);
                ?>
                <div class="mt-12 flex justify-center">
                    <div class="inline-flex items-center gap-2 bg-white p-2 rounded-xl shadow-sm border border-gray-100">
                        <a href="<?php echo $link($prev); ?>" class="px-4 py-2 rounded-lg text-sm font-semibold <?php echo $currPage <= 1 ? 'text-gray-300 cursor-not-allowed' : 'text-gray-600 hover:bg-gray-100'; ?>">Prev</a>
                        <span class="px-4 py-2 bg-orange-500 text-white text-sm font-bold rounded-lg"><?php echo $currPage; ?> / <?php echo $totalPages; ?></span>
                        <a href="<?php echo $link($next); ?>" class="px-4 py-2 rounded-lg text-sm font-semibold <?php echo $currPage >= $totalPages ? 'text-gray-300 cursor-not-allowed' : 'text-gray-600 hover:bg-gray-100'; ?>">Next</a>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </section>
</main>

<?php include __DIR__ . '/../layouts/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const track = document.getElementById('slider-track');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const dots = document.querySelectorAll('.slider-dot');
    
    if (!track || !prevBtn || !nextBtn) return;

    const slides = track.children;
    const totalSlides = slides.length;
    let currentIndex = 0;

    const updateSlider = () => {
        track.style.transform = `translateX(-${currentIndex * 100}%)`;
        dots.forEach((dot, idx) => {
            if (idx === currentIndex) {
                dot.classList.add('bg-orange-500', 'w-6');
                dot.classList.remove('bg-gray-300');
            } else {
                dot.classList.add('bg-gray-300');
                dot.classList.remove('bg-orange-500', 'w-6');
            }
        });
    };

    nextBtn.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % totalSlides;
        updateSlider();
    });

    prevBtn.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
        updateSlider();
    });

    dots.forEach(dot => {
        dot.addEventListener('click', (e) => {
            currentIndex = parseInt(e.target.dataset.index);
            updateSlider();
        });
    });

    setInterval(() => {
        currentIndex = (currentIndex + 1) % totalSlides;
        updateSlider();
    }, 5000);
});
</script>