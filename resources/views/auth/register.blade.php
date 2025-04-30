@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@section('auth_header')
    <h1>Register Pasien</h1>
@endsection

@section('auth_body')
    <form action="{{ route('register') }}" method="post">
        @csrf

        <!-- Nama -->
        <div class="form-group mb-3">
            <label for="nama">Nama</label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Masukkan Nama">
            @error('nama')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Alamat -->
        <div class="form-group mb-3">
            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}" placeholder="Masukkan Alamat">
            @error('address')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- No HP -->
        <div class="form-group mb-3">
            <label for="no_hp">No HP</label>
            <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" placeholder="Masukkan No HP">
            @error('no_hp')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email -->
        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Masukkan Email">
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group mb-3">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password">
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Konfirmasi Password -->
        <div class="form-group mb-3">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password">
        </div>

        <!-- Submit Button -->
        <div class="form-group mb-0">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </div>
    </form>
@endsection

@section('auth_footer')
    <p class="mb-0">
        Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
    </p>
@endsection