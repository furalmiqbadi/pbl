<?php
require_once __DIR__ . '/../lib/Connection.php';

class NewsModel {
    private ?PDO $conn;
    private string $table = "berita_artikel";

    public function __construct() {
        $this->conn = Connection::getConnection();
    }

    /**
     * Ambil berita dengan filter + pagination.
     */
    public function getNews(?string $keyword = null, ?int $kategoriId = null, int $offset = 0, int $limit = 10): array {
        if ($this->conn === null) {
            return [];
        }

        $sql = "SELECT b.id, b.judul, b.isi_berita, b.gambar_berita, b.created_at, k.nama_kategori 
                FROM {$this->table} b
                LEFT JOIN kategori k ON b.kategori_id = k.id
                WHERE 1=1";

        $params = [];
        if (!empty($keyword)) {
            $sql .= " AND (b.judul ILIKE :kw OR b.isi_berita ILIKE :kw)";
            $params[':kw'] = '%' . $keyword . '%';
        }
        if (!empty($kategoriId)) {
            $sql .= " AND b.kategori_id = :kat";
            $params[':kat'] = $kategoriId;
        }

        $sql .= " ORDER BY b.created_at DESC, b.id DESC LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($sql);
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val, is_int($val) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Hitung total berita untuk pagination.
     */
    public function countNews(?string $keyword = null, ?int $kategoriId = null): int {
        if ($this->conn === null) {
            return 0;
        }
        $sql = "SELECT COUNT(*) AS total FROM {$this->table} b WHERE 1=1";
        $params = [];
        if (!empty($keyword)) {
            $sql .= " AND (b.judul ILIKE :kw OR b.isi_berita ILIKE :kw)";
            $params[':kw'] = '%' . $keyword . '%';
        }
        if (!empty($kategoriId)) {
            $sql .= " AND b.kategori_id = :kat";
            $params[':kat'] = $kategoriId;
        }
        $stmt = $this->conn->prepare($sql);
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val, is_int($val) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)($row['total'] ?? 0);
    }

    /**
     * Ambil 1 berita terbaru (bisa disaring kategori / keyword).
     */
    public function getLatest(?string $keyword = null, ?int $kategoriId = null): ?array {
        $data = $this->getNews($keyword, $kategoriId, 0, 1);
        return $data[0] ?? null;
    }

    /**
     * Ambil daftar kategori untuk dropdown.
     */
    public function getCategories(): array {
        if ($this->conn === null) {
            return [];
        }
        $stmt = $this->conn->prepare("SELECT id, nama_kategori FROM kategori ORDER BY nama_kategori ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
