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
        Menu Kelola
    </div>

    <!-- Kelola Pemesanan -->
    <li class="nav-item {{ request()->is('faktur_penjualan*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('faktur_penjualan.index') }}">
            <i class="fas fa-file-invoice"></i>
            <span>Kelola Pemesanan</span>
        </a>
    </li>

    <!-- Kelola Akun -->
    <li class="nav-item {{ request()->is('users*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-users"></i>
            <span>Kelola Akun</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading: Akun -->
    <div class="sidebar-heading">
        Akun
    </div>

    <!-- Info User -->
    <li class="nav-item">
        <div class="nav-link">
            <i class="fas fa-user-circle"></i>
            <span>
                {{ auth()->user()->name ?? 'Admin' }}
                <small class="d-block text-light">
                    {{ auth()->user()->email ?? '-' }}
                </small>
            </span>
        </div>
    </li>

    <!-- Edit Profile (jika ada) -->
    @if(Route::has('profile.edit'))
    <li class="nav-item {{ request()->is('profile') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('profile.edit') }}">
            <i class="fas fa-user-edit"></i>
            <span>Edit Profile</span>
        </a>
    </li>
    @endif

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