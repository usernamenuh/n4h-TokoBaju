<?php

namespace App\Http\Controllers;
use App\Models\baju; // Sebaiknya 'Baju' dengan huruf kapital (PSR-4 Naming Convention)
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Tambahkan ini untuk menghapus gambar lama

class BajuController extends Controller
{
    public function index() {
        // Menggunakan 'Baju' jika nama model diubah sesuai konvensi
        $baju = Baju::all();
        return view('baju.index', compact('baju'));
    }
    public function create()
    {
        // Tidak perlu mengambil semua baju di sini jika tidak digunakan di view create
        return view('baju.create');
    }
    public function store(Request $request) {
        $validated = $request->validate([
            'nama' => 'required|max:255|string', // 'String' menjadi 'string'
            'type' => 'required|in:male,female',
            'size' => 'required|in:S,M,L,XL,XXL',
            'image' => 'required|image|mimes:jpg,jpeg,png,svg|max:2048', // 'image' rule lebih baik
            'description' => 'required|string|max:255', // 'String' menjadi 'string'
            'price' => 'required|integer', // 'Integer' menjadi 'integer'
            'stock' => 'required|integer|min:1', // 'Integer' menjadi 'integer'
            'status' => 'required|in:available,unavailable',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'nama.max' => 'Nama maksimal 255 karakter',
            'nama.string' => 'Nama harus berupa string', // 'string'
            'type.required' => 'Jenis tidak boleh kosong',
            'type.in' => 'Jenis harus berupa male atau female',
            'size.required' => 'Ukuran tidak boleh kosong',
            'size.in' => 'Ukuran harus berupa S, M, L, XL, XXL',
            'image.required' => 'Gambar tidak boleh kosong',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Gambar harus berupa jpg, jpeg, png, svg',
            'image.max' => 'Gambar maksimal 2048 KB',
            'description.required' => 'Deskripsi tidak boleh kosong',
            'description.string' => 'Deskripsi harus berupa string', // 'string'
            'description.max' => 'Deskripsi maksimal 255 karakter',
            'price.required' => 'Harga tidak boleh kosong',
            'price.integer' => 'Harga harus berupa angka.', // 'integer'
            'stock.required' => 'Stok tidak boleh kosong',
            'stock.integer' => 'Stok harus berupa angka.', // 'integer'
            'stock.min' => 'Stok minimal 1',
            'status.required' => 'Status tidak boleh kosong',
            'status.in' => 'Status harus berupa available atau unavailable',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validated['image'] = $imagePath;
        }

        // Menggunakan 'Baju' jika nama model diubah sesuai konvensi
        Baju::create($validated);
        return redirect()->route('baju.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id) {
        // Ambil data baju spesifik berdasarkan ID
        // Menggunakan 'Baju' jika nama model diubah sesuai konvensi
        $baju = Baju::findOrFail($id); // Gunakan findOrFail untuk error handling jika ID tidak ditemukan
        return view('baju.edit', compact('baju'));
    }

    public function update(Request $request, Baju $baju) { // Type hint Baju (jika modelnya Baju.php)
        $validated = $request->validate([
            'name' => 'required|max:255|string', // 'String' menjadi 'string'
            'type' => 'required|in:male,female',
            'size' => 'required|in:S,M,L,XL,XXL',
            // Validasi image opsional saat update, jika tidak ingin wajib diganti
            'image' => 'sometimes|image|mimes:jpg,jpeg,png,svg|max:2048', // 'sometimes' agar tidak wajib
            'description' => 'required|string|max:255', // 'String' menjadi 'string'
            'price' => 'required|integer', // 'Integer' menjadi 'integer'
            'stock' => 'required|integer|min:1', // 'Integer' menjadi 'integer'
            'status' => 'required|in:available,unavailable',
        ], [
            // Pesan validasi bisa disesuaikan atau dihilangkan jika tidak perlu
            'name.required' => 'Nama tidak boleh kosong',
            'name.max' => 'Nama maksimal 255 karakter',
            'name.string' => 'Nama harus berupa string', // 'string'
            'type.required' => 'Jenis tidak boleh kosong',
            'type.in' => 'Jenis harus berupa male atau female',
            'size.required' => 'Ukuran tidak boleh kosong',
            'size.in' => 'Ukuran harus berupa S, M, L, XL, XXL',
            // 'image.required' => 'Gambar tidak boleh kosong', // Hapus jika 'sometimes' digunakan
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Gambar harus berupa jpg, jpeg, png, svg',
            'image.max' => 'Gambar maksimal 2048 KB',
            'description.required' => 'Deskripsi tidak boleh kosong',
            'description.string' => 'Deskripsi harus berupa string', // 'string'
            'description.max' => 'Deskripsi maksimal 255 karakter',
            'price.required' => 'Harga tidak boleh kosong',
            'price.integer' => 'Harga harus berupa angka.', // 'integer'
            'stock.required' => 'Stok tidak boleh kosong',
            'stock.integer' => 'Stok harus berupa angka.', // 'integer'
            'stock.min' => 'Stok minimal 1',
            'status.required' => 'Status tidak boleh kosong',
            'status.in' => 'Status harus berupa available atau unavailable',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada dan jika gambar baru diupload
            if ($baju->image) {
                Storage::disk('public')->delete($baju->image);
            }
            $imagePath = $request->file('image')->store('images', 'public');
            $validated['image'] = $imagePath;
        }

        // Update data baju yang sudah ada
        $baju->update($validated);
        return redirect()->route('baju.index')->with('success', 'Data berhasil diperbarui');
    }

    // Tambahkan method destroy jika belum ada
    public function destroy(Baju $baju) // Type hint Baju
    {
        // Hapus gambar dari storage jika ada
        if ($baju->image) {
            Storage::disk('public')->delete($baju->image);
        }
        $baju->delete();
        return redirect()->route('baju.index')->with('success', 'Data berhasil dihapus');
    }

}
