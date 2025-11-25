<?php
require_once __DIR__ . '/../lib/Connection.php';

class NewsModel {
    private $conn;
    private $table = "berita_artikel";

    public function __construct() {
        $db = new Connection();
        $this->conn = $db->getConnection();
    }

    // Ambil semua berita (dengan fitur search & filter)
    public function getNews($keyword = null, $kategori = null) {
        // Query Join untuk mengambil nama kategori
        $query = "SELECT b.*, k.nama_kategori 
                  FROM " . $this->table . " b
                  LEFT JOIN kategori k ON b.kategori_id = k.id
                  WHERE 1=1";

        if ($keyword) {
            $query .= " AND b.judul ILIKE :keyword";
        }
        if ($kategori && $kategori != 'semua') {
            $query .= " AND k.nama_kategori ILIKE :kategori";
        }

        $query .= " ORDER BY b.created_at DESC"; // Urutkan dari yang terbaru

        $stmt = $this->conn->prepare($query);

        if ($keyword) {
            $key = "%{$keyword}%";
            $stmt->bindParam(':keyword', $key);
        }
        if ($kategori && $kategori != 'semua') {
            $stmt->bindParam(':kategori', $kategori);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil daftar kategori untuk dropdown
    public function getCategories() {
        $query = "SELECT * FROM kategori ORDER BY nama_kategori ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>