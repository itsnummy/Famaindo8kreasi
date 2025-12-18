@extends('layouts/app')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Selamat Datang, Admin!</h1>
    </div>

    <!-- Row 1: Statistik Cards -->
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

    <div class="row mb-4">
        <!-- Chart 14 Hari -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pemesanan 14 Hari Terakhir</h6>
                   <!-- <div class="dropdown">
                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown">
                            <i class="fas fa-calendar-alt"></i> Rentang
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item chart-filter-btn" href="#" data-days="7">7 Hari</a>
                            <a class="dropdown-item chart-filter-btn" href="#" data-days="14">14 Hari</a>
                            <a class="dropdown-item chart-filter-btn" href="#" data-days="30">30 Hari</a>
                        </div>
                    </div>!-->
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="orderChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

    $('.filter-btn').click(function(e) {
        e.preventDefault();
        
        const cardId = $(this).data('card');
        const filter = $(this).data('filter');
        const cardType = cardTypes[cardId];
        const filterDisplay = filterTexts[filter];
        
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
            $(`.filter-btn[data-card="${i}"][data-filter="${savedFilter}"]`).click();
        }
    }
    
    // Inisialisasi Grafik
    var orderChart;
    function initChart(labels, data) {
        var ctx = document.getElementById('orderChart').getContext('2d');
        
        if (orderChart) {
            orderChart.destroy();
        }
        
        orderChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Pemesanan',
                    data: data,
                    backgroundColor: 'rgba(78, 115, 223, 0.05)',
                    borderColor: 'rgba(78, 115, 223, 1)',
                    borderWidth: 2,
                    pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                    pointBorderColor: '#fff',
                    pointRadius: 4,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        },
                        grid: {
                            display: true
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            label: function(context) {
                                return 'Pesanan: ' + context.parsed.y;
                            }
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'nearest'
                },
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }
    
    // Load data chart awal (14 hari)
    const initialLabels = @json($chartLabels ?? []);
    const initialData = @json($chartData ?? []);
    
    if (initialLabels.length > 0 && initialData.length > 0) {
        initChart(initialLabels, initialData);
    } else {
        // Tampilkan pesan jika tidak ada data
        $('#orderChart').closest('.card-body').html('<div class="text-center text-muted py-5"><p>Belum ada data pemesanan</p></div>');
    }
    
    // Filter chart berdasarkan hari
    $('.chart-filter-btn').click(function(e) {
        e.preventDefault();
        const days = $(this).data('days');
        
        $.ajax({
            url: '{{ route("dashboard.chart") }}',
            type: 'GET',
            data: { days: days },
            success: function(response) {
                if (response.labels && response.data) {
                    initChart(response.labels, response.data);
                    
                    // Update ringkasan
                    const total = response.data.reduce((a, b) => a + b, 0);
                    const average = response.data.length > 0 ? total / response.data.length : 0;
                    const max = response.data.length > 0 ? Math.max(...response.data) : 0;
                    const min = response.data.length > 0 ? Math.min(...response.data) : 0;
                    
                    $('#total14Hari').text(total);
                    $('#rataRataHari').text(average.toFixed(1));
                    $('#tertinggi').text(max);
                    $('#terendah').text(min);
                }
            },
            error: function() {
                alert('Gagal memuat data chart');
            }
        });
    });
      
});
</script>
@endpush