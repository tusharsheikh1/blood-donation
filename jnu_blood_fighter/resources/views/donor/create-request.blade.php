@extends('layouts.app')

@section('title', 'Post Blood Request')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            {{-- Main Card Style: Larger shadow, soft rounded corners --}}
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-danger bg-gradient text-white rounded-top-4 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0 fw-bold"><i class="bi bi-plus-circle-fill me-2"></i> Post Blood Request</h3>
                        <a href="{{ route('donor.dashboard') }}" class="btn btn-sm btn-light rounded-pill fw-bold">
                            <i class="bi bi-arrow-left me-1"></i> Dashboard
                        </a>
                    </div>
                </div>
                <div class="card-body p-4 p-md-5">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show rounded-3">
                            <strong><i class="bi bi-exclamation-triangle-fill"></i> Please fix the following errors:</strong>
                            <ul class="mb-0 mt-2 small">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('blood-request.store') }}" id="requestForm">
                        @csrf

                        {{-- Patient Information Card --}}
                        <div class="card mb-4 border-light rounded-3 shadow-sm">
                            <div class="card-header bg-light border-0">
                                <h5 class="mb-0 text-dark fw-bold"><i class="bi bi-person-fill me-2 text-danger"></i> Patient Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label fw-bold">Patient Name <span class="text-danger">*</span></label>
                                        <input type="text" name="patient_name" class="form-control form-control-lg @error('patient_name') is-invalid @enderror rounded-3" 
                                               value="{{ old('patient_name') }}" required maxlength="255" placeholder="Enter patient's full name">
                                        @error('patient_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label class="form-label fw-bold">Disease/Reason <span class="text-danger">*</span></label>
                                        <input type="text" name="disease" class="form-control form-control-lg @error('disease') is-invalid @enderror rounded-3" 
                                               value="{{ old('disease') }}" required maxlength="255" placeholder="e.g., Surgery, Accident, Thalassemia">
                                        @error('disease')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Blood Requirements Card --}}
                        <div class="card mb-4 border-light rounded-3 shadow-sm">
                            <div class="card-header bg-light border-0">
                                <h5 class="mb-0 text-dark fw-bold"><i class="bi bi-droplet-fill me-2 text-danger"></i> Blood Requirements</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label fw-bold">Blood Type <span class="text-danger">*</span></label>
                                        <select name="blood_type" class="form-select form-select-lg @error('blood_type') is-invalid @enderror rounded-3" required>
                                            <option value="">-- Select Blood Type --</option>
                                            @foreach($bloodTypes as $type)
                                                <option value="{{ $type }}" {{ old('blood_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                                            @endforeach
                                        </select>
                                        @error('blood_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <label class="form-label fw-bold">Quantity (Bags) <span class="text-danger">*</span></label>
                                        <input type="number" name="blood_quantity" class="form-control form-control-lg @error('blood_quantity') is-invalid @enderror rounded-3" 
                                               value="{{ old('blood_quantity', 1) }}" required min="1" max="10">
                                        @error('blood_quantity')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        <small class="text-muted">1 bag = 450ml approx.</small>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <label class="form-label fw-bold">When Needed? <span class="text-danger">*</span></label>
                                        {{-- Enhanced Emergency Toggle --}}
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" name="is_emergency" id="is_emergency" 
                                                   value="1" {{ old('is_emergency') ? 'checked' : '' }} style="width: 3.5em; height: 1.8em;">
                                            <label class="form-check-label ms-2 fw-bold text-danger" for="is_emergency" style="font-size: 1.1rem;">
                                                <i class="bi bi-lightning-fill"></i> EMERGENCY
                                            </label>
                                        </div>
                                        <input type="datetime-local" name="needed_date" id="needed_date" 
                                               class="form-control @error('needed_date') is-invalid @enderror rounded-3" 
                                               value="{{ old('needed_date') }}" min="{{ date('Y-m-d\TH:i') }}">
                                        @error('needed_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        <small class="text-muted" id="date-hint">Select date & time or check 'Emergency'</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Hospital Location Card --}}
                        <div class="card mb-4 border-light rounded-3 shadow-sm">
                            <div class="card-header bg-light border-0">
                                <h5 class="mb-0 text-dark fw-bold"><i class="bi bi-hospital-fill me-2 text-danger"></i> Hospital Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label fw-bold">Hospital Name <span class="text-danger">*</span></label>
                                        <input type="text" name="hospital_name" class="form-control form-control-lg @error('hospital_name') is-invalid @enderror rounded-3" 
                                               value="{{ old('hospital_name') }}" required maxlength="255" placeholder="Enter hospital name">
                                        @error('hospital_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label class="form-label fw-bold">Hospital Address <span class="text-danger">*</span></label>
                                        <input type="text" name="hospital_location" class="form-control form-control-lg @error('hospital_location') is-invalid @enderror rounded-3" 
                                               value="{{ old('hospital_location') }}" required maxlength="500" placeholder="Full hospital address">
                                        @error('hospital_location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label fw-bold">Division <span class="text-danger">*</span></label>
                                        <select name="division" id="division" class="form-select @error('division') is-invalid @enderror rounded-3" required>
                                            <option value="">-- Select Division --</option>
                                            @foreach($divisions as $div)
                                                <option value="{{ $div['en'] }}" {{ old('division') == $div['en'] ? 'selected' : '' }}>{{ $div['en'] }}</option>
                                            @endforeach
                                        </select>
                                        @error('division')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <label class="form-label fw-bold">District <span class="text-danger">*</span></label>
                                        <select name="district" id="district" class="form-select @error('district') is-invalid @enderror rounded-3" required>
                                            <option value="">-- Select District --</option>
                                        </select>
                                        @error('district')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <label class="form-label fw-bold">Upazila <span class="text-danger">*</span></label>
                                        <select name="upazila" id="upazila" class="form-select @error('upazila') is-invalid @enderror rounded-3" required>
                                            <option value="">-- Select Upazila --</option>
                                        </select>
                                        @error('upazila')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Contact Information Card --}}
                        <div class="card mb-4 border-light rounded-3 shadow-sm">
                            <div class="card-header bg-light border-0">
                                <h5 class="mb-0 text-dark fw-bold"><i class="bi bi-telephone-fill me-2 text-danger"></i> Contact Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label fw-bold">Contact Number <span class="text-danger">*</span></label>
                                        <input type="text" name="contact_number" class="form-control form-control-lg @error('contact_number') is-invalid @enderror rounded-3" 
                                               value="{{ old('contact_number', $donor->phone) }}" required maxlength="11" 
                                               pattern="01[0-9]{9}" placeholder="01XXXXXXXXX">
                                        @error('contact_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        <small class="text-muted">This number will be shown to potential donors</small>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label class="form-label fw-bold">Additional Notes (Optional)</label>
                                        <textarea name="additional_notes" class="form-control rounded-3" rows="3" maxlength="1000" 
                                                  placeholder="Any additional information that might be helpful...">{{ old('additional_notes') }}</textarea>
                                        <small class="text-muted">Max 1000 characters</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Submit Buttons --}}
                        <div class="d-flex gap-3 pt-3">
                            <button type="submit" class="btn btn-danger btn-lg flex-fill fw-bold rounded-3" id="submitBtn">
                                <i class="bi bi-megaphone-fill me-1"></i> Post Blood Request
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
document.addEventListener('DOMContentLoaded', function() {
    const oldDivision = '{{ old('division') }}';
    const oldDistrict = '{{ old('district') }}';
    const oldUpazila = '{{ old('upazila') }}';
    
    const divisionSelect = document.getElementById('division');
    const districtSelect = document.getElementById('district');
    const upazilaSelect = document.getElementById('upazila');
    const emergencyCheckbox = document.getElementById('is_emergency');
    const neededDateInput = document.getElementById('needed_date');
    const dateHint = document.getElementById('date-hint');
    const contactNumberInput = document.querySelector('input[name="contact_number"]');

    // Emergency checkbox handler
    emergencyCheckbox.addEventListener('change', function() {
        if (this.checked) {
            neededDateInput.disabled = true;
            neededDateInput.required = false;
            neededDateInput.value = '';
            dateHint.textContent = 'Blood needed immediately - Date/Time field disabled';
            dateHint.classList.add('text-danger', 'fw-bold');
        } else {
            neededDateInput.disabled = false;
            neededDateInput.required = true;
            dateHint.textContent = 'Select date & time or check \'Emergency\'';
            dateHint.classList.remove('text-danger', 'fw-bold');
        }
    });

    // Trigger on load if emergency was checked
    if (emergencyCheckbox.checked) {
        emergencyCheckbox.dispatchEvent(new Event('change'));
    } else {
        // Ensure the hint is correctly set on load if not emergency
        dateHint.textContent = 'Select date & time or check \'Emergency\'';
    }

    // Location dropdowns - unchanged logic for functionality
    divisionSelect.addEventListener('change', function() {
        loadDistricts(this.value);
    });

    districtSelect.addEventListener('change', function() {
        loadUpazilas(this.value);
    });

    function loadDistricts(division) {
        // Simple loading logic can be added here
        districtSelect.innerHTML = '<option value="">-- Loading Districts... --</option>';
        districtSelect.disabled = true;
        upazilaSelect.innerHTML = '<option value="">-- Select Upazila --</option>';
        upazilaSelect.disabled = true;

        if (division) {
            fetch(`/api/districts/${encodeURIComponent(division)}`)
                .then(response => response.json())
                .then(data => {
                    districtSelect.innerHTML = '<option value="">-- Select District --</option>';
                    data.forEach(district => {
                        const option = new Option(district, district, false, district === oldDistrict);
                        districtSelect.add(option);
                    });
                    districtSelect.disabled = false;
                    if (oldDistrict && divisionSelect.value === oldDivision) {
                        districtSelect.value = oldDistrict;
                        districtSelect.dispatchEvent(new Event('change'));
                    }
                }).catch(() => {
                    districtSelect.innerHTML = '<option value="">-- Error loading --</option>';
                    districtSelect.disabled = false;
                });
        } else {
             districtSelect.innerHTML = '<option value="">-- Select District --</option>';
             districtSelect.disabled = true;
        }
    }

    function loadUpazilas(district) {
        upazilaSelect.innerHTML = '<option value="">-- Loading Upazilas... --</option>';
        upazilaSelect.disabled = true;
        
        if (district) {
            fetch(`/api/upazilas/${encodeURIComponent(district)}`)
                .then(response => response.json())
                .then(data => {
                    upazilaSelect.innerHTML = '<option value="">-- Select Upazila --</option>';
                    data.forEach(upazila => {
                        const option = new Option(upazila, upazila, false, upazila === oldUpazila);
                        upazilaSelect.add(option);
                    });
                    upazilaSelect.disabled = false;
                    if (oldUpazila && districtSelect.value === oldDistrict) {
                        upazilaSelect.value = oldUpazila;
                    }
                }).catch(() => {
                    upazilaSelect.innerHTML = '<option value="">-- Error loading --</option>';
                    upazilaSelect.disabled = false;
                });
        } else {
            upazilaSelect.innerHTML = '<option value="">-- Select Upazila --</option>';
            upazilaSelect.disabled = true;
        }
    }

    // Initialize on page load
    if (oldDivision) {
        loadDistricts(oldDivision);
    }

    // Phone number formatting
    contactNumberInput.addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);
    });

    // Form submission
    document.getElementById('requestForm').addEventListener('submit', function() {
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Posting Request...';
    });
});
</script>
@endpush
@endsection