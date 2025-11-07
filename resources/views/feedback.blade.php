<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback | Watersplash Park</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png" style="width:50px; height:50px; border-radius:50%; object-fit:cover;">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Gaya tambahan untuk efek hover hati, seperti di homepage awal */
        #ratingHearts .fa-heart { transition: color 0.2s ease-in-out, transform 0.1s ease-in-out; }
        #ratingHearts .fa-heart:hover { transform: scale(1.15); }
    </style>
</head>
<body class="bg-gray-50 font-sans">

    @include('layouts.navbar')

    @if (session('success'))
        <div class="container mx-auto px-6 py-4 mt-6">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <section class="py-16 min-h-screen flex items-center justify-center bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="bg-white max-w-2xl mx-auto p-8 md:p-12 rounded-lg shadow-xl relative mt-10">
                <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-blue-600 p-5 rounded-full shadow-lg border-4 border-white">
                    <i class="fa-solid fa-pencil text-white text-2xl"></i>
                </div>

                <h2 class="text-2xl font-bold text-center text-gray-800 mt-8 mb-2">Masukan Anda adalah inspirasi kami.</h2>
                <p class="text-center text-gray-500 mb-6">Beri kami nilai!</p>

                <form action="{{ route('feedback.store') }}" method="POST">
                    @csrf

                    <div class="flex justify-center space-x-2 mb-6" id="ratingHearts">
                        <i class="fa-regular fa-heart text-gray-300 text-3xl cursor-pointer" data-value="1"></i>
                        <i class="fa-regular fa-heart text-gray-300 text-3xl cursor-pointer" data-value="2"></i>
                        <i class="fa-regular fa-heart text-gray-300 text-3xl cursor-pointer" data-value="3"></i>
                        <i class="fa-regular fa-heart text-gray-300 text-3xl cursor-pointer" data-value="4"></i>
                        <i class="fa-regular fa-heart text-gray-300 text-3xl cursor-pointer" data-value="5"></i>
                    </div>
                    <input type="hidden" name="rating" id="ratingInput" value="0">

                    <div class="space-y-4">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email*</label>
                            <input type="email" name="email" id="email" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Masukan Email Anda">
                        </div>
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                            <input type="text" name="name" id="name"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Masukan Nama Anda">
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Pesan*</label>
                            <textarea name="message" id="message" rows="4" required
                                     class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                     placeholder="Tuliskan Masukan Anda disini..."></textarea>
                        </div>
                    </div>

                    <div class="text-center mt-6">
                        <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 shadow-md hover:shadow-lg">
                            Kirim Masukan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    @include('layouts.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ratingContainer = document.getElementById('ratingHearts');
            if (!ratingContainer) return;

            const hearts = ratingContainer.querySelectorAll('.fa-heart');
            const ratingInput = document.getElementById('ratingInput');

            const updateRatingUI = (ratingValue) => {
                hearts.forEach((h, i) => {
                    if (i < ratingValue) {
                        h.classList.add('text-red-500', 'fa-solid');
                        h.classList.remove('text-gray-300', 'fa-regular');
                    } else {
                        h.classList.add('text-gray-300', 'fa-regular');
                        h.classList.remove('text-red-500', 'fa-solid');
                    }
                });
            };

            hearts.forEach((heart, index) => {
                heart.addEventListener('click', () => {
                    const ratingValue = index + 1;
                    ratingInput.value = ratingValue;
                    updateRatingUI(ratingValue);
                });

                heart.addEventListener('mouseover', () => {
                    const hoverValue = index + 1;
                    hearts.forEach((h, i) => {
                        if (i < hoverValue) {
                            h.classList.add('text-red-400');
                            h.classList.remove('text-gray-300');
                        } else {
                            h.classList.add('text-gray-300');
                            h.classList.remove('text-red-400');
                        }
                    });
                });
            });

            ratingContainer.addEventListener('mouseleave', () => {
                const currentRating = parseInt(ratingInput.value, 10) || 0;
                updateRatingUI(currentRating);
            });
        });
    </script>
</body>
</html>