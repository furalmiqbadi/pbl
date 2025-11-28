<?php
session_start();
require_once __DIR__ . '/../../lib/Connection.php';

// Cek Login
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: ../login.php");
    exit;
}

// ... require controller mahasiswa ...
require_once __DIR__ . '/../../controller/SearchController.php';
$searchController = new SearchController();

require_once __DIR__ . '/../../controller/MahasiswaController.php';
$mahasiswaController = new MahasiswaController();

require_once __DIR__ . '/../../controller/KaryaController.php';
$karyaController = new KaryaController();

require_once __DIR__ . '/../../controller/GaleriController.php';
$galeriController = new GaleriController();

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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 flex min-h-screen">

    <?php include '../../layouts/sidebar.php'; ?>

    <main class="flex-1 ml-64 p-8">

        <?php
        switch ($page) {
            case 'home':
                include 'home.php';
                break;

            // --- FITUR MAHASISWA (KODE LAMA TETAP ADA) ---
            case 'mahasiswa':
                $mahasiswaController->index();
                break;

            case 'tambah_mahasiswa':
                $mahasiswaController->create();
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
                $mahasiswaController->store();
                break;

            // --- FITUR PENCARIAN (KODE LAMA TETAP ADA) ---
            case 'search':
                $searchController->index();
                break;

            // Routing karya
            case 'karya':
                $karyaController->index();
                break;
            case 'tambah_karya':
                $karyaController->create();
                break;
            case 'store_karya':
                $karyaController->store();
                break;
            case 'edit_karya':
                $karyaController->edit();
                break;
            case 'update_karya':
                $karyaController->update();
                break;
            case 'hapus_karya':
                $karyaController->delete();
                break;

            // --- OLD PROYEK (Biarkan saja jika tidak ingin dihapus) ---
            case 'karya':
                include 'karya.php';
                break;
            case 'tambah_proyek':
                include 'tambah_proyek.php';
                break;

            // --- BERITA ---
            case 'berita':
                include 'berita.php';
                break;
            case 'tambah_berita':
                include 'tambah_berita.php';
                break;

            // --- GALERI ---
            case 'galeri':
                $galeriController->index();
                break;
            case 'tambah_galeri':
                $galeriController->create();
                break;
            case 'store_galeri':
                $galeriController->store();
                break;
            case 'edit_galeri':
                $galeriController->edit();
                break;
            case 'update_galeri':
                $galeriController->update();
                break;
            case 'hapus_galeri':
                $galeriController->delete();
                break;

            // --- PROFIL ---
            case 'profil':
                include 'profil.php';
                break;

            default:
                echo "<div class='p-6 bg-red-100 text-red-600 rounded-xl font-bold'>Halaman tidak ditemukan!</div>";
                break;
        }
        ?>

    </main>

</body>

</html>