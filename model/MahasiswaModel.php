<?php
require_once __DIR__ . '/../lib/Connection.php';

class MahasiswaModel {
    private $db;

    public function __construct() {
        $this->db = Connection::getConnection();
    }

    public function getAll() {
        $sql = "SELECT m.*, p.nama_prodi 
                FROM mahasiswa m 
                LEFT JOIN prodi p ON m.prodi_id = p.id 
                ORDER BY m.id DESC";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // --- FUNGSI SEARCH (BARU) ---
    public function search($keyword) {
        $key = "%" . $keyword . "%";
        // Menggunakan ILIKE (PostgreSQL) agar tidak sensitif huruf besar/kecil
        $sql = "SELECT m.*, p.nama_prodi 
                FROM mahasiswa m 
                LEFT JOIN prodi p ON m.prodi_id = p.id 
                WHERE m.nama ILIKE :k OR m.nim ILIKE :k
                ORDER BY m.id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':k' => $key]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProdiList() {
        return $this->db->query("SELECT * FROM prodi ORDER BY nama_prodi ASC")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($nim, $nama, $prodi_id) {
        try {
            $sql = "INSERT INTO mahasiswa (nim, nama, prodi_id) VALUES (:nim, :nama, :prodi_id)";
            return $this->db->prepare($sql)->execute([':nim' => $nim, ':nama' => $nama, ':prodi_id' => $prodi_id]);
        } catch (PDOException $e) { return false; }
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM mahasiswa WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $nim, $nama, $prodi_id) {
        try {
            $sql = "UPDATE mahasiswa SET nim = :nim, nama = :nama, prodi_id = :prodi_id WHERE id = :id";
            return $this->db->prepare($sql)->execute([':nim' => $nim, ':nama' => $nama, ':prodi_id' => $prodi_id, ':id' => $id]);
        } catch (PDOException $e) { return false; }
    }

    public function delete($id) {
        return $this->db->prepare("DELETE FROM mahasiswa WHERE id = :id")->execute([':id' => $id]);
    }
}
?>