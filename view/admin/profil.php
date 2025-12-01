<?php
// view/admin/profil.php

// --- PENGAMAN VARIABEL (Agar tidak error Undefined/Null) ---
$deskripsi = $deskripsi ?? [];
$visi = $visi ?? [];
$misi = $misi ?? [];
$sejarah = $sejarah ?? [];
$nilai = $nilai ?? [];
$struktur = $struktur ?? [];
$partner = $partner ?? [];
?>

<div class="max-w-7xl mx-auto space-y-12 pb-24">
    
    <div class="flex justify-between items-end border-b border-gray-100 pb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Kelola Profil</h1>
            <p class="text-sm text-gray-500 mt-1">Atur informasi halaman profil laboratorium</p>
        </div>
    </div>

    <section class="relative">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                <i class="fas fa-info-circle text-orange-500"></i> Tentang Lab
            </h2>
            <button onclick="openModal('modalDeskripsi')" class="text-sm text-orange-600 hover:text-orange-700 font-medium bg-orange-50 px-3 py-1.5 rounded-lg transition">
                <i class="fas fa-pen mr-1"></i> Edit
            </button>
        </div>
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
            <p class="text-gray-600 leading-relaxed text-justify">
                <?= nl2br(htmlspecialchars($deskripsi['isi_deskripsi'] ?? 'Belum ada deskripsi.')) ?>
            </p>
        </div>
    </section>

    <section class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex flex-col h-full relative group">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 bg-blue-50 rounded-full flex items-center justify-center text-blue-600 mb-2">
                    <i class="fas fa-eye"></i>
                </div>
                <button onclick="openModal('modalVisi')" class="text-gray-400 hover:text-blue-600 transition"><i class="fas fa-pen"></i></button>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-3">Visi</h3>
            <p class="text-gray-600 italic text-sm leading-relaxed">
                "<?= htmlspecialchars($visi['isi_visi'] ?? '-') ?>"
            </p>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex flex-col h-full relative group">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 bg-green-50 rounded-full flex items-center justify-center text-green-600 mb-2">
                    <i class="fas fa-bullseye"></i>
                </div>
                <button onclick="openModal('modalMisi')" class="text-gray-400 hover:text-green-600 transition"><i class="fas fa-pen"></i></button>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-3">Misi</h3>
            <p class="text-gray-600 italic text-sm leading-relaxed">
                "<?= htmlspecialchars($misi['isi_misi'] ?? '-') ?>"
            </p>
        </div>
    </section>

    <section>
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                <i class="fas fa-history text-orange-500"></i> Sejarah
            </h2>
            <button onclick="openModal('modalSejarah')" class="bg-gray-900 text-white px-4 py-2 rounded-lg text-xs font-semibold hover:bg-orange-600 transition shadow-md">
                + Tambah
            </button>
        </div>

        <div class="space-y-8 border-l-2 border-gray-100 ml-3 pl-8 relative py-2">
            <?php if(!empty($sejarah)): ?>
                <?php foreach($sejarah as $sj): ?>
                <div class="relative group">
                    <span class="absolute -left-[41px] top-1.5 w-5 h-5 rounded-full bg-white border-4 border-orange-200 group-hover:border-orange-500 transition-colors"></span>
                    
                    <div class="flex justify-between items-start bg-white p-5 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition">
                        <div>
                            <span class="inline-block bg-orange-50 text-orange-700 text-xs font-bold px-2 py-1 rounded mb-2">
                                <?= htmlspecialchars($sj['tahun'] ?? '') ?>
                            </span>
                            <h4 class="text-base font-bold text-gray-800"><?= htmlspecialchars($sj['judul'] ?? '') ?></h4>
                            <p class="text-gray-500 text-sm mt-2 leading-relaxed"><?= htmlspecialchars($sj['isi'] ?? '') ?></p>
                        </div>
                        <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition">
                            <button onclick='editSejarah(<?= json_encode($sj) ?>)' class="text-gray-400 hover:text-blue-500 p-1"><i class="fas fa-pen"></i></button>
                            <a href="dashboard.php?page=delete_sejarah&id=<?= $sj['id'] ?>" onclick="return confirm('Hapus?')" class="text-gray-400 hover:text-red-500 p-1"><i class="fas fa-trash"></i></a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-gray-400 text-sm italic">Belum ada data sejarah.</p>
            <?php endif; ?>
        </div>
    </section>

    <section>
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                <i class="fas fa-lightbulb text-orange-500"></i> Nilai Inti
            </h2>
            <button onclick="openModal('modalNilai')" class="bg-gray-900 text-white px-4 py-2 rounded-lg text-xs font-semibold hover:bg-orange-600 transition shadow-md">
                + Tambah
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php if(!empty($nilai)): ?>
                <?php foreach($nilai as $nl): ?>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 text-center group hover:border-orange-200 transition relative">
                    
                    <div class="w-14 h-14 bg-orange-50 rounded-2xl flex items-center justify-center mx-auto mb-4 rotate-3 group-hover:rotate-0 transition">
                        <?php $icon = "../../assets/images/uploads/" . ($nl['gambar_nilai'] ?? 'default.png'); ?>
                        <img src="<?= $icon ?>" class="w-7 h-7 object-contain" onerror="this.src='https://via.placeholder.com/50'">
                    </div>
                    
                    <h3 class="font-bold text-gray-800"><?= htmlspecialchars($nl['judul'] ?? '') ?></h3>
                    <p class="text-xs text-gray-500 mt-2 leading-relaxed"><?= htmlspecialchars($nl['deskripsi'] ?? '') ?></p>
                    
                    <div class="absolute top-2 right-2 flex gap-1 opacity-0 group-hover:opacity-100 transition">
                        <button onclick='editNilai(<?= json_encode($nl) ?>)' class="bg-white p-1.5 rounded shadow-sm text-xs hover:text-blue-600"><i class="fas fa-pen"></i></button>
                        <a href="dashboard.php?page=delete_nilai&id=<?= $nl['id'] ?>" onclick="return confirm('Hapus?')" class="bg-white p-1.5 rounded shadow-sm text-xs hover:text-red-600"><i class="fas fa-trash"></i></a>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-3 text-center text-gray-400 text-sm italic py-8 bg-gray-50 rounded-xl border border-dashed">Belum ada data nilai inti.</div>
            <?php endif; ?>
        </div>
    </section>

    <section>
        <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fas fa-sitemap text-orange-500"></i> Struktur Organisasi
        </h2>
        
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
            
            <?php 
                // Cek apakah gambar ada di database & file fisiknya ada
                $imgName = $struktur['gambar_organisasi'] ?? '';
                $pathFisik = __DIR__ . '/../../assets/images/uploads/' . $imgName;
                $pathBrowser = "../../assets/images/uploads/" . $imgName;
                $isAdaGambar = !empty($imgName) && file_exists($pathFisik);
            ?>

            <form action="dashboard.php?page=update_struktur" method="POST" enctype="multipart/form-data" class="relative group w-full">
                
                <?php if ($isAdaGambar): ?>
                    <div class="relative rounded-xl overflow-hidden border border-gray-200">
                        <img src="<?= $pathBrowser ?>" alt="Struktur Organisasi" class="w-full object-contain max-h-[500px]">
                        
                        <div class="absolute inset-0 bg-black/60 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                            <i class="fas fa-cloud-upload-alt text-4xl text-white mb-2"></i>
                            <p class="text-white font-bold mb-4">Ganti Gambar Struktur</p>
                            
                            <label class="cursor-pointer bg-orange-600 hover:bg-orange-700 text-white px-6 py-2 rounded-full font-bold text-sm shadow-lg transition transform hover:-translate-y-1">
                                Pilih File Baru
                                <input type="file" name="gambar" class="hidden" onchange="this.form.submit()">
                            </label>
                        </div>
                    </div>
                
                <?php else: ?>
                    <label class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-2xl cursor-pointer bg-gray-50 hover:bg-orange-50 hover:border-orange-300 transition duration-300 group">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-sm mb-3 group-hover:scale-110 transition">
                                <i class="fas fa-image text-3xl text-gray-400 group-hover:text-orange-500"></i>
                            </div>
                            <p class="mb-1 text-sm text-gray-500 font-bold group-hover:text-orange-600">Klik untuk upload Struktur Organisasi</p>
                            <p class="text-xs text-gray-400">Format: JPG, PNG (Max. 2MB)</p>
                        </div>
                        <input type="file" name="gambar" class="hidden" onchange="this.form.submit()">
                    </label>
                <?php endif; ?>

            </form>
        </div>
    </section>

    <section>
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                <i class="fas fa-handshake text-orange-500"></i> Partner & Kolaborasi
            </h2>
            <button onclick="openModal('modalPartner')" class="bg-gray-900 text-white px-4 py-2 rounded-lg text-xs font-semibold hover:bg-orange-600 transition shadow-md">
                + Tambah
            </button>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            <?php if(!empty($partner)): ?>
                <?php foreach($partner as $pt): ?>
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col items-center justify-center gap-3 group hover:border-orange-300 transition relative h-32">
                    
                    <img src="../../assets/images/uploads/<?= $pt['gambar_brand'] ?? 'default.png' ?>" class="h-12 w-auto object-contain grayscale group-hover:grayscale-0 transition duration-300">
                    
                    <h4 class="font-bold text-gray-700 text-xs uppercase tracking-wider"><?= htmlspecialchars($pt['nama_brand'] ?? '') ?></h4>
                    
                    <div class="absolute top-2 right-2 flex gap-1 opacity-0 group-hover:opacity-100 transition">
                        <button onclick='editPartner(<?= json_encode($pt) ?>)' class="bg-gray-100 p-1 rounded hover:text-blue-600 text-[10px]"><i class="fas fa-pen"></i></button>
                        <a href="dashboard.php?page=delete_partner&id=<?= $pt['id'] ?>" onclick="return confirm('Hapus?')" class="bg-gray-100 p-1 rounded hover:text-red-600 text-[10px]"><i class="fas fa-trash"></i></a>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-5 text-center text-gray-400 text-sm italic py-8 bg-gray-50 rounded-xl border border-dashed">Belum ada partner.</div>
            <?php endif; ?>
        </div>
    </section>

</div>

<dialog id="modalDeskripsi" class="rounded-2xl w-full max-w-lg shadow-2xl backdrop:bg-black/50 p-0 bg-transparent">
    <form action="dashboard.php?page=update_deskripsi" method="POST" class="bg-white p-6 rounded-2xl">
        <h3 class="text-lg font-bold mb-4 text-gray-800">Edit Tentang Lab</h3>
        <textarea name="isi_deskripsi" rows="6" class="w-full border border-gray-200 p-3 rounded-xl mb-4 text-sm focus:outline-none focus:border-orange-500 transition resize-none" placeholder="Tulis deskripsi..."><?= htmlspecialchars($deskripsi['isi_deskripsi'] ?? '') ?></textarea>
        <div class="flex justify-end gap-2">
            <button type="button" onclick="closeModal('modalDeskripsi')" class="px-4 py-2 text-gray-500 text-sm hover:bg-gray-100 rounded-lg font-medium">Batal</button>
            <button class="bg-orange-600 text-white px-6 py-2 rounded-lg text-sm font-bold shadow hover:bg-orange-700 transition">Simpan</button>
        </div>
    </form>
</dialog>

<dialog id="modalVisi" class="rounded-2xl w-full max-w-lg shadow-2xl backdrop:bg-black/50 p-0 bg-transparent">
    <form action="dashboard.php?page=update_visi_misi" method="POST" class="bg-white p-6 rounded-2xl">
        <h3 class="text-lg font-bold mb-4">Edit Visi</h3>
        <textarea name="visi" rows="4" class="w-full border border-gray-200 p-3 rounded-xl mb-4 text-sm focus:outline-none focus:border-orange-500 transition resize-none"><?= htmlspecialchars($visi['isi_visi'] ?? '') ?></textarea>
        <div class="flex justify-end gap-2">
            <button type="button" onclick="closeModal('modalVisi')" class="px-4 py-2 text-gray-500 text-sm font-medium">Batal</button>
            <button class="bg-orange-600 text-white px-6 py-2 rounded-lg text-sm font-bold shadow">Simpan</button>
        </div>
    </form>
</dialog>

<dialog id="modalMisi" class="rounded-2xl w-full max-w-lg shadow-2xl backdrop:bg-black/50 p-0 bg-transparent">
    <form action="dashboard.php?page=update_visi_misi" method="POST" class="bg-white p-6 rounded-2xl">
        <h3 class="text-lg font-bold mb-4">Edit Misi</h3>
        <textarea name="misi" rows="4" class="w-full border border-gray-200 p-3 rounded-xl mb-4 text-sm focus:outline-none focus:border-orange-500 transition resize-none"><?= htmlspecialchars($misi['isi_misi'] ?? '') ?></textarea>
        <div class="flex justify-end gap-2">
            <button type="button" onclick="closeModal('modalMisi')" class="px-4 py-2 text-gray-500 text-sm font-medium">Batal</button>
            <button class="bg-orange-600 text-white px-6 py-2 rounded-lg text-sm font-bold shadow">Simpan</button>
        </div>
    </form>
</dialog>

<dialog id="modalSejarah" class="rounded-2xl w-full max-w-lg shadow-2xl backdrop:bg-black/50 p-0 bg-transparent">
    <form action="dashboard.php?page=save_sejarah" method="POST" class="bg-white p-6 rounded-2xl">
        <input type="hidden" name="id" id="sejarahId">
        <h3 class="text-lg font-bold mb-4" id="sejarahTitle">Tambah Sejarah</h3>
        <div class="flex gap-3 mb-3">
            <input type="text" name="tahun" id="sejarahTahun" placeholder="Tahun" class="w-1/3 border border-gray-200 p-2.5 rounded-xl text-sm font-mono focus:border-orange-500 outline-none">
            <input type="text" name="judul" id="sejarahJudul" placeholder="Judul Peristiwa" class="w-2/3 border border-gray-200 p-2.5 rounded-xl text-sm font-bold focus:border-orange-500 outline-none">
        </div>
        <textarea name="isi" id="sejarahIsi" rows="3" class="w-full border border-gray-200 p-3 rounded-xl mb-4 text-sm focus:border-orange-500 outline-none resize-none" placeholder="Deskripsi singkat..."></textarea>
        <div class="flex justify-end gap-2">
            <button type="button" onclick="closeModal('modalSejarah')" class="px-4 py-2 text-gray-500 text-sm font-medium">Batal</button>
            <button class="bg-orange-600 text-white px-6 py-2 rounded-lg text-sm font-bold shadow">Simpan</button>
        </div>
    </form>
</dialog>

<dialog id="modalNilai" class="rounded-2xl w-full max-w-lg shadow-2xl backdrop:bg-black/50 p-0 bg-transparent">
    <form action="dashboard.php?page=save_nilai" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-2xl">
        <input type="hidden" name="id" id="nilaiId">
        <input type="hidden" name="gambar_lama" id="nilaiGambarLama">
        <h3 class="text-lg font-bold mb-4" id="nilaiTitle">Kelola Nilai Inti</h3>
        
        <div class="bg-gray-50 p-4 rounded-xl text-center mb-4 border border-dashed border-gray-300 hover:bg-orange-50 transition">
            <p class="text-xs text-gray-500 mb-2 font-medium">Upload Icon (PNG/SVG)</p>
            <input type="file" name="gambar" class="text-xs mx-auto text-gray-500 file:mr-2 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-white file:text-orange-600 hover:file:bg-orange-100">
        </div>

        <input type="text" name="judul" id="nilaiJudul" placeholder="Judul Nilai" class="w-full border border-gray-200 p-2.5 rounded-xl mb-3 text-sm font-bold focus:border-orange-500 outline-none">
        <input type="text" name="deskripsi" id="nilaiDeskripsi" placeholder="Deskripsi singkat" class="w-full border border-gray-200 p-2.5 rounded-xl mb-4 text-sm focus:border-orange-500 outline-none">
        
        <div class="flex justify-end gap-2">
            <button type="button" onclick="closeModal('modalNilai')" class="px-4 py-2 text-gray-500 text-sm font-medium">Batal</button>
            <button class="bg-orange-600 text-white px-6 py-2 rounded-lg text-sm font-bold shadow">Simpan</button>
        </div>
    </form>
</dialog>

<dialog id="modalPartner" class="rounded-2xl w-full max-w-lg shadow-2xl backdrop:bg-black/50 p-0 bg-transparent">
    <form action="dashboard.php?page=save_partner" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-2xl">
        <input type="hidden" name="id" id="partnerId">
        <input type="hidden" name="gambar_lama" id="partnerGambarLama">
        <h3 class="text-lg font-bold mb-4" id="partnerTitle">Kelola Partner</h3>
        
        <div class="bg-gray-50 p-4 rounded-xl text-center mb-4 border border-dashed border-gray-300 hover:bg-orange-50 transition">
            <p class="text-xs text-gray-500 mb-2 font-medium">Upload Logo Partner</p>
            <input type="file" name="gambar" class="text-xs mx-auto text-gray-500 file:mr-2 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-white file:text-orange-600 hover:file:bg-orange-100">
        </div>

        <input type="text" name="nama_brand" id="partnerNama" placeholder="Nama Brand (ex: Google)" class="w-full border border-gray-200 p-2.5 rounded-xl mb-4 text-sm font-bold focus:border-orange-500 outline-none">
        
        <div class="flex justify-end gap-2">
            <button type="button" onclick="closeModal('modalPartner')" class="px-4 py-2 text-gray-500 text-sm font-medium">Batal</button>
            <button class="bg-orange-600 text-white px-6 py-2 rounded-lg text-sm font-bold shadow">Simpan</button>
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