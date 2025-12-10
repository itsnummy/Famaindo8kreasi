<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion sticky-sidebar" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <img src="{{ asset('img/logo-famaindo.png') }}" alt="Famaindo Logo" style="height: 40px;">
        </div>
        <div class="sidebar-brand-text mx-3">Famaindo Delapan Kreasi</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Halaman Utama -->
    <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-home"></i>
            <span>Halaman Utama</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading: Menu Kelola -->
    <div class="sidebar-heading">
        Menu Transaksi
    </div>

    <!-- Kelola Pemesanan -->
    <li class="nav-item {{ request()->is('faktur_penjualan*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('faktur_penjualan.index') }}">
            <i class="fas fa-file-invoice"></i>
            <span>Kelola Pemesanan</span>
        </a>
    </li>

      <li class="nav-item {{ request()->is('kelola-pembayaran*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('faktur_penjualan.kelolabayar') }}">
            <i class="fas fa-money-bill-wave"></i>
            <span>Kelola Pembayaran</span>
            @php
                $countUnfinished = \App\Models\faktur_penjualan::where('status', '!=', 'selesai')
                    ->orWhereNull('status')
                    ->count();
            @endphp
            @if($countUnfinished > 0)
                <span class="badge badge-danger badge-counter">{{ $countUnfinished }}</span>
            @endif
        </a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading: Akun -->
    <div class="sidebar-heading">
       Menu Akun
    </div>

    <!-- Kelola Akun -->
    <li class="nav-item {{ request()->is('users*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-users"></i>
            <span>Kelola Akun</span>
        </a>
    </li>

    <!-- Logout -->
    <li class="nav-item">
        <a class="nav-link" href="#" onclick="return confirmLogout(event)">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

<script>
function confirmLogout(event) {
    event.preventDefault();
    
    if (confirm('Anda yakin ingin keluar?')) {
        document.getElementById('logout-form').submit();
        return true;
    }
    return false;
}
</script>