<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi - {{ $faktur->no_transaksi }}</title>
    
    <style>
        /* Definisi Ukuran Kertas Custom (10.8 cm x 21.3 cm) */
        @page {
            size: 21.3cm 10.8cm; /* Lebar x Tinggi */
            margin: 5mm 5mm 5mm 5mm;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 10px;
            line-height: 1.2;
            color: #000;
            margin: 0;
            padding: 0;
            height: 10.8cm; 
        }

        /* Container Utama dengan Batas Kertas */
        .kwitansi-container {
            width: 100%;
            height: 100%; 
            padding: 5mm; 
        }

        /* HEADER & LOGO */
        .header-kwitansi {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .header-left {
            display: flex;
            align-items: center;
            width: 45%;
        }

        .header-right {
            display: flex;
            justify-content: flex-end;
            gap: 10px; /* Jarak antar logo diperlebar sedikit */
            width: 55%;
            padding-right: 20px; /* Memberi padding kanan agar tidak terlalu mepet */
        }
        
        /* CLASS .logo-img dihapus dari CSS karena style diterapkan inline di HTML */

        .company-name-kwitansi {
            font-family: Arial, sans-serif;
            font-weight: bold;
            color: #7d0b0b;
            font-size: 12px;
            margin-left: 5px;
        }
        
        /* JUDUL */
        .title {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 15px;
            padding-bottom: 3px;
        }

        /* TABLE BODY KWITANSI */
        .kwitansi-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }
        .kwitansi-table td {
            padding: 4px 0;
            vertical-align: top;
        }
        .kwitansi-label {
            width: 120px;
            font-weight: bold;
            padding-left: 5px;
        }
        .kwitansi-separator {
            width: 10px;
            text-align: center;
        }
        .kwitansi-value {
            flex: 1;
        }

        /* Kotak Isian (Untuk input atau display) */
        .input-box {
            border: 1px solid #ccc; /* Garis tipis abu-abu */
            padding: 2px 5px;
            min-height: 14px;
            width: 95%; 
            display: inline-block;
        }

        /* Kotak Khusus Jumlah */
        .amount-box {
            border: 1px solid #ccc;
            padding: 2px 5px;
            min-height: 14px;
            width: 100px;
            text-align: right;
            font-weight: bold;
            display: inline-block;
        }
        
        .text-bold { font-weight: bold; }
        .text-italic { font-style: italic; }

        /* FOOTER KWITANSI */
        .footer-kwitansi {
            margin-top: 15px;
            display: flex;
            justify-content: space-between;
        }

        .signature-box {
            text-align: center;
            width: 30%;
        }
        .sig-space {
            margin-top: 35px; /* Ruang untuk tanda tangan */
            height: 10px;
        }
        .date-info {
            font-size: 9px;
            text-align: right;
            margin-right: 20px;
        }

    </style>
</head>
<body onload="window.print()"> 
    <div class="kwitansi-container">
        
        <div class="header-kwitansi">
            <div class="header-left">
                <img 
                    src="{{ asset('img/logomerah.png') }}" 
                    alt="Logo Famaindo" 
                    style="width: 80px; height: 40px; object-fit: contain; margin-right: 10px;"
                >
                <div class="company-name-kwitansi">PT. Famaindo Delapan Kreasi</div>
            </div>
            
            <div class="header-right">
                <img 
                    src="{{ asset('img/famamerah.png') }}" 
                    alt="Logo Fama Kedua" 
                    style="width: 70px; height: 40px; object-fit: contain;"
                >
                <img 
                    src="{{ asset('img/audia.png') }}" 
                    alt="Logo Audia" 
                    style="width: 90px; height: 40px; object-fit: contain;"
                >
            </div>
        </div>

        <div class="title">
            KWITANSI
        </div>

        <table class="kwitansi-table">
            <tr>
                <td class="kwitansi-label">Nomor Bukti</td>
                <td class="kwitansi-separator">:</td>
                <td class="kwitansi-value">
                    <div class="input-box" style="width: 250px;">
                        {{ str_replace('-', '/', $faktur->no_transaksi) }}
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
                        (<span class="text-bold">{{ $faktur->terbilang }}</span>)
                    </div>
                </td>
            </tr>
            <tr>
                <td class="kwitansi-label">Untuk Pembayaran</td>
                <td class="kwitansi-separator">:</td>
                <td class="kwitansi-value">
                    <div class="input-box" style="width: 95%;">
                        {{ $faktur->item_pesanan }}
                    </div>
                </td>
            </tr>
            <tr>
                <td class="kwitansi-label">Sejumlah</td>
                <td class="kwitansi-separator">:</td>
                <td class="kwitansi-value">
                     <span style="font-weight: bold;"></span>
                    <div class="amount-box">
                       Rp. {{ number_format($faktur->total_akhir, 0, ',', '.') }}
                    </div>
                </td>
            </tr>
        </table>

        <div class="footer-kwitansi">
            <div style="width: 50%;">
                </div>
            
        
    </div>
</body>
</html>