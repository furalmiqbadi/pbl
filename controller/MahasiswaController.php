<?php
require_once __DIR__ . '/../model/MahasiswaModel.php';

class MahasiswaController {
    private $model;

    public function __construct() {
        $this->model = new MahasiswaModel();
    }

    public function index() {
        $mahasiswa = $this->model->getAll();
        
        include __DIR__ . '/../view/admin/mahasiswa.php';
    }

    public function create() {
        $prodiList = $this->model->getProdiList();
        include __DIR__ . '/../view/admin/tambah_mahasiswa.php';
    }

    public function store() {
        $nim = $_POST['nim'];
        $nama = $_POST['nama'];
        $prodi_id = $_POST['prodi_id'];

        if ($this->model->insert($nim, $nama, $prodi_id)) {
            echo "<script>alert('Berhasil!'); window.location.href='dashboard.php?page=mahasiswa';</script>";
        } else {
            echo "<script>alert('Gagal!'); window.location.href='dashboard.php?page=tambah_mahasiswa';</script>";
        }
    }

    public function edit() {
        $id = $_GET['id']; 
        $student = $this->model->getById($id); 
        $prodiList = $this->model->getProdiList(); 

        if (!$student) {
            echo "Data tidak ditemukan!";
            exit;
        }
        
        include __DIR__ . '/../view/admin/edit_mahasiswa.php';
    }

    public function update() {
        $id = $_POST['id'];
        $nim = $_POST['nim'];
        $nama = $_POST['nama'];
        $prodi_id = $_POST['prodi_id'];

        if ($this->model->update($id, $nim, $nama, $prodi_id)) {
            echo "<script>alert('Data Berhasil Diupdate!'); window.location.href='dashboard.php?page=mahasiswa';</script>";
        } else {
            echo "<script>alert('Gagal Update!'); window.location.href='dashboard.php?page=edit_mahasiswa&id=$id';</script>";
        }
    }

    public function delete() {
        $id = $_GET['id'];
        if ($this->model->delete($id)) {
            echo "<script>alert('Data Berhasil Dihapus!'); window.location.href='dashboard.php?page=mahasiswa';</script>";
        } else {
            echo "<script>alert('Gagal Menghapus!'); window.location.href='dashboard.php?page=mahasiswa';</script>";
        }
    }
}
?>