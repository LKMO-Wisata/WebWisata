<?php

namespace App\Http\Controllers;

use App\Mail\PaymentReceipt;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PaymentController extends Controller
{
    public function create()
    {
        return view('form-tiket');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'  => ['required','string','max:150'],
            'email' => ['required','email','max:190'],
            'telepon' => ['required','string','max:30'],
            'tanggalFormatted' => ['required','string','max:100'],

            'paymentMethod.id'   => ['required','string', Rule::in(['bca_va','bni_va','bri_va','mandiri_va'])],
            'paymentMethod.name' => ['required','string','max:100'],

            'orderItems'         => ['required','array','min:1'],
            'orderItems.*.id'    => ['required','integer', Rule::in([1,2])], // 1=Dewasa, 2=Anak
            'orderItems.*.quantity'  => ['required','integer','min:1'],
            'orderItems.*.fastTrack' => ['nullable','boolean'],

            'orderTotal'         => ['nullable','integer','min:0'],
        ]);

        // Harga dinamis (cocokkan dengan FE di tiket.blade.php)
        $PRICE_DEWASA = 35000;
        $PRICE_ANAK   = 30000;
        $PRICE_FAST   = 15000;

        $computedSubtotal = 0;
        foreach ($data['orderItems'] as $it) {
            $base = match ($it['id']) {
                1 => $PRICE_DEWASA,
                2 => $PRICE_ANAK,
            };
            $unit = $base + (!empty($it['fastTrack']) ? $PRICE_FAST : 0);
            $computedSubtotal += $unit * (int) $it['quantity'];
        }
        $computedTotal = $computedSubtotal;

        if (isset($data['orderTotal']) && (int)$data['orderTotal'] !== $computedTotal) {
            return response()->json([
                'message' => 'Total tidak valid. Silakan muat ulang halaman dan coba lagi.'
            ], 422);
        }

        $currency = config('app.currency') ?? env('APP_CURRENCY', 'IDR');

        $vaMap = [
            'bca_va'     => '0219'.random_int(100000000, 999999999),
            'bni_va'     => '8808'.random_int(100000000, 999999999),
            'bri_va'     => '0020'.random_int(100000000, 999999999),
            'mandiri_va' => '89508'.random_int(10000000, 99999999),
        ];
        $vaNumber = $vaMap[$data['paymentMethod']['id']] ?? (string) random_int(100000000000, 999999999999);

        $orderCode = 'ORD-'.Str::ulid();

        $order = Order::create([
            'order_code'     => $orderCode,
            'name'           => $data['nama'],
            'email'          => $data['email'],
            'phone'          => $data['telepon'],
            'payment_method' => $data['paymentMethod']['name'],
            'amount'         => $computedTotal,
            'currency'       => $currency,
            'status'         => 'paid', // simulasi
            'meta'           => [
                'ip'         => $request->ip(),
                'agent'      => $request->userAgent(),
                'tanggal'    => $data['tanggalFormatted'],
                'items'      => $data['orderItems'],
                'va_number'  => $vaNumber,
                'note'       => 'Simulasi pembayaran—tanpa payment gateway.',
            ],
        ]);

        Mail::to($order->email)->queue(new PaymentReceipt($order));

        return response()->json([
            'redirect' => route('payment.success', $order->order_code),
        ]);
    }

    public function success(string $orderCode)
    {
        $order = Order::where('order_code', $orderCode)->firstOrFail();
        return view('pembayaran', compact('order'));
    }
}
