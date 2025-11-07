<?php

namespace App\Http\Controllers;

use App\Mail\PaymentReceipt;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PaymentController extends Controller
{
    /**
     * ===== ADMIN: REKAP & PENGATURAN TIKET =====
     */
    public function index()
    {
        // Rekap order (yang terbaru dulu)
        $orders = Order::latest()->paginate(15);

        // Load harga tiket dinamis utk form admin
        $tiket = $this->loadTicketPrices();

        // Tampilkan halaman admin/aturtiket.blade.php
        return view('admin.aturtiket', compact('orders', 'tiket'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'harga_dewasa' => ['required', 'integer', 'min:0'],
            'harga_anak'   => ['required', 'integer', 'min:0'],
            'fast_track'   => ['required', 'integer', 'min:0'],
        ], [], [
            'harga_dewasa' => 'Harga Dewasa',
            'harga_anak'   => 'Harga Anak-Anak',
            'fast_track'   => 'Biaya Fast Track',
        ]);

        $this->saveTicketPrices([
            'dewasa'     => (int) $data['harga_dewasa'],
            'anak'       => (int) $data['harga_anak'],
            'fast_track' => (int) $data['fast_track'],
        ]);

        return redirect()
            ->route('admin.tiket.index')
            ->with('success', 'Harga tiket berhasil diperbarui.');
    }

    /**
     * ===== FRONT: FORM ORDER (tetap ke form-tiket.blade.php) =====
     */
    public function create()
    {
        return view('form-tiket');
    }

    /**
     * ===== FRONT: CREATE ORDER (dipanggil via fetch/POST dari form) =====
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'  => ['required','string','max:150'],
            'email' => ['required','email','max:190'],
            'telepon' => ['required','string','max:30'],
            'tanggalFormatted' => ['required','string','max:100'],

            'paymentMethod.id'   => ['required','string', Rule::in(['bca_va','bni_va','bri_va','mandiri_va'])],
            'paymentMethod.name' => ['required','string','max:100'],

            'orderItems'             => ['required','array','min:1'],
            'orderItems.*.id'        => ['required','integer', Rule::in([1,2])], // 1=Dewasa, 2=Anak
            'orderItems.*.quantity'  => ['required','integer','min:1'],
            'orderItems.*.fastTrack' => ['nullable','boolean'],

            'orderTotal'         => ['nullable','integer','min:0'],
        ]);

        // Harga dinamis (ambil dari storage, bukan hardcode)
        $prices = $this->loadTicketPrices();

        $computedSubtotal = 0;
        foreach ($data['orderItems'] as $it) {
            $base = match ($it['id']) {
                1 => $prices['dewasa'],
                2 => $prices['anak'],
            };
            $unit = $base + (!empty($it['fastTrack']) ? $prices['fast_track'] : 0);
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
            'status'         => 'paid', // simulasi payment berhasil
            'meta'           => [
                'ip'         => $request->ip(),
                'agent'      => $request->userAgent(),
                'tanggal'    => $data['tanggalFormatted'],
                'items'      => $data['orderItems'],
                'va_number'  => $vaNumber,
                'note'       => 'Simulasi pembayaran—tanpa payment gateway.',
            ],
        ]);

        // kirim email (queue)
        Mail::to($order->email)->queue(new PaymentReceipt($order));

        return response()->json([
            'redirect' => route('payment.success', $order->order_code),
        ]);
    }

    /**
     * ===== FRONT: HALAMAN SUCCESS (menampilkan ringkas order) =====
     */
    public function success(string $orderCode)
    {
        $order = Order::where('order_code', $orderCode)->firstOrFail();
        return view('pembayaran', compact('order'));
    }

    /**
     * ===== Helper load/save harga tiket (tanpa DB) =====
     */
    private function loadTicketPrices(): array
    {
        // file: storage/app/ticket.json
        if (Storage::exists('ticket.json')) {
            $data = json_decode(Storage::get('ticket.json'), true);
            if (is_array($data)) {
                return [
                    'dewasa'     => (int) ($data['dewasa']     ?? 35000),
                    'anak'       => (int) ($data['anak']       ?? 30000),
                    'fast_track' => (int) ($data['fast_track'] ?? 15000),
                ];
            }
        }
        // default
        return [
            'dewasa'     => 35000,
            'anak'       => 30000,
            'fast_track' => 15000,
        ];
    }

    private function saveTicketPrices(array $prices): void
    {
        Storage::put('ticket.json', json_encode([
            'dewasa'     => (int) $prices['dewasa'],
            'anak'       => (int) $prices['anak'],
            'fast_track' => (int) $prices['fast_track'],
        ], JSON_PRETTY_PRINT));
    }
}
