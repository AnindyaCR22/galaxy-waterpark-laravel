@extends('layouts.master')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-warning text-dark py-3">
                <h4 class="mb-0 fw-bold">Edit Lowongan Pekerjaan</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('jobs.update', $job->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Judul Posisi Lowongan</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $job->title) }}" required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold">Perusahaan / Divisi</label>
                            <input type="text" name="company" class="form-control @error('company') is-invalid @enderror" value="{{ old('company', $job->company) }}" required>
                            @error('company') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold">Lokasi Kerja</label>
                            <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', $job->location) }}" required>
                            @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold">Gaji (Nominal Rp)</label>
                            <input type="number" name="salary" class="form-control @error('salary') is-invalid @enderror" value="{{ old('salary', $job->salary) }}">
                            @error('salary') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold">Jenis Pekerjaan</label>
                            <select name="jenis_pekerjaan" class="form-select @error('jenis_pekerjaan') is-invalid @enderror" required>
                                <option value="Full-time" {{ old('jenis_pekerjaan', $job->jenis_pekerjaan) == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                <option value="Part-time" {{ old('jenis_pekerjaan', $job->jenis_pekerjaan) == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                <option value="Kontrak" {{ old('jenis_pekerjaan', $job->jenis_pekerjaan) == 'Kontrak' ? 'selected' : '' }}>Kontrak</option>
                                <option value="Magang" {{ old('jenis_pekerjaan', $job->jenis_pekerjaan) == 'Magang' ? 'selected' : '' }}>Magang</option>
                            </select>
                            @error('jenis_pekerjaan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Deskripsi & Kualifikasi Pekerjaan</label>
                        <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $job->description) }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label font-weight-bold">Ganti Logo / Gambar <small class="text-muted">(Kosongkan jika tidak diubah)</small></label>
                        @if($job->logo)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $job->logo) }}" alt="Logo Saat Ini" class="img-thumbnail rounded" style="width: 80px; height: 80px; object-fit: cover;">
                            </div>
                        @endif
                        <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" accept="image/*">
                        @error('logo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="btn btn-warning px-4">Update Lowongan</button>
                    <a href="{{ route('jobs.index') }}" class="btn btn-secondary px-4">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection