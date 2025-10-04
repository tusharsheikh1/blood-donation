@extends('layouts.app')

@section('title', 'Donor Registration')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-danger text-white text-center">
                    <h4 class="mb-0">Become a Blood Donor</h4>
                </div>
                <div class="card-body p-4">
                    {{-- Display validation errors --}}
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><i class="bi bi-exclamation-triangle-fill"></i> Registration Failed!</strong>
                            <p class="mb-2">Please fix the following errors:</p>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- Display session error (from controller) --}}
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><i class="bi bi-exclamation-circle-fill"></i> Error!</strong>
                            <p class="mb-0">{{ session('error') }}</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- Display success message --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><i class="bi bi-check-circle-fill"></i> Success!</strong>
                            <p class="mb-0">{{ session('success') }}</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('donor.register') }}" id="registerForm" novalidate>
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input 
                                    type="text" 
                                    id="name" 
                                    name="name" 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    value="{{ old('name') }}" 
                                    required
                                    maxlength="255"
                                    placeholder="Enter your full name"
                                >
                                @error('name')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @else
                                    <small class="form-text text-muted">Your complete legal name</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    class="form-control @error('email') is-invalid @enderror" 
                                    value="{{ old('email') }}" 
                                    required
                                    placeholder="example@email.com"
                                >
                                @error('email')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @else
                                    <small class="form-text text-muted">Used for login and notifications</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                <input 
                                    type="text" 
                                    id="phone" 
                                    name="phone" 
                                    class="form-control @error('phone') is-invalid @enderror" 
                                    value="{{ old('phone') }}" 
                                    placeholder="01XXXXXXXXX" 
                                    required
                                    maxlength="11"
                                    pattern="01[0-9]{9}"
                                >
                                @error('phone')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @else
                                    <small class="form-text text-muted">Format: 01XXXXXXXXX (11 digits starting with 01)</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="blood_type" class="form-label">Blood Type <span class="text-danger">*</span></label>
                                <select 
                                    id="blood_type" 
                                    name="blood_type" 
                                    class="form-select @error('blood_type') is-invalid @enderror" 
                                    required
                                >
                                    <option value="">-- Select Your Blood Type --</option>
                                    @foreach(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'] as $type)
                                        <option value="{{ $type }}" {{ old('blood_type') == $type ? 'selected' : '' }}>
                                            {{ $type }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('blood_type')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @else
                                    <small class="form-text text-muted">Your blood group type</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="division" class="form-label">Division <span class="text-danger">*</span></label>
                                <select 
                                    name="division" 
                                    id="division" 
                                    class="form-select @error('division') is-invalid @enderror" 
                                    required
                                >
                                    <option value="">-- Select Division --</option>
                                    @foreach($divisions as $division)
                                        <option value="{{ $division['en'] }}" {{ old('division') == $division['en'] ? 'selected' : '' }}>
                                            {{ $division['en'] }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('division')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="district" class="form-label">District <span class="text-danger">*</span></label>
                                <select 
                                    name="district" 
                                    id="district" 
                                    class="form-select @error('district') is-invalid @enderror" 
                                    required
                                >
                                    <option value="">-- Select District --</option>
                                </select>
                                @error('district')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @else
                                    <small class="form-text text-muted" id="district-hint">Select division first</small>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="upazila" class="form-label">Upazila <span class="text-danger">*</span></label>
                                <select 
                                    name="upazila" 
                                    id="upazila" 
                                    class="form-select @error('upazila') is-invalid @enderror" 
                                    required
                                >
                                    <option value="">-- Select Upazila --</option>
                                </select>
                                @error('upazila')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @else
                                    <small class="form-text text-muted" id="upazila-hint">Select district first</small>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                            <textarea 
                                id="address" 
                                name="address" 
                                class="form-control @error('address') is-invalid @enderror" 
                                rows="2" 
                                required
                                maxlength="500"
                                placeholder="House/Flat No, Road, Area"
                            >{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @else
                                <small class="form-text text-muted">Your detailed address (Max 500 characters)</small>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    class="form-control @error('password') is-invalid @enderror" 
                                    required
                                    minlength="6"
                                    placeholder="Enter password"
                                >
                                @error('password')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @else
                                    <small class="form-text text-muted">Minimum 6 characters</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                <input 
                                    type="password" 
                                    id="password_confirmation" 
                                    name="password_confirmation" 
                                    class="form-control" 
                                    required
                                    minlength="6"
                                    placeholder="Re-enter password"
                                >
                                <small class="form-text text-muted">Must match password</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    I agree to be contacted when blood is needed and my information is accurate
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-danger w-100" id="submitBtn">
                            <i class="bi bi-person-plus"></i> Register as Donor
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        <p class="mb-0">Already registered? <a href="{{ route('donor.login') }}">Login here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const divisionSelect = document.getElementById('division');
    const districtSelect = document.getElementById('district');
    const upazilaSelect = document.getElementById('upazila');
    const submitBtn = document.getElementById('submitBtn');
    const registerForm = document.getElementById('registerForm');

    // Store old values for error handling
    const oldDivision = '{{ old('division') }}';
    const oldDistrict = '{{ old('district') }}';
    const oldUpazila = '{{ old('upazila') }}';

    // Loading state helper
    function setLoading(element, isLoading, text = 'Loading...') {
        if (isLoading) {
            element.disabled = true;
            element.innerHTML = `<option value="">${text}</option>`;
        } else {
            element.disabled = false;
        }
    }

    // Show error message
    function showError(message) {
        const alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-danger alert-dismissible fade show';
        alertDiv.innerHTML = `
            <strong><i class="bi bi-exclamation-triangle-fill"></i> Error!</strong>
            <p class="mb-0">${message}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        document.querySelector('.card-body').insertBefore(alertDiv, registerForm);
        
        // Auto-remove after 5 seconds
        setTimeout(() => alertDiv.remove(), 5000);
    }

    // Division change handler
    divisionSelect.addEventListener('change', function() {
        const division = this.value;
        
        // Reset and clear dependent selects
        districtSelect.innerHTML = '<option value="">-- Select District --</option>';
        upazilaSelect.innerHTML = '<option value="">-- Select Upazila --</option>';
        
        if (division) {
            setLoading(districtSelect, true, 'Loading districts...');
            
            fetch(`/api/districts/${encodeURIComponent(division)}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (!Array.isArray(data) || data.length === 0) {
                        throw new Error('No districts found for this division');
                    }
                    
                    districtSelect.innerHTML = '<option value="">-- Select District --</option>';
                    data.forEach(district => {
                        const option = new Option(district, district, false, district === oldDistrict);
                        districtSelect.add(option);
                    });
                    setLoading(districtSelect, false);
                    
                    // If there's an old district value, trigger change to load upazilas
                    if (oldDistrict && divisionSelect.value === oldDivision) {
                        districtSelect.value = oldDistrict;
                        districtSelect.dispatchEvent(new Event('change'));
                    }
                })
                .catch(error => {
                    console.error('Error loading districts:', error);
                    districtSelect.innerHTML = '<option value="">-- Error loading districts --</option>';
                    setLoading(districtSelect, false);
                    showError(`Failed to load districts: ${error.message}. Please try again or refresh the page.`);
                });
        } else {
            setLoading(districtSelect, false);
        }
    });

    // District change handler
    districtSelect.addEventListener('change', function() {
        const district = this.value;
        
        // Reset upazila select
        upazilaSelect.innerHTML = '<option value="">-- Select Upazila --</option>';
        
        if (district) {
            setLoading(upazilaSelect, true, 'Loading upazilas...');
            
            fetch(`/api/upazilas/${encodeURIComponent(district)}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (!Array.isArray(data) || data.length === 0) {
                        throw new Error('No upazilas found for this district');
                    }
                    
                    upazilaSelect.innerHTML = '<option value="">-- Select Upazila --</option>';
                    data.forEach(upazila => {
                        const option = new Option(upazila, upazila, false, upazila === oldUpazila);
                        upazilaSelect.add(option);
                    });
                    setLoading(upazilaSelect, false);
                    
                    // If there's an old upazila value, select it
                    if (oldUpazila && districtSelect.value === oldDistrict) {
                        upazilaSelect.value = oldUpazila;
                    }
                })
                .catch(error => {
                    console.error('Error loading upazilas:', error);
                    upazilaSelect.innerHTML = '<option value="">-- Error loading upazilas --</option>';
                    setLoading(upazilaSelect, false);
                    showError(`Failed to load upazilas: ${error.message}. Please try again or refresh the page.`);
                });
        } else {
            setLoading(upazilaSelect, false);
        }
    });

    // Form submission handler
    registerForm.addEventListener('submit', function(e) {
        let isValid = true;
        let errorMessages = [];

        // Phone validation
        const phone = document.getElementById('phone').value;
        const phonePattern = /^01[0-9]{9}$/;
        if (!phonePattern.test(phone)) {
            isValid = false;
            errorMessages.push('Phone number must be 11 digits starting with 01');
        }

        // Password match validation
        const password = document.getElementById('password').value;
        const passwordConfirmation = document.getElementById('password_confirmation').value;
        if (password !== passwordConfirmation) {
            isValid = false;
            errorMessages.push('Passwords do not match');
        }

        // Location validation
        if (!divisionSelect.value) {
            isValid = false;
            errorMessages.push('Please select a division');
        }
        if (!districtSelect.value) {
            isValid = false;
            errorMessages.push('Please select a district');
        }
        if (!upazilaSelect.value) {
            isValid = false;
            errorMessages.push('Please select an upazila');
        }

        if (!isValid) {
            e.preventDefault();
            showError(errorMessages.join('<br>'));
            return false;
        }

        // Disable submit button to prevent double submission
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Registering...';
    });

    // On page load, if there's an old division, trigger the cascade
    if (oldDivision) {
        divisionSelect.dispatchEvent(new Event('change'));
    }

    // Phone number formatting helper
    document.getElementById('phone').addEventListener('input', function(e) {
        // Remove non-numeric characters
        this.value = this.value.replace(/[^0-9]/g, '');
        
        // Limit to 11 digits
        if (this.value.length > 11) {
            this.value = this.value.slice(0, 11);
        }
    });
});
</script>
@endpush
@endsection