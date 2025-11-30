<?php
// view/news_detail.php

// Helper (jaga-jaga kalau belum keload)
if (!function_exists('h')) {
    function h(?string $value): string {
        return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
    }
}

// Header sudah load helpers.php, jadi assetUrl() bisa dipakai
include __DIR__ . '/../layouts/header.php';
?>

<script src="https://cdn.tailwindcss.com"></script>

<main class="bg-white">
    
    <article class="max-w-4xl mx-auto px-4 pt-24 pb-12">
        
        <a href="index.php?page=news" class="inline-flex items-center text-sm font-semibold text-gray-500 hover:text-orange-500 transition-colors mb-8 group">
            <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Berita
        </a>

        <div class="flex flex-wrap items-center gap-4 mb-6">
            <span class="px-3 py-1 rounded-full bg-orange-100 text-orange-600 font-bold uppercase text-xs tracking-wide">
                <?php echo h($newsItem['nama_kategori'] ?? 'Umum'); ?>
            </span>
            
            <span class="text-gray-400 text-sm font-medium flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <?php echo !empty($newsItem['created_at']) ? date('d F Y', strtotime($newsItem['created_at'])) : '-'; ?>
            </span>
            
            <span class="text-gray-400 text-sm font-medium flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                Admin Lab MMT
            </span>
        </div>

        <h1 class="font-heading font-extrabold text-3xl md:text-5xl text-gray-900 leading-tight mb-10">
            <?php echo h($newsItem['judul']); ?>
        </h1>

        <div class="w-full h-[300px] md:h-[500px] rounded-2xl overflow-hidden shadow-lg mb-12 relative bg-gray-100">
            <img src="<?php echo assetUrl($newsItem['gambar_berita'] ?? ''); ?>" 
                 alt="<?php echo h($newsItem['judul']); ?>"
                 class="w-full h-full object-cover">
        </div>

        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed font-sans">
            <?php echo nl2br(h($newsItem['isi_berita'])); ?>
        </div>

        <div class="mt-16 pt-8 border-t border-gray-200 flex flex-col md:flex-row items-center justify-between gap-4">
            <span class="font-bold text-gray-900">Bagikan Artikel Ini:</span>
            <div class="flex gap-3">
                <button class="p-3 rounded-full bg-gray-100 hover:bg-green-500 hover:text-white transition-all">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                </button>
            </div>
        </div>

    </article>

    <?php if (!empty($relatedNews)): ?>
    <section class="bg-gray-50 py-16">
        <div class="max-w-screen-xl mx-auto px-4">
            <h3 class="font-heading font-bold text-2xl text-gray-800 mb-8 pl-4 border-l-4 border-orange-500">
                Baca Juga
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php foreach($relatedNews as $related): ?>
                <a href="index.php?page=news_detail&id=<?php echo $related['id']; ?>" class="group bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300">
                    <div class="h-40 overflow-hidden relative">
                        <img src="<?php echo assetUrl($related['gambar_berita'] ?? ''); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <span class="absolute top-2 left-2 bg-white/90 px-2 py-1 rounded text-xs font-bold text-gray-800">
                            <?php echo h($related['nama_kategori'] ?? 'Umum'); ?>
                        </span>
                    </div>
                    <div class="p-4">
                        <h4 class="font-bold text-gray-800 group-hover:text-orange-500 transition-colors line-clamp-2 mb-2">
                            <?php echo h($related['judul']); ?>
                        </h4>
                        <p class="text-xs text-gray-400">
                            <?php echo !empty($related['created_at']) ? date('d M Y', strtotime($related['created_at'])) : ''; ?>
                        </p>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

</main>

<?php include __DIR__ . '/../layouts/footer.php'; ?>