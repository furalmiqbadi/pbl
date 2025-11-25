<?php
require_once __DIR__ . '/controller/HomeController.php';

$basePath = '/pbl';

function h($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function assetUrl(string $src): string {
    global $basePath;
    if ($src === '') {
        return '';
    }
    if (preg_match('~^(https?:)?//~', $src)) {
        return $src;
    }
    return rtrim($basePath, '/') . '/' . ltrim($src, '/');
}

function mapImageList(array $items, string $key = 'image'): array {
    foreach ($items as &$item) {
        if (isset($item[$key])) {
            $item[$key] = assetUrl($item[$key]);
        }
    }
    return $items;
}

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
        body { font-family: 'Poppins', system-ui, -apple-system, sans-serif; background-color: #ffffff; color: #2f2f2f; }
        .smooth { transition: all 0.3s ease; }
        .card-outline { border: 1px solid #dcdfe5; box-shadow: 0 6px 12px rgba(0,0,0,0.04); }
        .pill { display: inline-block; padding: 8px 14px; border-radius: 999px; font-weight: 600; font-size: 13px; background: #f97316; color: #fff; }
        .gallery-row { overflow: hidden; }
        .gallery-track { display: flex; gap: 0; will-change: transform; }
        .gallery-card { flex: 0 0 25%; position: relative; aspect-ratio: 4 / 3; border-radius: 12px; overflow: hidden; border: 1px solid #dcdfe5; background: #0f172a; }
        .gallery-card img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
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

    function startGalleryMarquee(rowId, trackId, data, direction = 1) {
        const row = document.getElementById(rowId);
        const track = document.getElementById(trackId);
        if (!row || !track || !data || data.length === 0) return;

        while (data.length < 4) data = data.concat(data);
        const repeated = [...data, ...data];
        track.innerHTML = repeated.map(item => `
            <div class="gallery-card">
                <img src="${item.image}" alt="Galeri" class="w-full h-full object-cover">
            </div>
        `).join('');

        let offset = direction === -1 ? (track.firstElementChild?.getBoundingClientRect().width || 0) * data.length : 0;
        let cardWidth = 0;
        let loopWidth = 0;
        let paused = false;

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

        row.addEventListener('mouseenter', () => paused = true);
        row.addEventListener('mouseleave', () => paused = false);

        const speed = 0.6;
        function step() {
            if (!paused) {
                offset += direction * speed;
                track.style.transform = `translateX(${-offset}px)`;
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

    startGalleryMarquee('gallery-row-top', 'gallery-track-top', [...galleryTopData], 1);
    startGalleryMarquee('gallery-row-bottom', 'gallery-track-bottom', [...galleryBottomData], -1);

    // Filter karya
    const filterButtons = document.querySelectorAll('.karya-filter');
    const karyaGrid = document.getElementById('karya-grid');

    function renderKarya(list) {
        karyaGrid.innerHTML = list.slice(0, 3).map(k => `
            <div class="bg-white rounded-2xl shadow-[0_12px_35px_-18px_rgba(15,23,42,0.35)] overflow-hidden border border-slate-200/70">
                <div class="w-full h-44 bg-gray-200 overflow-hidden">
                    ${k.image ? `<img src="${k.image}" alt="${k.title || ''}" class="w-full h-full object-cover">` : ''}
                </div>
                <div class="p-4 space-y-2">
                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-[#feedd8] text-orange-700 text-xs font-semibold border border-orange-200">${k.category || ''}</span>
                    <h3 class="text-lg font-semibold text-gray-800">${k.title || ''}</h3>
                    <p class="text-sm text-gray-500">Detail singkat akan tampil di sini.</p>
                </div>
            </div>
        `).join('');
    }

    renderKarya(karyaData);

    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            filterButtons.forEach(b => b.classList.remove('bg-orange-500','text-white','border-orange-500','shadow-sm'));
            filterButtons.forEach(b => b.classList.add('bg-white','text-gray-700','border-gray-200'));
            btn.classList.add('bg-orange-500','text-white','border-orange-500','shadow-sm');
            btn.classList.remove('bg-white','text-gray-700','border-gray-200');

            const filter = btn.dataset.filter;
            const filtered = filter === 'Semua' ? karyaData : karyaData.filter(k => k.category === filter);
            renderKarya(filtered);
        });
    });
});
</script>
</body>
</html>
