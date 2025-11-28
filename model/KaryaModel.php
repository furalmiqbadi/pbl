<?php
require_once __DIR__ . '/../lib/Connection.php';

class KaryaModel {
    private $db;

    public function __construct() {
        $this->db = Connection::getConnection();
    }

    public function getAll() {
        $sql = "SELECT p.*, k.nama_kategori 
                FROM daftar_proyek p 
                LEFT JOIN kategori k ON p.kategori_id = k.id 
                ORDER BY p.id DESC";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getKategoriList() {
        return $this->db->query("SELECT * FROM kategori ORDER BY nama_kategori ASC")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT * FROM daftar_proyek WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($data) {
        try {
            $sql = "INSERT INTO daftar_proyek (judul, kategori_id, isi_proyek, gambar_proyek) 
                    VALUES (:judul, :kategori_id, :isi, :gambar)";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ':judul' => $data['judul'],
                ':kategori_id' => $data['kategori_id'],
                ':isi' => $data['isi_proyek'],
                ':gambar' => $data['gambar_proyek']
            ]);
        } catch (PDOException $e) { return false; }
    }

    public function update($data) {
        try {
            $sql = "UPDATE daftar_proyek 
                    SET judul = :judul, kategori_id = :kategori_id, isi_proyek = :isi";
            
            $params = [
                ':judul' => $data['judul'],
                ':kategori_id' => $data['kategori_id'],
                ':isi' => $data['isi_proyek'],
                ':id' => $data['id']
            ];

            if (!empty($data['gambar_proyek'])) {
                $sql .= ", gambar_proyek = :gambar";
                $params[':gambar'] = $data['gambar_proyek'];
            }

            $sql .= " WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) { return false; }
    }

    public function delete($id) {
        try {
            $sql = "DELETE FROM daftar_proyek WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) { return false; }
    }
}
?>