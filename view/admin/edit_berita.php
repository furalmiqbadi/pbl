<div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
    <div>
        <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
            <span class="w-3 h-8 bg-gradient-to-b from-blue-400 to-blue-600 rounded-full"></span>
            Edit Berita
        </h1>
        <p class="text-gray-500 text-sm mt-1 ml-6">Perbarui informasi artikel.</p>
    </div>
    <a href="dashboard.php?page=berita" class="text-gray-600 hover:text-blue-600 font-bold flex items-center gap-2 transition bg-white px-5 py-2.5 rounded-xl border border-gray-200 hover:border-blue-200 shadow-sm hover:shadow-md group">
        <div class="w-6 h-6 rounded-full bg-gray-100 group-hover:bg-blue-100 flex items-center justify-center transition">
            <i class="fas fa-arrow-left text-xs group-hover:-translate-x-0.5 transition-transform"></i>
        </div>
        Batal
    </a>
</div>

<div class="bg-white rounded-[2rem] shadow-xl shadow-gray-100/50 border border-gray-100 p-8 relative overflow-hidden">
    
    <div class="absolute top-0 right-0 w-64 h-64 bg-blue-50 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 opacity-50 pointer-events-none"></div>

    <form action="dashboard.php?page=update_berita" method="POST" enctype="multipart/form-data" class="relative z-10 space-y-8">
        
        <input type="hidden" name="id" value="<?= (int)$berita['id'] ?>">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            <div class="lg:col-span-4 space-y-6">
                
                <div class="w-full">
                    <label class="block text-sm font-extrabold text-gray-700 mb-2">Gambar Utama</label>
                    <label for="upload-berita" class="group flex flex-col items-center justify-center w-full aspect-video border-2 border-dashed border-gray-300 rounded-3xl cursor-pointer bg-gray-50/50 hover:bg-blue-50/30 hover:border-blue-400 transition-all duration-300 relative overflow-hidden">
                        
                        <?php if (!empty($berita['gambar_berita'])): ?>
                            <img src="../<?= h($berita['gambar_berita']) ?>" class="absolute inset-0 w-full h-full object-cover z-0 opacity-100 group-hover:opacity-40 transition-opacity duration-300" id="current-image">
                        <?php endif; ?>

                        <div class="flex flex-col items-center justify-center pt-5 pb-6 text-gray-400 group-hover:text-blue-500 transition-colors z-10 <?= !empty($berita['gambar_berita']) ? 'opacity-0 group-hover:opacity-100' : '' ?>">
                            <div class="w-14 h-14 rounded-full bg-white shadow-sm flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-camera text-2xl text-blue-400"></i>
                            </div>
                            <p class="text-sm font-bold text-gray-600 group-hover:text-blue-600">Ganti Gambar</p>
                        </div>
                        
                        <input id="upload-berita" name="gambar_berita" type="file" class="hidden" accept="image/*" onchange="previewImage(this)" />
                        <img id="image-preview" class="absolute inset-0 w-full h-full object-cover hidden z-20 transition-opacity duration-300" />
                    </label>
                </div>

                <div>
                    <label class="block text-sm font-extrabold text-gray-700 mb-2">Kategori</label>
                    <div class="relative">
                        <select name="kategori_id" required class="w-full pl-4 pr-10 py-3.5 rounded-xl bg-white border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition font-semibold text-gray-700 appearance-none cursor-pointer hover:border-blue-300">
                            <option value="" disabled>Pilih Kategori</option>
                            <?php foreach ($categories as $cat): ?>
                                <?php $selected = ($cat['id'] == $berita['kategori_id']) ? 'selected' : ''; ?>
                                <option value="<?= (int)$cat['id'] ?>" <?= $selected ?>>
                                    <?= h($cat['nama_kategori']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-blue-500">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>

            </div>

            <div class="lg:col-span-8 space-y-6">
                
                <div>
                    <label class="block text-sm font-extrabold text-gray-700 mb-2">Judul Artikel</label>
                    <input type="text" name="judul" value="<?= h($berita['judul']) ?>" required 
                           class="w-full px-6 py-4 rounded-2xl bg-gray-50 border-transparent focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition text-xl font-bold text-gray-800 placeholder-gray-400 shadow-sm">
                </div>

                <div>
                    <label class="block text-sm font-extrabold text-gray-700 mb-2">Isi Berita</label>
                    <div class="relative">
                        <textarea name="isi_berita" rows="15" required 
                                  class="w-full p-6 rounded-2xl bg-gray-50 border-transparent focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition resize-none text-gray-700 leading-relaxed shadow-sm text-base font-medium"><?= h($berita['isi_berita']) ?></textarea>
                        <i class="fas fa-paragraph absolute top-6 right-6 text-gray-300"></i>
                    </div>
                </div>

            </div>
        </div>

        <div class="pt-8 border-t border-gray-100 flex items-center justify-end gap-4">
            <a href="dashboard.php?page=berita" class="px-6 py-3.5 rounded-xl text-gray-500 font-bold hover:bg-gray-100 hover:text-gray-700 transition">
                Batal
            </a>
            <button type="submit" class="px-8 py-3.5 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white font-bold rounded-xl shadow-lg shadow-blue-500/30 transform hover:-translate-y-1 transition duration-300 flex items-center gap-3">
                <i class="fas fa-save text-sm"></i>
                <span>Simpan Perubahan</span>
            </button>
        </div>

    </form>
</div>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var img = document.getElementById('image-preview');
                var current = document.getElementById('current-image');
                
                img.src = e.target.result;
                img.classList.remove('hidden');
                if(current) current.classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>