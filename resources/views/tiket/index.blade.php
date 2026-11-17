@extends('layouts.master')

@section('content')

    <!-- Flash Message Notifikasi Success (Bab VI) -->
    @if(Session::has('pesan'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('pesan') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Tiket Galaxy Waterpark</h2>
        <div>
            <a href="{{ route('tiket.katalog') }}" class="btn btn-outline-primary me-2">Lihat Tampilan Katalog</a>
            <a href="{{ route('tiket.create') }}" class="btn btn-primary">Tambah Tiket</a>
        </div>
    </div>

    <!-- Form Search Box (Bab VI) -->
    <form action="{{ route('tiket.search') }}" method="GET" class="mb-3">
        <div class="input-group" style="width: 350px; float: right;">
            <input type="text" name="kata" class="form-control" placeholder="Cari nama / kategori tiket..." value="{{ request('kata') }}">
            <button class="btn btn-outline-secondary" type="submit">Cari</button>
        </div>
        <div style="clear: both;"></div>
    </form>

    <!-- Tabel Tiket -->
    <table class="table table-striped table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Tiket</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Tgl. Berlaku</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data_tiket as $tiket)
                <tr>
                    <td>{{ ++$no }}</td>
                    <td>{{ $tiket->nama }}</td>
                    <td><span class="badge bg-info text-dark">{{ $tiket->kategori }}</span></td>
                    
                    <!-- Format Rupiah dengan number_format (Bab VI) -->
                    <td>Rp {{ number_format($tiket->harga, 0, ',', '.') }}</td>
                    
                    <!-- Format Tanggal Carbon d/m/Y (Bab VI) -->
                    <td>{{ $tiket->tgl_berlaku ? $tiket->tgl_berlaku->format('d/m/Y') : '-' }}</td>
                    
                    <td>
                        <a href="{{ route('galeri.tiket', $tiket->tiket_seo ?: \Illuminate\Support\Str::slug($tiket->nama)) }}" class="btn btn-info btn-sm text-white">Detail</a>
                        <a href="{{ route('tiket.edit', $tiket->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        
                        <form action="{{ route('tiket.destroy', $tiket->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin mau dihapus?')" type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-danger">Data tiket belum ada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Component Pagination Links & Total Data (Bab VI) -->
    <div class="d-flex justify-content-between align-items-center mt-3">
        <div><strong>Jumlah Tiket: {{ $jumlah_tiket }}</strong></div>
        <div>{{ $data_tiket->links('pagination::bootstrap-5') }}</div>
    </div>

@endsection