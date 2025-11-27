<?php
require_once __DIR__ . '/../lib/Connection.php';

class SearchModel {
    private $db;

    public function __construct() {
        $this->db = Connection::getConnection();
    }

    public function searchAll($keyword) {
        $results = [
            'proyek' => [],
            'berita' => [],
            'mahasiswa' => [],
            'dosen' => []
        ];

        // Cek koneksi dan keyword kosong
        if (empty($keyword) || $this->db === null) {
            return $results;
        }

        try {
            // ==================================================
            // 1. METODE FTS (Full Text Search)
            // ==================================================
            $lang = 'indonesian'; 

            // Cari Proyek (Judul + Isi digabung)
            $sqlProyek = "SELECT * FROM daftar_proyek 
                          WHERE to_tsvector(:lang, judul || ' ' || isi_proyek) 
                          @@ websearch_to_tsquery(:lang, :q) LIMIT 5";
            $stmt = $this->db->prepare($sqlProyek);
            $stmt->execute([':lang' => $lang, ':q' => $keyword]);
            $results['proyek'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Cari Berita (Judul + Isi digabung)
            $sqlBerita = "SELECT * FROM berita_artikel 
                          WHERE to_tsvector(:lang, judul || ' ' || isi_berita) 
                          @@ websearch_to_tsquery(:lang, :q) LIMIT 5";
            $stmt = $this->db->prepare($sqlBerita);
            $stmt->execute([':lang' => $lang, ':q' => $keyword]);
            $results['berita'] = $stmt->fetchAll(PDO::FETCH_ASSOC);


            // ==================================================
            // 2. METODE ILIKE (Pattern Matching) - Cerdas Karakter
            // ==================================================
            
            $searchParam = "%" . $keyword . "%";
            $stmt = $this->db->prepare("SELECT * FROM mahasiswa WHERE nama ILIKE :q OR nim ILIKE :q LIMIT 5");
            $stmt->execute([':q' => $searchParam]);
            $results['mahasiswa'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Cari Dosen (Nama)
            $stmt = $this->db->prepare("SELECT * FROM dosen_multimedia WHERE nama ILIKE :q LIMIT 5");
            $stmt->execute([':q' => $searchParam]);
            $results['dosen'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            
        }

        return $results;
    }
}
?>