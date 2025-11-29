<?php
$highlightId = $_GET['highlight_id'] ?? null;
$searchKeyword = $_GET['q'] ?? '';
?>

<div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Data Dosen & Staff</h1>
    </div>

    <div class="flex gap-3 w-full md:w-auto">
        <form action="dashboard.php" method="GET" class="relative w-full md:w-64">
            <input type="hidden" name="page" value="dosen">
            <input type="text" name="q" value="<?= htmlspecialchars($searchKeyword) ?>" placeholder="Cari Nama / NIDN..." 
                   class="pl-10 pr-4 py-2 rounded-lg border border-gray-200 w-full focus:outline-none focus:ring-2 focus:ring-orange-500 text-sm shadow-sm">
            <i class="fas fa-search absolute left-4 top-3 text-gray-400 text-xs"></i>
        </form>

        <a href="dashboard.php?page=tambah_dosen" class="bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700 transition shadow-lg flex items-center gap-2 font-medium whitespace-nowrap text-sm">
            <i class="fas fa-plus"></i> Tambah
        </a>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50 text-gray-600 uppercase text-[11px] font-bold tracking-wider border-b border-gray-200">
            <tr>
                <th class="px-6 py-3 w-20">Foto</th>
                <th class="px-4 py-3">Nama Dosen</th>
                <th class="px-4 py-3">NIDN</th>
                <th class="px-4 py-3">Jabatan</th>
                <th class="px-4 py-3 text-center">Sosial Media</th>
                <th class="px-4 py-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
            <?php if (!empty($dosen)): ?>
                <?php foreach ($dosen as $row): ?>
                    
                    <?php 
                        $isHighlighted = ($row['id'] == $highlightId) || !empty($searchKeyword);
                        $rowClass = $isHighlighted ? "bg-green-50 border-l-4 border-green-500" : "hover:bg-gray-50";
                        
                        $namaFile = $row['gambar_tim'];
                        $browserPath = "../../assets/images/uploads/" . $namaFile;
                        $serverPath = __DIR__ . '/../../assets/images/uploads/' . $namaFile;
                        
                        if (!empty($namaFile) && file_exists($serverPath) && $namaFile != 'default.png') {
                            $src = $browserPath;
                        } else {
                            $src = "https://ui-avatars.com/api/?name=" . urlencode($row['nama']) . "&background=random&color=fff&size=128";
                        }
                    ?>

                    <tr class="<?= $rowClass ?> transition duration-150" id="row-<?= $row['id'] ?>">
                        <td class="px-6 py-3">
                            <img src="<?= $src ?>" alt="Foto" class="w-12 h-12 min-w-[48px] min-h-[48px] rounded-full object-cover border border-gray-200 shadow-sm bg-white block">
                        </td>
                        
                        <td class="px-4 py-3">
                            <div class="font-bold text-gray-800 text-sm"><?= htmlspecialchars($row['nama']) ?></div>
                            <?php if($isHighlighted): ?>
                                <span class="text-[10px] bg-green-100 text-green-700 px-2 py-0.5 rounded-full font-bold mt-1 inline-block"><i class="fas fa-check"></i> Data Ditemukan.</span>
                            <?php endif; ?>
                        </td>

                        <td class="px-4 py-3">
                            <span class="font-mono text-xs text-gray-600 bg-gray-50 px-2 py-1 rounded border border-gray-200"><?= htmlspecialchars($row['nidn']) ?></span>
                        </td>

                        <td class="px-4 py-3 text-sm text-gray-600">
                            <?= htmlspecialchars($row['jabatan']) ?>
                        </td>

                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center gap-3">
                                <?php if(!empty($row['link_instagram'])): ?>
                                    <a href="<?= htmlspecialchars($row['link_instagram']) ?>" target="_blank" class="text-pink-500 hover:text-pink-700 text-base transition hover:scale-110"><i class="fab fa-instagram"></i></a>
                                <?php endif; ?>
                                <?php if(!empty($row['link_linkedin'])): ?>
                                    <a href="<?= htmlspecialchars($row['link_linkedin']) ?>" target="_blank" class="text-blue-600 hover:text-blue-800 text-base transition hover:scale-110"><i class="fab fa-linkedin"></i></a>
                                <?php endif; ?>
                                <?php if(!empty($row['link_github'])): ?>
                                    <a href="<?= htmlspecialchars($row['link_github']) ?>" target="_blank" class="text-gray-800 hover:text-black text-base transition hover:scale-110"><i class="fab fa-github"></i></a>
                                <?php endif; ?>
                                <?php if(empty($row['link_instagram']) && empty($row['link_linkedin']) && empty($row['link_github'])): ?>
                                    <span class="text-gray-300 text-xs">-</span>
                                <?php endif; ?>
                            </div>
                        </td>
                        
                        <td class="px-4 py-3 text-center space-x-1">
                            <a href="dashboard.php?page=edit_dosen&id=<?= $row['id'] ?>" class="text-blue-600 hover:bg-blue-50 px-3 py-1 rounded text-xs font-semibold transition">Edit</a>
                            <a href="dashboard.php?page=hapus_dosen&id=<?= $row['id'] ?>" onclick="return confirm('Hapus?')" class="text-red-600 hover:bg-red-50 px-3 py-1 rounded text-xs font-semibold transition">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="px-6 py-10 text-center text-gray-400">
                        <i class="fas fa-search text-2xl mb-2 text-gray-300"></i><br>Data tidak ditemukan.
                        <?php if(!empty($searchKeyword)): ?><br><a href="dashboard.php?page=dosen" class="text-orange-500 hover:underline text-xs">Reset</a><?php endif; ?>
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
            target.style.backgroundColor = "#dcfce7"; 
        }
    });
</script>
<?php endif; ?>