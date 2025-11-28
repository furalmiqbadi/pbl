<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Edit Galeri</h1>
</div>

<form action="dashboard.php?page=update_galeri" method="POST" enctype="multipart/form-data" class="space-y-8">
    
    <input type="hidden" name="id" value="<?= $galeri['id'] ?>">

    <div class="w-full">
        <label for="upload-galeri" class="flex flex-col items-center justify-center w-full h-80 border-2 border-gray-300 border-dashed rounded-3xl cursor-pointer bg-gray-100 hover:bg-gray-200 transition relative overflow-hidden group">
            
            <?php if (!empty($galeri['gambar_galeri'])): ?>
                <img src="../../<?= htmlspecialchars($galeri['gambar_galeri']) ?>" class="absolute inset-0 w-full h-full object-cover z-0 opacity-60 group-hover:opacity-40 transition">
            <?php endif; ?>

            <div class="flex flex-col items-center justify-center pt-5 pb-6 text-gray-600 z-10 font-medium">
                <p class="mb-2 text-lg">Klik untuk ganti gambar</p>
                <i class="fas fa-camera text-4xl text-gray-500 mt-2"></i>
            </div>
            
            <input id="upload-galeri" name="gambar_galeri" type="file" class="hidden" accept="image/*" onchange="previewImage(this)" />
            <img id="image-preview" class="absolute inset-0 w-full h-full object-cover hidden z-20" />
        </label>
    </div>

    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
        <label class="block text-sm font-bold text-gray-700 mb-3">Deskripsi Gambar</label>
        <textarea name="deskripsi" rows="5" placeholder="Berikan deskripsi..." required 
                  class="w-full px-6 py-4 bg-gray-50 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:bg-white transition resize-none border border-gray-200"><?= htmlspecialchars($galeri['deskripsi']) ?></textarea>
    </div>

    <div class="flex gap-4 pt-4">
        <button type="submit" class="px-8 py-3 bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-xl shadow-lg hover:shadow-orange-500/30 transition transform hover:-translate-y-0.5">
            Simpan Perubahan
        </button>
        <a href="dashboard.php?page=galeri" class="px-8 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold rounded-xl transition">
            Batal
        </a>
    </div>

</form>

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