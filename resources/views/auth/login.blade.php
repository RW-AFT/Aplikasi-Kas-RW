@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh; background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);">
    <div class="card" style="width: 100%; max-width: 400px;">
        <div class="card-body p-5">
            <div class="text-center mb-4">
                <h2 class="fw-bold" style="color: #2c3e50;">
                    <i class="bi bi-cash-coin me-2"></i>Kas RW
                </h2>
                <p class="text-muted">Sistem Manajemen Keuangan RT/RW</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3">Login</button>
            </form>

            <div class="text-center text-muted small">
                <p>Hubungi admin untuk akun baru</p>
            </div>
        </div>
    </div>
</div>
@endsection
