<div class="row mt-3">
    <!-- Cetak Faktur -->
    <div class="col-md-4 mb-3">
        <a href="{{ route('cetak.faktur', $faktur->no_transaksi) }}" 
           target="_blank" 
           class="btn btn-primary btn-block">
            <i class="fas fa-file-invoice"></i> Cetak Faktur
        </a>
    </div>
    
    <!-- Cetak Surat Jalan -->
    <div class="col-md-4 mb-3">
        @if($totalDibayar >= $faktur->total_akhir)
            <a href="{{ route('cetak.surat-jalan', $faktur->no_transaksi) }}" 
               target="_blank" 
               class="btn btn-success btn-block">
                <i class="fas fa-truck"></i> Cetak Surat Jalan
            </a>
        @else
            <button class="btn btn-secondary btn-block" disabled>
                <i class="fas fa-truck"></i> Cetak Surat Jalan
            </button>
            <small class="text-muted d-block text-center mt-1">
                *Menunggu Pembayaran Lunas
            </small>
        @endif
    </div>
    
    
    <div class="col-md-4 mb-3">
        @if($kwitansi->count() > 0)
        <a href="{{ route('kwitansi.cetak-semua', $faktur->no_transaksi) }}"
           target="_blank"
           class="btn btn-info btn-block">
            <i class="fas fa-print"></i> Cetak Semua Kwitansi
        </a>
        @endif
    </div>
</div>