<?php
require_once __DIR__ . '/../model/HomeModel.php';

class HomeController {
    private HomeModel $model;

    public function __construct() {
        $this->model = new HomeModel();
    }

    public function index(): array {
        return [
            'hero' => $this->model->getHero(),
            'fokus' => $this->model->getFokus(),
            'karya' => $this->model->getKarya(),
            'artikel' => $this->model->getArtikel(),
            'gallery' => $this->model->getGallery(),
        ];
    }
}
