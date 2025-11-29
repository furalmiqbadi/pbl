<?php
require_once __DIR__ . '/../model/DosenModel.php';

class DosenController {
    private $model;

    public function __construct() {
        $this->model = new DosenModel();
    }

    // --- UPDATE INDEX UNTUK SEARCH ---
    public function index() {
        $keyword = $_GET['q'] ?? '';

        if (!empty($keyword)) {
            $dosen = $this->model->search($keyword);
        } else {
            $dosen = $this->model->getAll();
        }
        
        include __DIR__ . '/../view/admin/dosen.php';
    }

    public function create() {
        include __DIR__ . '/../view/admin/tambah_dosen.php';
    }

    public function store() {
        $nama = $_POST['nama'];
        $nidn = $_POST['nidn'];
        $jabatan = $_POST['jabatan'];
        $linkedin = $_POST['link_linkedin'] ?? '';
        $instagram = $_POST['link_instagram'] ?? '';
        $github = $_POST['link_github'] ?? '';
        
        $gambar = 'default.png';
        if (!empty($_FILES['gambar']['name'])) {
            $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
            $gambar = time() . '_' . uniqid() . '.' . $ext;
            $targetDir = __DIR__ . '/../assets/images/uploads/';
            if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
            move_uploaded_file($_FILES['gambar']['tmp_name'], $targetDir . $gambar);
        }

        if ($this->model->insert($nama, $nidn, $jabatan, $gambar, $linkedin, $instagram, $github)) {
            echo "<script>alert('Dosen Berhasil Ditambahkan!'); window.location.href='dashboard.php?page=dosen';</script>";
        } else {
            echo "<script>alert('Gagal Menambahkan!'); window.location.href='dashboard.php?page=tambah_dosen';</script>";
        }
    }

    public function edit() {
        $id = $_GET['id'];
        $dosen = $this->model->getById($id);
        if (!$dosen) { echo "Data tidak ditemukan!"; exit; }
        include __DIR__ . '/../view/admin/edit_dosen.php';
    }

    public function update() {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $nidn = $_POST['nidn'];
        $jabatan = $_POST['jabatan'];
        $linkedin = $_POST['link_linkedin'] ?? '';
        $instagram = $_POST['link_instagram'] ?? '';
        $github = $_POST['link_github'] ?? '';

        $gambar = null;
        if (!empty($_FILES['gambar']['name'])) {
            $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
            $gambar = time() . '_' . uniqid() . '.' . $ext;
            $targetDir = __DIR__ . '/../assets/images/uploads/';
            if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
            move_uploaded_file($_FILES['gambar']['tmp_name'], $targetDir . $gambar);
        }

        if ($this->model->update($id, $nama, $nidn, $jabatan, $linkedin, $instagram, $github, $gambar)) {
            echo "<script>alert('Data Dosen Diupdate!'); window.location.href='dashboard.php?page=dosen';</script>";
        } else {
            echo "<script>alert('Gagal Update!'); window.location.href='dashboard.php?page=edit_dosen&id=$id';</script>";
        }
    }

    public function delete() {
        $id = $_GET['id'];
        if ($this->model->delete($id)) {
            echo "<script>alert('Dosen Dihapus!'); window.location.href='dashboard.php?page=dosen';</script>";
        }
    }
}
?>