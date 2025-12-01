<?php
// FILE: pbl/model/BackupModel.php
require_once __DIR__ . '/../lib/Connection.php';

class BackupModel {
    // POSTGRESQL
    const DB_NAME = 'pbl'; 
    const DB_USER = 'postgres';
    const DB_PASS = '123'; 
    // ===================================================
    
    // UPLOAD_DIR: target folder 'assets/images' secara keseluruhan
    const UPLOAD_DIR = __DIR__ . '/../assets/images'; 
    const BACKUP_DIR = __DIR__ . '/../temp/backups';

    public function getBackupFilePaths(): array {
        $timestamp = date('Ymd_His');
        $dbFile = self::BACKUP_DIR . "/db_backup_{$timestamp}.sql";
        $mediaFile = self::BACKUP_DIR . "/media_backup_{$timestamp}.zip";

        if (!is_dir(self::BACKUP_DIR)) {
            mkdir(self::BACKUP_DIR, 0777, true);
        }

        return [
            'dbName' => self::DB_NAME,
            'dbUser' => self::DB_USER,
            'dbPass' => self::DB_PASS,
            'dbFile' => $dbFile,
            'mediaFile' => $mediaFile,
            'uploadDir' => self::UPLOAD_DIR,
            'timestamp' => $timestamp
        ];
    }
        public function createZipArchive(string $sourceDir, string $outputFile) : string {
                if (!extension_loaded('zip')) {
                    return "FAILED: Ekstensi ZipArchive PHP tidak aktif. (Aktifkan extension=zip di php.ini)";
                }
                
                if (!is_dir($sourceDir)) {
                    return "SUCCESS (Empty): Direktori sumber media tidak ditemukan.";
                }

                $zip = new \ZipArchive();
                $outputFileNormalized = str_replace('\\', '/', $outputFile);

                if ($zip->open($outputFileNormalized, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== TRUE) {
                    return "FAILED: Gagal membuka file ZIP di '{$outputFileNormalized}'. Pastikan file tidak terkunci oleh program lain."; 
                }
                
                // --- PERBAIKAN AKHIR PATH RELATIF YANG STABIL ---
                
                // 1. Tentukan path yang HARUS DIHAPUS: Path sampai sebelum folder 'images' (yaitu sampai '/assets/')
                $basePath = dirname($sourceDir); 
                $basePathToRemove = str_replace('\\', '/', $basePath) . '/'; // Contoh: C:/laragon/www/pbl/assets/
                
                // 2. Hitung panjang path yang akan dihapus (tanpa kompensasi awal)
                $sourceDirLength = strlen($basePathToRemove); 
                
                // 3. Tentukan NAMA FOLDER ROOT yang dipertahankan
                $rootFolderName = basename($sourceDir); // Ini adalah 'images'
                
                // --- AKHIR PERBAIKAN PATH RELATIF ---

                try {
                    $iterator = new \RecursiveIteratorIterator(
                        new \RecursiveDirectoryIterator($sourceDir, \FilesystemIterator::SKIP_DOTS),
                        \RecursiveIteratorIterator::SELF_FIRST
                    );
                    
                    // Tambahkan folder 'images' sebagai folder root eksplisit di ZIP
                    $zip->addEmptyDir($rootFolderName);

                    foreach ($iterator as $fileInfo) {
                        if (!$fileInfo->isReadable()) {
                            continue; 
                        }

                        $filePath = $fileInfo->getRealPath();
                        $filePathNormalized = str_replace('\\', '/', $filePath);
                        
                        // Mendapatkan path relatif dengan memotong $sourceDirLength.
                        // KUNCI: Tambahkan OFFSET +2 untuk memperbaiki pemotongan di Windows.
                        $relativePath = substr($filePathNormalized, $sourceDirLength - 2); // OFFSET +2
                        
                        // Jika path relatif tidak dimulai dengan 'images/', tambahkan prefix.
                        if (strpos($relativePath, $rootFolderName . '/') !== 0) {
                            $relativePath = $rootFolderName . '/' . $relativePath;
                        }
                        
                        // Normalisasi akhir untuk mencegah double slash
                        $relativePath = str_replace('//', '/', $relativePath);


                        if ($fileInfo->isFile()) {
                            if ($zip->addFile($filePath, $relativePath) === FALSE) {
                                throw new \Exception("Gagal menambahkan file '{$relativePath}'");
                            }
                        } elseif ($fileInfo->isDir() && $fileInfo->getFilename() !== '.' && $fileInfo->getFilename() !== '..') {
                            $zip->addEmptyDir($relativePath);
                        }
                    }
                    
                } catch (\Exception $e) {
                    $zip->close(); 
                    return "FAILED: Error saat iterasi file. Pesan: " . $e->getMessage();
                }
                
                $zip->close(); 

                return file_exists($outputFile) && filesize($outputFile) > 0 ? 'SUCCESS' : 'FAILED: Ukuran file zip nol atau gagal ditutup.';
            }
        }