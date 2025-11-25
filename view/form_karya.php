<?php
// FILE: view/form_karya.php
// Halaman Form Tambah/Edit (Tanpa Javascript)

// Cek apakah mode Edit (ada parameter id)
$isEdit = isset($_GET['id']);
$title = $isEdit ? "Edit Data Karya" : "Tambah Karya Baru";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - Lab MMT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gray-50">
    
    <?php include '../layouts/header.php'; ?>

    <main class="max-w-3xl mx-auto px-4 py-10">
        
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-orange-500 px-6 py-4">
                <h1 class="text-xl font-bold text-white"><?= $title ?></h1>
            </div>

            <form action="proses_simpan.php" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Karya</label>
                    <input type="text" name="judul" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent outline-none transition" required placeholder="Contoh: Aplikasi Smart Campus">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                    <select name="kategori" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent outline-none transition" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Mobile">Mobile Application</option>
                        <option value="AR/VR">AR / VR</option>
                        <option value="Game">Game Development</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Tim</label>
                    <input type="text" name="tim" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent outline-none transition" required placeholder="Contoh: Tim Hore">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Singkat</label>
                    <textarea name="deskripsi" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent outline-none transition resize-none" required placeholder="Jelaskan fitur utama karya..."></textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Upload Thumbnail</label>
                    <input type="file" name="gambar" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition">
                    <p class="text-xs text-gray-500 mt-1">Maksimal 2MB (JPG, PNG)</p>
                </div>

                <hr class="border-gray-200">

                <div class="flex justify-end gap-3">
                    <a href="kelola_karya.php" class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-lg transition-colors">
                        Simpan Data
                    </button>
                </div>

            </form>
        </div>
    </main>

    <?php include '../layouts/footer.php'; ?>
</body>
</html>