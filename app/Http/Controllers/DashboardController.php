<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Service;
use App\Models\Toko;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        $results = Service::where('name', 'LIKE', "%{$query}%")
                        ->orWhere('category', 'LIKE', "%{$query}%")
                        ->get();

        return response()->json($results);
    }

    public function index()
    {
        $data = [
            'product' => Service::all(),
            'popular' => Service::where('category', 'popular')->get(),
            'new' => Service::where('category', 'new')->get()
        ];

        return view('welcome', $data);
    }

    public function admin()
    {
        $data = [
            
        ];

        return view('admin.index', $data);
    }

    public function getTotalBayar(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        // Ambil user_id dari request
        $userId = $request->input('user_id');

        // Ambil data toko berdasarkan user_id
        $toko = Toko::where('user_id', $userId)->first();

        if (!$toko) {
            return response()->json([
                'status' => 'error',
                'message' => 'Toko tidak ditemukan'
            ], 404);
        }

        // Hitung total bayar berdasarkan toko_id
        $totalBayar = Pembayaran::where('toko_id', $toko->id)->sum('total_bayar');

        // Hitung jumlah pembayaran
        $jumlahPembayaran = Pembayaran::where('toko_id', $toko->id)->count();

        // Hitung jumlah pembayaran dalam minggu ini
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $pendapatanMingguIni = Pembayaran::where('toko_id', $toko->id)
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->sum('total_bayar');

        return response()->json([
            'status' => 'success',
            'total_bayar' => $totalBayar,
            'jumlah_pembayaran' => $jumlahPembayaran,
            'pendapatan_minggu_ini' => $pendapatanMingguIni
        ]);
    }
}
