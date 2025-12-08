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
}
?>