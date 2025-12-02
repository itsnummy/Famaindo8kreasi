<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class faktur_penjualan extends Model
{
    use HasFactory;
    
    protected $table = 'faktur_penjualan';
    protected $primaryKey = 'no_transaksi'; // Tetap pakai no_transaksi sebagai primary key
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    
    protected $fillable = [
        'no_transaksi', 'kode_sales', 'pelanggan', 'alamat', 'kontak_wa',
        'email', 'item_pesanan', 'harga_satuan', 'total_item', 'kredit',
        'total_akhir', 'potongan', 'biaya_lain', 'status', 'kembali',
        'tunai', 'tanggal', 'id_user', 'tgl_jt', 'subtotal', 'keterangan',
        'K_Debit', 'DP_PO', 'jml', 'K_Kredit', 'pajak', 'terbilang'
    ];
}