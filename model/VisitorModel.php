<?php
require_once __DIR__ . '/../lib/Connection.php';

class VisitorModel {
    private $db;

    public function __construct() {
        $this->db = Connection::getConnection();
    }

    // TUGAS 1: Merekam (Mode Ketat)
    public function rekamKunjungan() {
        $ip = $_SERVER['REMOTE_ADDR']; 
        $tanggal = date('Y-m-d');

        try {
            // Gunakan "ON CONFLICT DO NOTHING"
            // Artinya: Coba masukkan. Jika database menolak (karena duplikat), diam saja.
            $sql = "INSERT INTO pengunjung (ip_address, tanggal) 
                    VALUES (?, ?) 
                    ON CONFLICT (ip_address, tanggal) DO NOTHING";
            
            $this->db->prepare($sql)->execute([$ip, $tanggal]);
        } catch (PDOException $e) {
            // Silent error
        }
    }

    // TUGAS 2: Mengambil Statistik Angka (Hari ini, Bulan ini, Total)
    public function getStatistik() {
        $stats = ['hari_ini' => 0, 'bulan_ini' => 0, 'total' => 0];
        try {
            $stats['hari_ini'] = $this->db->query("SELECT COUNT(*) FROM pengunjung WHERE tanggal = CURRENT_DATE")->fetchColumn();
            $stats['bulan_ini'] = $this->db->query("SELECT COUNT(*) FROM pengunjung WHERE date_part('month', tanggal) = date_part('month', CURRENT_DATE) AND date_part('year', tanggal) = date_part('year', CURRENT_DATE)")->fetchColumn();
            $stats['total'] = $this->db->query("SELECT COUNT(*) FROM pengunjung")->fetchColumn();
        } catch (PDOException $e) {}
        return $stats;
    }

    // TUGAS 3: Mengambil Data Grafik (7 Hari Terakhir)
    public function getGrafikMingguan() {
        try {
            $sql = "SELECT TO_CHAR(tanggal, 'DD Mon') as tgl, COUNT(*) as jumlah 
                    FROM pengunjung 
                    WHERE tanggal >= CURRENT_DATE - INTERVAL '6 days'
                    GROUP BY tanggal 
                    ORDER BY tanggal ASC";
            return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }
}
?>