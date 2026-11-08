@extends('layouts.master')

@section('title', 'Edit User')
@section('heading', 'Edit User')

@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Form Edit User</h4>
    </div>

    <div class="card-body">

        <form action="{{ route('users.update', $user->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label>Nama</label>
                <input type="text"
                       name="name"
                       class="form-control"
                       value="{{ old('name', $user->name) }}"
                       required>
            </div>

            <div class="form-group mb-3">
                <label>Email</label>
                <input type="email"
                       name="email"
                       class="form-control"
                       value="{{ old('email', $user->email) }}"
                       required>
            </div>

            <div class="form-group mb-3">
                <label>Password Baru</label>
                <input type="password"
                       name="password"
                       class="form-control"
                       placeholder="Kosongkan jika tidak ingin mengubah password">
            </div>

            <div class="form-group mb-3">
                <label>Konfirmasi Password Baru</label>
                <input type="password"
                       name="password_confirmation"
                       class="form-control"
                       placeholder="Ulangi password baru">
            </div>

            <div class="form-group mb-3">
                <label>Level</label>
                <select name="level" class="form-select" required>
                    <option value="admin"
                        {{ old('level', $user->level) == 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>

                    <option value="user"
                        {{ old('level', $user->level) == 'user' ? 'selected' : '' }}>
                        User
                    </option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">
                Update
            </button>

            <a href="{{ route('users.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>
</div>

@endsection