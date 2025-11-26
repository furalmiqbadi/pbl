<?php

require_once '../model/GaleriModel.php';

class GaleriController {

    public function index() {
        $model = new GaleriModel();
        $data = $model->getAll();

        include '../view/gallery.php';
    }
}
