<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\faktur_penjualan;
use App\Http\Controllers\Controller;
use App\Models\Kwitansi;

class faktur_penjualanController extends Controller
{
    public function index()
    {
        $faktur_penjualan = faktur_penjualan::all();
        return view('faktur_penjualan.index', ['faktur_penjualan' => $faktur_penjualan]);
    }

    public function create()
    {
        return view('faktur_penjualan.create');
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'no_transaksi' => 'required|unique:faktur_penjualan'
        ]);

        // Simpan data ke database
        faktur_penjualan::create([
            'no_transaksi' => $request->no_transaksi,
            'tanggal' => $request->tanggal,
            'kode_sales' => $request->kode_sales,
            'pelanggan' => $request->pelanggan,
            'alamat' => $request->alamat,
            'kontak_wa' => $request->kontak_wa,
            'email' => $request->email,
            'kode_item' => $request->kode_item,
            'item_pesanan' => $request->item_pesanan,
            'jml' => $request->jml,
            'harga_satuan' => $request->harga_satuan,
            'potongan' => $request->potongan,
            'total_item' => $request->total_item,
            'pajak' => $request->pajak,
            'biaya_lain' => $request->biaya_lain,
            'tgl_jt' => $request->tgl_jt,
            'subtotal' => $request->subtotal,
            'total_akhir' => $request->total_akhir,
            'DP_PO' => $request->DP_PO,
            'tunai' => $request->tunai,
            'kredit' => $request->kredit,
            'K_Debit' => $request->K_Debit,
            'K_Kredit' => $request->K_Kredit,
            'terbilang' => $request->terbilang,
            'kembali' => $request->kembali,
            'keterangan' => $request->keterangan,
        ]);

        return redirect('faktur_penjualan')->with('success', 'Data Pemesanan berhasil ditambahkan');
    }

    public function edit(faktur_penjualan $faktur_penjualan)
    {
        return view('faktur_penjualan.edit')->with('data', $faktur_penjualan);
    }

    public function update(Request $request, faktur_penjualan $faktur_penjualan)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'pelanggan' => 'required',
            'item_pesanan' => 'required',
            'jml' => 'required|numeric',
            'harga_satuan' => 'required|numeric',
        ]);
        
        $faktur_penjualan->update([
            'tanggal' => $request->tanggal,
            'kode_sales' => $request->kode_sales,
            'pelanggan' => $request->pelanggan,
            'alamat' => $request->alamat,
            'kontak_wa' => $request->kontak_wa,
            'email' => $request->email,
            'kode_item' => $request->kode_item,
            'item_pesanan' => $request->item_pesanan,
            'jml' => $request->jml,
            'harga_satuan' => $request->harga_satuan,
            'potongan' => $request->potongan,
            'total_item' => $request->total_item,
            'pajak' => $request->pajak,
            'biaya_lain' => $request->biaya_lain,
            'tgl_jt' => $request->tgl_jt,
            'subtotal' => $request->subtotal,
            'total_akhir' => $request->total_akhir,
            'DP_PO' => $request->DP_PO,
            'tunai' => $request->tunai,
            'kredit' => $request->kredit,
            'K_Debit' => $request->K_Debit,
            'K_Kredit' => $request->K_Kredit,
            'terbilang' => $request->terbilang,
            'kembali' => $request->kembali,
            'keterangan' => $request->keterangan,
        ]);
        
        return redirect('faktur_penjualan')->with('success', 'Data Pemesanan berhasil diperbarui');
    }

    public function destroy(faktur_penjualan $faktur_penjualan)
    {
        $faktur_penjualan->delete();
        return redirect('faktur_penjualan')->with('success','Data Berhasil Dihapus');
    }

 public function indexKelolaPembayaran()
{
    // Ambil semua faktur yang belum selesai
    $faktur_penjualan = faktur_penjualan::where(function($query) {
        $query->where('status', '!=', 'selesai')
              ->orWhereNull('status');
    })->orderBy('tanggal', 'desc')->get();
    
    // Tampilkan view LIST (kelolabayar.blade.php)
    return view('faktur_penjualan.kelolabayar', [
        'faktur_penjualan' => $faktur_penjualan,
        'is_list_page' => true // Tetap butuh flag ini
    ]);
}

public function kelola($id) 
{
    // Cari faktur berdasarkan no_transaksi
    $faktur = faktur_penjualan::where('no_transaksi', $id)->first();
    
    if (!$faktur) {
        abort(404, 'Data faktur tidak ditemukan');
    }
    
    $kwitansi = Kwitansi::where('no_transaksi', $id)->get();
    $totalDibayar = $kwitansi->sum('sejumlah');
    $sisa = $faktur->total_akhir - $totalDibayar;

    // Tampilkan view DETAIL dengan tabs (index-kelola.blade.php)
    return view('faktur_penjualan.kelola.index-kelola', 
        compact('faktur', 'kwitansi', 'totalDibayar', 'sisa')
    );
}

    public function storeKwitansi(Request $request)
    {
        $request->validate([
            'no_transaksi' => 'required',
            'sejumlah' => 'required|numeric|min:1',
            'utk_pembayaran' => 'required',
            'jenis' => 'required|in:1,2'
        ]);

        $terbilang = $this->generateTerbilang($request->sejumlah);

        Kwitansi::create([
            'no_transaksi' => $request->no_transaksi,
            'terbliang' => $terbilang,
            'sejumlah' => $request->sejumlah,
            'utk_pembayaran' => $request->utk_pembayaran,
            'jenis' => $request->jenis
        ]);

            return redirect()->route('faktur_penjualan.kelola', $request->no_transaksi)
                ->with('success', 'Pembayaran berhasil disimpan!');
        }

        public function destroyKwitansi($id)
        {
            $kwitansi = Kwitansi::find($id);
            
            if (!$kwitansi) {
                return redirect()->back()->with('error', 'Kwitansi tidak ditemukan');
            }

            $no_transaksi = $kwitansi->no_transaksi;
            $kwitansi->delete();

            return redirect()->route('faktur_penjualan.kelola', $no_transaksi)
                ->with('success', 'Kwitansi berhasil dihapus');
        }


 
    private function generateTerbilang($angka)
    {
        $angka = (float)$angka;
        $bilangan = array('', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas');
        
        if ($angka < 12) {
            return $bilangan[$angka];
        } else if ($angka < 20) {
            return $bilangan[$angka - 10] . ' Belas';
        } else if ($angka < 100) {
            return $bilangan[floor($angka / 10)] . ' Puluh ' . $bilangan[$angka % 10];
        } else if ($angka < 200) {
            return 'Seratus ' . $this->generateTerbilang($angka - 100);
        } else if ($angka < 1000) {
            return $bilangan[floor($angka / 100)] . ' Ratus ' . $this->generateTerbilang($angka % 100);
        } else if ($angka < 2000) {
            return 'Seribu ' . $this->generateTerbilang($angka - 1000);
        } else if ($angka < 1000000) {
            return $this->generateTerbilang(floor($angka / 1000)) . ' Ribu ' . $this->generateTerbilang($angka % 1000);
        } else if ($angka < 1000000000) {
            return $this->generateTerbilang(floor($angka / 1000000)) . ' Juta ' . $this->generateTerbilang($angka % 1000000);
        }
        
        return 'Jumlah terlalu besar';
    }

    public function updateStatusSelesai(Request $request, $id)
{
    $faktur = faktur_penjualan::where('no_transaksi', $id)->first();
    
    if (!$faktur) {
        return redirect()->back()->with('error', 'Faktur tidak ditemukan');
    }

    $faktur->update([
        'status' => 'selesai',
        'keterangan' => 'Pemesanan telah diselesaikan pada ' . date('Y-m-d H:i:s')
    ]);

    return redirect()->back()->with('success', 'Status pemesanan berhasil diubah menjadi SELESAI');
}

}