<?php
require_once __DIR__ . '/../model/KaryaModel.php';

class KatalogController {
    private $model;

    public function __construct() {
        $this->model = new KaryaModel();
    }

    public function index() {
        $karya = $this->model->getAllWithKategori();
        $kategori_list = $this->model->getKategoriFilter();

        include __DIR__ . '/../view/catalog.php';
    }
}