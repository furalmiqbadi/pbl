<?php
// 1. LOAD MODEL PENGUNJUNG
require_once __DIR__ . '/../../model/VisitorModel.php';
$visitorModel = new VisitorModel();

// 2. AMBIL DATA ANALITIK (Realtime dari Database)
$webStats = $visitorModel->getStatistik();        // Angka: Hari ini, Bulan ini, Total
$grafikData = $visitorModel->getGrafikMingguan(); // Data Grafik 7 Hari

// Siapkan Data untuk Chart.js (Format JSON)
$chartLabels = [];
$chartValues = [];
foreach ($grafikData as $d) {
    $chartLabels[] = $d['tgl'];
    $chartValues[] = $d['jumlah'];
}

// 3. AMBIL DATA LAINNYA (Koneksi Manual untuk Counter Data)
$db = Connection::getConnection();
$stats = ['proyek' => 0, 'berita' => 0, 'galeri' => 0, 'mahasiswa' => 0, 'dosen' => 0];
$recentProyek = [];
$recentBerita = [];

if ($db) {
    try {
        // Hitung Total Data
        $stats['proyek'] = $db->query("SELECT COUNT(*) FROM daftar_proyek")->fetchColumn();
        $stats['berita'] = $db->query("SELECT COUNT(*) FROM berita_artikel")->fetchColumn();
        $stats['galeri'] = $db->query("SELECT COUNT(*) FROM galeri")->fetchColumn();
        $stats['mahasiswa'] = $db->query("SELECT COUNT(*) FROM mahasiswa")->fetchColumn();
        $stats['dosen'] = $db->query("SELECT COUNT(*) FROM dosen_multimedia")->fetchColumn();

        // Ambil 5 Karya Terbaru
        $recentProyek = $db->query("SELECT p.*, k.nama_kategori 
                                    FROM daftar_proyek p 
                                    LEFT JOIN kategori k ON p.kategori_id = k.id 
                                    ORDER BY p.id DESC LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);

        // Ambil 4 Berita Terbaru
        $recentBerita = $db->query("SELECT * FROM berita_artikel ORDER BY created_at DESC LIMIT 4")->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) { }
}
?>

<div class="flex flex-col md:flex-row justify-between items-end mb-8 gap-4">
    <div>
        <h1 class="text-3xl font-bold text-gray-800 tracking-tight">Dashboard Overview</h1>
        <p class="text-gray-500 mt-1 text-sm">
            Selamat datang, <span class="text-orange-600 font-bold"><?php echo htmlspecialchars($_SESSION['username'] ?? 'Admin'); ?></span>! 
            Berikut laporan performa website Anda.
        </p>
    </div>
    <div class="w-full md:w-auto relative">
        <form action="dashboard.php" method="GET">
            <input type="hidden" name="page" value="search">
            <input type="text" name="q" placeholder="Cari data apapun..." 
                   class="pl-10 pr-4 py-3 rounded-xl bg-white border border-gray-200 text-sm w-full md:w-80 focus:ring-2 focus:ring-orange-100 focus:border-orange-400 outline-none transition shadow-sm">
            <i class="fas fa-search absolute left-4 top-3.5 text-gray-400"></i>
        </form>
    </div>
</div>

<div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
    <?php 
    $cards = [
        ['label'=>'Karya', 'icon'=>'laptop-code', 'color'=>'blue', 'count'=>$stats['proyek']],
        ['label'=>'Artikel', 'icon'=>'newspaper', 'color'=>'orange', 'count'=>$stats['berita']],
        ['label'=>'Galeri', 'icon'=>'images', 'color'=>'purple', 'count'=>$stats['galeri']],
        ['label'=>'Mahasiswa', 'icon'=>'user-graduate', 'color'=>'green', 'count'=>$stats['mahasiswa']],
        ['label'=>'Dosen', 'icon'=>'chalkboard-teacher', 'color'=>'red', 'count'=>$stats['dosen']],
    ];
    foreach($cards as $c): 
    ?>
    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 text-center hover:shadow-md transition group cursor-default">
        <div class="text-<?= $c['color'] ?>-500 text-2xl mb-2 group-hover:scale-110 transition transform duration-300"><i class="fas fa-<?= $c['icon'] ?>"></i></div>
        <p class="text-3xl font-extrabold text-gray-800 counter" data-target="<?= $c['count'] ?>">0</p>
        <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider mt-1"><?= $c['label'] ?></p>
    </div>
    <?php endforeach; ?>
</div>

<div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-10">
    <a href="dashboard.php?page=tambah_proyek" class="p-4 bg-white border border-gray-200 rounded-xl hover:bg-blue-50 hover:border-blue-200 transition flex flex-col items-center gap-2 group shadow-sm hover:shadow-md">
        <i class="fas fa-plus-circle text-blue-400 group-hover:text-blue-600 text-2xl mb-1 transition"></i> 
        <span class="text-xs font-bold text-gray-600 group-hover:text-blue-700">Tambah Karya</span>
    </a>
    <a href="dashboard.php?page=tambah_berita" class="p-4 bg-white border border-gray-200 rounded-xl hover:bg-orange-50 hover:border-orange-200 transition flex flex-col items-center gap-2 group shadow-sm hover:shadow-md">
        <i class="fas fa-pen-nib text-orange-400 group-hover:text-orange-600 text-2xl mb-1 transition"></i> 
            <span class="text-xs font-bold text-gray-600 group-hover:text-orange-700">Tulis Berita & Artikel</span>
    </a>
    <a href="dashboard.php?page=tambah_galeri" class="p-4 bg-white border border-gray-200 rounded-xl hover:bg-purple-50 hover:border-purple-200 transition flex flex-col items-center gap-2 group shadow-sm hover:shadow-md">
        <i class="fas fa-camera text-purple-400 group-hover:text-purple-600 text-2xl mb-1 transition"></i> 
        <span class="text-xs font-bold text-gray-600 group-hover:text-purple-700">Upload Galeri</span>
    </a>
    <a href="dashboard.php?page=tambah_mahasiswa" class="p-4 bg-white border border-gray-200 rounded-xl hover:bg-green-50 hover:border-green-200 transition flex flex-col items-center gap-2 group shadow-sm hover:shadow-md">
        <i class="fas fa-user-plus text-green-400 group-hover:text-green-600 text-2xl mb-1 transition"></i> 
        <span class="text-xs font-bold text-gray-600 group-hover:text-green-700">Tambah Mahasiswa</span>
    </a>
    <a href="dashboard.php?page=tambah_dosen" class="p-4 bg-white border border-gray-200 rounded-xl hover:bg-red-50 hover:border-red-200 transition flex flex-col items-center gap-2 group shadow-sm hover:shadow-md">
        <i class="fas fa-user-tie text-red-400 group-hover:text-red-600 text-2xl mb-1 transition"></i> 
        <span class="text-xs font-bold text-gray-600 group-hover:text-red-700">Tambah Dosen</span>
    </a>
</div>

<h2 class="text-lg font-bold text-gray-800 mb-4">Analitik Trafik</h2>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
    
    <div class="space-y-6">
        <div class="bg-gradient-to-br from-blue-600 to-blue-800 p-6 rounded-2xl shadow-lg text-white relative overflow-hidden group transition hover:-translate-y-1">
            <div class="relative z-10">
                <p class="text-blue-200 text-xs font-bold uppercase tracking-wider">Pengunjung Hari Ini</p>
                <h3 class="text-4xl font-extrabold"><?php echo $webStats['hari_ini']; ?></h3>
            </div>
            <i class="fas fa-chart-line absolute -right-2 -bottom-4 text-[5rem] text-white opacity-10 group-hover:scale-110 transition duration-500"></i>
        </div>
        <div class="bg-gradient-to-br from-purple-600 to-purple-800 p-6 rounded-2xl shadow-lg text-white relative overflow-hidden group transition hover:-translate-y-1">
            <div class="relative z-10">
                <p class="text-purple-200 text-xs font-bold uppercase tracking-wider mb-2">Total Bulan Ini</p>
                <h3 class="text-4xl font-extrabold"><?php echo $webStats['bulan_ini']; ?></h3>
            </div>
            <i class="fas fa-calendar-alt absolute -right-2 -bottom-4 text-[5rem] text-white opacity-10 group-hover:scale-110 transition duration-500"></i>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100 relative overflow-hidden group">
            <div class="relative z-10">
                <p class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Total Sejak Awal</p>
                <h3 class="text-4xl font-extrabold text-gray-800"><?php echo number_format($webStats['total']); ?></h3>
            </div>
            <i class="fas fa-users absolute -right-2 -bottom-4 text-[5rem] text-gray-100 group-hover:scale-110 transition duration-500"></i>
        </div>
    </div>

    <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-md border border-gray-100 flex flex-col">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2"><i class="fas fa-chart-area text-orange-500"></i> Tren Kunjungan 7 Hari</h2>
            <button onclick="location.reload()" class="text-xs text-gray-400 hover:text-orange-500"><i class="fas fa-sync-alt"></i> Refresh</button>
        </div>
        <div class="relative flex-1 w-full min-h-[300px]">
            <canvas id="visitorChart"></canvas>
        </div>
    </div>
</div>

<h2 class="text-lg font-bold text-gray-800 mb-4">Preview Konten Terbaru</h2>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
    
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2"><span class="w-2 h-6 bg-blue-500 rounded-full"></span> Karya Terbaru</h2>
            <a href="dashboard.php?page=proyek" class="text-xs font-bold text-blue-600 hover:bg-blue-50 px-3 py-1.5 rounded-lg transition">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-gray-50 text-xs uppercase font-bold text-gray-400">
                    <tr>
                        <th class="px-6 py-3">Judul Karya</th>
                        <th class="px-6 py-3">Kategori</th>
                        <th class="px-6 py-3 text-right">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php if(!empty($recentProyek)): ?>
                        <?php foreach($recentProyek as $rp): ?>
                        <tr class="hover:bg-blue-50/50 transition">
                            <td class="px-6 py-4 font-semibold text-gray-800"><?= htmlspecialchars($rp['judul']) ?></td>
                            <td class="px-6 py-4">
                                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-[10px] font-bold border border-gray-200 uppercase"><?= htmlspecialchars($rp['nama_kategori'] ?? 'UMUM') ?></span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <span class="text-green-500 font-bold text-xs"><i class="fas fa-check-circle"></i> Publish</span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="3" class="px-6 py-8 text-center text-gray-400 text-sm italic">Belum ada karya diupload.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2"><span class="w-2 h-6 bg-orange-500 rounded-full"></span> Berita</h2>
            <a href="dashboard.php?page=berita" class="text-xs font-bold text-orange-600 hover:bg-orange-50 px-3 py-1.5 rounded-lg transition">Lihat Semua</a>
        </div>
        
        <div class="space-y-4 flex-1 overflow-y-auto max-h-[320px] pr-1 scrollbar-hide">
            <?php if(!empty($recentBerita)): ?>
                <?php foreach($recentBerita as $rb): ?>
                <a href="dashboard.php?page=berita" class="flex gap-4 group cursor-pointer hover:bg-gray-50 p-2 rounded-xl transition border border-transparent hover:border-gray-100">
                    <div class="w-16 h-16 rounded-xl bg-gray-100 overflow-hidden flex-shrink-0 shadow-sm relative">
                        <?php 
                            $img = "../../assets/images/uploads/" . $rb['gambar_berita'];
                            if(!file_exists(__DIR__ . '/../../assets/images/uploads/' . $rb['gambar_berita']) || empty($rb['gambar_berita'])) { $img = "https://via.placeholder.com/150?text=IMG"; }
                        ?>
                        <img src="<?= $img ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    </div>
                    <div class="flex-1">
                        <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wide mb-0.5 block"><i class="far fa-clock mr-1"></i> <?= date('d M, Y', strtotime($rb['created_at'])) ?></span>
                        <h4 class="text-sm font-bold text-gray-800 leading-snug group-hover:text-orange-600 transition line-clamp-2"><?= htmlspecialchars($rb['judul']) ?></h4>
                    </div>
                </a>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center py-10 text-gray-400 text-sm italic">Belum ada berita terbaru.</div>
            <?php endif; ?>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // 1. KONFIGURASI GRAFIK (Chart.js)
    const ctx = document.getElementById('visitorChart').getContext('2d');
    const labels = <?php echo json_encode($chartLabels); ?>;
    const dataValues = <?php echo json_encode($chartValues); ?>;

    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(249, 115, 22, 0.5)');
    gradient.addColorStop(1, 'rgba(249, 115, 22, 0.0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Pengunjung',
                data: dataValues,
                borderColor: '#f97316',
                backgroundColor: gradient,
                borderWidth: 3,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#f97316',
                pointRadius: 5,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { borderDash: [5, 5], color: '#f3f4f6' }, ticks: { font: { size: 11 }, color: '#9ca3af' } },
                x: { grid: { display: false }, ticks: { font: { size: 11 }, color: '#9ca3af' } }
            }
        }
    });

    // 2. ANIMASI ANGKA BERJALAN (Counter)
    document.addEventListener("DOMContentLoaded", () => {
        const counters = document.querySelectorAll('.counter');
        const speed = 100;

        counters.forEach(counter => {
            const updateCount = () => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const inc = Math.ceil(target / speed);
                if (count < target) {
                    counter.innerText = count + inc;
                    setTimeout(updateCount, 20);
                } else {
                    counter.innerText = target;
                }
            };
            updateCount();
        });
    });
</script>