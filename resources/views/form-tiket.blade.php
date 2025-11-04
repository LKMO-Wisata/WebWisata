<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form pemesanan|watersplash park</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png" style="width:50px; height:50px; border-radius:50%; object-fit:cover;">

    @include('layouts.navbar')

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
      
        [x-cloak] {
            display: none !important;
        }
        
     
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=number] {
            -moz-appearance: textfield; /* Firefox */
        }
    </style>
</head>
<body class="bg-white text-gray-900">

    <div x-data="pemesananApp()" x-init="loadOrderFromStorage()" class="container mx-auto max-w-6xl p-4 md:p-10">
        <div class="relative flex justify-center items-center mb-8">
            <a href="{{ url('/tiket') }}" class="absolute left-0 text-gray-600 hover:text-indigo-800 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
            </a>
            <h1 class="text-3xl font-bold text-indigo-900">Pemesanan Tiket</h1>
        </div>

        <nav class="flex items-center justify-center max-w-xl mx-auto mb-12">
            <div class="flex items-center">
                <div class="flex items-center justify-center w-8 h-8 bg-indigo-800 text-white rounded-full font-bold">1</div>
                <span class="ml-3 font-semibold text-indigo-800">Lengkapi Informasi</span>
            </div>
            <div class="flex-auto border-t-2 border-gray-300 mx-4"></div>
            <div class="flex items-center">
                <div class="flex items-center justify-center w-8 h-8 bg-gray-200 text-gray-500 rounded-full font-bold">2</div>
                <span class="ml-3 font-medium text-gray-400">Pembayaran</span>
            </div>
            <div class="flex-auto border-t-2 border-gray-300 mx-4"></div>
            <div class="flex items-center">
                <div class="flex items-center justify-center w-8 h-8 bg-gray-200 text-gray-500 rounded-full font-bold">3</div>
                <span class="ml-3 font-medium text-gray-400">Selesai</span>
            </div>
        </nav>

        <div class="lg:grid lg:grid-cols-5 lg:gap-12">
            <div class="lg:col-span-3">
                <h2 class="text-2xl font-bold text-gray-900">Lengkapi Informasi</h2>
                <p class="text-gray-600 mt-2 mb-8">Lengkapi formulir dibawah dengan data yang sesuai, klik tombol bayar untuk melanjutkan pemesanan</p>

                <form @submit.prevent="submitPayment" class="space-y-8">
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Informasi Pesanan</h3>
                        <div class="mb-6">
                            <label for="nama" class="block text-sm font-medium text-gray-600">Nama</label>
                            <input type="text" id="nama" name="nama" class="block w-full py-2 border-0 border-b-2 border-gray-300 focus:ring-0 focus:border-indigo-700 transition-colors" required>
                        </div>
                        <div class="mb-6">
                            <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                            <input type="email" id="email" name="email" class="block w-full py-2 border-0 border-b-2 border-gray-300 focus:ring-0 focus:border-indigo-700 transition-colors" required>
                        </div>
                        <div class="mb-6">
                            <label for="telepon" class="block text-sm font-medium text-gray-600">Nomor Telepon</label>
                            <input type="number" id="telepon" name="telepon" class="block w-full py-2 border-0 border-b-2 border-gray-300 focus:ring-0 focus:border-indigo-700 transition-colors" required>
                        </div>
                    </div>

                    <div class="relative">
                        <div 
                            @click="isPaymentOpen = !isPaymentOpen" 
                            class="w-full flex justify-between items-center p-4 border rounded-lg cursor-pointer bg-white"
                            :class="{ 'border-indigo-700 ring-2 ring-indigo-200': isPaymentOpen, 'border-gray-300': !isPaymentOpen }">
                            
                            <div class="flex items-center space-x-3">
                                <template x-if="!selectedPayment">
                                    <svg class="w-6 h-6 text-indigo-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h6m3-3.75l-3 3m0 0l-3-3m3 3V15m6-1.5h.008v.008H18V15m-1.5 0h.008v.008H16.5V15m3 0h.008v.008H19.5V15m-3 0h.008v.008H16.5V15m3 0h.008v.008H19.5V15m-3 0h.008v.008H16.5V15m0-1.5h.008v.008H16.5V13.5m3 0h.008v.008H19.5V13.5m-3 0h.008v.008H16.5V13.5m3 0h.008v.008H19.5V13.5m-3 0h.008v.008H16.5V13.5m0 3h.008v.008H16.5V16.5m3 0h.008v.008H19.5V16.5" />
                                    </svg>
                                </template>
                                <template x-if="selectedPayment">
                                    <img :src="selectedPayment.logoUrl" class="h-6 object-contain">
                                </template>
                                <div>
                                    <span class="text-sm text-gray-500">Metode Pembayaran</span>
                                    <p x-show="!selectedPayment" class="font-semibold text-gray-900">Pilih Metode Pembayaran</p>
                                    <p x-show="selectedPayment" x-cloak class="font-semibold text-gray-900">
                                        <span x-text="selectedPayment.name"></span>
                                        </p>
                                </div>
                            </div>
                            <svg x-show="!isPaymentOpen" class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                            <svg x-show="isPaymentOpen" x-cloak class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                            </svg>
                        </div>

                        <div 
                            x-show="isPaymentOpen" x-cloak @click.outside="isPaymentOpen = false" x-transition 
                            class="absolute z-10 w-full bg-white rounded-lg shadow-xl p-4 mt-2 border border-gray-200 max-h-96 overflow-y-auto">
                            
                            <p class="text-sm font-semibold text-gray-500 mb-3 px-2">Virtual Account</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <template x-for="method in paymentMethods.filter(p => p.category === 'va')" :key="method.id">
                                    <div @click="selectPayment(method)" 
                                        class="text-center p-6 border rounded-lg cursor-pointer hover:bg-gray-50 transition-colors"
                                        :class="{ 'border-indigo-700 ring-2 ring-indigo-200': selectedPayment && selectedPayment.id === method.id, 'border-gray-300': !selectedPayment || selectedPayment.id !== method.id }">
                                        
                                        <img :src="method.logoUrl" class="h-8 mx-auto mb-3 object-contain" alt="">
                                        <p class="font-semibold text-gray-900">
                                            <span x-text="method.name"></span>
                                            </p>
                                        <p class="text-sm text-gray-600 mt-1" x-text="method.description"></p>
                                    </div>
                                </template>
                            </div>

                            </div>
                    </div>

                    <div class="mt-8">
                        <label for="terms" class="flex items-start">
                            <input 
                                id="terms" name="terms" type="checkbox" 
                                class="h-5 w-5 rounded border-gray-300 text-indigo-700 focus:ring-indigo-600 mt-0.5" 
                                x-model="termsAccepted">
                            <span class="ml-3 text-sm text-gray-600">
                                Saya setuju dengan <a href="#" class="font-semibold text-indigo-700 hover:underline">syarat dan ketentuan</a> Watersplash Park, dan <a href="#" class="font-semibold text-indigo-700 hover:underline">kebijakan privasi</a> Watersplash Park
                            </span>
                        </label>
                    </div>

                    <div class="mt-10">
                        <button 
                            type="button" 
                            @click="submitPayment" 
                            class="w-full bg-indigo-800 text-white font-semibold py-3 px-6 rounded-lg shadow-md hover:bg-indigo-700 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed" 
                            :disabled="!termsAccepted || !selectedPayment">
                            Bayar Sekarang
                        </button>
                    </div>
                </form>
            </div>

            <div class="lg:col-span-2 mt-12 lg:mt-0">
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 sticky top-8">
                    <h3 class="text-lg font-bold text-gray-900 border-b border-gray-200 pb-4">Pesanan Anda</h3>

                    <template x-for="item in order.items" :key="item.id">
                        <div class="flex justify-between items-start py-4">
                            <div>
                                <span x-text="item.name === 'Dewasa' ? 'Dewasa' : 'Anak-Anak'"
                                    :class="item.name === 'Dewasa' ? 'bg-blue-100 text-blue-800' : 'bg-cyan-100 text-cyan-800'"
                                    class="inline-block text-xs font-semibold px-2.5 py-0.5 rounded-full mb-2">
                                </span>
                                <p class="font-semibold">Tiket Masuk Watersplash Park</p>
                                <p class="text-sm text-gray-600">
                                    <span x-text="order.tanggalFormatted"></span>, Total: <span x-text="item.quantity"></span>
                                </p>
                            </div>
                            <span class="font-bold text-gray-900" x-text="formatCurrency(item.price * item.quantity)"></span>
                        </div>
                    </template>

                    <template x-if="order.items.length === 0">
                        <div class="py-4 text-center text-gray-500">
                            <p>Tidak ada item dalam pesanan Anda.</p>
                        </div>
                    </template>

                    <div class="space-y-2 py-4 border-t border-b border-gray-200 text-gray-700">
                        <div class="flex justify-between">
                            <span>Subtotal:</span>
                            <span class="font-medium" x-text="formatCurrency(order.subtotal)"></span>
                        </div>
                        <div class="flex justify-between">
                            <span>Biaya Aplikasi:</span>
                            <span class="font-medium" x-text="formatCurrency(order.biayaAplikasi)"></span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center pt-4 font-bold text-lg text-gray-900">
                        <span>Total:</span>
                        <span x-text="formatCurrency(order.Total)"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button class="fixed bottom-8 right-8 bg-gray-900 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-lg hover:bg-gray-700 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
        </svg>
    </button>

    <script>
    function pemesananApp() {
        return {
            termsAccepted: false,
            order: { 
                items: [],
                tanggalFormatted: 'Tidak Ditemukan',
                subtotal: 0,
                biayaAplikasi: 0,
                Total: 0
            },
            isPaymentOpen: false, 
            selectedPayment: null, 
            
            paymentMethods: [
                { id: 'bca_va', name: 'BCA VA', description: 'Hanya menerima pembayaran dari Bank BCA', logoUrl: 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEi1MkMOsEjUfFY7Jthedj-LSUGzQjsNdK0lMCDXw3DO8yaiBSeoFAA19-ZMhZ_6fnefUSRpRY_KP-Ipxh4ZU4x7grVeoLgxBXm8qdIl64U06LMLHaBftYakqllTBPIFLYP3ELbA2lH6_Og/w320-h118/Logo+Bank+BCA.png', category: 'va' }, 
                { id: 'bni_va', name: 'BNI VA', description: 'Dapat menerima pembayaran dari semua bank', logoUrl: 'https://vectorez.biz.id/wp-content/uploads/2023/10/Logo-Bank-Negara-Indonesia-BNI.png', category: 'va' }, 
                { id: 'bri_va', name: 'BRI VA', description: 'Dapat menerima pembayaran dari semua bank', logoUrl: 'https://www.freelogovectors.net/wp-content/uploads/2023/02/bri-logo-freelogovectors.net_.png', category: 'va' }, 
                { id: 'mandiri_va', name: 'Mandiri VA', description: 'Hanya menerima pembayaran dari Bank Mandiri', logoUrl: 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Bank_Mandiri_logo_2016.svg/2560px-Bank_Mandiri_logo.svg.png', category: 'va' }
            ],

            loadOrderFromStorage() {
                const storedData = sessionStorage.getItem('watersplashOrder');
                if (storedData) {
                    const data = JSON.parse(storedData);
                    let calculatedSubtotal = 0;
                    if (data.items) {
                        data.items.forEach(item => {
                            calculatedSubtotal += item.price * item.quantity; 
                        });
                    }
                    this.order.items = data.items || [];
                    this.order.tanggalFormatted = data.tanggalFormatted || 'Tidak ditemukan';
                    this.order.subtotal = calculatedSubtotal;
                    this.order.biayaAplikasi = 0; 
                    this.order.Total = calculatedSubtotal; 
                }
            },

            formatCurrency(value) {
                if (isNaN(value)) { value = 0; }
                return new Intl.NumberFormat('id-ID', { 
                    style: 'currency', currency: 'IDR', minimumFractionDigits: 0, maximumFractionDigits: 0
                }).format(value);
            }, 

            selectPayment(method) {
                this.selectedPayment = method; 
                this.isPaymentOpen = false; 
            },

            submitPayment() {
                const paymentData = {
                    nama: document.getElementById('nama').value,
                    email: document.getElementById('email').value,
                    telepon: document.getElementById('telepon').value,
                    paymentMethod: this.selectedPayment, 
                    orderItems: this.order.items,       
                    orderTotal: this.order.Total,       
                    tanggalFormatted: this.order.tanggalFormatted 
                };

                if (!paymentData.paymentMethod) {
                    alert('Silakan pilih metode pembayaran terlebih dahulu.');
                    return; 
                }
                 if (!paymentData.nama || !paymentData.email || !paymentData.telepon) {
                    alert('Mohon lengkapi Nama, Email, dan Nomor Telepon.');
                    return;
                }
                
                sessionStorage.setItem('pendingPayment', JSON.stringify(paymentData));
               window.location.href = '/pembayaran'; 
            }
        }
    }
    </script>

    @include('layouts.footer')  

</body>
</html>