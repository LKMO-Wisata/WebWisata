<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Watersplash Park</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .gradient-bg { background: linear-gradient(to bottom, #dbeafe, #1e40af); }
        .password-toggle { cursor: pointer; }
    </style>
</head>
<body class="min-h-screen flex flex-col gradient-bg">

    <!-- Header -->
    <header class="bg-blue-900 text-white py-4 shadow-lg">
        <div class="max-w-7xl mx-auto px-6 flex items-center space-x-3">
            <img src="{{ asset('img/logo.png') }}" alt="Watersplash Park Logo" class="w-12 h-12 rounded-full border-2 border-yellow-400">
            <h1 class="text-2xl font-bold tracking-wide">Watersplash Park</h1>
        </div>
    </header>

    <!-- Welcome Text -->
    <div class="flex-1 flex items-center justify-center px-6 py-8">
        <div class="text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-blue-900 bg-white px-6 py-2 rounded-full shadow-md inline-block">
                SELAMAT DATANG, ADMIN
            </h2>
        </div>
    </div>

    <!-- Login Card -->
    <div class="flex justify-center px-6 pb-12">
        <div class="bg-blue-900 rounded-3xl shadow-2xl overflow-hidden max-w-4xl w-full grid md:grid-cols-2">

            <!-- Left Side: Logo + Form -->
            <div class="税务 p-8 md:p-12 flex flex-col justify-center items-center space-y-6 text-white">
                <!-- Logo Circle -->
                <div class="w-32 h-32 bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-full flex items-center justify-center shadow-lg border-4 border-white">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-24 h-24 object-contain">
                </div>

                <!-- Login Form -->
                <form action="{{ route('admin.login.post') ?? '#' }}" method="POST" class="w-full space-y-5">
                    @csrf

                    <!-- Email Field -->
                    <div>
                        <div class="relative">
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required
                                   class="w-full px-4 py-3 rounded-lg bg-white text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 @error('email') ring-2 ring-red-500 @else focus:ring-yellow-400 @enderror transition">
                            @error('email')
                                <p class="text-red-400 text-xs mt-1 flex items-center">
                                    <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Password Field with Toggle -->
                    <div>
                        <div class="relative">
                            <input type="password" name="password" id="password" placeholder="Password" required
                                   class="w-full px-4 py-3 pr-12 rounded-lg bg-white text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 @error('password') ring-2 ring-red-500 @else focus:ring-yellow-400 @enderror transition">
                            <span class="password-toggle absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700"
                                  onclick="togglePassword()">
                                <i data-lucide="eye-off" id="eye-off" class="w-5 h-5"></i>
                                <i data-lucide="eye" id="eye" class="w-5 h-5 hidden"></i>
                            </span>
                        </div>
                        @error('password')
                            <p class="text-red-400 text-xs mt-1 flex items-center">
                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- General Error (e.g. Wrong credentials) -->
                    @if(session('error'))
                        <div class="bg-red-500 bg-opacity-20 border border-red-500 text-red-300 px-4 py-2 rounded-lg text-sm flex items-center">
                            <i data-lucide="x-circle" class="w-5 h-5 mr-2"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Submit Button -->
                    <button type="submit"
                            class="w-full bg-yellow-400 hover:bg-yellow-500 text-blue-900 font-bold py-3 rounded-lg shadow-md transition transform hover:scale-105 flex items-center justify-center">
                        <span>LOG IN</span>
                    </button>
                </form>
            </div>

            <!-- Right Side: Google Login -->
            <div class="bg-blue-800 p-8 md:p-12 flex flex-col justify-center items-center text-center space-y-6 text-yellow-100">
                <h3 class="text-lg md:text-xl font-semibold uppercase tracking-wider">
                    Masuk ke Akun Anda
                </h3>
                <p class="text-sm opacity-90">Masuk dengan</p>

                <!-- Google Button -->
                <a href="#" class="inline-flex items-center space-x-3 bg-white text-gray-800 px-6 py-3 rounded-lg shadow-lg hover:shadow-xl transition transform hover:scale-105">
                    <img src="https://www.google.com/favicon.ico" alt="Google" class="w-6 h-6">
                    <span class="font-medium">Google</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-900 text-white text-center py-4 text-sm">
        <p>© {{ date('Y') }} Watersplash Park. All rights reserved.</p>
    </footer>

    <!-- JavaScript: Toggle Password Visibility -->
    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const eye = document.getElementById('eye');
            const eyeOff = document.getElementById('eye-off');

            if (password.type === 'password') {
                password.type = 'text';
                eye.classList.remove('hidden');
                eyeOff.classList.add('hidden');
            } else {
                password.type = 'password';
';
                eye.classList.add('hidden');
                eyeOff.classList.remove('hidden');
            }
        }

        // Inisialisasi Lucide Icons
        lucide.createIcons();
    </script>
</body>
</html>