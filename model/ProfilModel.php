<?php
require_once __DIR__ . '/../lib/Connection.php';

class ProfilModel {
    private $db;

    public function __construct() {
        $this->db = Connection::getConnection();
    }

    // ==========================
    // 1. GET DATA (READ)
    // ==========================
    public function getDeskripsi() { return $this->db->query("SELECT * FROM deskripsi LIMIT 1")->fetch(PDO::FETCH_ASSOC); }
    public function getVisi() { return $this->db->query("SELECT * FROM visi LIMIT 1")->fetch(PDO::FETCH_ASSOC); }
    public function getMisi() { return $this->db->query("SELECT * FROM misi LIMIT 1")->fetch(PDO::FETCH_ASSOC); }
    public function getSejarah() { return $this->db->query("SELECT * FROM sejarah ORDER BY tahun DESC")->fetchAll(PDO::FETCH_ASSOC); }
    public function getNilai() { return $this->db->query("SELECT * FROM nilai ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC); }
    public function getStruktur() { return $this->db->query("SELECT * FROM struktur_organisasi LIMIT 1")->fetch(PDO::FETCH_ASSOC); }
    public function getPartner() { return $this->db->query("SELECT * FROM partner ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC); }


    // ==========================
    // 2. UPDATE SINGLE DATA
    // ==========================
    public function updateDeskripsi($isi) {
        $check = $this->db->query("SELECT count(*) FROM deskripsi")->fetchColumn();
        if ($check > 0) {
            $sql = "UPDATE deskripsi SET isi_deskripsi = ?";
        } else {
            $sql = "INSERT INTO deskripsi (isi_deskripsi) VALUES (?)";
        }
        return $this->db->prepare($sql)->execute([$isi]);
    }

    public function updateVisi($isi) {
        $sql = "UPDATE visi SET isi_visi = ? WHERE id = (SELECT id FROM visi LIMIT 1)";
        return $this->db->prepare($sql)->execute([$isi]);
    }

    public function updateMisi($isi) {
        $sql = "UPDATE misi SET isi_misi = ? WHERE id = (SELECT id FROM misi LIMIT 1)";
        return $this->db->prepare($sql)->execute([$isi]);
    }

    public function updateStruktur($gambar) {
        $check = $this->db->query("SELECT count(*) FROM struktur_organisasi")->fetchColumn();
        if ($check > 0) {
            $sql = "UPDATE struktur_organisasi SET gambar_organisasi = ?";
        } else {
            $sql = "INSERT INTO struktur_organisasi (gambar_organisasi) VALUES (?)";
        }
        return $this->db->prepare($sql)->execute([$gambar]);
    }


    // ==========================
    // 3. CRUD SEJARAH (Tanpa Gambar)
    // ==========================
    public function saveSejarah($judul, $isi, $tahun, $id = null) {
        if ($id) {
            $sql = "UPDATE sejarah SET judul=?, isi=?, tahun=? WHERE id=?";
            return $this->db->prepare($sql)->execute([$judul, $isi, $tahun, $id]);
        } else {
            $sql = "INSERT INTO sejarah (judul, isi, tahun) VALUES (?, ?, ?)";
            return $this->db->prepare($sql)->execute([$judul, $isi, $tahun]);
        }
    }
    
    public function deleteSejarah($id) {
        return $this->db->prepare("DELETE FROM sejarah WHERE id = ?")->execute([$id]);
    }


    // ==========================
    // 4. CRUD NILAI INTI (Ada Gambar)
    // ==========================
    public function saveNilai($judul, $deskripsi, $gambar, $id = null) {
        if ($id) {
            $sql = "UPDATE nilai SET judul=?, deskripsi=?, gambar_nilai=? WHERE id=?";
            return $this->db->prepare($sql)->execute([$judul, $deskripsi, $gambar, $id]);
        } else {
            $sql = "INSERT INTO nilai (judul, deskripsi, gambar_nilai) VALUES (?, ?, ?)";
            return $this->db->prepare($sql)->execute([$judul, $deskripsi, $gambar]);
        }
    }

    // UPDATE PENTING: Hapus gambar fisik sebelum hapus data
    public function deleteNilai($id) {
        try {
            // 1. Ambil nama gambar dulu
            $stmt = $this->db->prepare("SELECT gambar_nilai FROM nilai WHERE id = ?");
            $stmt->execute([$id]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            // 2. Hapus file fisik jika ada
            if ($data && !empty($data['gambar_nilai'])) {
                $file = __DIR__ . '/../assets/images/uploads/' . $data['gambar_nilai'];
                if ($data['gambar_nilai'] != 'default.png' && file_exists($file)) {
                    unlink($file);
                }
            }

            // 3. Hapus dari database
            return $this->db->prepare("DELETE FROM nilai WHERE id = ?")->execute([$id]);
        } catch (PDOException $e) {
            return false;
        }
    }


    // ==========================
    // 5. CRUD PARTNER (Ada Gambar)
    // ==========================
    public function savePartner($nama, $gambar, $id = null) {
        if ($id) {
            $sql = "UPDATE partner SET nama_brand=?, gambar_brand=? WHERE id=?";
            return $this->db->prepare($sql)->execute([$nama, $gambar, $id]);
        } else {
            $sql = "INSERT INTO partner (nama_brand, gambar_brand) VALUES (?, ?)";
            return $this->db->prepare($sql)->execute([$nama, $gambar]);
        }
    }

    // UPDATE PENTING: Hapus gambar fisik sebelum hapus data
    public function deletePartner($id) {
        try {
            // 1. Ambil nama gambar dulu
            $stmt = $this->db->prepare("SELECT gambar_brand FROM partner WHERE id = ?");
            $stmt->execute([$id]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            // 2. Hapus file fisik jika ada
            if ($data && !empty($data['gambar_brand'])) {
                $file = __DIR__ . '/../assets/images/uploads/' . $data['gambar_brand'];
                if ($data['gambar_brand'] != 'default.png' && file_exists($file)) {
                    unlink($file);
                }
            }

            // 3. Hapus dari database
            return $this->db->prepare("DELETE FROM partner WHERE id = ?")->execute([$id]);
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>