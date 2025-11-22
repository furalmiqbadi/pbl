<?php
session_start();

// dummy
if (!isset($_SESSION['data_seeded'])) {
    $_SESSION['hero'] = [
        'title' => 'Selamat Datang di Lab Multimedia',
        'subtitle' => 'Bangun pengalaman interaktif lewat game, UI/UX, dan AR/VR.',
        'cta' => 'Jelajahi Karya →',
        'image' => '../pbl/assets/images/image.png',
    ];
    $_SESSION['fokus'] = [
        ['icon' => '🎮', 'title' => 'Game Development', 'text' => 'Rancang gameplay, art, dan deployment multi-platform.'],
        ['icon' => '🎨', 'title' => 'UI/UX Design', 'text' => 'Prototyping, usability testing, dan design system yang konsisten.'],
        ['icon' => '🕶️', 'title' => 'AR/VR', 'text' => 'Immersive experience untuk training, edukasi, dan hiburan.'],
    ];
    $_SESSION['karya'] = [
        ['title' => 'Project A', 'category' => 'Game', 'image' => '/pbl/assets/images/image.png'],
        ['title' => 'Project B', 'category' => 'UI/UX', 'image' => '/pbl/assets/images/image.png'],
        ['title' => 'Project C', 'category' => 'AR/VR', 'image' => '/pbl/assets/images/image.png'],
        ['title' => 'Project D', 'category' => 'Game', 'image' => '/pbl/assets/images/image.png'],
        ['title' => 'Project E', 'category' => 'UI/UX', 'image' => '/pbl/assets/images/image.png'],
        ['title' => 'Project F', 'category' => 'AR/VR', 'image' => '/pbl/assets/images/image.png'],
        ['title' => 'Project G', 'category' => 'Game', 'image' => '/pbl/assets/images/image.png'],
        ['title' => 'Project H', 'category' => 'UI/UX', 'image' => '/pbl/assets/images/image.png'],
    ];
    $_SESSION['artikel'] = [
        ['title' => 'Artikel 1', 'date' => '2025-08-12', 'excerpt' => 'Consectetur adipiscing elit. Integer semper mattis nulla.', 'image' => '/pbl/assets/images/image.png'],
        ['title' => 'Artikel 2', 'date' => '2025-08-12', 'excerpt' => 'Aliquam erat volutpat. Proin sit amet eros sed lorem.', 'image' => '/pbl/assets/images/image.png'],
        ['title' => 'Artikel 3', 'date' => '2025-08-12', 'excerpt' => 'Pellentesque vel feugiat turpis purus.', 'image' => '/pbl/assets/images/image.png'],
    ];
    $_SESSION['data_seeded'] = true;
}

function getHero() { return $_SESSION['hero']; }
function updateHero($data) { $_SESSION['hero'] = array_merge($_SESSION['hero'], $data); }

function getFokus() { return $_SESSION['fokus']; }
function createFokus($item) { $_SESSION['fokus'][] = $item; }
function updateFokus($index, $item) { if (isset($_SESSION['fokus'][$index])) $_SESSION['fokus'][$index] = $item; }
function deleteFokus($index) { if (isset($_SESSION['fokus'][$index])) array_splice($_SESSION['fokus'], $index, 1); }

function getKarya() { return $_SESSION['karya']; }
function createKarya($item) { $_SESSION['karya'][] = $item; }
function updateKarya($index, $item) { if (isset($_SESSION['karya'][$index])) $_SESSION['karya'][$index] = $item; }
function deleteKarya($index) { if (isset($_SESSION['karya'][$index])) array_splice($_SESSION['karya'], $index, 1); }

function getArtikel() { return $_SESSION['artikel']; }
function createArtikel($item) { $_SESSION['artikel'][] = $item; }
function updateArtikel($index, $item) { if (isset($_SESSION['artikel'][$index])) $_SESSION['artikel'][$index] = $item; }
function deleteArtikel($index) { if (isset($_SESSION['artikel'][$index])) array_splice($_SESSION['artikel'], $index, 1); }

$hero = getHero();
$fokusItems = getFokus();
$karyaItems = getKarya();
$artikelItems = getArtikel();

// loop foto
$sliderTopItems = [];
$sliderBottomItems = [];
for ($i = 0; $i < 8; $i++) {
    $sliderTopItems[] = $karyaItems[$i % count($karyaItems)];
    $sliderBottomItems[] = array_reverse($karyaItems)[$i % count($karyaItems)];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab MMT - Beranda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Poppins', system-ui, -apple-system, sans-serif; background-color: #f4f5f7; color: #2f2f2f; }
        .smooth { transition: all 0.3s ease; }
        .card-shadow { box-shadow: 0 12px 30px rgba(0,0,0,0.06); }
        .slider-row { display: flex; gap: 16px; transition: transform 0.6s ease; }
        .slider-full { position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; }
    </style>
</head>
<body class="text-gray-800">

<?php include 'layouts/header.php'; ?>

<main class="max-w-6xl mx-auto px-4 py-10 space-y-16">
    <!-- Awal -->
    <section class="grid md:grid-cols-2 gap-8 items-center">
        <div class="bg-white rounded-2xl card-shadow p-6">
            <img src="<?php echo $hero['image']; ?>" alt="Hero" class="w-full h-80 object-cover rounded-xl bg-gray-200">
        </div>
        <div class="space-y-4">
            <p class="text-xl text-orange-600 font-semibold">Selamat Datang di</p>
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
                Lab <span class="text-orange-500">Multimedia</span>
            </h1>
            <p class="text-gray-600"><?php echo $hero['subtitle']; ?></p>
            <button class="bg-orange-500 text-white px-6 py-3 rounded-lg font-semibold smooth hover:bg-orange-600">
                <?php echo $hero['cta']; ?>
            </button>
        </div>
    </section>

    <!-- Fokus Utama -->
    <section class="space-y-8">
        <h2 class="text-3xl font-bold text-center">Fokus Utama Kami</h2>
        <div class="grid md:grid-cols-3 gap-6">
            <?php foreach ($fokusItems as $fokus): ?>
            <div class="bg-white rounded-xl card-shadow p-6 flex flex-col items-center text-center border border-gray-100">
                <div class="w-20 h-20 bg-orange-500 text-white text-3xl rounded-2xl flex items-center justify-center mb-4"><?php echo $fokus['icon']; ?></div>
                <h3 class="text-xl font-semibold mb-2"><?php echo $fokus['title']; ?></h3>
                <p class="text-gray-600 text-sm"><?php echo $fokus['text']; ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Karya Unggulan -->
    <section class="space-y-6">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-bold">Karya Unggulan Kami</h2>
            <div class="flex gap-2">
                <?php
                $categories = ['Semua', 'Game', 'UI/UX', 'AR/VR'];
                foreach ($categories as $cat):
                ?>
                <button data-filter="<?php echo $cat; ?>" class="filter-btn px-4 py-2 rounded-lg text-sm font-semibold border <?php echo $cat === 'Semua' ? 'bg-orange-500 text-white border-orange-500' : 'bg-gray-100 text-gray-700 border-gray-200'; ?>">
                    <?php echo $cat; ?>
                </button>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-6" id="karya-grid">
            <?php foreach (array_slice($karyaItems, 0, 3) as $karya): ?>
            <div class="bg-white rounded-xl card-shadow overflow-hidden border border-gray-100">
                <img src="<?php echo $karya['image']; ?>" alt="<?php echo $karya['title']; ?>" class="w-full h-44 object-cover bg-gray-200">
                <div class="p-4">
                    <p class="text-sm text-orange-500 font-semibold"><?php echo $karya['category']; ?></p>
                    <h3 class="text-lg font-semibold"><?php echo $karya['title']; ?></h3>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center">
            <button class="bg-orange-500 text-white px-6 py-3 rounded-lg font-semibold smooth hover:bg-orange-600">Lihat Selengkapnya →</button>
        </div>

        <!-- Slider tumpuk -->
        <div class="space-y-3 slider-full">
            <div class="overflow-hidden border border-gray-200 bg-white">
                <div id="slider-top" class="slider-row p-3">
                    <?php foreach ($sliderTopItems as $karya): ?>
                        <img src="<?php echo $karya['image']; ?>" alt="<?php echo $karya['title']; ?>" class="h-36 w-72 object-cover bg-gray-200 flex-shrink-0">
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="overflow-hidden border border-gray-200 bg-white">
                <div id="slider-bottom" class="slider-row p-3">
                    <?php foreach ($sliderBottomItems as $karya): ?>
                        <img src="<?php echo $karya['image']; ?>" alt="<?php echo $karya['title']; ?>" class="h-36 w-72 object-cover bg-gray-200 flex-shrink-0">
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Artikel & Berita -->
    <section class="space-y-6">
        <h2 class="text-3xl font-bold text-center">Artikel & Berita</h2>
        <div class="grid md:grid-cols-3 gap-6">
            <?php foreach ($artikelItems as $artikel): ?>
            <article class="bg-white rounded-xl card-shadow overflow-hidden border border-gray-100">
                <img src="<?php echo $artikel['image']; ?>" alt="<?php echo $artikel['title']; ?>" class="w-full h-40 object-cover bg-gray-200">
                <div class="p-4 space-y-2">
                    <h3 class="font-semibold text-lg"><?php echo $artikel['title']; ?></h3>
                    <p class="text-gray-600 text-sm"><?php echo $artikel['excerpt']; ?></p>
                    <p class="font-semibold text-sm"><?php echo $artikel['date']; ?></p>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
        <div class="text-center">
            <button class="bg-orange-500 text-white px-6 py-3 rounded-lg font-semibold smooth hover:bg-orange-600">Lihat Selengkapnya →</button>
        </div>
    </section>
</main>

<?php include 'layouts/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Filter karya (dummy)
    const buttons = document.querySelectorAll('.filter-btn');
    const grid = document.getElementById('karya-grid');
    const karyaData = <?php echo json_encode($karyaItems); ?>;

    buttons.forEach(btn => {
        btn.addEventListener('click', () => {
            buttons.forEach(b => b.classList.remove('bg-orange-500','text-white','border-orange-500'));
            buttons.forEach(b => b.classList.add('bg-gray-100','text-gray-700','border-gray-200'));
            btn.classList.add('bg-orange-500','text-white','border-orange-500');
            btn.classList.remove('bg-gray-100','text-gray-700','border-gray-200');

            const filter = btn.dataset.filter;
            const filtered = filter === 'Semua' ? karyaData : karyaData.filter(k => k.category === filter);
            grid.innerHTML = filtered.slice(0,3).map(k => `
                <div class="bg-white rounded-xl card-shadow overflow-hidden border border-gray-100">
                    <img src="${k.image}" alt="${k.title}" class="w-full h-44 object-cover bg-gray-200">
                    <div class="p-4">
                        <p class="text-sm text-orange-500 font-semibold">${k.category}</p>
                        <h3 class="text-lg font-semibold">${k.title}</h3>
                    </div>
                </div>
            `).join('');
        });
    });

    // Slider auto geser
    function setupSliderLoop(id, direction = 'right') {
        const el = document.getElementById(id);
        if (!el) return;
        const item = el.children[0];
        if (!item) return;
        const step = item.getBoundingClientRect().width + 16;

        const shiftLeft = () => {
            el.style.transition = 'transform 0.7s ease';
            el.style.transform = `translateX(-${step}px)`;
            const handler = () => {
                el.removeEventListener('transitionend', handler);
                el.appendChild(el.firstElementChild);
                el.style.transition = 'none';
                el.style.transform = 'translateX(0)';
            };
            el.addEventListener('transitionend', handler);
        };

        const shiftRight = () => {
            el.style.transition = 'none';
            el.insertBefore(el.lastElementChild, el.firstElementChild);
            el.style.transform = `translateX(-${step}px)`;
            requestAnimationFrame(() => {
                requestAnimationFrame(() => {
                    el.style.transition = 'transform 0.7s ease';
                    el.style.transform = 'translateX(0)';
                });
            });
        };

        setInterval(() => {
            if (direction === 'left') {
                shiftLeft();
            } else {
                shiftRight();
            }
        }, 3000);
    }

    setupSliderLoop('slider-top', 'right');
    setupSliderLoop('slider-bottom', 'left');
});
</script>
</body>
</html>
