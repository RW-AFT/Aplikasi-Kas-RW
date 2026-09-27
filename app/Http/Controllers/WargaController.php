<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function index()
    {
        $wargas = Warga::latest()->get();
        return view('warga.index', compact('wargas'));
    }

    public function create()
    {
        return view('warga.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'nik' => 'required|unique:wargas,nik',
            'rt' => 'required',
            'rw' => 'required',
        ]);

        Warga::create($request->all());

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil disimpan.');
    }

    public function edit(Warga $warga)
    {
        return view('warga.edit', compact('warga'));
    }

    public function update(Request $request, Warga $warga)
    {
        $request->validate([
            'nama' => 'required|string',
            'nik' => 'required|unique:wargas,nik,' . $warga->id,
        ]);

        $warga->update($request->all());

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui.');
    }

    public function destroy(Warga $warga)
    {
        $warga->delete();
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus.');
    }
}
