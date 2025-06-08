@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3>Baju</h3>
                <a href="{{ route('baju.create') }}" class="btn btn-primary">Tambah</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Size</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Stok</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($baju as $item => $satu)
                            <tr>
                                <td>{{ $item + 1 }}</td>
                                <td>{{ $satu->name }}</td>
                                <td>{{ $satu->type }}</td>
                                <td>{{ $satu->size }}</td>
                                <td>{{ $satu->description }}</td>
                                <td>{{ $satu->price }}</td>
                                <td>{{ $satu->stok }}</td>
                                <td>{{ $satu->status }}</td>
                                <td><img src="{{ asset('storage/' . $satu->image) }}" alt="" width="100px"></td>
                                <td class="text-center">
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="{{ route('baju.edit', $satu->id) }}"
                                           class="btn btn-sm btn-warning"
                                           data-bs-toggle="tooltip"
                                           title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <form action="{{ route('baju.destroy', $satu->id) }}"
                                              method="POST"
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-danger"
                                                    data-bs-toggle="tooltip"
                                                    title="Delete"
                                                    onclick="return confirm('Are you sure you want to delete this item?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

@endsection
