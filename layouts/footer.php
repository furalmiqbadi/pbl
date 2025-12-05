<?php 
if (!isset($basePath)) {
    $basePath = '/pbl';
}
?>
<footer class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white mt-12 relative overflow-hidden">
    <!-- Decorative Elements -->
    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-orange-500 to-transparent opacity-50"></div>
    <div class="absolute top-0 right-0 w-64 h-64 bg-orange-500/5 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-orange-500/5 rounded-full blur-3xl"></div>
    
    <div class="container mx-auto px-6 lg:px-8 py-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
            
            <!-- Kontak Kami Section -->
            <div class="md:col-span-4 space-y-4">
                <div class="space-y-1">
                    <h3 class="text-xl font-bold text-white tracking-tight">Kontak Kami</h3>
                    <div class="w-12 h-0.5 bg-gradient-to-r from-orange-500 to-orange-600 rounded-full"></div>
                </div>
                
                <div class="space-y-2">
                    <div class="group hover:translate-x-1 transition-all duration-300">
                        <div class="flex items-start gap-3 p-2 rounded-lg hover:bg-white/5 transition-colors">
                            <div class="flex-shrink-0 w-9 h-9 rounded-lg bg-gradient-to-br from-orange-500/20 to-orange-600/20 flex items-center justify-center border border-orange-500/20">
                                <svg class="w-4 h-4 text-orange-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-200">Lantai 8 Gedung Teknik Sipil</p>
                                <p class="text-xs text-gray-400 mt-0.5">Politeknik Negeri Malang</p>
                            </div>
                        </div>
                    </div>
                    
                    <a href="tel:+622112345678" class="block group hover:translate-x-1 transition-all duration-300">
                        <div class="flex items-center gap-3 p-2 rounded-lg hover:bg-white/5 transition-colors">
                            <div class="flex-shrink-0 w-9 h-9 rounded-lg bg-gradient-to-br from-orange-500/20 to-orange-600/20 flex items-center justify-center border border-orange-500/20">
                                <svg class="w-4 h-4 text-orange-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-300 group-hover:text-orange-400 transition-colors">+62 21 1234 5678</span>
                        </div>
                    </a>
                    
                    <a href="mailto:info@labmmt.ac.id" class="block group hover:translate-x-1 transition-all duration-300">
                        <div class="flex items-center gap-3 p-2 rounded-lg hover:bg-white/5 transition-colors">
                            <div class="flex-shrink-0 w-9 h-9 rounded-lg bg-gradient-to-br from-orange-500/20 to-orange-600/20 flex items-center justify-center border border-orange-500/20">
                                <svg class="w-4 h-4 text-orange-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-300 group-hover:text-orange-400 transition-colors">info@labmmt.ac.id</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Menu Cepat Section -->
            <div class="md:col-span-4 space-y-4">
                <div class="space-y-1">
                    <h3 class="text-xl font-bold text-white tracking-tight">Menu Cepat</h3>
                    <div class="w-12 h-0.5 bg-gradient-to-r from-orange-500 to-orange-600 rounded-full"></div>
                </div>
                
                <nav class="space-y-1">
                    <a href="<?php echo $basePath; ?>/index.php?page=home" class="group flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/5 transition-all duration-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-orange-500 group-hover:w-2 group-hover:h-2 transition-all"></span>
                        <span class="text-sm font-medium text-gray-300 group-hover:text-white group-hover:translate-x-0.5 transition-all">Beranda</span>
                    </a>
                    <a href="<?php echo $basePath; ?>/index.php?page=about" class="group flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/5 transition-all duration-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-orange-500 group-hover:w-2 group-hover:h-2 transition-all"></span>
                        <span class="text-sm font-medium text-gray-300 group-hover:text-white group-hover:translate-x-0.5 transition-all">Tentang Kami</span>
                    </a>
                    <a href="<?php echo $basePath; ?>/index.php?page=catalog" class="group flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/5 transition-all duration-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-orange-500 group-hover:w-2 group-hover:h-2 transition-all"></span>
                        <span class="text-sm font-medium text-gray-300 group-hover:text-white group-hover:translate-x-0.5 transition-all">Karya</span>
                    </a>
                    <a href="<?php echo $basePath; ?>/index.php?page=news" class="group flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/5 transition-all duration-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-orange-500 group-hover:w-2 group-hover:h-2 transition-all"></span>
                        <span class="text-sm font-medium text-gray-300 group-hover:text-white group-hover:translate-x-0.5 transition-all">Berita</span>
                    </a>
                    <a href="<?php echo $basePath; ?>/index.php?page=gallery" class="group flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/5 transition-all duration-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-orange-500 group-hover:w-2 group-hover:h-2 transition-all"></span>
                        <span class="text-sm font-medium text-gray-300 group-hover:text-white group-hover:translate-x-0.5 transition-all">Galeri</span>
                    </a>
                </nav>
            </div>

            <!-- Logo & Portal Admin Section -->
            <div class="md:col-span-4 flex flex-col items-center justify-center space-y-4">
                <div class="relative group">
                    <div class="absolute -inset-4 bg-gradient-to-r from-orange-500/20 to-orange-600/20 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative">
                        <img src="<?php echo $basePath; ?>/assets/images/mmtLogo.png" alt="Lab MMT Maskot" class="w-28 h-28 object-contain transform group-hover:scale-105 transition-transform duration-500">
                    </div>
                </div>
                
                <div class="text-center space-y-3">
                    <div>
                        <h4 class="text-base font-bold text-white">Lab Multimedia MMT</h4>
                        <p class="text-xs text-gray-400 mt-0.5">Politeknik Negeri Malang</p>
                    </div>
                    
                    <a href="<?php echo $basePath; ?>/view/login.php" class="group inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white text-sm font-semibold shadow-xl shadow-orange-500/20 hover:shadow-2xl hover:shadow-orange-500/30 hover:-translate-y-0.5 transition-all duration-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        <span>Portal Admin</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="border-t border-white/10 mt-8 pt-4">
            <div class="text-center">
                <p class="text-xs text-gray-400">
                    &copy; 2025 <span class="text-orange-400 font-semibold">Lab Multimedia MMT</span>. Semua hak cipta dilindungi.
                </p>
            </div>
        </div>
    </div>
</footer>

<script>
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