<nav class="bg-[#000B58] text-[#FDEB9E] p-4 sticky top-0 z-50 shadow-lg">
    <div class="container mx-auto flex items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center space-x-2">
            <img src="{{ asset('img/logo.png') }}" alt="logo" class="w-14 h-14 rounded-full object-cover">
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

<div id="menu" class="hidden md:flex flex-col md:flex-row absolute md:static bg-[#000B58] md:bg-transparent w-full left-0 md:w-auto top-16 md:top-0 space-y-4 md:space-y-0 md:space-x-8 px-6 md:px-0 py-4 md:py-0 shadow-md md:shadow-none transition-all duration-300">
    
    <a href="{{ url('/') }}" class="flex items-center space-x-2 hover:text-red-400 transition">
        <i class="fa-solid fa-house w-5 h-5"></i>
        <span>Beranda</span>
    </a>

    <a href="{{ url('/wahana') }}" class="flex items-center space-x-2 hover:text-red-400 transition">
    <i class="fa-solid fa-water-ladder w-5 h-5"></i> <span>Wahana</span>
    </a>

    <a href="{{ url('/tiket') }}" class="flex items-center space-x-2 hover:text-red-400 transition">
        <i class="fa-solid fa-ticket w-5 h-5"></i>
        <span>Tiket</span>
    </a>

    <a href="{{ url('/fasilitas') }}" class="flex items-center space-x-2 hover:text-red-400 transition">
        <i class="fa-solid fa-utensils w-5 h-5"></i> 
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