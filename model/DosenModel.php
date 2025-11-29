<?php
require_once __DIR__ . '/../lib/Connection.php';

class DosenModel {
    private $db;

    public function __construct() {
        $this->db = Connection::getConnection();
    }

    public function getAll() {
        $sql = "SELECT * FROM dosen_multimedia ORDER BY id DESC";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // --- FUNGSI SEARCH (BARU) ---
    public function search($keyword) {
        $key = "%" . $keyword . "%";
        // Cari berdasarkan Nama atau NIDN (Case Insensitive)
        $sql = "SELECT * FROM dosen_multimedia 
                WHERE nama ILIKE :k OR nidn ILIKE :k 
                ORDER BY id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':k' => $key]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM dosen_multimedia WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($nama, $nidn, $jabatan, $gambar, $linkedin, $instagram, $github) {
        try {
            $sql = "INSERT INTO dosen_multimedia (nama, nidn, jabatan, gambar_tim, link_linkedin, link_instagram, link_github) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            return $this->db->prepare($sql)->execute([$nama, $nidn, $jabatan, $gambar, $linkedin, $instagram, $github]);
        } catch (PDOException $e) { return false; }
    }

    public function update($id, $nama, $nidn, $jabatan, $linkedin, $instagram, $github, $gambar = null) {
        try {
            if ($gambar) {
                $sql = "UPDATE dosen_multimedia SET nama=?, nidn=?, jabatan=?, link_linkedin=?, link_instagram=?, link_github=?, gambar_tim=? WHERE id=?";
                return $this->db->prepare($sql)->execute([$nama, $nidn, $jabatan, $linkedin, $instagram, $github, $gambar, $id]);
            } else {
                $sql = "UPDATE dosen_multimedia SET nama=?, nidn=?, jabatan=?, link_linkedin=?, link_instagram=?, link_github=? WHERE id=?";
                return $this->db->prepare($sql)->execute([$nama, $nidn, $jabatan, $linkedin, $instagram, $github, $id]);
            }
        } catch (PDOException $e) { return false; }
    }

    public function delete($id) {
        try { return $this->db->prepare("DELETE FROM dosen_multimedia WHERE id = ?")->execute([$id]); } 
        catch (PDOException $e) { return false; }
    }
}
?>