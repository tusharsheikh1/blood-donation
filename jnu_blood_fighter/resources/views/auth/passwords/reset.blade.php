@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-danger bg-gradient text-white text-center rounded-top-4 py-3">
                    <h3 class="mb-0 fw-bold"><i class="bi bi-shield-lock-fill me-2"></i> Create New Password</h3>
                    <p class="mb-0 small opacity-75">Enter your new password below</p>
                </div>
                <div class="card-body p-4 p-md-5">
                    
                    {{-- Error Messages --}}
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                            <strong><i class="bi bi-exclamation-triangle-fill"></i> Reset Failed!</strong>
                            <p class="mb-2 mt-1">Please fix the following errors:</p>
                            <ul class="mb-0 small">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="mb-4">
                        <div class="alert alert-info rounded-3">
                            <i class="bi bi-info-circle-fill"></i> Please enter your new password. Make sure it's at least 6 characters long.
                        </div>
                    </div>

                    <form method="POST" action="{{ route('donor.password.update') }}" id="resetForm">
                        @csrf
                        
                        <input type="hidden" name="token" value="{{ $token }}">
                        
                        {{-- Email Field --}}
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
                                    value="{{ $email ?? old('email') }}" 
                                    required 
                                    autofocus
                                    readonly
                                    placeholder="name@example.com"
                                >
                                @error('email')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- Password Field --}}
                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold text-muted">New Password <span class="text-danger">*</span></label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3">
                                    <i class="bi bi-lock-fill text-danger"></i>
                                </span>
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    class="form-control border-start-0 border-end-0 @error('password') is-invalid @enderror" 
                                    required
                                    minlength="6"
                                    placeholder="Enter new password"
                                >
                                <button 
                                    class="btn btn-outline-secondary border-start-0 rounded-end-3" 
                                    type="button" 
                                    id="togglePassword"
                                    onclick="togglePasswordVisibility('password', 'togglePassword')"
                                >
                                    <i class="bi bi-eye" id="togglePasswordIcon"></i>
                                </button>
                                @error('password')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <small class="form-text text-muted">Minimum 6 characters</small>
                        </div>

                        {{-- Confirm Password Field --}}
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-bold text-muted">Confirm New Password <span class="text-danger">*</span></label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3">
                                    <i class="bi bi-lock-fill text-danger"></i>
                                </span>
                                <input 
                                    type="password" 
                                    id="password_confirmation" 
                                    name="password_confirmation" 
                                    class="form-control border-start-0 border-end-0 rounded-3" 
                                    required
                                    minlength="6"
                                    placeholder="Re-enter new password"
                                >
                                <button 
                                    class="btn btn-outline-secondary border-start-0 rounded-end-3" 
                                    type="button" 
                                    id="togglePasswordConfirm"
                                    onclick="togglePasswordVisibility('password_confirmation', 'togglePasswordConfirm')"
                                >
                                    <i class="bi bi-eye" id="togglePasswordConfirmIcon"></i>
                                </button>
                            </div>
                            <small class="form-text text-muted">Must match the password above</small>
                            <div id="passwordMatchError" class="invalid-feedback d-none">
                                <i class="bi bi-exclamation-circle"></i> Passwords do not match
                            </div>
                        </div>

                        {{-- Password Strength Indicator --}}
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <small class="text-muted fw-bold">Password Strength:</small>
                                <small id="strengthText" class="text-muted">Not set</small>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div id="strengthBar" class="progress-bar" role="progressbar" style="width: 0%"></div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-danger btn-lg w-100 fw-bold rounded-3 mb-3" id="submitBtn">
                            <span id="submitBtnText"><i class="bi bi-check-circle-fill me-1"></i> Reset Password</span>
                        </button>

                        <div class="text-center">
                            <a href="{{ route('donor.login') }}" class="text-decoration-none text-muted">
                                <i class="bi bi-arrow-left"></i> Back to Login
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Toggle password visibility
function togglePasswordVisibility(inputId, buttonId) {
    const input = document.getElementById(inputId);
    const icon = document.querySelector(`#${buttonId} i`);
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.getElementById('password');
    const passwordConfirmInput = document.getElementById('password_confirmation');
    const strengthBar = document.getElementById('strengthBar');
    const strengthText = document.getElementById('strengthText');
    const submitBtn = document.getElementById('submitBtn');
    const submitBtnText = document.getElementById('submitBtnText'); // New element
    const resetForm = document.getElementById('resetForm');
    const passwordMatchError = document.getElementById('passwordMatchError');

    // Password strength checker
    passwordInput.addEventListener('input', function() {
        const password = this.value;
        let strength = 0;
        let strengthLabel = '';
        let strengthColor = '';

        if (password.length === 0) {
            strengthBar.style.width = '0%';
            strengthText.textContent = 'Not set';
            strengthBar.className = 'progress-bar';
            return;
        }

        // Length check
        if (password.length >= 6) strength += 25;
        if (password.length >= 10) strength += 15;

        // Contains lowercase
        if (/[a-z]/.test(password)) strength += 15;

        // Contains uppercase
        if (/[A-Z]/.test(password)) strength += 15;

        // Contains numbers
        if (/\d/.test(password)) strength += 15;

        // Contains special characters
        if (/[^a-zA-Z0-9]/.test(password)) strength += 15;

        // Set strength label and color
        if (strength <= 25) {
            strengthLabel = 'Weak';
            strengthColor = 'bg-danger';
        } else if (strength <= 50) {
            strengthLabel = 'Fair';
            strengthColor = 'bg-warning';
        } else if (strength <= 75) {
            strengthLabel = 'Good';
            strengthColor = 'bg-info';
        } else {
            strengthLabel = 'Strong';
            strengthColor = 'bg-success';
        }

        strengthBar.style.width = strength + '%';
        strengthText.textContent = strengthLabel;
        strengthBar.className = 'progress-bar ' + strengthColor;
    });

    // Password match validation
    function checkPasswordMatch() {
        if (passwordConfirmInput.value.length > 0) {
            if (passwordInput.value !== passwordConfirmInput.value) {
                passwordConfirmInput.classList.add('is-invalid');
                passwordMatchError.classList.remove('d-none');
                return false;
            } else {
                passwordConfirmInput.classList.remove('is-invalid');
                passwordMatchError.classList.add('d-none');
                return true;
            }
        }
        return true;
    }

    passwordConfirmInput.addEventListener('input', checkPasswordMatch);
    passwordInput.addEventListener('input', checkPasswordMatch);

    // Form submission
    resetForm.addEventListener('submit', function(e) {
        let isValid = true;

        // Check password match
        if (!checkPasswordMatch()) {
            isValid = false;
        }

        // Check minimum length
        if (passwordInput.value.length < 6) {
            isValid = false;
            // Only add is-invalid if it's not already set by Laravel validation on error
            if (!passwordInput.classList.contains('is-invalid')) {
                passwordInput.classList.add('is-invalid');
            }
        }

        if (!isValid) {
            e.preventDefault();
            // This is generally not needed with Bootstrap's built-in validation feedback
            // resetForm.classList.add('was-validated'); 
            return false;
        }

        // Disable submit button and show spinner
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Resetting Password...';
    });
});
</script>
@endpush
@endsection