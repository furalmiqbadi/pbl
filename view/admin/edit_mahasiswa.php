<div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
    <div>
        <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
            <span class="w-3 h-8 bg-gradient-to-b from-blue-400 to-indigo-500 rounded-full"></span>
            Edit Mahasiswa
        </h1>
        <p class="text-gray-500 text-sm mt-1 ml-6">Perbarui data mahasiswa.</p>
    </div>
    <a href="dashboard.php?page=mahasiswa" class="text-gray-600 hover:text-blue-600 font-bold flex items-center gap-2 transition bg-white px-5 py-2.5 rounded-xl border border-gray-200 hover:border-blue-200 shadow-sm hover:shadow-md group">
        <div class="w-6 h-6 rounded-full bg-gray-100 group-hover:bg-blue-100 flex items-center justify-center transition">
            <i class="fas fa-arrow-left text-xs group-hover:-translate-x-0.5 transition-transform"></i>
        </div>
        Kembali
    </a>
</div>

<div class="bg-white rounded-[2rem] shadow-xl shadow-gray-100/50 border border-gray-100 p-8 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 bg-blue-50 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 opacity-50 pointer-events-none"></div>

    <form action="dashboard.php?page=update_mahasiswa" method="POST" class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-12">
        <input type="hidden" name="id" value="<?= $student['id'] ?>">

        <div class="lg:col-span-4 space-y-6">
            <div class="bg-blue-50 rounded-3xl p-8 text-center border border-blue-100">
                <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm text-blue-500 font-bold text-3xl">
                    <?= substr($student['nama'], 0, 1) ?>
                </div>
                <h3 class="text-lg font-bold text-gray-800"><?= htmlspecialchars($student['nama']) ?></h3>
                <p class="text-sm text-gray-500 mt-1"><?= htmlspecialchars($student['nim']) ?></p>
            </div>
        </div>

        <div class="lg:col-span-8 space-y-6">
            <div>
                <label class="block text-sm font-extrabold text-gray-700 mb-2">NIM</label>
                <div class="relative">
                    <input type="text" name="nim" value="<?= htmlspecialchars($student['nim']) ?>" required 
                           class="w-full pl-12 pr-4 py-4 rounded-2xl bg-gray-50 border-transparent focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition font-mono font-bold text-gray-800 placeholder-gray-400 shadow-sm">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none text-gray-400">
                        <i class="fas fa-id-card"></i>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-extrabold text-gray-700 mb-2">Nama Lengkap</label>
                <div class="relative">
                    <input type="text" name="nama" value="<?= htmlspecialchars($student['nama']) ?>" required 
                           class="w-full pl-12 pr-4 py-4 rounded-2xl bg-gray-50 border-transparent focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition font-bold text-gray-800 placeholder-gray-400 shadow-sm">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none text-gray-400">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-extrabold text-gray-700 mb-2">Program Studi</label>
                <div class="relative">
                    <select name="prodi_id" required class="w-full pl-12 pr-10 py-4 rounded-2xl bg-gray-50 border-transparent focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition font-semibold text-gray-700 appearance-none cursor-pointer">
                        <option value="" disabled>-- Pilih Program Studi --</option>
                        <?php foreach ($prodiList as $p): ?>
                            <option value="<?= $p['id'] ?>" <?= ($p['id'] == $student['prodi_id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($p['nama_prodi']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none text-gray-400">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-5 pointer-events-none text-blue-500">
                        <i class="fas fa-chevron-down text-xs"></i>
                    </div>
                </div>
            </div>

            <div class="pt-6 flex justify-end gap-4">
                <a href="dashboard.php?page=mahasiswa" class="px-6 py-3.5 rounded-xl text-gray-500 font-bold hover:bg-gray-100 hover:text-gray-700 transition">Batal</a>
                <button type="submit" class="px-8 py-3.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-blue-500/30 transform hover:-translate-y-1 transition duration-300 flex items-center gap-3">
                    <i class="fas fa-save"></i>
                    <span>Simpan Perubahan</span>
                </button>
            </div>
        </div>

    </form>
</div>