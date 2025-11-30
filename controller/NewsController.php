<?php
require_once __DIR__ . '/../model/NewsModel.php';

class NewsController
{
    private $model;

    public function __construct()
    {
        $this->model = new NewsModel();
    }

    public function index()
    {
        // 1. Ambil input
        $search = $_GET['search'] ?? null;
        $category = $_GET['category'] ?? null;

        // 2. Ambil data database
        $allNews = $this->model->getNews($search, $category);
        $categories = $this->model->getCategories();

        // 3. Inisialisasi default anti-error
        $featuredNews = null;
        $newsList = [];

        // 4. Logika featured / list
        if (!empty($allNews)) {

            // Jika TIDAK sedang mencari dan kategori = semua → tampilkan Featured News
            if (!$search && ($category === null || $category === 'semua')) {
                $featuredNews = $allNews[0];        // Ambil berita paling baru
                $newsList = array_slice($allNews, 1);
            } else {
                // Jika sedang search atau filter kategori → semua jadi list
                $newsList = $allNews;
            }
        }

        // 5. Kirim ke view
        include __DIR__ . '/../view/news.php';
    }

    public function detail()
    {
        // 1. Cek apakah ada ID di URL
        if (!isset($_GET['id'])) {
            header("Location: index.php?page=news"); // Balikin ke list kalau gak ada ID
            exit;
        }

        $id = $_GET['id'];

        // 2. Minta data spesifik ke Model
        $newsItem = $this->model->getNewsById($id);

        // 3. Cek apakah berita ditemukan
        if (!$newsItem) {
            echo "Berita tidak ditemukan!";
            exit;
        }

        // 4. Panggil View Detail
        include __DIR__ . '/../view/news_detail.php';
    }
}
?>