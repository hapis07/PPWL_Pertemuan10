@extends('layout.master')

@section('title', 'List Buku')
@section('heading', 'Daftar Buku')

@section('content')

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Kumpulan Buku</h4>
            <p class="text-muted mb-0">
                Pilih buku untuk melihat koleksi gambar galerinya.
            </p>
        </div>

        <div class="card-body">

            <div class="row">

                @forelse ($bukus as $buku)

                    <div class="col-12 col-md-4 col-lg-3 mb-4">

                        <div class="card h-100">

                            @if ($buku->foto)
                                <img src="{{ asset('storage/' . ltrim($buku->foto, '/')) }}" class="card-img-top"
                                    alt="{{ $buku->judul }}" style="height: 250px; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex justify-content-center align-items-center" style="height: 250px;">
                                    <span class="text-muted">
                                        Foto belum tersedia
                                    </span>
                                </div>
                            @endif

                            <div class="card-body text-center">

                                <h5 class="card-title">
                                    {{ $buku->judul }}
                                </h5>

                                <p class="text-muted small">
                                    {{ $buku->penulis }}
                                </p>

                                <a href="{{ route('galeri.buku', ['title' => $buku->buku_seo]) }}"
                                    class="btn btn-primary btn-sm">

                                    <i class="bi bi-images me-1"></i>
                                    Lihat Gallery

                    
                                </a>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-12 text-center py-5">
                        <i class="bi bi-book fs-1 d-block mb-2"></i>
                        <p class="text-muted">
                            Belum terdapat data buku.
                        </p>
                    </div>

                @endforelse

            </div>

            <div class="mt-3">
                {{ $bukus->links() }}
            </div>

        </div>
    </div>

@endsection