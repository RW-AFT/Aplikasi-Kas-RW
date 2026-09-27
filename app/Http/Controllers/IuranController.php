<?php

namespace App\Http\Controllers;

use App\Models\Iuran;
use App\Models\Warga;
use Illuminate\Http\Request;

class IuranController extends Controller
{
    public function index()
    {
        $iurans = Iuran::with('warga')->latest()->get();
        return view('iuran.index', compact('iurans'));
    }

    public function create()
    {
        $wargas = Warga::all();
        return view('iuran.create', compact('wargas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'warga_id' => 'required|exists:wargas,id',
            'bulan' => 'required',
            'tahun' => 'required',
            'jumlah' => 'required|numeric',
        ]);

        Iuran::create($request->all());

        return redirect()->route('iuran.index')->with('success', 'Data iuran berhasil disimpan.');
    }

    public function edit(Iuran $iuran)
    {
        $wargas = Warga::all();
        return view('iuran.edit', compact('iuran', 'wargas'));
    }

    public function update(Request $request, Iuran $iuran)
    {
        $request->validate([
            'warga_id' => 'required|exists:wargas,id',
            'bulan' => 'required',
            'tahun' => 'required',
            'jumlah' => 'required|numeric',
        ]);

        $iuran->update($request->all());

        return redirect()->route('iuran.index')->with('success', 'Data iuran berhasil diperbarui.');
    }

    public function destroy(Iuran $iuran)
    {
        $iuran->delete();
        return redirect()->route('iuran.index')->with('success', 'Data iuran berhasil dihapus.');
    }
}
