<script src="https://cdn.tailwindcss.com"></script>

<div class="w-64 h-screen bg-gray-900 text-white fixed top-0 left-0 flex flex-col pt-6 z-10">
    <div class="text-center mb-8 px-4">
        <img src="assets/images/mmtLogo.png" alt="LAB MMT" class="w-24 mx-auto">
    </div>
    
    <nav class="flex-1">
        <a href="index.php?page=dashboard" class="block py-3 px-6 text-gray-400 hover:bg-gray-800 hover:text-white hover:border-l-4 hover:border-gray-500 transition-all">
            Dashboard
        </a>
        <a href="index.php?page=proyek" class="block py-3 px-6 text-gray-400 hover:bg-gray-800 hover:text-white hover:border-l-4 hover:border-gray-500 transition-all">
            Kelola Proyek
        </a>
        
        <?php 
            $isActive = (isset($_GET['page']) && strpos($_GET['page'], 'berita') !== false);
            $activeClass = $isActive ? "bg-gray-800 text-white border-l-4 border-gray-500" : "text-gray-400 hover:bg-gray-800 hover:text-white hover:border-l-4 hover:border-gray-500";
        ?>
        <a href="index.php?page=berita" class="block py-3 px-6 transition-all <?= $activeClass ?>">
            Kelola Berita
        </a>
        
        <a href="index.php?page=galeri" class="block py-3 px-6 text-gray-400 hover:bg-gray-800 hover:text-white hover:border-l-4 hover:border-gray-500 transition-all">
            Kelola Galeri
        </a>
        <a href="index.php?page=profil" class="block py-3 px-6 text-gray-400 hover:bg-gray-800 hover:text-white hover:border-l-4 hover:border-gray-500 transition-all">
            Kelola Profil
        </a>
    </nav>

    <a href="logout.php" class="block py-4 px-6 text-gray-400 hover:text-white mt-auto mb-4">
        Logout
    </a>
</div>