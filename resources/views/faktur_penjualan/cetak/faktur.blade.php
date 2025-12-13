<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faktur Penjualan - {{ $faktur->no_transaksi }}</title>
    
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
        .uppercase { text-transform: uppercase; }
        
        /* Warna Border Abu-Abu Tipis */
        .border-thin-gray {
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

        /* Tabel Info Header (Tanpa Border) */
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

        .item-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9px;
            border: none;
        }
        .item-table th, .item-table td {
            border: none; 
            padding: 4px;
        }
        
        /* Terapkan garis HANYA pada Header: Atas dan Bawah */
        .item-table thead tr {
            border-top: 1px solid #ccc; /* Abu-abu tipis */
            border-bottom: 1px solid #ccc; /* Abu-abu tipis */
        }
        .item-table th {
            background-color: #f0f0f0; 
            text-align: left;
        }
        
        /* Penyesuaian khusus untuk header yang perlu di tengah/kanan */
        .item-table th:first-child, 
        .item-table th:nth-child(4) { 
            text-align: center;
        }
        .item-table th:nth-child(5), 
        .item-table th:nth-child(6), 
        .item-table th:last-child { 
            text-align: right;
        }

        /* Penyesuaian untuk isi tabel agar tidak terlalu mepet kiri */
        .item-table tbody td {
            padding: 4px;
        }
        .item-table tbody td:first-child, 
        .item-table tbody td:nth-child(4) { 
            text-align: center;
        }
        .item-table tbody td:nth-child(2), 
        .item-table tbody td:nth-child(3) { 
            padding-left: 8px;
        }

        /* Garis Pemisah Tambahan (HR) */
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

        /* Teks Data Ringkasan di footer-right tidak bold */
        .footer-right .info-table td {
            font-weight: normal; 
        }
        .footer-right .info-table td.text-bold {
            font-weight: bold; /* Hanya label yang bold */
        }

        /* Terbilang */
        .terbilang-box {
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            padding: 3px 0;
            margin: 5px 0;
            font-style: italic;
            font-size: 9px;
        }

        /* Tanda Tangan */
        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            text-align: center;
            padding: 0 20px;
        }
        .sig-box { width: 40%; }
        .sig-line { 
            margin-top: 40px; 
            border-bottom: 1px solid #000; 
        }

        /* Info Rekening / Footer Note */
        .payment-note {
            margin-top: 5px;
            border: 1px solid #000;
            padding: 3px;
            font-size: 9px;
            width: 60%; 
        }
        
        /* Tambahan bold pada teks Rekening Bank dan label */
        .payment-note strong {
            font-weight: bold;
            font-size: 10px; /* Sedikit lebih besar dari teks di dalamnya */
        }
        .payment-note .rek-bank {
             font-weight: bold;
        }

        /* Catatan DP di luar box */
        .dp-note {
            font-style: italic;
            font-size: 8px; /* Lebih kecil */
            margin-top: 2px;
            width: 60%;
        }

        /* Hapus tombol saat print */
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()"> 
    <div class="invoice-container">
        
        <div class="header">
            <div class="header-left">
                <img src="{{ asset('img/logomerah.png') }}" alt="LOGO" class="logo-img">
                
                <div class="company-details">
                    <div class="text-bold" style="font-size: 16px;">FAKTUR PENJUALAN</div>
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
                        <td>{{ date('d/m/Y H:i', strtotime($faktur->tanggal)) }}</td>
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
                    <th width="35%">Nama Item</th>
                    <th width="10%">Jml Satuan</th>
                    <th width="12%">Harga</th>
                    <th width="10%">Pot</th>
                    <th width="13%">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>{{ $faktur->kode_item }}</td> 
                    <td>{{ $faktur->item_pesanan }}</td>
                    <td>{{ number_format($faktur->jml, 0, ',', '.') }} PCS</td>
                    <td class="text-right">{{ number_format($faktur->harga_satuan, 0, ',', '.') }}</td>
                    <td class="text-right">{{ $faktur->potongan ?? '0' }}</td>
                    <td class="text-right">{{ number_format($faktur->subtotal, 0, ',', '.') }}</td>
                </tr>
                 <tr><td colspan="7" style="height: 70px;"></td></tr>
            </tbody>
        </table>

        <hr class="divider">

        <div class="footer">
            
            <div class="footer-left">
                <div style="display: flex;">
                    <div style="width: 100%;">
                        <div style="margin-bottom: 2px;">
                            <span style="font-weight: bold; width: 70px; display: inline-block;">Keterangan</span>
                            <span>: {{ $faktur->keterangan ?? '-' }}</span>
                        </div>

                        <div class="summary-grid">
                            <div style="width: 50%;">
                                <table class="info-table" style="font-size: 10px;">
                                    <tr>
                                        <td class="text-bold" width="70">Jml Item</td>
                                        <td width="10">:</td>
                                        <td class="text-right">{{ number_format($faktur->jml, 0) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Potongan</td>
                                        <td>:</td>
                                        <td class="text-right">{{ $faktur->potongan ?? '0' }}%</td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Pajak</td>
                                        <td>:</td>
                                        <td class="text-right">{{ number_format($faktur->pajak ?? 0, 0) }}%</td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Biaya Lain</td>
                                        <td>:</td>
                                        <td class="text-right">{{ number_format((int)$faktur->biaya_lain, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Tanggal Jt</td>
                                        <td>:</td>
                                        <td class="text-right">
                                            {{ $faktur->tgl_jt ? date('d/m/Y', strtotime($faktur->tgl_jt)) : '-' }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="terbilang-box">
                    <strong>Terbilang :</strong> {{ $faktur->terbilang }}
                </div>
                
                <div style="font-size: 8px; margin-bottom: 5px;">
                    {{ date('d/m/Y H.i') }}
                </div>

                <div class="signature-section">
                    <div class="sig-box">
                        <div>Hormat Kami</div>
                        <div class="sig-line" style="border-bottom: none;"></div>
                        <div>(...........................)</div>
                    </div>
                    <div class="sig-box">
                        <div>Penerima</div>
                        <div class="sig-line" style="border-bottom: none;"></div>
                        <div>(...........................)</div>
                    </div>
                </div>
                
                <div class="payment-note">
                    <strong>Untuk Pembayaran :</strong><br>
                    <span class="rek-bank">Bank BCA 1280152991 an Ega Septia Manwel</span>
                </div>
                <div class="dp-note">
                    Untuk Dp min.50% dan pelunasan sebelum dikirim
                </div>
            </div>

            <div class="footer-right">
                <table class="info-table" style="font-size: 10px;">
                    <tr>
                        <td class="text-bold" width="80">Sub Total</td>
                        <td width="10">:</td>
                        <td class="text-right">{{ number_format($faktur->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Total Akhir</td>
                        <td>:</td>
                        <td class="text-right">{{ number_format($faktur->total_akhir, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">DP PO</td>
                        <td>:</td>
                        <td class="text-right">{{ number_format($faktur->DP_PO, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Tunai</td>
                        <td>:</td>
                        <td class="text-right">{{ number_format((int)$faktur->tunai, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Kredit</td>
                        <td>:</td>
                        <td class="text-right">{{ number_format((int)$faktur->kredit, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">K. Debit</td>
                        <td>:</td>
                        <td class="text-right">{{ number_format((int)$faktur->K_Debit, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">K. Kredit</td>
                        <td>:</td>
                        <td class="text-right">{{ number_format((int)$faktur->K_Kredit, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold" style="border-top: 1px solid #000; padding-top: 2px;">Kembali</td>
                        <td style="border-top: 1px solid #000; padding-top: 2px;">:</td>
                        <td class="text-right" style="border-top: 1px solid #000; padding-top: 2px;">{{ number_format((int)$faktur->kembali, 0, ',', '.') }}</td>
                    </tr>
                </table>
                
                <div class="text-right" style="margin-top: 50px; font-size: 9px; padding-right: 10px;">
                    ADMIN
                </div>
            </div>

        </div>

    </div>
</body>
</html>