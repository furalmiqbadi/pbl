<?php
session_start();

// Hapus semua sesi
session_unset();
session_destroy();

// Redirect ke halaman login
// Karena logout.php dan login.php ada di folder yang sama (view/), panggil langsung.
header("Location: login.php");
exit;
?>