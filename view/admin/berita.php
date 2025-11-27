<?php
require_once '../../model/NewsModel.php'; 
$newsModel = new NewsModel();

$newsList = $newsModel->getNews(); 
?>

<div class="space-y-6">
    
    <!-- 1. HEADER HALAMAN -->
    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        <div>
            <h2 class="font-heading font-bold text-2xl text-brand-dark">Kelola Artikel & Berita</h2>
        </div>
        
        <!-- Tombol Tambah -->
        <a href="dashboard.php?page=tulis_berita" class="inline-flex items-center bg-brand-orange hover:bg-orange-600 text-white text-sm font-semibold px-5 py-2.5 rounded-lg shadow-sm transition-all">
            <i class="ph ph-plus mr-2 text-lg"></i>
            Tulis Berita
        </a>
    </div>

    <!-- 2. FILTER & PENCARIAN -->
    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col md:flex-row gap-4 justify-between">
        <!-- Search -->
        <div class="relative w-full md:w-80">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                <i class="ph ph-magnifying-glass text-lg"></i>
            </span>
            <input type="text" class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-brand-orange focus:ring-1 focus:ring-brand-orange" placeholder="Cari judul berita...">
        </div>

        <!-- Filter Kategori -->
        <div class="w-full md:w-48">
            <select class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-brand-orange cursor-pointer text-gray-600 font-medium">
                <option value="">Semua Kategori</option>
                <option value="Kegiatan">Kegiatan</option>
                <option value="Prestasi">Prestasi</option>
                <option value="Workshop">Workshop</option>
            </select>
        </div>
    </div>

    <!-- 3. TABEL DATA BERITA -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-500 font-semibold tracking-wider">
                        <th class="px-6 py-4">Thumbnail</th>
                        <th class="px-6 py-4">Judul & Cuplikan</th>
                        <th class="px-6 py-4 text-center">Kategori</th>
                        <th class="px-6 py-4 text-center">Tanggal</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    
                    <?php if (!empty($newsList)): ?>
                        <?php foreach($newsList as $news): ?>
                        <tr class="hover:bg-orange-50/30 transition-colors group">
                            <!-- Thumbnail -->
                            <td class="px-6 py-4 w-32">
                                <div class="h-16 w-24 rounded-lg overflow-hidden bg-gray-200 border border-gray-200">
                                    <img src="<?php echo !empty($news['gambar_berita']) ? $news['gambar_berita'] : 'https://placehold.co/100x100?text=No+Img'; ?>" 
                                         class="w-full h-full object-cover">
                                </div>
                            </td>

                            <!-- Judul -->
                            <td class="px-6 py-4 max-w-md">
                                <h3 class="text-sm font-bold text-brand-dark line-clamp-1 group-hover:text-brand-orange transition-colors">
                                    <?php echo htmlspecialchars($news['judul']); ?>
                                </h3>
                                <p class="text-xs text-gray-500 mt-1 line-clamp-2">
                                    <?php echo htmlspecialchars(substr(strip_tags($news['isi_berita']), 0, 100)) . '...'; ?>
                                </p>
                            </td>

                            <!-- Kategori -->
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    <?php echo htmlspecialchars($news['nama_kategori'] ?? 'Umum'); ?>
                                </span>
                            </td>

                            <!-- Tanggal -->
                            <td class="px-6 py-4 text-center text-xs text-gray-500 font-medium">
                                <?php echo date('d M Y', strtotime($news['created_at'])); ?>
                            </td>

                            <!-- Aksi -->
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button class="p-2 rounded-lg text-blue-600 bg-blue-50 hover:bg-blue-100 transition-colors" title="Edit">
                                        <i class="ph ph-pencil-simple text-lg"></i>
                                    </button>
                                    <button class="p-2 rounded-lg text-red-600 bg-red-50 hover:bg-red-100 transition-colors" title="Hapus" onclick="return confirm('Yakin hapus berita ini?')">
                                        <i class="ph ph-trash text-lg"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="ph ph-newspaper text-4xl mb-3 text-gray-300"></i>
                                    <p>Belum ada berita yang ditambahkan.</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>

                </tbody>
            </table>
        </div>
        
        <!-- Pagination (Statis dulu) -->
        <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between">
            <span class="text-xs text-gray-500">Menampilkan <?php echo count($newsList); ?> data</span>
            <div class="flex gap-2">
                <button class="px-3 py-1 text-xs font-medium text-gray-500 bg-white border border-gray-200 rounded hover:bg-gray-50 disabled:opacity-50">Prev</button>
                <button class="px-3 py-1 text-xs font-medium text-gray-500 bg-white border border-gray-200 rounded hover:bg-gray-50">Next</button>
            </div>
        </div>
    </div>

</div>