@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3>Data Pelanggan</h3>
                <a href="{{ route('pelanggan.create') }}" class="btn btn-primary">Tambah</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No. Telp</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($pelanggans as $pelanggan => $item)
                            <tr>
                                <td>{{ $pelanggan + 1}}</td>
                                <td>{{ $item->nama}}</td>
                                <td>{{ $item->email}}</td> 
                                <td>{{ $item->no_hp}}</td>
                                <td>
                                    <a href="{{ route('pelanggan.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('pelanggan.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
