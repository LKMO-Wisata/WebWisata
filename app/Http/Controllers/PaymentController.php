<?php
namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Mail\PaymentReceipt;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function create()
    {
        $price    = (int) (config('app.price') ?? env('APP_PRICE', 50000));
        $currency = config('app.currency') ?? env('APP_CURRENCY', 'IDR');

        return view('payment.form', compact('price','currency'));
    }

    public function store(StorePaymentRequest $request)
    {
        $price    = (int) (config('app.price') ?? env('APP_PRICE', 50000));
        $currency = config('app.currency') ?? env('APP_CURRENCY', 'IDR');

        // Generate kode order unik (ULID rapi & sortable)
        $orderCode = 'ORD-' . Str::ulid();

        $order = Order::create([
            'order_code'     => $orderCode,
            'name'           => $request->name,
            'email'          => $request->email,
            'phone'          => $request->phone,
            'payment_method' => $request->payment_method,
            'amount'         => $price,
            'currency'       => $currency,
            'status'         => 'paid', // anggap berhasil (tanpa gateway)
            'meta'           => [
                'ip'      => $request->ip(),
                'agent'   => $request->userAgent(),
                'note'    => 'Simulasi pembayaran—tanpa payment gateway.',
            ],
        ]);

        // Kirim email (di-queue)
        Mail::to($order->email)->queue(new PaymentReceipt($order));

        return redirect()->route('payment.success', $order->order_code);
    }

    public function success(string $orderCode)
    {
        $order = Order::where('order_code', $orderCode)->firstOrFail();
        return view('payment.success', compact('order'));
    }
}
