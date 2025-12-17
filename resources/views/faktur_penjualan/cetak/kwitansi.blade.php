<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Semua Kwitansi - {{ $faktur->no_transaksi }}</title>
    
    <style>
        /* Setup Kertas: 603.78pt x 306.14pt (21.3cm x 10.8cm) */
        @page {
            size: 603.78pt 306.14pt; /* Ukuran dalam points sesuai DomPDF */
            margin: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 10px;
            line-height: 1.2;
            color: #000;
            margin: 0;
            padding: 0;
            background: #fff;
            width: 603.78pt;
            height: 306.14pt;
        }

        /* Container per Kwitansi */
        .kwitansi-container {
            width: 603.78pt;
            height: 306.14pt;
            padding: 14.17pt; /* 5mm = 14.17pt */
            box-sizing: border-box;
            position: relative;
            page-break-inside: avoid;
            overflow: hidden;
        }

        /* HEADER & LOGO */
        .header-kwitansi {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5.67pt; /* 2mm = 5.67pt */
            height: 28.35pt; /* 10mm = 28.35pt */
        }

        .header-left {
            display: flex;
            align-items: center;
            width: 45%;
        }

        .header-right {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 7.09pt; /* 2.5mm = 7.09pt */
            width: 55%;
        }
        
        .company-name-kwitansi {
            font-family: Arial, sans-serif;
            font-weight: bold;
            color: #7d0b0b;
            font-size: 12px;
            margin-left: 3.54pt; /* 1.25mm = 3.54pt */
        }
        
        .title {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 8.5pt; /* 3mm = 8.5pt */
            padding-bottom: 2.13pt; /* 0.75mm = 2.13pt */
        }

        /* TABLE */
        .kwitansi-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
            margin-bottom: 5.67pt; /* 2mm = 5.67pt */
        }
        
        .kwitansi-table tr {
            height: 16.54pt; /* 5.83mm = 16.54pt */
        }
        
        .kwitansi-table td {
            padding: 2.83pt 0; /* 1mm = 2.83pt */
            vertical-align: top;
        }
        
        .kwitansi-label {
            width: 85.04pt; /* 30mm = 85.04pt */
            font-weight: bold;
            padding-left: 3.54pt; /* 1.25mm = 3.54pt */
        }
        
        .kwitansi-separator {
            width: 7.09pt; /* 2.5mm = 7.09pt */
            text-align: center;
        }
        
        .kwitansi-value {
            flex: 1;
        }

        .input-box {
            border: 0.71pt solid #ccc; /* 0.25mm = 0.71pt */
            padding: 1.42pt 3.54pt; /* 0.5mm = 1.42pt, 1.25mm = 3.54pt */
            min-height: 11.34pt; /* 4mm = 11.34pt */
            width: 95%;
            display: inline-block;
            box-sizing: border-box;
        }

        .amount-box {
            border: 0.71pt solid #ccc;
            padding: 1.42pt 3.54pt;
            min-height: 11.34pt;
            width: 70.87pt; /* 25mm = 70.87pt */
            text-align: right;
            font-weight: bold;
            display: inline-block;
            box-sizing: border-box;
        }
        
        .text-bold { 
            font-weight: bold; 
        }

        /* FOOTER */
        .footer-kwitansi {
            margin-top: 8.5pt; /* 3mm = 8.5pt */
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            position: absolute;
            bottom: 14.17pt; /* 5mm = 14.17pt */
            left: 14.17pt;
            right: 14.17pt;
        }
        
        .signature-box {
            text-align: center;
            width: 106.3pt; /* 37.5mm = 106.3pt */
        }
        
        .date-info {
            font-size: 9px;
            text-align: center;
            margin-bottom: 2.13pt; /* 0.75mm = 2.13pt */
        }
        
        .sig-space {
            height: 0.71pt; /* 0.25mm = 0.71pt */
            border-bottom: 0.71pt solid #000;
            margin: 14.17pt auto 2.83pt; /* 5mm = 14.17pt, 1mm = 2.83pt */
            width: 85.04pt; /* 30mm = 85.04pt */
        }
        
        /* PENTING: Untuk memastikan halaman baru */
        .page-break {
            page-break-before: always;
        }
        
        /* Kontrol untuk print */
        @media print {
            .kwitansi-container {
                page-break-after: always;
            }
            .kwitansi-container:last-child {
                page-break-after: auto;
            }
        }

    </style>
</head>
<body>

    @foreach($kwitansiList as $index => $kwitansi)
    
    @if($index > 0)
    <div style="page-break-before: always;"></div>
    @endif
    
    <div class="kwitansi-container">
        
        <div class="header-kwitansi">
            <div class="header-left">
                <img src="{{ asset('img/logomerah.png') }}" alt="Logo" style="width: 56.69pt; height: 28.35pt; object-fit: contain; margin-right: 7.09pt;">
                <div class="company-name-kwitansi">PT. Famaindo Delapan Kreasi</div>
            </div>
            
            <div class="header-right">
                <img src="{{ asset('img/famamerah.png') }}" alt="Fama" style="width: 49.61pt; height: 28.35pt; object-fit: contain;">
                <img src="{{ asset('img/audia.png') }}" alt="Audia" style="width: 63.78pt; height: 28.35pt; object-fit: contain;">
            </div>
        </div>

        <div class="title">KWITANSI</div>

        <table class="kwitansi-table">
            <tr>
                <td class="kwitansi-label">Nomor Bukti</td>
                <td class="kwitansi-separator">:</td>
                <td class="kwitansi-value">
                    <div class="input-box" style="width: 177.17pt;">
                        {{ $kwitansi->no_kwitansi ?? str_replace('-', '/', $faktur->no_transaksi) . '-' . ($index + 1) }}
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
                       (<span class="text-bold">{{ $kwitansi->terbilang_formatted }}</span>)
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
                        Rp. {{ number_format($kwitansi->sejumlah, 0, ',', '.') }}
                    </div>
                </td>
            </tr>
        </table>

        <div class="footer-kwitansi">
            <div style="width: 50%;"></div>
            <div class="signature-box">
                <div class="date-info">
                    {{ date('d F Y', strtotime($kwitansi->created_at ?? now())) }}
                </div>
                <div class="sig-space"></div>
                <div style="font-size: 9px;">
                    Penerima
                </div>
            </div>
        </div>

    </div>
    @endforeach

    <script>
        // Auto print saat halaman selesai load
        window.onload = function() {
            window.print();
        }
    </script>

</body>
</html>