<?php
// view/admin/mahasiswa.php
$highlightId = $_GET['highlight_id'] ?? null;
$searchKeyword = $_GET['q'] ?? '';
?>

<div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
            <span class="w-3 h-8 bg-gradient-to-b from-emerald-400 to-teal-500 rounded-full"></span>
            Data Mahasiswa
        </h1>
        <p class="text-gray-500 text-sm mt-2 ml-6">Kelola data mahasiswa aktif dan alumni Lab MMT.</p>
    </div>

    <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
        <form action="dashboard.php" method="GET" class="relative w-full sm:w-64 group">
            <input type="hidden" name="page" value="mahasiswa">
            <input type="text" name="q" value="<?= htmlspecialchars($searchKeyword) ?>" placeholder="Cari Nama / NIM..." 
                   class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-400 transition shadow-sm font-medium text-gray-700">
            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-gray-400 group-focus-within:text-emerald-500 transition-colors">
                <i class="fas fa-search"></i>
            </div>
        </form>

        <a href="dashboard.php?page=tambah_mahasiswa" 
           class="group bg-gradient-to-r from-emerald-500 to-teal-600 text-white px-6 py-3 rounded-xl hover:shadow-lg hover:shadow-emerald-500/30 hover:-translate-y-1 transition-all duration-300 font-bold flex items-center justify-center gap-3 whitespace-nowrap">
            <div class="bg-white/20 p-1 rounded-lg group-hover:rotate-90 transition duration-300">
                <i class="fas fa-plus text-xs"></i>
            </div>
            <span>Tambah</span>
        </a>
    </div>
</div>

<div class="bg-white rounded-[2rem] shadow-xl shadow-gray-100/50 border border-gray-100 overflow-hidden relative">
    
    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2 opacity-60 pointer-events-none"></div>

    <div class="overflow-x-auto relative z-10">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50/80 text-gray-500 uppercase text-xs font-extrabold tracking-wider border-b border-gray-100">
                <tr>
                    <th class="px-8 py-5 w-20 text-center">No</th>
                    <th class="px-6 py-5">Identitas Mahasiswa</th>
                    <th class="px-6 py-5">Program Studi</th>
                    <th class="px-6 py-5 w-32 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 text-sm text-gray-700">
                <?php if (!empty($mahasiswa)): ?>
                    <?php $no = 1; foreach ($mahasiswa as $row): ?>
                    
                    <?php 
                        $isHighlighted = ($row['id'] == $highlightId) || !empty($searchKeyword);
                        $rowClass = $isHighlighted ? "bg-emerald-50/60" : "hover:bg-emerald-50/20";
                    ?>

                    <tr class="<?= $rowClass ?> transition duration-300 group" id="row-<?= $row['id'] ?>">
                        
                        <td class="px-8 py-5 text-center font-bold text-gray-400 group-hover:text-emerald-500 transition">
                            <?= $no++ ?>
                        </td>
                        
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-sm">
                                    <?= substr($row['nama'], 0, 1) ?>
                                </div>
                                <div>
                                    <div class="font-bold text-gray-800 text-base group-hover:text-emerald-700 transition">
                                        <?= htmlspecialchars($row['nama']) ?>
                                    </div>
                                    <span class="font-mono text-xs text-gray-500 bg-gray-100 px-2 py-0.5 rounded border border-gray-200 mt-1 inline-block">
                                        <?= htmlspecialchars($row['nim']) ?>
                                    </span>
                                    <?php if($isHighlighted): ?>
                                        <span class="ml-2 text-[10px] bg-green-100 text-green-700 px-2 py-0.5 rounded-full font-bold">
                                            <i class="fas fa-check mr-1"></i> Ditemukan
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                        
                        <td class="px-6 py-5">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-600 border border-blue-100">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                <?= htmlspecialchars($row['nama_prodi'] ?? '-') ?>
                            </span>
                        </td>
                        
                        <td class="px-6 py-5 text-center">
                            <div class="flex justify-center gap-2 opacity-90 group-hover:opacity-100 transition">
                                <a href="dashboard.php?page=edit_mahasiswa&id=<?= $row['id'] ?>" 
                                   class="w-9 h-9 flex items-center justify-center rounded-xl bg-white border border-gray-200 text-blue-500 hover:bg-blue-50 hover:border-blue-200 transition shadow-sm"
                                   title="Edit">
                                    <i class="fas fa-pen text-xs"></i>
                                </a>
                                <a href="dashboard.php?page=hapus_mahasiswa&id=<?= $row['id'] ?>" 
                                   class="w-9 h-9 flex items-center justify-center rounded-xl bg-white border border-gray-200 text-red-500 hover:bg-red-50 hover:border-red-200 transition shadow-sm"
                                   onclick="return confirm('Yakin ingin menghapus data <?= $row['nama'] ?>?')"
                                   title="Hapus">
                                    <i class="fas fa-trash text-xs"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-20 h-20 bg-emerald-50 rounded-full flex items-center justify-center mb-4 animate-bounce">
                                    <i class="fas fa-user-graduate text-3xl text-emerald-300"></i>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800">Data Kosong</h3>
                                <p class="text-gray-500 text-sm mt-1">Belum ada data mahasiswa yang terdaftar.</p>
                                <?php if(!empty($searchKeyword)): ?>
                                    <a href="dashboard.php?page=mahasiswa" class="mt-4 text-emerald-600 font-bold hover:underline text-sm">Reset Pencarian</a>
                                <?php endif; ?>
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
        if (target) {
            target.scrollIntoView({ behavior: "smooth", block: "center" });
        }
    });
</script>
<?php endif; ?>