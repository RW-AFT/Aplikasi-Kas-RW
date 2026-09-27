@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Warga</h3>

    <form action="{{ route('warga.store') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">NIK</label>
                <input type="text" name="nik" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">RT</label>
                <input type="text" name="rt" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">RW</label>
                <input type="text" name="rw" class="form-control" required>
            </div>
            <div class="col-md-12">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control"></textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label">Telepon</label>
                <input type="text" name="telepon" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="aktif">Aktif</option>
                    <option value="tidak_aktif">Tidak Aktif</option>
                </select>
            </div>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('warga.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection
