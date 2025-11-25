<?php
// FILE: view/kelola_karya.php
// Halaman List Data (Tanpa Javascript)
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data Karya - Lab MMT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gray-50">
    
    <?php include '../layouts/header.php'; ?>
    
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Kelola Data Karya</h1>
                <p class="text-gray-600 mt-1">Manajemen karya mahasiswa (Mobile, AR/VR, Game)</p>
            </div>
            <a href="form_karya.php" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-3 rounded-lg flex items-center gap-2 transition-all duration-200 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Karya Baru
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Thumbnail</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Judul Karya</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tim</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">1</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img src="https://via.placeholder.com/80x80/9333EA/FFFFFF?text=Game" alt="Thumbnail" class="w-20 h-20 object-cover rounded-lg shadow-sm">
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-semibold text-gray-800">Adventure Quest RPG</div>
                                <div class="text-xs text-gray-500 mt-1">Game petualangan 3D interaktif</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">Game</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Tim Garuda</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="form_karya.php?id=1" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">Edit</a>
                                    <a href="proses_hapus.php?id=1" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                                </div>
                            </td>
                        </tr>
                        
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">2</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img src="https://via.placeholder.com/80x80/F97316/FFFFFF?text=Mobile" alt="Thumbnail" class="w-20 h-20 object-cover rounded-lg shadow-sm">
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-semibold text-gray-800">Siakad Mobile App</div>
                                <div class="text-xs text-gray-500 mt-1">Aplikasi monitoring akademik mahasiswa</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">Mobile</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Tim DevOne</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="form_karya.php?id=2" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">Edit</a>
                                    <a href="proses_hapus.php?id=2" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                                </div>
                            </td>
                        </tr>
                        
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">3</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img src="https://via.placeholder.com/80x80/14B8A6/FFFFFF?text=ARVR" alt="Thumbnail" class="w-20 h-20 object-cover rounded-lg shadow-sm">
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-semibold text-gray-800">Virtual Museum Tour</div>
                                <div class="text-xs text-gray-500 mt-1">Pengalaman VR keliling museum sejarah</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-teal-100 text-teal-800">AR/VR</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Tim Vision</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="form_karya.php?id=3" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">Edit</a>
                                    <a href="proses_hapus.php?id=3" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <?php include '../layouts/footer.php'; ?>
</body>
</html>