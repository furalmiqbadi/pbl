<?php
// controller/AboutController.php

require_once __DIR__ . '/../model/AboutModel.php';
require_once __DIR__ . '/../lib/helpers.php'; 

class AboutController {
    private $model;

    public function __construct() {
        $this->model = new AboutModel();
    }

    public function index() {
        // 1. Ambil Semua Data dari Model
        $data = $this->model->getAllData();

        // 2. Panggil View
        include __DIR__ . '/../view/about.php'; 
    }

    public function detail() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: index.php?page=about");
            exit;
        }

        $dosen = $this->model->getDosenDetail($id);
        
        if (!$dosen) {
            echo "Data dosen tidak ditemukan.";
            exit;
        }

        include __DIR__ . '/../view/dosen_detail.php';
    }
}
?>