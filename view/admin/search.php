<div class="mb-8">
    <a href="dashboard.php?page=home" class="text-gray-500 hover:text-orange-500 mb-4 inline-block transition">
        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
    </a>
    <h1 class="text-2xl font-bold text-gray-800">Hasil Pencarian</h1>
    <p class="text-gray-500">Kata kunci: <span class="font-bold text-orange-600">"<?= htmlspecialchars($keyword) ?>"</span></p>
</div>

<?php if (empty($keyword)): ?>
    <div class="p-6 bg-yellow-50 text-yellow-700 rounded-xl border border-yellow-100">
        Silakan masukkan kata kunci di kolom pencarian.
    </div>
<?php elseif (empty($results['proyek']) && empty($results['berita']) && empty($results['mahasiswa']) && empty($results['dosen'])): ?>
    <div class="flex flex-col items-center justify-center p-10 bg-white rounded-xl border border-gray-100">
        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4 text-gray-400 text-2xl">
            <i class="fas fa-search"></i>
        </div>
        <h3 class="text-gray-800 font-bold text-lg">Tidak Ditemukan</h3>
        <p class="text-gray-500 mt-1">Coba gunakan kata kunci lain.</p>
    </div>
<?php else: ?>

    <?php if (!empty($results['proyek'])): ?>
        <div class="mb-8">
            <h2 class="text-lg font-bold text-gray-700 mb-3 border-b pb-2 flex items-center gap-2">
                <i class="fas fa-laptop-code text-blue-500"></i> Ditemukan di Karya
            </h2>
            <div class="grid grid-cols-1 gap-3">
                <?php foreach ($results['proyek'] as $row): ?>
                    <a href="dashboard.php?page=proyek" class="block bg-white p-4 rounded-xl border border-gray-100 hover:shadow-md transition hover:border-orange-300 group">
                        <h3 class="font-bold text-gray-800 group-hover:text-orange-600 transition"><?= htmlspecialchars($row['judul']) ?></h3>
                        <p class="text-sm text-gray-500 truncate mt-1"><?= htmlspecialchars(substr($row['isi_proyek'], 0, 100)) ?>...</p>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($results['berita'])): ?>
        <div class="mb-8">
            <h2 class="text-lg font-bold text-gray-700 mb-3 border-b pb-2 flex items-center gap-2">
                <i class="fas fa-newspaper text-orange-500"></i> Ditemukan di Berita
            </h2>
            <div class="grid grid-cols-1 gap-3">
                <?php foreach ($results['berita'] as $row): ?>
                    <a href="dashboard.php?page=berita" class="block bg-white p-4 rounded-xl border border-gray-100 hover:shadow-md transition hover:border-orange-300 group">
                        <h3 class="font-bold text-gray-800 group-hover:text-orange-600 transition"><?= htmlspecialchars($row['judul']) ?></h3>
                        <p class="text-sm text-gray-500 truncate mt-1"><?= htmlspecialchars(substr($row['isi_berita'], 0, 100)) ?>...</p>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($results['mahasiswa'])): ?>
        <div class="mb-8">
            <h2 class="text-lg font-bold text-gray-700 mb-3 border-b pb-2 flex items-center gap-2">
                <i class="fas fa-user-graduate text-green-500"></i> Ditemukan di Mahasiswa
            </h2>
            <div class="grid grid-cols-1 gap-3">
                <?php foreach ($results['mahasiswa'] as $row): ?>
                    <div class="bg-white p-4 rounded-xl border border-gray-100 flex justify-between items-center">
                        <div>
                            <h3 class="font-bold text-gray-800"><?= htmlspecialchars($row['nama']) ?></h3>
                            <span class="text-xs font-mono text-orange-600 bg-orange-50 px-2 py-1 rounded mt-1 inline-block"><?= htmlspecialchars($row['nim']) ?></span>
                        </div>
                        <a href="dashboard.php?page=mahasiswa" class="text-sm font-semibold text-orange-500 hover:underline">Lihat Data</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($results['dosen'])): ?>
        <div class="mb-8">
            <h2 class="text-lg font-bold text-gray-700 mb-3 border-b pb-2 flex items-center gap-2">
                <i class="fas fa-chalkboard-teacher text-red-500"></i> Ditemukan di Dosen
            </h2>
            <div class="grid grid-cols-1 gap-3">
                <?php foreach ($results['dosen'] as $row): ?>
                    <div class="bg-white p-4 rounded-xl border border-gray-100 flex justify-between items-center">
                        <div>
                            <h3 class="font-bold text-gray-800"><?= htmlspecialchars($row['nama']) ?></h3>
                            <p class="text-xs text-gray-500 mt-1"><?= htmlspecialchars($row['jabatan']) ?></p>
                        </div>
                        <a href="dashboard.php?page=dosen" class="text-sm font-semibold text-orange-500 hover:underline">Lihat Data</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

<?php endif; ?>