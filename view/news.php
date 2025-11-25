<?php include '../layouts/header.php'; ?>

<!-- Tailwind CDN -->
<script src="https://cdn.tailwindcss.com"></script>

<main class="max-w-7xl mx-auto px-4 py-16 space-y-10">

    <!-- Judul & Subjudul -->
    <section class="space-y-2 text-center">
        <h1 class="text-3xl font-bold text-gray-900">Artikel & Berita Terkini</h1>
        <p class="text-sm text-gray-500">
            Ikuti kegiatan terbaru, prestasi mahasiswa, dan wawasan teknologi dari Lab MMT
        </p>
    </section>

    <!-- Search + Filter Container -->
    <div class="w-full">
        <div class="flex flex-col md:flex-row bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

            <!-- Search -->
            <div class="relative flex-1 border-b md:border-b-0 md:border-r border-gray-200">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                    <!-- Icon search -->
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>

                <input id="searchInput" type="text" placeholder="Cari judul proyek..."
                    class="w-full pl-12 pr-4 py-3 text-sm text-gray-700 bg-white focus:ring-0 outline-none" />
            </div>

            <!-- Dropdown Kategori -->
            <div class="relative w-full md:w-64">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 text-xs font-medium">
                    Kategori:
                </span>

                <select id="categoryFilter"
                    class="w-full pl-20 pr-10 py-3 text-sm font-semibold bg-white text-gray-700 focus:ring-0 outline-none appearance-none cursor-pointer">
                    <option value="semua">Semua</option>
                    <option value="prestasi">Prestasi</option>
                    <option value="workshop">Workshop</option>
                    <option value="kegiatan">Kegiatan</option>
                </select>

                <!-- Icon Arrow -->
                <span class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-gray-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </span>
            </div>

        </div>
    </div>

    <!--Artikel Utama-->
    <div class="mt-12">
        <div class="border border-gray-200 rounded-xl p-6 flex flex-col md:flex-row gap-6">

            <!-- Gambar Besar -->
            <img src="https://via.placeholder.com/400x250.png?text=Thumbnail" alt="Dummy Thumbnail"
                class="h-56 w-full object-cover rounded-lg" />

            <!-- Teks Artikel -->
            <div class="w-full md:w-1/2 flex flex-col justify-between">
                <div>
                    <p class="text-xs text-orange-500 font-semibold mb-2">Baru Saja • 12 Nov 2025</p>

                    <h2 class="text-xl font-bold text-gray-800 leading-snug">
                        Mahasiswa Lab MMT Juara 1 Kompetisi AR Nasional
                    </h2>

                    <p class="mt-3 text-sm text-gray-600">
                        Tim riset Augmented Reality Lab MMT berhasil mengalahkan 50 universitas lain dengan inovasi
                        aplikasi edukasi sejarah berbasis lokasi. Simak kisah perjuangan mereka.
                    </p>
                </div>

                <button
                    class="mt-4 w-fit bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold px-4 py-2 rounded-lg">
                    Lihat Selengkapnya →
                </button>
            </div>

        </div>
    </div>

    <!-- ========================= -->
    <!--     GRID 3 KOLOM         -->
    <!-- ========================= -->

    <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- CARD TEMPLATE (Copy 6x) -->
        <!-- Card 1 -->
        <div class="border border-gray-200 rounded-xl p-4 flex flex-col">
            <img src="https://via.placeholder.com/400x250.png?text=Thumbnail" alt="Dummy Thumbnail"
                class="h-40 w-full object-cover rounded-lg" />

            <h3 class="mt-4 font-semibold text-gray-800">Workshop UI/UX Design Dasar</h3>

            <p class="text-xs text-gray-500 mt-1">12 Nov 2025</p>

            <p class="text-sm text-gray-600 mt-2">
                Pelajari dasar-dasar desain antarmuka pengguna dan membuat layout yang untuk aplikasi mobile.
            </p>

            <button
                class="mt-4 w-fit bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold px-4 py-2 rounded-lg">
                Lihat Selengkapnya →
            </button>
        </div>

        <!-- Card 2 -->
        <div class="border border-gray-200 rounded-xl p-4 flex flex-col">
            <img src="https://via.placeholder.com/400x250.png?text=Thumbnail" alt="Dummy Thumbnail"
                class="h-40 w-full object-cover rounded-lg" />

            <h3 class="mt-4 font-semibold text-gray-800">Workshop UI/UX Design Dasar</h3>

            <p class="text-xs text-gray-500 mt-1">12 Nov 2025</p>

            <p class="text-sm text-gray-600 mt-2">
                Pelajari dasar-dasar desain antarmuka pengguna dan membuat layout yang untuk aplikasi mobile.
            </p>

            <button
                class="mt-4 w-fit bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold px-4 py-2 rounded-lg">
                Lihat Selengkapnya →
            </button>
        </div>

        <!-- Card 3 -->
        <div class="border border-gray-200 rounded-xl p-4 flex flex-col">
            <img src="https://via.placeholder.com/400x250.png?text=Thumbnail" alt="Dummy Thumbnail"
                class="h-40 w-full object-cover rounded-lg" />

            <h3 class="mt-4 font-semibold text-gray-800">Workshop UI/UX Design Dasar</h3>

            <p class="text-xs text-gray-500 mt-1">12 Nov 2025</p>

            <p class="text-sm text-gray-600 mt-2">
                Pelajari dasar-dasar desain antarmuka pengguna dan membuat layout yang untuk aplikasi mobile.
            </p>

            <button
                class="mt-4 w-fit bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold px-4 py-2 rounded-lg">
                Lihat Selengkapnya →
            </button>
        </div>


        <!-- Card 4 -->
        <div class="border border-gray-200 rounded-xl p-4 flex flex-col">
            <img src="https://via.placeholder.com/400x250.png?text=Thumbnail" alt="Dummy Thumbnail"
                class="h-40 w-full object-cover rounded-lg" />

            <h3 class="mt-4 font-semibold text-gray-800">Workshop UI/UX Design Dasar</h3>

            <p class="text-xs text-gray-500 mt-1">12 Nov 2025</p>

            <p class="text-sm text-gray-600 mt-2">
                Pelajari dasar-dasar desain antarmuka pengguna dan membuat layout yang untuk aplikasi mobile.
            </p>

            <button
                class="mt-4 w-fit bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold px-4 py-2 rounded-lg">
                Lihat Selengkapnya →
            </button>
        </div>

        <!-- Card 5 -->
        <div class="border border-gray-200 rounded-xl p-4 flex flex-col">
            <img src="https://via.placeholder.com/400x250.png?text=Thumbnail" alt="Dummy Thumbnail"
                class="h-40 w-full object-cover rounded-lg" />

            <h3 class="mt-4 font-semibold text-gray-800">Workshop UI/UX Design Dasar</h3>

            <p class="text-xs text-gray-500 mt-1">12 Nov 2025</p>

            <p class="text-sm text-gray-600 mt-2">
                Pelajari dasar-dasar desain antarmuka pengguna dan membuat layout yang untuk aplikasi mobile.
            </p>

            <button
                class="mt-4 w-fit bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold px-4 py-2 rounded-lg">
                Lihat Selengkapnya →
            </button>
        </div>

        <!-- Card 6 -->
        <div class="border border-gray-200 rounded-xl p-4 flex flex-col">
            <img src="https://via.placeholder.com/400x250.png?text=Thumbnail" alt="Dummy Thumbnail"
                class="h-40 w-full object-cover rounded-lg" />

            <h3 class="mt-4 font-semibold text-gray-800">Workshop UI/UX Design Dasar</h3>

            <p class="text-xs text-gray-500 mt-1">12 Nov 2025</p>

            <p class="text-sm text-gray-600 mt-2">
                Pelajari dasar-dasar desain antarmuka pengguna dan membuat layout yang untuk aplikasi mobile.
            </p>

            <button
                class="mt-4 w-fit bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold px-4 py-2 rounded-lg">
                Lihat Selengkapnya →
            </button>
        </div>

    </div>

</main>

<?php include '../layouts/footer.php'; ?>