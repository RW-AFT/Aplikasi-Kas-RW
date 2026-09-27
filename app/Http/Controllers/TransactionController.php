<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin,bendahara,ketua_rw');
    }

    public function index(Request $request)
    {
        $query = Transaction::with('warga', 'user');

        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        if ($request->filled('bulan') && $request->filled('tahun')) {
            $query->whereMonth('tanggal', $request->bulan)
                  ->whereYear('tanggal', $request->tahun);
        }

        $transactions = $query->latest()->paginate(20);

        return view('transaksi.index', compact('transactions'));
    }

    public function create()
    {
        $wargas = Warga::where('status', 'aktif')->get();
        $kategoris = [
            'Iuran',
            'Donasi',
            'Keamanan',
            'Kebersihan',
            'Perbaikan Jalan',
            'Lampu',
            'Air',
            'Kegiatan Sosial',
            'Administrasi',
            'Lainnya',
        ];
        return view('transaksi.create', compact('wargas', 'kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'kategori' => 'required',
            'jumlah' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable',
        ]);

        Transaction::create([
            'warga_id' => $request->warga_id,
            'jenis' => $request->jenis,
            'kategori' => $request->kategori,
            'keterangan' => $request->keterangan,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function edit(Transaction $transaction)
    {
        $wargas = Warga::where('status', 'aktif')->get();
        $kategoris = [
            'Iuran',
            'Donasi',
            'Keamanan',
            'Kebersihan',
            'Perbaikan Jalan',
            'Lampu',
            'Air',
            'Kegiatan Sosial',
            'Administrasi',
            'Lainnya',
        ];
        return view('transaksi.edit', compact('transaction', 'wargas', 'kategoris'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'kategori' => 'required',
            'jumlah' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
        ]);

        $transaction->update($request->all());

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }

    public function laporanBulanan()
    {
        $bulans = range(1, 12);
        $tahun = date('Y');

        $data = Transaction::select(
            DB::raw('MONTH(tanggal) as bulan'),
            DB::raw('YEAR(tanggal) as tahun'),
            DB::raw('jenis'),
            DB::raw('SUM(jumlah) as total')
        )
        ->groupBy('tahun', 'bulan', 'jenis')
        ->orderBy('tahun', 'desc')
        ->orderBy('bulan', 'desc')
        ->get();

        return view('transaksi.laporan', compact('data', 'bulans', 'tahun'));
    }
}
