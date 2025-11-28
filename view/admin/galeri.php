<div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Kelola Galeri</h1>
        <p class="text-gray-500 text-sm mt-1">Dokumentasi kegiatan dan karya.</p>
    </div>
    
    <a href="dashboard.php?page=tambah_galeri" class="group bg-orange-600 text-white px-6 py-3 rounded-xl hover:bg-orange-700 transition shadow-lg hover:shadow-orange-500/30 font-semibold flex items-center gap-2">
        <div class="bg-white/20 p-1 rounded-lg group-hover:scale-110 transition">
            <i class="fas fa-plus text-xs"></i>
        </div>
        Tambah Gambar
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 text-gray-500 uppercase text-xs font-bold tracking-wider border-b border-gray-100">
                <tr>
                    <th class="px-6 py-5 w-16 text-center">No</th>
                    <th class="px-6 py-5 w-48">Gambar</th>
                    <th class="px-6 py-5">Deskripsi</th>
                    <th class="px-6 py-5 w-40 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 text-sm text-gray-700">
                <?php if (!empty($galeri)): ?>
                    <?php $no = 1; foreach ($galeri as $row): ?>
                    <tr class="hover:bg-orange-50/40 transition duration-200 group">
                        
                        <td class="px-6 py-4 text-center font-medium text-gray-400">
                            <?= $no++ ?>
                        </td>

                        <td class="px-6 py-4">
                            <div class="h-28 w-40 rounded-xl overflow-hidden bg-gray-100 border border-gray-200 shadow-sm relative group">
                                <?php if (!empty($row['gambar_galeri'])): ?>
                                    <img src="../../<?= htmlspecialchars($row['gambar_galeri']) ?>" 
                                         class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500"
                                         alt="Galeri">
                                <?php else: ?>
                                    <div class="w-full h-full flex flex-col items-center justify-center text-gray-400">
                                        <i class="fas fa-image text-2xl mb-1"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <p class="text-gray-600 leading-relaxed line-clamp-3">
                                <?= htmlspecialchars($row['deskripsi']) ?>
                            </p>
                        </td>

                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-2 opacity-80 group-hover:opacity-100 transition">
                                <a href="dashboard.php?page=edit_galeri&id=<?= $row['id'] ?>" 
                                   class="p-2 bg-white border border-gray-200 rounded-lg text-blue-500 hover:bg-blue-50 hover:border-blue-200 transition shadow-sm"
                                   title="Edit">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <a href="dashboard.php?page=hapus_galeri&id=<?= $row['id'] ?>" 
                                   class="p-2 bg-white border border-gray-200 rounded-lg text-red-500 hover:bg-red-50 hover:border-red-200 transition shadow-sm"
                                   onclick="return confirm('Hapus gambar ini?')"
                                   title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>

                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-gray-400">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                                    <i class="fas fa-images text-2xl"></i>
                                </div>
                                <p class="text-lg font-medium text-gray-500">Belum ada data galeri.</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>