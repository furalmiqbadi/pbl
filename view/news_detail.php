<?php
if (!function_exists('h')) {
    function h(?string $value): string {
        return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
    }
}

include __DIR__ . '/../layouts/header.php';

$detail = $newsItem ?? null;
$imageSrc = $detail ? assetUrl($detail['gambar_berita'] ?? '') : '';
$fallbackImage = 'https://placehold.co/900x520?text=Berita';

// Set currentPage ke 'detail' agar tidak ada menu yang aktif di navbar
$_GET['page'] = 'detail';

// Dynamic back button - deteksi dari mana user datang
$referer = $_SERVER['HTTP_REFERER'] ?? '';
$backUrl = 'index.php';
$backText = 'Kembali ke Beranda';

if (strpos($referer, 'page=news') !== false) {
    $backUrl = 'index.php?page=news';
    $backText = 'Kembali ke Berita';
}
?>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
    body { 
        font-family: 'Poppins', sans-serif; 
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-in-up {
        animation: fadeInUp 0.5s ease-out forwards;
    }

    .delay-100 { animation-delay: 0.1s; opacity: 0; }
    .delay-200 { animation-delay: 0.2s; opacity: 0; }
    .delay-300 { animation-delay: 0.3s; opacity: 0; }
</style>

<main class="bg-white min-h-screen">
    <div class="max-w-6xl mx-auto px-4 pt-24 pb-16">
        
        <!-- Back Button Orange - Dinamis -->
        <div class="mb-8 fade-in-up">
            <a href="<?php echo h($backUrl); ?>"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-orange-500 text-white font-semibold rounded-lg hover:bg-orange-600 transition-all duration-300 shadow-md hover:shadow-lg group">
                <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                <?php echo h($backText); ?>
            </a>
        </div>

        <!-- Category Badge -->
        <div class="text-center mb-4 fade-in-up delay-100">
            <span class="inline-block px-4 py-1.5 bg-orange-100 text-orange-600 text-xs font-bold uppercase rounded-full tracking-wide">
                PRESTASI
            </span>
        </div>

        <!-- Title -->
        <h1 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-4 leading-tight max-w-4xl mx-auto fade-in-up delay-100">
            <?php echo h($detail['judul'] ?? 'Berita tidak ditemukan'); ?>
        </h1>

        <!-- Meta Info -->
        <div class="text-center text-gray-500 text-sm mb-10 fade-in-up delay-100">
            <?php if (!empty($detail['created_at'])): ?>
                Oleh Admin • <?php echo date('d M Y', strtotime($detail['created_at'])); ?>
            <?php endif; ?>
        </div>

        <!-- Hero Image - Full Width -->
        <div class="mb-12 fade-in-up delay-200">
            <div class="rounded-2xl overflow-hidden shadow-lg">
                <div class="w-full h-64 md:h-96 bg-gray-100 relative overflow-hidden group">
                    <img src="<?php echo $imageSrc !== '' ? h($imageSrc) : $fallbackImage; ?>"
                         alt="<?php echo h($detail['judul'] ?? 'Berita'); ?>"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                </div>
            </div>
        </div>

        <!-- Content: 2 Kolom - Main Content (Kiri) + Sidebar (Kanan) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-16 fade-in-up delay-300">
            
            <!-- Kolom Kiri: Isi Berita (Main Content) -->
            <div class="lg:col-span-8">
                <?php if (!empty($detail['isi_berita'])): ?>
                    <div class="prose prose-lg max-w-none">
                        <p class="text-gray-700 leading-relaxed text-justify">
                            <?php echo nl2br(h($detail['isi_berita'])); ?>
                        </p>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500 italic">Detail berita belum tersedia.</p>
                <?php endif; ?>
            </div>

            <!-- Kolom Kanan: Sidebar "Baca Juga" -->
            <div class="lg:col-span-4">
                <div class="sticky top-24 space-y-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Baca Juga</h3>
                    
                    <?php if (!empty($relatedNews)): ?>
                        <div class="space-y-4">
                            <?php foreach (array_slice($relatedNews, 0, 3) as $news): ?>
                                <?php
                                $link = 'index.php?page=news_detail';
                                if (!empty($news['id'])) {
                                    $link .= '&id=' . urlencode((string) $news['id']);
                                }
                                $thumb = assetUrl($news['gambar_berita'] ?? '');
                                ?>
                                <a href="<?php echo h($link); ?>"
                                   class="group block bg-white rounded-xl border border-gray-200 overflow-hidden hover:border-orange-400 hover:shadow-lg transition-all duration-300">
                                    <div class="h-32 bg-gray-100 overflow-hidden relative">
                                        <img src="<?php echo $thumb !== '' ? h($thumb) : $fallbackImage; ?>"
                                             alt="<?php echo h($news['judul'] ?? 'Berita'); ?>"
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    </div>
                                    <div class="p-4">
                                        <p class="text-xs text-orange-500 font-semibold mb-2">
                                            <?php echo !empty($news['created_at']) ? date('d M Y', strtotime($news['created_at'])) : ''; ?>
                                        </p>
                                        <h4 class="font-bold text-sm text-gray-900 group-hover:text-orange-600 transition-colors line-clamp-2 mb-3">
                                            <?php echo h($news['judul'] ?? ''); ?>
                                        </h4>
                                        <button class="w-full bg-orange-500 text-white text-xs font-semibold py-2 rounded-lg hover:bg-orange-600 transition-colors">
                                            Lihat Detail
                                        </button>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-gray-500 text-sm italic">Tidak ada berita lainnya.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
