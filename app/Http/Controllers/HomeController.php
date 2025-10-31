<?php

namespace App\Http\Controllers;

use App\Models\DangerousAccount; // Use the existing DangerousAccount model
use Illuminate\Http\Request;
use App\Models\GrupJualBeliCard;

class HomeController extends Controller
{
    public function index()
    {
        // --- PERUBAHAN DI SINI ---
        // Fetch the last 5 DANGEROUS ACCOUNTS that are ACCEPTED by the admin.
        $kasus = DangerousAccount::where('is_accepted', true) // <-- FILTER AKUN YANG SUDAH DIKONFIRMASI
                                 ->latest()
                                 ->take(5)
                                 ->get();
        // ------------------------

        // Pass the data to the home view
        return view('home', compact('kasus'));
    }

    public function contacts()
    {
        $grupJualBeliCards = GrupJualBeliCard::orderBy('order', 'asc')->paginate(12);
        $contactUsCards = \App\Models\ContactUsCard::orderBy('order', 'asc')->get();
        return view('contacts', compact('grupJualBeliCards', 'contactUsCards'));
    }

    public function searchMlId(Request $request)
    {
        $request->validate([
            'ml_id' => 'required|string',
        ]);

        $mlId = $request->input('ml_id');

        // Note: Pastikan route dangerous.show menangani kasus jika ID tidak ditemukan/belum dikonfirmasi.
        return redirect()->route('dangerous.show', ['id' => $mlId]);
    }
}