<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kwitansi extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'kwitansi';
    protected $fillable = [
        'no_transaksi',
        'sejumlah',
        'utk_pembayaran', 
        'jenis'
    ];
}
