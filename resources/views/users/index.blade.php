@extends('layouts.master')

@section('title', 'Data User')
@section('heading', 'Data User')

@section('content')

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="card-title">Daftar User</h4>

            <a href="{{ route('users.create') }}"
               class="btn btn-primary">
                <i class="bi bi-plus-circle"></i>
                Tambah User
            </a>
        </div>
    </div>

    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $users->firstItem() + $loop->index }}</td>

                            <td>{{ $user->name }}</td>

                            <td>{{ $user->email }}</td>

                            <td>
                                @if ($user->level == 'admin')
                                    <span class="badge bg-primary">
                                        Admin
                                    </span>
                                @else
                                    <span class="badge bg-secondary">
                                        User
                                    </span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('users.edit', $user->id) }}"
                                   class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i>
                                    Edit
                                </a>

                                <form action="{{ route('users.destroy', $user->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus user ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                Belum ada data user.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $users->links() }}
        </div>

    </div>
</div>

@endsection