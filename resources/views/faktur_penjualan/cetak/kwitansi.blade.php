<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi - {{ $faktur->no_transaksi }}</title>
    
    <style>
        /* Ukuran dalam points: 603.78pt x 306.14pt (21.3cm x 10.8cm) */
        @page {
            size: 603.78pt 306.14pt;
            margin: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 10px;
            line-height: 1.2;
            color: #000;
            margin: 14.17pt 14.17pt 10pt 14.17pt; /* Top, Right, Bottom, Left */
            padding: 0;
            width: 575.44pt;
            height: 282.14pt; /* Sesuaikan dengan margin bottom yang lebih kecil */
            box-sizing: border-box;
        }

        /* Container Utama */
        .kwitansi-container {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        /* HEADER & LOGO - DIPERBAIKI */
        .header-kwitansi {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8.5pt; /* 3mm */
            height: 31.5pt; /* Diperbesar sedikit */
            flex-shrink: 0;
        }

        /* KIRI: Logo + Nama Perusahaan */
        .header-left {
            display: flex;
            align-items: center;
            width: 55%; /* Diperbesar */
            gap: 8.5pt; /* Jarak antara logo dan teks */
        }

        .logo-famaindo {
            width: 70pt !important; /* Diperbesar */
            height: 35pt !important;
            object-fit: contain;
            flex-shrink: 0;
        }

        .company-name-kwitansi {
            font-family: Arial, sans-serif;
            font-weight: bold;
            color: #7d0b0b;
            font-size: 13px !important; /* Sedikit lebih besar */
            line-height: 1.1;
            white-space: nowrap;
        }

        /* KANAN: Dua logo lainnya */
        .header-right {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 14.17pt; /* Jarak diperbesar (5mm) */
            width: 45%; /* Dikurangi */
            padding-right: 0; /* Hapus padding kanan */
        }

        .logo-fama {
            width: 63.78pt !important; /* Diperbesar */
            height: 31.5pt !important;
            object-fit: contain;
            flex-shrink: 0;
        }

        .logo-audia {
            width: 77.95pt !important; /* Diperbesar */
            height: 31.5pt !important;
            object-fit: contain;
            flex-shrink: 0;
        }

        /* JUDUL */
        .title {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin: 5.67pt 0 8.5pt 0; /* Atur margin atas-bawah */
            padding-bottom: 2.13pt;
            flex-shrink: 0;
            border-bottom: 0.71pt solid #7d0b0b; /* Garis merah untuk estetika */
        }

        /* TABLE BODY KWITANSI */
        .kwitansi-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
            flex-grow: 1;
            margin-top: 5.67pt; /* Tambah margin atas */
        }
        
        .kwitansi-table tr {
            height: 16.54pt;
        }
        
        .kwitansi-table td {
            padding: 2.83pt 0;
            vertical-align: top;
        }
        
        .kwitansi-label {
            width: 85.04pt;
            font-weight: bold;
            padding-left: 5.67pt; /* Ditambah */
        }
        
        .kwitansi-separator {
            width: 7.09pt;
            text-align: center;
        }
        
        .kwitansi-value {
            flex: 1;
        }

        /* Kotak Isian */
        .input-box {
            border: 0.71pt solid #ccc;
            padding: 2.13pt 4.25pt; /* Padding diperbesar */
            min-height: 12.75pt; /* Sedikit lebih tinggi */
            width: 95%;
            display: inline-block;
            box-sizing: border-box;
            background: #f9f9f9; /* Warna latar sedikit */
        }

        /* Kotak Khusus Jumlah */
        .amount-box {
            border: 0.71pt solid #000000ff; /* Border merah */
            padding: 2.13pt 4.25pt;
            min-height: 12.75pt;
            width: 85.04pt; /* Diperbesar (30mm) */
            text-align: right;
            font-weight: bold;
            display: inline-block;
            box-sizing: border-box;
            background: #fff;
            color: #000000ff; /* Warna merah */
        }
        
        .text-bold { 
            font-weight: bold; 
        }

        /* FOOTER - KOSONG */
        .footer-kwitansi {
            margin-top: 8.5pt;
            height: 21.26pt; /* Dikurangi (7.5mm) */
            flex-shrink: 0;
        }

        /* TANGGAL */
        .date-info {
            position: absolute;
            bottom: 14.17pt;
            right: 14.17pt;
            font-size: 9px;
            font-style: italic;
            color: #666;
        }

        /* Print specific styles */
        @media print {
            body {
                margin: 14.17pt 14.17pt 10pt 14.17pt;
                width: 575.44pt;
                height: 282.14pt;
            }
            
            .input-box {
                background: transparent; /* Transparent saat print */
            }
        }

    </style>
</head>
<body {{ !$is_preview ? 'onload="window.print()"' : '' }}>
    <div class="kwitansi-container">
        
        <div class="header-kwitansi">
            <!-- KIRI: Logo Famaindo + Nama Perusahaan -->
            <div class="header-left">
                <img
                    src="{{ asset('img/logomerah.png') }}"
                    alt="Logo Famaindo"
                    class="logo-famaindo"
                >
                <div class="company-name-kwitansi">PT. Famaindo<br>Delapan Kreasi</div>
            </div>
            
            <!-- KANAN: Dua logo lainnya -->
            <div class="header-right">
                <img
                    src="{{ asset('img/famamerah.png') }}"
                    alt="Logo Fama"
                    class="logo-fama"
                >
                <img
                    src="{{ asset('img/audia.png') }}"
                    alt="Logo Audia"
                    class="logo-audia"
                >
            </div>
        </div>

        <div class="title">KWITANSI</div>

        <table class="kwitansi-table">
            <tr>
                <td class="kwitansi-label">Nomor Bukti</td>
                <td class="kwitansi-separator">:</td>
                <td class="kwitansi-value">
                    <div class="input-box" style="width: 177.17pt;">
                        {{ $kwitansi->no_kwitansi ?? str_replace('-', '/', $faktur->no_transaksi) }}
                    </div>
                </td>
            </tr>
            <tr>
                <td class="kwitansi-label">Sudah Terima Dari</td>
                <td class="kwitansi-separator">:</td>
                <td class="kwitansi-value">
                    <div class="input-box text-bold">
                        {{ $faktur->pelanggan }}
                    </div>
                </td>
            </tr>
            <tr>
                <td class="kwitansi-label">Terbilang</td>
                <td class="kwitansi-separator">:</td>
                <td class="kwitansi-value">
                    <div class="input-box">
                        (<span class="text-bold">{{ $terbilang ?? $kwitansi->terbilang_formatted }}</span>)
                    </div>
                </td>
            </tr>
            <tr>
                <td class="kwitansi-label">Untuk Pembayaran</td>
                <td class="kwitansi-separator">:</td>
                <td class="kwitansi-value">
                    <div class="input-box" style="width: 95%;">
                        {{ $kwitansi->utk_pembayaran }}
                    </div>
                </td>
            </tr>
            <tr>
                <td class="kwitansi-label">Sejumlah</td>
                <td class="kwitansi-separator">:</td>
                <td class="kwitansi-value">
                    <div class="amount-box">
                       Rp {{ number_format($kwitansi->sejumlah ?? $faktur->total_akhir, 0, ',', '.') }}
                    </div>
                </td>
            </tr>
        </table>

        <div class="footer-kwitansi">
            <!-- Kosong -->
        </div>
        
        <!-- Tanggal di footer -->
        <div class="date-info">
            {{ $tanggal_formatted ?? date('d F Y', strtotime($kwitansi->tanggal ?? $kwitansi->created_at)) }}
        </div>

    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>