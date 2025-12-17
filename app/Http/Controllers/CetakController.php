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
    
    // Fungsi format rupiah jika diperlukan
    private function formatRupiah($angka)
    {
        return number_format($angka, 0, ',', '.');
    }

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
            'terbilang' => $this->terbilang($kwitansi->sejumlah),
            'tanggal_formatted' => $this->formatTanggal($kwitansi->tanggal ?? $kwitansi->created_at, 'long'),
            'is_preview' => true,
        ];
        
        return view('faktur_penjualan.cetak.kwitansi', $data);
    }

    public function cetakKwitansi($id)
    {
        $kwitansi = Kwitansi::with('faktur')->findOrFail($id);
        $faktur = $kwitansi->faktur;
        
        $data = [
            'faktur' => $faktur,
            'kwitansi' => $kwitansi,
            'terbilang' => $this->terbilang($kwitansi->sejumlah),
            'tanggal_formatted' => $this->formatTanggal($kwitansi->tanggal ?? $kwitansi->created_at, 'long'),
            'is_preview' => false,
        ];
        
        $pdf = PDF::loadView('faktur_penjualan.cetak.kwitansi', $data)
                ->setPaper([0, 0, 603.78, 306.14], 'portrait')
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

        foreach ($faktur->kwitansi as $k) {
        $k->terbilang_formatted = $this->terbilang($k->sejumlah);
    }
        
        $data = [
            'faktur' => $faktur,
            'kwitansiList' => $faktur->kwitansi,
            'is_preview' => false,
        ];
        
        return view('faktur_penjualan.cetak.semuakwitansi', $data);
    }

    public function cetakSemuaKwitansi($no_transaksi)
    {
        $faktur = faktur_penjualan::with('kwitansi')->where('no_transaksi', $no_transaksi)->firstOrFail();
        
        if ($faktur->kwitansi->isEmpty()) {
            return back()->with('error', 'Tidak ada kwitansi untuk dicetak.');
        }

           foreach ($faktur->kwitansi as $k) {
            $k->terbilang_formatted = $this->terbilang($k->sejumlah);
        }
        
        $data = [
            'faktur' => $faktur,
            'kwitansiList' => $faktur->kwitansi,
            'is_preview' => false,
        ];
        
        $pdf = PDF::loadView('faktur_penjualan.cetak.semuakwitansi', $data)
            ->setPaper([0, 0, 603.78, 306.14], 'portrait')
            ->setOption('defaultFont', 'Arial')
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isRemoteEnabled', true); 
        
        return $pdf->download('SemuaKwitansi-' . $no_transaksi . '.pdf');
    }


    private function penyebut($nilai) {
        $nilai = abs($nilai);
        $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
        $temp = "";
        
        if ($nilai < 12) {
            $temp = " ". $huruf[$nilai];
        } else if ($nilai < 20) {
            $temp = $this->penyebut($nilai - 10). " Belas";
        } else if ($nilai < 100) {
            $temp = $this->penyebut($nilai/10)." Puluh". $this->penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " Seratus" . $this->penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = $this->penyebut($nilai/100) . " Ratus" . $this->penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " Seribu" . $this->penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = $this->penyebut($nilai/1000) . " Ribu" . $this->penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = $this->penyebut($nilai/1000000) . " Juta" . $this->penyebut($nilai % 1000000);
        }
        return $temp;
    }

   
    public function terbilang($nilai) {
        if($nilai < 0) {
            $hasil = "minus ". trim($this->penyebut($nilai));
        } else {
            $hasil = trim($this->penyebut($nilai));
        }     		
        return $hasil . " Rupiah";
    }
}