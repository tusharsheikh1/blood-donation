@extends('layouts.app')

@section('title', 'Donor Registration')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- Modern Card Style: Larger shadow, soft rounded corners --}}
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-danger bg-gradient text-white text-center rounded-top-4 py-3">
                    <h3 class="mb-0 fw-bold"><i class="bi bi-heart-fill me-2"></i> Become a Blood Donor</h3>
                    <p class="mb-0 small opacity-75">Join our community and save a life today.</p>
                </div>
                <div class="card-body p-4 p-md-5">
                    
                    {{-- Alert Styling (improved) --}}
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                            <strong><i class="bi bi-exclamation-triangle-fill"></i> Registration Failed!</strong>
                            <p class="mb-2 mt-1">Please fix the following errors:</p>
                            <ul class="mb-0 small">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                            <strong><i class="bi bi-exclamation-circle-fill"></i> Error!</strong>
                            <p class="mb-0">{{ session('error') }}</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                            <strong><i class="bi bi-check-circle-fill"></i> Success!</strong>
                            <p class="mb-0">{{ session('success') }}</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('donor.register') }}" id="registerForm" novalidate>
                        @csrf
                        
                        {{-- Personal Information Section --}}
                        <h5 class="text-danger border-bottom pb-2 mb-4"><i class="bi bi-person-vcard me-2"></i> Personal Details</h5>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="name" class="form-label fw-bold">Full Name <span class="text-danger">*</span></label>
                                <input 
                                    type="text" 
                                    id="name" 
                                    name="name" 
                                    class="form-control form-control-lg @error('name') is-invalid @enderror rounded-3" 
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

                            <div class="col-md-6 mb-4">
                                <label for="email" class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    class="form-control form-control-lg @error('email') is-invalid @enderror rounded-3" 
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
                            <div class="col-md-6 mb-4">
                                <label for="phone" class="form-label fw-bold">Phone Number <span class="text-danger">*</span></label>
                                <input 
                                    type="text" 
                                    id="phone" 
                                    name="phone" 
                                    class="form-control form-control-lg @error('phone') is-invalid @enderror rounded-3" 
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

                            <div class="col-md-6 mb-4">
                                <label for="blood_type" class="form-label fw-bold">Blood Type <span class="text-danger">*</span></label>
                                <select 
                                    id="blood_type" 
                                    name="blood_type" 
                                    class="form-select form-select-lg @error('blood_type') is-invalid @enderror rounded-3" 
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

                        {{-- Location Section --}}
                        <h5 class="text-danger border-bottom pb-2 mb-4 mt-4"><i class="bi bi-geo-alt-fill me-2"></i> Location Details</h5>
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label for="division" class="form-label fw-bold">Division <span class="text-danger">*</span></label>
                                <select 
                                    name="division" 
                                    id="division" 
                                    class="form-select @error('division') is-invalid @enderror rounded-3" 
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

                            <div class="col-md-4 mb-4">
                                <label for="district" class="form-label fw-bold">District <span class="text-danger">*</span></label>
                                <select 
                                    name="district" 
                                    id="district" 
                                    class="form-select @error('district') is-invalid @enderror rounded-3" 
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

                            <div class="col-md-4 mb-4">
                                <label for="upazila" class="form-label fw-bold">Upazila <span class="text-danger">*</span></label>
                                <select 
                                    name="upazila" 
                                    id="upazila" 
                                    class="form-select @error('upazila') is-invalid @enderror rounded-3" 
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

                        <div class="mb-4">
                            <label for="address" class="form-label fw-bold">Address <span class="text-danger">*</span></label>
                            <textarea 
                                id="address" 
                                name="address" 
                                class="form-control @error('address') is-invalid @enderror rounded-3" 
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

                        {{-- Security Section --}}
                        <h5 class="text-danger border-bottom pb-2 mb-4 mt-4"><i class="bi bi-key-fill me-2"></i> Account Security</h5>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="password" class="form-label fw-bold">Password <span class="text-danger">*</span></label>
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    class="form-control form-control-lg @error('password') is-invalid @enderror rounded-3" 
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

                            <div class="col-md-6 mb-4">
                                <label for="password_confirmation" class="form-label fw-bold">Confirm Password <span class="text-danger">*</span></label>
                                <input 
                                    type="password" 
                                    id="password_confirmation" 
                                    name="password_confirmation" 
                                    class="form-control form-control-lg rounded-3" 
                                    required
                                    minlength="6"
                                    placeholder="Re-enter password"
                                >
                                <small class="form-text text-muted">Must match password</small>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms" required>
                                <label class="form-check-label fw-bold" for="terms">
                                    I agree to be contacted when blood is needed and confirm my information is accurate <span class="text-danger">*</span>
                                </label>
                            </div>
                        </div>

                        {{-- Button style: Larger, bolder, with rounded corners --}}
                        <button type="submit" class="btn btn-danger btn-lg w-100 fw-bold rounded-3" id="submitBtn">
                            <i class="bi bi-person-plus-fill me-1"></i> Register as Donor
                        </button>
                    </form>

                    <div class="text-center mt-4">
                        <p class="mb-0 text-muted">Already registered? <a href="{{ route('donor.login') }}" class="text-danger fw-bold text-decoration-none">Login here</a></p>
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
        // Remove existing error alert if any
        document.querySelector('.card-body').querySelectorAll('.alert-danger.custom-error').forEach(alert => alert.remove());
        
        const alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-danger alert-dismissible fade show rounded-3 custom-error';
        alertDiv.setAttribute('role', 'alert');
        alertDiv.innerHTML = `
            <strong><i class="bi bi-exclamation-triangle-fill"></i> Validation Error!</strong>
            <p class="mb-0 mt-1">${message}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;
        // Insert right after the card-header if it exists, or at the top of card-body
        const header = document.querySelector('.card-header');
        if (header) {
            header.insertAdjacentElement('afterend', alertDiv);
        } else {
            document.querySelector('.card-body').prepend(alertDiv);
        }
        
        // Scroll to the error message
        alertDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    // Division change handler
    divisionSelect.addEventListener('change', function() {
        const division = this.value;
        
        // Reset and clear dependent selects
        districtSelect.innerHTML = '<option value="">-- Select District --</option>';
        upazilaSelect.innerHTML = '<option value="">-- Select Upazila --</option>';
        document.getElementById('district-hint').textContent = division ? 'Loading districts...' : 'Select division first';
        document.getElementById('upazila-hint').textContent = 'Select district first';
        
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
                    document.getElementById('district-hint').textContent = 'Select your district';
                    
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
                    document.getElementById('district-hint').textContent = 'Error loading districts';
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
        document.getElementById('upazila-hint').textContent = district ? 'Loading upazilas...' : 'Select district first';
        
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
                    document.getElementById('upazila-hint').textContent = 'Select your upazila';
                    
                    // If there's an old upazila value, select it
                    if (oldUpazila && districtSelect.value === oldDistrict) {
                        upazilaSelect.value = oldUpazila;
                    }
                })
                .catch(error => {
                    console.error('Error loading upazilas:', error);
                    upazilaSelect.innerHTML = '<option value="">-- Error loading upazilas --</option>';
                    setLoading(upazilaSelect, false);
                    document.getElementById('upazila-hint').textContent = 'Error loading upazilas';
                    showError(`Failed to load upazilas: ${error.message}. Please try again or refresh the page.`);
                });
        } else {
            setLoading(upazilaSelect, false);
        }
    });

    // Form submission handler
    registerForm.addEventListener('submit', function(e) {
        // Clear previous custom errors
        document.querySelector('.card-body').querySelectorAll('.alert-danger.custom-error').forEach(alert => alert.remove());
        
        let isValid = true;
        let errorMessages = [];
        
        // Only run custom JS validation if built-in browser validation passes
        if (!registerForm.checkValidity()) {
            isValid = false;
        }

        // Phone validation (re-enforce custom pattern)
        const phone = document.getElementById('phone').value;
        const phonePattern = /^01[0-9]{9}$/;
        if (!phonePattern.test(phone)) {
            isValid = false;
            errorMessages.push('Phone number must be **11 digits** starting with **01**');
        }

        // Password match validation
        const password = document.getElementById('password').value;
        const passwordConfirmation = document.getElementById('password_confirmation').value;
        if (password !== passwordConfirmation) {
            isValid = false;
            errorMessages.push('Passwords do not match');
            // Add is-invalid class to confirmation field for visual feedback
            document.getElementById('password_confirmation').classList.add('is-invalid');
        } else {
             document.getElementById('password_confirmation').classList.remove('is-invalid');
        }
        
        // Location validation (only custom check if form.checkValidity() fails on select fields)
        if (!divisionSelect.value && divisionSelect.required) {
            isValid = false;
            errorMessages.push('Please select a **Division**');
        }
        if (!districtSelect.value && districtSelect.required) {
            isValid = false;
            errorMessages.push('Please select a **District**');
        }
        if (!upazilaSelect.value && upazilaSelect.required) {
            isValid = false;
            errorMessages.push('Please select an **Upazila**');
        }
        
        if (!document.getElementById('terms').checked) {
             isValid = false;
            errorMessages.push('You must agree to the **terms and conditions** to register');
        }


        if (!isValid) {
            e.preventDefault();
            // Show all errors at once if we collected custom errors
            if(errorMessages.length > 0) {
                showError(errorMessages.join('<br>'));
            }
            // Add Bootstrap's validation styles
            registerForm.classList.add('was-validated');
            return false;
        }

        // Disable submit button to prevent double submission
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Registering...';
    });

    // On page load, if there's an old division, trigger the cascade
    if (oldDivision) {
        // Use a timeout to ensure all DOM elements are fully rendered before dispatching the event
        setTimeout(() => divisionSelect.dispatchEvent(new Event('change')), 0);
    }

    // Phone number formatting helper
    document.getElementById('phone').addEventListener('input', function(e) {
        // Remove non-numeric characters and limit to 11 digits
        this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);
    });
});
</script>
@endpush
@endsection