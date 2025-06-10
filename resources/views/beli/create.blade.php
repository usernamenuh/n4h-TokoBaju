
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
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('beli.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="baju_id">Pilih Baju</label>
                                <select name="baju_id" id="baju_id" class="form-control">
                                    <option value="">Pilih Baju</option>
                                    @foreach($baju as $b)
                                        <option value="{{ $b->id }}">{{ $b->nama }} - Stok: {{ $b->stok }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" name="jumlah" class="form-control" id="jumlah" value="{{ old('jumlah') }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="harga">Harga</label>
                                <input type="number" name="harga" class="form-control" id="harga" value="{{ old('harga') }}" required>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('beli.index') }}" class="btn btn-secondary">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
