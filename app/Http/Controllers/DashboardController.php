<?php

namespace App\Http\Controllers;

use App\Models\Iuran;
use App\Models\Transaction;
use App\Models\Warga;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();

        $totalPemasukan = Transaction::where('jenis', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = Transaction::where('jenis', 'pengeluaran')->sum('jumlah');
        $saldo = $totalPemasukan - $totalPengeluaran;

        $totalWarga = Warga::count();
        $totalIuranLunas = Iuran::where('status', 'lunas')->count();
        $totalIuranBelum = Iuran::where('status', 'belum')->count();

        $transaksiTerbaru = Transaction::with('warga', 'user')
            ->latest()
            ->take(10)
            ->get();

        // Grafik pemasukan bulanan
        $bulananData = Transaction::select(
            DB::raw('DATE(tanggal) as tanggal'),
            DB::raw('SUM(CASE WHEN jenis = "pemasukan" THEN jumlah ELSE 0 END) as pemasukan'),
            DB::raw('SUM(CASE WHEN jenis = "pengeluaran" THEN jumlah ELSE 0 END) as pengeluaran')
        )
        ->groupBy('tanggal')
        ->orderBy('tanggal', 'desc')
        ->take(30)
        ->get();

        $stats = [
            'totalPemasukan' => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
            'saldo' => $saldo,
            'totalWarga' => $totalWarga,
            'totalIuranLunas' => $totalIuranLunas,
            'totalIuranBelum' => $totalIuranBelum,
            'transaksiTerbaru' => $transaksiTerbaru,
            'bulananData' => $bulananData,
        ];

        // Role-specific view
        if ($user->isAdmin() || $user->isKetuaRW()) {
            return view('dashboard.admin', $stats);
        }

        return view('dashboard.user', $stats);
    }
}
