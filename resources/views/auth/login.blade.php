@extends('layouts.master')

@section('content')
<div class="row justify-content-center my-5">
    <div class="col-md-5">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-primary text-white text-center py-3">
                <h4 class="mb-0 fw-bold">Login Admin Galaxy Waterpark</h4>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Alamat Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Kata Sandi</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                        @error('password')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">Masuk ke Sistem</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection