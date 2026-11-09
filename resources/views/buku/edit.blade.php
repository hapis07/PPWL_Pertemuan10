@extends('layout.master')

@section('title', 'Edit Buku')
@section('heading', 'Edit Buku')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Form Edit Buku</h4>
        <p class="text-muted mb-0">Perbarui informasi buku.</p>
    </div>

    <div class="card-body">
        <form action="{{ route('buku.update', $buku->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="judul" class="form-label">Judul Buku</label>
                <input type="text"
                       id="judul"
                       name="judul"
                       value="{{ old('judul', $buku->judul) }}"
                       class="form-control @error('judul') is-invalid @enderror"
                       placeholder="Masukkan judul buku"
                       required>

                @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input type="text"
                       id="penulis"
                       name="penulis"
                       value="{{ old('penulis', $buku->penulis) }}"
                       class="form-control @error('penulis') is-invalid @enderror"
                       placeholder="Masukkan nama penulis"
                       required>

                @error('penulis')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number"
                       id="harga"
                       name="harga"
                       value="{{ old('harga', $buku->harga) }}"
                       class="form-control @error('harga') is-invalid @enderror"
                       placeholder="Masukkan harga buku"
                       min="0"
                       required>

                @error('harga')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label for="tgl_terbit" class="form-label">
                    Tanggal Terbit
                </label>

                <input type="date"
                       id="tgl_terbit"
                       name="tgl_terbit"
                       value="{{ old('tgl_terbit', $buku->tgl_terbit->format('Y-m-d')) }}"
                       class="form-control @error('tgl_terbit') is-invalid @enderror"
                       required>

                @error('tgl_terbit')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label for="cover" class="form-label">Cover Buku</label>

                @if ($buku->cover)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $buku->cover) }}"
                             alt="Cover {{ $buku->judul }}"
                             width="120"
                             height="150"
                             style="object-fit: cover;">
                    </div>
                @else
                    <p class="text-muted">Belum ada cover buku.</p>
                @endif

                <input type="file"
                       id="cover"
                       name="cover"
                       class="form-control @error('cover') is-invalid @enderror"
                       accept="image/jpeg,image/png">

                <small class="text-muted">
                    Kosongkan jika tidak ingin mengganti cover.
                </small>

                @error('cover')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    Simpan Perubahan
                </button>

                <a href="{{ route('buku.index') }}"
                   class="btn btn-light-secondary">
                    Kembali
                </a>
            </div>

        </form>
    </div>
</div>
@endsection