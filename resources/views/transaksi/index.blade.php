@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Transaksi Kas</h3>
    <a href="{{ route('transaksi.create') }}" class="btn btn-primary mb-3">Tambah Transaksi</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Warga</th>
                <th>Jenis</th>
                <th>Kategori</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $item)
                <tr>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->warga->nama ?? '-' }}</td>
                    <td>{{ ucfirst($item->jenis) }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
