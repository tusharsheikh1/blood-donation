@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-danger bg-gradient text-white text-center rounded-top-4 py-3">
                    <h3 class="mb-0 fw-bold"><i class="bi bi-key-fill me-2"></i> Reset Password</h3>
                    <p class="mb-0 small opacity-75">Enter your email to receive a password reset link</p>
                </div>
                <div class="card-body p-4 p-md-5">
                    
                    {{-- Success Message --}}
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                            <strong><i class="bi bi-check-circle-fill"></i> Email Sent!</strong>
                            <p class="mb-0 mt-1">{{ session('status') }}</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Error Messages --}}
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                            <strong><i class="bi bi-exclamation-triangle-fill"></i> Error!</strong>
                            <ul class="mb-0 mt-1 small">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="mb-4">
                        <p class="text-muted">
                            <i class="bi bi-info-circle"></i> Don't worry! Enter your registered email address below and we'll send you a link to reset your password.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('donor.password.email') }}">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="emailInput" class="form-label fw-bold text-muted">Email Address</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3">
                                    <i class="bi bi-envelope-fill text-danger"></i>
                                </span>
                                <input 
                                    type="email" 
                                    name="email" 
                                    id="emailInput" 
                                    class="form-control border-start-0 @error('email') is-invalid @enderror rounded-end-3" 
                                    value="{{ old('email') }}" 
                                    required 
                                    autofocus 
                                    placeholder="name@example.com"
                                >
                                @error('email')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <small class="form-text text-muted">The email address you used to register</small>
                        </div>

                        <button type="submit" class="btn btn-danger btn-lg w-100 fw-bold rounded-3 mb-3">
                            <i class="bi bi-envelope-check-fill me-1"></i> Send Password Reset Link
                        </button>

                        <div class="text-center">
                            <a href="{{ route('donor.login') }}" class="text-decoration-none text-muted">
                                <i class="bi bi-arrow-left"></i> Back to Login
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Additional Help Section --}}
            <div class="card shadow-sm border-0 rounded-4 mt-3">
                <div class="card-body p-3">
                    <h6 class="text-danger mb-2"><i class="bi bi-question-circle"></i> Need Help?</h6>
                    <p class="small text-muted mb-0">
                        If you don't receive the email within a few minutes, please check your spam folder. 
                        Still having trouble? Contact our support team.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection