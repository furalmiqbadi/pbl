<?php
require_once __DIR__ . '/../lib/Connection.php';

class HomeModel {
    private ?PDO $db;

    public function __construct() {
        $this->db = Connection::getConnection();
    }

    public function getHero(): array {
        if ($this->db === null) {
            return [];
        }

        try {
            // Gunakan deskripsi sebagai teks hero, gambar ambil dari nilai (jika ada)
            $sql = "SELECT judul, isi_deskripsi FROM deskripsi ORDER BY id LIMIT 1";
            $stmt = $this->db->query($sql);
            $hero = ['title' => '', 'subtitle' => '', 'cta' => 'Kenali Kami', 'image' => 'assets/images/mmtLogo.png'];
            if ($stmt) {
                $row = $stmt->fetch();
                if ($row) {
                    $hero['title'] = trim($row['judul'] ?? '');
                    $hero['subtitle'] = trim($row['isi_deskripsi'] ?? '');
                }
            }

            $imgStmt = $this->db->query("SELECT gambar_nilai FROM nilai ORDER BY id LIMIT 1");
            if ($imgStmt) {
                $imgRow = $imgStmt->fetch();
                if ($imgRow) {
                    $hero['image'] = trim($imgRow['gambar_nilai'] ?? '');
                }
            }

            return $hero;
        } catch (Throwable $e) {
            return [];
        }
    }

    public function getFokus(): array {
        if ($this->db === null) {
            return [];
        }

        try {
            $sql = "SELECT judul, gambar_nilai FROM nilai ORDER BY id LIMIT 3";
            $stmt = $this->db->query($sql);
            if ($stmt) {
                $rows = $stmt->fetchAll();
                $data = [];
                foreach ($rows as $row) {
                    $data[] = [
                        'title' => trim($row['judul'] ?? ''),
                        'text' => '', // detail belum ada di tabel nilai
                        'image' => trim($row['gambar_nilai'] ?? ''),
                    ];
                }
                return $data;
            }
        } catch (Throwable $e) {
            return [];
        }

        return [];
    }

    public function getKarya(): array {
        if ($this->db === null) {
            return [];
        }

        try {
            $sql = "SELECT dp.id, dp.judul, dp.isi_proyek, dp.gambar_proyek, k.nama_kategori FROM daftar_proyek dp LEFT JOIN kategori k ON dp.kategori_id = k.id ORDER BY dp.id DESC";
            $stmt = $this->db->query($sql);
            if ($stmt) {
                $rows = $stmt->fetchAll();
                $data = [];
                foreach ($rows as $row) {
                    $rawExcerpt = trim(strip_tags($row['isi_proyek'] ?? ''));
                    $excerpt = mb_substr($rawExcerpt, 0, 140);
                    $data[] = [
                        'id' => $row['id'] ?? null,
                        'title' => trim($row['judul'] ?? ''),
                        'category' => trim($row['nama_kategori'] ?? ''),
                        'image' => trim($row['gambar_proyek'] ?? ''),
                        'excerpt' => $excerpt,
                    ];
                }
                return $data;
            }
        } catch (Throwable $e) {
            return [];
        }

        return [];
    }

    public function getArtikel(): array {
        if ($this->db === null) {
            return [];
        }

        try {
            $sql = "SELECT ba.id, ba.judul, ba.isi_berita, ba.gambar_berita, ba.created_at, k.nama_kategori FROM berita_artikel ba LEFT JOIN kategori k ON ba.kategori_id = k.id ORDER BY ba.created_at DESC, ba.id DESC LIMIT 3";
            $stmt = $this->db->query($sql);
            if ($stmt) {
                $rows = $stmt->fetchAll();
                $data = [];
                foreach ($rows as $row) {
                    $rawDate = $row['created_at'] ?? null;
                    $displayDate = '';
                    if ($rawDate) {
                        $timestamp = strtotime($rawDate);
                        if ($timestamp !== false) {
                            $displayDate = date('Y-m-d', $timestamp);
                        }
                    }

                    $data[] = [
                        'id' => $row['id'] ?? null,
                        'title' => trim($row['judul'] ?? ''),
                        'category' => trim($row['nama_kategori'] ?? ''),
                        'date' => $displayDate ?: '',
                        'excerpt' => trim($row['isi_berita'] ?? ''),
                        'image' => trim($row['gambar_berita'] ?? ''),
                    ];
                }
                return $data;
            }
        } catch (Throwable $e) {
            return [];
        }

        return [];
    }

    public function getGallery(): array {
        if ($this->db === null) {
            return [];
        }

        try {
            $sql = "SELECT gambar_galeri FROM galeri ORDER BY id DESC LIMIT 16";
            $stmt = $this->db->query($sql);
            if ($stmt) {
                $rows = $stmt->fetchAll();
                $data = [];
                foreach ($rows as $row) {
                    $src = trim($row['gambar_galeri'] ?? '');
                    if ($src !== '') {
                        $data[] = ['image' => $src];
                    }
                }
                return $data;
            }
        } catch (Throwable $e) {
            return [];
        }

        return [];
    }

    public function getGalleryRows(): array {
        $items = $this->getGallery();
        $top = array_slice($items, 0, 8);
        $bottom = array_slice($items, 8, 8);
        return ['top' => $top, 'bottom' => $bottom];
    }
}
