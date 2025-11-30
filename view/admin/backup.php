<div class="max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Modul Backup & Pemulihan</h1>
    
    <?php 
    $results = $_SESSION['backup_result'] ?? null;
    $restoreStatus = $_SESSION['restore_status'] ?? null;
    unset($_SESSION['backup_result']);
    unset($_SESSION['restore_status']);
    
    // Notifikasi status pemulihan
    if ($restoreStatus): 
    ?>
        <div class="p-4 rounded-xl <?= strpos($restoreStatus, 'SUCCESS') !== false ? 'bg-green-100 text-green-800 border-green-200' : 'bg-red-100 text-red-800 border-red-200' ?> mb-6 border">
            <h3 class="font-bold text-lg mb-2">Status Pemulihan:</h3>
            <p><?= $restoreStatus ?></p>
        </div>
    <?php endif; ?>

    <?php if ($results): ?>
        <div class="p-4 rounded-xl bg-green-100 text-green-800 mb-6 border border-green-200">
            <h3 class="font-bold text-lg mb-2">Proses Cadangan Selesai!</h3>
            <p>Database Status (Lokal): <strong><?= $results['db_status'] ?></strong></p>
            <p>Media Status (Lokal): <strong><?= $results['media_status'] ?></strong></p>
            <p class="text-sm mt-2 font-bold">Cloud Status: <?= $results['cloud_status'] ?></p>
        </div>
    <?php endif; ?>

    <div class="space-y-8">
        
        <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 flex flex-col sm:flex-row items-start sm:items-center justify-between transition duration-300 hover:shadow-xl">
            <div class="flex items-start gap-6 mb-4 sm:mb-0">
                <i class="fas fa-cloud-upload-alt text-5xl text-orange-600 flex-shrink-0"></i>
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Pencadangan (Lokal & Cloud)</h2>
                    <p class="text-gray-600 text-sm mt-1 max-w-lg">Mengambil salinan database (.sql) dan file media (.zip), lalu menyimpannya di **Lokal** dan di **Google Drive**.</p>
                </div>
            </div>
            <a href="dashboard.php?page=run_backup" 
               onclick="if(!confirm('Proses ini akan memakan waktu. Lanjutkan backup?')) return false;"
               class="bg-orange-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-orange-700 transition shadow-lg flex items-center gap-2 whitespace-nowrap w-full sm:w-auto justify-center">
                <i class="fas fa-save"></i> Cadangkan Sekarang
            </a>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 flex flex-col sm:flex-row items-start sm:items-center justify-between transition duration-300 hover:shadow-xl">
            <div class="flex items-start gap-6 mb-4 sm:mb-0">
                <i class="fas fa-redo-alt text-5xl text-red-600 flex-shrink-0"></i>
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Pemulihan (Restore dari Lokal)</h2>
                    <p class="text-gray-600 text-sm mt-1 max-w-lg">Memulihkan DB dari file backup **terbaru** yang tersimpan di folder `temp/backups/` Anda.</p>
                </div>
            </div>
            <a href="dashboard.php?page=restore_data" 
               onclick="return confirm('PERINGATAN KERAS! Tindakan ini akan MENGHAPUS SEMUA DATA BARU. Yakin melanjutkan pemulihan?')"
               class="bg-red-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-red-700 transition shadow-lg flex items-center gap-2 whitespace-nowrap w-full sm:w-auto justify-center">
                <i class="fas fa-undo"></i> Restore Data
            </a>
        </div>
        
        <div class="pt-6 border-t border-gray-200">
             <h3 class="text-lg font-bold text-gray-800 mb-3">Otomatisasi Harian</h3>
             <p class="text-sm text-gray-600">Untuk backup otomatis harian, Anda perlu mengatur **Cron Job** (di Linux) atau **Task Scheduler** (di Windows) untuk menjalankan skrip PHP CLI (`cron_backup.php`).</p>
        </div>

    </div>
</div>