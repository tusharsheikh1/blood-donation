@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
             {{-- Modern Card Style: Larger shadow, soft rounded corners, primary color header --}}
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary bg-gradient text-white rounded-top-4 py-3">
                    <h3 class="mb-0 fw-bold"><i class="bi bi-person-gear me-2"></i> Edit Your Profile</h3>
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
                            <ul class="mb-0 small">
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
                                <input type="text" name="name" class="form-control form-control-lg rounded-3" value="{{ old('name', $donor->name) }}" required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Phone Number <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control form-control-lg rounded-3" value="{{ old('phone', $donor->phone) }}" placeholder="01XXXXXXXXX" required>
                                <small class="text-muted">Format: 01XXXXXXXXX</small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Blood Type <span class="text-danger">*</span></label>
                                <select name="blood_type" class="form-select form-select-lg rounded-3" required>
                                    @foreach(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'] as $type)
                                        <option value="{{ $type }}" {{ old('blood_type', $donor->blood_type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Last Donation Date</label>
                                <input type="date" name="last_donation_date" class="form-control form-control-lg rounded-3" value="{{ old('last_donation_date', $donor->last_donation_date?->format('Y-m-d')) }}">
                                <small class="text-muted">Leave empty if never donated</small>
                            </div>
                        </div>

                        {{-- Location Details --}}
                        <h5 class="text-primary border-bottom pb-2 mb-4 mt-4"><i class="bi bi-geo-alt-fill me-2"></i> Location Details</h5>
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label class="form-label fw-bold">Division <span class="text-danger">*</span></label>
                                <select name="division" id="division" class="form-select rounded-3" required>
                                    <option value="">Select Division</option>
                                    @foreach($divisions as $div)
                                        <option value="{{ $div['en'] }}" {{ old('division', $donor->division) == $div['en'] ? 'selected' : '' }}>
                                            {{ $div['en'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mb-4">
                                <label class="form-label fw-bold">District <span class="text-danger">*</span></label>
                                <select name="district" id="district" class="form-select rounded-3" required>
                                    <option value="">Select District</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-4">
                                <label class="form-label fw-bold">Upazila <span class="text-danger">*</span></label>
                                <select name="upazila" id="upazila" class="form-select rounded-3" required>
                                    <option value="">Select Upazila</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Address <span class="text-danger">*</span></label>
                            <textarea name="address" class="form-control rounded-3" rows="2" required>{{ old('address', $donor->address) }}</textarea>
                            <small class="text-muted">House/Flat No, Road, Area</small>
                        </div>
                        
                        {{-- Availability Switch --}}
                        <h5 class="text-primary border-bottom pb-2 mb-4 mt-4"><i class="bi bi-heart-pulse-fill me-2"></i> Availability</h5>
                        <div class="mb-4">
                            <div class="form-check form-switch d-flex align-items-center p-0">
                                <input class="form-check-input ms-0 me-3" type="checkbox" name="is_available" id="is_available" value="1" {{ old('is_available', $donor->is_available) ? 'checked' : '' }} style="width: 3.5em; height: 1.8em;">
                                <label class="form-check-label fw-bold fs-5" for="is_available">
                                    I am **{{ $donor->is_available ? 'AVAILABLE' : 'NOT AVAILABLE' }}** to donate blood
                                </label>
                            </div>
                            <small class="text-muted d-block mt-1">Donors marked as 'Available' are prioritized for blood requests.</small>
                        </div>

                        {{-- Submit Buttons --}}
                        <div class="d-flex gap-3 pt-3">
                            <button type="submit" class="btn btn-primary btn-lg flex-fill fw-bold rounded-3">
                                <i class="bi bi-floppy-fill me-1"></i> Update Profile
                            </button>
                            <a href="{{ route('donor.dashboard') }}" class="btn btn-outline-secondary btn-lg rounded-3">Cancel</a>
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
const isAvailableLabel = document.querySelector('label[for="is_available"]');

// Function to update the label text based on the checkbox state
function updateAvailabilityLabel() {
    if (isAvailableCheckbox.checked) {
        isAvailableLabel.innerHTML = 'I am <strong class="text-success">AVAILABLE</strong> to donate blood';
    } else {
        isAvailableLabel.innerHTML = 'I am <strong class="text-danger">NOT AVAILABLE</strong> to donate blood';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    updateAvailabilityLabel();
    // Phone number formatting
    document.querySelector('input[name="phone"]').addEventListener('input', function(e) {
        // Remove non-numeric characters and limit to 11 digits
        this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);
    });
});

isAvailableCheckbox.addEventListener('change', updateAvailabilityLabel);

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

// Load on page load
const currentDivision = document.getElementById('division').value;
if (currentDivision) {
    loadDistricts(currentDivision);
}
</script>
@endpush
@endsection