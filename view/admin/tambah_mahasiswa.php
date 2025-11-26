<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Tambah Mahasiswa Baru</h1>
    <a href="dashboard.php?page=mahasiswa" class="text-gray-500 hover:text-gray-700 font-medium flex items-center gap-2">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 max-w-3xl mx-auto">
    <form action="dashboard.php?page=store_mahasiswa" method="POST" class="space-y-6">
        
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">NIM</label>
            <input type="text" name="nim" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-orange-500 outline-none">
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
            <input type="text" name="nama" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-orange-500 outline-none">
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Program Studi</label>
            <select name="prodi_id" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-orange-500 outline-none bg-white">
                <option value="" disabled selected>-- Pilih Program Studi --</option>
                <?php foreach ($prodiList as $p): ?>
                    <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nama_prodi']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="pt-4 flex justify-end">
            <button type="submit" class="px-8 py-3 rounded-xl bg-orange-600 text-white hover:bg-orange-700 font-bold">Simpan Data</button>
        </div>

    </form>
</div>