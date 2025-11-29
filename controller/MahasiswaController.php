<?php
require_once __DIR__ . '/../model/MahasiswaModel.php';

class MahasiswaController {
    private $model;

    public function __construct() {
        $this->model = new MahasiswaModel();
    }

    // --- UPDATE INDEX UNTUK SEARCH ---
    public function index() {
        // Cek apakah ada keyword pencarian di URL (?q=...)
        $keyword = $_GET['q'] ?? '';

        if (!empty($keyword)) {
            $mahasiswa = $this->model->search($keyword);
        } else {
            $mahasiswa = $this->model->getAll();
        }
        
        include __DIR__ . '/../view/admin/mahasiswa.php';
    }

    public function create() {
        $prodiList = $this->model->getProdiList();
        include __DIR__ . '/../view/admin/tambah_mahasiswa.php';
    }

    public function store() {
        if ($this->model->insert($_POST['nim'], $_POST['nama'], $_POST['prodi_id'])) {
            echo "<script>alert('Berhasil!'); window.location.href='dashboard.php?page=mahasiswa';</script>";
        } else {
            echo "<script>alert('Gagal!'); window.location.href='dashboard.php?page=tambah_mahasiswa';</script>";
        }
    }

    public function edit() {
        $id = $_GET['id'];
        $student = $this->model->getById($id);
        $prodiList = $this->model->getProdiList();
        if (!$student) { echo "Data tidak ditemukan!"; exit; }
        include __DIR__ . '/../view/admin/edit_mahasiswa.php';
    }

    public function update() {
        if ($this->model->update($_POST['id'], $_POST['nim'], $_POST['nama'], $_POST['prodi_id'])) {
            echo "<script>alert('Data Berhasil Diupdate!'); window.location.href='dashboard.php?page=mahasiswa';</script>";
        } else {
            echo "<script>alert('Gagal Update!'); window.location.href='dashboard.php?page=edit_mahasiswa&id={$_POST['id']}';</script>";
        }
    }

    public function delete() {
        if ($this->model->delete($_GET['id'])) {
            echo "<script>alert('Data Berhasil Dihapus!'); window.location.href='dashboard.php?page=mahasiswa';</script>";
        }
    }
}
?>