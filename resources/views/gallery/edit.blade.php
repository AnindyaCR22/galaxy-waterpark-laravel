@extends('layouts.master')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-warning fw-bold">Edit Foto Galeri Wahana</div>
            <div class="card-body p-4">
                <form action="{{ route('gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-bold">Judul Foto / Wahana</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title', $gallery->title) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Deskripsi</label>
                        <textarea class="form-control" rows="4" name="description" required>{{ old('description', $gallery->description) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold d-block">Foto Saat Ini</label>
                        <img src="{{ asset('storage/posts_image/' . $gallery->picture) }}" width="150" class="rounded border mb-2">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Ganti Gambar (Opsional)</label>
                        <input type="file" class="form-control" name="picture" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-primary px-4">Update</button>
                    <a href="{{ route('gallery.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection