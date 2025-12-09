<?php
// ========== INISIALISASI APLIKASI ==========
// Memulai session untuk menyimpan data user
session_start();

// Merekam kunjungan pengunjung ke database
require_once __DIR__ . '/model/VisitorModel.php';
$visitorModel = new VisitorModel();
$visitorModel->rekamKunjungan();

// Load controller utama
require_once __DIR__ . '/controller/HomeController.php';

// Base path untuk URL
$basePath = '/pbl';

// ========== FUNGSI HELPER ==========
// Fungsi untuk escape HTML (mencegah XSS attack)
function h($value)
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

// Fungsi untuk membuat URL asset (gambar, CSS, JS)
function assetUrl(string $src): string
{
    global $basePath;
    // Return kosong jika source kosong
    if ($src === '') {
        return '';
    }
    // Jika sudah URL lengkap (http/https), langsung return
    if (preg_match('~^(https?:)?//~', $src)) {
        return $src;
    }
    // Gabungkan dengan base path
    return rtrim($basePath, '/') . '/' . ltrim($src, '/');
}

// Fungsi untuk mapping URL gambar pada array items
function mapImageList(array $items, string $key = 'image'): array
{
    foreach ($items as &$item) {
        if (isset($item[$key])) {
            $item[$key] = assetUrl($item[$key]);
        }
    }
    return $items;
}


// ========== ROUTING HALAMAN ==========
// Ambil parameter page dari URL, default ke 'home'
$page = $_GET['page'] ?? 'home';

// Route untuk halaman daftar berita
if ($page === 'news') {
    require_once __DIR__ . '/controller/NewsController.php';
    $controller = new NewsController();
    $controller->index();
    exit; 
}

// Route untuk halaman detail berita
if ($page === 'news_detail') {
    require_once __DIR__ . '/controller/NewsController.php';
    $controller = new NewsController();
    $controller->detail();
    exit;
}

// Route untuk halaman tentang kami
if ($page === 'about') {
    require_once __DIR__ . '/controller/AboutController.php';
    $controller = new AboutController();
    $controller->index();
    exit;
}

// Route untuk halaman katalog karya
if ($page === 'catalog') { 
    require_once __DIR__ . '/controller/KatalogController.php';
    $controller = new KatalogController();
    $controller->index();
    exit;
}

// Route untuk halaman galeri dengan pagination
if ($page === 'gallery') {
    require_once __DIR__ . '/model/GaleriModel.php';
    $galeriModel = new GaleriModel();
    
    // Setup pagination (9 item per halaman)
    $limit = 9; 
    $p = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;
    if ($p < 1) $p = 1;
    
    // Hitung offset untuk query database
    $offset = ($p - 1) * $limit;
    
    // Hitung total halaman
    $totalData = $galeriModel->countAll(); 
    $totalPages = ceil($totalData / $limit);
    
    // Validasi halaman tidak melebihi total halaman
    if ($p > $totalPages && $totalPages > 0) {
        $p = $totalPages;
        $offset = ($p - 1) * $limit;
    }

    // Ambil data galeri dengan pagination
    $data = $galeriModel->getPaginated($limit, $offset);
    
    $currentPage = $p; 
    include __DIR__ . '/view/gallery.php';
    exit;
}

// Route untuk halaman detail karya
if ($page === 'detailKarya') {
    require_once __DIR__ . '/model/KaryaModel.php';
    $karyaModel = new KaryaModel();
    // Ambil ID karya dari URL
    $karyaId = isset($_GET['id']) ? (int) $_GET['id'] : null;
    // Ambil data karya berdasarkan ID
    $karyaItem = $karyaId ? $karyaModel->getById($karyaId) : null;
    // Ambil semua karya untuk "Karya Lainnya"
    $allKarya = $karyaModel->getAll();
    // Ambil daftar anggota tim
    $anggota = $karyaId ? $karyaModel->getAnggotaTim($karyaId) : [];
    include __DIR__ . '/view/karya_detail.php';
    exit;
}

// Route untuk halaman detail galeri
if ($page === 'detailGallery') {
    require_once __DIR__ . '/model/GaleriModel.php';
    $galeriModel = new GaleriModel();
    // Ambil ID galeri dari URL
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $detail = $galeriModel->getById($id);
    // Redirect jika galeri tidak ditemukan
    if (!$detail) {
        header("Location: index.php?page=gallery");
        exit;
    }
    // Ambil galeri lainnya untuk sidebar (kecuali yang sedang dibuka)
    $allGallery = $galeriModel->getAll();
    $sidebarGallery = array_filter($allGallery, function($item) use ($id) {
        return (int)$item['id'] !== $id;
    });
    $sidebarGallery = array_slice($sidebarGallery, 0, 3);

    include __DIR__ . '/view/gallery_detail.php';
    exit;
}


// ========== HALAMAN HOME (DEFAULT) ==========
// Jika tidak ada route yang cocok, tampilkan halaman home
$controller = new HomeController();
$data = $controller->index();

// Setup data hero section
$hero = $data['hero'] ?? [];
$heroImage = assetUrl($hero['image'] ?? '');
$heroImage = assetUrl('assets/images/mmtLogo.png');
$hero['image'] = $heroImage;

// Setup data fokus utama (Game, UI/UX, AR/VR)
$fokusItems = $data['fokus'] ?? [];

// Setup data karya dan artikel dengan URL gambar yang sudah di-mapping
$karyaItems = mapImageList($data['karya'] ?? []);
$artikelItems = mapImageList($data['artikel'] ?? []);

// Setup kategori berita untuk filter
$newsCategories = ['Semua'];
$dbCategories = $data['newsCategories'] ?? [];
foreach ($dbCategories as $cat) {
    if (!in_array($cat, $newsCategories, true)) {
        $newsCategories[] = $cat;
    }
}

// Setup data galeri untuk marquee scroll
$galleryTop = mapImageList($data['galleryTop'] ?? []);
$galleryBottom = mapImageList($data['galleryBottom'] ?? []);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab MMT - Beranda</title>
    <link rel="icon" href="assets/images/mmtLogo.png" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* ========== CSS VARIABLES ========== */
        :root {
            --accent: #f97316;  /* Warna orange utama */
            --ink: #0f172a;     /* Warna teks gelap */
        }

        /* ========== GLOBAL STYLES ========== */
        body {
            font-family: 'Poppins', system-ui, -apple-system, sans-serif;
            background-color: #ffffff;
            color: #2f2f2f;
        }

        .smooth {
            transition: all 0.3s ease;
        }

        .card-outline {
            border: 1px solid #dcdfe5;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.04);
        }

        .pill {
            display: inline-block;
            padding: 8px 14px;
            border-radius: 999px;
            font-weight: 600;
            font-size: 13px;
            background: #f97316;
            color: #fff;
        }

        .gallery-row {
            overflow: hidden;
        }

        .gallery-track {
            display: flex;
            gap: 0;
            will-change: transform;
        }

        .gallery-card {
            flex: 0 0 25%;
            position: relative;
            aspect-ratio: 4 / 3;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #dcdfe5;
            background: #0f172a;
        }

        .gallery-card img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .gallery-card:hover img {
            transform: scale(1.08);
        }

        /* ========== ANIMATIONS ========== */
        
        /* Pulse animation untuk badge (dot berkedip) */
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }

        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        /* Float animation untuk logo hero (naik-turun halus) */
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        /* Lightbox animations (popup gambar galeri) */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }

        @keyframes zoomIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Fade in dari bawah */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Slide animations */
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Scale in animation */
        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Shimmer effect */
        @keyframes shimmer {
            0% {
                background-position: -1000px 0;
            }
            100% {
                background-position: 1000px 0;
            }
        }

        /* Scroll reveal animation (muncul saat di-scroll) */
        .scroll-reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .scroll-reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Hero section animations (slide masuk dari kiri/kanan) */
        .slide-in-left {
            opacity: 0;
            animation: slideInLeft 0.8s ease-out forwards;
        }

        .slide-in-right {
            opacity: 0;
            animation: slideInRight 0.8s ease-out forwards;
        }

        .scale-in {
            opacity: 0;
            animation: scaleIn 0.6s ease-out forwards;
        }

        /* Animation delays */
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
        .delay-500 { animation-delay: 0.5s; }
        .delay-600 { animation-delay: 0.6s; }

        /* Parallax effect (logo mengikuti mouse) */
        .parallax {
            transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        /* Hover effects */
        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        /* Gradient animation */
        .gradient-shift {
            background-size: 200% 200%;
            animation: gradientShift 3s ease infinite;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>
</head>

<body class="text-gray-800">

    <?php include __DIR__ . '/layouts/header.php'; ?>
    <?php include __DIR__ . '/view/home.php'; ?>
    <?php include __DIR__ . '/layouts/footer.php'; ?>

    <script>
        // ========== JAVASCRIPT UNTUK INTERAKTIVITAS ==========
        
        // Gallery marquee auto scroll (galeri bergerak otomatis)
        document.addEventListener('DOMContentLoaded', () => {
            const galleryTopData = <?php echo json_encode($galleryTop, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT); ?>;
            const galleryBottomData = <?php echo json_encode($galleryBottom, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT); ?>;
            const karyaData = <?php echo json_encode($karyaItems, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT); ?>;

            // Gallery marquee function
            function startGalleryMarquee(rowId, trackId, data, direction = 1) {
                const row = document.getElementById(rowId);
                const track = document.getElementById(trackId);
                if (!row || !track || !data || data.length === 0) return;

                // Duplicate data untuk smooth loop
                while (data.length < 4) data = data.concat(data);
                const repeated = [...data, ...data];
                // Render gallery cards
                track.innerHTML = repeated.map((item, index) => `
            <div class="gallery-card" data-image="${item.image}" data-index="${index}">
                <img src="${item.image}" alt="Galeri" class="w-full h-full object-cover cursor-pointer">
            </div>
        `).join('');

                // Click handler untuk lightbox
                track.querySelectorAll('.gallery-card').forEach(card => {
                    card.addEventListener('click', () => {
                        const imgSrc = card.dataset.image;
                        openLightbox(imgSrc);
                    });
                });

                let offset = direction === -1 ? (track.firstElementChild?.getBoundingClientRect().width || 0) * data.length : 0;
                let cardWidth = 0;
                let loopWidth = 0;
                let paused = false;

                // Measure card width
                const measure = () => {
                    const firstCard = track.querySelector('.gallery-card');
                    if (firstCard) {
                        cardWidth = firstCard.getBoundingClientRect().width;
                        loopWidth = cardWidth * data.length;
                        if (direction === -1) offset = loopWidth;
                        track.style.transform = `translateX(${-offset}px)`;
                    }
                };
                measure();
                window.addEventListener('resize', measure);

                // Pause on hover
                row.addEventListener('mouseenter', () => paused = true);
                row.addEventListener('mouseleave', () => paused = false);

                const speed = 0.6;
                // Animation loop
                function step() {
                    if (!paused) {
                        offset += direction * speed;
                        track.style.transform = `translateX(${-offset}px)`;
                        // Reset untuk infinite loop
                        if (cardWidth > 0) {
                            const threshold = loopWidth;
                            if (direction === 1 && offset >= threshold) offset = 0;
                            if (direction === -1 && offset <= 0) offset = threshold;
                        }
                    }
                    requestAnimationFrame(step);
                }
                requestAnimationFrame(step);
            }

            // Open lightbox
            function openLightbox(imageSrc) {
                // Create lightbox overlay
                const lightbox = document.createElement('div');
                lightbox.id = 'gallery-lightbox';
                lightbox.className = 'fixed inset-0 bg-black/90 z-50 flex items-center justify-center p-4 cursor-pointer';
                lightbox.style.animation = 'fadeIn 0.3s ease-out';
                
                // Image container
                const imgContainer = document.createElement('div');
                imgContainer.className = 'relative max-w-7xl max-h-full';
                imgContainer.style.animation = 'zoomIn 0.3s ease-out';
                
                // Image element
                const img = document.createElement('img');
                img.src = imageSrc;
                img.className = 'max-w-full max-h-[90vh] object-contain rounded-lg shadow-2xl';
                img.style.cursor = 'default';
                
                // Prevent close on image click
                img.addEventListener('click', (e) => {
                    e.stopPropagation();
                });
                
                // Close button
                const closeBtn = document.createElement('button');
                closeBtn.innerHTML = '&times;';
                closeBtn.className = 'absolute -top-12 right-0 text-white text-4xl font-light hover:text-orange-400 transition-colors';
                closeBtn.addEventListener('click', closeLightbox);
                
                imgContainer.appendChild(img);
                imgContainer.appendChild(closeBtn);
                lightbox.appendChild(imgContainer);
                document.body.appendChild(lightbox);
                
                // Close handlers
                lightbox.addEventListener('click', closeLightbox);
                document.addEventListener('keydown', handleEscKey);
                document.body.style.overflow = 'hidden';
            }
            
            // Close lightbox
            function closeLightbox() {
                const lightbox = document.getElementById('gallery-lightbox');
                if (lightbox) {
                    lightbox.style.animation = 'fadeOut 0.2s ease-out';
                    setTimeout(() => {
                        lightbox.remove();
                        document.body.style.overflow = '';
                        document.removeEventListener('keydown', handleEscKey);
                    }, 200);
                }
            }
            
            // ESC key handler
            function handleEscKey(e) {
                if (e.key === 'Escape') {
                    closeLightbox();
                }
            }

            startGalleryMarquee('gallery-row-top', 'gallery-track-top', [...galleryTopData], 1);
            startGalleryMarquee('gallery-row-bottom', 'gallery-track-bottom', [...galleryBottomData], -1);

            // Filter karya berdasarkan kategori
            const filterButtons = document.querySelectorAll('.karya-filter');
            const karyaGrid = document.getElementById('karya-grid');

            // Render karya grid
            function renderKarya(list) {
                karyaGrid.innerHTML = list.slice(0, 3).map(k => {
                    const detailUrl = k.id ? `index.php?page=detailKarya&id=${encodeURIComponent(k.id)}` : 'index.php?page=detailKarya';
                    const excerpt = k.excerpt && k.excerpt !== '' ? k.excerpt : 'Detail singkat akan tampil di sini.';
                    return `
                <a href="${detailUrl}" class="block bg-white rounded-2xl shadow-[0_12px_35px_-18px_rgba(15,23,42,0.35)] overflow-hidden border border-slate-200/70 hover:shadow-lg hover:-translate-y-1 transition">
                    <div class="w-full h-44 bg-gray-200 overflow-hidden">
                        ${k.image ? `<img src="${k.image}" alt="${k.title || ''}" class="w-full h-full object-cover">` : ''}
                    </div>
                    <div class="p-4 space-y-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-[#feedd8] text-orange-700 text-xs font-semibold border border-orange-200">${k.category || ''}</span>
                        <h3 class="text-lg font-semibold text-gray-800">${k.title || ''}</h3>
                        <p class="text-sm text-gray-500 line-clamp-2">${excerpt}</p>
                    </div>
                </a>
            `;
                }).join('');
            }

            renderKarya(karyaData);

            filterButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    filterButtons.forEach(b => b.classList.remove('bg-orange-500', 'text-white', 'border-orange-500', 'shadow-md'));
                    filterButtons.forEach(b => b.classList.add('bg-white', 'text-orange-600'));
                    btn.classList.add('bg-orange-500', 'text-white', 'border-orange-500', 'shadow-md');
                    btn.classList.remove('bg-white', 'text-orange-600');

                    const filter = btn.dataset.filter;
                    const filtered = filter === 'Semua' ? karyaData : karyaData.filter(k => k.category === filter);
                    renderKarya(filtered);
                });
            });

            // Filter berita
            const newsFilterButtons = document.querySelectorAll('.news-filter');
            const newsGrid = document.getElementById('news-grid');
            const newsData = <?php echo json_encode($artikelItems); ?>;

            // Render news grid
            function renderNews(list) {
                newsGrid.innerHTML = list.slice(0, 3).map(n => {
                    const detailUrl = n.id ? `index.php?page=news_detail&id=${encodeURIComponent(n.id)}` : 'index.php?page=news_detail';
                    return `
                <a href="${detailUrl}" class="group bg-white rounded-xl card-outline overflow-hidden block hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                    ${n.image ? `
                        <div class="w-full h-40 overflow-hidden bg-gray-200">
                            <img src="${n.image}" alt="${n.title || ''}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                    ` : '<div class="w-full h-40 bg-gray-200"></div>'}
                    <div class="p-4 space-y-2">
                        <p class="text-sm text-orange-500 font-semibold">${n.date || ''}</p>
                        <h3 class="font-semibold text-lg text-gray-800 group-hover:text-orange-600 transition-colors">${n.title || ''}</h3>
                        <p class="text-gray-600 text-sm leading-relaxed line-clamp-2">${n.excerpt || ''}</p>
                    </div>
                </a>
            `;
                }).join('');
            }

            renderNews(newsData);

            newsFilterButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    newsFilterButtons.forEach(b => b.classList.remove('bg-orange-500', 'text-white', 'border-orange-500', 'shadow-md'));
                    newsFilterButtons.forEach(b => b.classList.add('bg-white', 'text-orange-600'));
                    btn.classList.add('bg-orange-500', 'text-white', 'border-orange-500', 'shadow-md');
                    btn.classList.remove('bg-white', 'text-orange-600');

                    const filter = btn.dataset.filterNews;
                    const filtered = filter === 'Semua' ? newsData : newsData.filter(n => n.category === filter);
                    renderNews(filtered);
                });
            });

            // Parallax effect untuk hero logo
            const heroLogo = document.getElementById('hero-logo');
            if (heroLogo) {
                document.addEventListener('mousemove', (e) => {
                    const mouseX = e.clientX / window.innerWidth - 0.5;
                    const mouseY = e.clientY / window.innerHeight - 0.5;
                    const moveX = mouseX * 20;
                    const moveY = mouseY * 20;
                    
                    heroLogo.style.transform = `translate(${moveX}px, ${moveY}px)`;
                });
            }
            
            // Scroll reveal animation
            
            const scrollObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            // Observe scroll-reveal elements
            document.querySelectorAll('.scroll-reveal').forEach(el => {
                scrollObserver.observe(el);
            });
        });
    </script>
</body>

</html>
