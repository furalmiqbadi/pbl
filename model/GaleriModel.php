<?php

class GaleriModel {
    private $conn;

    public function __construct() {
        require_once '../lib/Connection.php';
        $db = new Connection();
        $this->conn = $db->connect();
    }

    public function getAll() {
        try {
            $query = "SELECT id, deskripsi, gambar_galeri, judul, tanggal_upload FROM galeri";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return [];
        }
    }
}
