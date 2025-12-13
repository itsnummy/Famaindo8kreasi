<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input 
                type="text" 
                class="form-control bg-light border-0 small" 
                placeholder="Cari data..."
                aria-label="Search" 
                aria-describedby="basic-addon2"
                id="mainSearch" 
            >
            <div class="input-group-append">
                <button class="btn btn-primary" type="button" id="searchButton">
                    <i class="fas fa-search fa-sm"></i>
                </button>
                <button class="btn btn-secondary" type="button" id="clearSearch" style="display: none;">
                    <i class="fas fa-times fa-sm"></i>
                </button>
            </div>
        </div>
    </form>

    <ul class="navbar-nav ml-auto"> 

        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    <span class="text-bold">{{ auth()->user()->username ?? 'Admin' }}</span>
                    <small class="d-block text-gray-600">
                        {{ auth()->user()->email ?? '-' }}
                    </small>
                </span>
                <i class="fas fa-user-circle fa-2x" style="color: #7d0b0b;"></i>
            </a>
            </li>

    </ul> </nav>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Pastikan ID ini sesuai dengan yang ada di HTML: mainSearch, searchButton, clearSearch
    const searchInput = document.getElementById('mainSearch'); 
    const searchButton = document.getElementById('searchButton');
    const clearButton = document.getElementById('clearSearch'); 
    
    // Pastikan elemen ditemukan sebelum menjalankan fungsi
    if (!searchInput || !searchButton || !clearButton) {
        console.error("Elemen pencarian tidak ditemukan di DOM.");
        return; 
    }

    function performSearch() {
        const searchTerm = searchInput.value.trim().toLowerCase();
        
        // Tampilkan tombol clear jika ada teks
        if (searchTerm.length > 0) {
            clearButton.style.display = 'block';
        } else {
            clearButton.style.display = 'none';
        }
        
        // Cari di semua tabel
        // Ini akan menyembunyikan/menampilkan baris di semua tabel pada halaman tersebut
        document.querySelectorAll('table tbody tr').forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    }
    
    function clearSearch() {
        searchInput.value = '';
        clearButton.style.display = 'none';
        performSearch(); // Tampilkan semua data
    }
    
    // Event listeners
    searchInput.addEventListener('keyup', performSearch);
    searchButton.addEventListener('click', performSearch);
    clearButton.addEventListener('click', clearSearch);
    
    // Clear search saat ganti halaman (menggunakan pageshow untuk kompatibilitas browser cache)
    window.addEventListener('pageshow', clearSearch);
});
</script>