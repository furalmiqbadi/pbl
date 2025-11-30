<?php

require_once __DIR__ . '/../lib/Connection.php';

class Model {
    protected $db;

    public function __construct() {
        // Panggil koneksi dari class Connection
        $this->db = Connection::getConnection();
        
        // Cek jika koneksi gagal (null)
        if ($this->db === null) {
            echo "Gagal terhubung ke database!"; 
        }
    }
}