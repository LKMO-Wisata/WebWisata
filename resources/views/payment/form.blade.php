<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pembayaran</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 min-h-screen">
  <div class="max-w-xl mx-auto py-12 px-4">
    <h1 class="text-2xl font-semibold mb-6">Form Pembayaran</h1>

    @if ($errors->any())
      <div class="mb-4 rounded-md bg-red-50 p-4 text-red-700">
        <ul class="list-disc ml-6">
          @foreach ($errors->all() as $e)
            <li>{{ $e }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="mb-4 p-4 rounded-lg bg-white shadow">
      <p class="text-sm text-gray-600">Harga</p>
      <p class="text-2xl font-bold">
        {{ number_format($price, 0, ',', '.') }} {{ $currency }}
      </p>
    </div>

    <form action="{{ route('payment.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow space-y-4">
      @csrf

      <div>
        <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
        <input type="text" name="name" value="{{ old('name') }}"
               class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring"
               required>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Email</label>
        <input type="email" name="email" value="{{ old('email') }}"
               class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring"
               required>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Nomor Telepon</label>
        <input type="text" name="phone" value="{{ old('phone') }}"
               class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring"
               placeholder="08xxxxxxxxxx" required>
      </div>

      <div>
        <label class="block text-sm font-medium mb-2">Metode Pembayaran</label>
        <div class="grid grid-cols-2 gap-3">
          @php $methods = ['transfer' => 'Transfer Bank','qris' => 'QRIS','va' => 'Virtual Account','ewallet' => 'e-Wallet']; @endphp
          @foreach ($methods as $val => $label)
            <label class="flex items-center gap-2 border rounded-md p-3 cursor-pointer">
              <input type="radio" name="payment_method" value="{{ $val }}" {{ old('payment_method')===$val?'checked':'' }} required>
              <span>{{ $label }}</span>
            </label>
          @endforeach
        </div>
      </div>

      <button type="submit"
              class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2.5 rounded-md">
        Bayar & Kirim Email
      </button>
    </form>

    <p class="text-xs text-gray-500 mt-4">*Demo: transaksi dianggap sukses tanpa gateway pembayaran.</p>
  </div>
</body>
</html>
