<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Jalan - {{ $faktur->no_transaksi }}</title> 
    
    <style>
        /* Pengaturan Kertas A5 Landscape */
        @page {
            size: A5 landscape;
            margin: 5mm 10mm 5mm 10mm;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            font-size: 10px;
            line-height: 1.2;
            color: #000;
            margin: 0;
            padding: 0;
        }

        /* Helper Classes */
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .text-bold { font-weight: bold; }
        
        /* Warna Border Abu-Abu Tipis */
        .border-thin {
            border: 1px solid #ccc;
        }

        /* Container Utama */
        .invoice-container {
            width: 100%;
        }

        /* HEADER SECTION */
        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            padding-bottom: 5px;
        }

        .header-left {
            width: 55%;
            display: flex;
            align-items: flex-start;
            gap: 15px;
        }

        .logo-img {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }

        .company-details {
            font-size: 11px;
        }
        .company-name {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 2px;
        }

        .header-right {
            width: 45%;
            font-size: 10px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 1px 0;
            vertical-align: top;
        }
        .label-col { width: 70px; }
        .sep-col { width: 10px; text-align: center; }

        /* MODIFIKASI KRITIS: TABEL ITEM HANYA DENGAN GARIS HORIZONTAL DI HEADER */
        .item-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
            font-size: 9px;
            border: none;
        }
        .item-table th, .item-table td {
            border: none;
            padding: 4px;
        }
        
        /* Terapkan garis HANYA pada Header: Atas dan Bawah */
        .item-table thead tr {
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
        }
        .item-table th {
            background-color: #f0f0f0;
            text-align: left; /* Defaultkan ke kiri untuk teks */
        }
        
        /* Penyesuaian khusus untuk header yang perlu di tengah/kanan */
        .item-table th:first-child { text-align: center; } /* No. di tengah */
        .item-table th:last-child { text-align: center; } /* Jml Satuan di tengah */

        /* Penyesuaian untuk isi tabel agar tidak terlalu mepet kiri */
        .item-table td {
             padding: 4px;
        }
        .item-table tbody td:nth-child(2), /* Kolom Kode Item */
        .item-table tbody td:nth-child(3) { /* Kolom Nama Item */
            padding-left: 8px; /* Tambahkan padding agar bergeser sedikit ke kanan */
        }
        .item-table tbody td:first-child { /* Kolom No. */
             text-align: center;
        }
        .item-table tbody td:last-child { /* Kolom Jml Satuan */
             text-align: center;
        }

         .divider {
            border: 0;
            border-top: 1px solid #ccc; /* Abu-abu tipis */
            margin: 5px 0;
        }


        /* FOOTER SECTION */
        .footer {
            display: flex;
            justify-content: space-between;
            font-size: 10px;
        }

        .footer-left {
            width: 63%;
            padding-right: 10px;
        }

        .footer-right {
            width: 37%;
        }

        /* Tanda Tangan */
        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            text-align: center;
            padding: 0 5px;
        }
        .sig-box-left { width: 30%; } 
        .sig-box-center { width: 30%; }
        .sig-box-right { width: 30%; }

        .sig-space { 
            margin-top: 30px; 
            height: 10px; 
        }

    </style>
</head>
<body onload="window.print()"> 
    <div class="invoice-container">
        
        <div class="header">
            <div class="header-left">
                <img src="{{ asset('img/logomerah.png') }}" alt="LOGO" class="logo-img">
                
                <div class="company-details">
                    <div class="text-bold" style="font-size: 16px;">SURAT JALAN</div>
                    <div class="company-name">PT FAMAINDO DELAPAN KREASI</div>
                    <div>KOMP.PIK BLOK A NO.64-65, PENGGILINGAN</div>
                    <div>08111799909</div>
                </div>
            </div>

            <div class="header-right">
                <table class="info-table">
                    <tr>
                        <td class="label-col">No Transaksi</td>
                        <td class="sep-col">:</td>
                        <td>{{ str_replace('-', '/', $faktur->no_transaksi) }}</td>
                        <td width="30">Dept.</td>
                        <td>: FDK</td>
                    </tr>
                    <tr>
                        <td class="label-col">Tanggal</td>
                        <td class="sep-col">:</td>
                        <td>{{ date('d/m/Y', strtotime($faktur->tanggal)) }}</td> 
                        <td>User</td>
                        <td>: ADMIN</td>
                    </tr>
                    <tr>
                        <td class="label-col">Kode Sales</td>
                        <td class="sep-col">:</td>
                        <td colspan="3">{{ $faktur->kode_sales ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="label-col">Pelanggan</td>
                        <td class="sep-col">:</td>
                        <td colspan="3">{{ $faktur->pelanggan }}</td>
                    </tr>
                    <tr>
                        <td class="label-col">Alamat</td>
                        <td class="sep-col">:</td>
                        <td colspan="3" style="font-size: 9px;">
                            {{ $faktur->alamat }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <table class="item-table">
            <thead>
                <tr>
                    <th width="5%">No.</th>
                    <th width="15%">Kode Item</th>
                    <th width="50%">Nama Item</th>
                    <th width="30%">Jml Satuan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>{{ $faktur->kode_item ?? 'KVS' }}</td> 
                    <td>{{ $faktur->item_pesanan }}</td>
                    <td>{{ number_format($faktur->jml, 0, ',', '.') }} PCS</td>
                </tr>
                <tr><td colspan="4" style="height: 100px;"></td></tr>
            </tbody>
        </table>

        <hr class="divider">

        <div class="footer">
            
            <div class="footer-left" style="width: 100%; display: flex; justify-content: space-between;">
                <div style="width: 60%;">
                    <div style="margin-bottom: 5px;">
                        <span style=" width: 70px; display: inline-block;">Keterangan</span>
                        <span>: {{ $faktur->keterangan ?? '-' }}</span>
                    </div>
                </div>

                <div style="width: 30%; font-size: 11px;">
                    <span>Total Item :</span>
                    <span class="text-bold text-right">{{ number_format($faktur->jml, 0) }}</span>
                </div>
            </div>
        </div>

        <div class="signature-section" style="margin-top: 30px;">
            <div class="sig-box-left">
                <div>Hormat Kami</div>
                <div class="sig-space"></div>
                <div>(...........................)</div>
            </div>
            
            <div class="sig-box-center">
                <div style="font-size: 8px;">
                    {{ date('d/m/Y H.i') }}
                </div>
                <div class="sig-space"></div>
                <div style="font-size: 8px;">ADMIN</div>
            </div>
            
            <div class="sig-box-right">
                <div>Penerima</div>
                <div class="sig-space"></div>
                <div>(...........................)</div>
            </div>
        </div>
        
    </div>
</body>
</html>