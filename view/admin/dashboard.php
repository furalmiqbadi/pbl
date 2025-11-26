<?php
session_start();
require_once __DIR__ . '/../../lib/Connection.php';

// Cek Login
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: ../login.php");
    exit;
}

// ... require controller mahasiswa ...
require_once __DIR__ . '/../../controller/SearchController.php'; // Tambahkan ini
$searchController = new SearchController();

require_once __DIR__ . '/../../controller/MahasiswaController.php'; 
$mahasiswaController = new MahasiswaController();

// Ambil Halaman
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Lab MMT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gray-50 flex min-h-screen">

    <?php include '../../layouts/sidebar.php'; ?>
    
    <main class="flex-1 ml-64 p-8">
        
        <?php
        switch ($page) {
            case 'home': include 'home.php'; break;


            case 'mahasiswa':
            $mahasiswaController->index(); // Controller yang panggil view
            break;
    
            case 'tambah_mahasiswa':
            $mahasiswaController->create(); // Controller yang panggil view form
            break;

            case 'edit_mahasiswa':
            $mahasiswaController->edit();
            break;

            case 'update_mahasiswa':
            $mahasiswaController->update();
            break;

            case 'hapus_mahasiswa':
            $mahasiswaController->delete();
            break;

            case 'store_mahasiswa':
            $mahasiswaController->store(); // Controller yang proses data
            break;

            case 'search':
            $searchController->index(); // Panggil lewat controller
            break;

            // --- KARYA (Database: daftar_proyek) ---
            case 'proyek': include 'proyek.php'; break;
            case 'tambah_proyek': include 'tambah_proyek.php'; break;

            // --- BERITA ---
            case 'berita': include 'berita.php'; break;
            case 'tambah_berita': include 'tambah_berita.php'; break;
            
            // --- GALERI ---
            case 'galeri': include 'galeri.php'; break;
            case 'tambah_galeri': include 'tambah_galeri.php'; break;

            // --- MAHASISWA ---
            case 'mahasiswa': include 'mahasiswa.php'; break;
            case 'tambah_mahasiswa': include 'tambah_mahasiswa.php'; break;

            // --- DOSEN ---
            case 'dosen': include 'dosen.php'; break;
            case 'tambah_dosen': include 'tambah_dosen.php'; break;

            // --- PROFIL ---
            case 'profil': include 'profil.php'; break;

            default:
                echo "<div class='p-6 bg-red-100 text-red-600 rounded-xl font-bold'>Halaman tidak ditemukan!</div>";
                break;
        }
        ?>

    </main>

</body>
</html>