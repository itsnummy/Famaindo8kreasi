@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Pembayaran - {{ $faktur->pelanggan }}</h1>
    
    <!-- Tab Navigation -->
    <ul class="nav nav-tabs" id="kelolaTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="kontak-tab" data-toggle="tab" href="#kontak" role="tab">
                Kontak & Tagih
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pembayaran-tab" data-toggle="tab" href="#pembayaran" role="tab">
                Kelola Pembayaran
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="cetak-tab" data-toggle="tab" href="#cetak" role="tab">
                Cetak Dokumen
            </a>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content mt-3" id="kelolaTabsContent">
        <div class="tab-pane fade show active" id="kontak" role="tabpanel">
            @include('faktur_penjualan.kelola.partials.kontak')
        </div>
        
        <div class="tab-pane fade" id="pembayaran" role="tabpanel">
            @include('faktur_penjualan.kelola.partials.pembayaran', [
    'faktur' => $faktur, 
    'kwitansi' => $kwitansi,
    'totalDibayar' => $totalDibayar,
    'sisa' => $sisa
])
        </div>
        
        <div class="tab-pane fade" id="cetak" role="tabpanel">
            @include('faktur_penjualan.kelola.partials.cetak')
        </div>
    </div>
</div>

<div class="mt-3 text-right">
    <a href="{{ route('faktur_penjualan.kelolabayar') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

@endsection