@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="text-center my-5">Selamat Datang di Sistem Faktur Penjualan</h1>
            
            <!-- Konten dashboard publik -->
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Informasi Umum</h5>
                            <p class="card-text">Sistem manajemen faktur penjualan untuk perusahaan.</p>
                        </div>
                    </div>
                </div>
                <!-- ... konten lainnya ... -->
            </div>
            
            <!-- Tombol login untuk admin (hanya tampil jika belum login) -->
            @if(!auth()->check())
            <div class="text-center mt-5">
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-sign-in-alt"></i> Login Admin
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection