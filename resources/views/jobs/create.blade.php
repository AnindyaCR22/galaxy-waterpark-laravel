@extends('layouts.master')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-primary text-white py-3">
                <h4 class="mb-0 fw-bold">Tambah Lowongan Kerja Baru</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Judul Posisi Lowongan</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Contoh: Lifeguard / Staf Kasir Tiket / Operator Wahana" required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold">Perusahaan / Divisi</label>
                            <input type="text" name="company" class="form-control @error('company') is-invalid @enderror" value="{{ old('company', 'Galaxy Waterpark Jogja') }}" required>
                            @error('company') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold">Lokasi Kerja</label>
                            <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', 'Bantul, Yogyakarta') }}" required>
                            @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold">Gaji (Nominal Rp)</label>
                            <input type="number" name="salary" class="form-control @error('salary') is-invalid @enderror" value="{{ old('salary') }}" placeholder="Contoh: 2500000">
                            @error('salary') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold">Jenis Pekerjaan</label>
                            <select name="jenis_pekerjaan" class="form-select @error('jenis_pekerjaan') is-invalid @enderror" required>
                                <option value="Full-time" {{ old('jenis_pekerjaan') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                <option value="Part-time" {{ old('jenis_pekerjaan') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                <option value="Kontrak" {{ old('jenis_pekerjaan') == 'Kontrak' ? 'selected' : '' }}>Kontrak</option>
                                <option value="Magang" {{ old('jenis_pekerjaan') == 'Magang' ? 'selected' : '' }}>Magang</option>
                            </select>
                            @error('jenis_pekerjaan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Deskripsi & Kualifikasi Pekerjaan</label>
                        <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror" placeholder="Tuliskan syarat usia, sertifikasi renang, atau pengalaman kerja..." required>{{ old('description') }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label font-weight-bold">Upload Logo / Banner Divisi</label>
                        <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" accept="image/*">
                        @error('logo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary px-4">Simpan Lowongan</button>
                    <a href="{{ route('jobs.index') }}" class="btn btn-secondary px-4">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection