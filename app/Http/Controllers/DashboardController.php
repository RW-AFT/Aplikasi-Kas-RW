<?php

namespace App\Http\Controllers;

use App\Models\Iuran;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPemasukan = Transaction::where('jenis', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = Transaction::where('jenis', 'pengeluaran')->sum('jumlah');
        $saldo = $totalPemasukan - $totalPengeluaran;

        $totalIuranLunas = Iuran::where('status', 'lunas')->count();
        $totalIuranBelum = Iuran::where('status', 'belum')->count();

        $transaksiTerbaru = Transaction::with('warga')->latest()->take(10)->get();

        return view('dashboard', compact(
            'totalPemasukan',
            'totalPengeluaran',
            'saldo',
            'totalIuranLunas',
            'totalIuranBelum',
            'transaksiTerbaru'
        ));
    }
}
