<?php
require_once __DIR__ . '/../lib/Connection.php';

class GaleriModel {
    private $db;

    public function __construct() {
        $this->db = Connection::getConnection();
    }
    public function getAll() {
        $sql = "SELECT * FROM galeri ORDER BY id DESC";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getPaginated($limit, $offset) {
        $sql = "SELECT * FROM galeri ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAll() {
        $sql = "SELECT COUNT(*) as total FROM galeri";
        $stmt = $this->db->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

    public function getById($id) {
        $sql = "SELECT * FROM galeri WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($data) {
        try {
            $sql = "INSERT INTO galeri (deskripsi, gambar_galeri) VALUES (:deskripsi, :gambar)";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ':deskripsi' => $data['deskripsi'],
                ':gambar' => $data['gambar']
            ]);
        } catch (PDOException $e) { return false; }
    }

    public function update($data) {
        try {
            $sql = "UPDATE galeri SET deskripsi = :deskripsi";
            $params = [
                ':deskripsi' => $data['deskripsi'],
                ':id' => $data['id']
            ];

            if (!empty($data['gambar'])) {
                $sql .= ", gambar_galeri = :gambar";
                $params[':gambar'] = $data['gambar'];
            }

            $sql .= " WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) { return false; }
    }

    public function delete($id) {
        try {
            $sql = "DELETE FROM galeri WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) { return false; }
    }
}
?>