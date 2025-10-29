<!-- resources/views/layouts/navbar.blade.php -->
<nav class="bg-[#000B58] text-[#FDEB9E] p-4 sticky top-0 z-50 shadow-lg">
    <div class="container mx-auto flex items-center justify-between">
        <div class="flex items-center space-x-2">
            <img src="{{ asset('img/logo.png') }}" class="w-10 h-10" alt="logo" style="width:50px; height:50px; border-radius:50%; object-fit:cover;">
        </div>
        <div class="hidden md:flex space-x-8">
             <a href="{{ url('/') }}" class="hover:text-red-500">Beranda</a>
            <a href="{{ url('/wahana') }}" class="hover:text-red-500">Wahana</a>
            <a href="{{ url('/tiket') }}" class="hover:text-red-500">Tiket</a>
            <a href="{{ url('/fasilitas') }}" class="hover:text-red-500">Fasilitas</a>
        </div>
    </div>
</nav>
