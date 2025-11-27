<?php
$activePage = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="w-64 h-screen bg-[#0f172a] text-white fixed top-0 left-0 flex flex-col z-50 shadow-2xl">
    
    <div class="h-24 flex items-center justify-center border-b border-gray-800 bg-[#0f172a]">
        <img src="../../assets/images/mmtLogo.png" alt="Logo" class="w-24 h-auto object-contain hover:scale-110 transition-transform duration-300">
    </div>
    
    <nav class="flex-1 py-6 space-y-2 overflow-y-auto px-3 scrollbar-hide">
        
        <a href="dashboard.php?page=home" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group <?php echo $activePage == 'home' ? 'bg-orange-600 text-white shadow-lg' : 'text-gray-400 hover:bg-gray-800'; ?>">
            <i class="fas fa-home w-5 text-center"></i>
            <span class="font-medium">Dashboard</span>
        </a>

        <a href="dashboard.php?page=karya" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group <?php echo ($activePage == 'karya' || $activePage == 'tambah_karya') ? 'bg-orange-600 text-white shadow-lg' : 'text-gray-400 hover:bg-gray-800'; ?>">
            <i class="fas fa-laptop-code w-5 text-center"></i>
            <span class="font-medium">Kelola Karya</span>
        </a>
        
        <a href="dashboard.php?page=berita" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group <?php echo ($activePage == 'berita' || $activePage == 'tambah_berita') ? 'bg-orange-600 text-white shadow-lg' : 'text-gray-400 hover:bg-gray-800'; ?>">
            <i class="fas fa-newspaper w-5 text-center"></i>
            <span class="font-medium">Berita & Artikel</span>
        </a>
        
        <a href="dashboard.php?page=galeri" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group <?php echo ($activePage == 'galeri' || $activePage == 'tambah_galeri') ? 'bg-orange-600 text-white shadow-lg' : 'text-gray-400 hover:bg-gray-800'; ?>">
            <i class="fas fa-images w-5 text-center"></i>
            <span class="font-medium">Kelola Galeri</span>
        </a>

        <a href="dashboard.php?page=mahasiswa" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group <?php echo ($activePage == 'mahasiswa' || $activePage == 'tambah_mahasiswa') ? 'bg-orange-600 text-white shadow-lg' : 'text-gray-400 hover:bg-gray-800'; ?>">
            <i class="fas fa-user-graduate w-5 text-center"></i>
            <span class="font-medium">Data Mahasiswa</span>
        </a>

        <a href="dashboard.php?page=profil" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group <?php echo $activePage == 'profil' ? 'bg-orange-600 text-white shadow-lg' : 'text-gray-400 hover:bg-gray-800'; ?>">
            <i class="fas fa-user-cog w-5 text-center"></i>
            <span class="font-medium">Kelola Profil</span>
        </a>
    </nav>

    <div class="p-4 border-t border-gray-800 bg-[#0f172a]">
        <a href="../../logout.php" class="flex items-center justify-center w-full py-2.5 px-4 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-all shadow-lg text-sm font-semibold group">
            <i class="fas fa-sign-out-alt mr-2 group-hover:-translate-x-1 transition-transform"></i>
            Logout
        </a>
    </div>
</div>