<?php
// view/admin/mahasiswa.php

// TANGKAP ID & KEYWORD
$highlightId = $_GET['highlight_id'] ?? null;
$searchKeyword = $_GET['q'] ?? '';
?>

<div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Data Mahasiswa</h1>
        <p class="text-sm text-gray-500">Kelola data mahasiswa aktif Lab MMT</p>
    </div>

    <div class="flex gap-3 w-full md:w-auto">
        <form action="dashboard.php" method="GET" class="relative w-full md:w-64">
            <input type="hidden" name="page" value="mahasiswa">
            <input type="text" name="q" value="<?= htmlspecialchars($searchKeyword) ?>" placeholder="Cari Nama / NIM..." 
                   class="pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 w-full focus:outline-none focus:ring-2 focus:ring-orange-500 text-sm shadow-sm transition-all">
            <i class="fas fa-search absolute left-4 top-3.5 text-gray-400 text-xs"></i>
        </form>

        <a href="dashboard.php?page=tambah_mahasiswa" class="bg-orange-600 text-white px-5 py-2.5 rounded-xl hover:bg-orange-700 transition shadow-lg hover:shadow-orange-500/30 font-medium flex items-center gap-2 whitespace-nowrap">
            <i class="fas fa-plus"></i> <span class="hidden md:inline">Tambah</span>
        </a>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-bold tracking-wider">
            <tr>
                <th class="px-8 py-5 w-20">No</th>
                <th class="px-6 py-5">NIM</th>
                <th class="px-6 py-5">Nama Mahasiswa</th>
                <th class="px-6 py-5">Program Studi</th>
                <th class="px-6 py-5 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
            <?php if (!empty($mahasiswa)): ?>
                <?php $no = 1; foreach ($mahasiswa as $row): ?>
                
                <?php 
                    // --- LOGIKA HIGHLIGHT ---
                    // Highlight jika ID cocok ATAU ada Search Keyword
                    $isHighlighted = ($row['id'] == $highlightId) || !empty($searchKeyword);

                    $rowClass = $isHighlighted
                        ? "bg-green-100 border-l-4 border-green-500 transition-colors duration-1000 ease-in-out" 
                        : "hover:bg-gray-50 transition duration-150";
                ?>

                <tr class="<?= $rowClass ?>" id="row-<?= $row['id'] ?>">
                    
                    <td class="px-8 py-4 font-medium text-gray-400"><?= $no++ ?></td>
                    
                    <td class="px-6 py-4">
                        <span class="font-mono text-xs text-gray-600 bg-gray-100 px-2 py-1 rounded border border-gray-200 font-bold tracking-wide">
                            <?= htmlspecialchars($row['nim']) ?>
                        </span>
                    </td>
                    
                    <td class="px-6 py-4">
                        <div class="font-bold text-gray-800 text-base"><?= htmlspecialchars($row['nama']) ?></div>
                        
                        <?php if($isHighlighted): ?>
                            <span class="text-[10px] bg-green-100 text-green-700 border border-green-200 px-2 py-0.5 rounded-full font-bold mt-1 inline-block">
                                <i class="fas fa-check mr-1"></i> Data Ditemukan.
                            </span>
                        <?php endif; ?>
                    </td>
                    
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-600 border border-blue-100">
                            <?= htmlspecialchars($row['nama_prodi'] ?? '-') ?>
                        </span>
                    </td>
                    
                    <td class="px-6 py-4 text-center space-x-2">
                        <a href="dashboard.php?page=edit_mahasiswa&id=<?= $row['id'] ?>" class="text-blue-600 hover:text-blue-800 font-medium text-xs bg-blue-50 px-4 py-2 rounded-lg hover:bg-blue-100 transition">Edit</a>
                        <a href="dashboard.php?page=hapus_mahasiswa&id=<?= $row['id'] ?>" class="text-red-600 hover:text-red-800 font-medium text-xs bg-red-50 px-4 py-2 rounded-lg hover:bg-red-100 transition" onclick="return confirm('Yakin ingin menghapus data <?= $row['nama'] ?>?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                        <div class="flex flex-col items-center justify-center">
                            <i class="fas fa-user-graduate text-4xl mb-3 text-gray-200"></i>
                            <p>Belum ada data mahasiswa.</p>
                            <?php if(!empty($searchKeyword)): ?>
                                <a href="dashboard.php?page=mahasiswa" class="text-orange-500 hover:underline mt-2 text-sm font-semibold">Reset Pencarian</a>
                            <?php endif; ?>
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
        const target = document.getElementById("row-<?= $highlightId ?>");
        if (target) {
            target.scrollIntoView({ behavior: "smooth", block: "center" });
            target.style.backgroundColor = "#dcfce7"; // Warna hijau muda
        }
    });
</script>
<?php endif; ?>