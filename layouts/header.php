<?php
$basePath = '/pbl';
$currentPage = basename($_SERVER['SCRIPT_NAME']);
$navItems = [
    ['label' => 'Beranda', 'href' => $basePath . '/index.php'],
    ['label' => 'Tentang Kami', 'href' => $basePath . '/view/about.php'],
    ['label' => 'Karya', 'href' => $basePath . '/view/catalog.php'],
    ['label' => 'Berita', 'href' => $basePath . '/view/news.php'],
    ['label' => 'Galeri', 'href' => $basePath . '/view/gallery.php'],
];
?>
<header id="header" class="fixed w-full top-0 z-50 bg-white/90 backdrop-blur border-b border-slate-200 shadow-[0_6px_20px_-14px_rgba(15,23,42,0.35)] transition-transform duration-300 will-change-transform h-16">
    <div class="max-w-6xl mx-auto px-4 h-full">
        <div class="flex items-center justify-between h-full">
            <a href="<?php echo $basePath; ?>/index.php" class="flex items-center space-x-2 group">
                <div class="flex items-center space-x-2 px-2 py-1.5">
                    <img src="<?php echo $basePath; ?>/assets/images/jtiLogo.png" alt="Logo JTI" class="h-7 w-7 object-contain" onerror="this.src='<?php echo $basePath; ?>/assets/images/image.png'">
                    <span class="w-px h-10 bg-gray-200"></span>
                    <img src="<?php echo $basePath; ?>/assets/images/mmtLogo.png" alt="Lab MMT Maskot" class="h-10 w-10 object-contain">
                </div>
                <div class="flex flex-col leading-tight ml-1">
                    <span class="text-sm font-semibold text-slate-500 group-hover:text-orange-600 transition">Lab Multimedia</span>
                    <span class="text-xl font-extrabold text-orange-600 leading-tight">MMT</span>
                </div>
            </a>

            <nav class="hidden md:flex items-center space-x-2">
                <?php foreach ($navItems as $item): 
                    $isActive = $currentPage === basename($item['href']);
                    $activeClass = $isActive
                        ? 'text-orange-600 bg-orange-50 border border-orange-100 shadow-sm'
                        : 'text-slate-700 hover:text-orange-600 hover:bg-orange-50 border border-transparent';
                ?>
                    <a href="<?php echo $item['href']; ?>" class="px-3 py-2 rounded-xl font-medium transition <?php echo $activeClass; ?>">
                        <?php echo $item['label']; ?>
                    </a>
                <?php endforeach; ?>
            </nav>

            <button id="mobile-menu-btn" class="md:hidden text-gray-700 focus:outline-none p-2 rounded-lg border border-slate-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <nav id="mobile-menu" class="hidden md:hidden pb-4 space-y-1 border-t border-slate-200 pt-3 bg-white/90 backdrop-blur absolute left-0 right-0 px-4 shadow-lg">
            <?php foreach ($navItems as $item): 
                $isActive = $currentPage === basename($item['href']);
                $activeClass = $isActive
                    ? 'text-orange-600 font-semibold bg-orange-50 border border-orange-100'
                    : 'text-gray-700';
            ?>
                <a href="<?php echo $item['href']; ?>" class="block py-2 px-3 rounded-lg <?php echo $activeClass; ?> hover:bg-orange-50 transition">
                    <?php echo $item['label']; ?>
                </a>
            <?php endforeach; ?>
        </nav>
    </div>
</header>

<script>
    (function () {
        const header = document.getElementById('header');
        if (!header) return;

        let lastY = window.scrollY;
        window.addEventListener('scroll', () => {
            const currentY = window.scrollY;
            const goingDown = currentY > lastY && currentY > 50; 
            header.classList.toggle('-translate-y-full', goingDown);
            if (!goingDown) {
                header.classList.remove('-translate-y-full');
            }
            lastY = currentY;
        }, { passive: true });

        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        if(btn && menu) {
            btn.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
        }
    })();
</script>
