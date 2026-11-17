@extends('layouts.master')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-primary mb-1">Daftar Lowongan Kerja</h3>
        <p class="text-muted mb-0">Kelola rekrutmen staf dan operasional Galaxy Waterpark</p>
    </div>
    <a href="{{ route('jobs.create') }}" class="btn btn-primary shadow-sm">+ Tambah Lowongan</a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Layout Card Grid Bootstrap -->
<div class="row">
    @forelse($jobs as $job)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm border-0 rounded-3">
                <div class="card-body p-4 d-flex flex-column">
                    <div class="d-flex align-items-center mb-3">
                        @if($job->logo)
                            <img src="{{ asset('storage/' . $job->logo) }}" alt="Logo {{ $job->company }}" class="rounded me-3 border" style="width: 55px; height: 55px; object-fit: cover;">
                        @else
                            <div class="rounded me-3 bg-primary text-white d-flex align-items-center justify-content-center font-weight-bold" style="width: 55px; height: 55px; font-size: 18px;">
                                GW
                            </div>
                        @endif
                        <div>
                            <h5 class="card-title fw-bold text-dark mb-0">{{ $job->title }}</h5>
                            <small class="text-primary font-weight-semibold">{{ $job->company }}</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <span class="badge bg-primary me-1">{{ $job->jenis_pekerjaan }}</span>
                        <span class="badge bg-light text-dark border">{{ $job->location }}</span>
                    </div>

                    <p class="card-text text-secondary small flex-grow-1">
                        {{ Str::limit($job->description, 110) }}
                    </p>

                    <div class="pt-3 border-top mt-2 d-flex justify-content-between align-items-center">
                        <span class="fw-bold text-success">
                            {{ $job->salary ? 'Rp ' . number_format($job->salary, 0, ',', '.') : 'Gaji Kompetitif' }}
                        </span>
                        <div>
                            <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus lowongan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="card border-0 shadow-sm p-5 text-center">
                <p class="text-muted mb-0">Belum ada lowongan kerja yang dibuka untuk Galaxy Waterpark.</p>
            </div>
        </div>
    @endforelse
</div>
@endsection