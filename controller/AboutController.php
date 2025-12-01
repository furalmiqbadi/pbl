<?php

require_once __DIR__ . '/../model/AboutModel.php'; 

class AboutController {

    public function index() {
        $data = [
            'visi' => '-', 
            'misi' => '-', 
            'nilai_inti' => [], 
            'sejarah' => [], 
            'organisasi' => null, 
            'dosen' => [], 
            'partner' => []
        ];
        
        try {
            $model = new AboutModel();
            $data = $model->getAllData();
            
        } catch (Exception $e) {
            error_log("Controller Error: " . $e->getMessage());
        }

        include __DIR__ . '/../view/about.php'; 
    }
}
?>