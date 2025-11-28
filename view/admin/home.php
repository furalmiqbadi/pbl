<?php
// view/admin/home.php

// Koneksi Database
$db = Connection::getConnection();
$stats = [
    'proyek' => 0, 'berita' => 0, 'galeri' => 0,
    'mahasiswa' => 0, 'dosen' => 0
];

if ($db) {
    try {
        $stats['proyek'] = $db->query("SELECT COUNT(*) FROM daftar_proyek")->fetchColumn();
        $stats['berita'] = $db->query("SELECT COUNT(*) FROM berita_artikel")->fetchColumn();
        $stats['galeri'] = $db->query("SELECT COUNT(*) FROM galeri")->fetchColumn();
        $stats['mahasiswa'] = $db->query("SELECT COUNT(*) FROM mahasiswa")->fetchColumn();
        $stats['dosen'] = $db->query("SELECT COUNT(*) FROM dosen_multimedia")->fetchColumn();
    } catch (PDOException $e) { }
}
?>

<div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-10 flex flex-col md:flex-row justify-between items-center gap-4">
    
    <div class="w-full md:w-auto">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
        <p class="text-gray-500 text-sm mt-1">Selamat datang kembali, <span class="text-orange-500 font-bold"><?php echo htmlspecialchars($_SESSION['username'] ?? 'Admin'); ?></span>!</p>
    </div>

    <div class="w-full md:w-auto">
        <form action="dashboard.php" method="GET" class="relative">
            <input type="hidden" name="page" value="search">
            
            <input type="text" name="q" placeholder="Cari data..." 
                   class="pl-10 pr-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-orange-100 focus:border-orange-300 w-full md:w-72 transition-all">
            
            <i class="fas fa-search absolute left-4 top-3.5 text-gray-400 text-xs"></i>
        </form>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6 mb-10">
    
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center hover:shadow-md transition">
        <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center text-blue-500 text-xl mb-3"><i class="fas fa-laptop-code"></i></div>
        <h3 class="text-gray-500 text-xs font-bold uppercase tracking-wider">Total Karya</h3>
        <p class="text-2xl font-bold text-gray-800 mt-1"><?php echo $stats['proyek']; ?></p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center hover:shadow-md transition">
        <div class="w-12 h-12 rounded-full bg-orange-50 flex items-center justify-center text-orange-500 text-xl mb-3"><i class="fas fa-newspaper"></i></div>
        <h3 class="text-gray-500 text-xs font-bold uppercase tracking-wider">Berita & Artikel</h3>
        <p class="text-2xl font-bold text-gray-800 mt-1"><?php echo $stats['berita']; ?></p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center hover:shadow-md transition">
        <div class="w-12 h-12 rounded-full bg-purple-50 flex items-center justify-center text-purple-500 text-xl mb-3"><i class="fas fa-images"></i></div>
        <h3 class="text-gray-500 text-xs font-bold uppercase tracking-wider">Total Galeri</h3>
        <p class="text-2xl font-bold text-gray-800 mt-1"><?php echo $stats['galeri']; ?></p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center hover:shadow-md transition">
        <div class="w-12 h-12 rounded-full bg-green-50 flex items-center justify-center text-green-500 text-xl mb-3"><i class="fas fa-user-graduate"></i></div>
        <h3 class="text-gray-500 text-xs font-bold uppercase tracking-wider">Total Mahasiswa</h3>
        <p class="text-2xl font-bold text-gray-800 mt-1"><?php echo $stats['mahasiswa']; ?></p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center hover:shadow-md transition">
        <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center text-red-500 text-xl mb-3"><i class="fas fa-chalkboard-teacher"></i></div>
        <h3 class="text-gray-500 text-xs font-bold uppercase tracking-wider">Total Dosen</h3>
        <p class="text-2xl font-bold text-gray-800 mt-1"><?php echo $stats['dosen']; ?></p>
    </div>

</div>

<div class="grid grid-cols-2 md:grid-cols-5 gap-4">
    <a href="dashboard.php?page=tambah_proyek" class="p-6 bg-white border border-gray-200 rounded-xl hover:border-orange-500 hover:text-orange-600 transition flex flex-col items-center justify-center gap-3 group cursor-pointer">
        <i class="fas fa-plus-circle text-2xl text-gray-300 group-hover:text-orange-500 transition"></i>
        <span class="text-sm font-semibold">Tambah Karya</span>
    </a>
    <a href="dashboard.php?page=tambah_berita" class="p-6 bg-white border border-gray-200 rounded-xl hover:border-orange-500 hover:text-orange-600 transition flex flex-col items-center justify-center gap-3 group cursor-pointer">
        <i class="fas fa-pen-nib text-2xl text-gray-300 group-hover:text-orange-500 transition"></i>
        <span class="text-sm font-semibold text-center">Tulis Berita & Artikel</span>
    </a>
    <a href="dashboard.php?page=tambah_galeri" class="p-6 bg-white border border-gray-200 rounded-xl hover:border-orange-500 hover:text-orange-600 transition flex flex-col items-center justify-center gap-3 group cursor-pointer">
        <i class="fas fa-camera text-2xl text-gray-300 group-hover:text-orange-500 transition"></i>
        <span class="text-sm font-semibold">Upload Galeri</span>
    </a>
    <a href="dashboard.php?page=tambah_mahasiswa" class="p-6 bg-white border border-gray-200 rounded-xl hover:border-orange-500 hover:text-orange-600 transition flex flex-col items-center justify-center gap-3 group cursor-pointer">
        <i class="fas fa-user-plus text-2xl text-gray-300 group-hover:text-orange-500 transition"></i>
        <span class="text-sm font-semibold text-center">Tambah Mahasiswa</span>
    </a>
</div>