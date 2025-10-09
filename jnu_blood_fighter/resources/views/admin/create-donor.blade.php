@extends('layouts.admin')

@section('title', 'Create Donor')

@section('content')
<div class="container-fluid mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-person-plus"></i> Create New Donor</h5>
            <a href="{{ route('admin.donors') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.
                    <ul class="mt-2 mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.donors.store') }}">
                @csrf

                <div class="row g-3">
                    <!-- Name -->
                    <div class="col-md-6">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                    </div>

                    <!-- Blood Type -->
                    <div class="col-md-3">
                        <label class="form-label">Blood Type</label>
                        <select name="blood_type" class="form-select" required>
                            <option value="">Select</option>
                            @foreach(['A+','A-','B+','B-','O+','O-','AB+','AB-'] as $type)
                                <option value="{{ $type }}" @selected(old('blood_type')==$type)>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Gender -->
                    <div class="col-md-3">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-select">
                            <option value="">Select</option>
                            <option value="male" @selected(old('gender')==='male')>Male</option>
                            <option value="female" @selected(old('gender')==='female')>Female</option>
                            <option value="other" @selected(old('gender')==='other')>Other</option>
                        </select>
                    </div>

                    <!-- Phone -->
                    <div class="col-md-6">
                        <label class="form-label">Phone (Starts with 01)</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" maxlength="11" required>
                    </div>

                    <!-- Address -->
                    <div class="col-md-6">
                        <label class="form-label">Address</label>
                        <input type="text" name="address" value="{{ old('address') }}" class="form-control" required>
                    </div>

                    <!-- Location -->
                    <div class="col-md-4">
                        <label class="form-label">Division</label>
                        <select name="division" id="division" class="form-select" required>
                            <option value="">Select Division</option>
                            @foreach($divisions as $division)
                                <option value="{{ $division['en'] }}" @selected(old('division')==$division['en'])>{{ $division['en'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">District</label>
                        <select name="district" id="district" class="form-select" required>
                            <option value="">Select District</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Upazila</label>
                        <select name="upazila" id="upazila" class="form-select" required>
                            <option value="">Select Upazila</option>
                        </select>
                    </div>

                    <!-- Medical / Meta -->
                    <div class="col-md-4">
                        <label class="form-label">Height (cm)</label>
                        <input type="number" name="height_cm" value="{{ old('height_cm') }}" class="form-control" min="50" max="250">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Weight (kg)</label>
                        <input type="number" name="weight_kg" value="{{ old('weight_kg') }}" class="form-control" min="20" max="300">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Age</label>
                        <input type="number" name="age" value="{{ old('age') }}" class="form-control" min="16" max="100">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Last Donation Date</label>
                        <input type="date" name="last_donation_date" value="{{ old('last_donation_date') }}" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label d-block">Available to Donate</label>
                        <div class="form-check form-switch mt-1">
                            <input class="form-check-input" type="checkbox" name="is_available" value="1" id="is_available" @checked(old('is_available'))>
                            <label class="form-check-label" for="is_available">Yes</label>
                        </div>
                    </div>

                    <!-- (No email / password here on purpose) -->
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Create Donor
                    </button>
                    <a href="{{ route('admin.donors') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-circle"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const divisionSelect = document.getElementById('division');
    const districtSelect = document.getElementById('district');
    const upazilaSelect  = document.getElementById('upazila');

    const populateSelect = (select, items, placeholder) => {
        select.innerHTML = `<option value="">${placeholder}</option>`;
        (Array.isArray(items) ? items : []).forEach(val => {
            const opt = document.createElement('option');
            opt.value = val;
            opt.textContent = val;
            select.appendChild(opt);
        });
    };

    divisionSelect.addEventListener('change', async () => {
        const division = divisionSelect.value;
        populateSelect(districtSelect, [], 'Loading…');
        populateSelect(upazilaSelect, [], 'Select Upazila');
        if (!division) { populateSelect(districtSelect, [], 'Select District'); return; }

        try {
            const res = await fetch(`/api/districts/${encodeURIComponent(division)}`);
            const data = await res.json();
            populateSelect(districtSelect, data, 'Select District');
        } catch {
            populateSelect(districtSelect, [], 'Error loading districts');
        }
    });

    districtSelect.addEventListener('change', async () => {
        const district = districtSelect.value;
        populateSelect(upazilaSelect, [], 'Loading…');
        if (!district) { populateSelect(upazilaSelect, [], 'Select Upazila'); return; }

        try {
            const res = await fetch(`/api/upazilas/${encodeURIComponent(district)}`);
            const data = await res.json();
            populateSelect(upazilaSelect, data, 'Select Upazila');
        } catch {
            populateSelect(upazilaSelect, [], 'Error loading upazilas');
        }
    });
});
</script>
@endpush
