<?php
require_once __DIR__ . '/../../lib/helpers.php';
$listBerita = $newsList ?? [];
$searchQuery = $_GET['search'] ?? '';
?>

<div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
            <span class="w-3 h-8 bg-gradient-to-b from-orange-400 to-red-500 rounded-full"></span>
            Kelola Artikel & Berita
        </h1>
        <p class="text-gray-500 text-sm mt-2 ml-6">Publikasikan informasi terbaru seputar kegiatan lab dan prestasi.</p>
    </div>

    <a href="dashboard.php?page=tambah_berita"
        class="group bg-gradient-to-r from-orange-600 to-red-500 text-white px-7 py-3.5 rounded-2xl hover:shadow-lg hover:shadow-orange-500/30 hover:-translate-y-1 transition-all duration-300 font-bold flex items-center gap-3">
        <div class="bg-white/20 p-1.5 rounded-lg group-hover:rotate-12 transition duration-300">
            <i class="fas fa-pen-nib text-xs"></i>
        </div>
        <span>Tulis Berita Baru</span>
    </a>
</div>

<div class="bg-white rounded-[2rem] shadow-xl shadow-gray-100/50 border border-gray-100 overflow-hidden relative">

    <div
        class="absolute top-0 left-0 w-64 h-64 bg-orange-50 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2 opacity-60 pointer-events-none">
    </div>

    <div
        class="p-6 border-b border-gray-100 bg-gray-50/30 relative z-10 flex flex-col md:flex-row gap-4 justify-between items-center">
        <form action="" method="GET" class="relative w-full md:w-96 group">
            <input type="hidden" name="page" value="berita">

            <input type="text" name="search" value="<?php echo h($searchQuery); ?>" placeholder="Cari judul berita..."
                class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 bg-white focus:outline-none focus:ring-4 focus:ring-orange-500/10 focus:border-orange-400 transition shadow-sm font-medium text-gray-700">

            <div
                class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-gray-400 group-focus-within:text-orange-500 transition-colors">
                <i class="fas fa-search"></i>
            </div>
        </form>

        <div class="relative w-full md:w-auto">
            <form action="" method="GET">
                <input type="hidden" name="page" value="berita">

                <?php if (!empty($searchQuery)): ?>
                    <input type="hidden" name="search" value="<?= h($searchQuery) ?>">
                <?php endif; ?>

                <select name="category" onchange="this.form.submit()"
                    class="w-full md:w-48 pl-4 pr-10 py-3 rounded-xl border border-gray-200 bg-white text-gray-600 text-sm font-semibold focus:outline-none focus:ring-4 focus:ring-orange-500/10 focus:border-orange-400 transition shadow-sm cursor-pointer appearance-none hover:border-orange-300">

                    <option value="">Semua Kategori</option>

                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $cat): ?>
                            <?php
                            $selected = (isset($_GET['category']) && $_GET['category'] == $cat['id']) ? 'selected' : '';
                            ?>
                            <option value="<?= $cat['id'] ?>" <?= $selected ?>>
                                <?= h($cat['nama_kategori']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </select>

                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-400">
                    <i class="fas fa-filter text-xs"></i>
                </div>
            </form>
        </div>
    </div>

    <div class="overflow-x-auto relative z-10">
        <table class="w-full text-left border-collapse">
            <thead
                class="bg-gray-50/80 text-gray-500 uppercase text-xs font-extrabold tracking-wider border-b border-gray-100">
                <tr>
                    <th class="px-8 py-5 w-40">Thumbnail</th>
                    <th class="px-6 py-5">Judul & Cuplikan</th>
                    <th class="px-6 py-5 text-center">Kategori</th>
                    <th class="px-6 py-5 text-center">Tanggal</th>
                    <th class="px-6 py-5 text-center w-32">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 text-sm text-gray-700">
                <?php if (empty($listBerita)): ?>
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div
                                    class="w-20 h-20 bg-orange-50 rounded-full flex items-center justify-center mb-4 animate-pulse">
                                    <i class="far fa-newspaper text-3xl text-orange-300"></i>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800">Belum ada berita</h3>
                                <p class="text-gray-500 text-sm mt-1">Mulai tulis artikel pertama Anda sekarang.</p>
                            </div>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($listBerita as $berita): ?>
                        <tr class="hover:bg-orange-50/30 transition duration-300 group">

                            <td class="px-8 py-5">
                                <div
                                    class="h-20 w-28 bg-gray-100 rounded-xl overflow-hidden border border-gray-200 flex items-center justify-center shadow-sm group-hover:shadow-md transition-all relative">
                                    <?php if (!empty($berita['gambar_berita'])): ?>
                                        <img src="<?php echo assetUrl($berita['gambar_berita']); ?>" alt="Img"
                                            class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <div class="flex flex-col items-center text-gray-300">
                                            <i class="fas fa-image text-xl mb-1"></i>
                                            <span class="text-[10px] font-bold">No Image</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </td>

                            <td class="px-6 py-5 max-w-lg">
                                <h3
                                    class="font-bold text-gray-800 text-base mb-1.5 leading-snug group-hover:text-orange-600 transition-colors">
                                    <?php echo h($berita['judul']); ?>
                                </h3>
                                <p class="text-gray-500 text-xs leading-relaxed line-clamp-2">
                                    <?php echo h(mb_substr(strip_tags($berita['isi_berita'] ?? ''), 0, 120)) . '...'; ?>
                                </p>
                            </td>

                            <td class="px-6 py-5 text-center">
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-600 border border-blue-100 shadow-sm">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                    <?php echo h($berita['nama_kategori'] ?? 'Umum'); ?>
                                </span>
                            </td>

                            <td class="px-6 py-5 text-center whitespace-nowrap">
                                <div class="flex flex-col items-center">
                                    <span class="text-xs font-bold text-gray-700">
                                        <?php echo !empty($berita['created_at']) ? date('d M Y', strtotime($berita['created_at'])) : '-'; ?>
                                    </span>
                                    <span class="text-[10px] text-gray-400 font-medium">
                                        <?php echo !empty($berita['created_at']) ? date('H:i', strtotime($berita['created_at'])) . ' WIB' : ''; ?>
                                    </span>
                                </div>
                            </td>

                            <td class="px-6 py-5 text-center">
                                <div class="flex justify-center gap-2 opacity-90 group-hover:opacity-100 transition">
                                    <a href="dashboard.php?page=edit_berita&id=<?php echo $berita['id']; ?>"
                                        class="w-9 h-9 flex items-center justify-center rounded-xl bg-white border border-gray-200 text-blue-500 hover:bg-blue-50 hover:border-blue-200 transition shadow-sm"
                                        title="Edit Artikel">
                                        <i class="fas fa-pen text-xs"></i>
                                    </a>
                                    <a href="dashboard.php?page=hapus_berita&id=<?php echo $berita['id']; ?>"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')"
                                        class="w-9 h-9 flex items-center justify-center rounded-xl bg-white border border-gray-200 text-red-500 hover:bg-red-50 hover:border-red-200 transition shadow-sm"
                                        title="Hapus Artikel">
                                        <i class="fas fa-trash text-xs"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>