@extends('layouts.master')

@section('content')
    <h4 class="mb-3">Edit Tiket Galaxy Waterpark</h4>

    @if (count($errors) > 0)
        <ul class="alert alert-danger ps-4">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('tiket.update', $tiket->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Tiket</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $tiket->nama) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="kategori" class="form-select">
                <option value="Reguler" {{ $tiket->kategori == 'Reguler' ? 'selected' : '' }}>Reguler</option>
                <option value="Anak-anak" {{ $tiket->kategori == 'Anak-anak' ? 'selected' : '' }}>Anak-anak</option>
                <option value="Rombongan" {{ $tiket->kategori == 'Rombongan' ? 'selected' : '' }}>Rombongan</option>
                <option value="VIP" {{ $tiket->kategori == 'VIP' ? 'selected' : '' }}>VIP</option>
                <option value="Promo" {{ $tiket->kategori == 'Promo' ? 'selected' : '' }}>Promo</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga (Rp)</label>
            <input type="text" name="harga" class="form-control" value="{{ old('harga', $tiket->harga) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Berlaku</label>
            <input type="text" id="tgl_berlaku" name="tgl_berlaku" class="date form-control" placeholder="yyyy-mm-dd" value="{{ old('tgl_berlaku', $tiket->tgl_berlaku ? $tiket->tgl_berlaku->format('Y-m-d') : '') }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Tiket</button>
        <a href="{{ route('tiket.index') }}" class="btn btn-secondary ms-2">Kembali</a>
    </form>
@endsection