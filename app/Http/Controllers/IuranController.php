<?php

namespace App\Http\Controllers;

use App\Models\Iuran;
use App\Models\Warga;
use Illuminate\Http\Request;

class IuranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin,bendahara,ketua_rw');
    }

    public function index(Request $request)
    {
        $query = Iuran::with('warga');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('bulan')) {
            $query->where('bulan', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        $iurans = $query->latest()->paginate(20);

        return view('iuran.index', compact('iurans'));
    }

    public function create()
    {
        $wargas = Warga::where('status', 'aktif')->get();
        return view('iuran.create', compact('wargas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'warga_id' => 'required|exists:wargas',
            'bulan' => 'required',
            'tahun' => 'required',
            'jumlah' => 'required|numeric|min:0',
        ]);

        Iuran::create($request->all());

        return redirect()->route('iuran.index')
            ->with('success', 'Data iuran berhasil ditambahkan.');
    }

    public function edit(Iuran $iuran)
    {
        $wargas = Warga::where('status', 'aktif')->get();
        return view('iuran.edit', compact('iuran', 'wargas'));
    }

    public function update(Request $request, Iuran $iuran)
    {
        $request->validate([
            'warga_id' => 'required|exists:wargas',
            'bulan' => 'required',
            'tahun' => 'required',
            'jumlah' => 'required|numeric|min:0',
        ]);

        $iuran->update($request->all());

        return redirect()->route('iuran.index')
            ->with('success', 'Data iuran berhasil diperbarui.');
    }

    public function bayar(Iuran $iuran)
    {
        if ($iuran->status === 'lunas') {
            return redirect()->route('iuran.index')
                ->with('warning', 'Iuran sudah lunas.');
        }

        $iuran->update([
            'status' => 'lunas',
            'tanggal_bayar' => now(),
        ]);

        return redirect()->route('iuran.index')
            ->with('success', 'Iuran berhasil dimarkir lunas.');
    }

    public function destroy(Iuran $iuran)
    {
        $iuran->delete();
        return redirect()->route('iuran.index')
            ->with('success', 'Data iuran berhasil dihapus.');
    }
}
