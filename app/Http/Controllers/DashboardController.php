<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\faktur_penjualan; 
use App\Models\User; 
use App\Models\Kwitansi;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Data untuk default view (hari ini)
        $today = Carbon::today();
        
        // Total pemesanan
        $totalPemesanan = faktur_penjualan::count();
        
        // Pemesanan dengan status progress (jika ada kolom status)
        $pemesananProgress = faktur_penjualan::where('status', 'progress')->count();
        
        // Hitung lunas/belum lunas berdasarkan kwitansi
        $fakturs = faktur_penjualan::with('kwitansi')->get();
        $pembayaranLunas = 0;
        $pembayaranBelumLunas = 0;
        
        foreach ($fakturs as $faktur) {
            $totalDibayar = $faktur->kwitansi->sum('sejumlah');
            if ($totalDibayar >= $faktur->total_akhir) {
                $pembayaranLunas++;
            } else {
                $pembayaranBelumLunas++;
            }
        }
        
        // Untuk tampilan dashboard default (tidak perlu data lengkap)
        $data = [
            'totalPemesanan' => $totalPemesanan,
            'pemesananProgress' => $pemesananProgress,
            'pembayaranLunas' => $pembayaranLunas,
            'pembayaranBelumLunas' => $pembayaranBelumLunas,
        ];
        
        return view('dashboard', $data);
    }
    
    public function filterData(Request $request)
    {
        $type = $request->type;
        $filter = $request->filter;
        
        $now = Carbon::now();
        $value = 0;
        
        // Tentukan rentang tanggal berdasarkan filter
        switch($filter) {
            case 'hari_ini':
                $startDate = $now->format('Y-m-d');
                $endDate = $now->format('Y-m-d');
                break;
            case 'minggu_ini':
                $startDate = $now->startOfWeek()->format('Y-m-d');
                $endDate = $now->endOfWeek()->format('Y-m-d');
                break;
            case 'bulan_ini':
                $startDate = $now->startOfMonth()->format('Y-m-d');
                $endDate = $now->endOfMonth()->format('Y-m-d');
                break;
            case 'tahun_ini':
                $startDate = $now->startOfYear()->format('Y-m-d');
                $endDate = $now->endOfYear()->format('Y-m-d');
                break;
            default:
                $startDate = $now->format('Y-m-d');
                $endDate = $now->format('Y-m-d');
        }
        
        // Hitung berdasarkan tipe data
        switch($type) {
            case 'totalPemesanan':
                if ($filter == 'hari_ini') {
                    $value = faktur_penjualan::whereDate('tanggal', $startDate)->count();
                } else {
                    $value = faktur_penjualan::whereBetween('tanggal', [$startDate, $endDate])->count();
                }
                break;
                
            case 'pemesananProgress':
                if ($filter == 'hari_ini') {
                    $value = faktur_penjualan::whereDate('tanggal', $startDate)
                        ->where('status', '!=', 'selesai')
                        ->count();
                } else {
                    $value = faktur_penjualan::whereBetween('tanggal', [$startDate, $endDate])
                        ->where('status', '!=', 'selesai')
                        ->count();
                }
                break;
                
            case 'pembayaranLunas':
                // Hitung yang sudah lunas berdasarkan kwitansi dalam rentang waktu
                if ($filter == 'hari_ini') {
                    $fakturs = faktur_penjualan::whereDate('tanggal', $startDate)
                        ->with('kwitansi')
                        ->get();
                } else {
                    $fakturs = faktur_penjualan::whereBetween('tanggal', [$startDate, $endDate])
                        ->with('kwitansi')
                        ->get();
                }
                
                foreach ($fakturs as $faktur) {
                    $totalDibayar = $faktur->kwitansi->sum('sejumlah');
                    if ($totalDibayar >= $faktur->total_akhir) {
                        $value++;
                    }
                }
                break;
                
            case 'pembayaranBelumLunas':
                // Hitung yang belum lunas berdasarkan kwitansi dalam rentang waktu
                if ($filter == 'hari_ini') {
                    $fakturs = faktur_penjualan::whereDate('tanggal', $startDate)
                        ->with('kwitansi')
                        ->get();
                } else {
                    $fakturs = faktur_penjualan::whereBetween('tanggal', [$startDate, $endDate])
                        ->with('kwitansi')
                        ->get();
                }
                
                foreach ($fakturs as $faktur) {
                    $totalDibayar = $faktur->kwitansi->sum('sejumlah');
                    if ($totalDibayar < $faktur->total_akhir) {
                        $value++;
                    }
                }
                break;
                
            default:
                $value = 0;
        }
        
        return response()->json(['value' => $value]);
    }
    
    // Method lama untuk data lengkap (jika masih diperlukan)
    public function getDetailedStats()
    {
        $totalPemesanan = faktur_penjualan::count();
        $pemesananProgress = faktur_penjualan::where('status', 'progress')->count();
        $pemesananSelesai = faktur_penjualan::where('status', 'selesai')->count();
        $totalPendapatan = faktur_penjualan::sum('total_akhir');
        
        // Hitung lunas/belum lunas
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
        
        // Pemesanan belum lunas
        $pemesananBelumLunas = faktur_penjualan::with('kwitansi')
            ->get()
            ->filter(function($faktur) {
                $totalDibayar = $faktur->kwitansi->sum('sejumlah');
                return $totalDibayar < $faktur->total_akhir;
            })
            ->take(5);
        
        $totalUsers = User::count();
        $averageOrderValue = $totalPemesanan > 0 ? round($totalPendapatan / $totalPemesanan) : 0;
        $todayOrders = faktur_penjualan::whereDate('tanggal', date('Y-m-d'))->count();
        $totalItemsSold = faktur_penjualan::sum('total_item');
        $percentageLunas = $totalPemesanan > 0 ? round(($pembayaranLunas / $totalPemesanan) * 100, 1) : 0;
        
        // Hitung pemesanan terlambat
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
        
        return compact(
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
        );
    }
}