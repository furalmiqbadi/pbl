<?php
require_once __DIR__ . '/../model/ProfilModel.php';

class ProfilController {
    private $model;

    public function __construct() {
        $this->model = new ProfilModel();
    }

    public function index() {
        $deskripsi = $this->model->getDeskripsi();
        $visi = $this->model->getVisi();
        $misi = $this->model->getMisi();
        $sejarah = $this->model->getSejarah();
        $nilai = $this->model->getNilai();
        $struktur = $this->model->getStruktur();
        $partner = $this->model->getPartner();
        
        include __DIR__ . '/../view/admin/profil.php';
    }

    // --- ACTIONS ---
    public function updateDeskripsi() {
        $this->model->updateDeskripsi($_POST['isi_deskripsi']);
        header("Location: dashboard.php?page=profil");
    }

    public function updateVisiMisi() {
        if(isset($_POST['visi'])) $this->model->updateVisi($_POST['visi']);
        if(isset($_POST['misi'])) $this->model->updateMisi($_POST['misi']);
        header("Location: dashboard.php?page=profil");
    }

    public function saveSejarah() {
        $this->model->saveSejarah($_POST['judul'], $_POST['isi'], $_POST['tahun'], $_POST['id'] ?? null);
        header("Location: dashboard.php?page=profil");
    }
    public function deleteSejarah() {
        $this->model->deleteSejarah($_GET['id']);
        header("Location: dashboard.php?page=profil");
    }

    public function updateStruktur() {
        if (!empty($_FILES['gambar']['name'])) {
            $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
            $gambar = time() . '_struktur.' . $ext;
            $targetDir = __DIR__ . '/../assets/images/uploads/';
            if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
            move_uploaded_file($_FILES['gambar']['tmp_name'], $targetDir . $gambar);
            
            $this->model->updateStruktur($gambar);
        }
        header("Location: dashboard.php?page=profil");
    }

    public function saveNilai() {
        $gambar = $_POST['gambar_lama'] ?? 'default.png';
        if (!empty($_FILES['gambar']['name'])) {
            $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
            $gambar = time() . '_nilai.' . $ext;
            $targetDir = __DIR__ . '/../assets/images/uploads/';
            if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
            move_uploaded_file($_FILES['gambar']['tmp_name'], $targetDir . $gambar);
        }
        $this->model->saveNilai($_POST['judul'], $_POST['deskripsi'], $gambar, $_POST['id'] ?? null);
        header("Location: dashboard.php?page=profil");
    }
    public function deleteNilai() {
        $this->model->deleteNilai($_GET['id']);
        header("Location: dashboard.php?page=profil");
    }

    public function savePartner() {
        $gambar = $_POST['gambar_lama'] ?? 'default.png';
        if (!empty($_FILES['gambar']['name'])) {
            $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
            $gambar = time() . '_partner.' . $ext;
            $targetDir = __DIR__ . '/../assets/images/uploads/';
            if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
            move_uploaded_file($_FILES['gambar']['tmp_name'], $targetDir . $gambar);
        }
        $this->model->savePartner($_POST['nama_brand'], $gambar, $_POST['id'] ?? null);
        header("Location: dashboard.php?page=profil");
    }
    public function deletePartner() {
        $this->model->deletePartner($_GET['id']);
        header("Location: dashboard.php?page=profil");
    }
}
?>