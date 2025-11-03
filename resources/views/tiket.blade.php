<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembelian tiket | Watersplash Park</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    
    @include('layouts.navbar')

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>

    <style>
        [x-cloak] { display: none !important; }

        /* Sedikit kustomisasi flatpickr agar rapih di card */
        .flatpickr-calendar { background: transparent; box-shadow: none; border: none; padding: 0; }
        .flatpickr-day { border-radius: 9999px; height: 36px; width: 36px; line-height: 36px; margin: 3px 2px; }
        .flatpickr-day.selected, .flatpickr-day.startRange, .flatpickr-day.endRange { background: #05204a !important; color: #fff !important; border-color: #05204a !important; }
        .flatpickr-day.today { border: 1px solid #05204a; color: #05204a; }
        .legend-dot { display:inline-flex; align-items:center; justify-content:center; width:1.25rem; height:1.25rem; border-radius:9999px; font-size:.75rem; font-weight:700; margin-right:.5rem; }
    </style>
</head>

<body class="bg-gray-50" x-data="ticketApp()" x-init="initDatepicker($refs.calendarContainer)">

    <div class="container mx-auto p-4 md:p-10 max-w-7xl">
        <h1 class="text-4xl font-bold text-indigo-900 mb-8 text-center md:text-left">Tiket</h1>

        <div class="lg:grid lg:grid-cols-3 lg:gap-8">
            <!-- KIRI: Daftar tiket & kalender -->
            <div class="lg:col-span-2 space-y-6">
                <h2 class="text-2xl font-bold text-indigo-900">Beli tiket disini</h2>

                <!-- Ketentuan Umum -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 shadow-sm">
                    <h3 class="font-semibold text-indigo-900 mb-2">Ketentuan Umum</h3>
                    <ul class="list-disc list-inside text-sm text-indigo-900/90">
                        <li>Dewasa: 19th keatas</li>
                        <li>Anak-Anak: 2-18th</li>
                        <li>Dibawah 2th tidak dikenakan biaya tiket masuk</li>
                    </ul>
                </div>

                <!-- Pilih Tanggal (trigger) -->
                <div class="relative mb-2">
                    <div 
                        @click="isCalendarOpen = !isCalendarOpen" 
                        class="bg-white border border-gray-200 rounded-lg p-4 flex justify-between items-center shadow-sm cursor-pointer"
                        :class="{ 'ring-2 ring-indigo-200 border-indigo-700': isCalendarOpen }">
                        
                        <div class="flex items-center space-x-3">
                            <svg class="w-6 h-6 text-indigo-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75" />
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

                    <!-- Calendar dropdown -->
                    <div x-show="isCalendarOpen" x-cloak @click.outside="isCalendarOpen = false" class="absolute z-10 w-full lg:w-[420px] bg-white rounded-lg shadow-xl p-6 mt-2 border border-gray-200">
                        <div x-ref="calendarContainer"></div>

                        <h4 class="text-lg font-semibold text-gray-800 mt-6 mb-3">Informasi Tanggal</h4>
                        <div class="space-y-2 text-sm text-gray-700">
                            <div class="flex items-center">
                                <span class="legend-dot bg-white border border-gray-400 text-gray-700">1</span>
                                <span>Tanggal tersedia</span>
                            </div>
                            <div class="flex items-center">
                                <span class="legend-dot bg-indigo-900 border border-indigo-900 text-white">1</span>
                                <span>Tanggal terpilih</span>
                            </div>
                            <div class="flex items-center">
                                <span class="legend-dot bg-gray-100 border border-gray-300 text-gray-400"><span class="line-through">1</span></span>
                                <span>Tanggal tidak tersedia</span>
                            </div>
                        </div>
                    </div>
                </div>

                <h3 class="text-xl font-bold text-gray-800">Tiket untuk tanggal <span x-text="formatDateForDisplay(selectedDate)"></span>:</h3>

                <!-- Daftar tiket -->
                <div class="grid md:grid-cols-2 gap-6 mt-4">
                    <!-- Tiket Dewasa -->
                    <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm flex flex-col justify-between">
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900">Tiket Masuk Watersplash Park</h4>
                            <span class="inline-block bg-blue-50 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full mt-1">Dewasa</span>
                            <p class="text-2xl font-bold text-gray-900 mt-4" x-text="formatCurrency(products[0].price)"></p>

                            <div class="mt-3 text-sm text-gray-600 flex items-center">
                                <input type="checkbox" id="fasttrack1" class="mr-2" x-model="fastTrack[1]">
                                <label for="fasttrack1">Fast Track (&plus; Rp.15.000)</label>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button @click="addToCart(1)" class="w-full bg-indigo-900 text-white font-semibold py-2 rounded-lg hover:bg-indigo-800 transition-colors">
                                Tambah
                            </button>
                        </div>
                    </div>

                    <!-- Tiket Anak-Anak -->
                    <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm flex flex-col justify-between">
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900">Tiket Masuk Watersplash Park</h4>
                            <span class="inline-block bg-cyan-50 text-cyan-800 text-xs font-semibold px-2.5 py-0.5 rounded-full mt-1">Anak-Anak</span>
                            <p class="text-2xl font-bold text-gray-900 mt-4" x-text="formatCurrency(products[1].price)"></p>

                            <div class="mt-3 text-sm text-gray-600 flex items-center">
                                <input type="checkbox" id="fasttrack2" class="mr-2" x-model="fastTrack[2]">
                                <label for="fasttrack2">Fast Track (&plus; Rp.15.000)</label>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button @click="addToCart(2)" class="w-full bg-indigo-900 text-white font-semibold py-2 rounded-lg hover:bg-indigo-800 transition-colors">
                                Tambah
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KANAN: Keranjang -->
            <div class="lg:col-span-1 mt-8 lg:mt-0">
                <div class="bg-white border border-gray-200 rounded-lg shadow-lg p-6 sticky top-8">
                    <div class="flex items-center space-x-2 text-xl font-bold text-indigo-900 mb-4">
                        <svg class="w-6 h-6 text-indigo-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75" />
                        </svg>
                        <span>Keranjang Belanja</span>
                    </div>

                    <p class="text-sm text-gray-600 mb-4">
                        Tanggal Kedatangan: <span class="font-semibold" x-text="cart.tanggal || formatDateForDisplay(selectedDate)"></span>
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
                                            <span class="border-t border-b w-12 text-center py-1" x-text="item.quantity"></span>
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
                           class="inline-block text-center w-full bg-teal-600 text-white font-semibold py-3 rounded-lg mt-4 hover:bg-teal-500 transition-colors">
                            Beli Tiket
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alpine + Flatpickr logic -->
   <script>
function ticketApp() {
    const todayRaw = new Date();
    const yyyy = todayRaw.getFullYear();
    const mm = String(todayRaw.getMonth() + 1).padStart(2, '0');
    const dd = String(todayRaw.getDate()).padStart(2, '0');
    const todayStr = `${yyyy}-${mm}-${dd}`;

    return {
        products: [
            { id: 1, name: 'Dewasa', price: 35000 },
            { id: 2, name: 'Anak-Anak', price: 30000 }
        ],

        // tambahkan status fast track
        fastTrack: {
            1: false,
            2: false
        },

        cart: {
            items: [],
            tanggal: '' 
        },

        selectedDate: todayStr,
        isCalendarOpen: false,

        initDatepicker(element) {
            flatpickr(element, {
                inline: true,
                dateFormat: "Y-m-d",
                defaultDate: this.selectedDate,
                locale: 'id',
                minDate: "today",
                monthSelectorType: 'static',
                onChange: (selectedDates, dateStr) => {
                    this.selectedDate = dateStr;
                    this.cart.tanggal = this.formatDateForDisplay(dateStr);
                    this.isCalendarOpen = false;
                }
            });
            this.cart.tanggal = this.formatDateForDisplay(this.selectedDate);
        },

        formatDateForDisplay(dateStr) {
            if (!dateStr) return "Pilih Tanggal";
            const date = new Date(dateStr + 'T00:00:00');
            return date.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
        },

        // saat klik "Tambah"
        addToCart(productId) {
            const product = this.products.find(p => p.id === productId);
            if (!product) return;

            // cek apakah fast track diaktifkan
            const isFast = this.fastTrack[productId];
            const price = product.price + (isFast ? 15000 : 0);
            const name = product.name + (isFast ? " (Fast Track)" : "");

            let itemInCart = this.cart.items.find(
                item => item.id === productId && item.fastTrack === isFast
            );

            if (itemInCart) {
                itemInCart.quantity++;
            } else {
                this.cart.items.push({
                    id: product.id,
                    name,
                    price,
                    fastTrack: isFast,
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
            if (itemInCart.quantity < 1) itemInCart.quantity = 1;
        },
        cartItemCount() {
            return this.cart.items.reduce((total, item) => total + item.quantity, 0);
        },
        cartTotal() {
            return this.cart.items.reduce((total, item) => total + (item.price * item.quantity), 0);
        },
        formatCurrency(value) {
            if (isNaN(value)) value = 0;
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(value);
        },
        saveCartToStorage() {
            const orderData = {
                items: this.cart.items,
                tanggalRaw: this.selectedDate,
                tanggalFormatted: this.formatDateForDisplay(this.selectedDate)
            };
            sessionStorage.setItem('watersplashOrder', JSON.stringify(orderData));
        }
    }
}
</script>

    @include('layouts.footer')
</body>
</html>
