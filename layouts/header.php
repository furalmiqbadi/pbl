<!-- HEADER.PHP -->
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
<header id="header" class="bg-white shadow-md sticky top-0 z-50 transition-transform duration-300 will-change-transform">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <a href="<?php echo $basePath; ?>/index.php" class="flex items-center space-x-3">
                <div class="flex items-center space-x-3 bg-white px-2 py-1 rounded-md">
                    <img src="<?php echo $basePath; ?>/assets/images/jtiLogo.png" alt="Logo JTI" class="h-10 w-10 object-contain" onerror="this.src='<?php echo $basePath; ?>/assets/images/image.png'">
                    <img src="../assets/images/jtiLogo.png" alt="Logo JTI" class="h-10 w-10 object-contain" onerror="this.src='/pbl/assets/images/image.png'">
                    <span class="w-px h-10 bg-gray-300"></span>
                    <img src="../assets/images/mmtLogo.png" alt="Lab MMT Maskot" class="h-12 w-12 object-contain">
                    <img src="<?php echo $basePath; ?>/assets/images/mmtLogo.png" alt="Lab MMT Maskot" class="h-12 w-12 object-contain">
                </div>
                <span class="ml-1 text-xl font-bold text-orange-600">LAB MMT</span>
            </a>

            <!-- Navbar Desktop -->
            <nav class="hidden md:flex space-x-8">
                <?php foreach ($navItems as $item): 
                    $isActive = $currentPage === basename($item['href']);
                    $activeClass = $isActive ? 'text-orange-600 underline underline-offset-4' : 'text-gray-700';
                ?>
                    <a href="<?php echo $item['href']; ?>" class="font-medium <?php echo $activeClass; ?> hover:text-orange-600 transition">
                        <?php echo $item['label']; ?>
                    </a>
                <?php endforeach; ?>
            </nav>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="md:hidden text-gray-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <nav id="mobile-menu" class="hidden md:hidden pb-4 space-y-1">
            <?php foreach ($navItems as $item): 
                $isActive = $currentPage === basename($item['href']);
                $activeClass = $isActive ? 'text-orange-600 underline underline-offset-4' : 'text-gray-700';
            ?>
                <a href="<?php echo $item['href']; ?>" class="block py-2 font-medium <?php echo $activeClass; ?> hover:text-orange-600 transition">
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
            const goingDown = currentY > lastY && currentY > 80;
            header.classList.toggle('-translate-y-full', goingDown);
            if (!goingDown) {
                header.classList.remove('-translate-y-full');
            }
            lastY = currentY;
        }, { passive: true });
    })();
</script>
