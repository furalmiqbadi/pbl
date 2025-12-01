<?php

require_once __DIR__ . '/Model.php';

class NewsModel extends Model
{
    private string $table = "berita_artikel";

    /**
     * Ambil berita dengan filter + pagination.
     */
    public function getNews(?string $keyword = null, ?int $kategoriId = null, int $offset = 0, int $limit = 10): array
    {
        // Cek koneksi pakai $this->db (warisan dari Model)
        if ($this->db === null) {
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

        $stmt = $this->db->prepare($sql); // Pakai $this->db
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
    public function countNews(?string $keyword = null, ?int $kategoriId = null): int
    {
        if ($this->db === null) {
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
        $stmt = $this->db->prepare($sql);
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val, is_int($val) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int) ($row['total'] ?? 0);
    }

    /**
     * Ambil 1 berita terbaru (bisa disaring kategori / keyword).
     */
    public function getLatest(?string $keyword = null, ?int $kategoriId = null): ?array
    {
        $data = $this->getNews($keyword, $kategoriId, 0, 1);
        return $data[0] ?? null;
    }

    /**
     * Ambil daftar kategori untuk dropdown.
     */
    public function getCategories(): array
    {
        if ($this->db === null) {
            return [];
        }
        $stmt = $this->db->prepare("SELECT id, nama_kategori FROM kategori ORDER BY nama_kategori ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNewsById($id)
    {
        if ($this->db === null) {
            return null;
        }
        $query = "SELECT b.*, k.nama_kategori 
                  FROM berita_artikel b
                  LEFT JOIN kategori k ON b.kategori_id = k.id
                  WHERE b.id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 1. Ambil Semua
    public function getAllNews()
    {
        if ($this->db === null)
            return [];
        $sql = "SELECT b.*, k.nama_kategori 
                FROM berita_artikel b
                LEFT JOIN kategori k ON b.kategori_id = k.id
                ORDER BY b.created_at DESC";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // 2. Insert Data
    public function insert($data)
    {
        if ($this->db === null)
            return false;
        $sql = "INSERT INTO berita_artikel (judul, isi_berita, kategori_id, gambar_berita, created_at) 
                VALUES (:judul, :isi, :kat, :img, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':judul', $data['judul']);
        $stmt->bindValue(':isi', $data['isi_berita']);
        $stmt->bindValue(':kat', $data['kategori_id'] ?: null);
        $stmt->bindValue(':img', $data['gambar_berita']);
        return $stmt->execute();
    }

    // 3. Update Data
    public function update($data)
    {
        if ($this->db === null)
            return false;

        $sql = "UPDATE berita_artikel SET judul = :judul, isi_berita = :isi, kategori_id = :kat, updated_at = NOW()";

        // Cek apakah gambar diupdate
        if (!empty($data['gambar_berita'])) {
            $sql .= ", gambar_berita = :img";
        }
        $sql .= " WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':judul', $data['judul']);
        $stmt->bindValue(':isi', $data['isi_berita']);
        $stmt->bindValue(':kat', $data['kategori_id'] ?: null);
        $stmt->bindValue(':id', $data['id']);

        if (!empty($data['gambar_berita'])) {
            $stmt->bindValue(':img', $data['gambar_berita']);
        }

        return $stmt->execute();
    }

    // 4. Delete Data
    public function delete($id)
    {
        if ($this->db === null)
            return false;
        $stmt = $this->db->prepare("DELETE FROM berita_artikel WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}