<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Data Mahasiswa</h1>
    <a href="dashboard.php?page=tambah_mahasiswa" class="bg-orange-600 text-white px-5 py-2.5 rounded-xl hover:bg-orange-700 transition shadow-lg font-medium flex items-center gap-2">
        <i class="fas fa-plus"></i> Tambah Mahasiswa
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-bold tracking-wider">
            <tr>
                <th class="px-6 py-4">No</th>
                <th class="px-6 py-4">NIM</th>
                <th class="px-6 py-4">Nama Mahasiswa</th>
                <th class="px-6 py-4">Program Studi</th>
                <th class="px-6 py-4 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
            <?php if (!empty($mahasiswa)): ?>
                <?php $no = 1; foreach ($mahasiswa as $row): ?>
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="px-6 py-4 font-medium text-gray-500"><?= $no++ ?></td>
                    <td class="px-6 py-4 font-mono text-orange-600 font-semibold bg-orange-50 rounded-lg w-fit px-2 py-1">
                        <?= htmlspecialchars($row['nim']) ?>
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-800"><?= htmlspecialchars($row['nama']) ?></td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-600">
                            <?= htmlspecialchars($row['nama_prodi'] ?? '-') ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center space-x-3">
                    <a href="dashboard.php?page=edit_mahasiswa&id=<?= $row['id'] ?>" 
                    class="text-blue-500 hover:text-blue-700 font-medium transition">
                    Edit
                    </a>
                    
                    <span class="text-gray-300">|</span>
                    
                    <a href="dashboard.php?page=hapus_mahasiswa&id=<?= $row['id'] ?>" 
                    class="text-red-500 hover:text-red-700 font-medium transition" 
                    onclick="return confirm('Yakin ingin menghapus data <?= $row['nama'] ?>?')">
                    Hapus
                    </a>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5" class="text-center py-4">Data kosong</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>