@extends('layouts.app')

@section('title', 'Donor Login')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            {{-- Modern Card Style: Larger shadow, soft rounded corners, light header --}}
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-danger bg-gradient text-white text-center rounded-top-4 py-3">
                    <h3 class="mb-0 fw-bold"><i class="bi bi-person-circle me-2"></i> Donor Login</h3>
                </div>
                <div class="card-body p-4 p-md-5">
                    
                    {{-- Alert Styling --}}
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('status'))
                        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                            <i class="bi bi-check-circle-fill"></i> {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('donor.login') }}">
                        @csrf
                        
                        {{-- Modern Input: Using a form-floating pattern if supported, otherwise just cleaner spacing --}}
                        <div class="mb-4">
                            <label for="emailInput" class="form-label fw-bold text-muted">Email</label>
                            <input type="email" name="email" id="emailInput" class="form-control form-control-lg @error('email') is-invalid @enderror rounded-3" value="{{ old('email') }}" required autofocus placeholder="name@example.com">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="passwordInput" class="form-label fw-bold text-muted">Password</label>
                            <input type="password" name="password" id="passwordInput" class="form-control form-control-lg @error('password') is-invalid @enderror rounded-3" required placeholder="Enter your password">
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label text-muted" for="remember">
                                    Remember Me
                                </label>
                            </div>
                            <a href="{{ route('donor.password.request') }}" class="text-danger text-decoration-none fw-bold small">
                                Forgot Password?
                            </a>
                        </div>

                        {{-- Button style: Larger, bolder, with rounded corners --}}
                        <button type="submit" class="btn btn-danger btn-lg w-100 fw-bold rounded-3">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Log In
                        </button>
                    </form>

                    <div class="text-center mt-4">
                        <p class="mb-0 text-muted">Don't have an account? <a href="{{ route('donor.register') }}" class="text-danger fw-bold text-decoration-none">Register here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection