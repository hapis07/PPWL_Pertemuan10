
@extends('layout.master')

@section('title', 'Edit Gallery')
@section('heading', 'Edit Gallery')

@section('content')

<div class="card">

    <div class="card-header">
        <h4 class="card-title">Form Edit Gallery</h4>
        <p class="text-muted mb-0">
            Perbarui informasi gambar Gallery.
        </p>
    </div>

    <div class="card-body">

        <form action="{{ route('gallery.update', ['gallery' => $gallery->id]) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="form-group mb-3">

                <label for="nama_galeri" class="form-label">
                    Nama Gallery
                </label>

                <input type="text"
                       id="nama_galeri"
                       name="nama_galeri"
                       value="{{ old('nama_galeri', $gallery->nama_galeri) }}"
                       class="form-control @error('nama_galeri') is-invalid @enderror"
                       required>

                @error('nama_galeri')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            <div class="form-group mb-3">

                <label for="keterangan" class="form-label">
                    Keterangan
                </label>

                <textarea id="keterangan"
                          name="keterangan"
                          rows="4"
                          class="form-control">{{ old('keterangan', $gallery->keterangan) }}</textarea>

            </div>

            <div class="form-group mb-3">

                <label for="buku_id" class="form-label">
                    Pilih Buku
                </label>

                <select id="buku_id"
                        name="buku_id"
                        class="form-select"
                        required>

                    @foreach ($bukus as $buku)

                        <option value="{{ $buku->id }}"
                            {{ old('buku_id', $gallery->buku_id) == $buku->id ? 'selected' : '' }}>

                            {{ $buku->judul }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="form-group mb-4">

                <label class="form-label">
                    Foto Saat Ini
                </label>

                @if ($gallery->path)

                    <div class="mb-3">

                        <img src="{{ asset('storage/' . $gallery->path) }}"
                             alt="{{ $gallery->nama_galeri }}"
                             width="150"
                             style="object-fit: cover;">

                    </div>

                @else

                    <p class="text-muted">
                        Foto belum tersedia.
                    </p>

                @endif

                <label for="foto" class="form-label">
                    Ganti Foto
                </label>

                <input type="file"
                       id="foto"
                       name="foto"
                       class="form-control @error('foto') is-invalid @enderror"
                       accept="image/jpeg,image/png">

                <small class="text-muted">
                    Kosongkan jika tidak ingin mengganti foto.
                </small>

                @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            <div class="d-flex gap-2">

                <button type="submit" class="btn btn-primary">
                    Simpan Perubahan
                </button>

                <a href="{{ route('gallery.index') }}"
                   class="btn btn-light-secondary">
                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>

@endsection
