<?php
session_start();

// Dummy
if (!isset($_SESSION['data_seeded'])) {
    $_SESSION['hero'] = [
        'title' => 'Selamat Datang di Lab Multimedia',
        'subtitle' => 'Bangun pengalaman interaktif lewat game, UI/UX, dan AR/VR.',
        'cta' => 'Jelajahi Karya →',
        'image' => 'assets/images/mmtLogo.png',
    ];
    $_SESSION['fokus'] = [
        ['icon' => '🎮', 'title' => 'Game Development', 'text' => 'Rancang gameplay, art, dan deployment multi-platform.'],
        ['icon' => '🎨', 'title' => 'UI/UX Design', 'text' => 'Prototyping, usability testing, dan design system yang konsisten.'],
        ['icon' => '🕶', 'title' => 'AR/VR', 'text' => 'Immersive experience untuk training, edukasi, dan hiburan.'],
    ];
    $_SESSION['karya'] = [
        ['title' => 'Project A', 'category' => 'Game', 'image' => 'assets/images/jtiLogo.png'],
        ['title' => 'Project B', 'category' => 'UI/UX', 'image' => 'assets/images/jtiLogo.png'],
        ['title' => 'Project C', 'category' => 'AR/VR', 'image' => 'assets/images/jtiLogo.png'],
        ['title' => 'Project D', 'category' => 'Game', 'image' => 'assets/images/jtiLogo.png'],
        ['title' => 'Project E', 'category' => 'UI/UX', 'image' => 'assets/images/jtiLogo.png'],
        ['title' => 'Project F', 'category' => 'AR/VR', 'image' => 'assets/images/jtiLogo.png'],
        ['title' => 'Project G', 'category' => 'Game', 'image' => 'assets/images/jtiLogo.png'],
        ['title' => 'Project H', 'category' => 'UI/UX', 'image' => 'assets/images/jtiLogo.png'],
    ];
    $_SESSION['artikel'] = [
        ['title' => 'Artikel 1', 'date' => '2025-08-12', 'excerpt' => 'Consectetur adipiscing elit. Integer semper mattis nulla.', 'image' => 'assets/images/jtiLogo.png'],
        ['title' => 'Artikel 2', 'date' => '2025-08-12', 'excerpt' => 'Aliquam erat volutpat. Proin sit amet eros sed lorem.', 'image' => 'assets/images/jtiLogo.png'],
        ['title' => 'Artikel 3', 'date' => '2025-08-12', 'excerpt' => 'Pellentesque vel feugiat turpis purus.', 'image' => 'assets/images/jtiLogo.png'],
    ];
    $_SESSION['data_seeded'] = true;
}

// Ensure hero image always uses the latest logo even if session was seeded earlier
$_SESSION['hero']['image'] = 'assets/images/mmtLogo.png';

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

function renderIcon($title) {
    $baseClass = 'h-8 w-8';
    switch ($title) {
        case 'Game Development':
        case 'Game Developer':
            return '<svg class="'.$baseClass.'" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="9" width="14" height="7" rx="3"/><path d="M9.5 12h2M10.5 11v2M15.8 12h.01M13.8 10.8h.01M13.8 13.2h.01"/></svg>';
        case 'UI/UX Design':
        case 'UI UX Design':
            return '<svg class="'.$baseClass.'" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="5" width="16" height="12" rx="2"/><path d="M10 5v14M7 9h6M7 13h4"/></svg>';
        case 'AR/VR':
            return '<svg class="'.$baseClass.'" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 10.5c0-1.4 1.1-2.5 2.5-2.5h11c1.4 0 2.5 1.1 2.5 2.5v1c0 1.4-1.1 2.5-2.5 2.5h-2l-2 2h-3l-2-2h-2C5.1 14 4 12.9 4 11.5v-1z"/><circle cx="9" cy="11.5" r="1"/><circle cx="15" cy="11.5" r="1"/></svg>';
        default:
            return '<svg class="'.$baseClass.'" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="8"/></svg>';
    }
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
        body { font-family: 'Poppins', system-ui, -apple-system, sans-serif; background-color: #ffffff; color: #2f2f2f; }
        .smooth { transition: all 0.3s ease; }
        .card-shadow { box-shadow: 0 10px 22px rgba(0,0,0,0.06); }
        .card-outline { border: 1px solid #dcdfe5; box-shadow: 0 6px 12px rgba(0,0,0,0.04); }
        .pill { display: inline-block; padding: 8px 14px; border-radius: 999px; font-weight: 600; font-size: 13px; background: #f97316; color: #fff; }
    </style>
</head>
<body class="text-gray-800">

<?php include 'layouts/header.php'; ?>

<main class="max-w-6xl mx-auto px-4 py-12 space-y-20">
    <!-- Awal -->
    <section class="grid md:grid-cols-2 gap-12 items-center">
        <div class="space-y-4">
            <p class="text-xl text-orange-600 font-semibold">Selamat Datang di</p>
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight text-gray-900">
                Lab <span class="text-orange-500">Multimedia</span>
            </h1>
            <p class="text-gray-600 max-w-xl"><?php echo $hero['subtitle']; ?></p>
            <button class="bg-orange-500 text-white px-6 py-3 rounded-lg font-semibold smooth hover:bg-orange-600">
                <?php echo $hero['cta']; ?>
            </button>
        </div>
        <div class="flex justify-center">
            <img src="<?php echo $hero['image']; ?>" alt="Hero" class="w-96 h-96 md:w-[480px] md:h-[480px] object-contain">
        </div>
    </section>

    <!-- Fokus Utama -->
    <section class="space-y-10">
        <h2 class="text-3xl font-bold text-center text-gray-800">Fokus Utama Kami</h2>
        <div class="grid md:grid-cols-3 gap-6 items-stretch">
            <?php foreach ($fokusItems as $fokus): ?>
            <div class="relative bg-white rounded-2xl card-outline p-8 pt-14 flex flex-col items-center text-center h-full">
                <div class="absolute -top-8 bg-orange-500 text-white rounded-full w-16 h-16 flex items-center justify-center shadow-lg">
                    <?php echo renderIcon($fokus['title']); ?>
                </div>
                <h3 class="text-xl font-semibold mb-2 mt-4 text-gray-800"><?php echo $fokus['title']; ?></h3>
                <p class="text-gray-600 text-sm leading-relaxed"><?php echo $fokus['text']; ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Karya Unggulan -->
    <section class="space-y-6">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-bold text-gray-800">Karya Unggulan Kami</h2>
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
            <div class="bg-white rounded-xl card-outline overflow-hidden">
                <div class="w-full h-44 bg-gray-200"></div>
                <div class="p-4 space-y-2">
                    <p class="pill text-xs inline-block"><?php echo $karya['category']; ?></p>
                    <h3 class="text-lg font-semibold text-gray-800"><?php echo $karya['title']; ?></h3>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center">
            <button class="bg-orange-500 text-white px-6 py-3 rounded-lg font-semibold smooth hover:bg-orange-600">Lihat Selengkapnya →</button>
        </div>

    </section>

    <!-- Artikel & Berita -->
    <section class="space-y-6">
        <h2 class="text-3xl font-bold text-center text-gray-800">Artikel & Berita</h2>
        <div class="grid md:grid-cols-3 gap-6">
            <?php foreach ($artikelItems as $artikel): ?>
            <article class="bg-white rounded-xl card-outline overflow-hidden">
                <div class="w-full h-40 bg-gray-200"></div>
                <div class="p-4 space-y-2">
                    <p class="text-sm text-orange-500 font-semibold"><?php echo $artikel['date']; ?></p>
                    <h3 class="font-semibold text-lg text-gray-800"><?php echo $artikel['title']; ?></h3>
                    <p class="text-gray-600 text-sm leading-relaxed"><?php echo $artikel['excerpt']; ?></p>
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
    // Filter karya (Dummy)
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
                <div class="bg-white rounded-xl card-outline overflow-hidden">
                    <div class="w-full h-44 bg-gray-200"></div>
                    <div class="p-4 space-y-2">
                        <p class="pill text-xs inline-block">${k.category}</p>
                        <h3 class="text-lg font-semibold text-gray-800">${k.title}</h3>
                    </div>
                </div>
            `).join('');
        });
    });

});
</script>
</body>
</html>