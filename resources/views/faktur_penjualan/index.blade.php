@extends('layouts/app')
@section('content')

@if(session('success'))
<p class="alert alert-success">{{session('success')}}</p>
@endif

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
      
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
              
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Kelola Pemesanan</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Pemesanan</h6>
                        </div>
                        <div class="card-body">
                            <a class="btn btn-primary mb-3" href="{{route('faktur_penjualan.create')}}"><i class="fas fa-plus"></i> Tambah Pemesanan</a>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead  class="thead-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Pelanggan</th>
                                            <th>Item</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                            
                                    <tbody>
                                        <?php $no= 1 ?>
                                        @foreach($faktur_penjualan as $faktur)
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{$faktur->pelanggan}}</td>
                                            <td>{{$faktur->kode_item}}</td>
                                            <td>Rp {{ number_format($faktur->total_akhir, 0, ',', '.') }}</td>
                                            <td>
                                                @if($faktur->status == 'selesai')
                                                    <span class="badge badge-success">Selesai</span>
                                                @else
                                                    <span class="badge badge-warning">Progress</span>
                                                @endif
                                            </td>
                                         <td>
                                            <div class="btn-group">

                                                @if($faktur->status != 'selesai')
                                                    <a class="btn btn-sm btn-warning" href="{{ route('faktur_penjualan.edit', $faktur->no_transaksi) }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @else
                                                    <button class="btn btn-sm btn-secondary" disabled title="Tidak dapat diedit karena sudah selesai">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                @endif

                                                <form action="{{ route('faktur_penjualan.destroy', $faktur->no_transaksi) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-primary" onclick="return confirm('Anda Yakin ingin Menghapus Data?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>

                                                @if($faktur->status != 'selesai')
                                                    <button class="btn btn-sm btn-success btn-selesai" 
                                                            data-id="{{ $faktur->no_transaksi }}"
                                                            data-pelanggan="{{ $faktur->pelanggan }}"
                                                            title="Tandai Selesai">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                @else
                                                    <button class="btn btn-sm btn-secondary" disabled title="Sudah Selesai">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>


<div class="modal fade" id="modalSelesai" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Penyelesaian Pemesanan</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Apakah pemesanan untuk <strong id="modal-pelanggan-selesai"></strong> sudah selesai semua?</p>
                <p class="text-muted">Pastikan semua proses sudah lengkap sebelum menandai sebagai selesai.</p>
            </div>
            <div class="modal-footer">
                <form id="form-selesai" method="POST" style="display: inline;">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check"></i> Ya, Tandai Selesai
                    </button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    
    // Tombol tandai selesai
    $('.btn-selesai').click(function() {
        const id = $(this).data('id');
        const pelanggan = $(this).data('pelanggan');
        
        // Set data di modal
        $('#modal-pelanggan-selesai').text(pelanggan);
        
        // Set action form
        $('#form-selesai').attr('action', '/faktur_penjualan/' + id + '/selesai');
        
        // Tampilkan modal
        $('#modalSelesai').modal('show');
    });

    // SweetAlert untuk sukses
    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        timer: 3000,
        showConfirmButton: false
    });
    @endif

    // SweetAlert untuk error
    @if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: '{{ session('error') }}',
        timer: 3000,
        showConfirmButton: false
    });
    @endif
});
</script>
@endpush