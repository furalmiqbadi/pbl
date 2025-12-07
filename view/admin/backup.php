<div class="max-w-4xl mx-auto">
    
    <h1 class="text-3xl font-extrabold text-gray-800 mb-2">
        Modul Backup & Pemulihan
    </h1> 
    <p class="text-gray-600 text-lg mb-8">
        Kelola pencadangan database (.sql) dan file media (.zip) serta pemulihan data lokal.
    </p>
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
            <p>Database Status: <strong><?= $results['db_status'] ?></strong></p>
            <p>Media Status: <strong><?= $results['media_status'] ?></strong></p>
        </div>
    <?php endif; ?>

    <div class="space-y-8">
        
        <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 flex flex-col sm:flex-row items-start sm:items-center justify-between transition duration-300 hover:shadow-xl">
            <div class="flex items-start gap-6 mb-4 sm:mb-0">
                <i class="fas fa-database text-5xl text-orange-600 flex-shrink-0"></i>
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Pencadangan (Lokal)</h2>
                    <p class="text-gray-600 text-sm mt-1 max-w-lg">Mengambil salinan database (.sql) dan file media (.zip), lalu menyimpannya di folder `temp/backups`.</p>
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
                    <p class="text-gray-600 text-sm mt-1 max-w-lg">Memulihkan DB dan Media dari file backup terbaru yang tersimpan di folder `temp/backups/` Anda.</p>
                </div>
            </div>
            <a href="dashboard.php?page=restore_data" 
                onclick="return confirm('PERINGATAN KERAS! Tindakan ini akan MENGHAPUS SEMUA DATA BARU. Yakin melanjutkan pemulihan?')"
                class="bg-red-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-red-700 transition shadow-lg flex items-center gap-2 whitespace-nowrap w-full sm:w-auto justify-center">
                <i class="fas fa-undo"></i> Restore Data
            </a>
        </div>
        
    </div>
</div>  