<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Tambah Karya Baru</h1>
    <a href="dashboard.php?page=karya" class="text-gray-500 hover:text-gray-700 font-medium flex items-center gap-2">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 max-w-3xl mx-auto">
    <form action="dashboard.php?page=store_karya" method="POST" enctype="multipart/form-data" class="space-y-6">
        
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Judul Karya</label>
            <input type="text" name="judul" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-orange-500 outline-none transition">
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Kategori</label>
            <select name="kategori_id" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-orange-500 outline-none bg-white transition">
                <option value="" disabled selected>-- Pilih Kategori --</option>
                <?php foreach ($kategoriList as $kat): ?>
                    <option value="<?= $kat['id'] ?>"><?= htmlspecialchars($kat['nama_kategori']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Singkat</label>
            <textarea name="isi_proyek" rows="4" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-orange-500 outline-none transition"></textarea>
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Upload Thumbnail</label>
            <input type="file" name="gambar_proyek" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition">
            <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG. Maks 2MB.</p>
        </div>

        <div class="pt-4 flex justify-end">
            <button type="submit" class="px-8 py-3 rounded-xl bg-orange-600 text-white hover:bg-orange-700 font-bold transition shadow-lg">Simpan Data</button>
        </div>

    </form>
</div>