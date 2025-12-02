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

        return redirect('faktur_penjualan')->with('success', 'Pemesanan berhasil ditambahkan');
    }
        public function edit(faktur_penjualan $faktur_penjualan)
        {
            // Sekarang $faktur_penjualan adalah object model, bukan string ID
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
    $faktur_penjualan->update(['tanggal' => $request->tanggal,
            'kode_sales' => $request->kode_sales,
            'pelanggan' => $request->pelanggan,
            'alamat' => $request->alamat,
            'kontak_wa' => $request->kontak_wa,
            'email' => $request->email,
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
            'keterangan' => $request->keterangan,]);
return redirect('faktur_penjualan')->with('success', 'Pemesanan berhasil diupdate');
}

public function destroy(faktur_penjualan $faktur_penjualan)
{
    $faktur_penjualan->delete();
    return redirect('faktur_penjualan')->with('success','Data Berhasil Dihapus');
}

 public function kelola($id)
    {
        // Ambil data faktur berdasarkan no_transaksi
        $faktur = faktur_penjualan::where('no_transaksi', $id)->first();
        
        if (!$faktur) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        // Data kwitansi
        $kwitansi = Kwitansi::where('no_transaksi', $id)->get();
        $totalDibayar = $kwitansi->sum('sejumlah');
        $sisa = $faktur->total_akhir - $totalDibayar;

        return view('faktur_penjualan.kelola.index-kelola', compact('faktur', 'kwitansi', 'totalDibayar', 'sisa'));
    }

    public function storeKwitansi(Request $request)
{
    $request->validate([
        'no_transaksi' => 'required',
        'sejumlah' => 'required|numeric|min:1',
        'utk_pembayaran' => 'required',
        'jenis' => 'required|in:1,2'
    ]);

    Kwitansi::create([
        'no_transaksi' => $request->no_transaksi,
        'sejumlah' => $request->sejumlah,
        'utk_pembayaran' => $request->utk_pembayaran,
        'jenis' => $request->jenis
    ]);

    return redirect()->back()->with('success', 'Pembayaran berhasil disimpan!');
}

public function destroyKwitansi($id)
{
    $kwitansi = Kwitansi::find($id);
    
    if (!$kwitansi) {
        return redirect()->back()->with('error', 'Kwitansi tidak ditemukan');
    }

    $kwitansi->delete();

    return redirect()->back()->with('success', 'Kwitansi berhasil dihapus');
}
   
}