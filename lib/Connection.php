<?php
class Connection {
    private static $instance = null;

    public static function getConnection(): ?PDO {
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
            } catch (PDOException $e) {
                // Kembalikan null supaya aplikasi bisa jatuh ke data dummy jika DB tidak tersedia
                return null;
            }
        }

        return self::$instance;
    }
}
