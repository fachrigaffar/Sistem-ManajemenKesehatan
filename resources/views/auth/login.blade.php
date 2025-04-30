@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('auth_header')
    <h1>Login</h1>
@endsection

@section('auth_body')
    <form action="{{ route('login') }}" method="post">
        @csrf

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

        <!-- Remember Me -->
        <div class="form-group mb-3">
            <div class="form-check">
                <input type="checkbox" name="remember" id="remember" class="form-check-input">
                <label for="remember" class="form-check-label">Ingat Saya</label>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="form

-group mb-0">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </div>
    </form>
@endsection

@section('auth_footer')
    <p class="mb-1">
        <a href="{{ route('password.request') }}">Lupa Password?</a>
    </p>
    <p class="mb-0">
        Belum punya akun? <a href="{{ route('register') }}">Register di sini</a>
    </p>
@endsection