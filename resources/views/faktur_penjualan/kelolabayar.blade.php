@extends('layouts.app')
@section('content')

@php
    $faktur_penjualan = $faktur_penjualan ?? collect();
@endphp

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelola Pembayaran</h1>
        <div>
            <a href="{{ route('faktur_penjualan.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali ke Pemesanan
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Pemesanan Belum Selesai</h6>
                    <div class="text-muted">
                        <span id="count-data">Jumlah :{{ $faktur_penjualan->count() }}</span> Pemesanan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="15%">No Transaksi</th>
                                    <th width="15%">Jatuh Tempo</th>
                                    <th width="20%">Item</th>
                                    <th width="15%">Total</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($faktur_penjualan as $index => $item)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td><strong>{{ $item->no_transaksi }}</strong></td>
                                    <td>{{ \Carbon\Carbon::parse($item->tgl_jt)->format('d/m/Y') }}</td>
                                    <td>
                                        <div>{{ $item->item_pesanan }}</div>
                                    </td>
                                    <td class="text-right">
                                        <strong>Rp {{ number_format($item->total_akhir, 0, ',', '.') }}</strong>
                                    </td>
                                  
                                    <td class="text-center">
                                      
                                        <a href="{{ route('faktur_penjualan.kelola', $item->no_transaksi) }}"
                                           class="btn btn-primary btn-sm">
                                            <i class="fas fa-cog"></i> Kelola
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                                        <h4>Semua Pemesanan Sudah Selesai!</h4>
                                        <p class="text-muted">Tidak ada pemesanan yang perlu dikelola pembayaran.</p>
                                        <a href="{{ route('faktur_penjualan.index') }}" class="btn btn-primary mt-2">
                                            Lihat Semua Pemesanan
                                        </a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection