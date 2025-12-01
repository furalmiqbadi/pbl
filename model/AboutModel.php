<?php
require_once __DIR__ . '/../lib/Connection.php'; 

class AboutModel {
    private $conn;

    public function __construct() {
        $this->conn = Connection::getConnection();
    }
    private function getAboutData() {
        $data = [];
        try {
            $stmt_visi = $this->conn->query("SELECT isi_visi FROM visi LIMIT 1");
            $row_visi = $stmt_visi->fetch(PDO::FETCH_ASSOC);
            $data['visi'] = $row_visi['isi_visi'] ?? 'Visi belum diatur.';

            $stmt_misi = $this->conn->query("SELECT isi_misi FROM misi LIMIT 1");
            $row_misi = $stmt_misi->fetch(PDO::FETCH_ASSOC);
            $data['misi'] = $row_misi['isi_misi'] ?? 'Misi belum diatur.';
            
            $stmt_nilai = $this->conn->query("SELECT * FROM nilai ORDER BY id ASC");
            $data['nilai_inti'] = $stmt_nilai->fetchAll(PDO::FETCH_ASSOC);

            $stmt_sejarah = $this->conn->query("SELECT * FROM sejarah ORDER BY tahun ASC");
            $data['sejarah'] = $stmt_sejarah->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log("Error fetching About data: " . $e->getMessage());
            $data = ['visi' => 'Error DB', 'misi' => 'Error DB', 'nilai_inti' => [], 'sejarah' => []];
        }
        return $data;
    }

    private function getStrukturOrganisasi() {
        try {
            $stmt = $this->conn->query("SELECT gambar_organisasi FROM struktur_organisasi LIMIT 1");
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($res && !empty($res['gambar_organisasi'])) {
                return 'assets/images/uploads/' . $res['gambar_organisasi'];
            }
            return null;
        } catch (PDOException $e) {
            return null;
        }
    }

    private function getDosen() {
        try {
            $stmt = $this->conn->query("SELECT * FROM dosen_multimedia ORDER BY id ASC");
            $dosen = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($dosen as &$d) {
                if (!empty($d['gambar_tim']) && $d['gambar_tim'] !== 'default.png') {
                    $d['gambar_tim'] = 'assets/images/uploads/' . $d['gambar_tim'];
                }
            }
            return $dosen;
        } catch (PDOException $e) {
            return [];
        }
    }

    private function getPartner() {
        try {
            $stmt = $this->conn->query("SELECT * FROM partner ORDER BY id ASC");
            $partner = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($partner as &$p) {
                if (!empty($p['gambar_brand'])) {
                    $p['gambar_brand'] = 'assets/images/uploads/' . $p['gambar_brand'];
                }
            }
            return $partner;
        } catch (PDOException $e) {
            return [];
        }
    }

    public function getAllData() {
        $data = $this->getAboutData();
        $data['organisasi'] = $this->getStrukturOrganisasi();
        $data['dosen'] = $this->getDosen();
        $data['partner'] = $this->getPartner();
        return $data;
    }
}
?>