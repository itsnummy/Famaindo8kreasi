@extends('layouts/app')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Selamat Datang, Admin!</h1>
    </div>

    <div class="row">
        <!-- Card 1: Total Pemesanan -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Pemesanan <span class="filter-text" id="filterText1">| Hari ini</span>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="cardValue1">{{ $totalPemesanan ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent py-1">
                    <div class="dropdown text-right">
                        <button class="btn btn-sm btn-link text-gray-600" data-toggle="dropdown">
                            <i class="fas fa-filter"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item filter-btn" href="#" data-card="1" data-filter="hari_ini">Hari ini</a>
                            <a class="dropdown-item filter-btn" href="#" data-card="1" data-filter="minggu_ini">Minggu ini</a>
                            <a class="dropdown-item filter-btn" href="#" data-card="1" data-filter="bulan_ini">Bulan ini</a>
                            <a class="dropdown-item filter-btn" href="#" data-card="1" data-filter="tahun_ini">Tahun ini</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Progress -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Progress <span class="filter-text" id="filterText2">| Hari ini</span>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="cardValue2">{{ $pemesananProgress ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-spinner fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent py-1">
                    <div class="dropdown text-right">
                        <button class="btn btn-sm btn-link text-gray-600" data-toggle="dropdown">
                            <i class="fas fa-filter"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item filter-btn" href="#" data-card="2" data-filter="hari_ini">Hari ini</a>
                            <a class="dropdown-item filter-btn" href="#" data-card="2" data-filter="minggu_ini">Minggu ini</a>
                            <a class="dropdown-item filter-btn" href="#" data-card="2" data-filter="bulan_ini">Bulan ini</a>
                            <a class="dropdown-item filter-btn" href="#" data-card="2" data-filter="tahun_ini">Tahun ini</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3: Lunas -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Lunas <span class="filter-text" id="filterText3">| Hari ini</span>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="cardValue3">{{ $pembayaranLunas ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent py-1">
                    <div class="dropdown text-right">
                        <button class="btn btn-sm btn-link text-gray-600" data-toggle="dropdown">
                            <i class="fas fa-filter"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item filter-btn" href="#" data-card="3" data-filter="hari_ini">Hari ini</a>
                            <a class="dropdown-item filter-btn" href="#" data-card="3" data-filter="minggu_ini">Minggu ini</a>
                            <a class="dropdown-item filter-btn" href="#" data-card="3" data-filter="bulan_ini">Bulan ini</a>
                            <a class="dropdown-item filter-btn" href="#" data-card="3" data-filter="tahun_ini">Tahun ini</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 4: Belum Lunas -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Belum Lunas <span class="filter-text" id="filterText4">| Hari ini</span>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="cardValue4">{{ $pembayaranBelumLunas ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent py-1">
                    <div class="dropdown text-right">
                        <button class="btn btn-sm btn-link text-gray-600" data-toggle="dropdown">
                            <i class="fas fa-filter"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item filter-btn" href="#" data-card="4" data-filter="hari_ini">Hari ini</a>
                            <a class="dropdown-item filter-btn" href="#" data-card="4" data-filter="minggu_ini">Minggu ini</a>
                            <a class="dropdown-item filter-btn" href="#" data-card="4" data-filter="bulan_ini">Bulan ini</a>
                            <a class="dropdown-item filter-btn" href="#" data-card="4" data-filter="tahun_ini">Tahun ini</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Mapping card ke tipe data
    const cardTypes = {
        1: 'totalPemesanan',
        2: 'pemesananProgress', 
        3: 'pembayaranLunas',
        4: 'pembayaranBelumLunas'
    };
    
    // Mapping filter ke teks
    const filterTexts = {
        'hari_ini': 'Hari ini',
        'minggu_ini': 'Minggu ini',
        'bulan_ini': 'Bulan ini',
        'tahun_ini': 'Tahun ini'
    };
    
    // Format angka
    function formatNumber(num) {
        return new Intl.NumberFormat('id-ID').format(num);
    }
    
    // Event handler untuk semua filter button
    $('.filter-btn').click(function(e) {
        e.preventDefault();
        
        const cardId = $(this).data('card');
        const filter = $(this).data('filter');
        const cardType = cardTypes[cardId];
        const filterDisplay = filterTexts[filter];
        
        // Tampilkan loading
        const cardValue = $('#cardValue' + cardId);
        cardValue.html('<span class="spinner-border spinner-border-sm"></span>');
        
        // Kirim request AJAX
        $.ajax({
            url: '{{ route("dashboard.filter") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                type: cardType,
                filter: filter
            },
            success: function(response) {
                // Update nilai card
                cardValue.text(formatNumber(response.value));
                
                // Update teks filter
                $('#filterText' + cardId).text('| ' + filterDisplay);
                
                // Simpan ke localStorage
                localStorage.setItem('card_' + cardId + '_filter', filter);
            },
            error: function(xhr) {
                console.log('Error:', xhr);
                cardValue.text('Error');
            }
        });
    });
    
    // Load filter yang disimpan di localStorage
    for (let i = 1; i <= 4; i++) {
        const savedFilter = localStorage.getItem('card_' + i + '_filter');
        if (savedFilter) {
            // Trigger click pada filter yang disimpan
            $(`.filter-btn[data-card="${i}"][data-filter="${savedFilter}"]`).click();
        }
    }
});
</script>
@endpush