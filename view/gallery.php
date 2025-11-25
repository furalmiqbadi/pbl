<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'postgres');
define('DB_PASS', '123');
define('DB_NAME', 'pbl');
define('DB_PORT', '5432');

$conn = null;
$error_message = '';
$data_to_loop = [];

try {
    $dsn = "pgsql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME;
    $conn = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    $sql = "SELECT id, deskripsi, gambar_galeri FROM galeri";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($results) > 0) {
        $data_to_loop = $results;
    } else {
        $data_to_loop = [
            ['judul' => 'Contoh PG 1: Pelatihan Web', 'deskripsi' => 'Sesi mendalam tentang pengembangan web modern dengan fokus pada PHP dan Tailwind.', 'tanggal_upload' => '2025-11-20', 'url_gambar' => 'https://via.placeholder.com/400x300/F0F4F8/333333?text=PostgreSQL+Web'],
            ['judul' => 'Contoh PG 2: Desain Grafis', 'deskripsi' => 'Workshop kreasi visual untuk media digital, menggunakan tools profesional.', 'tanggal_upload' => '2025-11-19', 'url_gambar' => 'https://via.placeholder.com/400x300/F0F4F8/333333?text=PostgreSQL+Design'],
            ['judul' => 'Contoh PG 3: Pemrograman IoT', 'deskripsi' => 'Mempelajari dasar-dasar Internet of Things dan implementasinya di kehidupan sehari-hari.', 'tanggal_upload' => '2025-11-18', 'url_gambar' => 'https://via.placeholder.com/400x300/F0F4F8/333333?text=PostgreSQL+IoT'],
        ];
    }

} catch (PDOException $e) {
    $error_message = "Koneksi database PostgreSQL gagal: " . $e->getMessage();
    $data_to_loop = [];
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Multimedia Dinamis (PostgreSQL)</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            overflow-y: auto;
        }

        tailwind.config= {
            theme: {
                extend: {
                    colors: {
                        'gambar-bg': '#F0F4F8',
                            'deskripsi-bg': '#334155',
                            'text-light': '#F8FAFC',
                            'text-dark': '#1F2937',
                            'accent-color': '#EF4444',
                    }
                }
            }
        }
    </style>
</head>
<?php include '../layouts/header.php'; ?>

<body class="bg-gray-50 min-h-screen">

    <div class="container mx-auto px-4 py-8">

        <header class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-deskripsi-bg sm:text-5xl">Galeri Multimedia</h1>
            <p class="mt-3 text-xl text-gray-500">Kumpulan karya dan dokumentasi dari berbagai sesi pelatihan.</p>
        </header>

        <?php if ($error_message): ?>
            <div role="alert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-8">
                <strong class="font-bold">Error Koneksi!</strong>
                <span class="block sm:inline"><?= htmlspecialchars($error_message) ?></span>
                <p class="mt-2 text-sm">Pastikan service PostgreSQL Anda berjalan dan kredensial di `index.php` sudah benar.
                </p>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">

            <?php
            if (!empty($data_to_loop)):
                foreach ($data_to_loop as $item):
                    $judul = htmlspecialchars($item['judul']);
                    $deskripsi = htmlspecialchars($item['deskripsi']);
                    $tanggal = isset($item['tanggal_upload']) ? date('d F Y', strtotime($item['tanggal_upload'])) : 'N/A';
                    $url_gambar = htmlspecialchars($item['url_gambar']);
                    ?>

                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transition duration-300 hover:shadow-xl">

                        <div class="bg-gambar-bg p-4 flex items-center justify-center h-48 sm:h-56">
                            <img src="<?= $url_gambar ?>" alt="<?= $judul ?>"
                                class="object-cover w-full h-full rounded-lg border border-gray-200">
                        </div>

                        <div class="bg-deskripsi-bg p-5">
                            <h3 class="text-xl font-semibold text-text-light mb-2 truncate">
                                <?= $judul ?>
                            </h3>
                            <p class="text-sm text-gray-300 mb-3 line-clamp-2">
                                <?= $deskripsi ?>
                            </p>
                            <div class="flex justify-between items-center border-t border-gray-600 pt-3">
                                <span class="text-xs font-medium text-accent-color">
                                    <?= $tanggal ?>
                                </span>
                                <a href="#"
                                    class="text-sm font-medium text-blue-300 hover:text-blue-200 transition duration-150">
                                    Lihat Detail &rarr;
                                </a>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            <?php else: ?>
                <?php if (!$error_message): ?>
                    <p class="col-span-full text-center text-gray-500">
                        Tidak ada data galeri yang ditemukan di database. Silakan isi tabel `galeri_multimedia`.
                    </p>
                <?php endif; ?>
            <?php endif; ?>

        </div>
    </div>
    <?php include '../layouts/footer.php'; ?>

</body>

</html>