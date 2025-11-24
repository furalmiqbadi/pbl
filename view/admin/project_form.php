<?php
include __DIR__ . '/../layouts/header.php';
include __DIR__ . '/../layouts/sidebar.php';

// helper values
$isEdit = !empty($projectItem);
$formAction = $isEdit ? '/admin/project/update?id=' . ($projectItem['id'] ?? '') : '/admin/project/store';
$btnText = $isEdit ? 'Simpan Perubahan' : 'Simpan Proyek';
$thumbSrc = $projectItem['thumbnail_url'] ?? '/mnt/data/ADD Proyek.png'; // sample image path you provided
?>
<main class="ml-64 p-10">
  <div class="max-w-6xl mx-auto">
    <h1 class="text-5xl font-extrabold mb-8">Tambahkan Proyek Baru</h1>

    <div class="bg-white rounded-lg border border-gray-200 p-8">
      <form action="<?= htmlspecialchars($formAction) ?>" method="post" enctype="multipart/form-data" class="space-y-6">
        <!-- Upload area -->
        <div class="border border-dashed rounded-lg p-8 bg-gray-100 flex items-center justify-center">
          <label class="w-full cursor-pointer text-center">
            <input type="file" name="thumbnail" id="thumbnailInput" class="hidden" accept="image/*">
            <div id="thumbPreview" class="w-full h-56 rounded-lg flex items-center justify-center bg-gray-200">
              <img id="thumbImg" src="<?= htmlspecialchars($thumbSrc) ?>" alt="Upload Thumbnail Proyek" class="object-cover w-full h-full rounded-md">
            </div>
            <p class="mt-3 text-gray-600">Upload Thumbnail Proyek</p>
          </label>
        </div>

        <!-- Fields -->
        <div>
          <input name="title" placeholder="Masukan Judul Proyek" value="<?= htmlspecialchars($projectItem['judul'] ?? '') ?>"
            class="w-full py-6 px-6 rounded-lg bg-gray-200 border border-gray-300 text-lg focus:outline-none" required>
        </div>

        <div>
          <input name="team_name" placeholder="Masukan Nama Tim" value="<?= htmlspecialchars($projectItem['tim'] ?? '') ?>"
            class="w-full py-6 px-6 rounded-lg bg-gray-200 border border-gray-300 text-lg focus:outline-none">
        </div>

        <div>
          <textarea name="description" placeholder="Deskripsi Proyek" rows="6"
            class="w-full py-6 px-6 rounded-lg bg-gray-200 border border-gray-300 text-lg focus:outline-none"><?= htmlspecialchars($projectItem['isi_proyek'] ?? '') ?></textarea>
        </div>

        <div class="flex gap-4">
          <button type="submit" class="bg-orange-500 text-white px-8 py-3 rounded-xl font-semibold hover:bg-orange-600 transition">
            <?= $btnText ?>
          </button>
          <a href="/admin/project" class="inline-block px-6 py-3 border border-orange-400 rounded-xl text-orange-600">Batal</a>
        </div>
      </form>
    </div>
  </div>
</main>

<script>
  // preview thumbnail on select (client-side)
  document.getElementById('thumbnailInput')?.addEventListener('change', function(e){
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(ev) {
      const img = document.getElementById('thumbImg');
      img.src = ev.target.result;
      img.classList.remove('hidden');
    };
    reader.readAsDataURL(file);
  });
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
