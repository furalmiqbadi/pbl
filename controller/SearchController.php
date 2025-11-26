<?php
// controller/SearchController.php
require_once __DIR__ . '/../model/SearchModel.php';

class SearchController {
    private $model;

    public function __construct() {
        $this->model = new SearchModel();
    }

    public function index() {
        // 1. Ambil Keyword dari URL
        $keyword = $_GET['q'] ?? '';

        // 2. Minta data ke Model
        $results = $this->model->searchAll($keyword);

        // 3. Panggil View (search.php)
        // Path '../view/admin/search.php' karena controller ada di folder controller/
        include __DIR__ . '/../view/admin/search.php';
    }
}
?>