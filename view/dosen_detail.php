<?php include __DIR__ . '/../layouts/header.php'; ?>

<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
    /* Reset font agar konsisten */
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
</style>

<main class="min-h-screen bg-gray-50 pt-32 pb-20 relative z-0">
    
    <div class="container mx-auto px-4 max-w-5xl">
        
        <div class="mb-8">
            <a href="index.php?page=about" class="inline-flex items-center gap-2 px-4 py-2 bg-white text-orange-600 font-bold rounded-lg shadow-sm border border-gray-200 hover:bg-orange-50 hover:border-orange-200 transition-all group">
                <i class="fas fa-arrow-left transition-transform group-hover:-translate-x-1"></i>
                Kembali ke Tim
            </a>
        </div>

        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100 relative">
            
            <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-r from-orange-400 to-red-500"></div>

            <div class="flex flex-col md:flex-row relative z-10 pt-10 md:pt-0">
                
                <div class="md:w-1/3 flex flex-col items-center text-center md:pt-20 pb-10 px-6 border-r border-gray-100 bg-white">
                    
                    <div class="relative w-40 h-40 md:w-48 md:h-48 mb-4 -mt-16 md:-mt-0">
                        <div class="w-full h-full rounded-full p-1 bg-white shadow-2xl">
                            <div class="w-full h-full rounded-full overflow-hidden border-4 border-orange-50">
                                <?php 
                                    $imgName = basename($dosen['gambar_tim'] ?? '');
                                    $pathDosen = 'assets/images/uploads/' . $imgName;
                                ?>
                                <img src="<?php echo assetUrl($pathDosen); ?>" 
                                     alt="<?php echo h($dosen['nama']); ?>" 
                                     class="w-full h-full object-cover"
                                     onerror="this.src='https://ui-avatars.com/api/?name=<?php echo urlencode($dosen['nama']); ?>&size=256&background=f97316&color=fff&bold=true';">
                            </div>
                        </div>
                    </div>

                    <h1 class="text-xl md:text-2xl font-extrabold text-gray-800 mb-1 px-2"><?php echo h($dosen['nama']); ?></h1>
                    
                    <span class="inline-block px-4 py-1.5 bg-orange-100 text-orange-700 text-xs font-bold rounded-full tracking-wide uppercase mb-6">
                        <?php echo h($dosen['jabatan']); ?>
                    </span>

                    <div class="w-full space-y-3 px-4">
                        <?php if (!empty($dosen['nidn'])): ?>
                            <div class="flex flex-col bg-gray-50 p-3 rounded-lg border border-gray-100">
                                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">NIDN</span>
                                <span class="font-mono text-gray-700 font-bold tracking-wider"><?php echo h($dosen['nidn']); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($dosen['email'])): ?>
                            <div class="flex flex-col bg-gray-50 p-3 rounded-lg border border-gray-100">
                                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">EMAIL</span>
                                <a href="mailto:<?php echo h($dosen['email']); ?>" class="text-sm text-orange-600 hover:underline break-all font-medium">
                                    <?php echo h($dosen['email']); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="mt-8 flex gap-3">
                        <?php if (!empty($dosen['link_linkedin'])): ?>
                            <a href="<?php echo h($dosen['link_linkedin']); ?>" target="_blank" class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center hover:scale-110 shadow-lg transition"><i class="fab fa-linkedin-in"></i></a>
                        <?php endif; ?>
                        <?php if (!empty($dosen['link_instagram'])): ?>
                            <a href="<?php echo h($dosen['link_instagram']); ?>" target="_blank" class="w-10 h-10 rounded-full bg-pink-600 text-white flex items-center justify-center hover:scale-110 shadow-lg transition"><i class="fab fa-instagram"></i></a>
                        <?php endif; ?>
                        <?php if (!empty($dosen['link_github'])): ?>
                            <a href="<?php echo h($dosen['link_github']); ?>" target="_blank" class="w-10 h-10 rounded-full bg-gray-800 text-white flex items-center justify-center hover:scale-110 shadow-lg transition"><i class="fab fa-github"></i></a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="md:w-2/3 p-8 md:p-12 bg-white">
                    
                    <div class="mb-10">
                        <div class="flex items-center gap-3 mb-4 pb-2 border-b border-gray-100">
                            <span class="text-2xl">📝</span>
                            <h3 class="text-xl font-bold text-gray-800">Biografi Singkat</h3>
                        </div>
                        <div class="text-gray-600 leading-relaxed text-justify bg-orange-50/50 p-6 rounded-2xl border border-orange-100/50">
                            <?php echo nl2br(h($dosen['biografi'] ?? 'Belum ada data biografi.')); ?>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-8">
                        <div>
                            <div class="flex items-center gap-3 mb-4 pb-2 border-b border-gray-100">
                                <span class="text-2xl">🎓</span>
                                <h3 class="text-xl font-bold text-gray-800">Pendidikan</h3>
                            </div>
                            <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm hover:shadow-md transition hover:border-orange-200">
                                <p class="text-gray-800 font-bold text-lg">
                                    <?php echo h($dosen['pendidikan_terakhir'] ?? '-'); ?>
                                </p>
                                <span class="text-xs text-orange-500 font-semibold uppercase mt-1 block tracking-wide">Gelar Terakhir</span>
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center gap-3 mb-4 pb-2 border-b border-gray-100">
                                <span class="text-2xl">💡</span>
                                <h3 class="text-xl font-bold text-gray-800">Bidang Keahlian</h3>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <?php 
                                    if (!empty($dosen['bidang_keahlian'])): 
                                        $skills = explode(',', $dosen['bidang_keahlian']);
                                        foreach ($skills as $skill): 
                                ?>
                                    <span class="px-3 py-1.5 bg-gray-100 text-gray-700 border border-gray-200 rounded-lg text-sm font-semibold shadow-sm hover:bg-orange-50 hover:text-orange-700 hover:border-orange-200 transition cursor-default">
                                        <?php echo h(trim($skill)); ?>
                                    </span>
                                <?php 
                                        endforeach;
                                    else: 
                                ?>
                                    <span class="text-gray-400 text-sm italic">Belum diset.</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</main>

<?php include __DIR__ . '/../layouts/footer.php'; ?>