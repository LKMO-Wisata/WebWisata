<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sukses</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 min-h-screen">
  <div class="max-w-xl mx-auto py-16 px-4 text-center">
    <div class="bg-white rounded-lg shadow p-8">
      <h1 class="text-2xl font-semibold mb-2">Pembayaran Berhasil</h1>
      <p class="text-gray-600 mb-6">Rincian telah dikirim ke <strong>{{ $order->email }}</strong>.</p>

      <div class="text-left space-y-2 bg-gray-50 p-4 rounded-md">
        <p><span class="font-medium">Kode Order:</span> {{ $order->order_code }}</p>
        <p><span class="font-medium">Nama:</span> {{ $order->name }}</p>
        <p><span class="font-medium">Telepon:</span> {{ $order->phone }}</p>
        <p><span class="font-medium">Metode:</span> {{ strtoupper($order->payment_method) }}</p>
        <p><span class="font-medium">Jumlah:</span> {{ number_format($order->amount,0,',','.') }} {{ $order->currency }}</p>
        <p><span class="font-medium">Status:</span> {{ strtoupper($order->status) }}</p>
      </div>

      <a href="{{ route('payment.form') }}"
         class="inline-block mt-6 px-4 py-2 rounded-md bg-emerald-600 text-white hover:bg-emerald-700">
        Kembali ke Form
      </a>
    </div>
  </div>
</body>
</html>
