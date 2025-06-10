<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\beli;
use App\Models\baju;

class BeliController extends Controller
{
    public function index()
    {
        $beli = beli::all();
        $baju = baju::all();
        return view('beli.index', compact('beli', 'baju'));
    }

    public function create() {
        $beli = beli::all();
        $baju = baju::all();
        return view('beli.create', compact('beli', 'baju'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jumlah' => 'required|integer',
            'harga' => 'required|integer',
        ], [
            'jumlah.required' => 'Jumlah beli harus diisi',
            'harga.required' => 'Harga beli harus diisi',
        ]);

        $beli = new beli;
        $beli->jumlah = $request->jumlah;
        $beli->harga = $request->harga;
        $beli->save();
        return redirect()->route('beli.index');
    }
}
