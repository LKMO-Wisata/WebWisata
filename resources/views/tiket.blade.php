<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembelian tiket|Watersplash park</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png" style="width:50px; height:50px; border-radius:50%; object-fit:cover;">
    
    @include('layouts.navbar')

    <script src="https://cdn.tailwindcss.com"></script>
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>

    <style>
        /* Mengatasi 'flash' saat Alpine.js dimuat */
        [x-cloak] { 
            display: none !important;
        }
        
        /* Tema Tailwind kustom untuk Flatpickr */
        .flatpickr-calendar {
            background: transparent;
            width: 100% !important;
            box-shadow: none;
            border: none;
            padding: 0;
        }
        .flatpickr-months {
            border-bottom: 1px solid theme('colors.gray.200');
            padding-bottom: 0.5rem;
            margin-bottom: 0.5rem;
        }
        .flatpickr-current-month {
            font-size: 1.25rem; /* text-xl */
            font-weight: 700; /* font-bold */
            color: theme('colors.gray.800');
            padding: 0;
            height: auto;
        }
        /* CSS Tambahan untuk membuat input tahun terlihat seperti teks */
        .flatpickr-current-month .numInputWrapper {
            display: inline-block;
            /* Beri sedikit spasi antara bulan dan tahun */
            margin-left: 0.25rem; 
        }
        .flatpickr-current-month .numInput {
            /* Mengambil style dari parent (bold, text-xl, color) */
            font: inherit; 
            color: inherit;
            background: transparent;
            border: none;
            padding: 0;
            width: 3.5rem; /* Cukup untuk "2025" */
            -moz-appearance: textfield; /* Sembunyikan panah di Firefox */
        }
        /* Sembunyikan panah di Chrome, Safari, Edge */
        .flatpickr-current-month .numInput::-webkit-outer-spin-button,
        .flatpickr-current-month .numInput::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .flatpickr-monthDropdown-months { display: none; }

        .flatpickr-prev-month, .flatpickr-next-month {
            color: theme('colors.gray.600');
            fill: theme('colors.gray.600');
            top: 0.3rem;
        }
        .flatpickr-prev-month:hover, .flatpickr-next-month:hover {
            color: theme('colors.indigo.700');
            fill: theme('colors.indigo.700');
        }
        .flatpickr-weekdays {
            margin-top: 0.5rem;
        }
        span.flatpickr-weekday {
            font-weight: 600; /* font-semibold */
            color: theme('colors.gray.600');
            font-size: 0.875rem; /* text-sm */
        }
        .dayContainer {
            padding: 0;
        }
        .flatpickr-day {
            font-size: 0.875rem; /* text-sm */
            color: theme('colors.gray.700');
            border-radius: 9999px; /* rounded-full */
            border: 1px solid transparent;
            height: 36px;
            width: 36px;
            line-height: 36px;
            margin: 2px 0;
        }
        .flatpickr-day.prevMonthDay, .flatpickr-day.nextMonthDay {
            color: theme('colors.gray.300');
        }
        .flatpickr-day.today {
            border-color: theme('colors.indigo.700');
            color: theme('colors.indigo.700');
        }
        .flatpickr-day.selected, .flatpickr-day.selected:hover {
            background: theme('colors.indigo.800');
            border-color: theme('colors.indigo.800');
            color: theme('colors.white');
        }
        .flatpickr-day:hover {
            background: theme('colors.gray.100');
            border-color: transparent;
        }
        /* Style untuk legenda dari gambar ke-2 */
        .legend-dot {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 1.25rem; /* w-5 */
            height: 1.25rem; /* h-5 */
            border-radius: 9999px; /* rounded-full */
            font-size: 0.75rem; /* text-xs */
            font-weight: 700; /* font-bold */
            margin-right: 0.5rem; /* mr-2 */
        }
    </style>
</head>

<body 
    class="bg-gray-50" 
    x-data="ticketApp()" 
    x-init="
        initDatepicker($refs.calendarContainer); 
        cart.tanggal = formatDateForDisplay(selectedDate)
    ">

    <div class="container mx-auto p-4 md:p-10 max-w-7xl">
        
        <h1 class="text-4xl font-bold text-indigo-900 mb-8">Tiket</h1>
        
        <div class="lg:grid lg:grid-cols-3 lg:gap-8">
            
            <div class="lg:col-span-2">
                <h2 class="text-2xl font-bold text-indigo-900 mb-4">Beli tiket disini</h2>
                
                <div class="relative mb-8">
                    <div 
                        @click="isCalendarOpen = !isCalendarOpen" 
                        class="bg-white border border-gray-300 rounded-lg p-4 flex justify-between items-center shadow-sm cursor-pointer"
                        :class="{ 'border-indigo-700 ring-2 ring-indigo-200': isCalendarOpen }">
                        
                        <div class="flex items-center space-x-3">
                            <svg class="w-6 h-6 text-indigo-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-18 0h18" />
                            </svg>
                            <div>
                                <span class="text-sm text-gray-500">Tanggal Kedatangan</span>
                                <p class="font-semibold text-gray-900" x-text="formatDateForDisplay(selectedDate)"></p>
                            </div>
                        </div>
                        
                        <svg x-show="!isCalendarOpen" class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                        <svg x-show="isCalendarOpen" x-cloak class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                        </svg>
                    </div>
                    
                    <div
                        x-show="isCalendarOpen"
                        x-cloak
                        @click.outside="isCalendarOpen = false"
                        class="absolute z-10 w-full lg:w-[400px] bg-white rounded-lg shadow-xl p-6 mt-2 border border-gray-200">
                        
                        <div x-ref="calendarContainer"></div>
                        
                        <h4 class="text-lg font-semibold text-gray-800 mt-6 mb-3">Informasi Tanggal</h4>
                        <div class="space-y-2 text-sm text-gray-700">
                            <div class="flex items-center">
                                <span class="legend-dot bg-white border border-gray-400 text-gray-700">1</span>
                                <span>Tanggal tersedia</span>
                            </div>
                            <div class="flex items-center">
                                <span class="legend-dot bg-indigo-800 border border-indigo-800 text-white">1</span>
                                <span>Tanggal terpilih</span>
                            </div>
                            <div class="flex items-center">
                                <span class="legend-dot bg-gray-100 border border-gray-300 text-gray-400">
                                    <span class="line-through">1</span>
                                </span>
                                <span>Tanggal tidak tersedia</span>
                            </div>
                        </div>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">
                    Tiket untuk tanggal <span x-text="formatDateForDisplay(selectedDate)"></span>:
                </h3>
                
                <div class="bg-white border border-gray-300 rounded-lg p-6 mb-4 flex justify-between items-center shadow-sm">
                    <div>
                        <h4 class="text-lg font-semibold text-gray-900">Tiket Masuk Watersplash Park</h4>
                        <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full mt-1">Dewasa</span>
                        <p class="text-xl font-bold text-gray-900 mt-2" x-text="formatCurrency(products[0].price)"></p>
                    </div>
                    <button @click="addToCart(1)" class="bg-indigo-800 text-white font-semibold py-2 px-6 rounded-lg hover:bg-indigo-700 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                        Tambah
                    </button>
                </div>
                
                <div class="bg-white border border-gray-300 rounded-lg p-6 mb-4 flex justify-between items-center shadow-sm">
                    <div>
                        <h4 class="text-lg font-semibold text-gray-900">Tiket Masuk Watersplash Park</h4>
                        <span class="inline-block bg-cyan-100 text-cyan-800 text-xs font-semibold px-2.5 py-0.5 rounded-full mt-1">Anak-Anak</span>
                        <p class="text-xl font-bold text-gray-900 mt-2" x-text="formatCurrency(products[1].price)"></p>
                    </div>
                    <button @click="addToCart(2)" class="bg-indigo-800 text-white font-semibold py-2 px-6 rounded-lg hover:bg-indigo-700 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                        Tambah
                    </button>
                </div>
            </div>
            
            <div class="lg:col-span-1 mt-8 lg:mt-0">
                <div class="bg-white border border-gray-300 rounded-lg shadow-lg p-6 sticky top-8">
                    <div class="flex items-center space-x-2 text-xl font-bold text-indigo-900 mb-4">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25V7.5A2.25 2.25 0 0 1 9.75 5.25h8.5a2.25 2.25 0 0 1 2.25 2.25v6.75m-1.5-6.75h.008v.008H18v-.008m-3 0h.008v.008H15v-.008" />
                        </svg>
                        <span>Keranjang Belanja</span>
                    </div>
                    
                    <p class="text-sm text-gray-600 mb-4">
                        Tanggal Kedatangan: <span class="font-semibold" x-text="cart.tanggal"></span>
                    </p>
                    
                    <div x-show="cart.items.length === 0" x-cloak class="text-center text-gray-500 py-8">
                        <p>Keranjang Anda kosong.</p>
                    </div>

                    <div x-show="cart.items.length > 0" x-cloak class="space-y-4">
                        <template x-for="item in cart.items" :key="item.id">
                            <div class="pb-4 border-b border-gray-200 last:border-b-0">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-semibold text-gray-800" x-text="item.name"></span>
                                    <button @click="removeFromCart(item.id)" class="text-red-500 hover:text-red-700">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="flex justify-between items-end">
                                    <div>
                                        <span class="text-xs text-gray-500 d-block">Jumlah tiket Anda</span>
                                        <div class="flex items-center mt-1">
                                            <button @click="updateQuantity(item.id, -1)" class="border rounded-l px-2 py-1 hover:bg-gray-100 text-gray-700 disabled:opacity-50" :disabled="item.quantity <= 1">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" /></svg>
                                            </button>
                                            <span class="border-t border-b w-10 text-center py-1" x-text="item.quantity"></span>
                                            <button @click="updateQuantity(item.id, 1)" class="border rounded-r px-2 py-1 hover:bg-gray-100 text-gray-700">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                                            </button>
                                        </div>
                                    </div>
                                    <span class="font-bold text-gray-900 text-lg" x-text="formatCurrency(item.price * item.quantity)"></span>
                                </div>
                            </div>
                        </template>
                    </div>
                    
                    <div x-show="cart.items.length > 0" x-cloak>
                        <hr class="my-4">
                        <div class="flex justify-between items-center font-bold text-gray-900">
                            <span x-text="'Subtotal (' + cartItemCount() + ')'"></span>
                            <span x-text="formatCurrency(cartTotal())"></span>
                        </div>
                        
                        <a href="{{ url('/form-tiket') }}" 
                        @click="saveCartToStorage()" 
                        class="inline-block text-center w-full bg-teal-600 text-white font-semibold py-3 rounded-lg mt-4 hover:bg-teal-500 transition-colors focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-opacity-50">
                            Beli Tiket
                        </a>
                        </button>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <script>
        function ticketApp() {
            return {
                // DATA PRODUK (Tetap)
                products: [
                    { id: 1, name: 'Dewasa', price: 35000 },
                    { id: 2, name: 'Anak-Anak', price: 30000 }
                ],
                
                // DATA KERANJANG (Diperbarui)
                cart: {
                    items: [],
                    tanggal: '' // Tanggal sekarang akan diisi oleh Alpine
                },

                // --- DATA BARU UNTUK DATE PICKER ---
                selectedDate: '2025-10-10', // Default tanggal (YYYY-MM-DD)
                isCalendarOpen: false, // Status dropdown kalender
                
                // --- FUNGSI BARU: INISIALISASI DATE PICKER ---
                initDatepicker(element) {
                    flatpickr(element, {
                        inline: true, // Tampilkan kalender langsung di dalam div
                        dateFormat: "Y-m-d", // Format data standar
                        defaultDate: this.selectedDate, // Tanggal default
                        locale: 'id', // Gunakan bahasa Indonesia
                        monthSelectorType: 'static', // Tampilan bulan sesuai gambar
                        onChange: (selectedDates, dateStr, instance) => {
                            // Update state Alpine saat tanggal berubah
                            this.selectedDate = dateStr;
                            
                            // Update tanggal di keranjang
                            this.cart.tanggal = this.formatDateForDisplay(dateStr);
                            
                            // Tutup dropdown setelah memilih
                            this.isCalendarOpen = false;
                        },
                        // Contoh 'disable' tanggal (misal: semua hari Senin)
                        // disable: [
                        //     function(date) {
                        //         // return true untuk menonaktifkan
                        //         return (date.getDay() === 1); // Nonaktifkan hari Senin
                        //     }
                        // ],
                    });
                },
                
                // --- FUNGSI BARU: FORMAT TANGGAL ---
                formatDateForDisplay(dateStr) {
                    // Konversi "YYYY-MM-DD" ke "DD MMMM YYYY" (Bahasa Indonesia)
                    if (!dateStr) return "Pilih Tanggal";
                    const date = new Date(dateStr + 'T00:00:00'); // Tambah T00:00 untuk hindari isu timezone
                    return date.toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric'
                    });
                },

                // --- FUNGSI KERANJANG (Tetap) ---
                addToCart(productId) {
                    const product = this.products.find(p => p.id === productId);
                    if (!product) return;
                    let itemInCart = this.cart.items.find(item => item.id === productId);
                    if (itemInCart) {
                        itemInCart.quantity++;
                    } else {
                        this.cart.items.push({ 
                            id: product.id, 
                            name: product.name, 
                            price: product.price, 
                            quantity: 1 
                        });
                    }
                },
                removeFromCart(productId) {
                    this.cart.items = this.cart.items.filter(item => item.id !== productId);
                },
                updateQuantity(productId, amount) {
                    let itemInCart = this.cart.items.find(item => item.id === productId);
                    if (!itemInCart) return;
                    itemInCart.quantity += amount;
                    if (itemInCart.quantity < 1) {
                        itemInCart.quantity = 1;
                    }
                },
                cartItemCount() {
                    return this.cart.items.reduce((total, item) => total + item.quantity, 0);
                },
                cartTotal() {
                    return this.cart.items.reduce((total, item) => total + (item.price * item.quantity), 0);
                },
                // ... (fungsi-fungsi Alpine.js lainnya di atas) ...

                formatCurrency(value) {
                    if (isNaN(value)) { value = 0; }
                    return new Intl.NumberFormat('id-ID', { 
                        style: 'currency', 
                        currency: 'IDR', 
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 0
                    }).format(value);
                }, 

                // BENAR: Ini adalah fungsi baru yang setara dengan formatCurrency
                saveCartToStorage() {
                    // 1. Siapkan data yang akan disimpan
                    const orderData = {
                        items: this.cart.items,
                        tanggalRaw: this.selectedDate, // misal: "2025-10-10"
                        tanggalFormatted: this.formatDateForDisplay(this.selectedDate) // misal: "10 Oktober 2025"
                    };
                    
                    // 2. Simpan sebagai string JSON di sessionStorage
                    sessionStorage.setItem('watersplashOrder', JSON.stringify(orderData));
                    
                    // 3. Halaman akan berpindah karena tag <a>
                }
                
            } // <-- Ini penutup 'return' dari ticketApp()
        } // <-- Ini penutup fungsi ticketApp()
    </script>

    @include('layouts.footer')

</body>
</html>