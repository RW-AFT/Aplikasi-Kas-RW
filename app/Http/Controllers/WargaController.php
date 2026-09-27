<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Iuran;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin,bendahara,ketua_rw');
    }

    public function index()
    {
        $wargas = Warga::latest()->paginate(20);
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
            'nik' => 'required|unique:wargas',
            'rt' => 'required',
            'rw' => 'required',
            'alamat' => 'nullable',
            'telepon' => 'nullable',
        ]);

        Warga::create($request->all());

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil ditambahkan.');
    }

    public function show(Warga $warga)
    {
        return view('warga.show', compact('warga'));
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

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil diperbarui.');
    }

    public function destroy(Warga $warga)
    {
        $warga->delete();
        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil dihapus.');
    }

    public function iuranHistory(Warga $warga)
    {
        $iurans = $warga->iurans()->latest()->paginate(10);
        return view('warga.iuran', compact('warga', 'iurans'));
    }
}
