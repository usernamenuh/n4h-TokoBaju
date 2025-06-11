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


}
