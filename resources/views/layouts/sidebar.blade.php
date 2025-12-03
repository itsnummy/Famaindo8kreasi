<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <img src="{{ asset('img/logo-famaindo.png') }}" alt="Famaindo Logo" style="height: 40px;">
        </div>
        <div class="sidebar-brand-text mx-3">Famaindo Delapan Kreasi</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Home/Welcome Link -->
    <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-home text-warning"></i>
            <span class="text-warning">Halaman Utama</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu Kelola
    </div>

    <!-- Nav Item - Kelola Pemesanan -->
    <li class="nav-item {{ request()->is('faktur_penjualan*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('faktur_penjualan.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Kelola Pemesanan</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Akun
    </div>

    <!-- User Info -->
    <li class="nav-item">
        <div class="nav-link">
            <i class="fas fa-user-circle"></i>
            <span>
                {{ auth()->user()->nama ?? 'Admin' }}
                <small class="d-block text-light">Role: {{ auth()->user()->role ?? 'Admin' }}</small>
            </span>
        </div>
    </li>

    <!-- Logout Button dengan Style -->
    <li class="nav-item">
        <a class="nav-link" href="#" onclick="return confirmLogout(event)">
            <i class="fas fa-sign-out-alt text-danger"></i>
            <span class="text-danger">🚪 Logout</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

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