<div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
            <span class="w-3 h-8 bg-gradient-to-b from-orange-400 to-red-500 rounded-full"></span>
            Kelola Data Karya
        </h1>
        <p class="text-gray-500 text-sm mt-2 ml-6">Manajemen portofolio proyek mahasiswa dan penelitian dosen.</p>
    </div>
    
    <a href="dashboard.php?page=tambah_karya" 
       class="group bg-gradient-to-r from-orange-600 to-red-500 text-white px-7 py-3.5 rounded-2xl hover:shadow-lg hover:shadow-orange-500/30 hover:-translate-y-1 transition-all duration-300 font-bold flex items-center gap-3">
        <div class="bg-white/20 p-1.5 rounded-lg group-hover:rotate-90 transition duration-300">
            <i class="fas fa-plus text-xs"></i>
        </div>
        <span>Tambah Karya Baru</span>
    </a>
</div>

<div class="bg-white rounded-[2rem] shadow-xl shadow-gray-100/50 border border-gray-100 overflow-hidden relative">
    
    <div class="absolute top-0 right-0 w-32 h-32 bg-orange-50 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2 opacity-60 pointer-events-none"></div>

    <div class="overflow-x-auto relative z-10">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50/80 text-gray-500 uppercase text-xs font-extrabold tracking-wider border-b border-gray-100">
                <tr>
                    <th class="px-8 py-6 w-20 text-center">No</th>
                    <th class="px-6 py-6 w-40">Thumbnail</th>
                    <th class="px-6 py-6">Detail Karya</th>
                    <th class="px-6 py-6 w-56 text-center">Atribut</th>
                    <th class="px-6 py-6 w-40 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 text-sm text-gray-700">
                <?php if (!empty($karya)): ?>
                    <?php $no = 1; foreach ($karya as $row): ?>
                    <tr class="hover:bg-orange-50/30 transition duration-300 group">
                        
                        <td class="px-8 py-5 text-center font-bold text-gray-400 group-hover:text-orange-500 transition">
                            <?= $no++ ?>
                        </td>

                        <td class="px-6 py-5">
                            <div class="h-24 w-32 rounded-2xl overflow-hidden bg-white border border-gray-100 shadow-sm group-hover:shadow-md group-hover:border-orange-200 transition-all relative">
                                <?php if (!empty($row['gambar_proyek'])): ?>
                                    <img src="../../<?= htmlspecialchars($row['gambar_proyek']) ?>" 
                                         class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700"
                                         alt="Thumbnail">
                                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition duration-300"></div>
                                <?php else: ?>
                                    <div class="w-full h-full flex flex-col items-center justify-center text-gray-300 bg-gray-50">
                                        <i class="fas fa-image text-2xl mb-2"></i>
                                        <span class="text-[10px] font-medium">No Image</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </td>

                        <td class="px-6 py-5">
                            <div class="max-w-md space-y-2">
                                <h3 class="text-lg font-bold text-gray-800 group-hover:text-orange-600 transition duration-200">
                                    <?= htmlspecialchars($row['judul']) ?>
                                </h3>
                                
                                <div class="flex items-center gap-2">
                                    <div class="w-1 h-1 rounded-full bg-gray-300"></div>
                                    <p class="text-gray-500 text-xs leading-relaxed line-clamp-2">
                                        <?= htmlspecialchars(strip_tags($row['isi_proyek'])) ?>
                                    </p>
                                </div>

                                <div class="flex items-center gap-2 mt-2">
                                    <span class="flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-gray-50 border border-gray-100 text-xs font-semibold text-gray-500">
                                        <i class="fas fa-users text-blue-400"></i>
                                        <?= htmlspecialchars($row['nama_tim'] ?? 'Tim Tidak Diketahui') ?>
                                    </span>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-5 text-center">
                            <div class="flex flex-col items-center gap-2">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-orange-100 text-orange-700 border border-orange-200 shadow-sm">
                                    <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span>
                                    <?= htmlspecialchars($row['nama_kategori'] ?? 'Umum') ?>
                                </span>
                                
                                <span class="text-xs font-mono font-bold text-blue-600 bg-blue-50 px-3 py-1 rounded-full border border-blue-100">
                                    <i class="far fa-calendar-alt mr-1"></i>
                                    <?= htmlspecialchars($row['tahun'] ?? '-') ?>
                                </span>
                            </div>
                        </td>

                        <td class="px-6 py-5 text-center">
                            <div class="flex justify-center gap-3 opacity-90">
                                <a href="dashboard.php?page=edit_karya&id=<?= $row['id'] ?>" 
                                   class="w-10 h-10 flex items-center justify-center rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all shadow-sm hover:shadow-blue-200"
                                   title="Edit Data">
                                    <i class="fas fa-pen text-xs"></i>
                                </a>
                                <a href="dashboard.php?page=hapus_karya&id=<?= $row['id'] ?>" 
                                   class="w-10 h-10 flex items-center justify-center rounded-xl bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition-all shadow-sm hover:shadow-red-200"
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus karya ini? Tindakan ini tidak dapat dibatalkan.')"
                                   title="Hapus Data">
                                    <i class="fas fa-trash text-xs"></i>
                                </a>
                            </div>
                        </td>

                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-24 h-24 bg-orange-50 rounded-full flex items-center justify-center mb-4 animate-pulse">
                                    <i class="fas fa-folder-open text-4xl text-orange-200"></i>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800">Belum ada karya</h3>
                                <p class="text-gray-500 text-sm mt-1 max-w-xs mx-auto">Mulai tambahkan portofolio mahasiswa atau dosen sekarang.</p>
                                <a href="dashboard.php?page=tambah_karya" class="mt-4 text-orange-600 font-bold hover:underline text-sm">
                                    + Tambah Karya Pertama
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>