@extends('layouts.app')
@section('title', 'Create Beli')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create Beli</h3>
                    </div>
                    <div class="card-body">
                        {{-- Tampilkan semua error --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Terjadi kesalahan:</strong>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Tampilkan pesan sukses jika ada --}}
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- Tampilkan pesan error jika ada --}}
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('beli.store') }}" method="POST">
                            @csrf

                            {{-- Pilih Baju --}}
                            <div class="form-group mb-3">
                                <label for="baju_id" class="form-label">Pilih Baju <span class="text-danger">*</span></label>
                                <select name="baju_id" id="baju_id" class="form-control @error('baju_id') is-invalid @enderror">
                                    <option value="">-- Pilih Baju --</option>
                                    @foreach($baju as $b)
                                        <option value="{{ $b->id }}" {{ old('baju_id') == $b->id ? 'selected' : '' }}>
                                            {{ $b->name }} - Stok: {{ $b->stock }} - Harga: Rp {{ number_format($b->price ?? 0, 0, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('baju_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Jumlah --}}
                            <div class="form-group mb-3">
                                <label for="jumlah" class="form-label">Jumlah <span class="text-danger">*</span></label>
                                <input type="number"
                                       name="jumlah"
                                       class="form-control @error('jumlah') is-invalid @enderror"
                                       id="jumlah"
                                       value="{{ old('jumlah') }}"
                                       min="1"
                                       max="1000"
                                       placeholder="Masukkan jumlah pembelian">
                                @error('jumlah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-text text-muted">Jumlah minimal 1, maksimal 1000</small>
                            </div>

                            {{-- Harga --}}
                            <div class="form-group mb-3">
                                <label for="harga" class="form-label">Harga Satuan <span class="text-danger">*</span></label>
                                <input type="number"
                                       name="harga"
                                       class="form-control @error('harga') is-invalid @enderror"
                                       id="harga"
                                       value="{{ old('harga') }}"
                                       min="1000"
                                       max="10000000"
                                       placeholder="Masukkan harga satuan">
                                @error('harga')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-text text-muted">Harga minimal Rp 1.000, maksimal Rp 10.000.000</small>
                            </div>

                            {{-- Total Harga (Optional - untuk preview) --}}
                            <div class="form-group mb-3">
                                <label class="form-label">Total Harga</label>
                                <input type="text"
                                       id="total_harga"
                                       class="form-control"
                                       placeholder="Total akan dihitung otomatis"
                                       readonly>
                                <small class="form-text text-muted">Total = Jumlah × Harga Satuan</small>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan Pembelian
                                </button>
                                <a href="{{ route('beli.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript untuk kalkulasi total --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jumlahInput = document.getElementById('jumlah');
            const hargaInput = document.getElementById('harga');
            const totalInput = document.getElementById('total_harga');
            const bajuSelect = document.getElementById('baju_id');

            function calculateTotal() {
                const jumlah = parseInt(jumlahInput.value) || 0;
                const harga = parseInt(hargaInput.value) || 0;
                const total = jumlah * harga;

                if (total > 0) {
                    totalInput.value = 'Rp ' + total.toLocaleString('id-ID');
                } else {
                    totalInput.value = '';
                }
            }

            // Auto-fill harga berdasarkan baju yang dipilih
            bajuSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                if (selectedOption.value) {
                    // Ambil harga dari text option jika ada
                    const text = selectedOption.text;
                    const hargaMatch = text.match(/Harga: Rp ([\d.,]+)/);
                    if (hargaMatch) {
                        const harga = hargaMatch[1].replace(/[.,]/g, '');
                        hargaInput.value = harga;
                        calculateTotal();
                    }
                }
            });

            // Hitung total saat input berubah
            jumlahInput.addEventListener('input', calculateTotal);
            hargaInput.addEventListener('input', calculateTotal);

            // Hitung total saat halaman dimuat (untuk old values)
            calculateTotal();
        });
    </script>
@endsection
