<?php

namespace App\Http\Requests;           // ✅ WAJIB ada

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name' => ['required','string','max:100'],
            'email' => ['required','email:rfc,dns','max:150'],
            'phone' => ['required','string','max:20'],
            'payment_method' => ['required','in:transfer,qris,va,ewallet'],
        ];
    }
}
