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
                       
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            
                            <!-- Email/Username -->
                            <div class="form-group mb-4">
                                <label for="login">Email atau Username</label>
                                <input 
                                    type="text" 
                                    id="login"
                                    name="login" 
                                    class="form-control" 
                                    placeholder="Email atau username Anda" 
                                    required 
                                    autofocus
                                >
                            </div>
                            
                            <!-- Password -->
                            <div class="form-group mb-4">
                                <label for="password">Password</label>
                                <input 
                                    type="password" 
                                    id="password"
                                    name="password" 
                                    class="form-control" 
                                    placeholder="Masukkan password" 
                                    required
                                >
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