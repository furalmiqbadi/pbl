<?php
// FILE: pbl/controller/BackupController.php
require_once __DIR__ . '/../model/BackupModel.php';

class BackupController {
    private $model;

    public function __construct() {
        $this->model = new BackupModel();
    }

    public function index() {
        include __DIR__ . '/../view/admin/backup.php';
    }

    // Fungsi Konseptual Cloud Upload (Placeholder)
    public function uploadToGoogleDrive(string $filePath, string $fileName) : string {
        if (!file_exists($filePath)) {
            return "FAILED (Cloud): File sumber tidak ada.";
        }
        return "SUCCESS (Cloud): File siap diunggah ke Google Drive (Logic API diperlukan).";
    }

    // --- LOGIC: BACKUP (Lokal & Cloud) ---
        public function runBackup() {
        $paths = $this->model->getBackupFilePaths();
        $results = [];
        
        // --- Perbaikan di sini ---
        // HINDARI escapeshellarg() pada password jika password sederhana
        $dbPass = $paths['dbPass']; // TIDAK pakai escapeshellarg()
        
        $dbUser = escapeshellarg($paths['dbUser']); // Tetap pakai escapeshellarg()
        $dbName = escapeshellarg($paths['dbName']); // Tetap pakai escapeshellarg()
        $dbFile = escapeshellarg($paths['dbFile']); // Tetap pakai escapeshellarg()
        // --- Akhir Perbaikan ---
        
        // 1. BACKUP DATABASE (pg_dump) - Disesuaikan untuk Windows (CMD)
        // Perhatikan $dbPass TIDAK menggunakan quote
        $cmdDb = sprintf(
            'set PGPASSWORD=%s && pg_dump -h localhost -p 5432 -U %s -d %s > %s',
            $dbPass,
            $dbUser,
            $dbName,
            $dbFile
        );

        $results['db'] = shell_exec($cmdDb . ' 2>&1');
        $results['db_status'] = file_exists($paths['dbFile']) && filesize($paths['dbFile']) > 0 ? 'SUCCESS' : 'FAILED: ' . $results['db'];

        
        // 2. BACKUP MEDIA FILES (ZipArchive)
        // Panggil metode baru dari model
        $mediaResult = $this->model->createZipArchive($paths['uploadDir'], $paths['mediaFile']);
        
        // Tentukan status dan pesan eror media
        if (strpos($mediaResult, 'SUCCESS') !== false) {
            $results['media_status'] = 'SUCCESS';
            $results['media'] = '';
        } else {
            // $mediaResult sudah berisi pesan FAILED yang detail dari Model
            $results['media_status'] = $mediaResult; 
            $results['media'] = $mediaResult;
        }

        
        // 3. CLOUD UPLOAD (Konsep/Placeholder)
        $cloudResult = "DB: " . $this->uploadToGoogleDrive($paths['dbFile'], basename($paths['dbFile']));
        
        // Media Cloud hanya jika media lokal sukses
        if ($results['media_status'] == 'SUCCESS') {
            $cloudResult .= " | Media: " . $this->uploadToGoogleDrive($paths['mediaFile'], basename($paths['mediaFile']));
        } else {
            $cloudResult .= " | Media: FAILED (Cloud): File sumber tidak ada.";
        }

        $results['cloud_status'] = $cloudResult;

        $_SESSION['backup_result'] = $results;
        header("Location: dashboard.php?page=backup");
        exit;
    }
    
    // --- LOGIC: RESTORE (Hanya dari Lokal) ---
    public function runRestore() {
        $backupFiles = glob($this->model::BACKUP_DIR . '/*.sql');
        
        if (empty($backupFiles)) {
            $_SESSION['restore_status'] = "FAILED: Tidak ada file backup lokal (.sql) ditemukan.";
            header("Location: dashboard.php?page=backup");
            exit;
        }

        // Ambil file SQL yang terakhir (backup terbaru)
        // ... (dalam fungsi runRestore)
        // ...
        $latestDbFile = end($backupFiles);
        $paths = $this->model->getBackupFilePaths();
        
        // --- Perbaikan di sini ---
        $dbPass = $paths['dbPass']; // TIDAK pakai escapeshellarg()
        // --- Akhir Perbaikan ---
        
        $dbUser = escapeshellarg($paths['dbUser']);
        $dbName = escapeshellarg($paths['dbName']);
        $latestDbFileEscaped = escapeshellarg($latestDbFile);
        
        // RESTORE DATABASE (psql) - Disesuaikan untuk Windows (CMD)
        $cmdRestore = sprintf(
            'set PGPASSWORD=%s && psql -h localhost -p 5432 -U %s -d %s < %s',
            $dbPass,
            $dbUser,
            $dbName,
            $latestDbFileEscaped
        );
        // ... (sisanya sama)
        
        $execRestore = shell_exec($cmdRestore . ' 2>&1');
        
        if (strpos($execRestore, 'ERROR') === false) {
            $_SESSION['restore_status'] = "SUCCESS: Database berhasil dipulihkan dari " . basename($latestDbFile);
        } else {
            $_SESSION['restore_status'] = "FAILED: Gagal memulihkan database. Periksa log atau izin DB. Pesan: " . $execRestore;
        }
        
        header("Location: dashboard.php?page=backup");
        exit;
    }
}
?>