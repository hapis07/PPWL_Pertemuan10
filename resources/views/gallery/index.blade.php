
@extends('layout.master')

@section('title', 'Gallery Buku')
@section('heading', 'Gallery Buku')

@section('content')

<div class="card">

    <div class="card-header">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">

            <h4 class="card-title mb-0">Daftar Gallery</h4>

            <a href="{{ route('gallery.create') }}"
               class="btn btn-primary">

                <i class="bi bi-plus-circle me-1"></i>
                Tambah Gallery

            </a>

        </div>
    </div>

    <div class="card-body">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show"
                 role="alert">

                {{ session('success') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Tutup">
                </button>

            </div>
        @endif

        <div class="row">

            @forelse ($galleries as $gallery)

                <div class="col-12 col-md-4 col-lg-3 mb-4">

                    <div class="card h-100">

                        @if ($gallery->path)

                            <a href="{{ asset('storage/' . $gallery->path) }}"
                               data-lightbox="gallery-buku"
                               data-title="{{ $gallery->keterangan }}">

                                <img src="{{ asset('storage/' . $gallery->path) }}"
                                     class="card-img-top"
                                     alt="{{ $gallery->nama_galeri }}"
                                     style="height: 200px; object-fit: cover;">

                            </a>

                        @else

                            <div class="text-center p-5">
                                Foto tidak tersedia.
                            </div>

                        @endif

                        <div class="card-body">

                            <h5 class="card-title">
                                {{ $gallery->nama_galeri }}
                            </h5>

                            <p class="card-text text-muted">
                                {{ $gallery->keterangan }}
                            </p>

                            <p class="small">
                                Buku:
                                {{ $gallery->buku->judul ?? 'Tidak tersedia' }}
                            </p>

                            <div class="d-flex gap-1">

                                <a href="{{ route('gallery.edit', ['gallery' => $gallery->id]) }}"
                                   class="btn btn-warning btn-sm">

                                    <i class="bi bi-pencil-square"></i>
                                    Edit

                                </a>

                                <form action="{{ route('gallery.destroy', ['gallery' => $gallery->id]) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus gambar ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger btn-sm">

                                        <i class="bi bi-trash"></i>
                                        Hapus

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12 text-center py-5">

                    <i class="bi bi-images fs-1 d-block mb-2"></i>

                    <p class="text-muted">
                        Belum ada gambar Gallery.
                    </p>

                </div>

            @endforelse

        </div>

        <div class="mt-3">
            {{ $galleries->links() }}
        </div>

    </div>

</div>

@endsection
