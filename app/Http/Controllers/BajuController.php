<?php

namespace App\Http\Controllers;
use App\Models\baju;
use Illuminate\Http\Request;

class BajuController extends Controller
{
    public function index() {
        $baju = baju::all();
        return view('baju.index', compact('baju'));
    }
    public function create()
    {
        $baju = baju::all();
        return view('baju.create');
    }
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|max:255|String',
            'type' => 'required|in:male,female',
            'size' => 'required|in:S,M,L,XL,XXL',
            'image' => 'required|mimes:jpg,jpeg,png,svg|max:2048',
            'description' => 'required|String|max:255',
            'price' => 'required|Integer',
            'stock' => 'required|Integer|min:1',
            'status' => 'required|in:available,unavailable',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'name.max' => 'Nama maksimal 255 karakter',
            'name.String' => 'Nama harus berupa string',
            'type.required' => 'Jenis tidak boleh kosong',
            'type.in' => 'Jenis harus berupa male atau female',
            'size.required' => 'Ukuran tidak boleh kosong',
            'size.in' => 'Ukuran harus berupa S, M, L, XL, XXL',
            'image.required' => 'Gambar tidak boleh kosong',
            'image.mimes' => 'Gambar harus berupa jpg, jpeg, png, svg',
            'image.max' => 'Gambar maksimal 2048 KB',
            'description.required' => 'Deskripsi tidak boleh kosong',
            'description.String' => 'Deskripsi harus berupa string',
            'description.max' => 'Deskripsi maksimal 255 karakter',
            'price.required' => 'Harga tidak boleh kosong',
            'stock.required' => 'Stok tidak boleh kosong',
            'stock.min' => 'Stok minimal 1',
            'status.required' => 'Status tidak boleh kosong',
            'status.in' => 'Status harus berupa available atau unavailable',
        ]);

        if ($request->hasFile('image')) {
            // Simpan file ke storage/app/public/images
            $imagePath = $request->file('image')->store('images', 'public'); // 'public' adalah disk
            $validated['image'] = $imagePath; // contoh: images/nama-file.jpg
        }

        baju::create($validated);
        return redirect()->route('baju.index')->with('success', 'Data berhasil ditambahkan');
    }
}
