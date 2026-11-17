@extends('layouts.master')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-primary mb-1">Galeri Wahana Galaxy Waterpark</h3>
        <p class="text-muted mb-0">Klik gambar untuk memperbesar pratinjau (Lightbox)</p>
    </div>
    @if(Auth::user()->level == 'admin')
        <a href="{{ route('gallery.create') }}" class="btn btn-primary shadow-sm">+ Tambah Foto</a>
    @endif
</div>

<div class="row">
    @forelse($galleries as $gallery)
        <div class="col-md-4 col-lg-3 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <a href="{{ asset('storage/posts_image/' . $gallery->picture) }}" 
                   data-lightbox="galaxy-gallery" 
                   data-title="{{ $gallery->title }} - {{ $gallery->description }}">
                    <img src="{{ asset('storage/posts_image/' . $gallery->picture) }}" 
                         class="card-img-top" 
                         alt="{{ $gallery->title }}" 
                         style="height: 180px; object-fit: cover;">
                </a>
                <div class="card-body d-flex flex-column">
                    <h6 class="fw-bold mb-1">{{ $gallery->title }}</h6>
                    <p class="text-muted small flex-grow-1">{{ Str::limit($gallery->description, 70) }}</p>
                    @if(Auth::user()->level == 'admin')
                        <div class="d-flex gap-2 mt-2 pt-2 border-top">
                            <a href="{{ route('gallery.edit', $gallery->id) }}" class="btn btn-warning btn-sm w-50">Edit</a>
                            <form action="{{ route('gallery.destroy', $gallery->id) }}" method="POST" class="w-50" onsubmit="return confirm('Hapus foto ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm w-100">Hapus</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <h5 class="text-muted">Belum ada foto galeri yang diunggah.</h5>
        </div>
    @endforelse
</div>

<div class="d-flex justify-content-center mt-3">
    {{ $galleries->links() }}
</div>
@endsection