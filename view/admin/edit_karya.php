<div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
    <div>
        <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
            <span class="w-3 h-8 bg-gradient-to-b from-orange-400 to-red-500 rounded-full"></span>
            Edit Data Karya
        </h1>
        <p class="text-gray-500 text-sm mt-1 ml-6">Perbarui detail proyek karya.</p>
    </div>
    <a href="dashboard.php?page=karya" 
       class="text-gray-600 hover:text-orange-600 font-bold flex items-center gap-2 transition bg-white px-5 py-2.5 rounded-xl border border-gray-200 hover:border-orange-200 shadow-sm hover:shadow-md group">
        <div class="w-6 h-6 rounded-full bg-gray-100 group-hover:bg-orange-100 flex items-center justify-center transition">
            <i class="fas fa-arrow-left text-xs group-hover:-translate-x-0.5 transition-transform"></i>
        </div>
        Kembali
    </a>
</div>

<div class="bg-white rounded-[2rem] shadow-xl shadow-gray-100/50 border border-gray-100 p-8 relative overflow-hidden">
    
    <div class="absolute top-0 right-0 w-64 h-64 bg-orange-50 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 opacity-50 pointer-events-none"></div>

    <form action="dashboard.php?page=update_karya" method="POST" enctype="multipart/form-data" class="relative z-10 space-y-8">
        
        <input type="hidden" name="id" value="<?= $karya['id'] ?>">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <div class="lg:col-span-4 space-y-8">
                
                <div class="space-y-3">
                    <label class="block text-sm font-extrabold text-gray-700 tracking-wide">Thumbnail Karya</label>
                    <label for="upload-thumbnail" class="group flex flex-col items-center justify-center w-full aspect-[4/3] border-2 border-dashed border-gray-300 rounded-3xl cursor-pointer bg-gray-50/50 hover:bg-orange-50/30 hover:border-orange-400 transition-all duration-300 relative overflow-hidden">
                        
                        <?php if (!empty($karya['gambar_proyek'])): ?>
                            <img src="../../<?= htmlspecialchars($karya['gambar_proyek']) ?>" class="absolute inset-0 w-full h-full object-cover z-0 opacity-100 group-hover:opacity-40 transition-opacity duration-300" id="current-image">
                        <?php endif; ?>

                        <div class="flex flex-col items-center justify-center pt-5 pb-6 text-gray-400 group-hover:text-orange-500 transition-colors z-10 <?= !empty($karya['gambar_proyek']) ? 'opacity-0 group-hover:opacity-100' : '' ?>">
                            <div class="w-16 h-16 rounded-full bg-white shadow-sm flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-camera text-3xl text-orange-400"></i>
                            </div>
                            <p class="text-sm font-bold text-gray-600 group-hover:text-orange-600">Ganti Thumbnail</p>
                        </div>
                        
                        <input id="upload-thumbnail" name="gambar_proyek" type="file" class="hidden" accept="image/*" onchange="previewImage(this)" />
                        <img id="image-preview" class="absolute inset-0 w-full h-full object-cover hidden z-20 transition-opacity duration-300" />
                    </label>
                </div>

                <div class="bg-gray-50 p-6 rounded-3xl border border-gray-100 space-y-5">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kategori</label>
                        <div class="relative">
                            <select name="kategori_id" required class="w-full pl-4 pr-10 py-3.5 rounded-xl bg-white border border-gray-200 focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 outline-none transition font-semibold text-gray-700 appearance-none cursor-pointer hover:border-orange-300">
                                <option value="" disabled>Pilih Kategori</option>
                                <?php foreach ($kategoriList as $kat): ?>
                                    <option value="<?= $kat['id'] ?>" <?= ($kat['id'] == $karya['kategori_id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($kat['nama_kategori']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-orange-500">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Tahun Pembuatan</label>
                        <div class="relative">
                            <input type="number" name="tahun" value="<?= htmlspecialchars($karya['tahun'] ?? '') ?>" placeholder="2024" required 
                                   class="w-full pl-10 pr-4 py-3.5 rounded-xl bg-white border border-gray-200 focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 outline-none transition font-mono font-medium hover:border-orange-300">
                            <div class="absolute inset-y-0 left-0 flex items-center px-4 pointer-events-none text-gray-400">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="lg:col-span-8 space-y-8">
                
                <div>
                    <label class="block text-sm font-extrabold text-gray-700 mb-2">Judul Karya</label>
                    <input type="text" name="judul" value="<?= htmlspecialchars($karya['judul']) ?>" placeholder="Masukkan judul karya..." required 
                           class="w-full px-6 py-4 rounded-2xl bg-gray-50 border-transparent focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 outline-none transition text-lg font-bold text-gray-800 placeholder-gray-400 shadow-sm">
                </div>

                <div>
                    <label class="block text-sm font-extrabold text-gray-700 mb-2">Deskripsi Lengkap</label>
                    <div class="relative">
                        <textarea name="deskripsi" rows="6" placeholder="Deskripsi karya..." required 
                                  class="w-full p-6 rounded-2xl bg-gray-50 border-transparent focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 outline-none transition resize-none text-gray-600 leading-relaxed shadow-sm"><?= htmlspecialchars($karya['isi_proyek']) ?></textarea>
                        <i class="fas fa-pen-nib absolute top-6 right-6 text-gray-300"></i>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-extrabold text-gray-700 mb-2">Nama Tim</label>
                        <div class="relative">
                            <input type="text" name="nama_tim" value="<?= htmlspecialchars($karya['nama_tim'] ?? '') ?>" placeholder="Nama Tim" required 
                                   class="w-full pl-11 pr-4 py-3.5 rounded-xl bg-white border border-gray-200 focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 outline-none transition font-semibold hover:border-orange-300">
                            <div class="absolute inset-y-0 left-0 flex items-center px-4 pointer-events-none text-blue-500">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 p-6 rounded-3xl shadow-sm relative overflow-hidden group-focus-within:ring-4 group-focus-within:ring-orange-500/10 transition-all">
                    <div class="absolute top-0 left-0 w-1 h-full bg-blue-500 rounded-l-3xl"></div>
                    
                    <label class="block text-sm font-extrabold text-gray-800 mb-4 flex justify-between items-center pl-2">
                        <span>Anggota Tim</span>
                        <span class="text-[10px] font-bold text-blue-600 bg-blue-50 px-3 py-1 rounded-full uppercase tracking-wider">Update</span>
                    </label>
                    
                    <div class="relative mb-4">
                        <input type="text" id="search-mhs" placeholder="Cari nama anggota..." 
                               class="w-full pl-10 pr-4 py-3 text-sm border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition bg-gray-50 focus:bg-white" autocomplete="off">
                        <i class="fas fa-search absolute left-3.5 top-3.5 text-gray-400 text-sm"></i>
                    </div>

                    <div id="mhs-list" class="h-56 overflow-y-auto pr-2 space-y-2 custom-scrollbar">
                        <?php if (!empty($mahasiswaList)): ?>
                            <?php foreach ($mahasiswaList as $mhs): ?>
                                <?php 
                                    $isChecked = in_array($mhs['id'], $selectedMembers) ? 'checked' : ''; 
                                ?>
                                <label class="mhs-item flex items-center space-x-3 p-3 rounded-xl border border-gray-100 cursor-pointer hover:bg-blue-50 hover:border-blue-200 transition group select-none">
                                    <div class="relative flex items-center">
                                        <input type="checkbox" name="anggota_tim[]" value="<?= $mhs['id'] ?>" <?= $isChecked ?>
                                               class="peer appearance-none w-5 h-5 border-2 border-gray-300 rounded-md checked:bg-blue-500 checked:border-blue-500 transition cursor-pointer">
                                        <i class="fas fa-check text-white text-[10px] absolute inset-0 m-auto opacity-0 peer-checked:opacity-100 pointer-events-none"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-bold text-gray-700 group-hover:text-blue-700 truncate transition"><?= htmlspecialchars($mhs['nama']) ?></p>
                                        <p class="text-xs text-gray-400 mhs-nim font-mono group-hover:text-blue-400"><?= htmlspecialchars($mhs['nim']) ?></p>
                                    </div>
                                </label>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center py-10 bg-gray-50 rounded-xl border border-dashed border-gray-200">Data Kosong</div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>

        <div class="pt-8 border-t border-gray-100 flex items-center justify-end gap-4">
            <a href="dashboard.php?page=karya" class="px-6 py-3.5 rounded-xl text-gray-500 font-bold hover:bg-gray-100 hover:text-gray-700 transition">
                Batal
            </a>
            <button type="submit" class="px-8 py-3.5 bg-gradient-to-r from-orange-600 to-red-500 hover:from-orange-700 hover:to-red-600 text-white font-bold rounded-xl shadow-lg shadow-orange-500/30 transform hover:-translate-y-1 transition duration-300 flex items-center gap-3">
                <i class="fas fa-save text-sm"></i>
                <span>Simpan Perubahan</span>
            </button>
        </div>

    </form>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #e5e7eb; border-radius: 20px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background-color: #d1d5db; }
</style>

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