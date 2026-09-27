@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Warga</h3>
        <a href="{{ route('warga.create') }}" class="btn btn-primary">Tambah Warga</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>NIK</th>
                <th>RT/RW</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($wargas as $warga)
                <tr>
                    <td>{{ $warga->nama }}</td>
                    <td>{{ $warga->nik }}</td>
                    <td>{{ $warga->rt }}/{{ $warga->rw }}</td>
                    <td>{{ $warga->alamat }}</td>
                    <td>{{ $warga->telepon }}</td>
                    <td>{{ ucfirst($warga->status) }}</td>
                    <td>
                        <a href="{{ route('warga.edit', $warga->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('warga.destroy', $warga->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
