<?php
require_once __DIR__ . '/../model/GaleriModel.php';

class GaleriController {
    private $model;

    public function __construct() {
        $this->model = new GaleriModel();
    }

    public function index() {
        $limit = 9;
        $page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;
        $offset = ($page - 1) * $limit;

        $totalData = $this->model->countAll();
        $totalPages = ceil($totalData / $limit);
        
        if ($page < 1) $page = 1;
        if ($page > $totalPages && $totalPages > 0) $page = $totalPages;

        $galeri = $this->model->getPaginated($limit, $offset);
        
        $data = $galeri; 
        
        include __DIR__ . '/../view/admin/galeri.php';
    }
    
    public function create() { include __DIR__ . '/../view/admin/tambah_galeri.php'; }
    
    public function store() {
        $data = ['deskripsi' => $_POST['deskripsi'], 'gambar' => ''];
        if (!empty($_FILES['gambar_galeri']['name'])) {
            $targetDir = __DIR__ . "/../assets/images/uploads/";
            if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
            $fileName = time() . 'galeri' . basename($_FILES["gambar_galeri"]["name"]);
            if (move_uploaded_file($_FILES["gambar_galeri"]["tmp_name"], $targetDir . $fileName)) {
                $data['gambar'] = "assets/images/uploads/" . $fileName;
            }
        }
        if ($this->model->insert($data)) {
            echo "<script>alert('Galeri Berhasil Ditambahkan!'); window.location.href='dashboard.php?page=galeri';</script>";
        } else {
            echo "<script>alert('Gagal Menambahkan!'); window.location.href='dashboard.php?page=tambah_galeri';</script>";
        }
    }

    public function edit() {
        $id = $_GET['id'];
        $galeri = $this->model->getById($id);
        if (!$galeri) { echo "Data tidak ditemukan!"; exit; }
        include __DIR__ . '/../view/admin/edit_galeri.php';
    }

    public function update() {
        $data = ['id' => $_POST['id'], 'deskripsi' => $_POST['deskripsi'], 'gambar' => ''];
        if (!empty($_FILES['gambar_galeri']['name'])) {
            $targetDir = __DIR__ . "/../assets/images/uploads/";
            $fileName = time() . 'galeri' . basename($_FILES["gambar_galeri"]["name"]);
            if (move_uploaded_file($_FILES["gambar_galeri"]["tmp_name"], $targetDir . $fileName)) {
                $data['gambar'] = "assets/images/uploads/" . $fileName;
            }
        }
        if ($this->model->update($data)) {
            echo "<script>alert('Galeri Berhasil Diupdate!'); window.location.href='dashboard.php?page=galeri';</script>";
        } else {
            echo "<script>alert('Gagal Update!'); window.location.href='dashboard.php?page=edit_galeri&id=" . $data['id'] . "';</script>";
        }
    }

    public function delete() {
        $id = $_GET['id'];
        if ($this->model->delete($id)) {
            echo "<script>alert('Galeri Berhasil Dihapus!'); window.location.href='dashboard.php?page=galeri';</script>";
        } else {
            echo "<script>alert('Gagal Menghapus!'); window.location.href='dashboard.php?page=galeri';</script>";
        }
    }
}
?>