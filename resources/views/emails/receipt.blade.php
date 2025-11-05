@component('mail::message')
# Rincian Pembayaran

Halo **{{ $order->name }}**, terima kasih atas pembayarannya.

**Kode Order:** {{ $order->order_code }}  
**Tanggal:** {{ $order->created_at->format('d M Y H:i') }}  
**Metode:** {{ strtoupper($order->payment_method) }}  
**Jumlah:** {{ number_format($order->amount, 0, ',', '.') }} {{ $order->currency }}  
**Status:** {{ strtoupper($order->status) }}

@component('mail::panel')
Nama: {{ $order->name }}  
Email: {{ $order->email }}  
Telepon: {{ $order->phone }}
@endcomponent

Jika Anda merasa tidak melakukan transaksi ini, abaikan email ini atau hubungi dukungan kami.

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
