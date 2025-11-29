<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Edit Data Dosen</h1>
    <a href="dashboard.php?page=dosen" class="text-gray-500 hover:text-gray-700 flex items-center gap-2 transition"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>

<div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 max-w-3xl mx-auto">
    
    <form action="dashboard.php?page=update_dosen" method="POST" enctype="multipart/form-data" class="space-y-6">
        <input type="hidden" name="id" value="<?= $dosen['id'] ?>">

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Dosen</label>
            <input type="text" name="nama" value="<?= htmlspecialchars($dosen['nama']) ?>" required 
                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-orange-500 outline-none">
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Foto Profil</label>
            <div class="flex items-center gap-4 p-4 border border-gray-100 rounded-xl bg-gray-50">
                <?php 
                    $img = !empty($dosen['gambar_tim']) && $dosen['gambar_tim'] !== 'default.png' 
                        ? "../../assets/images/uploads/" . $dosen['gambar_tim'] 
                        : "https://ui-avatars.com/api/?name=" . urlencode($dosen['nama']);
                ?>
                <img src="<?= $img ?>" class="w-16 h-16 rounded-full object-cover border border-gray-300 shadow-sm">
                
                <div class="flex-1">
                    <input type="file" name="gambar" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-white file:text-orange-700 hover:file:bg-orange-50 cursor-pointer">
                    <p class="text-xs text-gray-400 mt-2 ml-1">*Biarkan kosong jika tidak ingin mengubah foto.</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">NIDN</label>
                <input type="text" name="nidn" value="<?= htmlspecialchars($dosen['nidn']) ?>" 
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-orange-500 outline-none font-mono">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Jabatan</label>
                <select name="jabatan" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-orange-500 outline-none bg-white">
                    <option value="" disabled>-- Pilih Jabatan --</option>
                    <?php 
                    $listJabatan = ['Kepala Laboratorium', 'Sekretaris Laboratorium', 'Teknisi / Laboran', 'Dosen Pembina', 'Anggota'];
                    foreach ($listJabatan as $j) {
                        $selected = ($dosen['jabatan'] == $j) ? 'selected' : '';
                        echo "<option value='$j' $selected>$j</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="border-t pt-4 mt-2">
            <h3 class="text-gray-800 font-bold mb-3">Tautan Sosial Media</h3>
            <div class="space-y-3">
                <div class="flex items-center">
                    <span class="w-10 text-center text-pink-500 text-xl"><i class="fab fa-instagram"></i></span>
                    <input type="text" name="link_instagram" value="<?= htmlspecialchars($dosen['link_instagram'] ?? '') ?>" placeholder="Link Instagram" class="flex-1 px-4 py-2 rounded-xl border border-gray-200 focus:border-orange-500 outline-none text-sm">
                </div>
                <div class="flex items-center">
                    <span class="w-10 text-center text-blue-600 text-xl"><i class="fab fa-linkedin"></i></span>
                    <input type="text" name="link_linkedin" value="<?= htmlspecialchars($dosen['link_linkedin'] ?? '') ?>" placeholder="Link LinkedIn" class="flex-1 px-4 py-2 rounded-xl border border-gray-200 focus:border-orange-500 outline-none text-sm">
                </div>
                <div class="flex items-center">
                    <span class="w-10 text-center text-gray-800 text-xl"><i class="fab fa-github"></i></span>
                    <input type="text" name="link_github" value="<?= htmlspecialchars($dosen['link_github'] ?? '') ?>" placeholder="Link GitHub" class="flex-1 px-4 py-2 rounded-xl border border-gray-200 focus:border-orange-500 outline-none text-sm">
                </div>
            </div>
        </div>

        <div class="pt-4 flex justify-end">
            <button type="submit" class="px-8 py-3 rounded-xl bg-orange-600 text-white hover:bg-orange-700 font-bold shadow-lg transform hover:-translate-y-0.5 transition">Simpan Perubahan</button>
        </div>
    </form>
</div>