@extends('layouts.master')

@section('content')
<div class="mb-4">
    <h3 class="fw-bold text-primary">Katalog Tiket & Wahana Galaxy Waterpark</h3>
    <p class="text-muted">Pilih paket tiket untuk melihat galeri foto wahana terkait (SEO Friendly URL)</p>
</div>

<div class="row">
    @foreach($tikets as $tiket)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <img src="{{ $tiket->foto ? asset('storage/tiket/' . $tiket->foto) : asset('images/logoGalaxyWaterpark.jpg') }}" 
                     class="card-img-top" style="height: 180px; object-fit: cover;" alt="{{ $tiket->nama }}">
                <div class="card-body d-flex flex-column">
                    <span class="badge bg-info text-dark align-self-start mb-2">{{ $tiket->kategori }}</span>
                    <h5 class="card-title fw-bold">{{ $tiket->nama }}</h5>
                    <p class="text-success fw-bold mb-3">Rp {{ number_format($tiket->harga, 0, ',', '.') }}</p>
                    <a href="{{ route('galeri.tiket', $tiket->tiket_seo ?: \Illuminate\Support\Str::slug($tiket->nama)) }}" class="btn btn-outline-primary mt-auto">
                        Lihat Galeri Wahana
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection