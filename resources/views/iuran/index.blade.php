@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Data Iuran</h3>
    <a href="{{ route('iuran.create') }}" class="btn btn-primary mb-3">Tambah Iuran</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Warga</th>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($iurans as $item)
                <tr>
                    <td>{{ $item->warga->nama ?? '-' }}</td>
                    <td>{{ $item->bulan }}</td>
                    <td>{{ $item->tahun }}</td>
                    <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($item->status) }}</td>
                    <td>
                        <a href="{{ route('iuran.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
