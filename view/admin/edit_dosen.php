<div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
    <div>
        <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
            <span class="w-3 h-8 bg-gradient-to-b from-blue-400 to-indigo-500 rounded-full"></span>
            Edit Data Dosen
        </h1>
        <p class="text-gray-500 text-sm mt-1 ml-6">Perbarui informasi dosen.</p>
    </div>
    <a href="dashboard.php?page=dosen" class="text-gray-600 hover:text-blue-600 font-bold flex items-center gap-2 transition bg-white px-5 py-2.5 rounded-xl border border-gray-200 hover:border-blue-200 shadow-sm hover:shadow-md group">
        <div class="w-6 h-6 rounded-full bg-gray-100 group-hover:bg-blue-100 flex items-center justify-center transition">
            <i class="fas fa-arrow-left text-xs group-hover:-translate-x-0.5 transition-transform"></i>
        </div>
        Kembali
    </a>
</div>

<div class="bg-white rounded-[2rem] shadow-xl shadow-gray-100/50 border border-gray-100 p-8 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 bg-blue-50 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 opacity-50 pointer-events-none"></div>

    <form action="dashboard.php?page=update_dosen" method="POST" enctype="multipart/form-data" class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-12">
        <input type="hidden" name="id" value="<?= $dosen['id'] ?>">

        <div class="lg:col-span-4 space-y-6">
            <div class="w-full">
                <label class="block text-sm font-extrabold text-gray-700 mb-2">Foto Profil</label>
                <label for="upload-dosen" class="group flex flex-col items-center justify-center w-full aspect-square border-2 border-dashed border-gray-300 rounded-3xl cursor-pointer bg-gray-50/50 hover:bg-blue-50/30 hover:border-blue-400 transition-all duration-300 relative overflow-hidden">
                    
                    <?php 
                        $img = !empty($dosen['gambar_tim']) && $dosen['gambar_tim'] !== 'default.png' 
                            ? "../../assets/images/uploads/" . $dosen['gambar_tim'] 
                            : "https://ui-avatars.com/api/?name=" . urlencode($dosen['nama']);
                    ?>
                    <img src="<?= $img ?>" id="current-image" class="absolute inset-0 w-full h-full object-cover z-0 opacity-100 group-hover:opacity-40 transition-opacity duration-300">

                    <div class="flex flex-col items-center justify-center pt-5 pb-6 text-gray-400 group-hover:text-blue-500 transition-colors z-10 opacity-0 group-hover:opacity-100">
                        <div class="w-16 h-16 rounded-full bg-white shadow-sm flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-camera text-3xl text-blue-400"></i>
                        </div>
                        <p class="text-sm font-bold text-gray-600 group-hover:text-blue-600">Ganti Foto</p>
                    </div>
                    
                    <input id="upload-dosen" name="gambar" type="file" class="hidden" accept="image/*" onchange="previewImage(this)" />
                    <img id="image-preview" class="absolute inset-0 w-full h-full object-cover hidden z-20 transition-opacity duration-300" />
                </label>
            </div>
        </div>

        <div class="lg:col-span-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-extrabold text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="nama" value="<?= htmlspecialchars($dosen['nama']) ?>" required 
                           class="w-full px-5 py-4 rounded-2xl bg-gray-50 border-transparent focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition font-bold text-gray-800 placeholder-gray-400 shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-extrabold text-gray-700 mb-2">NIDN</label>
                    <input type="text" name="nidn" value="<?= htmlspecialchars($dosen['nidn']) ?>" 
                           class="w-full px-5 py-4 rounded-2xl bg-gray-50 border-transparent focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition font-mono font-medium text-gray-800 placeholder-gray-400 shadow-sm">
                </div>
            </div>

            <div>
                <label class="block text-sm font-extrabold text-gray-700 mb-2">Jabatan</label>
                <div class="relative">
                    <select name="jabatan" required class="w-full px-5 py-4 rounded-2xl bg-gray-50 border-transparent focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition font-semibold text-gray-700 appearance-none cursor-pointer">
                        <option value="" disabled>-- Pilih Jabatan --</option>
                        <?php 
                        $listJabatan = ['Kepala Laboratorium', 'Sekretaris Laboratorium', 'Teknisi / Laboran', 'Dosen Pembina', 'Anggota'];
                        foreach ($listJabatan as $j) {
                            $selected = ($dosen['jabatan'] == $j) ? 'selected' : '';
                            echo "<option value='$j' $selected>$j</option>";
                        }
                        ?>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-5 pointer-events-none text-blue-500">
                        <i class="fas fa-chevron-down text-xs"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 p-6 rounded-3xl border border-gray-100">
                <label class="block text-sm font-extrabold text-gray-700 mb-4">Social Media</label>
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-pink-100 text-pink-600 flex items-center justify-center"><i class="fab fa-instagram"></i></div>
                        <input type="text" name="link_instagram" value="<?= htmlspecialchars($dosen['link_instagram'] ?? '') ?>" placeholder="Link Instagram..." class="flex-1 px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-pink-500 focus:ring-2 focus:ring-pink-100 text-sm transition">
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center"><i class="fab fa-linkedin"></i></div>
                        <input type="text" name="link_linkedin" value="<?= htmlspecialchars($dosen['link_linkedin'] ?? '') ?>" placeholder="Link LinkedIn..." class="flex-1 px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm transition">
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-gray-200 text-gray-700 flex items-center justify-center"><i class="fab fa-github"></i></div>
                        <input type="text" name="link_github" value="<?= htmlspecialchars($dosen['link_github'] ?? '') ?>" placeholder="Link GitHub..." class="flex-1 px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-gray-500 focus:ring-2 focus:ring-gray-100 text-sm transition">
                    </div>
                </div>
            </div>

            <div class="pt-6 flex justify-end gap-4">
                <a href="dashboard.php?page=dosen" class="px-6 py-3.5 rounded-xl text-gray-500 font-bold hover:bg-gray-100 hover:text-gray-700 transition">Batal</a>
                <button type="submit" class="px-8 py-3.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-blue-500/30 transform hover:-translate-y-1 transition duration-300 flex items-center gap-3">
                    <i class="fas fa-save"></i>
                    <span>Simpan Perubahan</span>
                </button>
            </div>
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