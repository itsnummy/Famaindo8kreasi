<div class="row">
    <div class="col-md-6">
        <h6>Info Kontak</h6>
        <p><strong>Nama:</strong> <span id="kontak-nama">{{ $faktur->pelanggan ?? '-' }}</span></p>
        <p><strong>WhatsApp:</strong> 
            @if($faktur->kontak_wa)
                @php
                    // Format nomor untuk WhatsApp
                    $nomor_wa = $faktur->kontak_wa;
                    
                    // Hapus karakter selain angka
                    $nomor_wa = preg_replace('/[^0-9]/', '', $nomor_wa);
                    
                    // Jika diawali dengan 0, ganti dengan +62
                    if(substr($nomor_wa, 0, 1) == '0') {
                        $nomor_wa = '+62' . substr($nomor_wa, 1);
                    }
                    // Jika diawali dengan 62, tambah +
                    elseif(substr($nomor_wa, 0, 2) == '62') {
                        $nomor_wa = '+' . $nomor_wa;
                    }
                    // Jika kurang dari 10 digit, tampilkan asli
                    elseif(strlen($nomor_wa) < 10) {
                        $nomor_wa = $faktur->kontak_wa;
                    }
                    // Default: tambah +
                    else {
                        $nomor_wa = '+' . $nomor_wa;
                    }
                @endphp
                <span id="kontak-wa">{{ $nomor_wa }}</span>
            @else
                <span id="kontak-wa" class="text-muted">-</span>
            @endif
        </p>
    </div>
    <div class="col-md-6">
        <h6>Aksi Cepat</h6>
        @if($faktur->kontak_wa)
            @php
                // Hitung sisa pembayaran
                $totalDibayar = \App\Models\Kwitansi::where('no_transaksi', $faktur->no_transaksi)->sum('sejumlah');
                $sisaBayar = $faktur->total_akhir - $totalDibayar;
                
                // Format pesan untuk tagih DP
                $pesanDP = rawurlencode("Halo " . $faktur->pelanggan . ",\n\nIni adalah pengingat untuk pembayaran DP pesanan Anda:\n\n" .
                          "No. Transaksi: " . $faktur->no_transaksi . "\n" .
                          "Item: " . $faktur->item_pesanan . "\n" .
                          "Total Pesanan: Rp " . number_format($faktur->total_akhir, 0, ',', '.') . "\n" .
                          "Minimal DP: Rp " . number_format($faktur->total_akhir * 0.5, 0, ',', '.') . "\n\n" .
                          "Silakan lakukan pembayaran DP untuk melanjutkan proses pemesanan.\n\n" .
                          "Terima kasih,\n" .
                          $faktur->pelanggan);
            @endphp
            
            @if($sisaBayar > 0)
                <a href="https://wa.me/{{ $nomor_wa }}?text={{ $pesanDP }}" 
                   target="_blank" 
                   class="btn btn-success btn-sm btn-wa">
                    <i class="fab fa-whatsapp"></i> Tagih DP
                </a>
                
                @if($faktur->tgl_jt)
                    @php
                        // Format pesan untuk jatuh tempo
                        $tgl_jt = date('d/m/Y', strtotime($faktur->tgl_jt));
                        $pesanJatuhTempo = rawurlencode("Halo " . $faktur->pelanggan . ",\n\nPengingat jatuh tempo pembayaran:\n\n" .
                                  "No. Transaksi: " . $faktur->no_transaksi . "\n" .
                                  "Item: " . $faktur->item_pesanan . "\n" .
                                  "Total: Rp " . number_format($faktur->total_akhir, 0, ',', '.') . "\n" .
                                  "Sisa Bayar: Rp " . number_format($sisaBayar, 0, ',', '.') . "\n" .
                                  "Jatuh Tempo: " . $tgl_jt . "\n\n" .
                                  "Silakan lakukan pelunasan sebelum tanggal jatuh tempo.\n\n" .
                                  "Terima kasih,\n" .
                                  $faktur->pelanggan);
                    @endphp
                    <a href="https://wa.me/{{ $nomor_wa }}?text={{ $pesanJatuhTempo }}" 
                       target="_blank" 
                       class="btn btn-warning btn-sm btn-wa mt-1">
                        <i class="fab fa-whatsapp"></i> Reminder Jatuh Tempo
                    </a>
                @endif
            @else
                @php
                    // Pesan terima kasih jika sudah lunas
                    $pesanLunas = rawurlencode("Halo " . $faktur->pelanggan . ",\n\nTerima kasih telah melunasi pesanan:\n\n" .
                              "No. Transaksi: " . $faktur->no_transaksi . "\n" .
                              "Item: " . $faktur->item_pesanan . "\n" .
                              "Status: LUNAS\n\n" .
                              "Pesanan Anda akan segera kami proses.\n\n" .
                              "Terima kasih,\n" .
                              $faktur->pelanggan);
                @endphp
                <a href="https://wa.me/{{ $nomor_wa }}?text={{ $pesanLunas }}" 
                   target="_blank" 
                   class="btn btn-info btn-sm btn-wa">
                    <i class="fab fa-whatsapp"></i> Konfirmasi Lunas
                </a>
            @endif
        @else
            <button class="btn btn-secondary btn-sm" disabled>
                <i class="fab fa-whatsapp"></i> No WhatsApp Tidak Tersedia
            </button>
        @endif
    </div>
</div>

@push('scripts')
<script>
// Format nomor WhatsApp otomatis
function formatWhatsAppNumber(number) {
    // Hapus karakter selain angka
    let cleanNumber = number.replace(/\D/g, '');
    
    // Format ke +62
    if (cleanNumber.startsWith('0')) {
        return '+62' + cleanNumber.substring(1);
    } else if (cleanNumber.startsWith('62')) {
        return '+' + cleanNumber;
    } else if (cleanNumber.length >= 10) {
        return '+' + cleanNumber;
    }
    
    return number;
}

// Update nomor WhatsApp yang ditampilkan
document.addEventListener('DOMContentLoaded', function() {
    const waElement = document.getElementById('kontak-wa');
    if (waElement) {
        const originalNumber = waElement.textContent.trim();
        if (originalNumber !== '-') {
            waElement.textContent = formatWhatsAppNumber(originalNumber);
        }
    }
});
</script>
@endpush