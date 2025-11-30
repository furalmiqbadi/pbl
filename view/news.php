<?php
// Helper function
if (!function_exists('h')) {
    function h(?string $value): string {
        return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
    }
}

include __DIR__ . '/../layouts/header.php';
?>

<script src="https://cdn.tailwindcss.com"></script>

<main class="max-w-7xl mx-auto px-4 py-12 space-y-10">
    <section class="bg-white pt-24 pb-12 text-center">
        <div class="max-w-screen-xl mx-auto px-4">
            <h1 class="font-heading font-bold text-3xl md:text-4xl text-brand-dark mb-2">
                Artikel & Berita Terkini </h1>
            <p class="font-sans text-gray-500 text-sm md:text-base">
                Ikuti kegiatan terbaru, prestasi mahasiswa, dan wawasan teknologi dari Lab MMT </p>
        </div>
    </section>

    <section class="bg-white rounded-xl p-4">
        <form action="index.php" method="GET" class="flex flex-col md:flex-row gap-3 items-center justify-center">
            
            <input type="hidden" name="page" value="news">

            <div class="relative w-full md:w-96">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </span>
                <input type="text" name="search" value="<?php echo h($search ?? ''); ?>" placeholder="Cari judul proyek..."
                    class="w-full pl-11 pr-4 py-3 text-sm rounded-lg bg-white border border-gray-200 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-300">
            </div>

            <div class="relative w-full md:w-64">
                <select name="category" onchange="this.form.submit()"
                    class="w-full pl-3 pr-8 py-3 text-sm font-semibold bg-white text-gray-800 border border-gray-200 rounded-lg appearance-none focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-300">
                    <option value="semua">Kategori: Semua</option>
                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?php echo (int) $cat['id']; ?>" <?php echo (isset($categoryId) && $categoryId === (int) $cat['id']) ? 'selected' : ''; ?>>
                                <?php echo 'Kategori: ' . h($cat['nama_kategori']); ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </span>
            </div>
        </form>
    </section>

    <?php if (!empty($featuredNews)): ?>
        <section class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden p-6 md:p-8 hover:shadow-md transition-shadow duration-300">
            <div class="flex flex-col lg:flex-row gap-8 items-center">
                <div class="w-full lg:w-1/2 h-64 lg:h-80 rounded-xl overflow-hidden bg-gray-100 relative group">
                    <img src="<?php echo !empty($featuredNews['gambar_berita']) ? h($featuredNews['gambar_berita']) : 'https://placehold.co/800x500?text=No+Image'; ?>"
                        class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                </div>
                <div class="w-full lg:w-1/2 flex flex-col items-start text-left space-y-3">
                    <div class="text-xs font-bold text-orange-500 uppercase tracking-wider flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-orange-500"></span>
                        Terbaru &bull;
                        <?php echo !empty($featuredNews['created_at']) ? h(date('d M Y', strtotime($featuredNews['created_at']))) : ''; ?>
                    </div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 leading-tight hover:text-orange-500 transition">
                        <a href="index.php?page=news_detail&id=<?php echo $featuredNews['id']; ?>"><?php echo h($featuredNews['judul'] ?? ''); ?></a>
                    </h2>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        <?php echo h(mb_substr(strip_tags($featuredNews['isi_berita'] ?? ''), 0, 150) . '...'); ?>
                    </p>
                    <a href="index.php?page=news_detail&id=<?php echo $featuredNews['id']; ?>"
                        class="inline-flex items-center justify-center bg-orange-500 hover:bg-orange-600 text-white text-sm font-semibold py-3 px-6 rounded-lg transition-all shadow-md shadow-orange-200 transform hover:-translate-y-0.5">
                        Lihat Selengkapnya
                    </a>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section class="bg-white">
        <div class="max-w-screen-xl mx-auto px-0">
            <?php if (empty($newsList)): ?>
                <div class="text-center py-10">
                    <p class="text-gray-500 text-lg">Belum ada berita yang ditemukan.</p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($newsList as $news): ?>
                        <article class="flex flex-col h-full bg-white border border-gray-100 rounded-2xl p-5 shadow-sm hover:shadow-lg transition-all duration-300 group">
                            <div class="h-48 rounded-xl overflow-hidden bg-gray-100 mb-4 relative">
                                <img src="<?php echo !empty($news['gambar_berita']) ? h($news['gambar_berita']) : 'https://placehold.co/600x400?text=No+Image'; ?>"
                                    class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-gray-800 text-[10px] font-bold px-2 py-1 rounded shadow-sm">
                                    <?php echo h($news['nama_kategori'] ?? 'Umum'); ?>
                                </span>
                            </div>
                            <div class="flex flex-col flex-grow">
                                <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-orange-500 transition">
                                    <a href="index.php?page=news_detail&id=<?php echo $news['id']; ?>"><?php echo h($news['judul'] ?? ''); ?></a>
                                </h3>
                                <div class="text-xs font-medium text-gray-400 mb-3 flex items-center gap-1">
                                    <?php echo !empty($news['created_at']) ? h(date('d M Y', strtotime($news['created_at']))) : ''; ?>
                                </div>
                                <p class="text-gray-500 text-sm line-clamp-3 mb-4 flex-grow">
                                    <?php echo h(mb_substr(strip_tags($news['isi_berita'] ?? ''), 0, 100) . '...'); ?>
                                </p>
                                <a href="index.php?page=news_detail&id=<?php echo $news['id']; ?>"
                                    class="inline-flex items-center justify-center gap-2 w-full bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold py-3 px-4 rounded-lg transition-all mt-auto shadow-sm hover:shadow-md">
                                    Lihat Selengkapnya &rarr;
                                </a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if(isset($totalPages) && $totalPages > 1): ?>
            <?php
            // Logic URL pagination
            $link = function (int $p) use ($search, $categoryId) {
                $params = [
                    'page' => 'news', 
                    'p' => $p
                ];
                if (!empty($search)) $params['search'] = $search;
                if (!empty($categoryId)) $params['category'] = $categoryId;
                return 'index.php?' . http_build_query($params);
            };
            
            $currPage = $page ?? 1; 
            $prev = max(1, $currPage - 1);
            $next = min($totalPages, $currPage + 1);
            
            $window = 5;
            $startPage = max(1, $currPage - 2);
            $endPage = min($totalPages, $startPage + $window - 1);
            if ($endPage - $startPage + 1 < $window) {
                $startPage = max(1, $endPage - $window + 1);
            }
            ?>
            <div class="mt-10 flex justify-center">
                <div class="inline-flex items-center gap-1 bg-white border border-gray-200 rounded-xl px-3 py-2 shadow-sm text-sm font-semibold">
                    <a href="<?php echo $link($prev); ?>" class="px-3 py-1 rounded-lg <?php echo $currPage <= 1 ? 'text-gray-300 cursor-not-allowed' : 'text-orange-600 hover:bg-orange-50'; ?>">Sebelumnya</a>
                    
                    <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                        <a href="<?php echo $link($i); ?>" class="px-3 py-1 rounded-lg <?php echo $i === $currPage ? 'bg-orange-500 text-white shadow-sm' : 'text-gray-700 hover:bg-orange-50'; ?>">
                            <?php echo $i; ?>
                        </a>
                    <?php endfor; ?>
                    
                    <a href="<?php echo $link($next); ?>" class="px-3 py-1 rounded-lg <?php echo $currPage >= $totalPages ? 'text-gray-300 cursor-not-allowed' : 'text-orange-600 hover:bg-orange-50'; ?>">Berikutnya</a>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </section>
</main>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
