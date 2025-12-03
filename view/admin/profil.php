<?php
// view/admin/profil.php

// --- PENGAMAN VARIABEL ---
$deskripsi = $deskripsi ?? [];
$visi = $visi ?? [];
$misi = $misi ?? [];
$sejarah = $sejarah ?? [];
$nilai = $nilai ?? [];
$struktur = $struktur ?? [];
$partner = $partner ?? [];
?>

<div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
            <span class="w-3 h-8 bg-gradient-to-b from-blue-500 to-indigo-600 rounded-full"></span>
            Kelola Profil Lab
        </h1>
        <p class="text-gray-500 text-sm mt-2 ml-6">Atur informasi identitas, visi misi, dan sejarah laboratorium.</p>
    </div>
</div>

<div class="space-y-10 pb-20">

    <section class="bg-white rounded-[2rem] shadow-xl shadow-gray-100/50 border border-gray-100 p-8 relative overflow-hidden group hover:shadow-2xl transition duration-500">
        <div class="absolute top-0 right-0 w-64 h-64 bg-blue-50 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 opacity-50 pointer-events-none"></div>
        
        <div class="relative z-10">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-extrabold text-gray-800 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">
                        <i class="fas fa-info-circle text-lg"></i>
                    </div>
                    Tentang Lab
                </h2>
                <button onclick="openModal('modalDeskripsi')" class="group flex items-center gap-2 px-4 py-2 rounded-xl bg-gray-50 text-gray-600 font-bold text-xs hover:bg-blue-50 hover:text-blue-600 transition border border-gray-200 hover:border-blue-200">
                    <i class="fas fa-pen group-hover:rotate-12 transition"></i> Edit
                </button>
            </div>
            
            <div class="bg-gray-50/50 p-6 rounded-2xl border border-gray-100">
                <p class="text-gray-600 leading-relaxed text-justify">
                    <?= nl2br(htmlspecialchars($deskripsi['isi_deskripsi'] ?? 'Belum ada deskripsi yang diatur.')) ?>
                </p>
            </div>
        </div>
    </section>

    <section class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-white rounded-[2rem] shadow-lg border border-gray-100 p-8 relative overflow-hidden flex flex-col h-full hover:-translate-y-1 transition duration-300">
            <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-50 rounded-full blur-2xl translate-x-1/2 -translate-y-1/2 opacity-60"></div>
            
            <div class="flex justify-between items-start mb-6 relative z-10">
                <div class="w-12 h-12 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center shadow-sm">
                    <i class="fas fa-eye text-xl"></i>
                </div>
                <button onclick="openModal('modalVisi')" class="w-8 h-8 rounded-lg bg-gray-50 hover:bg-indigo-50 text-gray-400 hover:text-indigo-600 flex items-center justify-center transition">
                    <i class="fas fa-pen text-xs"></i>
                </button>
            </div>
            
            <h3 class="text-lg font-extrabold text-gray-800 mb-4">Visi</h3>
            <div class="flex-1 bg-indigo-50/30 rounded-xl p-5 border border-indigo-50">
                <p class="text-gray-600 italic text-sm leading-relaxed font-medium">
                    "<?= htmlspecialchars($visi['isi_visi'] ?? 'Visi belum diatur.') ?>"
                </p>
            </div>
        </div>

        <div class="bg-white rounded-[2rem] shadow-lg border border-gray-100 p-8 relative overflow-hidden flex flex-col h-full hover:-translate-y-1 transition duration-300">
            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-full blur-2xl translate-x-1/2 -translate-y-1/2 opacity-60"></div>
            
            <div class="flex justify-between items-start mb-6 relative z-10">
                <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center shadow-sm">
                    <i class="fas fa-bullseye text-xl"></i>
                </div>
                <button onclick="openModal('modalMisi')" class="w-8 h-8 rounded-lg bg-gray-50 hover:bg-emerald-50 text-gray-400 hover:text-emerald-600 flex items-center justify-center transition">
                    <i class="fas fa-pen text-xs"></i>
                </button>
            </div>
            
            <h3 class="text-lg font-extrabold text-gray-800 mb-4">Misi</h3>
            <div class="flex-1 bg-emerald-50/30 rounded-xl p-5 border border-emerald-50">
                <p class="text-gray-600 italic text-sm leading-relaxed font-medium">
                    "<?= htmlspecialchars($misi['isi_misi'] ?? 'Misi belum diatur.') ?>"
                </p>
            </div>
        </div>
    </section>

    <section class="bg-white rounded-[2rem] shadow-xl border border-gray-100 p-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-xl font-extrabold text-gray-800 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center">
                    <i class="fas fa-history text-lg"></i>
                </div>
                Sejarah & Timeline
            </h2>
            <button onclick="openModal('modalSejarah')" class="bg-orange-600 text-white px-5 py-2.5 rounded-xl text-xs font-bold hover:bg-orange-700 transition shadow-lg shadow-orange-500/30 flex items-center gap-2">
                <i class="fas fa-plus"></i> Peristiwa
            </button>
        </div>

        <div class="relative pl-8 border-l-2 border-orange-100 space-y-8 py-2">
            <?php if(!empty($sejarah)): ?>
                <?php foreach($sejarah as $sj): ?>
                <div class="relative group">
                    <span class="absolute -left-[41px] top-5 w-5 h-5 rounded-full bg-white border-4 border-orange-200 group-hover:border-orange-500 group-hover:scale-110 transition-all duration-300"></span>
                    
                    <div class="bg-gray-50 hover:bg-orange-50/40 p-5 rounded-2xl border border-gray-100 hover:border-orange-200 transition duration-300 flex justify-between items-start gap-4">
                        <div>
                            <span class="inline-block bg-orange-100 text-orange-700 text-[10px] font-extrabold px-3 py-1 rounded-full mb-2 shadow-sm">
                                TAHUN <?= htmlspecialchars($sj['tahun'] ?? '-') ?>
                            </span>
                            <h4 class="text-lg font-bold text-gray-800 mb-1"><?= htmlspecialchars($sj['judul'] ?? '') ?></h4>
                            <p class="text-gray-500 text-sm leading-relaxed"><?= htmlspecialchars($sj['isi'] ?? '') ?></p>
                        </div>
                        <div class="flex flex-col gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <button onclick='editSejarah(<?= json_encode($sj) ?>)' class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-gray-200 text-blue-500 hover:bg-blue-50 hover:border-blue-200 transition shadow-sm">
                                <i class="fas fa-pen text-xs"></i>
                            </button>
                            <a href="dashboard.php?page=delete_sejarah&id=<?= $sj['id'] ?>" onclick="return confirm('Hapus peristiwa ini?')" class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-gray-200 text-red-500 hover:bg-red-50 hover:border-red-200 transition shadow-sm">
                                <i class="fas fa-trash text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center py-8 text-gray-400 text-sm italic bg-gray-50 rounded-xl border border-dashed border-gray-200">
                    Belum ada data sejarah yang ditambahkan.
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section>
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-extrabold text-gray-800 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center">
                    <i class="fas fa-lightbulb text-lg"></i>
                </div>
                Nilai Inti
            </h2>
            <button onclick="openModal('modalNilai')" class="bg-purple-600 text-white px-5 py-2.5 rounded-xl text-xs font-bold hover:bg-purple-700 transition shadow-lg shadow-purple-500/30 flex items-center gap-2">
                <i class="fas fa-plus"></i> Nilai Baru
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php if(!empty($nilai)): ?>
                <?php foreach($nilai as $nl): ?>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 text-center group hover:shadow-lg hover:-translate-y-1 hover:border-purple-200 transition duration-300 relative">
                    
                    <div class="w-16 h-16 bg-purple-50 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:rotate-6 transition duration-300 shadow-inner">
                        <?php $icon = "../../assets/images/uploads/" . ($nl['gambar_nilai'] ?? 'default.png'); ?>
                        <img src="<?= $icon ?>" class="w-8 h-8 object-contain" onerror="this.src='https://via.placeholder.com/50'">
                    </div>
                    
                    <h3 class="font-bold text-gray-800 text-lg"><?= htmlspecialchars($nl['judul'] ?? '') ?></h3>
                    <p class="text-xs text-gray-500 mt-2 leading-relaxed px-2"><?= htmlspecialchars($nl['deskripsi'] ?? '') ?></p>
                    
                    <div class="absolute top-3 right-3 flex gap-1 opacity-0 group-hover:opacity-100 transition duration-200">
                        <button onclick='editNilai(<?= json_encode($nl) ?>)' class="p-1.5 bg-white rounded-lg border border-gray-200 text-blue-500 hover:text-blue-700 shadow-sm"><i class="fas fa-pen text-[10px]"></i></button>
                        <a href="dashboard.php?page=delete_nilai&id=<?= $nl['id'] ?>" onclick="return confirm('Hapus?')" class="p-1.5 bg-white rounded-lg border border-gray-200 text-red-500 hover:text-red-700 shadow-sm"><i class="fas fa-trash text-[10px]"></i></a>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-3 text-center py-10 bg-gray-50 rounded-xl border border-dashed border-gray-200 text-gray-400">Belum ada nilai inti.</div>
            <?php endif; ?>
        </div>
    </section>

    <section class="bg-white rounded-[2rem] shadow-xl border border-gray-100 p-8 overflow-hidden">
        <h2 class="text-xl font-extrabold text-gray-800 mb-6 flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-teal-100 text-teal-600 flex items-center justify-center">
                <i class="fas fa-sitemap text-lg"></i>
            </div>
            Struktur Organisasi
        </h2>
        
        <?php 
            $imgName = $struktur['gambar_organisasi'] ?? '';
            $pathBrowser = "../../assets/images/uploads/" . $imgName;
            $isAdaGambar = !empty($imgName);
        ?>

        <form action="dashboard.php?page=update_struktur" method="POST" enctype="multipart/form-data" class="relative group w-full">
            <?php if ($isAdaGambar): ?>
                <div class="relative rounded-2xl overflow-hidden border-2 border-gray-100 bg-gray-50 p-2">
                    <img src="<?= $pathBrowser ?>" alt="Struktur Organisasi" class="w-full h-auto object-contain max-h-[500px] rounded-xl">
                    
                    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                        <i class="fas fa-cloud-upload-alt text-4xl text-white mb-3"></i>
                        <p class="text-white font-bold mb-4">Ubah Struktur Organisasi</p>
                        
                        <label class="cursor-pointer bg-white text-gray-800 px-6 py-2.5 rounded-full font-bold text-sm shadow-lg hover:bg-gray-100 transition transform hover:scale-105">
                            Pilih File Baru
                            <input type="file" name="gambar" class="hidden" onchange="this.form.submit()">
                        </label>
                    </div>
                </div>
            <?php else: ?>
                <label class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-3xl cursor-pointer bg-gray-50 hover:bg-teal-50 hover:border-teal-300 transition duration-300 group">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-sm mb-3 group-hover:scale-110 transition">
                            <i class="fas fa-image text-3xl text-gray-400 group-hover:text-teal-500"></i>
                        </div>
                        <p class="mb-1 text-sm text-gray-500 font-bold group-hover:text-teal-600">Klik untuk upload Struktur Organisasi</p>
                        <p class="text-xs text-gray-400">Format: JPG, PNG (Max. 2MB)</p>
                    </div>
                    <input type="file" name="gambar" class="hidden" onchange="this.form.submit()">
                </label>
            <?php endif; ?>
        </form>
    </section>

    <section>
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-extrabold text-gray-800 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-pink-100 text-pink-600 flex items-center justify-center">
                    <i class="fas fa-handshake text-lg"></i>
                </div>
                Partner & Kolaborasi
            </h2>
            <button onclick="openModal('modalPartner')" class="bg-pink-600 text-white px-5 py-2.5 rounded-xl text-xs font-bold hover:bg-pink-700 transition shadow-lg shadow-pink-500/30 flex items-center gap-2">
                <i class="fas fa-plus"></i> Partner
            </button>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            <?php if(!empty($partner)): ?>
                <?php foreach($partner as $pt): ?>
                <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center justify-center gap-3 group hover:border-pink-300 hover:shadow-md transition relative h-36">
                    
                    <div class="flex-1 flex items-center justify-center w-full px-2">
                        <img src="../../assets/images/uploads/<?= $pt['gambar_brand'] ?? 'default.png' ?>" class="max-h-16 w-auto object-contain grayscale group-hover:grayscale-0 group-hover:scale-110 transition duration-300">
                    </div>
                    
                    <h4 class="font-bold text-gray-600 text-[10px] uppercase tracking-wider group-hover:text-pink-600 transition"><?= htmlspecialchars($pt['nama_brand'] ?? '') ?></h4>
                    
                    <div class="absolute top-2 right-2 flex gap-1 opacity-0 group-hover:opacity-100 transition duration-200">
                        <button onclick='editPartner(<?= json_encode($pt) ?>)' class="w-6 h-6 flex items-center justify-center rounded bg-gray-100 hover:text-blue-600 text-[10px]"><i class="fas fa-pen"></i></button>
                        <a href="dashboard.php?page=delete_partner&id=<?= $pt['id'] ?>" onclick="return confirm('Hapus?')" class="w-6 h-6 flex items-center justify-center rounded bg-gray-100 hover:text-red-600 text-[10px]"><i class="fas fa-trash"></i></a>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-5 text-center py-10 bg-gray-50 rounded-xl border border-dashed border-gray-200 text-gray-400">Belum ada partner.</div>
            <?php endif; ?>
        </div>
    </section>

</div>

<dialog id="modalDeskripsi" class="rounded-3xl w-full max-w-lg shadow-2xl backdrop:bg-black/60 p-0 bg-transparent">
    <form action="dashboard.php?page=update_deskripsi" method="POST" class="bg-white p-8 rounded-3xl relative">
        <h3 class="text-xl font-bold mb-4 text-gray-800">Edit Tentang Lab</h3>
        <textarea name="isi_deskripsi" rows="8" class="w-full bg-gray-50 border border-gray-200 p-4 rounded-2xl mb-6 text-sm focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition resize-none text-gray-700 leading-relaxed" placeholder="Tulis deskripsi..."><?= htmlspecialchars($deskripsi['isi_deskripsi'] ?? '') ?></textarea>
        <div class="flex justify-end gap-3">
            <button type="button" onclick="closeModal('modalDeskripsi')" class="px-5 py-2.5 text-gray-500 text-sm hover:bg-gray-100 rounded-xl font-bold transition">Batal</button>
            <button class="bg-blue-600 text-white px-6 py-2.5 rounded-xl text-sm font-bold shadow-lg hover:bg-blue-700 transition">Simpan Perubahan</button>
        </div>
    </form>
</dialog>

<dialog id="modalVisi" class="rounded-3xl w-full max-w-lg shadow-2xl backdrop:bg-black/60 p-0 bg-transparent">
    <form action="dashboard.php?page=update_visi_misi" method="POST" class="bg-white p-8 rounded-3xl">
        <h3 class="text-xl font-bold mb-4 text-gray-800">Edit Visi</h3>
        <textarea name="visi" rows="5" class="w-full bg-gray-50 border border-gray-200 p-4 rounded-2xl mb-6 text-sm focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition resize-none"><?= htmlspecialchars($visi['isi_visi'] ?? '') ?></textarea>
        <div class="flex justify-end gap-3">
            <button type="button" onclick="closeModal('modalVisi')" class="px-5 py-2.5 text-gray-500 text-sm font-bold hover:bg-gray-100 rounded-xl transition">Batal</button>
            <button class="bg-indigo-600 text-white px-6 py-2.5 rounded-xl text-sm font-bold shadow-lg hover:bg-indigo-700 transition">Simpan</button>
        </div>
    </form>
</dialog>

<dialog id="modalMisi" class="rounded-3xl w-full max-w-lg shadow-2xl backdrop:bg-black/60 p-0 bg-transparent">
    <form action="dashboard.php?page=update_visi_misi" method="POST" class="bg-white p-8 rounded-3xl">
        <h3 class="text-xl font-bold mb-4 text-gray-800">Edit Misi</h3>
        <textarea name="misi" rows="5" class="w-full bg-gray-50 border border-gray-200 p-4 rounded-2xl mb-6 text-sm focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition resize-none"><?= htmlspecialchars($misi['isi_misi'] ?? '') ?></textarea>
        <div class="flex justify-end gap-3">
            <button type="button" onclick="closeModal('modalMisi')" class="px-5 py-2.5 text-gray-500 text-sm font-bold hover:bg-gray-100 rounded-xl transition">Batal</button>
            <button class="bg-emerald-600 text-white px-6 py-2.5 rounded-xl text-sm font-bold shadow-lg hover:bg-emerald-700 transition">Simpan</button>
        </div>
    </form>
</dialog>

<dialog id="modalSejarah" class="rounded-3xl w-full max-w-lg shadow-2xl backdrop:bg-black/60 p-0 bg-transparent">
    <form action="dashboard.php?page=save_sejarah" method="POST" class="bg-white p-8 rounded-3xl">
        <input type="hidden" name="id" id="sejarahId">
        <h3 class="text-xl font-bold mb-6 text-gray-800" id="sejarahTitle">Tambah Sejarah</h3>
        
        <div class="space-y-4 mb-6">
            <div class="flex gap-4">
                <div class="w-1/3">
                    <label class="block text-xs font-bold text-gray-500 mb-1 ml-1">Tahun</label>
                    <input type="text" name="tahun" id="sejarahTahun" placeholder="2024" class="w-full bg-gray-50 border border-gray-200 p-3 rounded-xl text-sm font-mono focus:border-orange-500 focus:ring-2 focus:ring-orange-100 outline-none transition text-center font-bold">
                </div>
                <div class="w-2/3">
                    <label class="block text-xs font-bold text-gray-500 mb-1 ml-1">Judul Peristiwa</label>
                    <input type="text" name="judul" id="sejarahJudul" placeholder="Contoh: Pendirian Lab" class="w-full bg-gray-50 border border-gray-200 p-3 rounded-xl text-sm font-bold focus:border-orange-500 focus:ring-2 focus:ring-orange-100 outline-none transition">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-500 mb-1 ml-1">Deskripsi Singkat</label>
                <textarea name="isi" id="sejarahIsi" rows="4" class="w-full bg-gray-50 border border-gray-200 p-3 rounded-xl mb-1 text-sm focus:border-orange-500 focus:ring-2 focus:ring-orange-100 outline-none resize-none" placeholder="Jelaskan peristiwa tersebut..."></textarea>
            </div>
        </div>

        <div class="flex justify-end gap-3">
            <button type="button" onclick="closeModal('modalSejarah')" class="px-5 py-2.5 text-gray-500 text-sm font-bold hover:bg-gray-100 rounded-xl transition">Batal</button>
            <button class="bg-orange-600 text-white px-6 py-2.5 rounded-xl text-sm font-bold shadow-lg hover:bg-orange-700 transition">Simpan</button>
        </div>
    </form>
</dialog>

<dialog id="modalNilai" class="rounded-3xl w-full max-w-lg shadow-2xl backdrop:bg-black/60 p-0 bg-transparent">
    <form action="dashboard.php?page=save_nilai" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-3xl">
        <input type="hidden" name="id" id="nilaiId">
        <input type="hidden" name="gambar_lama" id="nilaiGambarLama">
        <h3 class="text-xl font-bold mb-6 text-gray-800" id="nilaiTitle">Kelola Nilai Inti</h3>
        
        <div class="bg-purple-50 border-2 border-dashed border-purple-200 p-6 rounded-2xl text-center mb-6 hover:bg-purple-100 transition cursor-pointer group relative">
            <div class="mb-2 text-purple-400 group-hover:text-purple-600 transition"><i class="fas fa-cloud-upload-alt text-3xl"></i></div>
            <p class="text-xs text-gray-600 font-bold mb-1">Upload Icon (PNG/SVG)</p>
            <input type="file" name="gambar" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
        </div>

        <div class="space-y-4 mb-6">
            <input type="text" name="judul" id="nilaiJudul" placeholder="Judul Nilai (ex: Kreativitas)" class="w-full bg-gray-50 border border-gray-200 p-3.5 rounded-xl text-sm font-bold focus:border-purple-500 focus:ring-2 focus:ring-purple-100 outline-none transition">
            <input type="text" name="deskripsi" id="nilaiDeskripsi" placeholder="Deskripsi singkat..." class="w-full bg-gray-50 border border-gray-200 p-3.5 rounded-xl text-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-100 outline-none transition">
        </div>
        
        <div class="flex justify-end gap-3">
            <button type="button" onclick="closeModal('modalNilai')" class="px-5 py-2.5 text-gray-500 text-sm font-bold hover:bg-gray-100 rounded-xl transition">Batal</button>
            <button class="bg-purple-600 text-white px-6 py-2.5 rounded-xl text-sm font-bold shadow-lg hover:bg-purple-700 transition">Simpan</button>
        </div>
    </form>
</dialog>

<dialog id="modalPartner" class="rounded-3xl w-full max-w-lg shadow-2xl backdrop:bg-black/60 p-0 bg-transparent">
    <form action="dashboard.php?page=save_partner" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-3xl">
        <input type="hidden" name="id" id="partnerId">
        <input type="hidden" name="gambar_lama" id="partnerGambarLama">
        <h3 class="text-xl font-bold mb-6 text-gray-800" id="partnerTitle">Kelola Partner</h3>
        
        <div class="bg-pink-50 border-2 border-dashed border-pink-200 p-6 rounded-2xl text-center mb-6 hover:bg-pink-100 transition cursor-pointer relative group">
            <div class="mb-2 text-pink-400 group-hover:text-pink-600 transition"><i class="fas fa-image text-3xl"></i></div>
            <p class="text-xs text-gray-600 font-bold mb-1">Upload Logo Partner</p>
            <input type="file" name="gambar" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
        </div>

        <input type="text" name="nama_brand" id="partnerNama" placeholder="Nama Brand (ex: Google)" class="w-full bg-gray-50 border border-gray-200 p-3.5 rounded-xl mb-6 text-sm font-bold focus:border-pink-500 focus:ring-2 focus:ring-pink-100 outline-none transition">
        
        <div class="flex justify-end gap-3">
            <button type="button" onclick="closeModal('modalPartner')" class="px-5 py-2.5 text-gray-500 text-sm font-bold hover:bg-gray-100 rounded-xl transition">Batal</button>
            <button class="bg-pink-600 text-white px-6 py-2.5 rounded-xl text-sm font-bold shadow-lg hover:bg-pink-700 transition">Simpan</button>
        </div>
    </form>
</dialog>

<script>
    function openModal(id) { document.getElementById(id).showModal(); }
    function closeModal(id) { document.getElementById(id).close(); }

    function editSejarah(data) {
        document.getElementById('sejarahId').value = data.id;
        document.getElementById('sejarahTahun').value = data.tahun;
        document.getElementById('sejarahJudul').value = data.judul;
        document.getElementById('sejarahIsi').value = data.isi;
        document.getElementById('sejarahTitle').innerText = 'Edit Sejarah';
        openModal('modalSejarah');
    }

    function editNilai(data) {
        document.getElementById('nilaiId').value = data.id;
        document.getElementById('nilaiGambarLama').value = data.gambar_nilai;
        document.getElementById('nilaiJudul').value = data.judul;
        document.getElementById('nilaiDeskripsi').value = data.deskripsi;
        document.getElementById('nilaiTitle').innerText = 'Edit Nilai Inti';
        openModal('modalNilai');
    }

    function editPartner(data) {
        document.getElementById('partnerId').value = data.id;
        document.getElementById('partnerGambarLama').value = data.gambar_brand;
        document.getElementById('partnerNama').value = data.nama_brand;
        document.getElementById('partnerTitle').innerText = 'Edit Partner';
        openModal('modalPartner');
    }
</script>