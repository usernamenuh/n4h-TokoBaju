<?php

namespace App\Http\Controllers;

use App\Models\pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = pelanggan::with('user')->latest()->get();
        return view('pelanggan.index', compact('pelanggan'));
    }

    public function create()
    {
        $pelanggan = pelanggan::all();
        return view('pelanggan.create', compact('pelanggan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255|string',
            'email' => 'required|email|unique:pelanggans',
            'no_hp' => 'required|integer',
            'user_id' => 'required|exists:users,id'
        ]);

        $pelanggan = pelanggan::create($request->all());
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan');
    }
}
