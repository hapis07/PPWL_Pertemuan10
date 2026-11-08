@extends('layouts.master')

@section('title', 'Tambah User')
@section('heading', 'Tambah User')

@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Form Tambah User</h4>
    </div>

    <div class="card-body">

        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label>Nama</label>
                <input type="text"
                       name="name"
                       class="form-control"
                       value="{{ old('name') }}"
                       placeholder="Masukkan nama"
                       required>
            </div>

            <div class="form-group mb-3">
                <label>Email</label>
                <input type="email"
                       name="email"
                       class="form-control"
                       value="{{ old('email') }}"
                       placeholder="Masukkan email"
                       required>
            </div>

            <div class="form-group mb-3">
                <label>Password</label>
                <input type="password"
                       name="password"
                       class="form-control"
                       placeholder="Masukkan password"
                       required>
            </div>

            <div class="form-group mb-3">
                <label>Konfirmasi Password</label>
                <input type="password"
                       name="password_confirmation"
                       class="form-control"
                       placeholder="Ulangi password"
                       required>
            </div>

            <div class="form-group mb-3">
                <label>Level</label>
                <select name="level" class="form-select" required>
                    <option value="">-- Pilih Level --</option>
                    <option value="admin" {{ old('level') == 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>
                    <option value="user" {{ old('level') == 'user' ? 'selected' : '' }}>
                        User
                    </option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">
                Simpan
            </button>

            <a href="{{ route('users.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>
</div>

@endsection