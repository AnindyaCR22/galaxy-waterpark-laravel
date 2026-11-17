@extends('layouts.master')

@section('content')
<h3 class="fw-bold text-primary mb-4">Tambah User Baru</h3>

<!-- Tambahkan enctype="multipart/form-data" agar form dapat mengirimkan file foto -->
<form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div class="mb-3">
        <label class="form-label">Nama Lengkap</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Alamat Email</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Kata Sandi</label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Level Hak Akses</label>
        <select name="level" class="form-select @error('level') is-invalid @enderror" required>
            <option value="user" {{ old('level') == 'user' ? 'selected' : '' }}>User Biasa</option>
            <option value="admin" {{ old('level') == 'admin' ? 'selected' : '' }}>Administrator</option>
        </select>
        @error('level') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <!-- Input Berkas Foto Profil -->
    <div class="mb-4">
        <label class="form-label">Foto Profil</label>
        <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/*">
        @error('photo') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn btn-primary">Simpan User</button>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection