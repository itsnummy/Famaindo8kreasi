<div class="row">
    <div class="col-md-4">
        <!-- Form Tambah Kwitansi -->
        <div class="card">
            <div class="card-header bg-accent text-white">
                <h6 class="mb-0">Tambah Pembayaran</h6>
            </div>
            <div class="card-body">
                @if($totalDibayar >= $faktur->total_akhir)
                    <div class="alert alert-success text-center">
                        <h5><i class="fas fa-check-circle"></i> Transaksi Sudah LUNAS</h5>
                        <p class="mb-0">Silahkan cetak surat jalan di menu <strong>Cetak Dokumen</strong></p>
                    </div>
                @else
                    <form action="{{ route('kwitansi.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="no_transaksi" value="{{ $faktur->no_transaksi }}">
                        
                        <div class="form-group">
                            <label>Jumlah Bayar *</label>
                            <input type="number" class="form-control" name="sejumlah" required 
                                   min="1" max="{{ $sisa }}">
                            <small class="text-muted">Maksimal: Rp {{ number_format($sisa, 0, ',', '.') }}</small>
                        </div>
                        
                        <div class="form-group">
                            <label>Untuk Pembayaran *</label>
                            <input type="text" class="form-control" name="utk_pembayaran" placeholder="Contoh: DP pesanan tas, Pelunasan invoice, dll" required>
                            <small class="text-muted">Deskripsi tujuan pembayaran</small>
                        </div>
                        
                        <div class="form-group">
                            <label>Jenis *</label>
                            <select class="form-control" name="jenis" required>
                                <option value="1">DP</option>
                                <option value="2">Lunas</option>
                            </select>
                        </div>
                        
                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-success btn-block">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                            </div>
                            <div class="col-6">
                                <button type="reset" class="btn btn-secondary btn-block">
                                    <i class="fas fa-times"></i> Batal
                                </button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>

        <!-- Status Ringkasan -->
        <div class="card mt-3">
            <div class="card-header bg-accent text-white">
                <h6 class="mb-0">Status Pembayaran</h6>
            </div>
            <div class="card-body">
                <p>Total Pesanan: <strong>Rp {{ number_format($faktur->total_akhir, 0, ',', '.') }}</strong></p>
                <p>Sudah Dibayar: <strong>Rp {{ number_format($totalDibayar, 0, ',', '.') }}</strong></p>
                <p>Sisa: <strong>Rp {{ number_format($sisa, 0, ',', '.') }}</strong></p>
                <p>Status: 
                    <span class="badge badge-{{ $totalDibayar == 0 ? 'danger' : ($sisa > 0 ? 'warning' : 'success') }}">
                        {{ $totalDibayar == 0 ? 'Belum Bayar' : ($sisa > 0 ? 'DP' : 'LUNAS') }}
                    </span>
                </p>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <!-- Tabel Riwayat Kwitansi -->
        <div class="card">
            <div class="card-header bg-accent text-white d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Riwayat Pembayaran (Kwitansi)</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Sejumlah</th>
                                <th>Untuk Pembayaran</th>
                                <th>Jenis</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kwitansi as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>Rp {{ number_format($item->sejumlah, 0, ',', '.') }}</td>
                                <td>{{ $item->utk_pembayaran }}</td>
                                <td>
                                    <span class="badge badge-{{ $item->jenis == 1 ? 'warning' : 'success' }}">
                                        {{ $item->jenis == 1 ? 'DP' : 'Lunas' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('preview.kwitansi', $item->id) }}" 
                                           target="_blank" 
                                           class="btn btn-sm btn-primary" 
                                           title="Cetak Kwitansi">
                                            <i class="fas fa-print"></i>
                                        </a>
                                        <form action="{{ route('kwitansi.destroy', $item->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Hapus pembayaran ini?')"
                                                    title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            
                            @if($kwitansi->count() == 0)
                            <tr>
                                <td colspan="5" class="text-center">Belum ada pembayaran</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert untuk flash messages -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tampilkan SweetAlert untuk flash messages dari session
    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        timer: 3000,
        showConfirmButton: false
    });
    @endif
    
    @if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '{{ session('error') }}',
        timer: 3000,
        showConfirmButton: false
    });
    @endif
    
    // Validasi jumlah bayar sebelum submit form
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const jumlahInput = document.querySelector('input[name="sejumlah"]');
            if (jumlahInput) {
                const max = parseFloat(jumlahInput.max);
                const value = parseFloat(jumlahInput.value);
                
                if (value > max) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Jumlah Melebihi Batas',
                        text: 'Jumlah bayar tidak boleh melebihi sisa pembayaran Rp ' + max.toLocaleString('id-ID'),
                    });
                    jumlahInput.focus();
                }
            }
        });
    }
});
</script>