<div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
    <div>
        <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
            <span class="w-3 h-8 bg-gradient-to-b from-orange-400 to-red-500 rounded-full"></span>
            Tulis Berita Baru
        </h1>
        <p class="text-gray-500 text-sm mt-1 ml-6">Bagikan informasi terkini, prestasi, atau kegiatan.</p>
    </div>
    <a href="dashboard.php?page=berita" class="text-gray-600 hover:text-orange-600 font-bold flex items-center gap-2 transition bg-white px-5 py-2.5 rounded-xl border border-gray-200 hover:border-orange-200 shadow-sm hover:shadow-md group">
        <div class="w-6 h-6 rounded-full bg-gray-100 group-hover:bg-orange-100 flex items-center justify-center transition">
            <i class="fas fa-arrow-left text-xs group-hover:-translate-x-0.5 transition-transform"></i>
        </div>
        Kembali
    </a>
</div>

<div class="bg-white rounded-[2rem] shadow-xl shadow-gray-100/50 border border-gray-100 p-8 relative overflow-hidden">
    
    <div class="absolute top-0 right-0 w-64 h-64 bg-orange-50 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 opacity-50 pointer-events-none"></div>

    <form action="dashboard.php?page=simpan_berita" method="POST" enctype="multipart/form-data" class="relative z-10 space-y-8">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            <div class="lg:col-span-4 space-y-6">
                
                <div class="w-full">
                    <label class="block text-sm font-extrabold text-gray-700 mb-2">Gambar Utama <span class="text-red-500">*</span></label>
                    <label for="upload-berita" class="group flex flex-col items-center justify-center w-full aspect-video border-2 border-dashed border-gray-300 rounded-3xl cursor-pointer bg-gray-50/50 hover:bg-orange-50/30 hover:border-orange-400 transition-all duration-300 relative overflow-hidden">
                        
                        <div class="flex flex-col items-center justify-center pt-5 pb-6 text-gray-400 group-hover:text-orange-500 transition-colors z-10">
                            <div class="w-14 h-14 rounded-full bg-white shadow-sm flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-image text-2xl text-orange-400"></i>
                            </div>
                            <p class="text-sm font-bold text-gray-600 group-hover:text-orange-600">Upload Gambar</p>
                            <p class="text-xs text-gray-400 mt-1">JPG, PNG (Max 2MB)</p>
                        </div>
                        
                        <input id="upload-berita" name="gambar_berita" type="file" class="hidden" accept="image/*" onchange="previewImage(this)" required />
                        <img id="image-preview" class="absolute inset-0 w-full h-full object-cover hidden z-20 transition-opacity duration-300" />
                    </label>
                </div>

                <div>
                    <label class="block text-sm font-extrabold text-gray-700 mb-2">Kategori Berita</label>
                    <div class="relative">
                        <select name="kategori_id" required class="w-full pl-4 pr-10 py-3.5 rounded-xl bg-white border border-gray-200 focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 outline-none transition font-semibold text-gray-700 appearance-none cursor-pointer hover:border-orange-300">
                            <option value="" disabled selected>Pilih Kategori...</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= (int)$cat['id'] ?>"><?= h($cat['nama_kategori']) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-orange-500">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>

            </div>

            <div class="lg:col-span-8 space-y-6">
                
                <div>
                    <label class="block text-sm font-extrabold text-gray-700 mb-2">Judul Artikel <span class="text-red-500">*</span></label>
                    <input type="text" name="judul" placeholder="Judul berita yang menarik..." required 
                           class="w-full px-6 py-4 rounded-2xl bg-gray-50 border-transparent focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 outline-none transition text-xl font-bold text-gray-800 placeholder-gray-400 shadow-sm">
                </div>

                <div>
                    <label class="block text-sm font-extrabold text-gray-700 mb-2">Isi Berita <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <textarea name="isi_berita" rows="15" placeholder="Tuliskan konten berita di sini..." required 
                                  class="w-full p-6 rounded-2xl bg-gray-50 border-transparent focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 outline-none transition resize-none text-gray-700 leading-relaxed shadow-sm text-base font-medium"></textarea>
                        <i class="fas fa-paragraph absolute top-6 right-6 text-gray-300"></i>
                    </div>
                </div>

            </div>
        </div>

        <div class="pt-8 border-t border-gray-100 flex items-center justify-end gap-4">
            <a href="dashboard.php?page=berita" class="px-6 py-3.5 rounded-xl text-gray-500 font-bold hover:bg-gray-100 hover:text-gray-700 transition">
                Batal
            </a>
            <button type="submit" class="px-8 py-3.5 bg-gradient-to-r from-orange-600 to-red-500 hover:from-orange-700 hover:to-red-600 text-white font-bold rounded-xl shadow-lg shadow-orange-500/30 transform hover:-translate-y-1 transition duration-300 flex items-center gap-3">
                <i class="fas fa-paper-plane text-sm"></i>
                <span>Publikasikan</span>
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
                img.src = e.target.result;
                img.classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>