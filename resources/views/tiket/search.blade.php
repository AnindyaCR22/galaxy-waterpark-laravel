@extends('layouts.master')

@section('content')

    <h2>Hasil Pencarian Tiket</h2>

    <!-- Kondisi jika data ditemukan (Bab VI) -->
    @if(count($data_tiket))
        <div class="alert alert-success mb-3">
            Ditemukan <strong>{{ $jumlah_tiket }}</strong> data dengan kata kunci: <strong>{{ $cari }}</strong>
        </div>

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
                @foreach ($data_tiket as $tiket)
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $tiket->nama }}</td>
                        <td><span class="badge bg-info text-dark">{{ $tiket->kategori }}</span></td>
                        <td>Rp {{ number_format($tiket->harga, 0, ',', '.') }}</td>
                        <td>{{ $tiket->tgl_berlaku ? $tiket->tgl_berlaku->format('d/m/Y') : '-' }}</td>
                        <td>
                            <a href="{{ route('tiket.edit', $tiket->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            
                            <form action="{{ route('tiket.destroy', $tiket->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin mau dihapus?')" type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <a href="{{ route('tiket.index') }}" class="btn btn-secondary">Kembali ke Semua Tiket</a>
            <div>{{ $data_tiket->appends(['kata' => $cari])->links('pagination::bootstrap-5') }}</div>
        </div>

    @else
        <!-- Kondisi jika data TIDAK ditemukan (Bab VI) -->
        <div class="alert alert-warning my-4">
            <h4>Data dengan kata "<strong>{{ $cari }}</strong>" tidak ditemukan</h4>
            <a href="{{ route('tiket.index') }}" class="btn btn-warning mt-2">Kembali</a>
        </div>
    @endif

@endsection