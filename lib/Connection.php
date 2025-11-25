<?php
class Connection {
    private static $instance = null;

    public static function getConnection() {
        if (self::$instance === null) {

            $host = 'localhost';        
            $port = '5432';
            $dbname = 'pbl';       
            $user = 'postgres';        
            $password = '123';         

            $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";

            try {
                self::$instance = new PDO($dsn, $user, $password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);

                // 🔥 Pesan berhasil (hanya muncul saat koneksi pertama kali dibuat)
                echo "<p style='color: green; font-weight: bold;'>Koneksi ke database berhasil!</p>";

            } catch (PDOException $e) {
                die("Database connection error: " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}
