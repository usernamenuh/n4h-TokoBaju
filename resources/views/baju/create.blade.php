@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <a href="{{ route('baju.index') }}" class="btn btn-primary">Kembali</a>
                <h3>Tambah Data Baju</h3>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('baju.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-2">
                        <label for="name">Nama</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Masukkan nama" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="type">Type</label>
                        <select name="type" id="type" class="form-control @error('type') is-invalid @enderror">
                            <option value="">Type</option>
                            <option value="male" {{ old('type', $baju->type ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('type', $baju->type ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="size">Size</label>
                        <select name="size" class="form-select">
                        <option value="">Pilih Size</option>
    @foreach (['S', 'M', 'L', 'XL', 'XXL'] as $size)
        <option value="{{ $size }}" {{ old('size', $baju->size ?? '') == $size ? 'selected' : '' }}>
            {{ $size }}
        </option>
    @endforeach
</select>
                        @error('size')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control @error('description') is-invalid @enderror"
              id="description"
              name="description"
              rows="4"
              placeholder="Enter description here">{{ old('description', $baju->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
                    <div class="form-group mb-2">
                        <label for="price">Price</label>
                        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="Masukkan harga" value="{{ old('price') }}">
                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="stock">Stock</label>
                        <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" id="stock" placeholder="Masukkan stock" value="{{ old('stock') }}">
                        @error('stock')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="status">Status</label>
                        <select name="status" class="form-select">
    <option value="">Pilih Status</option>
    <option value="available" {{ old('status', $baju->status ?? '') == 'available' ? 'selected' : '' }}>Available</option>
    <option value="unavailable" {{ old('status', $baju->status ?? '') == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
</select>
                        @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="image">Image</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="image">
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
