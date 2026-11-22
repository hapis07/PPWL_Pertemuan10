
@extends('layout.master')

@section('title', 'Detail Gallery Buku')
@section('heading', 'Detail Gallery Buku')

@section('content')

<div class="card">

    <div class="card-header">
        <h4 class="card-title">
            {{ $buku->judul }}
        </h4>

        <p class="text-muted mb-0">
            Koleksi gambar Gallery buku {{ $buku->judul }}
        </p>
    </div>

    <div class="card-body">

        <div class="row">

            @forelse ($galeris as $galeri)

                <div class="col-6 col-md-4 col-lg-3 mb-4">

                    <div class="card h-100">

                        <a href="{{ asset('storage/' . ltrim($galeri->path, '/')) }}"
                           data-lightbox="gallery-buku-{{ $buku->id }}"
                           data-title="{{ $galeri->keterangan }}">

                            <img src="{{ asset('storage/' . ltrim($galeri->path, '/')) }}"
                                 class="card-img-top"
                                 alt="{{ $galeri->nama_galeri }}"
                                 style="height: 200px; object-fit: cover;">

                        </a>

                        <div class="card-body">

                            <h6 class="card-title">
                                {{ $galeri->nama_galeri }}
                            </h6>

                            <p class="text-muted small">
                                {{ $galeri->keterangan }}
                            </p>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12 text-center py-5">

                    <i class="bi bi-images fs-1 d-block mb-2"></i>

                    <h5>Belum Ada Gallery</h5>

                    <p class="text-muted">
                        Belum terdapat gambar untuk buku ini.
                    </p>

                </div>

            @endforelse

        </div>

        <div class="mt-3">
            {{ $galeris->links() }}
        </div>

        <a href="{{ route('buku.list') }}"
           class="btn btn-light-secondary mt-3">

            <i class="bi bi-arrow-left me-1"></i>
            Kembali ke List Buku

        </a>

    </div>

</div>

@endsection
