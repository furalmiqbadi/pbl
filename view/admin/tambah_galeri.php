<div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
    <div>
        <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
            <span class="w-3 h-8 bg-gradient-to-b from-purple-400 to-purple-600 rounded-full"></span>
            Tambah Galeri Baru
        </h1>
        <p class="text-gray-500 text-sm mt-1 ml-6">Unggah foto dokumentasi kegiatan terbaru.</p>
    </div>
    <a href="dashboard.php?page=galeri" class="text-gray-600 hover:text-purple-600 font-bold flex items-center gap-2 transition bg-white px-5 py-2.5 rounded-xl border border-gray-200 hover:border-purple-200 shadow-sm hover:shadow-md group">
        <div class="w-6 h-6 rounded-full bg-gray-100 group-hover:bg-purple-100 flex items-center justify-center transition">
            <i class="fas fa-arrow-left text-xs group-hover:-translate-x-0.5 transition-transform"></i>
        </div>
        Kembali
    </a>
</div>

<div class="bg-white rounded-[2rem] shadow-xl shadow-gray-100/50 border border-gray-100 p-8 relative overflow-hidden">
    
    <div class="absolute top-0 right-0 w-64 h-64 bg-purple-50 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 opacity-50 pointer-events-none"></div>

    <form action="dashboard.php?page=store_galeri" method="POST" enctype="multipart/form-data" class="relative z-10 space-y-8">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <div class="lg:col-span-5 space-y-4">
                <label class="block text-sm font-extrabold text-gray-700 tracking-wide">
                    File Gambar <span class="text-red-500">*</span>
                </label>
                
                <label for="upload-galeri" class="group flex flex-col items-center justify-center w-full aspect-[4/3] border-2 border-dashed border-gray-300 rounded-3xl cursor-pointer bg-gray-50/50 hover:bg-purple-50/30 hover:border-purple-400 transition-all duration-300 relative overflow-hidden shadow-sm hover:shadow-md">
                    
                    <div class="flex flex-col items-center justify-center pt-5 pb-6 text-gray-400 group-hover:text-purple-500 transition-colors z-10">
                        <div class="w-16 h-16 rounded-full bg-white shadow-sm flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-cloud-upload-alt text-3xl text-purple-400"></i>
                        </div>
                        <p class="text-sm font-bold text-gray-600 group-hover:text-purple-600">Klik untuk upload</p>
                        <p class="text-xs text-gray-400 mt-1">JPG, PNG (Max. 2MB)</p>
                    </div>
                    
                    <input id="upload-galeri" name="gambar_galeri" type="file" class="hidden" accept="image/*" onchange="previewImage(this)" required />
                    <img id="image-preview" class="absolute inset-0 w-full h-full object-cover hidden z-20 transition-opacity duration-300" />
                    
                    <div id="image-overlay" class="absolute inset-0 bg-black/40 hidden z-30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <p class="text-white font-bold text-sm bg-white/20 backdrop-blur px-4 py-2 rounded-full">Ganti Gambar</p>
                    </div>
                </label>
            </div>

            <div class="lg:col-span-7 space-y-6">
                
                <div>
                    <label class="block text-sm font-extrabold text-gray-700 mb-2">Deskripsi Foto <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <textarea name="deskripsi" rows="8" placeholder="Ceritakan tentang momen ini..." required 
                                  class="w-full p-6 rounded-2xl bg-gray-50 border-transparent focus:bg-white focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 outline-none transition resize-none text-gray-700 leading-relaxed shadow-sm text-base font-medium placeholder-gray-400"></textarea>
                        <i class="fas fa-align-left absolute top-6 right-6 text-gray-300"></i>
                    </div>
                    <p class="text-xs text-gray-400 mt-2 text-right">Min. 10 karakter</p>
                </div>

                <div class="bg-blue-50 border border-blue-100 rounded-2xl p-4 flex gap-3 items-start">
                    <i class="fas fa-info-circle text-blue-500 mt-0.5"></i>
                    <p class="text-xs text-blue-700 leading-relaxed">
                        Pastikan gambar memiliki resolusi yang baik agar tidak pecah saat ditampilkan di halaman utama website.
                    </p>
                </div>

            </div>
        </div>

        <div class="pt-8 border-t border-gray-100 flex items-center justify-end gap-4">
            <a href="dashboard.php?page=galeri" class="px-6 py-3.5 rounded-xl text-gray-500 font-bold hover:bg-gray-100 hover:text-gray-700 transition">
                Batal
            </a>
            <button type="submit" class="px-8 py-3.5 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-purple-500/30 transform hover:-translate-y-1 transition duration-300 flex items-center gap-3">
                <i class="fas fa-save text-sm"></i>
                <span>Simpan Gambar</span>
            </button>
        </div>

    </form>
</div>

<script>
    function previewImage(input) {
        const preview = document.getElementById('image-preview');
        const overlay = document.getElementById('image-overlay');
        
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                overlay.classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>