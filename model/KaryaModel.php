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

    public function getMahasiswaList() {
        return $this->db->query("SELECT id, nama, nim FROM mahasiswa ORDER BY nama ASC")->fetchAll(PDO::FETCH_ASSOC);
    }

    // [BARU] Ambil ID mahasiswa yang sudah masuk tim di proyek ini
    public function getTeamMembers($proyekId) {
        $sql = "SELECT mahasiswa_id FROM mahasiswa_proyek WHERE proyek_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $proyekId]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN); // Mengembalikan array flat [1, 5, 8]
    }

    public function getById($id) {
        $sql = "SELECT * FROM daftar_proyek WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($data) {
        try {
            $this->db->beginTransaction();
            $sql = "INSERT INTO daftar_proyek (judul, kategori_id, isi_proyek, gambar_proyek, tahun, nama_tim) 
                    VALUES (:judul, :kategori_id, :isi, :gambar, :tahun, :nama_tim) RETURNING id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':judul' => $data['judul'],
                ':kategori_id' => $data['kategori_id'],
                ':isi' => $data['isi_proyek'],
                ':gambar' => $data['gambar_proyek'],
                ':tahun' => $data['tahun'],
                ':nama_tim' => $data['nama_tim']
            ]);
            $proyekId = $stmt->fetch(PDO::FETCH_ASSOC)['id'];

            if (!empty($data['mahasiswa_ids'])) {
                $sqlMhs = "INSERT INTO mahasiswa_proyek (mahasiswa_id, proyek_id) VALUES (:mhs_id, :proyek_id)";
                $stmtMhs = $this->db->prepare($sqlMhs);
                foreach ($data['mahasiswa_ids'] as $mhsId) {
                    $stmtMhs->execute([':mhs_id' => $mhsId, ':proyek_id' => $proyekId]);
                }
            }
            $this->db->commit();
            return true;
        } catch (PDOException $e) { 
            $this->db->rollBack();
            return false; 
        }
    }

    // [PERBAIKAN] Logika Update Data Lengkap
    public function update($data) {
        try {
            $this->db->beginTransaction();

            // 1. Update Tabel Utama
            $sql = "UPDATE daftar_proyek 
                    SET judul = :judul, 
                        kategori_id = :kategori_id, 
                        isi_proyek = :isi, 
                        tahun = :tahun, 
                        nama_tim = :nama_tim";
            
            $params = [
                ':judul' => $data['judul'],
                ':kategori_id' => $data['kategori_id'],
                ':isi' => $data['isi_proyek'],
                ':tahun' => $data['tahun'],
                ':nama_tim' => $data['nama_tim'],
                ':id' => $data['id']
            ];

            // Update gambar hanya jika ada file baru
            if (!empty($data['gambar_proyek'])) {
                $sql .= ", gambar_proyek = :gambar";
                $params[':gambar'] = $data['gambar_proyek'];
            }

            $sql .= " WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);

            // 2. Update Anggota Tim (Hapus semua dulu, lalu insert ulang yang baru)
            // Ini cara termudah untuk menangani perubahan anggota (tambah/kurang)
            $delSql = "DELETE FROM mahasiswa_proyek WHERE proyek_id = :id";
            $delStmt = $this->db->prepare($delSql);
            $delStmt->execute([':id' => $data['id']]);

            if (!empty($data['mahasiswa_ids'])) {
                $sqlMhs = "INSERT INTO mahasiswa_proyek (mahasiswa_id, proyek_id) VALUES (:mhs_id, :proyek_id)";
                $stmtMhs = $this->db->prepare($sqlMhs);
                foreach ($data['mahasiswa_ids'] as $mhsId) {
                    $stmtMhs->execute([':mhs_id' => $mhsId, ':proyek_id' => $data['id']]);
                }
            }

            $this->db->commit();
            return true;

        } catch (PDOException $e) { 
            $this->db->rollBack();
            return false; 
        }
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