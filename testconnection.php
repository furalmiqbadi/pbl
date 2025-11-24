<?php

error_reporting(E_ALL);

require_once __DIR__ . '/lib/Connection.php'; 
echo "<h3>Memulai test koneksi...</h3>";

try {
    $db = Connection::getConnection(); 
    $stmt = $db->query("SELECT 1 AS ok");
    $row = $stmt->fetch();
    if ($row && isset($row['ok'])) {
        echo "<p style='color:green'>Koneksi ke database berhasil! (SELECT 1 = {$row['ok']})</p>";
    } else {
        echo "<p style='color:orange'>Koneksi dibuat tapi SELECT 1 tidak mengembalikan hasil yang diharapkan.</p>";
    }
} catch (Exception $e) {
    echo "<p style='color:red'>Exception: " . htmlspecialchars($e->getMessage()) . "</p>";
}

echo "<p>PHP SAPI: " . php_sapi_name() . "</p>";
