<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FeedbackController extends Controller
{
    // Public — simpan feedback dari homepage
    public function store(Request $request)
    {
        $data = $request->validate([
            'email'   => ['required','email','max:190'],
            'name'    => ['nullable','string','max:150'],
            'rating'  => ['required','integer','min:0','max:5'],
            'message' => ['required','string','min:5'],
        ], [], [
            'email'   => 'Email',
            'name'    => 'Nama',
            'rating'  => 'Rating',
            'message' => 'Pesan',
        ]);

        Feedback::create([
            'email'   => $data['email'],
            'name'    => $data['name'] ?? null,
            'rating'  => (int)$data['rating'],
            'message' => $data['message'],
            'ip'      => $request->ip(),
            'agent'   => $request->userAgent(),
        ]);

        return redirect()->route('homepage')->with('success', 'Terima kasih! Feedback Anda sudah kami terima.');
    }

    // Admin — daftar feedback
    public function index()
    {
        $feedback = Feedback::latest()->paginate(12);
        return view('admin.feedback.index', compact('feedback'));
    }

    // (Opsional) Admin — hapus feedback
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        return redirect()->route('admin.feedback.index')->with('success', 'Feedback telah dihapus.');
    }
}
