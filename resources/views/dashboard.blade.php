@extends('layouts/app')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Stats Utama -->
    <div class="row">
        <!-- Total Pemesanan -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Pemesanan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPemesanan ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pemesanan Progress -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Progress</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pemesananProgress ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-spinner fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pemesanan Lunas -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Lunas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pembayaranLunas ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Belum Lunas -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Belum Lunas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pembayaranBelumLunas ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pemesanan Belum Lunas -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-danger text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-exclamation-triangle mr-2"></i>Pemesanan Belum Lunas
                    </h6>
                </div>
                <div class="card-body">
                    @if($pemesananBelumLunas && $pemesananBelumLunas->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>No Transaksi</th>
                                    <th>Pelanggan</th>
                                    <th>Kontak</th>
                                    <th>Total</th>
                                    <th>Sisa</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pemesananBelumLunas as $faktur)
                                @php
                                    $totalDibayar = $faktur->kwitansi->sum('sejumlah');
                                    $sisa = $faktur->total_akhir - $totalDibayar;
                                @endphp
                                <tr>
                                    <td>{{ $faktur->no_transaksi }}</td>
                                    <td>{{ $faktur->pelanggan }}</td>
                                    <td>{{ $faktur->kontak_wa }}</td>
                                    <td>Rp {{ number_format($faktur->total_akhir, 0, ',', '.') }}</td>
                                    <td class="text-danger">Rp {{ number_format($sisa, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('faktur_penjualan.kelola', $faktur->no_transaksi) }}" 
                                           class="btn btn-sm btn-danger">
                                            <i class="fas fa-cog"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-4">
                        <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                        <h5 class="text-success">Tidak ada pemesanan belum lunas</h5>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection