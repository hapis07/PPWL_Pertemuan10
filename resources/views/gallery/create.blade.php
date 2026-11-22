
@extends('layout.master')

@section('title', 'Tambah Gallery')
@section('heading', 'Tambah Gallery')

@section('content')

<div class="card">

    <div class="card-header">
        <h4 class="card-title">Form Tambah Gallery</h4>
        <p class="text-muted mb-0">
            Tambahkan gambar ke dalam Gallery buku.
        </p>
    </div>

    <div class="card-body">

        <form action="{{ route('gallery.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="form-group mb-3">

                <label for="nama_galeri" class="form-label">
                    Nama Gallery
                </label>

                <input type="text"
                       id="nama_galeri"
                       name="nama_galeri"
                       value="{{ old('nama_galeri') }}"
                       class="form-control @error('nama_galeri') is-invalid @enderror"
                       placeholder="Masukkan nama Gallery"
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
                          class="form-control @error('keterangan') is-invalid @enderror"
                          placeholder="Masukkan keterangan">{{ old('keterangan') }}</textarea>

                @error('keterangan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            <div class="form-group mb-3">

                <label for="buku_id" class="form-label">
                    Pilih Buku
                </label>

                <select id="buku_id"
                        name="buku_id"
                        class="form-select @error('buku_id') is-invalid @enderror"
                        required>

                    <option value="">Pilih Buku</option>

                    @foreach ($bukus as $buku)

                        <option value="{{ $buku->id }}"
                            {{ old('buku_id') == $buku->id ? 'selected' : '' }}>

                            {{ $buku->judul }}

                        </option>

                    @endforeach

                </select>

                @error('buku_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            <div class="form-group mb-4">

                <label class="form-label">
                    Upload Foto Gallery
                </label>

                <div id="input-foto">

                    <div class="input-group mb-2">

                        <input type="file"
                               name="foto[]"
                               class="form-control"
                               accept="image/jpeg,image/png"
                               required>

                    </div>

                </div>

                <button type="button"
                        id="tambah-foto"
                        class="btn btn-outline-primary btn-sm">

                    <i class="bi bi-plus-circle me-1"></i>
                    Tambah Foto

                </button>

                @error('foto')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror

                @error('foto.*')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror

                <small class="text-muted d-block mt-2">
                    Format JPG, JPEG, atau PNG. Maksimal 2 MB per gambar.
                </small>

            </div>

            <div class="d-flex gap-2">

                <button type="submit" class="btn btn-primary">
                    Simpan Gallery
                </button>

                <a href="{{ route('gallery.index') }}"
                   class="btn btn-light-secondary">
                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>

<script>
    document.getElementById('tambah-foto').addEventListener('click', function () {

        const container = document.getElementById('input-foto');

        const group = document.createElement('div');
        group.className = 'input-group mb-2';

        group.innerHTML = `
            <input type="file"
                   name="foto[]"
                   class="form-control"
                   accept="image/jpeg,image/png"
                   required>

            <button type="button"
                    class="btn btn-danger hapus-foto">
                <i class="bi bi-trash"></i>
            </button>
        `;

        container.appendChild(group);
    });

    document.getElementById('input-foto').addEventListener('click', function (event) {

        const button = event.target.closest('.hapus-foto');

        if (button) {
            button.closest('.input-group').remove();
        }

    });
</script>

@endsection
