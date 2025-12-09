<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\faktur_penjualan; 
use App\Models\User; 
use App\Models\Kwitansi;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        // Total pemesanan
        $totalPemesanan = faktur_penjualan::count();
        
        // Pemesanan dengan status progress (jika ada kolom status)
        $pemesananProgress = faktur_penjualan::where('status', 'progress')->count();
        
        // Pemesanan selesai (jika ada kolom status)
        $pemesananSelesai = faktur_penjualan::where('status', 'selesai')->count();
        
        // Total pendapatan
        $totalPendapatan = faktur_penjualan::sum('total_akhir');
        
        // Hitung lunas/belum lunas berdasarkan kwitansi
        $fakturs = faktur_penjualan::with('kwitansi')->get();
        $pembayaranLunas = 0;
        $pembayaranBelumLunas = 0;
        $totalPiutang = 0;
        
        foreach ($fakturs as $faktur) {
            $totalDibayar = $faktur->kwitansi->sum('sejumlah');
            if ($totalDibayar >= $faktur->total_akhir) {
                $pembayaranLunas++;
            } else {
                $pembayaranBelumLunas++;
                $totalPiutang += ($faktur->total_akhir - $totalDibayar);
            }
        }
        
        // Pemesanan belum lunas (limit 5 untuk dashboard)
        $pemesananBelumLunas = faktur_penjualan::with('kwitansi')
            ->get()
            ->filter(function($faktur) {
                $totalDibayar = $faktur->kwitansi->sum('sejumlah');
                return $totalDibayar < $faktur->total_akhir;
            })
            ->take(5);
        
        // Stats tambahan
        $totalUsers = User::count();
        $averageOrderValue = $totalPemesanan > 0 ? round($totalPendapatan / $totalPemesanan) : 0;
        
        // Pemesanan hari ini - gunakan kolom tanggal
        $todayOrders = faktur_penjualan::where('tanggal', date('Y-m-d'))->count();
        
        // Total item terjual
        $totalItemsSold = faktur_penjualan::sum('total_item');
        
        // Hitung persentase
        $percentageLunas = $totalPemesanan > 0 ? round(($pembayaranLunas / $totalPemesanan) * 100, 1) : 0;
        
        // Hitung pemesanan terlambat (jika ada tgl_jt)
        $pemesananTerlambat = 0;
        if (Schema::hasColumn('faktur_penjualan', 'tgl_jt')) {
            $pemesananTerlambat = faktur_penjualan::where('tgl_jt', '<', date('Y-m-d'))
                ->get()
                ->filter(function($faktur) {
                    $totalDibayar = $faktur->kwitansi->sum('sejumlah');
                    return $totalDibayar < $faktur->total_akhir;
                })
                ->count();
        }
        
        return view('dashboard', compact(
            'totalPemesanan',
            'pemesananProgress',
            'pemesananSelesai',
            'totalPendapatan',
            'pembayaranLunas',
            'pembayaranBelumLunas',
            'pemesananBelumLunas',
            'totalUsers',
            'averageOrderValue',
            'todayOrders',
            'totalItemsSold',
            'totalPiutang',
            'percentageLunas',
            'pemesananTerlambat'
        ));
    }
}