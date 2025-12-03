<?php 
$data_About = $data ?? []; 

$visi = $data_About['visi'] ?? 'Data Visi tidak tersedia.';
$misi = $data_About['misi'] ?? 'Data Misi tidak tersedia.';
$nilai_inti = $data_About['nilai_inti'] ?? [];
$sejarah = $data_About['sejarah'] ?? [];
$organisasi = $data_About['organisasi'] ?? null;
$dosen = $data_About['dosen'] ?? [];
$partner = $data_About['partner'] ?? [];
?>

<?php include __DIR__ . '/../layouts/header.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .color-orange-brand { color: #f97316; } 
        .bg-orange-brand { background-color: #f97316; }
        .border-orange-brand { border-color: #f97316; }
        
        .timeline-line {
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 2px;
            background-color: #e5e7eb;
            transform: translateX(-50%);
        }
        @media (max-width: 768px) {
            .timeline-line {
                left: 20px;
            }
        }

        /* Custom Scrollbar untuk Dosen */
        .scrollbar-thin::-webkit-scrollbar {
            height: 6px;
        }
        .scrollbar-thin::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .scrollbar-thin::-webkit-scrollbar-thumb {
            background: #fed7aa; 
            border-radius: 10px;
        }
        .scrollbar-thin::-webkit-scrollbar-thumb:hover {
            background: #fdba74; 
        }
    </style>
</head>
<body class="bg-white text-gray-800">

    <main class="container mx-auto px-4 py-12">

        <section class="bg-white pt-24 pb-12 text-center">
            <div class="max-w-screen-xl mx-auto px-4"> 
                <h1 class="font-heading font-bold text-3xl md:text-4xl text-brand-dark mb-2">
                    Tentang Kami
                </h1>
                <p class="font-sans text-gray-500 text-sm md:text-base">
                    Pusat Inovasi Laboratorium dan Pengembangan Teknologi Digital Multimedia.
                </p>
            </div>
        </section>

        <section class="mb-20">
            <div class="flex flex-col md:flex-row gap-8 max-w-6xl mx-auto">
                <div class="md:w-1/2 border p-6 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-semibold mb-4 text-gray-900">Visi Kami</h3>
                    <p class="text-gray-600 leading-relaxed"><?php echo htmlspecialchars($visi); ?></p>
                </div>
                <div class="md:w-1/2 border p-6 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-semibold mb-4 text-gray-900">Misi Kami</h3>
                    <p class="text-gray-600 leading-relaxed"><?php echo htmlspecialchars($misi); ?></p>
                </div>
            </div>
        </section>

        <section class="mb-20">
            <h3 class="text-3xl font-bold text-center mb-10 text-gray-800">Nilai Inti Kami</h3>
            <div class="flex flex-wrap justify-center gap-6 max-w-4xl mx-auto">
                <?php if (!empty($nilai_inti)): ?>
                    <?php foreach ($nilai_inti as $item): ?>
                        <div class="w-full sm:w-1/3 p-4">
                            <div class="bg-white p-6 text-center border rounded-xl shadow-md transition duration-300 hover:shadow-lg">
                                <div class="w-16 h-16 rounded-full bg-orange-100 flex items-center justify-center mx-auto mb-4 border-2 border-orange-200">
                                    <?php if (!empty($item['gambar_nilai'])): ?>
                                        <img src="<?php echo htmlspecialchars('assets/images/uploads/' . $item['gambar_nilai']); ?>" alt="Icon" class="w-10 h-10 object-contain">
                                    <?php else: ?>
                                        <svg class="w-8 h-8 color-orange-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v18"></path></svg>
                                    <?php endif; ?>
                                </div>
                                <h4 class="font-semibold text-lg text-gray-900"><?php echo htmlspecialchars($item['judul']); ?></h4>
                                <p class="text-sm text-gray-500 mt-2"><?php echo htmlspecialchars($item['deskripsi'] ?? ''); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-gray-500 w-full text-center">Data Nilai Inti tidak ditemukan.</p>
                <?php endif; ?>
            </div>
        </section>

        <section class="mb-20">
            <h3 class="text-3xl font-bold text-center mb-16 text-gray-800">Sejarah & Perjalanan</h3>
            <div class="relative max-w-4xl mx-auto">
                <div class="timeline-line"></div>
                <?php if (!empty($sejarah)): ?>
                    <?php $i = 0; foreach ($sejarah as $event): ?>
                        <?php 
                            $is_left = ($i % 2 == 0); 
                            $align_class = $is_left ? 'md:justify-start md:text-left' : 'md:justify-end md:text-right';
                            $content_order = $is_left ? 'md:order-1' : 'md:order-3';
                            $i++;
                        ?>
                        <div class="mb-8 flex justify-center w-full">
                            <div class="flex flex-col md:flex-row w-full items-center <?php echo $align_class; ?>">
                                <div class="w-full md:w-1/2 p-2 <?php echo $content_order; ?>">
                                    <div class="p-4 border rounded-lg shadow-md bg-white">
                                        <span class="inline-block bg-orange-100 text-orange-600 text-xs font-bold px-2 py-1 rounded mb-2">
                                            <?php echo htmlspecialchars($event['tahun'] ?? ''); ?>
                                        </span>
                                        <h4 class="font-bold text-xl color-orange-brand"><?php echo htmlspecialchars($event['judul']); ?></h4>
                                        <p class="text-sm text-gray-600 mt-1"><?php echo htmlspecialchars($event['isi']); ?></p>
                                    </div>
                                </div>
                                <div class="relative w-full md:w-auto flex justify-center items-center h-full order-2">
                                    <div class="z-10 w-4 h-4 rounded-full bg-orange-brand border-4 border-white shadow-md"></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center text-gray-500">Data Sejarah tidak ditemukan.</p>
                <?php endif; ?>
            </div>
        </section>

        <section class="mb-20">
            <h3 class="text-3xl font-bold text-center mb-8 text-gray-800">Struktur Organisasi</h3>
            <div class="max-w-6xl mx-auto bg-gray-50 rounded-lg shadow-xl flex items-center justify-center text-gray-500 text-lg font-medium overflow-hidden border border-gray-200">
                <?php if ($organisasi): ?>
                    <img src="<?php echo htmlspecialchars($organisasi); ?>" alt="Struktur Organisasi" class="w-full h-auto object-contain">
                <?php else: ?>
                    <div class="p-12 text-center">Data Struktur Organisasi belum tersedia.</div>
                <?php endif; ?>
            </div>
        </section>

        <section class="mb-20">
            <h3 class="text-3xl font-bold text-center mb-10 text-gray-800">Dosen Laboratorium</h3>
            
            <?php if (!empty($dosen)): ?>
                <div class="flex overflow-x-auto pb-8 gap-6 px-4 snap-x snap-mandatory scrollbar-thin">
                    <?php foreach ($dosen as $pic): ?>
                        <div class="flex-shrink-0 w-64 snap-center flex flex-col items-center text-center p-5 bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition group">
                            <?php if (!empty($pic['gambar_tim'])): ?>
                                <img src="<?php echo htmlspecialchars($pic['gambar_tim']); ?>" alt="<?php echo htmlspecialchars($pic['nama']); ?>" class="w-24 h-24 rounded-full object-cover mb-4 bg-gray-100 border-2 border-gray-200 group-hover:border-orange-300 transition">
                            <?php else: ?>
                                <div class="w-24 h-24 rounded-full bg-gray-200 mb-4 flex items-center justify-center text-gray-400">
                                    <i class="fas fa-user text-3xl"></i>
                                </div>
                            <?php endif; ?>
                            
                            <p class="font-semibold text-gray-900 leading-tight text-base mb-1"><?php echo htmlspecialchars($pic['nama']); ?></p>
                            <p class="text-xs text-gray-500 mb-4 uppercase tracking-wide"><?php echo htmlspecialchars($pic['jabatan']); ?></p>
                            
                            <div class="flex space-x-4 mt-auto">
                                <?php if (!empty($pic['link_linkedin'])): ?>
                                    <a href="<?php echo htmlspecialchars($pic['link_linkedin']); ?>" target="_blank" 
                                       class="text-gray-400 hover:text-blue-700 transition-transform duration-300 hover:scale-125"> 
                                        <i class="fab fa-linkedin text-xl"></i>
                                    </a>
                                <?php endif; ?>
                                
                                <?php if (!empty($pic['link_instagram'])): ?>
                                    <a href="<?php echo htmlspecialchars($pic['link_instagram']); ?>" target="_blank" 
                                       class="text-gray-400 hover:text-pink-600 transition-transform duration-300 hover:scale-125"> 
                                        <i class="fab fa-instagram text-xl"></i>
                                    </a>
                                <?php endif; ?>
                                
                                <?php if (!empty($pic['link_github'])): ?>
                                    <a href="<?php echo htmlspecialchars($pic['link_github']); ?>" target="_blank" 
                                       class="text-gray-400 hover:text-gray-800 transition-transform duration-300 hover:scale-125"> 
                                        <i class="fab fa-github text-xl"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="col-span-full text-center text-gray-500">Data dosen tidak tersedia.</p>
            <?php endif; ?>
        </section>

        <section class="mb-10">
            <h3 class="text-3xl font-bold text-center mb-10 text-gray-800">Partner dan Kolaborasi Kami</h3>
            <div class="flex flex-wrap justify-center gap-8 max-w-7xl mx-auto">
                <?php if (!empty($partner)): ?>
                    <?php foreach ($partner as $p): ?>
                        <div class="w-32 h-24 flex items-center justify-center border border-gray-200 rounded-xl p-4 bg-white transition duration-300 hover:shadow-xl hover:border-orange-200">
                            <?php if (!empty($p['gambar_brand'])): ?>
                                <img src="<?php echo htmlspecialchars($p['gambar_brand']); ?>" 
                                     alt="<?php echo htmlspecialchars($p['nama_brand']); ?>" 
                                     class="max-h-full max-w-full object-contain transition-transform duration-300 hover:scale-110">
                            <?php else: ?>
                                <span class="text-sm font-medium text-gray-500 text-center leading-snug"><?php echo htmlspecialchars($p['nama_brand']); ?></span>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center text-gray-500">Data partner tidak tersedia.</p>
                <?php endif; ?>
            </div>
        </section>

    </main>
    
    <?php include __DIR__ . '/../layouts/footer.php';?>
</body>
</html>