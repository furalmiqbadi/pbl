<?php
// Helper function (jika belum ada di global)
if (!function_exists('h')) {
    function h($value) { return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8'); }
}

// --- SIMULASI DATA DUMMY (PENGGANTI DATABASE SEMENTARA) ---
// Nanti bagian ini diganti dengan pemanggilan ke Model
$dummyNews = [
    1 => [
        'id' => 1,
        'judul' => 'Mahasiswa Lab MMT Juara 1 Kompetisi AR Nasional',
        'kategori' => 'Prestasi',
        'tanggal' => '2025-11-12',
        'penulis' => 'Admin Lab',
        'gambar' => 'https://images.unsplash.com/photo-1551818255-e6e10975bc17?q=80&w=1000&auto=format&fit=crop',
        'isi' => "Tim riset Augmented Reality Lab MMT berhasil mengalahkan 50 universitas lain dengan inovasi aplikasi edukasi sejarah berbasis lokasi. Simak kisah perjuangan mereka dari persiapan hingga final.\n\nKompetisi ini diadakan di Jakarta dan diikuti oleh berbagai universitas ternama. Tim kami yang terdiri dari 3 orang mahasiswa semester 5 berhasil memukau juri dengan konsep aplikasi 'Jelajah Sejarah' yang menggabungkan teknologi AR Markerless dengan GPS.\n\n'Kami sangat bersyukur atas pencapaian ini. Ini membuktikan bahwa mahasiswa Polinema mampu bersaing di tingkat nasional,' ujar ketua tim."
    ],
    2 => [
        'id' => 2,
        'judul' => 'Workshop UI/UX Design Dasar: Mendesain untuk Pengguna',
        'kategori' => 'Workshop',
        'tanggal' => '2025-11-10',
        'penulis' => 'Divisi Kreatif',
        'gambar' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=800&q=80',
        'isi' => "Pelajari dasar-dasar desain antarmuka pengguna dan cara membuat layout yang responsif untuk aplikasi mobile modern menggunakan Figma. Workshop ini dihadiri oleh lebih dari 50 peserta dari berbagai jurusan.\n\nPemateri dalam workshop ini adalah praktisi UI/UX senior yang berbagi tips tentang *User Research*, *Wireframing*, hingga *Prototyping*. Peserta juga diajak langsung mempraktikkan materi dengan membuat desain aplikasi sederhana."
    ],
    // Tambahkan data dummy lain jika perlu
];

// Ambil ID dari URL (contoh: news_detail.php?id=1)
$id = isset($_GET['id']) ? (int)$_GET['id'] : 1; // Default ke ID 1 jika tidak ada

// Cari berita berdasarkan ID
$newsItem = $dummyNews[$id] ?? null;

// Jika tidak ketemu, pakai data default/kosong agar tidak error
if (!$newsItem) {
    $newsItem = $dummyNews[1]; // Fallback ke berita pertama
}

include '../layouts/header.php';
?>

<!-- Tailwind CDN (Jika belum ada di header) -->
<script src="https://cdn.tailwindcss.com"></script>

<main class="bg-white">
    
    <!-- 1. HEADER ARTIKEL -->
    <article class="max-w-4xl mx-auto px-4 pt-24 pb-12">
        
        <!-- Breadcrumb / Back Button -->
        <a href="news.php" class="inline-flex items-center text-sm font-semibold text-gray-500 hover:text-orange-500 transition-colors mb-8 group">
            <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Berita
        </a>

        <!-- Meta Data (Kategori & Tanggal) -->
        <div class="flex flex-wrap items-center gap-4 mb-6">
            <span class="px-3 py-1 rounded-full bg-orange-100 text-orange-600 font-bold uppercase text-xs tracking-wide">
                <?php echo h($newsItem['kategori']); ?>
            </span>
            <span class="text-gray-400 text-sm font-medium flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <?php echo date('d F Y', strtotime($newsItem['tanggal'])); ?>
            </span>
            <span class="text-gray-400 text-sm font-medium flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                <?php echo h($newsItem['penulis']); ?>
            </span>
        </div>

        <!-- Judul Utama -->
        <h1 class="font-heading font-extrabold text-3xl md:text-5xl text-gray-900 leading-tight mb-10">
            <?php echo h($newsItem['judul']); ?>
        </h1>

        <!-- Gambar Utama (Hero Image) -->
        <div class="w-full h-[300px] md:h-[500px] rounded-2xl overflow-hidden shadow-lg mb-12 relative bg-gray-100">
            <img src="<?php echo h($newsItem['gambar']); ?>" 
                 alt="<?php echo h($newsItem['judul']); ?>"
                 class="w-full h-full object-cover">
        </div>

        <!-- Isi Konten (Typography) -->
        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed font-sans">
            <!-- nl2br mengubah enter (\n) menjadi <br> agar paragraf terpisah -->
            <?php echo nl2br(h($newsItem['isi'])); ?>
        </div>

        <!-- Bagian Share -->
        <div class="mt-16 pt-8 border-t border-gray-200 flex flex-col md:flex-row items-center justify-between gap-4">
            <span class="font-bold text-gray-900">Bagikan Artikel Ini:</span>
            <div class="flex gap-3">
                <button class="p-3 rounded-full bg-gray-100 hover:bg-green-500 hover:text-white transition-all" title="WhatsApp">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                </button>
                <button class="p-3 rounded-full bg-gray-100 hover:bg-blue-500 hover:text-white transition-all" title="Twitter">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                </button>
                <button class="p-3 rounded-full bg-gray-100 hover:bg-gray-700 hover:text-white transition-all" title="Copy Link">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                </button>
            </div>
        </div>

    </article>

    <!-- 2. REKOMENDASI / BACA JUGA -->
    <section class="bg-gray-50 py-16">
        <div class="max-w-screen-xl mx-auto px-4">
            <h3 class="font-heading font-bold text-2xl text-gray-800 mb-8 pl-4 border-l-4 border-orange-500">
                Baca Juga
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php 
                // Ambil 3 berita lain (logic sederhana: ambil selain ID yg sedang dibuka)
                $relatedNews = array_filter($dummyNews, function($n) use ($id) { return $n['id'] !== $id; });
                // Kalau kosong (misal cuma ada 1 berita), ambil array kosong
                if (empty($relatedNews)) $relatedNews = [];
                ?>

                <?php foreach($relatedNews as $related): ?>
                <a href="news_detail.php?id=<?php echo $related['id']; ?>" class="group bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300">
                    <div class="h-40 overflow-hidden relative">
                        <img src="<?php echo h($related['gambar']); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <span class="absolute top-2 left-2 bg-white/90 px-2 py-1 rounded text-xs font-bold text-gray-800"><?php echo h($related['kategori']); ?></span>
                    </div>
                    <div class="p-4">
                        <h4 class="font-bold text-gray-800 group-hover:text-orange-500 transition-colors line-clamp-2 mb-2">
                            <?php echo h($related['judul']); ?>
                        </h4>
                        <p class="text-xs text-gray-400"><?php echo date('d M Y', strtotime($related['tanggal'])); ?></p>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

</main>

<?php include '../layouts/footer.php'; ?>