<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Warga;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('warga')->latest()->get();
        return view('transaksi.index', compact('transactions'));
    }

    public function create()
    {
        $wargas = Warga::all();
        return view('transaksi.create', compact('wargas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'kategori' => 'required',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        Transaction::create([
            'warga_id' => $request->warga_id,
            'jenis' => $request->jenis,
            'kategori' => $request->kategori,
            'keterangan' => $request->keterangan,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'user_id' => 1,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan.');
    }

    public function edit(Transaction $transaction)
    {
        $wargas = Warga::all();
        return view('transaksi.edit', compact('transaction', 'wargas'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'kategori' => 'required',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        $transaction->update($request->all());

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
