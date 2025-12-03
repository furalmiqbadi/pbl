<div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
            <span class="w-3 h-8 bg-gradient-to-b from-purple-400 to-purple-600 rounded-full"></span>
            Kelola Galeri
        </h1>
        <p class="text-gray-500 text-sm mt-2 ml-6">Dokumentasi visual kegiatan dan karya.</p>
    </div>
    
    <a href="dashboard.php?page=tambah_galeri" 
       class="group bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-7 py-3.5 rounded-2xl hover:shadow-lg hover:shadow-purple-500/30 hover:-translate-y-1 transition-all duration-300 font-bold flex items-center gap-3">
        <div class="bg-white/20 p-1.5 rounded-lg group-hover:rotate-12 transition duration-300">
            <i class="fas fa-plus text-xs"></i>
        </div>
        <span>Tambah Gambar</span>
    </a>
</div>

<div class="bg-white rounded-[2rem] shadow-xl shadow-gray-100/50 border border-gray-100 overflow-hidden relative">
    
    <div class="absolute top-0 right-0 w-64 h-64 bg-purple-50 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2 opacity-60 pointer-events-none"></div>

    <div class="overflow-x-auto relative z-10">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50/80 text-gray-500 uppercase text-xs font-extrabold tracking-wider border-b border-gray-100">
                <tr>
                    <th class="px-8 py-6 w-20 text-center">No</th>
                    <th class="px-6 py-6 w-48">Gambar</th>
                    <th class="px-6 py-6">Deskripsi</th>
                    <th class="px-6 py-6 w-32 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 text-sm text-gray-700">
                <?php if (!empty($galeri)): ?>
                    <?php $no = 1; foreach ($galeri as $row): ?>
                    <tr class="hover:bg-purple-50/30 transition duration-300 group">
                        
                        <td class="px-8 py-5 text-center font-bold text-gray-400 group-hover:text-purple-500 transition">
                            <?= $no++ ?>
                        </td>

                        <td class="px-6 py-5">
                            <div class="h-28 w-40 rounded-2xl overflow-hidden bg-white border border-gray-100 shadow-sm group-hover:shadow-md group-hover:border-purple-200 transition-all relative cursor-pointer">
                                <?php if (!empty($row['gambar_galeri'])): ?>
                                    <img src="../../<?= htmlspecialchars($row['gambar_galeri']) ?>" 
                                         class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700"
                                         alt="Galeri">
                                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition duration-300"></div>
                                <?php else: ?>
                                    <div class="w-full h-full flex flex-col items-center justify-center text-gray-300 bg-gray-50">
                                        <i class="fas fa-image text-2xl mb-1"></i>
                                        <span class="text-[10px] font-medium">No Image</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </td>

                        <td class="px-6 py-5">
                            <p class="text-gray-600 leading-relaxed line-clamp-3 group-hover:text-gray-800 transition">
                                <?= htmlspecialchars($row['deskripsi']) ?>
                            </p>
                        </td>

                        <td class="px-6 py-5 text-center">
                            <div class="flex justify-center gap-3 opacity-90">
                                <a href="dashboard.php?page=edit_galeri&id=<?= $row['id'] ?>" 
                                   class="w-10 h-10 flex items-center justify-center rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all shadow-sm hover:shadow-blue-200"
                                   title="Edit">
                                    <i class="fas fa-pen text-xs"></i>
                                </a>
                                <a href="dashboard.php?page=hapus_galeri&id=<?= $row['id'] ?>" 
                                   class="w-10 h-10 flex items-center justify-center rounded-xl bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition-all shadow-sm hover:shadow-red-200"
                                   onclick="return confirm('Hapus gambar ini?')"
                                   title="Hapus">
                                    <i class="fas fa-trash text-xs"></i>
                                </a>
                            </div>
                        </td>

                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-20 h-20 bg-purple-50 rounded-full flex items-center justify-center mb-4 animate-pulse">
                                    <i class="fas fa-images text-3xl text-purple-300"></i>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800">Galeri Kosong</h3>
                                <p class="text-gray-500 text-sm mt-1">Belum ada foto kegiatan yang diunggah.</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>