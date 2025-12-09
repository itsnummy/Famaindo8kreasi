<div class="text-center">
    <h5>Cetak Dokumen</h5>
    
    <div class="row mt-3">
        <div class="col-md-6 mb-3">
            <a href="{{ route('cetak.faktur', $faktur->no_transaksi) }}" 
               target="_blank" 
               class="btn btn-primary btn-block">
                <i class="fas fa-file-invoice"></i> Cetak Faktur Penjualan
            </a>
        </div>
        <div class="col-md-6 mb-3">
            @if($totalDibayar >= $faktur->total_akhir)
                <a href="{{ route('cetak.surat-jalan', $faktur->no_transaksi) }}" 
                   target="_blank" 
                   class="btn btn-success btn-block">
                    <i class="fas fa-truck"></i> Cetak Surat Jalan
                </a>
            @else
                <button class="btn btn-secondary btn-block" disabled title="Hanya bisa dicetak jika sudah LUNAS">
                    <i class="fas fa-truck"></i> Cetak Surat Jalan
                </button>
                <small class="text-muted">*Hanya tersedia jika pembayaran LUNAS</small>
            @endif
        </div>
    </div>
</div>