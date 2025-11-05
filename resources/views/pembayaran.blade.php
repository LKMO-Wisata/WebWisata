<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pembayaran | Watersplash Park</title>
  <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">

  @include('layouts.navbar')

  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <style>[x-cloak]{display:none!important} body{background-color:#F8FAFC}</style>

  <!-- Lempar data order dari server ke JS global (AMAN untuk Alpine) -->
  @php
    $__orderPayload = null;
    if (isset($order)) {
        // Pastikan meta berupa array
        $meta = is_array($order->meta) ? $order->meta : (array) $order->meta;

        $__orderPayload = [
            'email'         => $order->email,
            'amount'        => (int) $order->amount,
            'paymentMethod' => $order->payment_method,
            'va_number'     => $meta['va_number'] ?? 'N/A',
        ];
    }
@endphp
<script>
    window.__ORDER__ = @json($__orderPayload);
</script>
</head>
<body class="bg-gray-100">

<div
  x-data="pembayaranApp()"
  x-init="loadPaymentData()"
  class="container mx-auto max-w-2xl p-4 md:py-10"
>
  <div class="relative flex justify-center items-center mb-8">
    <a href="{{ route('payment.form') }}" class="absolute left-0 text-gray-600 hover:text-indigo-800 transition-colors">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
      </svg>
    </a>
    <h1 class="text-3xl font-bold text-indigo-900">Pemesanan Tiket</h1>
  </div>

  <nav class="flex items-center justify-center max-w-xl mx-auto my-12">
    <div class="flex items-center text-gray-400"><div class="w-8 h-8 flex items-center justify-center bg-gray-200 text-gray-500 rounded-full font-bold">1</div><span class="ml-3">Lengkapi Informasi</span></div>
    <div class="flex-auto border-t-2 border-gray-300 mx-4"></div>
    <div class="flex items-center text-indigo-800"><div class="w-8 h-8 flex items-center justify-center bg-indigo-800 text-white rounded-full font-bold">2</div><span class="ml-3 font-semibold">Pembayaran</span></div>
    <div class="flex-auto border-t-2 border-gray-300 mx-4"></div>
    <div class="flex items-center text-gray-400"><div class="w-8 h-8 flex items-center justify-center bg-gray-200 text-gray-500 rounded-full font-bold">3</div><span class="ml-3">Selesai</span></div>
  </nav>

  <div class="bg-white rounded-lg shadow-lg overflow-hidden mt-8" x-show="paymentData">
    <div class="bg-indigo-900 text-white p-6">
      <p class="text-lg font-semibold">PT Taman Impian Watersplash</p>
    </div>

    <div class="bg-gray-50 p-6 flex justify-between items-center border-b border-gray-200">
      <div>
        <p class="text-2xl font-bold text-gray-900 flex items-center">
          <span x-text="formatCurrency(paymentData ? paymentData.orderTotal : 0)"></span>
          <svg @click="copyToClipboard(paymentData ? paymentData.orderTotal : 0)" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 text-gray-500 hover:text-indigo-600 cursor-pointer" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8z"/>
          </svg>
        </p>
      </div>
      <div class="text-right">
        <p class="text-sm text-gray-600">Pay within</p>
        <p class="text-lg font-bold text-red-600" x-text="formatTime()"></p>
      </div>
    </div>

    <div class="p-8 space-y-5">
      <div class="flex justify-between items-center">
        <h2 class="text-lg font-semibold text-gray-800" x-text="paymentData ? ('Bank ' + (paymentData.paymentMethod.name.split(' ')[0]||'')) : 'Memuat...'"></h2>
        <img x-show="paymentData && paymentData.paymentMethod.logoUrl" :src="paymentData.paymentMethod.logoUrl" :alt="'Logo ' + (paymentData ? paymentData.paymentMethod.name : '')" class="h-6 object-contain">
      </div>

      <p class="text-gray-600 text-sm" x-text="paymentData ? ('Selesaikan pembayaran dari ' + (paymentData.paymentMethod.name.split(' ')[0]||'Bank') + ' ke nomor virtual account di bawah ini.') : 'Memuat instruksi...'"></p>

      <div>
        <p class="text-sm text-gray-500 mb-1">Virtual account number</p>
        <div class="flex justify-between items-center">
          <p class="text-2xl font-semibold text-gray-900 tracking-wider" x-text="paymentData ? paymentData.va_number : '...' "></p>
          <button @click="copyToClipboard(paymentData ? paymentData.va_number : '')" class="text-blue-600 font-medium text-sm hover:underline">
            <span x-show="!copied">Copy</span>
            <span x-show="copied" x-cloak class="text-green-600">Copied!</span>
          </button>
        </div>
      </div>
    </div>

    <div class="bg-gray-50 p-6 text-center border-t border-gray-200">
      <button @click="checkStatus()" class="w-full max-w-xs bg-gray-800 text-white font-semibold py-3 px-4 rounded-lg shadow-md hover:bg-gray-700 transition-colors mb-3">
        Cek Status Pesanan
      </button>
      <a href="{{ url('/') }}" class="block mt-4 text-base font-bold text-gray-600 hover:text-gray-800 hover:underline">Close</a>
    </div>
  </div>

  <div x-show="!paymentData" x-cloak class="text-center text-gray-500 mt-10">Memuat data pembayaran...</div>

  <!-- Modal sukses -->
  <div x-show="showSuccessModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="fixed inset-0 bg-black/70 backdrop-blur-sm"></div>
    <div @click.outside="showSuccessModal=false" x-transition
         class="relative bg-white rounded-2xl shadow-xl w-full max-w-lg p-8 md:p-12 text-center">
      <button @click="showSuccessModal=false" class="absolute top-4 right-4 text-red-500 bg-red-100 rounded-full p-1.5 hover:bg-red-200">
        <svg class="w-6 h-6" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke="currentColor" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </button>
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Yay, Transaksi Berhasil!</h2>
      <p class="text-base md:text-lg text-gray-700 leading-relaxed mb-6">
        Detail pembayaran dan tiket masuk sudah kami kirim ke email
        <strong x-text="paymentData ? paymentData.email : 'kamu'"></strong>.
      </p>
      <p class="text-lg md:text-xl font-semibold text-gray-800 italic">
        Selamat menikmati wahana dan sampai jumpa di lokasi!
      </p>
    </div>
  </div>
</div>

@include('layouts.footer')

<script>
function pembayaranApp(){
  return {
    timeLeft: 5400,
    showSuccessModal: false,
    copied: false,
    paymentData: null,

    loadPaymentData(){
      // 1) Jika ada data dari server (Order berhasil dibuat)
      if (window.__ORDER__) {
        this.paymentData = {
          email: window.__ORDER__.email,
          orderTotal: Number(window.__ORDER__.amount || 0),
          paymentMethod: { name: window.__ORDER__.paymentMethod || 'VA', logoUrl: '' },
          va_number: window.__ORDER__.va_number || 'N/A',
        };
      } else {
        // 2) (Fallback) jika akses langsung tanpa create order
        const s = sessionStorage.getItem('pendingPayment');
        if (s) {
          const d = JSON.parse(s);
          this.paymentData = d;
          if (!this.paymentData.va_number) this.paymentData.va_number = '333395049471896016060';
          if (!this.paymentData.paymentMethod) this.paymentData.paymentMethod = { name:'Bank VA', logoUrl:'' };
        } else {
          alert('Data pembayaran tidak ditemukan. Silakan ulangi pemesanan.');
          window.location.href = '{{ route('tiket') }}';
          return;
        }
      }
      this.startTimer();
    },

    startTimer(){
      const h = setInterval(() => {
        if (this.timeLeft > 0) { this.timeLeft--; } else { clearInterval(h); }
      }, 1000);
    },

    formatTime(){
      let h = Math.floor(this.timeLeft / 3600);
      let m = Math.floor((this.timeLeft % 3600) / 60);
      let s = this.timeLeft % 60;
      return [h,m,s].map(v => v < 10 ? '0'+v : v).join(':');
    },

    formatCurrency(v){
      if (isNaN(v)) v = 0;
      return new Intl.NumberFormat('id-ID', { style:'currency', currency:'IDR', minimumFractionDigits:0 }).format(v);
    },

    copyToClipboard(text){
      if (!text) return;
      navigator.clipboard.writeText(String(text)).then(() => {
        this.copied = true;
        setTimeout(() => this.copied = false, 1500);
      });
    },

    checkStatus(){ this.showSuccessModal = true; }
  }
}
</script>
</body>
</html>
