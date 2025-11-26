<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Kelola Data Karya</h1>
    <a href="dashboard.php?page=tambah_karya" class="bg-orange-600 text-white px-5 py-2.5 rounded-xl hover:bg-orange-700 transition shadow-lg font-medium flex items-center gap-2">
        <i class="fas fa-plus"></i> Tambah Karya
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-bold tracking-wider">
            <tr>
                <th class="px-6 py-4">No</th>
                <th class="px-6 py-4">Thumbnail</th>
                <th class="px-6 py-4">Judul Karya</th>
                <th class="px-6 py-4">Kategori</th>
                <th class="px-6 py-4 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
            <?php if (!empty($karya)): ?>
                <?php $no = 1; foreach ($karya as $row): ?>
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="px-6 py-4 font-medium text-gray-500"><?= $no++ ?></td>
                    <td class="px-6 py-4">
                        <?php if ($row['gambar_proyek']): ?>
                            <img src="../../<?= htmlspecialchars($row['gambar_proyek']) ?>" class="w-16 h-16 object-cover rounded-lg border border-gray-200">
                        <?php else: ?>
                            <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center text-xs text-gray-400">No Img</div>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-semibold text-gray-800"><?= htmlspecialchars($row['judul']) ?></div>
                        <div class="text-xs text-gray-500 mt-1 truncate w-64"><?= htmlspecialchars($row['isi_proyek']) ?></div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-600">
                            <?= htmlspecialchars($row['nama_kategori'] ?? '-') ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center space-x-3">
                        <a href="dashboard.php?page=edit_karya&id=<?= $row['id'] ?>" class="text-blue-500 hover:text-blue-700 font-medium transition">Edit</a>
                        <span class="text-gray-300">|</span>
                        <a href="dashboard.php?page=hapus_karya&id=<?= $row['id'] ?>" class="text-red-500 hover:text-red-700 font-medium transition" onclick="return confirm('Yakin ingin menghapus karya ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5" class="text-center py-8 text-gray-500">Belum ada data karya.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>