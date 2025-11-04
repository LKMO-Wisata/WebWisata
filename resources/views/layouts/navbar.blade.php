<nav class="bg-[#000B58] text-[#FDEB9E] p-4 sticky top-0 z-50 shadow-lg">
    <div class="container mx-auto flex items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center space-x-2">
            <img src="{{ asset('img/logo.png') }}" alt="logo" class="w-10 h-10 rounded-full object-cover">
            <span class="text-xl font-bold">Watersplash Park</span>
        </div>

        <!-- Hamburger Icon (Mobile) -->
        <button id="menu-btn" class="block md:hidden focus:outline-none">
            <!-- Heroicon: Menu -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-[#FDEB9E]" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Menu Items -->
        <div id="menu" class="hidden md:flex flex-col md:flex-row absolute md:static bg-[#000B58] md:bg-transparent w-full left-0 md:w-auto top-16 md:top-0 space-y-4 md:space-y-0 md:space-x-8 px-6 md:px-0 py-4 md:py-0 shadow-md md:shadow-none transition-all duration-300">
            
            <!-- Beranda -->
            <a href="{{ url('/') }}" class="flex items-center space-x-2 hover:text-red-400 transition">
                <!-- Home Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 9.75L12 4l9 5.75V20a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1V9.75z" />
                </svg>
                <span>Beranda</span>
            </a>

            <!-- Wahana -->
            <a href="{{ url('/wahana') }}" class="flex items-center space-x-2 hover:text-red-400 transition">
                <!-- Water Slide / Attraction Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 2c2.28 0 4 1.72 4 4 0 1.4-.74 2.6-1.86 3.26l.36 4.24H9.5l.36-4.24A3.98 3.98 0 0 1 8 6c0-2.28 1.72-4 4-4zM5 21h14v-2H5v2z" />
                </svg>
                <span>Wahana</span>
            </a>

            <!-- Tiket -->
            <a href="{{ url('/tiket') }}" class="flex items-center space-x-2 hover:text-red-400 transition">
                <!-- Ticket Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 8h16v3a1 1 0 0 1-1 1h-1v2h1a1 1 0 0 1 1 1v3H4v-3a1 1 0 0 1 1-1h1v-2H5a1 1 0 0 1-1-1V8z" />
                </svg>
                <span>Tiket</span>
            </a>

            <!-- Fasilitas -->
            <a href="{{ url('/fasilitas') }}" class="flex items-center space-x-2 hover:text-red-400 transition">
                <!-- Facilities Icon (Building / Rest Area) -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 21V9l8-4 8 4v12H4zM9 21v-6h6v6" />
                </svg>
                <span>Fasilitas</span>
            </a>
        </div>
    </div>

    <!-- Script for Mobile Toggle -->
    <script>
        const menuBtn = document.getElementById('menu-btn');
        const menu = document.getElementById('menu');
        menuBtn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>
</nav>