<?php
// view/admin/project_list.php
// Standalone page: includes header & sidebar markup inline so file bisa dibuka langsung.
// If you have real $projectList from controller, set it before including this page.
// For standalone testing we'll create a dummy list if not provided.

if (!isset($projectList)) {
    // dummy placeholders to match UI layout
    $projectList = [
        ['id'=>1,'judul'=>'Proyek','isi_proyek'=>'Lorem Ipsum','gambar_proyek'=>'/mnt/data/CRUD Proyek.png'],
        ['id'=>2,'judul'=>'Proyek','isi_proyek'=>'Lorem Ipsum','gambar_proyek'=>'/mnt/data/CRUD Proyek.png'],
        ['id'=>3,'judul'=>'Proyek','isi_proyek'=>'Lorem Ipsum','gambar_proyek'=>'/mnt/data/CRUD Proyek.png'],
        ['id'=>4,'judul'=>'Proyek','isi_proyek'=>'Lorem Ipsum','gambar_proyek'=>'/mnt/data/CRUD Proyek.png'],
        ['id'=>5,'judul'=>'Proyek','isi_proyek'=>'Lorem Ipsum','gambar_proyek'=>'/mnt/data/CRUD Proyek.png'],
        ['id'=>6,'judul'=>'Proyek','isi_proyek'=>'Lorem Ipsum','gambar_proyek'=>'/mnt/data/CRUD Proyek.png'],
    ];
}

// Path to logo image if you have one; else keep text
$logoSrc = '.../PBL/assets/images/mmtLogo.png'; // using your uploaded image as logo visually

?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Daftar Proyek - Admin</title>

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    :root{--sidebar-width:220px}
    body{font-family:'Poppins',system-ui,-apple-system,Segoe UI,Roboto,"Helvetica Neue",Arial;}
    .sidebar { width: var(--sidebar-width); position: fixed; left: 0; top: 0; bottom: 0; background:#303336; color:#fff; padding:28px 18px; }
    .sidebar .logo { display:flex; align-items:center; gap:12px; margin-bottom:28px; }
    .sidebar .logo img{ width:64px; height:64px; object-fit:contain; border-radius:8px; }
    .sidebar nav a{ display:block; padding:12px 14px; color:#fff; border-radius:8px; margin-bottom:6px; text-decoration:none; opacity:0.95; }
    .sidebar nav a.active, .sidebar nav a:hover{ background:#515356; opacity:1; }
    main { margin-left: var(--sidebar-width); padding:40px; background:#fff; min-height:100vh; }
    .card { background:#fff; border-radius:12px; padding:28px; border:1px solid #ececec; box-shadow: 0 10px 18px rgba(0,0,0,0.06); height:170px; display:flex; flex-direction:column; justify-content:space-between; }
    .action-btn { width:44px; height:44px; border-radius:9999px; display:inline-flex; align-items:center; justify-content:center; background:#f97316; color:#fff; font-weight:700; }
    .page-title { font-size:48px; font-weight:800; }
    @media (max-width:900px){ .sidebar{position:relative;width:100%;height:auto} main{margin-left:0;padding:20px} }
  </style>
</head>
<body>

  <!-- SIDEBAR (inline so page is standalone) -->
  <aside class="sidebar">
    <div class="logo">
      <img src="<?= htmlspecialchars($logoSrc) ?>" alt="Logo">
      <div>
        <div style="font-weight:800; font-size:14px">LAB MMT</div>
        <div style="font-size:12px; opacity:0.8">Admin Panel</div>
      </div>
    </div>

    <nav>
      <a href="#" class="block hover:bg-gray-700 rounded-md px-3 py-2">Dashboard</a>
      <a href="#" class="active block rounded-md px-3 py-2">Kelola Proyek</a>
      <a href="#" class="block rounded-md px-3 py-2">Kelola Berita</a>
      <a href="#" class="block rounded-md px-3 py-2">Kelola Galeri</a>
      <a href="#" class="block rounded-md px-3 py-2">Profil Lab</a>
      <a href="#" class="block rounded-md px-3 py-2">Pesan Masuk</a>
    </nav>

    <div style="position:absolute; left:18px; bottom:26px;">
      <a href="#" style="color:#fff; text-decoration:underline;">Logout</a>
    </div>
  </aside>

  <!-- MAIN CONTENT -->
  <main>
    <div class="max-w-6xl mx-auto">
      <div class="flex items-center justify-between mb-10">
        <h1 class="page-title">Daftar Proyek</h1>
        <a href="/view/admin/project_form.php" class="bg-orange-500 text-white px-6 py-3 rounded-xl font-semibold hover:bg-orange-600">+ Tambah Proyek Baru</a>
      </div>

      <div class="grid md:grid-cols-2 gap-8">
        <?php foreach ($projectList as $p): ?>
          <div class="card">
            <div>
              <h3 class="text-2xl font-bold mb-2"><?= htmlspecialchars($p['judul']) ?></h3>
              <p class="text-gray-600"><?= htmlspecialchars(mb_strimwidth($p['isi_proyek'] ?? '', 0, 120, '...')) ?></p>
            </div>
            <div class="flex justify-end gap-3">
              <a href="/view/admin/project_form.php?id=<?= $p['id'] ?>" class="action-btn" title="Edit">✎</a>
              <form method="post" action="/admin/project/delete?id=<?= $p['id'] ?>" onsubmit="return confirm('Hapus proyek?');" style="display:inline">
                <button type="submit" class="action-btn" title="Hapus">🗑</button>
              </form>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </main>

</body>
</html>
