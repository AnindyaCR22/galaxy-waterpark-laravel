@extends('layouts.master')

@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col-md-12">
            <div class="p-5 mb-4 bg-light rounded-3 border">
                <div class="container-fluid py-3">
                    <h1 class="display-5 fw-bold text-primary">Selamat Datang, {{ Auth::user()->name }}!</h1>
                    <p class="col-md-8 fs-4">Anda telah masuk ke Sistem Informasi Pengelolaan Tiket Wisata Galaxy Waterpark.</p>
                    
                    <!-- Tombol Kelola Tiket (Khusus Admin) -->
                    @if(Auth::user()->level == 'admin')
                        <a href="{{ route('tiket.index') }}" class="btn btn-primary btn-lg mt-2 me-2">Kelola Data Tiket</a>
                    @endif
                    
                    <!-- Tombol Logout -->
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-lg mt-2">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection