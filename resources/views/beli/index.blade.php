@extends('layouts.app')
@section('title', 'Daftar Pembelian')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Daftar Pembelian</h3>
                        <div class="card-tools">
                            <a href="{{ route('beli.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Pembelian
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="table-dark">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="25%">Nama Baju</th>
                                    <th width="10%">Jumlah</th>
                                    <th width="15%">Harga Satuan</th>
                                    <th width="15%">Total Harga</th>
                                    <th width="20%">Tanggal Pembelian</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($beli as $index => $item)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>
                                            @if($item->baju)
                                                {{ $item->baju->name ?? $item->baju->name ?? 'Nama tidak tersedia' }}
                                            @else
                                                <span class="text-danger">Baju tidak ditemukan</span>
                                            @endif
                                        </td>
                                        <td class="text-center">{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                        <td class="text-end">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                        <td class="text-end">
                                            <strong>Rp {{ number_format($item->jumlah * $item->harga, 0, ',', '.') }}</strong>
                                        </td>
                                        <td class="text-center">
                                            {{ $item->created_at->format('d/m/Y H:i') }}
                                            <br>
                                            <small class="text-muted">{{ $item->created_at->diffForHumans() }}</small>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-info"
                                                    data-bs-toggle="tooltip"
                                                    title="Detail Pembelian #{{ $item->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-shopping-cart fa-3x mb-3"></i>
                                                <br>
                                                <h5>Belum ada data pembelian</h5>
                                                <p>Klik tombol "Tambah Pembelian" untuk memulai</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                                @if($beli->count() > 0)
                                    <tfoot class="table-dark">
                                    <tr>
                                        <td colspan="4" class="text-end"><strong>Total Keseluruhan:</strong></td>
                                        <td class="text-end">
                                            <strong>Rp {{ number_format($beli->sum(function($item) { return $item->jumlah * $item->harga; }), 0, ',', '.') }}</strong>
                                        </td>
                                        <td colspan="2"></td>
                                    </tr>
                                    </tfoot>
                                @endif
                            </table>
                        </div>

                        @if($beli->count() > 0)
                            <div class="mt-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <small class="text-muted">
                                            Total {{ $beli->count() }} pembelian ditemukan
                                        </small>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <small class="text-muted">
                                            Terakhir diperbarui: {{ now()->format('d/m/Y H:i') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script untuk tooltip --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@endsection
