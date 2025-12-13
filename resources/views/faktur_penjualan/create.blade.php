@extends('layouts.app')
@section('content')
<form action="{{ route('faktur_penjualan.store') }}" method="post" id="fakturForm">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6>Formulir Tambah Pemesanan</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nomor Transaksi *</label>
                                <input type="text" class="form-control" name="" placeholder="Nomor Transaksi (tidak bisa diubah setelah tersimpan)" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal *</label>
                                <input type="date" class="form-control" name="tanggal" value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kode Sales</label>
                                <input type="text" class="form-control" name="kode_sales" placeholder="kode sales">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pelanggan *</label>
                                <input type="text" class="form-control" name="pelanggan" placeholder="Nama Orang atau Instansi" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" name="alamat" placeholder="Alamat Lengkap" rows="2"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kontak WA *</label>
                                <input type="number" class="form-control" name="kontak_wa" placeholder="Nomor Whatsapp Aktif" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Email">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Item Pesanan *</label>
                        <textarea class="form-control" name="kode_item" placeholder="Nama Item (cth: Tas Ransel KVS)" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi Item *</label>
                        <textarea class="form-control" name="item_pesanan" placeholder="Deskripsi Pesanan" required></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Jumlah Pesanan *</label>
                                <input type="number" class="form-control" id="jml" name="jml" placeholder="Jumlah" min="1" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Harga Satuan (Rp) *</label>
                                <input type="number" class="form-control" id="harga_satuan" name="harga_satuan" placeholder="Harga Satuan Item" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Potongan (%)</label>
                                <input type="number" class="form-control" id="potongan" name="potongan" placeholder="0" step="0.01" min="0" max="100">
                                <small class="text-muted">Persentase potongan</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Total Item (Rp)</label>
                                <input type="hidden" id="total_item_value" name="total_item">
                                <input type="text" class="form-control bg-light" id="total_item_display" readonly>
                                <small class="text-muted" id="total_item_detail"></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Pajak (%)</label>
                                <input type="number" class="form-control" id="pajak" name="pajak" placeholder="0" step="0.01" min="0" max="100">
                                <small class="text-muted">Persentase pajak</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Biaya Lain (Rp)</label>
                                <input type="number" class="form-control" id="biaya_lain" name="biaya_lain" placeholder="0" min="0">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Subtotal (Rp)</label>
                                <input type="hidden" id="subtotal_value" name="subtotal">
                                <input type="text" class="form-control bg-light" id="subtotal_display" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Total Akhir (Rp)</label>
                                <input type="hidden" id="total_akhir_value" name="total_akhir">
                                <input type="text" class="form-control bg-light" id="total_akhir_display" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Terbilang</label>
                                <input type="text" class="form-control bg-light" id="terbilang" name="terbilang" readonly>
                                <small class="text-info" id="terbilang_preview"></small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Jatuh Tempo *</label>
                                <input type="date" class="form-control" name="tgl_jt" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>DP PO (Rp)</label>
                                <input type="number" class="form-control" name="DP_PO" placeholder="0" min="0">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tunai (Rp)</label>
                                <input type="number" class="form-control" name="tunai" placeholder="Pembayaran Tunai" min="0">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Kredit (Rp)</label>
                                <input type="number" class="form-control" name="kredit" placeholder="Pembayaran Kredit" min="0">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>K.Debit (Rp)</label>
                                <input type="number" class="form-control" name="K_Debit" placeholder="K.Debit" min="0">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>K.Kredit (Rp)</label>
                                <input type="number" class="form-control" name="K_Kredit" placeholder="K.Kredit" min="0">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kembali (Rp)</label>
                                <input type="number" class="form-control" name="kembali" placeholder="Kembali" min="0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" class="form-control" name="keterangan" placeholder="Keterangan">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                    <a href="{{ route('faktur_penjualan.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputs = ['jml', 'harga_satuan', 'potongan', 'pajak', 'biaya_lain'];
    const elements = {};
    
    // Initialize elements
    inputs.forEach(id => {
        elements[id] = document.getElementById(id);
    });
    
    // Display elements (untuk tampilan format Rupiah)
    elements.total_item_display = document.getElementById('total_item_display');
    elements.total_item_value = document.getElementById('total_item_value');
    elements.total_item_detail = document.getElementById('total_item_detail');
    elements.subtotal_display = document.getElementById('subtotal_display');
    elements.subtotal_value = document.getElementById('subtotal_value');
    elements.total_akhir_display = document.getElementById('total_akhir_display');
    elements.total_akhir_value = document.getElementById('total_akhir_value');
    elements.terbilang = document.getElementById('terbilang');
    elements.terbilang_preview = document.getElementById('terbilang_preview');

    function formatRupiah(angka) {
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(angka);
    }

    function calculateAll() {
        const jml = parseFloat(elements.jml.value) || 0;
        const hargaSatuan = parseFloat(elements.harga_satuan.value) || 0;
        const potonganPercent = parseFloat(elements.potongan.value) || 0;
        const pajakPercent = parseFloat(elements.pajak.value) || 0;
        const biayaLain = parseFloat(elements.biaya_lain.value) || 0;

        // Hitung total sebelum potongan
        const totalSebelumPotongan = jml * hargaSatuan;
        
        // Hitung nilai potongan dalam rupiah
        const nilaiPotongan = totalSebelumPotongan * (potonganPercent / 100);
        
        // Hitung total item setelah potongan
        const totalItem = Math.round(totalSebelumPotongan - nilaiPotongan);
        
        // Update total item (value untuk database, display untuk tampilan)
        elements.total_item_value.value = totalItem;
        elements.total_item_display.value = formatRupiah(totalItem);
        elements.total_item_detail.textContent = `${formatRupiah(totalSebelumPotongan)} - ${formatRupiah(nilaiPotongan)}`;

        // Hitung nilai pajak dalam rupiah
        const nilaiPajak = totalItem * (pajakPercent / 100);

        // Hitung subtotal dan total akhir
        const subtotal = Math.round(totalItem + nilaiPajak + biayaLain);
        elements.subtotal_value.value = subtotal;
        elements.subtotal_display.value = formatRupiah(subtotal);
        
        elements.total_akhir_value.value = subtotal;
        elements.total_akhir_display.value = formatRupiah(subtotal);

        // Update terbilang
        updateTerbilang(subtotal);
    }

    function updateTerbilang(angka) {
        const terbilang = angkaKeTerbilang(angka);
        elements.terbilang.value = terbilang;
        elements.terbilang_preview.textContent = terbilang;
    }

    function angkaKeTerbilang(angka) {
        if (angka === 0) return 'Nol Rupiah';
        
        const satuan = ['', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan'];
        const belasan = ['Sepuluh', 'Sebelas', 'Dua Belas', 'Tiga Belas', 'Empat Belas', 'Lima Belas', 'Enam Belas', 'Tujuh Belas', 'Delapan Belas', 'Sembilan Belas'];
        const puluhan = ['', '', 'Dua Puluh', 'Tiga Puluh', 'Empat Puluh', 'Lima Puluh', 'Enam Puluh', 'Tujuh Puluh', 'Delapan Puluh', 'Sembilan Puluh'];

        function convertThreeDigits(num) {
            let result = '';
            const ratusan = Math.floor(num / 100);
            const sisa = num % 100;
            const puluhanDigit = Math.floor(sisa / 10);
            const satuanDigit = sisa % 10;

            if (ratusan > 0) {
                if (ratusan === 1) {
                    result += 'Seratus ';
                } else {
                    result += satuan[ratusan] + ' Ratus ';
                }
            }

            if (sisa > 0) {
                if (sisa < 10) {
                    result += satuan[satuanDigit] + ' ';
                } else if (sisa < 20) {
                    result += belasan[sisa - 10] + ' ';
                } else {
                    result += puluhan[puluhanDigit] + ' ';
                    if (satuanDigit > 0) {
                        result += satuan[satuanDigit] + ' ';
                    }
                }
            }

            return result.trim();
        }

        let result = '';
        let num = Math.floor(angka);
        let ribuanIndex = 0;
        const ribuan = ['', 'Ribu', 'Juta', 'Miliar', 'Triliun'];

        if (num === 0) return 'Nol';

        while (num > 0) {
            const threeDigits = num % 1000;
            if (threeDigits > 0) {
                let part = convertThreeDigits(threeDigits);
                
                if (threeDigits === 1 && ribuanIndex === 1) {
                    part = 'Seribu';
                } else if (ribuanIndex > 0) {
                    part += ' ' + ribuan[ribuanIndex];
                }
                
                result = part + ' ' + result;
            }
            num = Math.floor(num / 1000);
            ribuanIndex++;
        }

        return result.trim() + ' Rupiah';
    }

    // Event listeners untuk realtime calculation
    inputs.forEach(id => {
        elements[id].addEventListener('input', calculateAll);
    });

    // Form submission handler untuk memastikan data yang dikirim adalah angka
    document.getElementById('fakturForm').addEventListener('submit', function(e) {
        // Validasi tambahan bisa ditambahkan di sini
        console.log('Data yang akan dikirim:');
        console.log('Total Item:', elements.total_item_value.value);
        console.log('Subtotal:', elements.subtotal_value.value);
        console.log('Total Akhir:', elements.total_akhir_value.value);
    });

    // Initial calculation
    calculateAll();
});
</script>
@endsection