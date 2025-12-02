<div class="row">
    <div class="col-md-4">
        <!-- Form Tambah Kwitansi -->
        <div class="card">
            <div class="card-header bg-success text-white">
                <h6 class="mb-0">Tambah Pembayaran</h6>
            </div>
            <div class="card-body">
                <form action="/kwitansi" method="POST">
                    @csrf
                    <input type="hidden" name="no_transaksi" value="{{ $faktur->no_transaksi }}">
                    
                    <div class="form-group">
                        <label>Jumlah Bayar *</label>
                        <input type="number" class="form-control" name="sejumlah" required 
                               min="1" max="{{ $faktur->total_akhir }}">
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
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <!-- Tabel Riwayat Kwitansi -->
        <div class="card">
            <div class="card-header bg-info text-white">
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
                                    <form action="{{ route('kwitansi.destroy', $item->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus pembayaran ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
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

<!-- Tombol Kembali -->
