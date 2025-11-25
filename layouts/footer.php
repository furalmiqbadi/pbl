<!-- ========== FOOTER.PHP ========== -->
<?php $basePath = '/pbl'; ?>
<footer class="bg-gray-800 text-white mt-12">
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Kontak Kami -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Kontak Kami</h3>
                <div class="space-y-3">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 mt-1 mr-3 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <p class="text-sm">Lantai 8 Gedung GFIF</p>
                            <p class="text-sm">Politeknik Negeri Malang</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                        </svg>
                        <p class="text-sm">+62 21 1234 5678</p>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                        <p class="text-sm">info@labmmt.ac.id</p>
                    </div>
                </div>
            </div>

            <!-- Menu Cepat -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Menu Cepat</h3>
                <ul class="space-y-2">
                    <li><a href="<?php echo $basePath; ?>/index.php" class="text-sm hover:text-orange-500 transition">Beranda</a></li>
                    <li><a href="<?php echo $basePath; ?>/view/about.php" class="text-sm hover:text-orange-500 transition">Tentang Kami</a></li>
                    <li><a href="<?php echo $basePath; ?>/view/catalog.php" class="text-sm hover:text-orange-500 transition">Karya</a></li>
                    <li><a href="<?php echo $basePath; ?>/view/news.php" class="text-sm hover:text-orange-500 transition">Berita</a></li>
                    <li><a href="<?php echo $basePath; ?>/view/gallery.php" class="text-sm hover:text-orange-500 transition">Galeri</a></li>
                </ul>
            </div>

            <!-- Logo & Portal Admin -->
            <div class="flex flex-col items-center md:items-end text-right space-y-3 md:h-full md:justify-end">
                <img src="<?php echo $basePath; ?>/assets/images/mmtLogo.png" alt="Lab MMT Maskot" class="w-32 h-32 object-contain">
                <a href="<?php echo $basePath; ?>/view/login.php" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-orange-300 text-orange-200 hover:text-white hover:border-white transition text-sm font-semibold">
                    Portal Admin
                    <span class="text-lg leading-none">&rarr;</span>
                </a>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-gray-700 mt-8 pt-6 text-center">
            <p class="text-sm text-gray-400">┬⌐ 2025 Lab Multimedia MMT. Semua hak cipta dilindungi</p>
        </div>
    </div>
</footer>

<!-- Script umum (mobile menu + sidebar) -->
<script>
    // Mobile Menu 
    const mobileBtn = document.getElementById('mobile-menu-btn');
    if (mobileBtn) {
        mobileBtn.addEventListener('click', function () {
            const menu = document.getElementById('mobile-menu');
            if (menu) {
                menu.classList.toggle('hidden');
            }
        });
    }

    // Sidebar
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        if (!sidebar || !overlay) {
            return;
        }

        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    }

    const sidebarLinks = document.querySelectorAll('#sidebar a');
    if (sidebarLinks.length > 0) {
        sidebarLinks.forEach(link => {
            link.addEventListener('click', function () {
                toggleSidebar();
            });
        });
    }
</script>

