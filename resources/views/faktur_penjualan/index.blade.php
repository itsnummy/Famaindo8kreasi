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
                            <a class="btn btn-primary mb-3" href="{{route('faktur_penjualan.create')}}">Tambah Data</a>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Pelanggan</th>
                                            <th>Item Pesanan</th>
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
                                            <td>{{$faktur->item_pesanan}}</td>
                                            <td>{{$faktur->total_akhir}}</td>
                                            <td>{{$faktur->status}}</td>
                                         <td>
                                            {{-- TOMBOL KELOLA --}}
                                           <a href="/faktur_penjualan/kelola/{{ $faktur->no_transaksi }}"
                                            class="btn btn-sm btn-info">
                                                <i class="fas fa-cog"></i> Kelola
                                            </a>

                                            <a class="btn btn-sm btn-primary" href="{{ route('faktur_penjualan.edit', $faktur->no_transaksi) }}">Ubah</a>

                                            <form action="{{ route('faktur_penjualan.destroy', $faktur->no_transaksi) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Anda Yakin ingin Menghapus Data?')">Hapus</button>
                                            </form>
                                        </td>
                                        </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- INCLUDE MODAL KELOLA -->
 @endsection
 @push('scripts')
<script>
$(document).ready(function() {
    $('.btn-kelola').click(function() {
        const id = $(this).data('id');
        const pelanggan = $(this).data('pelanggan');
        const kontak = $(this).data('kontak');
        const item = $(this).data('item');
        const total = $(this).data('total');
        
        console.log('Tombol kelola diklik:', id, pelanggan);
        
        // Set data ke modal
        $('#modal-pelanggan').text(pelanggan);
        $('#display-pelanggan').text(pelanggan);
        $('#display-id').text(id);
        
        // Tampilkan modal
        $('#modalKelola').modal('show');
    });
});
</script>
@endpush