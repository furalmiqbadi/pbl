<?php
if (!function_exists('h')) {
    function h(?string $str) {
        return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
    }
}


$listBerita = $newsList ?? []; 
$searchQuery = $_GET['search'] ?? ''; 
?>

<div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
    
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Kelola Artikel & Berita</h2>
        </div>
        
        <a href="dashboard.php?page=tambah_berita" class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2.5 rounded-lg font-semibold flex items-center gap-2 transition shadow-sm hover:shadow-md">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tulis Berita
        </a>
    </div>

    <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 mb-6 flex flex-col md:flex-row gap-4 justify-between items-center">
        <form action="" method="GET" class="relative w-full md:w-96">
            <input type="hidden" name="page" value="berita"> 
            
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </span>
            
            <input type="text" name="search" 
                   value="<?php echo h($searchQuery); ?>" 
                   placeholder="Cari judul berita..." 
                   class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-200 focus:border-orange-500 transition">
        </form>

        <div class="flex items-center gap-2">
             <select class="px-4 py-2.5 rounded-lg border border-gray-300 text-gray-600 text-sm focus:outline-none focus:border-orange-500 bg-white">
                <option value="">Semua Kategori</option>
                <option value="prestasi">Prestasi</option>
                <option value="kegiatan">Kegiatan</option>
             </select>
        </div>
    </div>

    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 text-gray-600 text-xs uppercase font-bold tracking-wider">
                <tr>
                    <th class="px-6 py-4 border-b border-gray-200">Thumbnail</th>
                    <th class="px-6 py-4 border-b border-gray-200">Judul & Cuplikan</th>
                    <th class="px-6 py-4 border-b border-gray-200 text-center">Kategori</th>
                    <th class="px-6 py-4 border-b border-gray-200 text-center">Tanggal</th>
                    <th class="px-6 py-4 border-b border-gray-200 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                <?php if (empty($listBerita)): ?>
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-400">
                            Belum ada berita yang ditemukan.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($listBerita as $berita): ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 w-32">
                            <div class="h-20 w-28 bg-gray-100 rounded-lg overflow-hidden border border-gray-200 flex items-center justify-center">
                                <?php if (!empty($berita['gambar_berita'])): ?>
                                    <img src="../<?php echo h($berita['gambar_berita']); ?>" alt="Img" class="w-full h-full object-cover">
                                <?php else: ?>
                                    <span class="text-xs text-gray-400 font-medium">No Img</span>
                                <?php endif; ?>
                            </div>
                        </td>

                        <td class="px-6 py-4 max-w-md">
                            <h3 class="font-bold text-gray-800 text-base mb-1">
                                <?php echo h($berita['judul']); ?>
                            </h3>
                            <p class="text-gray-500 text-sm line-clamp-2 leading-relaxed">
                                <?php echo h(mb_substr(strip_tags($berita['isi_berita'] ?? ''), 0, 100)) . '...'; ?>
                            </p>
                        </td>

                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                <?php echo h($berita['nama_kategori'] ?? 'Umum'); ?>
                            </span>
                        </td>

                        <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-gray-500">
                            <?php echo !empty($berita['created_at']) ? date('d M Y', strtotime($berita['created_at'])) : '-'; ?>
                        </td>

                        <td class="px-6 py-4 text-center w-32">
                            <div class="flex items-center justify-center gap-2">
                                <a href="dashboard.php?page=edit_berita&id=<?php echo $berita['id']; ?>" class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <a href="dashboard.php?page=hapus_berita&id=<?php echo $berita['id']; ?>" onclick="return confirm('Yakin ingin menghapus berita ini?')" class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>