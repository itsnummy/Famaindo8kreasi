@extends('layouts.app')

@section('content')
<div class="login-page">
    <div class="container login-container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8">
                <div class="card login-card shadow-lg">
                    <div class="login-header text-white">
                        <!-- Logo -->
                        <div class="login-logo">
                            <img src="{{ asset('img/logofama.png') }}" alt="Fama Logo" class="logo-fama">
                        </div>
                        
                        <!-- Judul -->
                        <p class="mb-0" style="opacity: 0.9;"> Login Admin Penjualan Tas Custom</p>
                    </div>
                    
                    <div class="card-body p-4 p-md-5">
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                {{ $errors->first() }}
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                       
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            
                            <!-- Email/Username -->
                            <div class="form-group mb-4">
                                <label for="login">Email atau Username</label>
                                <input 
                                    type="text" 
                                    id="login"
                                    name="login" 
                                    class="form-control @error('login') is-invalid @enderror" 
                                    placeholder="Email atau username Anda" 
                                    required 
                                    autofocus
                                    value="{{ old('login') }}"
                                >
                                @error('login')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <!-- Password -->
                            <div class="form-group mb-4">
                                <label for="password">Password</label>
                                <input 
                                    type="password" 
                                    id="password"
                                    name="password" 
                                    class="form-control @error('password') is-invalid @enderror" 
                                    placeholder="Masukkan password" 
                                    required
                                >
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-login btn-block text-white mb-3">
                                Login
                            </button>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection