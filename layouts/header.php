<!-- HEADER.PHP -->
<header id="header" class="bg-white shadow-md">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <img src="/pbl/assets/images/logo.png" alt="Lab MMT Logo" class="h-12">
                <span class="ml-2 text-xl font-bold text-orange-600">LAB MMT</span>
            </div>

            <!-- Navbar Desktop -->
            <nav class="hidden md:flex space-x-8">
                <a href="#" class="text-gray-700 hover:text-orange-600 transition">Home</a>
                <a href="#" class="text-gray-700 hover:text-orange-600 transition">Project</a>
                <a href="#" class="text-gray-700 hover:text-orange-600 transition">Galery</a>
                <a href="#" class="text-gray-700 hover:text-orange-600 transition">About Us</a>
                <a href="#" class="text-gray-700 hover:text-orange-600 transition">News</a>
            </nav>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="md:hidden text-gray-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <nav id="mobile-menu" class="hidden md:hidden pb-4">
            <a href="#" class="block py-2 text-gray-700 hover:text-orange-600 transition">Home</a>
            <a href="#" class="block py-2 text-gray-700 hover:text-orange-600 transition">Project</a>
            <a href="#" class="block py-2 text-gray-700 hover:text-orange-600 transition">Galery</a>
            <a href="#" class="block py-2 text-gray-700 hover:text-orange-600 transition">About Us</a>
            <a href="#" class="block py-2 text-gray-700 hover:text-orange-600 transition">News</a>
        </nav>
    </div>
</header>
