<?php
$highlightId = $_GET['highlight_id'] ?? null;
$searchKeyword = $_GET['q'] ?? '';
?>

<div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
            <span class="w-3 h-8 bg-gradient-to-b from-rose-400 to-red-600 rounded-full"></span>
            Data Dosen & Staff
        </h1>
        <p class="text-gray-500 text-sm mt-2 ml-6">Manajemen pengajar dan staff laboratorium.</p>
    </div>

    <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
        <form action="dashboard.php" method="GET" class="relative w-full sm:w-64 group">
            <input type="hidden" name="page" value="dosen">
            <input type="text" name="q" value="<?= htmlspecialchars($searchKeyword) ?>" placeholder="Cari Nama / NIDN..." 
                   class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 bg-white focus:outline-none focus:ring-4 focus:ring-rose-500/10 focus:border-rose-400 transition shadow-sm font-medium text-gray-700">
            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-gray-400 group-focus-within:text-rose-500 transition-colors">
                <i class="fas fa-search"></i>
            </div>
        </form>

        <a href="dashboard.php?page=tambah_dosen" 
           class="group bg-gradient-to-r from-rose-500 to-red-600 text-white px-6 py-3 rounded-xl hover:shadow-lg hover:shadow-rose-500/30 hover:-translate-y-1 transition-all duration-300 font-bold flex items-center justify-center gap-3 whitespace-nowrap">
            <div class="bg-white/20 p-1 rounded-lg group-hover:rotate-90 transition duration-300">
                <i class="fas fa-plus text-xs"></i>
            </div>
            <span>Tambah</span>
        </a>
    </div>
</div>

<div class="bg-white rounded-[2rem] shadow-xl shadow-gray-100/50 border border-gray-100 overflow-hidden relative">
    
    <div class="absolute top-0 right-0 w-32 h-32 bg-rose-50 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2 opacity-60 pointer-events-none"></div>

    <div class="overflow-x-auto relative z-10">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50/80 text-gray-500 uppercase text-xs font-extrabold tracking-wider border-b border-gray-100">
                <tr>
                    <th class="px-6 py-5 w-20 text-center">Foto</th>
                    <th class="px-6 py-5">Nama Dosen</th>
                    <th class="px-6 py-5">NIDN</th>
                    <th class="px-6 py-5">Jabatan</th>
                    <th class="px-6 py-5 text-center">Sosial Media</th>
                    <th class="px-6 py-5 w-32 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 text-sm text-gray-700">
                <?php if (!empty($dosen)): ?>
                    <?php foreach ($dosen as $row): ?>
                    
                    <?php 
                        $isHighlighted = ($row['id'] == $highlightId) || !empty($searchKeyword);
                        $rowClass = $isHighlighted ? "bg-rose-50/60" : "hover:bg-rose-50/20";
                        
                        $namaFile = $row['gambar_tim'];
                        $path = "../../assets/images/uploads/" . $namaFile;
                        $src = (!empty($namaFile) && $namaFile != 'default.png') ? $path : "https://ui-avatars.com/api/?name=" . urlencode($row['nama']) . "&background=random&color=fff";
                    ?>

                    <tr class="<?= $rowClass ?> transition duration-300 group" id="row-<?= $row['id'] ?>">
                        <td class="px-6 py-5 text-center">
                            <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-white shadow-sm mx-auto group-hover:scale-110 transition duration-300 group-hover:border-rose-200">
                                <img src="<?= $src ?>" alt="Foto" class="w-full h-full object-cover">
                            </div>
                        </td>
                        
                        <td class="px-6 py-5">
                            <div class="font-bold text-gray-800 text-base group-hover:text-rose-700 transition">
                                <?= htmlspecialchars($row['nama']) ?>
                            </div>
                            <?php if($isHighlighted): ?>
                                <span class="text-[10px] bg-green-100 text-green-700 px-2 py-0.5 rounded-full font-bold mt-1 inline-block"><i class="fas fa-check"></i> Ditemukan</span>
                            <?php endif; ?>
                        </td>

                        <td class="px-6 py-5">
                            <span class="font-mono text-xs text-gray-600 bg-gray-100 px-2 py-1 rounded border border-gray-200">
                                <?= htmlspecialchars($row['nidn']) ?>
                            </span>
                        </td>

                        <td class="px-6 py-5 text-sm text-gray-600">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-semibold bg-gray-50 text-gray-600 border border-gray-200">
                                <?= htmlspecialchars($row['jabatan']) ?>
                            </span>
                        </td>

                        <td class="px-6 py-5 text-center">
                            <div class="flex justify-center gap-3">
                                
                                <?php if(!empty($row['link_instagram'])): ?>
                                    <a href="<?= htmlspecialchars($row['link_instagram']) ?>" target="_blank" 
                                    class="text-pink-500 hover:text-pink-600 transition hover:scale-110">
                                    <i class="fab fa-instagram text-lg"></i>
                                    </a>
                                <?php endif; ?>

                                <?php if(!empty($row['link_linkedin'])): ?>
                                    <a href="<?= htmlspecialchars($row['link_linkedin']) ?>" target="_blank" 
                                    class="text-blue-600 hover:text-blue-700 transition hover:scale-110">
                                    <i class="fab fa-linkedin text-lg"></i>
                                    </a>
                                <?php endif; ?>

                                <?php if(!empty($row['link_github'])): ?>
                                    <a href="<?= htmlspecialchars($row['link_github']) ?>" target="_blank" 
                                    class="text-gray-900 hover:text-black transition hover:scale-110">
                                    <i class="fab fa-github text-lg"></i>
                                    </a>
                                <?php endif; ?>

                            </div>
                        </td>
                        
                        <td class="px-6 py-5 text-center">
                            <div class="flex justify-center gap-2 opacity-90 group-hover:opacity-100 transition">
                                <a href="dashboard.php?page=edit_dosen&id=<?= $row['id'] ?>" class="w-9 h-9 flex items-center justify-center rounded-xl bg-white border border-gray-200 text-blue-500 hover:bg-blue-50 hover:border-blue-200 transition shadow-sm">
                                    <i class="fas fa-pen text-xs"></i>
                                </a>
                                <a href="dashboard.php?page=hapus_dosen&id=<?= $row['id'] ?>" onclick="return confirm('Hapus?')" class="w-9 h-9 flex items-center justify-center rounded-xl bg-white border border-gray-200 text-red-500 hover:bg-red-50 hover:border-red-200 transition shadow-sm">
                                    <i class="fas fa-trash text-xs"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-20 h-20 bg-rose-50 rounded-full flex items-center justify-center mb-4 animate-pulse">
                                    <i class="fas fa-chalkboard-teacher text-3xl text-rose-300"></i>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800">Data Kosong</h3>
                                <p class="text-gray-500 text-sm mt-1">Belum ada data dosen.</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php if ($highlightId): ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const target = document.getElementById("row-<?= $highlightId ?>");
        if (target) target.scrollIntoView({ behavior: "smooth", block: "center" });
    });
</script>
<?php endif; ?>