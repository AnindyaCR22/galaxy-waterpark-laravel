@extends('layouts.master')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="fw-bold text-primary mb-0">Kelola Data Users</h3>
    <a href="{{ route('users.create') }}" class="btn btn-primary">+ Tambah User Baru</a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-primary text-center">
            <tr>
                <th width="50">No</th>
                <th width="80">Foto</th>
                <th>Nama</th>
                <th>Email</th>
                <th width="120">Level</th>
                <th width="180">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $index => $user)
                <tr>
                    <td class="text-center">{{ $users->firstItem() + $index }}</td>
                    <!-- Menampilkan Gambar Foto Profil dari Storage Public -->
                    <td class="text-center">
                        @if($user->photo)
                            <img src="{{ asset('storage/' . $user->photo) }}" alt="Foto {{ $user->name }}" class="rounded-circle shadow-sm" style="width: 50px; height: 50px; object-fit: cover;">
                        @else
                            <span class="badge bg-light text-secondary border">No Image</span>
                        @endif
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="text-center">
                        @if($user->level == 'admin')
                            <span class="badge bg-danger">ADMIN</span>
                        @else
                            <span class="badge bg-secondary">USER</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini beserta fotonya?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada data user.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-end">
    {{ $users->links() }}
</div>
@endsection