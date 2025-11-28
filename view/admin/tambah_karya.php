<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Tambahkan Karya Baru</h1>
</div>

<form action="dashboard.php?page=store_karya" method="POST" enctype="multipart/form-data" class="space-y-8">

    <div class="w-full">
        <label for="upload-thumbnail" class="flex flex-col items-center justify-center w-full h-80 border-2 border-gray-300 border-dashed rounded-3xl cursor-pointer bg-gray-100 hover:bg-gray-200 transition relative overflow-hidden group">
            <div class="flex flex-col items-center justify-center pt-5 pb-6 text-gray-500 group-hover:text-gray-600 z-10">
                <p class="mb-2 text-lg font-semibold">Upload Thumbnail Karya</p>
                <i class="fas fa-camera text-5xl text-gray-400 mt-2"></i>
            </div>
            <input id="upload-thumbnail" name="gambar_proyek" type="file" class="hidden" accept="image/*" onchange="previewImage(this)" />
            <img id="image-preview" class="absolute inset-0 w-full h-full object-cover hidden" />
        </label>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <div class="lg:col-span-4 space-y-6">
            
            <div class="bg-gray-50 p-5 rounded-2xl border border-gray-100">
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Kategori</label>
                <select name="kategori_id" required class="w-full bg-transparent border-b border-gray-300 py-2 focus:outline-none focus:border-orange-500 font-semibold text-gray-800 cursor-pointer">
                    <option value="" disabled selected>Pilih Kategori</option>
                    <?php foreach ($kategoriList as $kat): ?>
                        <option value="<?= $kat['id'] ?>"><?= htmlspecialchars($kat['nama_kategori']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="bg-gray-50 p-5 rounded-2xl border border-gray-100">
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Tahun</label>
                <input type="number" name="tahun" placeholder="Contoh: 2024" required 
                       class="w-full bg-transparent border-b border-gray-300 py-2 focus:outline-none focus:border-orange-500 font-semibold text-gray-800">
            </div>

            <div class="bg-gray-50 p-5 rounded-2xl border border-gray-100">
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Nama Tim</label>
                <input type="text" name="nama_tim" placeholder="Masukkan Nama Tim" required 
                       class="w-full bg-transparent border-b border-gray-300 py-2 focus:outline-none focus:border-orange-500 font-semibold text-gray-800">
            </div>

            <div class="bg-gray-50 p-5 rounded-2xl border border-gray-100">
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Anggota Tim (Mahasiswa)</label>
                
                <div class="relative mb-3">
                    <input type="text" id="search-mhs" placeholder="Cari Nama atau NIM..." 
                           class="w-full pl-9 pr-4 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-orange-500 transition shadow-sm bg-white" autocomplete="off">
                    <i class="fas fa-search absolute left-3 top-2.5 text-gray-400 text-xs"></i>
                </div>

                <div id="mhs-list" class="h-48 overflow-y-auto pr-2 space-y-2 scrollbar-thin scrollbar-thumb-gray-300">
                    <?php if (!empty($mahasiswaList)): ?>
                        <?php foreach ($mahasiswaList as $mhs): ?>
                            <label class="mhs-item flex items-center space-x-3 p-2 hover:bg-white rounded-lg cursor-pointer transition border border-transparent hover:border-gray-200 group">
                                <input type="checkbox" name="anggota_tim[]" value="<?= $mhs['id'] ?>" class="w-4 h-4 text-orange-500 border-gray-300 rounded focus:ring-orange-500 cursor-pointer">
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
                
                <p id="no-result" class="text-xs text-red-400 text-center mt-2 hidden">Mahasiswa tidak ditemukan.</p>
                <p class="text-[10px] text-gray-400 mt-2 italic">* Centang nama mahasiswa yang terlibat.</p>
            </div>

        </div>

        <div class="lg:col-span-8 space-y-6">
            
            <div>
                <h2 class="text-xl font-bold text-gray-800 mb-3">Masukkan Judul</h2>
                <input type="text" name="judul" placeholder="Judul Karya..." required 
                       class="w-full px-6 py-4 bg-gray-100 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:bg-white transition text-lg font-medium shadow-sm">
            </div>

            <div>
                <h2 class="text-xl font-bold text-gray-800 mb-3">Deskripsi Singkat</h2>
                <textarea name="deskripsi" rows="12" placeholder="Jelaskan tentang karya ini secara detail..." required 
                          class="w-full px-6 py-4 bg-gray-100 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:bg-white transition resize-none shadow-sm"></textarea>
            </div>

        </div>
    </div>

    <div class="flex gap-4 pt-6 border-t border-gray-100">
        <button type="submit" class="px-8 py-3 bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-xl shadow-lg hover:shadow-orange-500/30 transition transform hover:-translate-y-0.5">
            Simpan Karya
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

    // 2. Fitur Live Search Mahasiswa (Tanpa Reload)
    document.getElementById('search-mhs').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let items = document.querySelectorAll('.mhs-item');
        let visibleCount = 0;

        items.forEach(item => {
            let name = item.querySelector('.mhs-name').innerText.toLowerCase();
            let nim = item.querySelector('.mhs-nim').innerText.toLowerCase();
            
            // Cek apakah Nama ATAU NIM cocok dengan ketikan
            if (name.includes(filter) || nim.includes(filter)) {
                item.style.display = "flex"; // Tampilkan
                visibleCount++;
            } else {
                item.style.display = "none"; // Sembunyikan
            }
        });

        // Tampilkan pesan jika tidak ada hasil
        let noResultMsg = document.getElementById('no-result');
        if (visibleCount === 0) {
            noResultMsg.classList.remove('hidden');
        } else {
            noResultMsg.classList.add('hidden');
        }
    });
</script>