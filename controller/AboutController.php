<?php
// File: controller/AboutController.php

// Path relatif dari controller ke model
require_once '../model/AboutModel.php'; 

class AboutController {

    public function index() {
        // WAJIB: Inisialisasi $data di awal. 
        // Ini MENCEGAH error "Undefined variable $data" jika Model gagal.
        $data = [
            'visi' => 'Error', 
            'misi' => 'Error', 
            'nilai_inti' => [], 
            'sejarah' => [], 
            'organisasi' => null, 
            'dosen' => [], 
            'partner' => []
        ];
        
        try {
            // Inisialisasi Model, yang akan otomatis memanggil koneksi
            $model = new AboutModel();
            
            // Ambil semua data
            $data = $model->getAllData(); 
            
        } catch (Exception $e) {
            // Jika ada kegagalan fatal (mis. class Connection tidak ditemukan)
            error_log("Controller error fatal: " . $e->getMessage());
            // $data tetap berisi array default yang aman
        }

        // Muat View dan kirim variabel $data
        // Path relatif dari controller ke view
        include '../view/about.php'; 
    }
}

// Cara penggunaan (Contoh di index.php atau router):
// $controller = new AboutController();
// $controller->index();
?>