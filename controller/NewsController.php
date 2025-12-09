<?php
require_once __DIR__ . '/../model/NewsModel.php';
require_once __DIR__ . '/../lib/helpers.php';

class NewsController
{
    private $model;

    public function __construct()
    {
        $this->model = new NewsModel();
    }

    // BAGIAN FRONTEND

    public function index()
    {
        // 1. Ambil Input
        $search = trim($_GET['search'] ?? '');
        $categoryInput = $_GET['category'] ?? null;

        // 2. Normalisasi Kategori
        $categoryId = null;
        if ($categoryInput && $categoryInput !== 'semua' && is_numeric($categoryInput)) {
            $categoryId = (int) $categoryInput;
        }

        // Update Pagination
        $limit = 9; 
        $page = isset($_GET['p']) && ctype_digit((string) $_GET['p']) ? max(1, (int) $_GET['p']) : 1;
        $offset = ($page - 1) * $limit;

        $totalNews = $this->model->countNews($search, $categoryId);
        $totalPages = ceil($totalNews / $limit);
        
        if ($page > $totalPages && $totalPages > 0) $page = $totalPages;

        // 3. Ambil Data Utama
        $newsList = $this->model->getNews($search, $categoryId, $offset, $limit);
        $categories = $this->model->getCategories();

        // 4. Logika Slider (Ambil Berita Terbaru Terpisah)
        $sliderData = $this->model->getNews(null, null, 0, 3); // Ambil 3 berita terbaru
        
        $sliderNews = $sliderData; // Gunakan ini untuk slider
        
        // ---

        // 5. Panggil View
        include __DIR__ . '/../view/news.php';
    }

    public function detail()
    {
        if (!isset($_GET['id'])) {
            header("Location: index.php?page=news");
            exit;
        }

        $id = (int) $_GET['id'];
        $newsItem = $this->model->getNewsById($id);

        if (!$newsItem) {
            echo "Berita tidak ditemukan!";
            exit;
        }

        // Ambil Rekomendasi (3 berita terbaru selain yang sedang dibuka)
        $recentNews = $this->model->getNews(null, null, 0, 4);
        $relatedNews = array_filter($recentNews, function ($item) use ($id) {
            return (int) $item['id'] !== $id;
        });
        $relatedNews = array_slice($relatedNews, 0, 3);

        include __DIR__ . '/../view/news_detail.php';
    }

    // BAGIAN ADMIN (Untuk Dashboard)

    public function adminIndex()
    {
        $search = $_GET['search'] ?? null;
        $category = $_GET['category'] ?? null;

        $newsList = $this->model->getAdminNews($search, $category);
        $categories = $this->model->getCategories();

        include __DIR__ . '/../view/admin/berita.php';
    }

    // Tampilkan Form Tambah
    public function create()
    {
        $categories = $this->model->getCategories();
        include __DIR__ . '/../view/admin/tambah_berita.php';
    }

    // Proses Simpan Data Baru
    public function store()
    {
        $data = [
            'judul' => $_POST['judul'],
            'isi_berita' => $_POST['isi_berita'],
            'kategori_id' => $_POST['kategori_id'],
            'gambar_berita' => ''
        ];

        // Upload Gambar
        if (!empty($_FILES['gambar_berita']['name'])) {
            $data['gambar_berita'] = $this->uploadImage($_FILES['gambar_berita']);
        }

        if ($this->model->insert($data)) {
            echo "<script>alert('Berita berhasil ditambahkan!'); window.location.href='dashboard.php?page=berita';</script>";
        } else {
            echo "<script>alert('Gagal menambah berita!'); window.history.back();</script>";
        }
    }

    // Tampilkan Form Edit
    public function edit()
    {
        $id = $_GET['id'];
        $berita = $this->model->getNewsById($id);
        $categories = $this->model->getCategories();
        include __DIR__ . '/../view/admin/edit_berita.php';
    }

    // Proses Update Data
    public function update()
    {
        $data = [
            'id' => $_POST['id'],
            'judul' => $_POST['judul'],
            'isi_berita' => $_POST['isi_berita'],
            'kategori_id' => $_POST['kategori_id'],
            'gambar_berita' => ''
        ];

        // Cek jika ada gambar baru
        if (!empty($_FILES['gambar_berita']['name'])) {
            $data['gambar_berita'] = $this->uploadImage($_FILES['gambar_berita']);
        }

        if ($this->model->update($data)) {
            echo "<script>alert('Berita berhasil diupdate!'); window.location.href='dashboard.php?page=berita';</script>";
        } else {
            echo "<script>alert('Gagal update berita!'); window.history.back();</script>";
        }
    }

    // Proses Hapus Data
    public function delete()
    {
        $id = $_GET['id'];
        if ($this->model->delete($id)) {
            echo "<script>alert('Berita berhasil dihapus!'); window.location.href='dashboard.php?page=berita';</script>";
        } else {
            echo "<script>alert('Gagal menghapus!'); window.location.href='dashboard.php?page=berita';</script>";
        }
    }

    // Helper Upload Gambar
    private function uploadImage($file)
    {
        $targetDir = __DIR__ . "/../assets/images/uploads/";
        if (!is_dir($targetDir))
            mkdir($targetDir, 0777, true);

        $ext = pathinfo($file["name"], PATHINFO_EXTENSION);
        $fileName = time() . '_' . uniqid() . '.' . $ext;

        if (move_uploaded_file($file["tmp_name"], $targetDir . $fileName)) {
            return "assets/images/uploads/" . $fileName;
        }
        return "";
    }
}
?>