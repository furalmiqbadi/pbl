<?php
session_start();
require_once __DIR__ . '/model/VisitorModel.php';
$visitorModel = new VisitorModel();
$visitorModel->rekamKunjungan();
require_once __DIR__ . '/controller/HomeController.php';

$basePath = '/pbl';

function h($value)
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function assetUrl(string $src): string
{
    global $basePath;
    if ($src === '') {
        return '';
    }
    if (preg_match('~^(https?:)?//~', $src)) {
        return $src;
    }
    return rtrim($basePath, '/') . '/' . ltrim($src, '/');
}

function mapImageList(array $items, string $key = 'image'): array
{
    foreach ($items as &$item) {
        if (isset($item[$key])) {
            $item[$key] = assetUrl($item[$key]);
        }
    }
    return $items;
}


//sementara
$page = $_GET['page'] ?? 'home'; // Cek URL, mau ke mana?

if ($page === 'news') {
    require_once __DIR__ . '/controller/NewsController.php';
    $controller = new NewsController();
    $controller->index();
    exit; 
}

if ($page === 'news_detail') {
    require_once __DIR__ . '/controller/NewsController.php';
    $controller = new NewsController();
    $controller->detail();
    exit;
}

if ($page === 'about') {
    require_once __DIR__ . '/controller/AboutController.php';
    $controller = new AboutController();
    $controller->index();
    exit;
}

if ($page === 'catalog') { 
    include __DIR__ . '/view/catalog.php';
    exit;
}

if ($page === 'gallery') {
    require_once __DIR__ . '/model/GaleriModel.php';
    $galeriModel = new GaleriModel();
    
    $limit = 9; 
    $p = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;
    if ($p < 1) $p = 1;
    
    $offset = ($p - 1) * $limit;
    
    $totalData = $galeriModel->countAll(); 
    $totalPages = ceil($totalData / $limit);
    
    if ($p > $totalPages && $totalPages > 0) {
        $p = $totalPages;
        $offset = ($p - 1) * $limit;
    }

    $data = $galeriModel->getPaginated($limit, $offset);
    
    $currentPage = $p; 
    include __DIR__ . '/view/gallery.php';
    exit;
}

if ($page === 'detailKarya') {
    require_once __DIR__ . '/model/KaryaModel.php';
    $karyaModel = new KaryaModel();
    $karyaId = isset($_GET['id']) ? (int) $_GET['id'] : null;
    $karyaItem = $karyaId ? $karyaModel->getById($karyaId) : null;
    $allKarya = $karyaModel->getAll();
    include __DIR__ . '/view/karya_detail.php';
    exit;
}

if ($page === 'detailGallery') {
    require_once __DIR__ . '/model/GaleriModel.php';
    $galeriModel = new GaleriModel();
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $detail = $galeriModel->getById($id);
    if (!$detail) {
        header("Location: index.php?page=gallery");
        exit;
    }
    $allGallery = $galeriModel->getAll();
    $sidebarGallery = array_filter($allGallery, function($item) use ($id) {
        return (int)$item['id'] !== $id;
    });
    $sidebarGallery = array_slice($sidebarGallery, 0, 3);

    include __DIR__ . '/view/detailGallery.php';
    exit;
}
//sampai sini 

$controller = new HomeController();
$data = $controller->index();

$hero = $data['hero'] ?? [];
$heroImage = assetUrl($hero['image'] ?? '');
$heroImage = assetUrl('assets/images/mmtLogo.png');
$hero['image'] = $heroImage;
$fokusItems = $data['fokus'] ?? [];
$karyaItems = mapImageList($data['karya'] ?? []);
$artikelItems = mapImageList($data['artikel'] ?? []);
$galleryTop = mapImageList($data['galleryTop'] ?? []);
$galleryBottom = mapImageList($data['galleryBottom'] ?? []);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab MMT - Beranda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --accent: #f97316;
            --ink: #0f172a;
        }

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
        
        /* PULSE ANIMATION - Untuk dot/badge yang berkedip */
        /* Digunakan di: 
           - Badge "Selamat Datang" di hero section
           - Badge di setiap section header (Fokus Utama, Galeri, dll)
        */
        /* Cara kerja: Opacity berubah dari 1 (100%) ke 0.5 (50%) lalu kembali ke 1 */
        /* Duration: 2 detik per cycle, infinite loop */
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

        /* FLOAT ANIMATION - Untuk logo yang melayang naik-turun */
        /* Digunakan di: Logo/maskot di hero section */
        /* Cara kerja: Logo bergerak naik 20px lalu turun kembali ke posisi awal */
        /* Duration: 6 detik per cycle, infinite loop, smooth easing */
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

        /* LIGHTBOX ANIMATIONS - Untuk gallery lightbox */
        /* fadeIn: muncul dari transparan ke solid */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* fadeOut: hilang dari solid ke transparan */
        @keyframes fadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }

        /* zoomIn: zoom dari 80% ke 100% sambil fade in */
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

        /* fadeInUp: muncul dari bawah sambil fade in - untuk scroll reveal */
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

        /* slideInLeft: muncul dari kiri */
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

        /* slideInRight: muncul dari kanan */
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

        /* scaleIn: zoom in dengan fade */
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

        /* shimmer: efek loading shimmer */
        @keyframes shimmer {
            0% {
                background-position: -1000px 0;
            }
            100% {
                background-position: 1000px 0;
            }
        }

        /* Class untuk elemen yang akan muncul saat scroll */
        .scroll-reveal {
            opacity: 0;
        }

        .scroll-reveal.animate-in {
            animation: fadeInUp 0.8s ease-out forwards;
        }

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

        /* Delay untuk animasi berurutan */
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
        .delay-500 { animation-delay: 0.5s; }
        .delay-600 { animation-delay: 0.6s; }

        /* Parallax effect */
        .parallax {
            transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        /* Enhanced hover effects */
        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        /* Smooth gradient animation */
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
        // Galeri marquee: 4 tampilan, auto geser, pause on hover
        document.addEventListener('DOMContentLoaded', () => {
            const galleryTopData = <?php echo json_encode($galleryTop, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT); ?>;
            const galleryBottomData = <?php echo json_encode($galleryBottom, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT); ?>;
            const karyaData = <?php echo json_encode($karyaItems, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT); ?>;

            // ========== GALLERY MARQUEE FUNCTION ==========
            // Fungsi untuk membuat gallery scroll otomatis (marquee)
            // Parameters:
            //   - rowId: ID container row gallery
            //   - trackId: ID track yang berisi gambar-gambar
            //   - data: Array data gambar
            //   - direction: 1 = kanan, -1 = kiri
            function startGalleryMarquee(rowId, trackId, data, direction = 1) {
                const row = document.getElementById(rowId);
                const track = document.getElementById(trackId);
                if (!row || !track || !data || data.length === 0) return;

                // Duplikasi data agar minimal 4 item untuk smooth loop
                while (data.length < 4) data = data.concat(data);
                const repeated = [...data, ...data];
                // Render gallery cards dengan event listener untuk lightbox
                track.innerHTML = repeated.map((item, index) => `
            <div class="gallery-card" data-image="${item.image}" data-index="${index}">
                <img src="${item.image}" alt="Galeri" class="w-full h-full object-cover cursor-pointer">
            </div>
        `).join('');

                // Event listener untuk buka lightbox saat klik gambar
                track.querySelectorAll('.gallery-card').forEach(card => {
                    card.addEventListener('click', () => {
                        const imgSrc = card.dataset.image;
                        openLightbox(imgSrc);
                    });
                });

                let offset = direction === -1 ? (track.firstElementChild?.getBoundingClientRect().width || 0) * data.length : 0;
                let cardWidth = 0;
                let loopWidth = 0;
                let paused = false; // Flag untuk pause saat hover

                // Fungsi untuk mengukur lebar card dan set posisi awal
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

                // Pause animasi saat hover, resume saat mouse keluar
                row.addEventListener('mouseenter', () => paused = true);
                row.addEventListener('mouseleave', () => paused = false);

                const speed = 0.6; // Kecepatan scroll (pixels per frame)
                // Fungsi animasi loop menggunakan requestAnimationFrame
                function step() {
                    if (!paused) {
                        offset += direction * speed;
                        track.style.transform = `translateX(${-offset}px)`;
                        // Reset posisi untuk infinite loop
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

            // Fungsi untuk membuka lightbox (zoom gambar)
            function openLightbox(imageSrc) {
                // Create lightbox overlay dengan background hitam transparan
                const lightbox = document.createElement('div');
                lightbox.id = 'gallery-lightbox';
                lightbox.className = 'fixed inset-0 bg-black/90 z-50 flex items-center justify-center p-4 cursor-pointer';
                lightbox.style.animation = 'fadeIn 0.3s ease-out';
                
                // Container untuk gambar dengan animasi zoom
                const imgContainer = document.createElement('div');
                imgContainer.className = 'relative max-w-7xl max-h-full';
                imgContainer.style.animation = 'zoomIn 0.3s ease-out';
                
                // Gambar dengan max height 90% viewport
                const img = document.createElement('img');
                img.src = imageSrc;
                img.className = 'max-w-full max-h-[90vh] object-contain rounded-lg shadow-2xl';
                img.style.cursor = 'default';
                
                // Prevent klik gambar menutup lightbox
                img.addEventListener('click', (e) => {
                    e.stopPropagation();
                });
                
                // Tombol close (X) di pojok kanan atas
                const closeBtn = document.createElement('button');
                closeBtn.innerHTML = '&times;';
                closeBtn.className = 'absolute -top-12 right-0 text-white text-4xl font-light hover:text-orange-400 transition-colors';
                closeBtn.addEventListener('click', closeLightbox);
                
                imgContainer.appendChild(img);
                imgContainer.appendChild(closeBtn);
                lightbox.appendChild(imgContainer);
                document.body.appendChild(lightbox);
                
                // Close saat klik di luar gambar
                lightbox.addEventListener('click', closeLightbox);
                
                // Close saat tekan tombol ESC
                document.addEventListener('keydown', handleEscKey);
                
                // Prevent scroll body saat lightbox terbuka
                document.body.style.overflow = 'hidden';
            }
            
            // Fungsi untuk menutup lightbox dengan animasi fade out
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
            
            // Handle tombol ESC untuk tutup lightbox
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

            // Fungsi untuk render karya ke grid (max 3 items)
            function renderKarya(list) {
                karyaGrid.innerHTML = list.slice(0, 3).map(k => {
                    const detailUrl = k.id ? `index.php?page=detailKarya&id=${encodeURIComponent(k.id)}&from=home` : 'index.php?page=detailKarya&from=home';
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
                    filterButtons.forEach(b => b.classList.remove('bg-orange-500', 'text-white', 'border-orange-500', 'shadow-sm'));
                    filterButtons.forEach(b => b.classList.add('bg-white', 'text-gray-700', 'border-gray-200'));
                    btn.classList.add('bg-orange-500', 'text-white', 'border-orange-500', 'shadow-sm');
                    btn.classList.remove('bg-white', 'text-gray-700', 'border-gray-200');

                    const filter = btn.dataset.filter;
                    const filtered = filter === 'Semua' ? karyaData : karyaData.filter(k => k.category === filter);
                    renderKarya(filtered);
                });
            });

            // ========== PARALLAX EFFECT FOR HERO LOGO ==========
            // Menambahkan efek parallax pada logo hero yang mengikuti gerakan mouse
            const heroLogo = document.getElementById('hero-logo');
            if (heroLogo) {
                document.addEventListener('mousemove', (e) => {
                    // Hitung posisi mouse relatif terhadap center viewport
                    const mouseX = e.clientX / window.innerWidth - 0.5;
                    const mouseY = e.clientY / window.innerHeight - 0.5;
                    
                    // Terapkan transformasi dengan multiplier untuk efek subtle
                    // Nilai kecil (20px) agar tidak terlalu berlebihan
                    const moveX = mouseX * 20;
                    const moveY = mouseY * 20;
                    
                    heroLogo.style.transform = `translate(${moveX}px, ${moveY}px)`;
                });
            }

            // ========== SCROLL REVEAL ANIMATION ==========
            // Intersection Observer untuk trigger animasi saat elemen masuk viewport
            const observerOptions = {
                root: null, // viewport
                rootMargin: '0px',
                threshold: 0.1 // trigger saat 10% elemen terlihat
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Tambahkan class untuk trigger animasi
                        entry.target.classList.add('animate-in');
                        // Optional: unobserve setelah animasi (animasi hanya sekali)
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            // Observe semua elemen dengan class scroll-reveal
            document.querySelectorAll('.scroll-reveal').forEach(el => {
                observer.observe(el);
            });
        });
    </script>
</body>

</html>
