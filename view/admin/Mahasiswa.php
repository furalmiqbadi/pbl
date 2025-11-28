<?php
// view/admin/mahasiswa.php

// 1. TANGKAP ID UNTUK HIGHLIGHT
// Jika ada parameter highlight_id di URL, simpan ke variabel
$highlightId = $_GET['highlight_id'] ?? null;
?>

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Data Mahasiswa</h1>
    <a href="dashboard.php?page=tambah_mahasiswa" class="bg-orange-600 text-white px-5 py-2.5 rounded-xl hover:bg-orange-700 transition shadow-lg hover:shadow-orange-500/30 font-medium flex items-center gap-2">
        <i class="fas fa-plus"></i> Tambah Mahasiswa
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-bold tracking-wider">
            <tr>
                <th class="px-6 py-4">No</th>
                <th class="px-6 py-4">NIM</th>
                <th class="px-6 py-4">Nama Mahasiswa</th>
                <th class="px-6 py-4">Program Studi</th>
                <th class="px-6 py-4 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
            <?php if (!empty($mahasiswa)): ?>
                <?php $no = 1; foreach ($mahasiswa as $row): ?>
                
                <?php 
                    // --- LOGIKA WARNA (HIGHLIGHT HIJAU) ---
                    // Jika ID baris ini sama dengan ID yang dicari:
                    // - bg-green-50: Background Hijau Muda Transparan
                    // - border-l-4 border-green-500: Garis hijau tebal di kiri
                    $rowClass = ($row['id'] == $highlightId) 
                        ? "bg-green-200 border-l-4 border-green-500 transition-colors duration-1000 ease-in-out" 
                        : "hover:bg-gray-50 transition duration-150";
                ?>

                <tr class="<?= $rowClass ?>" id="row-<?= $row['id'] ?>">
                    
                    <td class="px-6 py-4 font-medium text-gray-500"><?= $no++ ?></td>
                    
                    <td class="px-6 py-4">
                        <span class="font-mono text-orange-600 font-semibold bg-orange-50 rounded px-2 py-1 border border-orange-200">
                            <?= htmlspecialchars($row['nim']) ?>
                        </span>
                    </td>
                    
                    <td class="px-6 py-4 font-semibold text-gray-800">
                        <?= htmlspecialchars($row['nama']) ?>
                        
                        <?php if($row['id'] == $highlightId): ?>
                            <span class="ml-2 text-[10px] bg-green-100 text-green-700 border border-green-200 px-2 py-0.5 rounded-full font-bold animate-pulse">
                                <i class="fas fa-check mr-1"></i> Hasil Pencarian
                            </span>
                        <?php endif; ?>
                    </td>
                    
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-600 border border-blue-100">
                            <?= htmlspecialchars($row['nama_prodi'] ?? '-') ?>
                        </span>
                    </td>
                    
                    <td class="px-6 py-4 text-center space-x-3">
                        <a href="dashboard.php?page=edit_mahasiswa&id=<?= $row['id'] ?>" class="text-blue-500 hover:text-blue-700 font-medium transition text-xs bg-blue-50 px-3 py-1.5 rounded-lg hover:bg-blue-100">Edit</a>
                        <a href="dashboard.php?page=hapus_mahasiswa&id=<?= $row['id'] ?>" class="text-red-500 hover:text-red-700 font-medium transition text-xs bg-red-50 px-3 py-1.5 rounded-lg hover:bg-red-100" onclick="return confirm('Yakin ingin menghapus data <?= $row['nama'] ?>?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-gray-400">
                        <div class="flex flex-col items-center justify-center">
                            <i class="fas fa-user-graduate text-4xl mb-3 text-gray-200"></i>
                            <p>Belum ada data mahasiswa.</p>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php if ($highlightId): ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Cari baris dengan ID yang sesuai
        const targetRow = document.getElementById("row-<?= $highlightId ?>");
        
        if (targetRow) {
            // 1. Scroll browser ke baris tersebut dengan efek halus
            targetRow.scrollIntoView({ behavior: "smooth", block: "center" });
            
            // 2. Efek Kedip Hijau (Opsional, biar makin kelihatan)
            // Menggunakan warna #f0fdf4 (Green-50 Tailwind)
            targetRow.style.backgroundColor = "#bbf7d0"; 
        }
    });
</script>
<?php endif; ?>