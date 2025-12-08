<?php
include __DIR__ . '/../lib/helpers.php';
include __DIR__ . '/../layouts/header.php';

$sliderNews = [];
if (!empty($featuredNews)) {
    $sliderNews[] = $featuredNews;
}
if (!empty($newsList)) {
    $sliderNews = array_merge($sliderNews, array_slice($newsList, 0, 2));
}
$sliderNews = array_unique($sliderNews, SORT_REGULAR);
?>

<script src="https://cdn.tailwindcss.com"></script>
<style>
    .fade-in-up {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }
    .fade-in-up.visible {
        opacity: 1;
        transform: translateY(0);
    }
</style>

<main class="max-w-7xl mx-auto px-4 py-12 space-y-16 min-h-screen">
    
    <section class="bg-white pt-24 pb-8 text-center fade-in-up">
        <div class="max-w-screen-xl mx-auto px-4">
            <h1 class="font-heading font-bold text-4xl md:text-5xl text-brand-dark mb-4 tracking-tight">
                Artikel & Berita <span class="text-orange-500">Terkini</span>
            </h1>
            <p class="font-sans text-gray-500 text-lg md:text-xl max-w-2xl mx-auto leading-relaxed">
                Dapatkan wawasan terbaru seputar teknologi, prestasi mahasiswa, dan kegiatan seru di Lab MMT.
            </p>
        </div>
    </section>

    <section class="bg-white border border-gray-100 rounded-2xl shadow-lg p-6 max-w-4xl mx-auto fade-in-up" style="transition-delay: 100ms;">
        <form action="index.php" method="GET" class="flex flex-col md:flex-row gap-4 items-center justify-center">
            
            <input type="hidden" name="page" value="news">

            <div class="relative w-full md:flex-1">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input type="text" name="search" value="<?php echo h($search ?? ''); ?>" placeholder="Cari topik menarik..."
                    class="w-full pl-11 pr-4 py-3.5 text-sm rounded-xl border border-gray-200 focus:outline-none focus:ring-4 focus:ring-orange-100 focus:border-orange-400 transition-all">
            </div>

            <div class="relative w-full md:w-64">
                <select name="category" onchange="this.form.submit()"
                    class="w-full pl-4 pr-10 py-3.5 text-sm font-semibold bg-gray-50 text-gray-700 border border-gray-200 rounded-xl appearance-none focus:outline-none focus:ring-4 focus:ring-orange-100 focus:border-orange-400 cursor-pointer transition-all hover:bg-white">
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
        <section class="relative bg-white rounded-3xl shadow-xl overflow-hidden group fade-in-up" style="transition-delay: 200ms;">
            
            <div class="overflow-hidden relative h-[500px] md:h-[450px]">
                <div id="slider-track" class="flex h-full transition-transform duration-700 cubic-bezier(0.4, 0, 0.2, 1)">
                    <?php foreach ($sliderNews as $index => $item): ?>
                    <div class="w-full flex-shrink-0 h-full relative">
                        <div class="absolute inset-0">
                            <img src="<?php echo assetUrl($item['gambar_berita'] ?? ''); ?>" 
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent"></div>
                        </div>

                        <div class="absolute bottom-0 left-0 w-full p-8 md:p-12 text-white z-10">
                            <div class="max-w-3xl">
                                <div class="flex items-center gap-3 mb-4">
                                    <span class="px-3 py-1 bg-orange-500 text-white text-xs font-bold uppercase tracking-wider rounded-full shadow-lg">
                                        <?php echo h($item['nama_kategori'] ?? 'Highlight'); ?>
                                    </span>
                                    <span class="text-gray-300 text-sm font-medium flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <?php echo !empty($item['created_at']) ? h(date('d M Y', strtotime($item['created_at']))) : ''; ?>
                                    </span>
                                </div>
                                <h2 class="text-3xl md:text-5xl font-bold leading-tight mb-4 drop-shadow-md">
                                    <a href="index.php?page=news_detail&id=<?php echo $item['id']; ?>" class="hover:text-orange-400 transition-colors">
                                        <?php echo h($item['judul']); ?>
                                    </a>
                                </h2>
                                <p class="text-gray-200 text-sm md:text-lg line-clamp-2 mb-6 max-w-2xl">
                                    <?php echo h(mb_substr(strip_tags($item['isi_berita'] ?? ''), 0, 150) . '...'); ?>
                                </p>
                                <a href="index.php?page=news_detail&id=<?php echo $item['id']; ?>"
                                   class="inline-flex items-center gap-2 bg-white text-gray-900 hover:bg-orange-500 hover:text-white font-bold py-3 px-6 rounded-full transition-all shadow-lg hover:shadow-orange-500/30 group">
                                    Baca Selengkapnya
                                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php if(count($sliderNews) > 1): ?>
                <button id="prevBtn" class="absolute top-1/2 left-4 md:left-8 -translate-y-1/2 bg-white/10 hover:bg-white/20 text-white p-4 rounded-full backdrop-blur-md border border-white/20 transition-all hover:scale-110 focus:outline-none hidden md:block">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                <button id="nextBtn" class="absolute top-1/2 right-4 md:right-8 -translate-y-1/2 bg-white/10 hover:bg-white/20 text-white p-4 rounded-full backdrop-blur-md border border-white/20 transition-all hover:scale-110 focus:outline-none hidden md:block">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>

                <div class="absolute bottom-8 right-8 flex gap-2 z-20">
                    <?php foreach ($sliderNews as $i => $v): ?>
                        <button class="slider-dot w-3 h-3 rounded-full bg-white/50 hover:bg-white transition-all <?php echo $i === 0 ? 'bg-orange-500 w-8' : ''; ?>" data-index="<?php echo $i; ?>"></button>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </section>
    <?php endif; ?>

    <section class="bg-white">
        <div class="max-w-screen-xl mx-auto px-0">
            <?php if (empty($newsList)): ?>
                <div class="text-center py-20 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
                    <div class="text-6xl mb-4">📭</div>
                    <p class="text-gray-500 text-xl font-medium">Belum ada berita yang ditemukan.</p>
                    <p class="text-gray-400 mt-2">Coba kata kunci lain atau ubah filter kategori.</p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php foreach ($newsList as $i => $news): ?>
                        <article class="flex flex-col h-full bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 group fade-in-up" style="transition-delay: <?php echo ($i * 50) + 300; ?>ms;">
                            
                            <div class="h-56 overflow-hidden relative bg-gray-100">
                                <img src="<?php echo assetUrl($news['gambar_berita'] ?? ''); ?>" 
                                     class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute top-4 left-4">
                                    <span class="bg-white/90 backdrop-blur-md text-gray-800 text-xs font-bold px-3 py-1.5 rounded-lg shadow-sm border border-white/50 uppercase tracking-wide">
                                        <?php echo h($news['nama_kategori'] ?? 'Umum'); ?>
                                    </span>
                                </div>
                            </div>

                            <div class="flex flex-col flex-grow p-6">
                                <div class="text-xs font-semibold text-orange-500 mb-3 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <?php echo !empty($news['created_at']) ? h(date('d F Y', strtotime($news['created_at']))) : ''; ?>
                                </div>
                                
                                <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-orange-600 transition-colors line-clamp-2 leading-snug">
                                    <a href="index.php?page=news_detail&id=<?php echo $news['id']; ?>">
                                        <?php echo h($news['judul'] ?? ''); ?>
                                    </a>
                                </h3>
                                
                                <p class="text-gray-500 text-sm line-clamp-3 mb-6 flex-grow leading-relaxed">
                                    <?php echo h(mb_substr(strip_tags($news['isi_berita'] ?? ''), 0, 120) . '...'); ?>
                                </p>
                                
                                <a href="index.php?page=news_detail&id=<?php echo $news['id']; ?>"
                                   class="inline-flex items-center text-sm font-bold text-gray-900 hover:text-orange-600 transition-colors group/link">
                                    Baca Selengkapnya 
                                    <svg class="w-4 h-4 ml-2 transition-transform group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
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
                <div class="mt-16 flex justify-center fade-in-up">
                    <div class="inline-flex items-center gap-2 bg-white p-2 rounded-2xl shadow-lg border border-gray-100">
                        
                        <a href="<?php echo $link($prev); ?>" 
                           class="px-5 py-2.5 rounded-xl text-sm font-bold text-gray-600 hover:bg-orange-50 hover:text-orange-600 transition-colors <?php echo $currPage <= 1 ? 'opacity-50 cursor-not-allowed pointer-events-none' : ''; ?>">
                           Sebelumnya
                        </a>
                        
                        <span class="px-4 py-2 bg-gray-50 text-gray-800 text-sm font-bold rounded-xl border border-gray-100">
                            Hal <?php echo $currPage; ?> / <?php echo $totalPages; ?>
                        </span>
                        
                        <a href="<?php echo $link($next); ?>" 
                           class="px-5 py-2.5 rounded-xl text-sm font-bold text-gray-600 hover:bg-orange-50 hover:text-orange-600 transition-colors <?php echo $currPage >= $totalPages ? 'opacity-50 cursor-not-allowed pointer-events-none' : ''; ?>">
                           Selanjutnya
                        </a>

                    </div>
                </div>
            <?php endif; ?>

        </div>
    </section>
</main>

<?php include __DIR__ . '/../layouts/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // 1. Scroll Animations (Fade In)
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target); 
            }
        });
    }, observerOptions);

    document.querySelectorAll('.fade-in-up').forEach(el => {
        observer.observe(el);
    });

    // 2. Slider Logic
    const track = document.getElementById('slider-track');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const dots = document.querySelectorAll('.slider-dot');
    
    if (!track || !prevBtn || !nextBtn) return;

    const slides = track.children;
    const totalSlides = slides.length;
    let currentIndex = 0;
    let autoPlayInterval;

    const updateSlider = () => {
        track.style.transform = `translateX(-${currentIndex * 100}%)`;
        
        // Update dots style
        dots.forEach((dot, idx) => {
            if (idx === currentIndex) {
                dot.classList.add('bg-orange-500', 'w-8');
                dot.classList.remove('bg-white/50');
            } else {
                dot.classList.add('bg-white/50');
                dot.classList.remove('bg-orange-500', 'w-8');
            }
        });
    };

    const nextSlide = () => {
        currentIndex = (currentIndex + 1) % totalSlides;
        updateSlider();
    };

    const prevSlide = () => {
        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
        updateSlider();
    };

    nextBtn.addEventListener('click', () => {
        nextSlide();
        resetAutoPlay();
    });

    prevBtn.addEventListener('click', () => {
        prevSlide();
        resetAutoPlay();
    });

    dots.forEach(dot => {
        dot.addEventListener('click', (e) => {
            currentIndex = parseInt(e.target.dataset.index);
            updateSlider();
            resetAutoPlay();
        });
    });

    const startAutoPlay = () => {
        autoPlayInterval = setInterval(nextSlide, 5000);
    };

    const resetAutoPlay = () => {
        clearInterval(autoPlayInterval);
        startAutoPlay();
    };

    startAutoPlay(); 
});
</script>