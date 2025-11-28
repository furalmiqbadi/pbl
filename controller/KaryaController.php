<?php
require_once __DIR__ . '/../model/KaryaModel.php';

class KaryaController {
    private $model;

    public function __construct() {
        $this->model = new KaryaModel();
    }

    public function index() {
        $karya = $this->model->getAll();
        include __DIR__ . '/../view/admin/karya.php';
    }

    public function create() {
        $kategoriList = $this->model->getKategoriList();
        include __DIR__ . '/../view/admin/tambah_karya.php';
    }

    public function store() {
        $data = [
            'judul' => $_POST['judul'],
            'kategori_id' => $_POST['kategori_id'],
            'isi_proyek' => $_POST['isi_proyek'],
            'gambar_proyek' => ''
        ];

        if (!empty($_FILES['gambar_proyek']['name'])) {
            $targetDir = __DIR__ . "/../assets/images/uploads/";
            if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
            
            $fileName = time() . '_' . basename($_FILES["gambar_proyek"]["name"]);
            if (move_uploaded_file($_FILES["gambar_proyek"]["tmp_name"], $targetDir . $fileName)) {
                $data['gambar_proyek'] = "assets/images/uploads/" . $fileName;
            }
        }

        if ($this->model->insert($data)) {
            echo "<script>alert('Data Berhasil Disimpan!'); window.location.href='dashboard.php?page=karya';</script>";
        } else {
            echo "<script>alert('Gagal Menyimpan!'); window.location.href='dashboard.php?page=tambah_karya';</script>";
        }
    }

    public function edit() {
        $id = $_GET['id'];
        $karya = $this->model->getById($id); // Variabel jadi $karya
        $kategoriList = $this->model->getKategoriList();

        if (!$karya) {
            echo "Data tidak ditemukan!";
            exit;
        }
        include __DIR__ . '/../view/admin/edit_karya.php';
    }

    public function update() {
        $data = [
            'id' => $_POST['id'],
            'judul' => $_POST['judul'],
            'kategori_id' => $_POST['kategori_id'],
            'isi_proyek' => $_POST['isi_proyek'],
            'gambar_proyek' => ''
        ];

        if (!empty($_FILES['gambar_proyek']['name'])) {
            $targetDir = __DIR__ . "/../assets/images/uploads/";
            $fileName = time() . '_' . basename($_FILES["gambar_proyek"]["name"]);
            if (move_uploaded_file($_FILES["gambar_proyek"]["tmp_name"], $targetDir . $fileName)) {
                $data['gambar_proyek'] = "assets/images/uploads/" . $fileName;
            }
        }

        if ($this->model->update($data)) {
            echo "<script>alert('Data Berhasil Diupdate!'); window.location.href='dashboard.php?page=karya';</script>";
        } else {
            echo "<script>alert('Gagal Update!'); window.location.href='dashboard.php?page=edit_karya&id=" . $data['id'] . "';</script>";
        }
    }

    public function delete() {
        $id = $_GET['id'];
        if ($this->model->delete($id)) {
            echo "<script>alert('Data Berhasil Dihapus!'); window.location.href='dashboard.php?page=karya';</script>";
        } else {
            echo "<script>alert('Gagal Menghapus!'); window.location.href='dashboard.php?page=karya';</script>";
        }
    }
}
?>