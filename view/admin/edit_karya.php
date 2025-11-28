<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Edit Data Karya</h1>
</div>

<form action="dashboard.php?page=update_karya" method="POST" enctype="multipart/form-data" class="space-y-8">
    
    <input type="hidden" name="id" value="<?= $karya['id'] ?>">

    <div class="w-full">
        <label for="upload-thumbnail" class="flex flex-col items-center justify-center w-full h-80 border-2 border-gray-300 border-dashed rounded-3xl cursor-pointer bg-gray-100 hover:bg-gray-200 transition relative overflow-hidden group">
            
            <?php if (!empty($karya['gambar_proyek'])): ?>
                <img src="../../<?= htmlspecialchars($karya['gambar_proyek']) ?>" class="absolute inset-0 w-full h-full object-cover z-0 opacity-60 group-hover:opacity-40 transition">
            <?php endif; ?>

            <div class="flex flex-col items-center justify-center pt-5 pb-6 text-gray-600 z-10 font-medium">
                <p class="mb-2 text-lg">Klik untuk ganti gambar (Opsional)</p>
                <i class="fas fa-camera text-4xl text-gray-500 mt-2"></i>
            </div>
            
            <input id="upload-thumbnail" name="gambar_proyek" type="file" class="hidden" accept="image/*" onchange="previewImage(this)" />
            <img id="image-preview" class="absolute inset-0 w-full h-full object-cover hidden z-20" />
        </label>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <div class="lg:col-span-4 space-y-6">
            
            <div class="bg-gray-50 p-5 rounded-2xl border border-gray-100">
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Kategori</label>
                <select name="kategori_id" required class="w-full bg-transparent border-b border-gray-300 py-2 focus:outline-none focus:border-orange-500 font-semibold text-gray-800 cursor-pointer">
                    <option value="" disabled>Pilih Kategori</option>
                    <?php foreach ($kategoriList as $kat): ?>
                        <option value="<?= $kat['id'] ?>" <?= ($kat['id'] == $karya['kategori_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($kat['nama_kategori']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="bg-gray-50 p-5 rounded-2xl border border-gray-100">
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Tahun</label>
                <input type="number" name="tahun" value="<?= htmlspecialchars($karya['tahun'] ?? '') ?>" placeholder="Contoh: 2024" required 
                       class="w-full bg-transparent border-b border-gray-300 py-2 focus:outline-none focus:border-orange-500 font-semibold text-gray-800">
            </div>

            <div class="bg-gray-50 p-5 rounded-2xl border border-gray-100">
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Nama Tim</label>
                <input type="text" name="nama_tim" value="<?= htmlspecialchars($karya['nama_tim'] ?? '') ?>" placeholder="Masukkan Nama Tim" required 
                       class="w-full bg-transparent border-b border-gray-300 py-2 focus:outline-none focus:border-orange-500 font-semibold text-gray-800">
            </div>

            <div class="bg-gray-50 p-5 rounded-2xl border border-gray-100">
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Anggota Tim</label>
                
                <div class="relative mb-3">
                    <input type="text" id="search-mhs" placeholder="Cari Nama/NIM..." 
                           class="w-full pl-9 pr-4 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-orange-500 transition shadow-sm bg-white" autocomplete="off">
                    <i class="fas fa-search absolute left-3 top-2.5 text-gray-400 text-xs"></i>
                </div>

                <div id="mhs-list" class="h-48 overflow-y-auto pr-2 space-y-2 scrollbar-thin scrollbar-thumb-gray-300">
                    <?php if (!empty($mahasiswaList)): ?>
                        <?php foreach ($mahasiswaList as $mhs): ?>
                            <?php 
                                // Cek apakah mahasiswa ini sudah ada di tim (untuk atribut checked)
                                $isChecked = in_array($mhs['id'], $selectedMembers) ? 'checked' : ''; 
                            ?>
                            <label class="mhs-item flex items-center space-x-3 p-2 hover:bg-white rounded-lg cursor-pointer transition border border-transparent hover:border-gray-200 group">
                                <input type="checkbox" name="anggota_tim[]" value="<?= $mhs['id'] ?>" <?= $isChecked ?> 
                                       class="w-4 h-4 text-orange-500 border-gray-300 rounded focus:ring-orange-500 cursor-pointer">
                                <div class="text-sm cursor-pointer w-full">
                                    <p class="font-semibold text-gray-800 mhs-name group-hover:text-orange-600 transition"><?= htmlspecialchars($mhs['nama']) ?></p>
                                    <p class="text-xs text-gray-400 mhs-nim"><?= htmlspecialchars($mhs['nim']) ?></p>
                                </div>
                            </label>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-xs text-gray-400 text-center py-4">Data mahasiswa kosong.</p>
                    <?php endif; ?>
                </div>
                <p class="text-[10px] text-gray-400 mt-2 italic">* Centang untuk memilih/menghapus anggota.</p>
            </div>

        </div>

        <div class="lg:col-span-8 space-y-6">
            
            <div>
                <h2 class="text-xl font-bold text-gray-800 mb-3">Judul Karya</h2>
                <input type="text" name="judul" value="<?= htmlspecialchars($karya['judul']) ?>" placeholder="Judul Karya..." required 
                       class="w-full px-6 py-4 bg-gray-100 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:bg-white transition text-lg font-medium shadow-sm">
            </div>

            <div>
                <h2 class="text-xl font-bold text-gray-800 mb-3">Deskripsi Singkat</h2>
                <textarea name="deskripsi" rows="12" placeholder="Deskripsi karya..." required 
                          class="w-full px-6 py-4 bg-gray-100 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:bg-white transition resize-none shadow-sm"><?= htmlspecialchars($karya['isi_proyek']) ?></textarea>
            </div>

        </div>
    </div>

    <div class="flex gap-4 pt-6 border-t border-gray-100">
        <button type="submit" class="px-8 py-3 bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-xl shadow-lg hover:shadow-orange-500/30 transition transform hover:-translate-y-0.5">
            Simpan Perubahan
        </button>
        <a href="dashboard.php?page=karya" class="px-8 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold rounded-xl transition">
            Batal
        </a>
    </div>

</form>

<script>
    // 1. Preview Gambar
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

    // 2. Fitur Live Search Mahasiswa
    document.getElementById('search-mhs').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let items = document.querySelectorAll('.mhs-item');
        
        items.forEach(item => {
            let name = item.querySelector('.mhs-name').innerText.toLowerCase();
            let nim = item.querySelector('.mhs-nim').innerText.toLowerCase();
            
            if (name.includes(filter) || nim.includes(filter)) {
                item.style.display = "flex";
            } else {
                item.style.display = "none";
            }
        });
    });
</script>