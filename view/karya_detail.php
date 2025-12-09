<?php
// ========== HELPER FUNCTION ==========
// Fungsi untuk escape HTML (mencegah XSS attack)
if (!function_exists('h')) {
    function h(?string $value): string
    {
        return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
    }
}

// Load header (navbar)
include __DIR__ . '/../layouts/header.php';

// ========== SETUP DATA KARYA ==========
// Ambil data karya dari controller
$detail = $karyaItem ?? null;
// Setup URL gambar karya
$imageSrc = $detail ? assetUrl($detail['gambar_proyek'] ?? '') : '';
$fallbackImage = 'https://placehold.co/900x520?text=Karya';
// Ambil daftar anggota tim
$anggota = $anggota ?? [];

// ========== KARYA TERKAIT ==========
// Filter karya lainnya (kecuali yang sedang dibuka)
$relatedKarya = [];
if (!empty($allKarya) && is_array($allKarya)) {
    foreach ($allKarya as $item) {
        if (!isset($detail['id']) || (int) $item['id'] !== (int) $detail['id']) {
            $relatedKarya[] = $item;
        }
    }
    // Ambil maksimal 3 karya terkait
    $relatedKarya = array_slice($relatedKarya, 0, 3);
}

// ========== SETUP NAVBAR & BACK BUTTON ==========
// Set halaman detail (tidak ada menu aktif di navbar)
$_GET['page'] = 'detail';

// Dynamic back button - deteksi dari mana user datang
$referer = $_SERVER['HTTP_REFERER'] ?? '';
$backUrl = 'index.php';
$backText = 'Kembali ke Beranda';

// Jika dari halaman katalog, tombol kembali ke katalog
if (strpos($referer, 'page=catalog') !== false) {
    $backUrl = 'index.php?page=catalog';
    $backText = 'Kembali ke Katalog';
}
?>

<!-- Tailwind CSS & Font -->
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
    /* ========== CUSTOM STYLES ========== */
    body { 
        /* Styles ditangani oleh Tailwind dan header.php */
    }

    /* Animasi fade in dari bawah */
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
        
        <!-- ========== TOMBOL KEMBALI ========== -->
        <!-- Tombol kembali (dinamis sesuai dari mana user datang) -->
        <div class="mb-8 fade-in-up">
            <a href="<?php echo h($backUrl); ?>"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-orange-500 text-white font-semibold rounded-lg hover:bg-orange-600 transition-all duration-300 shadow-md hover:shadow-lg group">
                <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                <?php echo h($backText); ?>
            </a>
        </div>

        <!-- ========== GAMBAR HERO ========== -->
        <!-- Gambar hero (full width dengan efek zoom saat hover) -->
        <div class="mb-12 fade-in-up delay-100">
            <div class="rounded-2xl overflow-hidden shadow-lg">
                <div class="w-full h-64 md:h-96 bg-gray-100 relative overflow-hidden group">
                    <img src="<?php echo $imageSrc !== '' ? h($imageSrc) : $fallbackImage; ?>"
                         alt="<?php echo h($detail['judul'] ?? 'Karya'); ?>"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                </div>
            </div>
        </div>

        <!-- ========== KONTEN UTAMA ========== -->
        <!-- Konten: 2 kolom (Sidebar kiri + Konten kanan) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-16 fade-in-up delay-200">
            
            <!-- ========== SIDEBAR KIRI ========== -->
            <!-- Sidebar kiri: Metadata karya (kategori, tahun, tim, anggota) -->
            <div class="lg:col-span-4">
                <div class="bg-white rounded-xl border border-gray-200 p-6 sticky top-24">
                    <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-4 pb-3 border-b border-gray-200">Kategori</h3>
                    
                    <div class="space-y-4 text-sm">
                        <?php if (!empty($detail['nama_kategori'])): ?>
                            <div>
                                <p class="text-gray-500 mb-1">Nama Aplikasi</p>
                                <p class="font-semibold text-gray-900"><?php echo h($detail['nama_kategori']); ?></p>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($detail['tahun'])): ?>
                            <div>
                                <p class="text-gray-500 mb-1">Tahun</p>
                                <p class="font-semibold text-gray-900"><?php echo h((string) $detail['tahun']); ?></p>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($detail['nama_tim'])): ?>
                            <div>
                                <p class="text-gray-500 mb-1">Nama Tim</p>
                                <p class="font-semibold text-gray-900"><?php echo h($detail['nama_tim']); ?></p>
                            </div>
                        <?php endif; ?>
                        
                        <div>
                            <p class="text-gray-500 mb-2">Anggota Tim</p>
                            <div class="space-y-1">
                                <?php if (!empty($anggota) && is_array($anggota)): ?>
                                    <?php foreach ($anggota as $namaAnggota): ?>
                                        <p class="font-semibold text-gray-900"><?php echo h($namaAnggota); ?></p>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p class="text-gray-400 italic">Tidak ada anggota tim yang terdaftar.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========== KONTEN KANAN ========== -->
            <!-- Konten kanan: Judul & Deskripsi karya -->
            <div class="lg:col-span-8">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 leading-tight">
                    <?php echo h($detail['judul'] ?? 'Karya tidak ditemukan'); ?>
                </h1>

                <?php if (!empty($detail['isi_proyek'])): ?>
                    <div class="space-y-6">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900 mb-3">Latar Belakang</h2>
                            <div class="prose prose-lg max-w-none">
                                <p class="text-gray-700 leading-relaxed text-justify">
                                    <?php echo nl2br(h($detail['isi_proyek'])); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500 italic">Detail karya belum tersedia.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- ========== KARYA TERKAIT ========== -->
        <!-- Karya terkait lainnya (maksimal 3 karya) -->
        <?php if (!empty($relatedKarya)): ?>
            <section class="fade-in-up delay-300">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Lihat Karya Lainnya</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <?php foreach ($relatedKarya as $karya): ?>
                        <?php
                        $link = 'index.php?page=detailKarya';
                        if (!empty($karya['id'])) {
                            $link .= '&id=' . urlencode((string) $karya['id']);
                        }
                        $thumb = assetUrl($karya['gambar_proyek'] ?? ($karya['image'] ?? ''));
                        $text = trim(strip_tags($karya['isi_proyek'] ?? ($karya['excerpt'] ?? '')));
                        ?>
                        <a href="<?php echo h($link); ?>"
                           class="group bg-white rounded-xl border-2 border-gray-200 overflow-hidden hover:border-orange-400 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                            <div class="h-44 bg-gray-100 overflow-hidden relative">
                                <img src="<?php echo $thumb !== '' ? h($thumb) : $fallbackImage; ?>"
                                     alt="<?php echo h($karya['judul'] ?? 'Karya'); ?>"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <div class="p-5 space-y-3">
                                <h3 class="font-bold text-gray-900 group-hover:text-orange-600 transition-colors line-clamp-2">
                                    <?php echo h($karya['judul'] ?? 'Aplikasi Smart Kampus'); ?>
                                </h3>
                                <button class="w-full bg-orange-500 text-white text-sm font-semibold py-2.5 px-4 rounded-lg hover:bg-orange-600 transition-colors duration-200">
                                    Lihat Detail
                                </button>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>
    </div>
</main>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
