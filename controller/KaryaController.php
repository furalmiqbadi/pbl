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
        $mahasiswaList = $this->model->getMahasiswaList();
        include __DIR__ . '/../view/admin/tambah_karya.php';
    }

    public function store() {
        $data = [
            'judul' => $_POST['judul'],
            'kategori_id' => $_POST['kategori_id'],
            'isi_proyek' => $_POST['deskripsi'],
            'tahun' => $_POST['tahun'],
            'nama_tim' => $_POST['nama_tim'],
            'mahasiswa_ids' => $_POST['anggota_tim'] ?? [],
            'gambar_proyek' => ''
        ];

        if (!empty($_FILES['gambar_proyek']['name'])) {
            $targetDir = __DIR__ . "/../assets/images/uploads/";
            if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
            
            $fileExtension = pathinfo($_FILES["gambar_proyek"]["name"], PATHINFO_EXTENSION);
            $fileName = time() . '_' . uniqid() . '.' . $fileExtension;
            
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

    // [PERBAIKAN] Ambil data lengkap untuk form edit
    public function edit() {
        $id = $_GET['id'];
        $karya = $this->model->getById($id);
        $kategoriList = $this->model->getKategoriList();
        $mahasiswaList = $this->model->getMahasiswaList();
        
        // Ambil anggota tim yang sudah terpilih sebelumnya (Array ID)
        $selectedMembers = $this->model->getTeamMembers($id); 

        if (!$karya) {
            echo "Data tidak ditemukan!";
            exit;
        }
        include __DIR__ . '/../view/admin/edit_karya.php';
    }

    // [PERBAIKAN] Proses Update
    public function update() {
        $data = [
            'id' => $_POST['id'],
            'judul' => $_POST['judul'],
            'kategori_id' => $_POST['kategori_id'],
            'isi_proyek' => $_POST['deskripsi'], // Sesuaikan name di form
            'tahun' => $_POST['tahun'],
            'nama_tim' => $_POST['nama_tim'],
            'mahasiswa_ids' => $_POST['anggota_tim'] ?? [],
            'gambar_proyek' => ''
        ];

        if (!empty($_FILES['gambar_proyek']['name'])) {
            $targetDir = __DIR__ . "/../assets/images/uploads/";
            $fileExtension = pathinfo($_FILES["gambar_proyek"]["name"], PATHINFO_EXTENSION);
            $fileName = time() . '_' . uniqid() . '.' . $fileExtension;
            
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