<!doctype html>
<html>
  <body style="font-family:Arial,sans-serif">
    <h2>Terima kasih, {{ $order->name }}!</h2>
    <p>Order: <strong>{{ $order->order_code }}</strong></p>
    <p>Total: <strong>{{ number_format($order->amount,0,',','.') }} {{ $order->currency }}</strong></p>
    <p>Metode: {{ $order->payment_method }}</p>
    @if(isset($order->meta['va_number']))
      <p>Virtual Account: <strong>{{ $order->meta['va_number'] }}</strong></p>
    @endif
    <hr>
    <p>Kami menunggu kehadiran Anda di Watersplash Park. Sampai jumpa!</p>
  </body>
</html>
