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

    // --- LOGIC: BACKUP (HANYA Lokal) ---
    public function runBackup() {
        $paths = $this->model->getBackupFilePaths();
        $results = [];
        
        // --- DB Config ---
        $dbPass = $paths['dbPass'];
        $dbUser = escapeshellarg($paths['dbUser']);
        $dbName = escapeshellarg($paths['dbName']);
        $dbFile = escapeshellarg($paths['dbFile']);
        // --- Akhir Config ---
        
        // 1. BACKUP DATABASE (pg_dump)
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
        $mediaResult = $this->model->createZipArchive($paths['uploadDir'], $paths['mediaFile']);
        
        if (strpos($mediaResult, 'SUCCESS') !== false) {
            $results['media_status'] = 'SUCCESS';
            $results['media'] = '';
        } else {
            $results['media_status'] = $mediaResult; 
            $results['media'] = $mediaResult;
        }

        $_SESSION['backup_result'] = $results;
        header("Location: dashboard.php?page=backup");
        exit;
    }
    
    // --- LOGIC: RESTORE (Database & Media) ---
    public function runRestore() {
        $paths = $this->model->getBackupFilePaths();
        $backupSqlFiles = glob($this->model::BACKUP_DIR . '/*.sql');
        $restoreMessages = [];
        
        // --- 1. Cek & Temukan File SQL Terbaru ---
        if (empty($backupSqlFiles)) {
            $_SESSION['restore_status'] = "FAILED: Tidak ada file backup lokal (.sql) ditemukan. Pemulihan Gagal.";
            header("Location: dashboard.php?page=backup");
            exit;
        }

        $latestDbFile = end($backupSqlFiles);
        $timestamp = basename($latestDbFile, '.sql');
        
        // --- DB Config ---
        $dbPass = $paths['dbPass']; 
        $dbUser = escapeshellarg($paths['dbUser']);
        $dbName = escapeshellarg($paths['dbName']);
        $latestDbFileEscaped = escapeshellarg($latestDbFile);
        
        // --- 2-4. DROP, CREATE, RESTORE DB (TIDAK DIUBAH) ---
        
        // 2. DROPDB
        $cmdDropDb = sprintf('set PGPASSWORD=%s && dropdb -f -U %s %s', $dbPass, $dbUser, $dbName);
        $execDropDb = shell_exec($cmdDropDb . ' 2>&1');
        
        // 3. CREATEDB
        $cmdCreateDb = sprintf('set PGPASSWORD=%s && createdb -U %s %s', $dbPass, $dbUser, $dbName);
        $execCreateDb = shell_exec($cmdCreateDb . ' 2>&1');

        if (strpos($execCreateDb, 'ERROR') !== false) {
             $restoreMessages[] = "DB: FAILED. Gagal membuat database baru. Pesan: " . $execCreateDb;
             $_SESSION['restore_status'] = implode(' | ', $restoreMessages);
             header("Location: dashboard.php?page=backup");
             exit;
        }
        
        // 4. RESTORE DATA (psql)
        $cmdRestoreData = sprintf(
            'set PGPASSWORD=%s && psql -h localhost -p 5432 -U %s -d %s < %s',
            $dbPass, $dbUser, $dbName, $latestDbFileEscaped
        );
        $execRestoreData = shell_exec($cmdRestoreData . ' 2>&1');
        
        if (strpos($execRestoreData, 'ERROR') === false) {
            $restoreMessages[] = "DB: SUCCESS. Database berhasil dipulihkan.";
        } else {
            $restoreMessages[] = "DB: FAILED. Gagal memuat data. Pesan: " . $execRestoreData;
        }
        
        // --- 5. RESTORE MEDIA FILES (.zip) ---
        
        // CARI FILE ZIP PALING BARU SECARA INDEPENDEN
        $backupZipFiles = glob($this->model::BACKUP_DIR . '/*.zip');
        
        if (empty($backupZipFiles)) {
            $restoreMessages[] = "Media: SKIP. Tidak ada file ZIP media ditemukan.";
        } else {
            $latestMediaFile = end($backupZipFiles); 
            
            if (file_exists($latestMediaFile)) {
                $zip = new \ZipArchive;
                
                if ($zip->open($latestMediaFile) === TRUE) {
                    // Panggil fungsi cleanDirectory di Model sebelum ekstraksi
                    // Ini membersihkan assets/images/
                    $this->model->cleanDirectory($paths['uploadDir']); 
                    
                    // EKSTRAKSI KE FOLDER assets/ BUKAN assets/images/
                    $zip->extractTo($paths['assetsDir']); // <--- KOREKSI INI
                    $zip->close();
                    
                    $restoreMessages[] = "Media: SUCCESS. File media berhasil diekstrak dari " . basename($latestMediaFile);
                } else {
                    $restoreMessages[] = "Media: FAILED. Tidak dapat membuka file ZIP media: " . basename($latestMediaFile);
                }
            } else {
                $restoreMessages[] = "Media: SKIP. File ZIP media tidak dapat diakses.";
            }
        }


        $_SESSION['restore_status'] = implode(' | ', $restoreMessages);
        header("Location: dashboard.php?page=backup");
        exit;
    }
}