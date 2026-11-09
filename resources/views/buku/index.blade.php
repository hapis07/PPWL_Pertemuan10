```blade
@extends('layout.master')

@section('title', 'Data Buku')
@section('heading', 'Data Buku')

@section('content')

<div class="row">
    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-body px-4 py-4">
                <div class="d-flex align-items-center">
                    <div class="stats-icon purple mb-2">
                        <i class="bi bi-book"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="text-muted font-semibold">
                            Total Buku
                        </h6>
                        <h6 class="font-extrabold mb-0">
                            {{ $total_buku }} Buku
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-body px-4 py-4">
                <div class="d-flex align-items-center">
                    <div class="stats-icon green mb-2">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="text-muted font-semibold">
                            Total Harga Semua Buku
                        </h6>
                        <h6 class="font-extrabold mb-0">
                            Rp {{ number_format($total_harga, 0, ',', '.') }}
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Daftar Buku --}}
<div class="card">
    <div class="card-header">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
            <h4 class="card-title mb-0">Daftar Buku</h4>

            <a href="{{ route('buku.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i>
                Tambah Buku
            </a>
        </div>
    </div>

    <div class="card-body">

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show"
                 role="alert">
                {{ session('success') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Tutup"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Terjadi kesalahan:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Pencarian --}}
        <form action="{{ route('buku.search') }}"
              method="GET"
              class="row g-2 mb-4">

            <div class="col-12 col-md-6 col-lg-5">
                <input type="text"
                       id="cari"
                       name="cari"
                       value="{{ request('cari') }}"
                       class="form-control"
                       placeholder="Cari judul atau penulis...">
            </div>

            <div class="col-auto">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search me-1"></i>
                    Cari
                </button>
            </div>

            <div class="col-auto">
                <a href="{{ route('buku.index') }}"
                   class="btn btn-light-secondary">
                    Reset
                </a>
            </div>
        </form>

        {{-- Tabel --}}
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Judul Buku</th>
                        <th>Cover Buku</th>
                        <th>Penulis</th>
                        <th>Harga</th>
                        <th>Tanggal Terbit</th>
                        <th style="min-width: 150px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($data_buku as $buku)
                        <tr>
                            <td>{{ $no + $loop->iteration }}</td>

                            <td class="text-bold-500">
                                {{ $buku->judul }}
                            </td>
                            
                            <td>
                                @if ($buku->cover)
                                    <img src="{{asset('storage/' . $buku->cover)}}"
                                        width ="80"
                                        height="100"
                                        style="object-fit:cover"
                                        alt="Cover {{ $buku->judul }}">
                                @else
                                    <span class ="text-muted">Belum ada cover</span>
                                @endif
                            </td>

                            <td>{{ $buku->penulis }}</td>

                            <td>
                                Rp {{ number_format($buku->harga, 0, ',', '.') }}
                            </td>

                            <td>
                                {{ $buku->tgl_terbit->format('d/m/Y') }}
                            </td>

                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('buku.edit', $buku->id) }}"
                                       class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                        Edit
                                    </a>

                                    <form action="{{ route('buku.destroy', $buku->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                Belum ada data buku.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="d-flex flex-wrap justify-content-between align-items-center mt-4 gap-2">
            <div>
                {{ $data_buku->links() }}
            </div>

            <span class="text-muted">
                Total data buku: {{ $total_buku }}
            </span>
        </div>
    </div>
</div>

@endsection
```