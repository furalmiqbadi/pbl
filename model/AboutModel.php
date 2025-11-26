<?php
// File: model/TentangModel.php

class TentangModel {
    private $conn;

    public function __construct() {
        // Path relatif ke file koneksi Anda
        require_once '../lib/Connection.php'; 
        
        // Asumsi class Connection ada dan method connect() mengembalikan objek PDO
        $db = new Connection(); 
        $this->conn = $db->connect();
    }

    // Mengambil Visi, Misi, Nilai, dan Sejarah
    private function getAboutData() {
        $data = [];
        try {
            // Visi
            $stmt_visi = $this->conn->prepare("SELECT isi FROM v_deskripsi_visi_misi WHERE jenis = 'visi' LIMIT 1");
            $stmt_visi->execute();
            $data['visi'] = $stmt_visi->fetch(PDO::FETCH_ASSOC)['isi'] ?? 'Visi belum diatur.';

            // Misi
            $stmt_misi = $this->conn->prepare("SELECT isi FROM v_deskripsi_visi_misi WHERE jenis = 'misi' LIMIT 1");
            $stmt_misi->execute();
            $data['misi'] = $stmt_misi->fetch(PDO::FETCH_ASSOC)['isi'] ?? 'Misi belum diatur.';
            
            // Nilai Inti
            $stmt_nilai = $this->conn->query("SELECT judul, gambar_nilai FROM nilai ORDER BY id ASC");
            $data['nilai_inti'] = $stmt_nilai->fetchAll(PDO::FETCH_ASSOC);

            // Sejarah
            $stmt_sejarah = $this->conn->query("SELECT judul, isi FROM sejarah ORDER BY id ASC");
            $data['sejarah'] = $stmt_sejarah->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            // Log error dan kembalikan data default jika gagal
            error_log("Error fetching 'Tentang Kami' data: " . $e->getMessage());
            $data = ['visi' => 'Error', 'misi' => 'Error', 'nilai_inti' => [], 'sejarah' => []];
        }
        return $data;
    }

    // Mengambil Struktur Organisasi
    private function getStrukturOrganisasi() {
        try {
            $stmt = $this->conn->query("SELECT gambar_organisasi FROM struktur_organisasi LIMIT 1");
            return $stmt->fetch(PDO::FETCH_ASSOC)['gambar_organisasi'] ?? null;
        } catch (PDOException $e) {
            error_log("Error fetching Struktur Organisasi: " . $e->getMessage());
            return null;
        }
    }

    // Mengambil Dosen Laboratorium
    private function getDosen() {
        try {
            $stmt = $this->conn->query("SELECT nama, jabatan, gambar_tim, link_linkedin, link_instagram, link_github FROM dosen_multimedia ORDER BY id ASC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching Dosen: " . $e->getMessage());
            return [];
        }
    }

    // Mengambil Partner
    private function getPartner() {
        try {
            $stmt = $this->conn->query("SELECT nama_brand, nama_pt, gambar_brand FROM partner ORDER BY id ASC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching Partner: " . $e->getMessage());
            return [];
        }
    }

    // Metode utama untuk dipanggil Controller
    public function getAllData() {
        $data = $this->getAboutData();
        $data['organisasi'] = $this->getStrukturOrganisasi();
        $data['dosen'] = $this->getDosen();
        $data['partner'] = $this->getPartner();
        return $data;
    }
}
?>