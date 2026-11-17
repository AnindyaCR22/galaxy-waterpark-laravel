@extends('layouts.master')

@section('content')
<section id="album" class="py-2">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="fw-bold text-primary mb-0">Galeri Wahana: {{ $tiket->nama }}</h3>
            <small class="text-muted">Slug URL: <code>/detail-tiket/{{ $tiket->tiket_seo }}</code></small>
        </div>
        <a href="{{ route('tiket.katalog') }}" class="btn btn-secondary btn-sm">Kembali ke Katalog</a>
    </div>
    <hr>
    <div class="row">
        @forelse($galeris as $data)
            <div class="col-md-4 mb-4 text-center">
                <div class="card border-0 shadow-sm h-100 p-2">
                    <a href="{{ asset('storage/galeri_tiket/' . $data->foto) }}" 
                       data-lightbox="image-1" 
                       data-title="{{ $data->keterangan }}">
                        <img src="{{ asset('storage/galeri_tiket/' . $data->foto) }}" 
                             class="img-fluid rounded" 
                             style="width: 100%; height: 180px; object-fit: cover;">
                    </a>
                    <div class="card-body pb-1">
                        <h6 class="fw-bold mb-1">{{ $data->nama_galeri }}</h6>
                        <small class="text-muted">{{ $data->keterangan }}</small>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-4">
                <p class="text-muted">Belum ada foto galeri untuk paket tiket ini.</p>
            </div>
        @endforelse
    </div>
    <div class="d-flex justify-content-center mt-3">
        {{ $galeris->links('pagination::bootstrap-5') }}
    </div>
</section>
@endsection