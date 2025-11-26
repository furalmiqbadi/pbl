<div class="mb-8">
    <a href="dashboard.php?page=home" class="text-gray-500 hover:text-orange-500 mb-4 inline-block transition flex items-center gap-2">
        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
    </a>
    <div class="flex flex-col md:flex-row justify-between items-end gap-4 border-b pb-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Hasil Pencarian</h1>
            <p class="text-gray-500 mt-1">Kata kunci: <span class="font-bold text-orange-600 bg-orange-50 px-2 py-1 rounded">"<?= htmlspecialchars($keyword) ?>"</span></p>
        </div>
    </div>
</div>

<?php if (empty($keyword)): ?>
    <div class="p-10 text-center bg-white rounded-xl border border-gray-100 shadow-sm">
        <i class="fas fa-keyboard text-4xl text-gray-200 mb-4"></i>
        <p class="text-gray-500 font-medium">Silakan ketik kata kunci di kolom pencarian di atas.</p>
    </div>
<?php elseif (empty($results['proyek']) && empty($results['berita']) && empty($results['mahasiswa']) && empty($results['dosen'])): ?>
    <div class="flex flex-col items-center justify-center p-16 bg-white rounded-xl border border-gray-100 shadow-sm">
        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4 text-gray-400 text-3xl">
            <i class="fas fa-search"></i>
        </div>
        <h3 class="text-gray-800 font-bold text-lg">Data Tidak Ditemukan</h3>
        <p class="text-gray-500 mt-1">Coba gunakan kata kunci atau ejaan lain.</p>
    </div>
<?php else: ?>

    <?php if (!empty($results['mahasiswa'])): ?>
        <div class="mb-8">
            <h2 class="text-lg font-bold text-gray-700 mb-3 flex items-center gap-2">
                <span class="w-8 h-8 rounded-lg bg-green-100 text-green-600 flex items-center justify-center text-sm"><i class="fas fa-user-graduate"></i></span>
                Ditemukan di Mahasiswa
            </h2>
            <div class="grid grid-cols-1 gap-3">
                <?php foreach ($results['mahasiswa'] as $row): ?>
                    <div class="bg-white p-4 rounded-xl border border-gray-100 hover:border-green-200 hover:shadow-md transition flex justify-between items-center group">
                        <div>
                            <h3 class="font-bold text-gray-800 group-hover:text-green-600 transition"><?= htmlspecialchars($row['nama']) ?></h3>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-xs font-mono text-green-700 bg-green-50 px-2 py-0.5 rounded border border-green-100"><?= htmlspecialchars($row['nim']) ?></span>
                            </div>
                        </div>
                        <a href="dashboard.php?page=mahasiswa&highlight_id=<?= $row['id'] ?>" class="px-4 py-2 text-sm font-bold text-green-600 bg-green-50 rounded-lg hover:bg-green-600 hover:text-white transition">
                            Lihat Data
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($results['dosen'])): ?>
        <div class="mb-8">
            <h2 class="text-lg font-bold text-gray-700 mb-3 flex items-center gap-2">
                <span class="w-8 h-8 rounded-lg bg-red-100 text-red-600 flex items-center justify-center text-sm"><i class="fas fa-chalkboard-teacher"></i></span>
                Ditemukan di Dosen
            </h2>
            <div class="grid grid-cols-1 gap-3">
                <?php foreach ($results['dosen'] as $row): ?>
                    <div class="bg-white p-4 rounded-xl border border-gray-100 hover:border-red-200 hover:shadow-md transition flex justify-between items-center group">
                        <div class="flex items-center gap-4">
                            <img src="../../assets/images/<?= $row['gambar_tim'] ?>" class="w-10 h-10 rounded-full object-cover border border-gray-200">
                            <div>
                                <h3 class="font-bold text-gray-800 group-hover:text-red-600 transition"><?= htmlspecialchars($row['nama']) ?></h3>
                                <p class="text-xs text-gray-500"><?= htmlspecialchars($row['jabatan']) ?></p>
                            </div>
                        </div>
                        <a href="dashboard.php?page=profil&highlight_dosen=<?= $row['id'] ?>" class="px-4 py-2 text-sm font-bold text-red-600 bg-red-50 rounded-lg hover:bg-red-600 hover:text-white transition">
                            Lihat Data
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($results['proyek'])): ?>
        <div class="mb-8">
            <h2 class="text-lg font-bold text-gray-700 mb-3 flex items-center gap-2">
                <span class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center text-sm"><i class="fas fa-laptop-code"></i></span>
                Ditemukan di Karya
            </h2>
            <div class="grid grid-cols-1 gap-3">
                <?php foreach ($results['proyek'] as $row): ?>
                    <a href="dashboard.php?page=proyek&highlight_id=<?= $row['id'] ?>" class="block bg-white p-4 rounded-xl border border-gray-100 hover:border-blue-300 hover:shadow-md transition group">
                        <h3 class="font-bold text-gray-800 group-hover:text-blue-600 transition"><?= htmlspecialchars($row['judul']) ?></h3>
                        <p class="text-sm text-gray-500 truncate mt-1"><?= htmlspecialchars(substr($row['isi_proyek'], 0, 120)) ?>...</p>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($results['berita'])): ?>
        <div class="mb-8">
            <h2 class="text-lg font-bold text-gray-700 mb-3 flex items-center gap-2">
                <span class="w-8 h-8 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center text-sm"><i class="fas fa-newspaper"></i></span>
                Ditemukan di Berita
            </h2>
            <div class="grid grid-cols-1 gap-3">
                <?php foreach ($results['berita'] as $row): ?>
                    <a href="dashboard.php?page=berita&highlight_id=<?= $row['id'] ?>" class="block bg-white p-4 rounded-xl border border-gray-100 hover:border-orange-300 hover:shadow-md transition group">
                        <h3 class="font-bold text-gray-800 group-hover:text-orange-600 transition"><?= htmlspecialchars($row['judul']) ?></h3>
                        <p class="text-sm text-gray-500 truncate mt-1"><?= htmlspecialchars(substr($row['isi_berita'], 0, 120)) ?>...</p>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

<?php endif; ?>