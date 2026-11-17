@extends('layouts.master')

@section('content')
    <h4 class="mb-3">Tambah Tiket Baru</h4>

    <!-- Tampilkan List Error Validasi jika ada kesalahan input (Bab VI) -->
    @if (count($errors) > 0)
        <ul class="alert alert-danger ps-4">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('tiket.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Tiket</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="kategori" class="form-select">
                <option value="">-- Pilih Kategori --</option>
                <option value="Reguler">Reguler</option>
                <option value="Anak-anak">Anak-anak</option>
                <option value="Rombongan">Rombongan</option>
                <option value="VIP">VIP</option>
                <option value="Promo">Promo</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga (Rp)</label>
            <input type="text" name="harga" class="form-control" value="{{ old('harga') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Berlaku</label>
            <!-- Menggunakan class 'date' untuk memicu Datepicker (Bab VI) -->
            <input type="text" id="tgl_berlaku" name="tgl_berlaku" class="date form-control" placeholder="yyyy-mm-dd" value="{{ old('tgl_berlaku') }}">
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('tiket.index') }}" class="btn btn-secondary ms-2">Kembali</a>
    </form>
@endsection