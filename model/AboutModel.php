<?php
require_once __DIR__ . '/Model.php'; 

class AboutModel extends Model {

    // --- BAGIAN BACA DATA (READ - PUBLIC & ADMIN) ---

    public function getVisi() {
        if ($this->db === null) return 'Visi belum diatur.';
        try {
            $stmt = $this->db->query("SELECT isi_visi FROM visi LIMIT 1");
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res['isi_visi'] ?? 'Visi belum diatur.';
        } catch (PDOException $e) { return ''; }
    }

    public function getMisi() {
        if ($this->db === null) return 'Misi belum diatur.';
        try {
            $stmt = $this->db->query("SELECT isi_misi FROM misi LIMIT 1");
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res['isi_misi'] ?? 'Misi belum diatur.';
        } catch (PDOException $e) { return ''; }
    }

    public function getNilai() {
        if ($this->db === null) return [];
        try {
            $data = $this->db->query("SELECT * FROM nilai ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);
            
            // [LOGIKA GAMBAR] Tambahkan 'uploads/' jika belum ada
            foreach ($data as &$item) {
                if (!empty($item['gambar_nilai']) && strpos($item['gambar_nilai'], '/') === false) {
                    $item['gambar_nilai'] = 'uploads/' . $item['gambar_nilai'];
                }
            }
            return $data;
        } catch (PDOException $e) { return []; }
    }

    public function getSejarah() {
        if ($this->db === null) return [];
        try {
            return $this->db->query("SELECT * FROM sejarah ORDER BY tahun ASC")->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) { return []; }
    }

    public function getStrukturOrganisasi() {
        if ($this->db === null) return null;
        try {
            $stmt = $this->db->query("SELECT gambar_organisasi FROM struktur_organisasi LIMIT 1");
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($res && !empty($res['gambar_organisasi'])) {
                $img = $res['gambar_organisasi'];
                return (strpos($img, '/') === false) ? 'uploads/' . $img : $img;
            }
            return null;
        } catch (PDOException $e) { return null; }
    }

    public function getDosen() {
        if ($this->db === null) return [];
        try {
            $dosen = $this->db->query("SELECT * FROM dosen_multimedia ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($dosen as &$d) {
                if (!empty($d['gambar_tim']) && strpos($d['gambar_tim'], '/') === false) {
                    $d['gambar_tim'] = 'uploads/' . $d['gambar_tim'];
                }
            }
            return $dosen;
        } catch (PDOException $e) { return []; }
    }

    public function getDosenDetail($id) {
        if ($this->db === null) return null;
        
        try {
            $sql = "SELECT d.*, dt.biografi, dt.pendidikan_terakhir, dt.bidang_keahlian, dt.email 
                    FROM dosen_multimedia d
                    LEFT JOIN detail_dosen dt ON d.id = dt.dosen_id
                    WHERE d.id = :id";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result && !empty($result['gambar_tim']) && strpos($result['gambar_tim'], '/') === false) {
                $result['gambar_tim'] = 'uploads/' . $result['gambar_tim'];
            }

            return $result;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function getPartner() {
        if ($this->db === null) return [];
        try {
            $partner = $this->db->query("SELECT * FROM partner ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($partner as &$p) {
                if (!empty($p['gambar_brand']) && strpos($p['gambar_brand'], '/') === false) {
                    $p['gambar_brand'] = 'uploads/' . $p['gambar_brand'];
                }
            }
            return $partner;
        } catch (PDOException $e) { return []; }
    }

    public function getAllData() {
        return [
            'visi'       => $this->getVisi(),
            'misi'       => $this->getMisi(),
            'nilai_inti' => $this->getNilai(),
            'sejarah'    => $this->getSejarah(),
            'organisasi' => $this->getStrukturOrganisasi(),
            'dosen'      => $this->getDosen(),
            'partner'    => $this->getPartner()
        ];
    }
}
?>