@extends('layout.auth')

@section('title', 'Login')

@section('content')

    <div class="text-center mb-4">
        <h2 class="auth-title">Login</h2>
        <p class="text-muted">
            Selamat Datang di Aplikasi Data Buku.
            Silakan login untuk melanjutkan.
        </p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            Email atau password yang dimasukkan tidak sesuai.
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group mb-4">
            <label for="email" class="form-label">Alamat Email</label>

            <input
                id="email"
                type="email"
                class="form-control @error('email') is-invalid @enderror"
                name="email"
                value="{{ old('email') }}"
                placeholder="Masukkan alamat email"
                required
                autofocus
                autocomplete="username"
            >

            @error('email')
                <span class="invalid-feedback">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="form-group mb-4">
            <label for="password" class="form-label">Password</label>

            <input
                id="password"
                type="password"
                class="form-control @error('password') is-invalid @enderror"
                name="password"
                placeholder="Masukkan password"
                required
                autocomplete="current-password"
            >

            @error('password')
                <span class="invalid-feedback">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">
            Login
        </button>
    </form>

    <div class="text-center mt-4">
        <small class="text-muted">
            2026 &copy; Aplikasi Data Buku
        </small>
    </div>

@endsection