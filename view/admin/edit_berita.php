<div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 max-w-4xl mx-auto">
    
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h2 class="text-2xl font-bold text-gray-800">Edit Berita</h2>
        <a href="dashboard.php?page=berita" class="text-gray-500 hover:text-gray-700 text-sm flex items-center gap-1">
            &larr; Batal
        </a>
    </div>

    <form action="dashboard.php?page=update_berita" method="POST" enctype="multipart/form-data" class="space-y-6">
        
        <input type="hidden" name="id" value="<?= (int)$berita['id'] ?>">

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Artikel</label>
            <input type="text" name="judul" required value="<?= h($berita['judul']) ?>"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-200 focus:border-orange-500 outline-none transition">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                <select name="kategori_id" required 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-200 focus:border-orange-500 outline-none bg-white">
                    <option value="" disabled>Pilih Kategori</option>
                    <?php foreach ($categories as $cat): ?>
                        <?php $selected = ($cat['id'] == $berita['kategori_id']) ? 'selected' : ''; ?>
                        <option value="<?= (int)$cat['id'] ?>" <?= $selected ?>>
                            <?= h($cat['nama_kategori']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Utama</label>
                
                <?php if (!empty($berita['gambar_berita'])): ?>
                    <div class="mb-3 p-1 border rounded inline-block">
                        <img src="../<?= h($berita['gambar_berita']) ?>" alt="Preview" class="h-20 w-auto object-cover rounded">
                        <p class="text-xs text-gray-400 mt-1">Gambar saat ini</p>
                    </div>
                <?php endif; ?>

                <input type="file" name="gambar_berita" accept="image/*"
                       class="block w-full text-sm text-slate-500
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-full file:border-0
                              file:text-sm file:font-semibold
                              file:bg-orange-50 file:text-orange-700
                              hover:file:bg-orange-100">
                <p class="mt-1 text-xs text-gray-400">Biarkan kosong jika tidak ingin mengubah gambar.</p>
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Isi Berita</label>
            <textarea name="isi_berita" rows="10" required
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-200 focus:border-orange-500 outline-none transition"><?= h($berita['isi_berita']) ?></textarea>
        </div>

        <div class="flex justify-end pt-4 border-t">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-lg shadow-md transition transform hover:-translate-y-0.5">
                Simpan Perubahan
            </button>
        </div>

    </form>
</div>