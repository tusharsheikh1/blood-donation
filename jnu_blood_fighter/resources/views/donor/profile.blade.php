@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary bg-gradient text-white rounded-top-4 py-3 d-flex justify-content-between align-items-center">
                    <h3 class="mb-0 fw-bold"><i class="bi bi-person-gear me-2"></i> Edit Your Profile</h3>
                    <a href="{{ route('donor.dashboard') }}" class="btn btn-outline-light btn-sm rounded-pill fw-bold">
                        <i class="bi bi-arrow-left-circle me-1"></i> Back to Dashboard
                    </a>
                </div>
                <div class="card-body p-4 p-md-5">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded-3">
                            <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger rounded-3">
                            <strong><i class="bi bi-exclamation-triangle-fill me-1"></i> Please fix the following errors:</strong>
                            <ul class="mb-0 small mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('donor.profile.update') }}" id="profileForm">
                        @csrf
                        
                        {{-- Personal Information --}}
                        <h5 class="text-primary border-bottom pb-2 mb-4"><i class="bi bi-person-vcard me-2"></i> Personal Details</h5>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control form-control-lg rounded-3 @error('name') is-invalid @enderror" value="{{ old('name', $donor->name) }}" required maxlength="255">
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Phone Number <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control form-control-lg rounded-3 @error('phone') is-invalid @enderror" value="{{ old('phone', $donor->phone) }}" placeholder="01XXXXXXXXX" required maxlength="11">
                                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <small class="text-muted">Format: 01XXXXXXXXX</small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label class="form-label fw-bold">Gender <span class="text-danger">*</span></label>
                                <select name="gender" class="form-select form-select-lg rounded-3 @error('gender') is-invalid @enderror" required>
                                    <option value="">Select Gender</option>
                                    @foreach(['Male', 'Female', 'Other'] as $g)
                                        <option value="{{ $g }}" {{ old('gender', $donor->gender) == $g ? 'selected' : '' }}>{{ $g }}</option>
                                    @endforeach
                                </select>
                                @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="col-md-4 mb-4">
                                <label class="form-label fw-bold">Age (years) <span class="text-danger">*</span></label>
                                <input type="number" name="age" class="form-control form-control-lg rounded-3 @error('age') is-invalid @enderror" value="{{ old('age', $donor->age) }}" min="18" max="65" required>
                                @error('age')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <small class="text-muted">Must be 18-65 years</small>
                            </div>
                            
                            <div class="col-md-4 mb-4">
                                <label class="form-label fw-bold">Weight (kg) <span class="text-danger">*</span></label>
                                <input type="number" name="weight_kg" class="form-control form-control-lg rounded-3 @error('weight_kg') is-invalid @enderror" value="{{ old('weight_kg', $donor->weight_kg) }}" min="45" max="200" required>
                                @error('weight_kg')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <small class="text-muted">Minimum 45 kg</small>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Height (ft/in) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <select id="height_ft" class="form-select form-select-lg rounded-start-3" required>
                                        <option value="">Ft</option>
                                        @for ($f = 4; $f <= 7; $f++)
                                            <option value="{{ $f }}">{{ $f }} ft</option>
                                        @endfor
                                    </select>
                                    <select id="height_in" class="form-select form-select-lg rounded-end-3" required>
                                        <option value="">In</option>
                                        @for ($i = 0; $i <= 11; $i++)
                                            <option value="{{ $i }}">{{ $i }} in</option>
                                        @endfor
                                    </select>
                                </div>
                                <small class="text-muted">Select height in feet and inches</small>
                                <input type="hidden" name="height_cm" id="height_cm" value="{{ old('height_cm', $donor->height_cm) }}">
                                @error('height_cm')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Blood Type <span class="text-danger">*</span></label>
                                <select name="blood_type" class="form-select form-select-lg rounded-3 @error('blood_type') is-invalid @enderror" required>
                                    @foreach(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'] as $type)
                                        <option value="{{ $type }}" {{ old('blood_type', $donor->blood_type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                                    @endforeach
                                </select>
                                @error('blood_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label class="form-label fw-bold">Last Donation Date</label>
                                <input type="date" name="last_donation_date" class="form-control form-control-lg rounded-3 @error('last_donation_date') is-invalid @enderror" value="{{ old('last_donation_date', $donor->last_donation_date?->format('Y-m-d')) }}" max="{{ now()->format('Y-m-d') }}">
                                @error('last_donation_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <small class="text-muted">Leave empty if never donated</small>
                            </div>
                        </div>

                        {{-- Location Details --}}
                        <h5 class="text-primary border-bottom pb-2 mb-4 mt-4"><i class="bi bi-geo-alt-fill me-2"></i> Location Details</h5>
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label class="form-label fw-bold">Division <span class="text-danger">*</span></label>
                                <select name="division" id="division" class="form-select rounded-3 @error('division') is-invalid @enderror" required>
                                    <option value="">Select Division</option>
                                    @foreach($divisions as $div)
                                        <option value="{{ $div['en'] }}" {{ old('division', $donor->division) == $div['en'] ? 'selected' : '' }}>
                                            {{ $div['en'] }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('division')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-4 mb-4">
                                <label class="form-label fw-bold">District <span class="text-danger">*</span></label>
                                <select name="district" id="district" class="form-select rounded-3 @error('district') is-invalid @enderror" required>
                                    <option value="">Select District</option>
                                </select>
                                @error('district')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-4 mb-4">
                                <label class="form-label fw-bold">Upazila <span class="text-danger">*</span></label>
                                <select name="upazila" id="upazila" class="form-select rounded-3 @error('upazila') is-invalid @enderror" required>
                                    <option value="">Select Upazila</option>
                                </select>
                                @error('upazila')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Address <span class="text-danger">*</span></label>
                            <textarea name="address" class="form-control rounded-3 @error('address') is-invalid @enderror" rows="2" required maxlength="500">{{ old('address', $donor->address) }}</textarea>
                            @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <small class="text-muted">House/Flat No, Road, Area</small>
                        </div>
                        
                        {{-- Privacy & Availability --}}
                        <h5 class="text-primary border-bottom pb-2 mb-4 mt-4"><i class="bi bi-shield-check me-2"></i> Privacy & Availability</h5>
                        
                        <div class="mb-4">
                            <div class="form-check form-switch d-flex align-items-center p-0">
                                <input class="form-check-input ms-0 me-3" type="checkbox" name="share_phone" id="share_phone" value="1" {{ old('share_phone', $donor->share_phone) ? 'checked' : '' }} style="width: 3.5em; height: 1.8em;">
                                <label class="form-check-label fw-bold fs-5" for="share_phone">
                                    Share my <strong id="contact_type_text">{{ $donor->share_phone ? 'phone number' : 'email address' }}</strong> publicly
                                </label>
                            </div>
                            <small class="text-muted d-block mt-2">
                                <i class="bi bi-info-circle me-1"></i>
                                When enabled, your phone number will be visible to people searching for donors. 
                                When disabled, your email address will be shown instead for privacy.
                            </small>
                        </div>
                        
                        <div class="mb-4">
                            <div class="form-check form-switch d-flex align-items-center p-0">
                                <input class="form-check-input ms-0 me-3" type="checkbox" name="is_available" id="is_available" value="1" {{ old('is_available', $donor->is_available) ? 'checked' : '' }} style="width: 3.5em; height: 1.8em;">
                                <label class="form-check-label fw-bold fs-5" for="is_available">
                                    I am <strong id="availability_status_text">{{ $donor->is_available ? 'AVAILABLE' : 'NOT AVAILABLE' }}</strong> to donate blood
                                </label>
                            </div>
                            <small class="text-muted d-block mt-2">Donors marked as 'Available' are prioritized for blood requests.</small>
                        </div>

                        {{-- Submit Buttons --}}
                        <div class="d-flex gap-3 pt-3">
                            <button type="submit" class="btn btn-primary btn-lg flex-fill fw-bold rounded-3" id="submitBtn">
                                <i class="bi bi-floppy-fill me-1"></i> Update Profile
                            </button>
                            <a href="{{ route('donor.dashboard') }}" class="btn btn-outline-secondary btn-lg rounded-3">
                                <i class="bi bi-arrow-left me-1"></i> Back to Dashboard
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
const oldDistrict = '{{ old('district', $donor->district) }}';
const oldUpazila = '{{ old('upazila', $donor->upazila) }}';
const isAvailableCheckbox = document.getElementById('is_available');
const availabilityStatusText = document.getElementById('availability_status_text');
const sharePhoneCheckbox = document.getElementById('share_phone');
const contactTypeText = document.getElementById('contact_type_text');

const heightFtSelect = document.getElementById('height_ft');
const heightInSelect = document.getElementById('height_in');
const heightCmInput = document.getElementById('height_cm');
const profileForm = document.getElementById('profileForm');

const initialHeightCm = parseInt(heightCmInput.value);

function convertInchesToFtIn(totalInches) {
    if (isNaN(totalInches) || totalInches < 0) return {ft: '', inch: ''};
    const ft = Math.floor(totalInches / 12);
    const inch = totalInches % 12;
    return {ft: ft, inch: inch};
}

function setInitialHeightDropdowns() {
    if (!isNaN(initialHeightCm) && initialHeightCm > 0) {
        const totalInches = Math.round(initialHeightCm / 2.54);
        const { ft, inch } = convertInchesToFtIn(totalInches);
        
        if (ft >= 4 && ft <= 7) {
            heightFtSelect.value = ft;
            heightInSelect.value = inch;
        }
    }
}

function convertFtInToCm() {
    const ft = parseInt(heightFtSelect.value) || 0;
    const inch = parseInt(heightInSelect.value) || 0;
    const totalInches = (ft * 12) + inch;
    const totalCm = Math.round(totalInches * 2.54);
    heightCmInput.value = totalCm > 0 ? totalCm : '';
}

function updateAvailabilityLabel() {
    if (isAvailableCheckbox.checked) {
        availabilityStatusText.innerHTML = '<span class="text-success">AVAILABLE</span>';
    } else {
        availabilityStatusText.innerHTML = '<span class="text-danger">NOT AVAILABLE</span>';
    }
}

function updateContactTypeLabel() {
    if (sharePhoneCheckbox.checked) {
        contactTypeText.innerHTML = '<span class="text-primary">phone number</span>';
    } else {
        contactTypeText.innerHTML = '<span class="text-info">email address</span>';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    updateAvailabilityLabel();
    updateContactTypeLabel();
    setInitialHeightDropdowns();
    
    document.querySelector('input[name="phone"]').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);
    });
});

isAvailableCheckbox.addEventListener('change', updateAvailabilityLabel);
sharePhoneCheckbox.addEventListener('change', updateContactTypeLabel);

heightFtSelect.addEventListener('change', convertFtInToCm);
heightInSelect.addEventListener('change', convertFtInToCm);

profileForm.addEventListener('submit', function(e) {
    convertFtInToCm();
    
    if ((heightFtSelect.value || heightInSelect.value) && !heightCmInput.value) {
        e.preventDefault();
        alert('Please ensure height is correctly selected.');
        return false;
    }
    
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Updating Profile...';
});

document.getElementById('division').addEventListener('change', function() {
    loadDistricts(this.value);
});

document.getElementById('district').addEventListener('change', function() {
    loadUpazilas(this.value);
});

function loadDistricts(division) {
    const districtSelect = document.getElementById('district');
    const upazilaSelect = document.getElementById('upazila');
    
    districtSelect.innerHTML = '<option value="">Loading Districts...</option>';
    districtSelect.disabled = true;
    upazilaSelect.innerHTML = '<option value="">Select Upazila</option>';
    upazilaSelect.disabled = true;
    
    if (division) {
        fetch(`/api/districts/${division}`)
            .then(response => response.json())
            .then(data => {
                districtSelect.innerHTML = '<option value="">Select District</option>';
                data.forEach(district => {
                    const option = new Option(district, district, false, district === oldDistrict);
                    districtSelect.add(option);
                });
                districtSelect.disabled = false;
                if (oldDistrict && districtSelect.value === oldDistrict) {
                    loadUpazilas(oldDistrict);
                }
            }).catch(() => {
                districtSelect.innerHTML = '<option value="">Error loading</option>';
                districtSelect.disabled = false;
            });
    } else {
        districtSelect.innerHTML = '<option value="">Select District</option>';
        districtSelect.disabled = true;
    }
}

function loadUpazilas(district) {
    const upazilaSelect = document.getElementById('upazila');
    upazilaSelect.innerHTML = '<option value="">Loading Upazilas...</option>';
    upazilaSelect.disabled = true;
    
    if (district) {
        fetch(`/api/upazilas/${district}`)
            .then(response => response.json())
            .then(data => {
                upazilaSelect.innerHTML = '<option value="">Select Upazila</option>';
                data.forEach(upazila => {
                    const option = new Option(upazila, upazila, false, upazila === oldUpazila);
                    upazilaSelect.add(option);
                });
                upazilaSelect.disabled = false;
                if (oldUpazila && upazilaSelect.value === oldUpazila) {
                    upazilaSelect.value = oldUpazila;
                }
            }).catch(() => {
                upazilaSelect.innerHTML = '<option value="">Error loading</option>';
                upazilaSelect.disabled = false;
            });
    } else {
        upazilaSelect.innerHTML = '<option value="">Select Upazila</option>';
        upazilaSelect.disabled = true;
    }
}

const currentDivision = document.getElementById('division').value;
if (currentDivision) {
    loadDistricts(currentDivision);
}
</script>
@endpush
@endsection