<?php

namespace App\Http\Controllers;

use App\Models\faktur_penjualan;
use App\Models\Kwitansi;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CetakController extends Controller
{
    // Preview Faktur (tampil di browser)
    public function previewFaktur($no_transaksi)
    {
        $faktur = faktur_penjualan::where('no_transaksi', $no_transaksi)->firstOrFail();
        
        $data = [
            'faktur' => $faktur,
            'tanggal_short' => $this->formatTanggal($faktur->tanggal, 'short'),
            'tanggal_long' => $this->formatTanggal($faktur->tanggal, 'long'),
            'tgl_jt_short' => $this->formatTanggal($faktur->tgl_jt, 'short'),
            'tgl_jt_long' => $this->formatTanggal($faktur->tgl_jt, 'long'),
            'terbilang' => $this->terbilang($faktur->total_akhir ?? 0),
            'is_preview' => true,
        ];
        
        return view('faktur_penjualan.cetak.faktur', $data);
    }
    
    // Download PDF (save as PDF)
    public function cetakFaktur($no_transaksi)
    {
        $faktur = faktur_penjualan::where('no_transaksi', $no_transaksi)->firstOrFail();
        
        $data = [
            'faktur' => $faktur,
            'tanggal_short' => $this->formatTanggal($faktur->tanggal, 'short'),
            'tanggal_long' => $this->formatTanggal($faktur->tanggal, 'long'),
            'tgl_jt_short' => $this->formatTanggal($faktur->tgl_jt, 'short'),
            'tgl_jt_long' => $this->formatTanggal($faktur->tgl_jt, 'long'),
            'terbilang' => $this->terbilang($faktur->total_akhir ?? 0),
            'is_preview' => false,
        ];
        
        $pdf = PDF::loadView('faktur_penjualan.cetak.faktur', $data)
                  ->setPaper('a5', 'landscape')
                  ->setOption('defaultFont', 'Arial')
                  ->setOption('isHtml5ParserEnabled', true)
                  ->setOption('isRemoteEnabled', true);
        
        return $pdf->download('Faktur-' . $no_transaksi . '.pdf');
    }
    
    // Fungsi format tanggal
    private function formatTanggal($date, $format = 'short')
    {
        if (!$date) return '';
        
        $tanggal = \Carbon\Carbon::parse($date);
        
        if ($format === 'short') {
            // Format: dd/mm/yyyy
            return $tanggal->format('d/m/Y');
        } else {
            // Format panjang: dd bulan yyyy
            $bulan = [
                '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
                '04' => 'April', '05' => 'Mei', '06' => 'Juni',
                '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
                '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
            ];
            return $tanggal->format('d') . ' ' . $bulan[$tanggal->format('m')] . ' ' . $tanggal->format('Y');
        }
    }
    
    // Fungsi terbilang
    private function terbilang($angka)
    {
        if ($angka == 0) return 'nol';
        
        $bilangan = ['', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas'];
        
        if ($angka < 12) {
            return $bilangan[$angka];
        } elseif ($angka < 20) {
            return $bilangan[$angka - 10] . ' belas';
        } elseif ($angka < 100) {
            $hasil_bagi = floor($angka / 10);
            $hasil_mod = $angka % 10;
            return trim(sprintf('%s puluh %s', $bilangan[$hasil_bagi], $bilangan[$hasil_mod]));
        } elseif ($angka < 200) {
            return sprintf('seratus %s', $this->terbilang($angka - 100));
        } elseif ($angka < 1000) {
            $hasil_bagi = floor($angka / 100);
            $hasil_mod = $angka % 100;
            return trim(sprintf('%s ratus %s', $bilangan[$hasil_bagi], $this->terbilang($hasil_mod)));
        } elseif ($angka < 2000) {
            return trim(sprintf('seribu %s', $this->terbilang($angka - 1000)));
        } elseif ($angka < 1000000) {
            $hasil_bagi = floor($angka / 1000);
            $hasil_mod = $angka % 1000;
            return sprintf('%s ribu %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod));
        } elseif ($angka < 1000000000) {
            $hasil_bagi = floor($angka / 1000000);
            $hasil_mod = $angka % 1000000;
            return trim(sprintf('%s juta %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod)));
        }
        
        return 'jumlah terlalu besar';
    }
    
    // Tambahkan fungsi format rupiah jika diperlukan
    private function formatRupiah($angka)
    {
        return number_format($angka, 0, ',', '.');
    }

    // Preview Surat Jalan
    public function previewSuratJalan($no_transaksi)
    {
        $faktur = faktur_penjualan::where('no_transaksi', $no_transaksi)->firstOrFail();
        
        $data = [
            'faktur' => $faktur,
            'tanggal_formatted' => $this->formatTanggal($faktur->tanggal, 'short') . ' ' . date('H.i.s', strtotime($faktur->tanggal)),
            'tanggal_cetak' => date('d/m/Y H:i'),
            'is_preview' => true,
        ];
        
        return view('faktur_penjualan.cetak.suratjalan', $data);
    }

    // Cetak/Download PDF Surat Jalan
    public function cetakSuratJalan($no_transaksi)
    {
        $faktur = faktur_penjualan::where('no_transaksi', $no_transaksi)->firstOrFail();
        
        $data = [
            'faktur' => $faktur,
            'tanggal_formatted' => $this->formatTanggal($faktur->tanggal, 'short') . ' ' . date('H.i.s', strtotime($faktur->tanggal)),
            'tanggal_cetak' => date('d/m/Y H:i'),
            'is_preview' => false,
        ];
        
        $pdf = PDF::loadView('faktur_penjualan.cetak.surat_jalan', $data)
                ->setPaper('a5', 'landscape') 
                ->setOption('defaultFont', 'Arial');
        
        return $pdf->download('suratjalan-' . $no_transaksi . '.pdf');
    }

    public function previewKwitansi($id)
    {
       
        $kwitansi = Kwitansi::with('faktur')->findOrFail($id);
        $faktur = $kwitansi->faktur;
        
        $data = [
            'faktur' => $faktur,
            'kwitansi' => $kwitansi,
            'terbilang' => $faktur->terbilang ?? $this->terbilang($kwitansi->sejumlah),
            'tanggal_formatted' => $this->formatTanggal($kwitansi->tanggal ?? $faktur->tanggal, 'long'),
            'is_preview' => true,
        ];
        
        return view('faktur_penjualan.cetak.kwitansi', $data);
    }

   
    public function cetakKwitansi($id)
    {
        // Ambil data kwitansi berdasarkan ID
        $kwitansi = Kwitansi::with('faktur')->findOrFail($id);
        $faktur = $kwitansi->faktur;
        
        $data = [
            'faktur' => $faktur,
            'kwitansi' => $kwitansi,
            'terbilang' => $faktur->terbilang ?? $this->terbilang($kwitansi->sejumlah),
            'tanggal_formatted' => $this->formatTanggal($kwitansi->tanggal ?? $faktur->tanggal, 'long'),
            'is_preview' => false,
        ];
        
        $pdf = PDF::loadView('faktur_penjualan.cetak.kwitansi', $data)
                ->setPaper('a5', 'portrait')
                ->setOption('defaultFont', 'Arial');
        
        return $pdf->download('Kwitansi-' . $kwitansi->id . '.pdf');
    }

    public function listKwitansi($no_transaksi)
    {
        $faktur = faktur_penjualan::with('kwitansi')->where('no_transaksi', $no_transaksi)->firstOrFail();
        
        return view('faktur_penjualan.kwitansi.index', [
            'faktur' => $faktur,
            'kwitansiList' => $faktur->kwitansi,
        ]);
    }

    public function previewSemuaKwitansi($no_transaksi)
    {
        $faktur = faktur_penjualan::with('kwitansi')->where('no_transaksi', $no_transaksi)->firstOrFail();
        
        if ($faktur->kwitansi->isEmpty()) {
            return back()->with('error', 'Tidak ada kwitansi untuk ditampilkan.');
        }
        
        $data = [
            'faktur' => $faktur,
            'kwitansiList' => $faktur->kwitansi,
            'is_preview' => true,
        ];
        
        return view('faktur_penjualan.cetak.semuakwitansi', $data);
    }

    // DOWNLOAD PDF Semua Kwitansi
    public function cetakSemuaKwitansi($no_transaksi)
    {
        $faktur = faktur_penjualan::with('kwitansi')->where('no_transaksi', $no_transaksi)->firstOrFail();
        
        if ($faktur->kwitansi->isEmpty()) {
            return back()->with('error', 'Tidak ada kwitansi untuk dicetak.');
        }
        
        $data = [
            'faktur' => $faktur,
            'kwitansiList' => $faktur->kwitansi,
            'is_preview' => false,
        ];
        
        $pdf = PDF::loadView('faktur_penjualan.cetak.semuakwitansi', $data)
                ->setPaper('a5', 'portrait')
                ->setOption('defaultFont', 'Arial');
        
        return $pdf->download('SemuaKwitansi-' . $no_transaksi . '.pdf');
    }
        
} 