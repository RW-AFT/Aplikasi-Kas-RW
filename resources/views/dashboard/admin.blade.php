@extends('layouts.app')

@section('title', 'Dashboard - Kas RW')

@section('content')
<div class="row mb-4">
    <div class="col-md-6 col-lg-3">
        <div class="card text-bg-success stat-card">
            <div class="stat-label">Pemasukan</div>
            <div class="stat-number">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card text-bg-danger stat-card">
            <div class="stat-label">Pengeluaran</div>
            <div class="stat-number">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card text-bg-primary stat-card">
            <div class="stat-label">Saldo</div>
            <div class="stat-number">Rp {{ number_format($saldo, 0, ',', '.') }}</div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card text-bg-info stat-card">
            <div class="stat-label">Total Warga</div>
            <div class="stat-number">{{ $totalWarga }}</div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-receipt me-2"></i>Status Iuran
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <h4 class="text-success">{{ $totalIuranLunas }}</h4>
                        <small class="text-muted">Iuran Lunas</small>
                    </div>
                    <div class="col-6">
                        <h4 class="text-danger">{{ $totalIuranBelum }}</h4>
                        <small class="text-muted">Iuran Belum</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-bar-chart me-2"></i>Quick Actions
            </div>
            <div class="card-body">
                <a href="{{ route('warga.create') }}" class="btn btn-sm btn-primary mb-2 w-100">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Warga
                </a>
                <a href="{{ route('iuran.create') }}" class="btn btn-sm btn-success mb-2 w-100">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Iuran
                </a>
                <a href="{{ route('transaksi.create') }}" class="btn btn-sm btn-info mb-2 w-100">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Transaksi
                </a>
                <a href="{{ route('transaksi.laporan') }}" class="btn btn-sm btn-warning w-100">
                    <i class="bi bi-file-earmark-pdf me-2"></i>Laporan Kas
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <i class="bi bi-clock-history me-2"></i>Transaksi Terbaru
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                        <th>Warga</th>
                        <th>Input Oleh</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksiTerbaru as $item)
                        <tr>
                            <td>{{ $item->tanggal->format('d/m/Y') }}</td>
                            <td>{{ $item->kategori }}</td>
                            <td>
                                @if($item->jenis === 'pemasukan')
                                    <span class="badge bg-success">Pemasukan</span>
                                @else
                                    <span class="badge bg-danger">Pengeluaran</span>
                                @endif
                            </td>
                            <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                            <td>{{ $item->warga ? $item->warga->nama : '-' }}</td>
                            <td>{{ $item->user ? $item->user->name : '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Tidak ada data transaksi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
