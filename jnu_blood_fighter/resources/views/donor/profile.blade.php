@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Your Profile</h4>
                </div>
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('donor.profile.update') }}" id="profileForm">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $donor->name) }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone', $donor->phone) }}" placeholder="01XXXXXXXXX" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Blood Type <span class="text-danger">*</span></label>
                                <select name="blood_type" class="form-select" required>
                                    @foreach(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'] as $type)
                                        <option value="{{ $type }}" {{ old('blood_type', $donor->blood_type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Last Donation Date</label>
                                <input type="date" name="last_donation_date" class="form-control" value="{{ old('last_donation_date', $donor->last_donation_date?->format('Y-m-d')) }}">
                                <small class="text-muted">Leave empty if never donated</small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Division <span class="text-danger">*</span></label>
                                <select name="division" id="division" class="form-select" required>
                                    <option value="">Select Division</option>
                                    @foreach($divisions as $div)
                                        <option value="{{ $div['en'] }}" {{ old('division', $donor->division) == $div['en'] ? 'selected' : '' }}>
                                            {{ $div['en'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">District <span class="text-danger">*</span></label>
                                <select name="district" id="district" class="form-select" required>
                                    <option value="">Select District</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Upazila <span class="text-danger">*</span></label>
                                <select name="upazila" id="upazila" class="form-select" required>
                                    <option value="">Select Upazila</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Address <span class="text-danger">*</span></label>
                            <textarea name="address" class="form-control" rows="2" required>{{ old('address', $donor->address) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_available" id="is_available" value="1" {{ old('is_available', $donor->is_available) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_available">
                                    I am available to donate blood
                                </label>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary flex-fill">Update Profile</button>
                            <a href="{{ route('donor.dashboard') }}" class="btn btn-secondary">Cancel</a>
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

document.getElementById('division').addEventListener('change', function() {
    loadDistricts(this.value);
});

document.getElementById('district').addEventListener('change', function() {
    loadUpazilas(this.value);
});

function loadDistricts(division) {
    const districtSelect = document.getElementById('district');
    const upazilaSelect = document.getElementById('upazila');
    
    districtSelect.innerHTML = '<option value="">Select District</option>';
    upazilaSelect.innerHTML = '<option value="">Select Upazila</option>';
    
    if (division) {
        fetch(`/api/districts/${division}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(district => {
                    const option = new Option(district, district, false, district === oldDistrict);
                    districtSelect.add(option);
                });
                if (oldDistrict) {
                    districtSelect.value = oldDistrict;
                    loadUpazilas(oldDistrict);
                }
            });
    }
}

function loadUpazilas(district) {
    const upazilaSelect = document.getElementById('upazila');
    upazilaSelect.innerHTML = '<option value="">Select Upazila</option>';
    
    if (district) {
        fetch(`/api/upazilas/${district}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(upazila => {
                    const option = new Option(upazila, upazila, false, upazila === oldUpazila);
                    upazilaSelect.add(option);
                });
                if (oldUpazila) {
                    upazilaSelect.value = oldUpazila;
                }
            });
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