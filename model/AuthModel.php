<?php
// model/AuthModel.php
require_once __DIR__ . '/../lib/Connection.php';

class AuthModel {
    private ?PDO $db;

    public function __construct() {
        $this->db = Connection::getConnection();
    }

    public function checkLogin($username, $password) {
        if ($this->db === null) return false;

        try {
            // Ambil data user berdasarkan username
            $sql = "SELECT * FROM admin WHERE username = :username LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // --- BAGIAN INI YANG DIUBAH ---
            // Kita izinkan password biasa (123) ATAU password terenkripsi
            if ($user && ($password === $user['password'] || password_verify($password, $user['password']))) {
                return $user;
            }
            // -----------------------------

        } catch (PDOException $e) {
            return false;
        }

        return false;
    }
}
?>