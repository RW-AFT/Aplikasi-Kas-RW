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
        <div class="card text-bg-warning stat-card">
            <div class="stat-label">Total Iuran Belum</div>
            <div class="stat-number">{{ $totalIuranBelum }}</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <i class="bi bi-clock-history me-2"></i>Ringkasan Keuangan RW
    </div>
    <div class="card-body">
        <p class="text-muted">Anda memiliki akses terbatas. Hubungi bendahara atau ketua RW untuk informasi lengkap.</p>
        <div class="alert alert-info" role="alert">
            <strong>Info:</strong> Total iuran yang belum dibayar: <strong>{{ $totalIuranBelum }}</strong> warga
        </div>
    </div>
</div>
@endsection
