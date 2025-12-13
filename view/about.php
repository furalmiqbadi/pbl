<?php 
require_once __DIR__ . '/../lib/helpers.php'; 

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
    <title>Tentang Kami - Lab MMT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; scroll-behavior: smooth; }
        .reveal { opacity: 0; transform: translateY(30px); transition: all 0.8s ease-out; }
        .reveal.active { opacity: 1; transform: translateY(0); }
        .timeline-line {
            position: absolute; left: 50%; top: 0; bottom: 0; width: 2px;
            background: linear-gradient(to bottom, #f97316 20%, #e5e7eb 100%);
            transform: translateX(-50%);
        }
        @media (max-width: 768px) { .timeline-line { left: 24px; } }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <main class="overflow-x-hidden">

        <section class="relative bg-white pt-32 pb-20 text-center overflow-hidden">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full pointer-events-none">
                <div class="absolute top-20 left-10 w-72 h-72 bg-orange-100 rounded-full blur-3xl opacity-50"></div>
                <div class="absolute bottom-10 right-10 w-96 h-96 bg-blue-50 rounded-full blur-3xl opacity-50"></div>
            </div>
            <div class="relative z-10 max-w-4xl mx-auto px-4 reveal">
                <span class="inline-block py-1 px-3 rounded-full bg-orange-100 text-orange-600 text-sm font-bold tracking-wide mb-4">PROFIL KAMI</span>
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-6 leading-tight">
                    Membangun Masa Depan <br> <span class="text-orange-500">Teknologi Multimedia</span>
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    Pusat inovasi, kreativitas, dan pengembangan teknologi digital yang berfokus pada pencetakan talenta unggul di bidang multimedia.
                </p>
            </div>
        </section>

        <section class="py-16 px-4">
            <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-8">
                <div class="group bg-white p-8 rounded-3xl shadow-sm hover:shadow-xl border border-gray-100 transition-all duration-300 reveal hover:-translate-y-2">
                    <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-blue-500 transition-colors duration-300">
                        <i class="fas fa-eye text-2xl text-blue-600 group-hover:text-white transition-colors"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Visi Kami</h3>
                    <p class="text-gray-600 leading-relaxed text-justify"><?php echo nl2br(h($visi)); ?></p>
                </div>
                <div class="group bg-white p-8 rounded-3xl shadow-sm hover:shadow-xl border border-gray-100 transition-all duration-300 reveal hover:-translate-y-2" style="transition-delay: 100ms;">
                    <div class="w-14 h-14 bg-orange-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-orange-500 transition-colors duration-300">
                        <i class="fas fa-rocket text-2xl text-orange-600 group-hover:text-white transition-colors"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Misi Kami</h3>
                    <p class="text-gray-600 leading-relaxed text-justify"><?php echo nl2br(h($misi)); ?></p>
                </div>
            </div>
        </section>

        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16 reveal">
                    <span class="text-orange-500 font-bold tracking-wider uppercase text-sm">Core Values</span>
                    <h3 class="text-3xl font-extrabold text-gray-900 mt-2">Nilai Inti Kami</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    <?php if (!empty($nilai_inti)): ?>
                        <?php foreach ($nilai_inti as $i => $item): ?>
                            <div class="reveal h-full p-8 rounded-3xl bg-gray-50 border border-gray-100 hover:bg-white hover:shadow-xl hover:border-orange-200 transition-all duration-300 group text-center flex flex-col items-center" style="transition-delay: <?php echo $i * 100; ?>ms;">
                                
                                <div class="w-20 h-20 rounded-full bg-white shadow-sm flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 border border-gray-100 overflow-hidden relative">
                                    <?php 
                                        $namaFile = basename($item['gambar_nilai'] ?? '');
                                        $fullPath = 'assets/images/uploads/' . $namaFile;
                                    ?>
                                    
                                    <?php if (!empty($namaFile)): ?>
                                        <img src="<?php echo assetUrl($fullPath); ?>" 
                                             alt="Icon" 
                                             class="w-10 h-10 object-contain absolute inset-0 m-auto z-10"
                                             onerror="this.style.display='none'; document.getElementById('fallback-icon-<?= $i ?>').style.display='block';">
                                        
                                        <i id="fallback-icon-<?= $i ?>" class="fas fa-star text-3xl text-orange-500" style="display: none;"></i>
                                    <?php else: ?>
                                        <i class="fas fa-star text-3xl text-orange-500"></i>
                                    <?php endif; ?>
                                </div>
                                
                                <h4 class="text-xl font-bold text-gray-900 mb-3"><?php echo h($item['judul']); ?></h4>
                                <p class="text-gray-500 text-sm leading-relaxed"><?php echo h($item['deskripsi'] ?? ''); ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-span-full text-center py-10">Data Nilai Inti belum tersedia.</div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <section class="py-20 bg-gray-50">
            <div class="container mx-auto px-4">
                <h3 class="text-3xl font-extrabold text-center mb-16 text-gray-900 reveal">Perjalanan Kami</h3>
                <div class="relative max-w-4xl mx-auto">
                    <div class="timeline-line"></div>
                    <?php if (!empty($sejarah)): ?>
                        <?php $i = 0; foreach ($sejarah as $event): $i++; ?>
                            <div class="mb-12 flex justify-center w-full reveal">
                                <div class="flex flex-col md:flex-row w-full items-center <?php echo ($i % 2 == 0) ? 'md:flex-row-reverse' : ''; ?>">
                                    <div class="w-full md:w-1/2 p-4 <?php echo ($i % 2 == 0) ? 'md:text-right' : 'md:text-left'; ?>">
                                        <div class="bg-white p-6 rounded-2xl shadow-md border-b-4 border-orange-500 hover:-translate-y-1 transition-transform duration-300 group">
                                            <span class="inline-block bg-orange-500 text-white text-xs font-bold px-3 py-1 rounded-full mb-3 shadow-sm group-hover:bg-orange-600 transition"><?php echo h($event['tahun'] ?? 'Tahun'); ?></span>
                                            <h4 class="font-bold text-xl text-gray-900 mb-2"><?php echo h($event['judul']); ?></h4>
                                            <p class="text-gray-600 text-sm leading-relaxed"><?php echo h($event['isi']); ?></p>
                                        </div>
                                    </div>
                                    <div class="relative flex justify-center items-center p-2">
                                        <div class="w-6 h-6 rounded-full bg-white border-4 border-orange-500 shadow z-10"></div>
                                    </div>
                                    <div class="w-full md:w-1/2 p-4 hidden md:block"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <section class="py-20 bg-white">
            <div class="container mx-auto px-4 text-center reveal">
                <h3 class="text-3xl font-bold text-gray-900 mb-10">Struktur Organisasi</h3>
                <div class="max-w-5xl mx-auto bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100 p-4">
                    <?php if ($organisasi): 
                        $orgName = basename($organisasi);
                        $orgPath = 'assets/images/uploads/' . $orgName; 
                    ?>
                        <img src="<?php echo assetUrl($orgPath); ?>" 
                             alt="Struktur Organisasi" 
                             class="w-full h-auto object-contain hover:scale-[1.02] transition-transform duration-500 rounded-2xl"
                             onerror="this.style.display='none'; this.parentElement.innerHTML += '<div class=\'p-20 text-gray-400\'>Gambar tidak ditemukan.</div>';">
                    <?php else: ?>
                        <div class="p-20 text-gray-400 bg-gray-50 rounded-2xl border border-dashed border-gray-200">Belum ada gambar struktur organisasi.</div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <section class="py-20 bg-white relative overflow-hidden">
            <div class="absolute top-0 right-0 w-96 h-96 bg-orange-100 rounded-full blur-[100px] opacity-60 pointer-events-none"></div>

            <div class="container mx-auto px-4 relative z-10">
                <div class="flex justify-between items-end mb-12 px-4 reveal">
                    <div>
                        <h3 class="text-3xl font-bold text-gray-900">Dosen & Tim Ahli</h3>
                        <p class="text-gray-500 mt-2">Orang-orang hebat di balik Lab MMT.</p>
                    </div>
                    <div class="hidden md:flex gap-2">
                        <button id="scrollLeft" class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center text-gray-600 hover:bg-orange-500 hover:text-white hover:border-orange-500 transition shadow-sm"><i class="fas fa-arrow-left"></i></button>
                        <button id="scrollRight" class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center text-gray-600 hover:bg-orange-500 hover:text-white hover:border-orange-500 transition shadow-sm"><i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>

                <?php if (!empty($dosen)): ?>
                    <div id="dosenSlider" class="flex overflow-x-auto gap-6 pb-8 px-4 no-scrollbar scroll-smooth snap-x snap-mandatory">
                        <?php foreach ($dosen as $pic): ?>
                            <div class="flex-shrink-0 w-72 snap-start bg-white p-6 rounded-2xl border border-gray-200 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group reveal">
                                
                                <a href="index.php?page=dosen_detail&id=<?php echo $pic['id']; ?>" class="block group/img">
                                    <div class="w-24 h-24 mx-auto mb-6 relative cursor-pointer">
                                        <div class="absolute inset-0 bg-orange-100 rounded-full blur-md opacity-0 group-hover/img:opacity-100 transition duration-300"></div>
                                        <?php 
                                            // FIX PATH GAMBAR DOSEN
                                            $imgDosen = basename($pic['gambar_tim'] ?? ''); 
                                            $dosenPath = 'assets/images/uploads/' . $imgDosen; 
                                        ?>
                                        <img src="<?php echo assetUrl($dosenPath); ?>" 
                                             alt="<?php echo h($pic['nama']); ?>" 
                                             class="w-full h-full rounded-full object-cover relative z-10 border-2 border-gray-100 group-hover/img:border-orange-400 transition shadow-sm"
                                             onerror="this.src='https://ui-avatars.com/api/?name=<?php echo urlencode($pic['nama']); ?>&background=random';">
                                    </div>
                                </a>

                                <div class="text-center">
                                    <a href="index.php?page=dosen_detail&id=<?php echo $pic['id']; ?>" class="hover:text-orange-600 transition-colors">
                                        <h4 class="text-lg font-bold text-gray-900 mb-1"><?php echo h($pic['nama']); ?></h4>
                                    </a>
                                    
                                    <p class="text-gray-500 text-xs uppercase tracking-wider font-semibold mb-4"><?php echo h($pic['jabatan']); ?></p>
                                    
                                    <div class="flex justify-center gap-4 border-t border-gray-100 pt-4 mt-4">
                                        <?php if (!empty($pic['link_linkedin'])): ?>
                                            <a href="<?php echo h($pic['link_linkedin']); ?>" target="_blank" class="text-gray-400 hover:text-blue-700 transition transform hover:scale-110"><i class="fab fa-linkedin text-lg"></i></a>
                                        <?php endif; ?>
                                        <?php if (!empty($pic['link_instagram'])): ?>
                                            <a href="<?php echo h($pic['link_instagram']); ?>" target="_blank" class="text-gray-400 hover:text-pink-600 transition transform hover:scale-110"><i class="fab fa-instagram text-lg"></i></a>
                                        <?php endif; ?>
                                        <?php if (!empty($pic['link_github'])): ?>
                                            <a href="<?php echo h($pic['link_github']); ?>" target="_blank" class="text-gray-400 hover:text-gray-900 transition transform hover:scale-110"><i class="fab fa-github text-lg"></i></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <section class="py-20 bg-gray-50 border-t border-gray-200">
            <div class="container mx-auto px-4 text-center reveal">
                <h3 class="text-3xl font-extrabold text-gray-900 mb-12">Partner & Kolaborasi</h3>
                
                <div class="flex flex-wrap justify-center items-center gap-8 max-w-5xl mx-auto">
                    <?php if (!empty($partner)): ?>
                        <?php foreach ($partner as $p): ?>
                            <div class="group relative w-36 h-24 bg-white rounded-2xl shadow-sm border border-gray-200 flex items-center justify-center p-4 hover:shadow-xl hover:border-orange-300 transition-all duration-300 transform hover:scale-110 cursor-pointer">
                                
                                <div class="absolute inset-0 bg-orange-50 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                                <?php 
                                    $imgPartner = basename($p['gambar_brand'] ?? '');
                                    $partnerPath = 'assets/images/uploads/' . $imgPartner;
                                ?>
                                <img src="<?php echo assetUrl($partnerPath); ?>" 
                                     alt="<?php echo h($p['nama_brand']); ?>" 
                                     class="relative z-10 max-h-full max-w-full object-contain filter transition-all duration-500"
                                     onerror="this.style.display='none';">
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-gray-400 font-medium italic">Data partner belum tersedia.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>

    </main>
    
    <?php include __DIR__ . '/../layouts/footer.php';?>

    <script>
        const reveals = document.querySelectorAll('.reveal');
        const revealOnScroll = () => {
            const windowHeight = window.innerHeight;
            const elementVisible = 100;
            reveals.forEach((reveal) => {
                const elementTop = reveal.getBoundingClientRect().top;
                if (elementTop < windowHeight - elementVisible) reveal.classList.add('active');
            });
        };
        window.addEventListener('scroll', revealOnScroll);
        revealOnScroll();

        const slider = document.getElementById('dosenSlider');
        const leftBtn = document.getElementById('scrollLeft');
        const rightBtn = document.getElementById('scrollRight');
        if(slider && leftBtn && rightBtn) {
            leftBtn.addEventListener('click', () => { slider.scrollBy({ left: -300, behavior: 'smooth' }); });
            rightBtn.addEventListener('click', () => { slider.scrollBy({ left: 300, behavior: 'smooth' }); });
        }
    </script>
</body>
</html>