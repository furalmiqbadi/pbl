<?php
//dummy
$structures = [
    [
        'name' => 'Dimas Wahyu Wibowo',
        'role' => 'Kepala Laboratorium',
        'nip'  => '2949752001',
        'image'=> 'https://ui-avatars.com/api/?name=Dimas+Wahyu&background=CBD5E1&color=fff'
    ],
    [
        'name' => 'Dimas Wahyu Wibowo',
        'role' => 'Kepala Laboratorium',
        'nip'  => '2949752001',
        'image'=> 'https://ui-avatars.com/api/?name=Dimas+Wahyu&background=CBD5E1&color=fff'
    ],
    [
        'name' => 'Dimas Wahyu Wibowo',
        'role' => 'Kepala Laboratorium',
        'nip'  => '2949752001',
        'image'=> 'https://ui-avatars.com/api/?name=Dimas+Wahyu&background=CBD5E1&color=fff'
    ],
];

$creatives = [
    [
        'name' => 'Abdul Ghof',
        'role' => 'UI/UX Designer',
        'tags' => ['Figma', 'Design Thinking'],
        'image'=> 'https://ui-avatars.com/api/?name=Abdul+Ghof&background=E2E8F0&color=64748B'
    ],
    [
        'name' => 'Abdul Muid',
        'role' => 'UI/UX Designer',
        'tags' => ['Figma', 'Design Thinking'],
        'image'=> 'https://ui-avatars.com/api/?name=Abdul+Muid&background=E2E8F0&color=64748B'
    ],
    [
        'name' => 'Arya Bayu',
        'role' => 'UI/UX Designer',
        'tags' => ['Figma', 'Design Thinking'],
        'image'=> 'https://ui-avatars.com/api/?name=Arya+Bayu&background=E2E8F0&color=64748B'
    ],
    [
        'name' => 'Febryan',
        'role' => 'UI/UX Designer',
        'tags' => ['Figma', 'Design Thinking'],
        'image'=> 'https://ui-avatars.com/api/?name=Febryan&background=E2E8F0&color=64748B'
    ],
    [
        'name' => 'Aqil',
        'role' => 'UI/UX Designer',
        'tags' => ['Figma', 'Design Thinking'],
        'image'=> 'https://ui-avatars.com/api/?name=Aqil&background=E2E8F0&color=64748B'
    ],
    [
        'name' => 'Sahrul Ram',
        'role' => 'UI/UX Designer',
        'tags' => ['Figma', 'Design Thinking'],
        'image'=> 'https://ui-avatars.com/api/?name=Sahrul+Ram&background=E2E8F0&color=64748B'
    ],
];

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Lab MMT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-white text-gray-800 about-page">
    <?php include '../layouts/header.php'; ?>

    <style>
        .about-content {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-white text-gray-800">

    <main class="about-content">
    <section class="max-w-6xl mx-auto px-4 py-12 text-center">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Tentang Lab MMT</h1>
        <p class="text-gray-500 text-sm max-w-2xl mx-auto">
            Pusat Inovasi, Kolaborasi, dan pengembangan teknologi kreatif mahasiswa Politeknik Negeri Malang. Kami mengubah ide-ide menjadi karya digital yang nyata.
        </p>
    </section>

    <section class="max-w-6xl mx-auto px-4 mb-16">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white border border-gray-100 shadow-lg rounded-lg p-8">
                <h2 class="text-2xl font-bold text-center mb-4">Visi Kami</h2>
                <p class="text-gray-600 text-sm leading-relaxed text-justify">
                    Lorem ipsum dolor sit amet consectetur. Tincidunt eleifend sed cursus eu lacus. Condimentum a elit quisque eget purus magna faucibus arcu eu. Bibendum lacus quis nisl sociis. In ut ut viverra. Odio nibh lorem molestie i.
                </p>
            </div>
            <div class="bg-white border border-gray-100 shadow-lg rounded-lg p-8">
                <h2 class="text-2xl font-bold text-center mb-4">Misi Kami</h2>
                <ul class="text-gray-600 text-sm space-y-2 list-none pl-4">
                    <li>- Nilai 1</li>
                    <li>- Nilai 2</li>
                    <li>- Nilai 3</li>
                    <li>- Nilai 4</li>
                    <li>- Nilai 5</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="max-w-4xl mx-auto px-4 mb-16 text-center">
        <h2 class="text-2xl font-bold text-gray-600 mb-6">Perjalanan Kami</h2>
        <div class="relative bg-gray-300 rounded-lg aspect-video w-full flex items-center justify-center group cursor-pointer hover:bg-gray-400 transition">
            <div class="w-16 h-16 bg-gray-800 rounded-full flex items-center justify-center pl-1 opacity-80 group-hover:opacity-100 transition">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8 5v14l11-7z" />
                </svg>
            </div>
        </div>
    </section>

    <section class="max-w-5xl mx-auto px-4 mb-16 text-center">
        <h2 class="text-2xl font-bold text-gray-700 mb-8">Struktur Organisasi</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <?php foreach ($structures as $member): ?>
            <div class="bg-white border border-gray-100 shadow-md rounded-xl p-6 flex flex-col items-center hover:shadow-lg transition">
                <img src="<?= $member['image'] ?>" alt="<?= $member['name'] ?>" class="w-20 h-20 rounded-full mb-4 object-cover bg-gray-200">
                <h3 class="font-bold text-sm text-gray-900"><?= $member['name'] ?></h3>
                <p class="text-xs text-orange-500 font-semibold mb-1"><?= $member['role'] ?></p>
                <p class="text-[10px] text-gray-400"><?= $member['nip'] ?></p>
            </div>
            <?php endforeach; ?>
        </div>

        <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-2 px-6 rounded-full transition">
            Lihat Selengkapnya &rarr;
        </button>
    </section>

    <section class="max-w-6xl mx-auto px-4 mb-20 text-center">
        <h2 class="text-2xl font-bold text-gray-700 mb-8">Tim Kreatif Kami</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            <?php foreach ($creatives as $creative): ?>
            <div class="bg-white border border-gray-100 shadow-sm hover:shadow-md transition rounded-lg p-4 flex flex-col items-center">
                <img src="<?= $creative['image'] ?>" alt="<?= $creative['name'] ?>" class="w-16 h-16 rounded-full mb-3 object-cover bg-gray-200">
                <h3 class="font-bold text-xs text-gray-900"><?= $creative['name'] ?></h3>
                <p class="text-[10px] text-orange-500 mb-2"><?= $creative['role'] ?></p>
                
                <div class="flex flex-wrap justify-center gap-1">
                    <?php foreach($creative['tags'] as $tag): ?>
                        <span class="bg-blue-50 text-blue-600 text-[8px] px-2 py-1 rounded-full font-medium">
                            <?= $tag ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php include '../layouts/footer.php'; ?>

</body>
</html>
