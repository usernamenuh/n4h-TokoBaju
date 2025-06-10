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
        'baju_id' => 'required|exists:bajus,id', // Tambahkan validasi untuk baju_id
    ], [
        'jumlah.required' => 'Jumlah beli harus diisi',
        'harga.required' => 'Harga beli harus diisi',
        'baju_id.required' => 'Baju harus dipilih',
        'baju_id.exists' => 'Baju tidak ditemukan',
    ]);

    // Ambil data baju
    $baju = baju::findOrFail($request->bajus_id);

    // Cek stok tersedia
    if ($baju->stok < $request->jumlah) {
        return back()->with('error', 'Stok tidak mencukupi');
    }

    // Update stok baju
    $baju->stok -= $request->jumlah;
    $baju->save();

    // Simpan data pembelian
    $beli = new beli;
    $beli->jumlah = $request->jumlah;
    $beli->harga = $request->harga;
    $beli->bajus_id = $request->bajus_id;
    $beli->save();

    return redirect()->route('beli.index')->with('success', 'Pembelian berhasil dilakukan');
}
}
