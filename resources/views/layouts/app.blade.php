<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Famaindo</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="https://api.fontshare.com/v2/css?f[]=circular-std@700&display=swap" rel="stylesheet">

    @stack('styles')
</head>

<body id="page-top">
    
    @if(Request::is('login'))
        <!-- ==================== LAYOUT UNTUK HALAMAN LOGIN ==================== -->
        <!-- Hanya halaman login (tanpa sidebar/navbar) -->
        @yield('content')
        
    @elseif(auth()->check() && auth()->user()->role === 'admin')
        <!-- ==================== LAYOUT UNTUK ADMIN YANG SUDAH LOGIN ==================== -->
        <div id="wrapper">
            <!-- Sidebar -->
            @include('layouts.sidebar')
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content">
                    <!-- Topbar -->
                    @include('layouts.navbar')
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <!-- Page Heading (opsional, bisa di-view masing-masing) -->
                        @if(!isset($hidePageHeading) || !$hidePageHeading)
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">
                                @yield('title', 'Selamat Datang!')
                            </h1>
                            @hasSection('action_button')
                                @yield('action_button')
                            @else
                                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                    <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
                                </a>
                            @endif
                        </div>
                        @endif
                        
                        <!-- Konten Utama -->
                        @yield('content')
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                @include('layouts.footer')
                <!-- End of Footer -->
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Siap untuk Keluar?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Pilih "Logout" di bawah jika Anda siap mengakhiri sesi saat ini.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <a class="btn btn-primary" href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    @else
        <!-- ==================== LAYOUT UNTUK GUEST (TANPA LOGIN) ==================== -->
        <!-- Navbar sederhana untuk guest -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
            <div class="container">
                <a class="navbar-brand font-weight-bold text-primary" href="/">
                    <i class="fas fa-chart-line"></i> Famaindo
                </a>
                <div class="navbar-nav ml-auto">
                    <a href="{{ route('login') }}" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt"></i> Login Admin
                    </a>
                </div>
            </div>
        </nav>

        <!-- Konten utama untuk guest -->
        <main class="py-4">
            @yield('content')
        </main>

        <!-- Footer sederhana untuk guest -->
        <footer class="bg-light py-4 mt-5">
            <div class="container text-center">
                <p class="mb-0 text-muted">&copy; {{ date('Y') }} Famaindo. All rights reserved.</p>
            </div>
        </footer>
    @endif

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    @if(auth()->check() && auth()->user()->role === 'admin')
        <!-- Custom scripts for all pages (hanya untuk admin)-->
        <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

        <!-- Page level plugins (hanya untuk admin) -->
        <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts (hanya untuk admin) -->
        <script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
        <script src="{{asset('js/demo/chart-pie-demo.js')}}"></script>
        <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
    @endif

    @stack('scripts')
</body>

</html>