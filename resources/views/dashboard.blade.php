@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row g-3">
        <div class="col-md-3">
            <div class="card text-bg-success h-100">
                <div class="card-body">
                    <div class="text-uppercase small">Pemasukan</div>
                    <h3 class="mt-2">Rp {{ number_format($totalPemasukan ?? 0, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-danger h-100">
                <div class="card-body">
                    <div class="text-uppercase small">Pengeluaran</div>
                    <h3 class="mt-2">Rp {{ number_format($totalPengeluaran ?? 0, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-primary h-100">
                <div class="card-body">
                    <div class="text-uppercase small">Saldo</div>
                    <h3 class="mt-2">Rp {{ number_format($saldo ?? 0, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-warning h-100">
                <div class="card-body">
                    <div class="text-uppercase small">Iuran Lunas</div>
                    <h3 class="mt-2">{{ $totalIuranLunas ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">Transaksi Terbaru</div>
        <div class="card-body">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                        <th>Warga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksiTerbaru ?? [] as $item)
                        <tr>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->kategori }}</td>
                            <td>{{ ucfirst($item->jenis) }}</td>
                            <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                            <td>{{ $item->warga ? $item->warga->nama : '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
