<div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
    <div>
        <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
            <span class="w-3 h-8 bg-gradient-to-b from-purple-400 to-purple-600 rounded-full"></span>
            Edit Galeri
        </h1>
        <p class="text-gray-500 text-sm mt-1 ml-6">Perbarui informasi atau ganti gambar.</p>
    </div>
    <a href="dashboard.php?page=galeri" class="text-gray-600 hover:text-purple-600 font-bold flex items-center gap-2 transition bg-white px-5 py-2.5 rounded-xl border border-gray-200 hover:border-purple-200 shadow-sm hover:shadow-md group">
        <div class="w-6 h-6 rounded-full bg-gray-100 group-hover:bg-purple-100 flex items-center justify-center transition">
            <i class="fas fa-arrow-left text-xs group-hover:-translate-x-0.5 transition-transform"></i>
        </div>
        Kembali
    </a>
</div>

<div class="bg-white rounded-[2rem] shadow-xl shadow-gray-100/50 border border-gray-100 p-8 relative overflow-hidden">
    
    <div class="absolute top-0 left-0 w-64 h-64 bg-purple-50 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2 opacity-60 pointer-events-none"></div>

    <form action="dashboard.php?page=update_galeri" method="POST" enctype="multipart/form-data" class="relative z-10 space-y-8">
        
        <input type="hidden" name="id" value="<?= $galeri['id'] ?>">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <div class="lg:col-span-5 space-y-4">
                <label class="block text-sm font-extrabold text-gray-700 tracking-wide">
                    File Gambar
                </label>
                
                <label for="upload-galeri" class="group flex flex-col items-center justify-center w-full aspect-[4/3] border-2 border-dashed border-gray-300 rounded-3xl cursor-pointer bg-gray-50/50 hover:bg-purple-50/30 hover:border-purple-400 transition-all duration-300 relative overflow-hidden shadow-sm hover:shadow-md">
                    
                    <?php if (!empty($galeri['gambar_galeri'])): ?>
                        <img src="../../<?= htmlspecialchars($galeri['gambar_galeri']) ?>" class="absolute inset-0 w-full h-full object-cover z-0 opacity-100 group-hover:opacity-40 transition-opacity duration-300" id="current-image">
                    <?php endif; ?>

                    <div class="flex flex-col items-center justify-center pt-5 pb-6 text-gray-400 group-hover:text-purple-500 transition-colors z-10 <?= !empty($galeri['gambar_galeri']) ? 'opacity-0 group-hover:opacity-100' : '' ?>">
                        <div class="w-16 h-16 rounded-full bg-white shadow-sm flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-camera text-3xl text-purple-400"></i>
                        </div>
                        <p class="text-sm font-bold text-gray-600 group-hover:text-purple-600">Ganti Gambar</p>
                    </div>
                    
                    <input id="upload-galeri" name="gambar_galeri" type="file" class="hidden" accept="image/*" onchange="previewImage(this)" />
                    <img id="image-preview" class="absolute inset-0 w-full h-full object-cover hidden z-20 transition-opacity duration-300" />
                </label>
            </div>

            <div class="lg:col-span-7 space-y-6">
                
                <div>
                    <label class="block text-sm font-extrabold text-gray-700 mb-2">Deskripsi Foto <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <textarea name="deskripsi" rows="8" placeholder="Berikan deskripsi..." required 
                                  class="w-full p-6 rounded-2xl bg-gray-50 border-transparent focus:bg-white focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 outline-none transition resize-none text-gray-700 leading-relaxed shadow-sm text-base font-medium placeholder-gray-400"><?= htmlspecialchars($galeri['deskripsi']) ?></textarea>
                        <i class="fas fa-pen absolute top-6 right-6 text-gray-300"></i>
                    </div>
                </div>

            </div>
        </div>

        <div class="pt-8 border-t border-gray-100 flex items-center justify-end gap-4">
            <a href="dashboard.php?page=galeri" class="px-6 py-3.5 rounded-xl text-gray-500 font-bold hover:bg-gray-100 hover:text-gray-700 transition">
                Batal
            </a>
            <button type="submit" class="px-8 py-3.5 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-purple-500/30 transform hover:-translate-y-1 transition duration-300 flex items-center gap-3">
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