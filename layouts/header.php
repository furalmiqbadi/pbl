<?php
$basePath = '/pbl';

$currentPage = $_GET['page'] ?? 'home';

$navItems = [
    ['label' => 'Beranda',      'page' => 'home',    'href' => $basePath . '/index.php?page=home'],
    ['label' => 'Tentang Kami', 'page' => 'about',   'href' => $basePath . '/index.php?page=about'],
    ['label' => 'Karya',        'page' => 'catalog', 'href' => $basePath . '/index.php?page=catalog'],
    ['label' => 'Berita',       'page' => 'news',    'href' => $basePath . '/index.php?page=news'], 
    ['label' => 'Galeri',       'page' => 'gallery', 'href' => $basePath . '/index.php?page=gallery'],
];
?>

<header id="header" class="fixed w-full top-0 z-50 bg-white/95 backdrop-blur-md border-b border-gray-100 transition-all duration-300">
    <div class="absolute inset-x-6 bottom-0 h-[1px] bg-gradient-to-r from-transparent via-orange-200/80 to-transparent pointer-events-none"></div>
    <div class="absolute inset-x-10 bottom-[2px] h-px bg-gradient-to-r from-orange-50 via-white to-orange-50 opacity-60 pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="flex items-center justify-between h-16">
            
            <!-- Logo Section -->
            <a href="<?php echo $basePath; ?>/index.php?page=home" class="flex items-center gap-3 group">
                <div class="flex items-center gap-2.5 px-2.5 py-1.5">
                    <img src="<?php echo $basePath; ?>/assets/images/jtiLogo.png" alt="Logo JTI" class="h-8 w-8 object-contain transform group-hover:scale-105 transition-transform duration-200" onerror="this.src='<?php echo $basePath; ?>/assets/images/image.png'">
                    
                    <div class="w-px h-10 bg-gradient-to-b from-transparent via-gray-300 to-transparent"></div>
                    
                    <img src="<?php echo $basePath; ?>/assets/images/mmtLogo.png" alt="Lab MMT Maskot" class="h-10 w-10 object-contain transform group-hover:scale-105 transition-transform duration-200">
                </div>
                
                <div class="flex flex-col leading-tight">
                    <span class="text-xs font-semibold text-gray-600 group-hover:text-orange-600 transition-colors tracking-wide">Lab Multimedia</span>
                    <span class="text-2xl font-bold bg-gradient-to-r from-orange-600 to-orange-500 bg-clip-text text-transparent">MMT</span>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex items-center gap-1">
                <?php foreach ($navItems as $item): 
                    $isActive = ($currentPage === $item['page']);
                    
                    if ($currentPage === 'news_detail' && $item['page'] === 'news') {
                        $isActive = true;
                    }

                    if ($isActive) {
                        $classes = 'text-orange-600 bg-orange-50 border-orange-200 font-semibold';
                    } else {
                        $classes = 'text-gray-700 hover:text-orange-600 hover:bg-gray-50 border-transparent font-medium';
                    }
                ?>
                    <a href="<?php echo $item['href']; ?>" class="relative px-4 py-2 rounded-lg border transition-all duration-200 <?php echo $classes; ?>">
                        <?php echo $item['label']; ?>
                        <?php if ($isActive): ?>
                            <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-10 h-0.5 bg-orange-600 rounded-full"></div>
                        <?php endif; ?>
                    </a>
                <?php endforeach; ?>
            </nav>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors focus:outline-none">
                <svg id="menu-icon" class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                <svg id="close-icon" class="w-6 h-6 text-gray-700 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Navigation -->
        <nav id="mobile-menu" class="hidden lg:hidden pb-4 pt-2 space-y-1.5 border-t border-gray-100">
            <?php foreach ($navItems as $item): 
                $isActive = ($currentPage === $item['page']);
                if ($currentPage === 'news_detail' && $item['page'] === 'news') { $isActive = true; }

                if ($isActive) {
                    $classes = 'text-orange-600 bg-orange-50 border-orange-200 font-semibold';
                } else {
                    $classes = 'text-gray-700 bg-white border-gray-100 font-medium hover:bg-gray-50';
                }
            ?>
                <a href="<?php echo $item['href']; ?>" class="flex items-center justify-between py-2.5 px-4 rounded-lg border transition-colors <?php echo $classes; ?>">
                    <span><?php echo $item['label']; ?></span>
                    <?php if ($isActive): ?>
                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    <?php endif; ?>
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
            
            if (goingDown) {
                header.style.transform = 'translateY(-100%)';
            } else {
                header.style.transform = 'translateY(0)';
            }
            
            // Add shadow on scroll
            if (currentY > 10) {
                header.style.boxShadow = '0 4px 6px -1px rgba(0, 0, 0, 0.1)';
            } else {
                header.style.boxShadow = 'none';
            }
            
            lastY = currentY;
        }, { passive: true });

        // Mobile menu toggle
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');
        
        if (btn && menu && menuIcon && closeIcon) {
            btn.addEventListener('click', () => {
                const isHidden = menu.classList.contains('hidden');
                
                menu.classList.toggle('hidden');
                menuIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('hidden');
            });

            // Close menu when clicking on a link
            menu.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => {
                    menu.classList.add('hidden');
                    menuIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                });
            });
        }
    })();
</script>
