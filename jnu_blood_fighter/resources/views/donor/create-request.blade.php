@extends('layouts.app')

@section('title', 'Post Blood Request')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-danger text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0"><i class="bi bi-plus-circle-fill"></i> Post Blood Request</h4>
                        <a href="{{ route('donor.dashboard') }}" class="btn btn-sm btn-light">
                            <i class="bi bi-arrow-left"></i> Back to Dashboard
                        </a>
                    </div>
                </div>
                <div class="card-body p-4">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <strong><i class="bi bi-exclamation-triangle-fill"></i> Please fix the following errors:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('blood-request.store') }}" id="requestForm">
                        @csrf

                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h6 class="mb-0"><i class="bi bi-person-fill"></i> Patient Information</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Patient Name <span class="text-danger">*</span></label>
                                        <input type="text" name="patient_name" class="form-control @error('patient_name') is-invalid @enderror" 
                                               value="{{ old('patient_name') }}" required maxlength="255" placeholder="Enter patient's full name">
                                        @error('patient_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Disease/Reason <span class="text-danger">*</span></label>
                                        <input type="text" name="disease" class="form-control @error('disease') is-invalid @enderror" 
                                               value="{{ old('disease') }}" required maxlength="255" placeholder="e.g., Surgery, Accident, Thalassemia">
                                        @error('disease')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h6 class="mb-0"><i class="bi bi-droplet-fill"></i> Blood Requirements</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Blood Type <span class="text-danger">*</span></label>
                                        <select name="blood_type" class="form-select @error('blood_type') is-invalid @enderror" required>
                                            <option value="">-- Select Blood Type --</option>
                                            @foreach($bloodTypes as $type)
                                                <option value="{{ $type }}" {{ old('blood_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                                            @endforeach
                                        </select>
                                        @error('blood_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Blood Quantity (Bags) <span class="text-danger">*</span></label>
                                        <input type="number" name="blood_quantity" class="form-control @error('blood_quantity') is-invalid @enderror" 
                                               value="{{ old('blood_quantity', 1) }}" required min="1" max="10">
                                        @error('blood_quantity')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        <small class="text-muted">1 bag = 450ml approx.</small>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">When Needed? <span class="text-danger">*</span></label>
                                        <div class="form-check form-switch mb-2" style="font-size: 1.1rem;">
                                            <input class="form-check-input" type="checkbox" name="is_emergency" id="is_emergency" 
                                                   value="1" {{ old('is_emergency') ? 'checked' : '' }} style="width: 3em; height: 1.5em;">
                                            <label class="form-check-label ms-2 text-danger fw-bold" for="is_emergency">
                                                <i class="bi bi-exclamation-triangle-fill"></i> EMERGENCY (Needed Immediately)
                                            </label>
                                        </div>
                                        <input type="datetime-local" name="needed_date" id="needed_date" 
                                               class="form-control @error('needed_date') is-invalid @enderror" 
                                               value="{{ old('needed_date') }}" min="{{ date('Y-m-d\TH:i') }}">
                                        @error('needed_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        <small class="text-muted" id="date-hint">Or select date & time above</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h6 class="mb-0"><i class="bi bi-hospital-fill"></i> Hospital Information</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Hospital Name <span class="text-danger">*</span></label>
                                        <input type="text" name="hospital_name" class="form-control @error('hospital_name') is-invalid @enderror" 
                                               value="{{ old('hospital_name') }}" required maxlength="255" placeholder="Enter hospital name">
                                        @error('hospital_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Hospital Address <span class="text-danger">*</span></label>
                                        <input type="text" name="hospital_location" class="form-control @error('hospital_location') is-invalid @enderror" 
                                               value="{{ old('hospital_location') }}" required maxlength="500" placeholder="Full hospital address">
                                        @error('hospital_location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                
                                {{-- START: Optional Google Map Link Field (ADDED) --}}
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Google Map Link (Optional)</label>
                                        <input type="url" name="hospital_map_link" class="form-control @error('hospital_map_link') is-invalid @enderror" 
                                               value="{{ old('hospital_map_link') }}" maxlength="500" placeholder="Paste the Google Maps link here (e.g., from 'Share' or 'Embed map')">
                                        @error('hospital_map_link')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        <small class="text-muted">A map link helps donors navigate easily.</small>
                                    </div>
                                </div>
                                {{-- END: Optional Google Map Link Field (ADDED) --}}


                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Division <span class="text-danger">*</span></label>
                                        <select name="division" id="division" class="form-select @error('division') is-invalid @enderror" required>
                                            <option value="">-- Select Division --</option>
                                            @foreach($divisions as $div)
                                                <option value="{{ $div['en'] }}" {{ old('division') == $div['en'] ? 'selected' : '' }}>{{ $div['en'] }}</option>
                                            @endforeach
                                        </select>
                                        @error('division')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">District <span class="text-danger">*</span></label>
                                        <select name="district" id="district" class="form-select @error('district') is-invalid @enderror" required>
                                            <option value="">-- Select District --</option>
                                        </select>
                                        @error('district')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Upazila <span class="text-danger">*</span></label>
                                        <select name="upazila" id="upazila" class="form-select @error('upazila') is-invalid @enderror" required>
                                            <option value="">-- Select Upazila --</option>
                                        </select>
                                        @error('upazila')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h6 class="mb-0"><i class="bi bi-telephone-fill"></i> Contact Information</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Contact Number <span class="text-danger">*</span></label>
                                        <input type="text" name="contact_number" class="form-control @error('contact_number') is-invalid @enderror" 
                                               value="{{ old('contact_number', $donor->phone) }}" required maxlength="11" 
                                               pattern="01[0-9]{9}" placeholder="01XXXXXXXXX">
                                        @error('contact_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        <small class="text-muted">This number will be shown to potential donors</small>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Additional Notes (Optional)</label>
                                        <textarea name="additional_notes" class="form-control" rows="3" maxlength="1000" 
                                                  placeholder="Any additional information that might be helpful...">{{ old('additional_notes') }}</textarea>
                                        <small class="text-muted">Max 1000 characters</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-danger btn-lg flex-fill" id="submitBtn">
                                <i class="bi bi-megaphone-fill"></i> Post Blood Request
                            </button>
                            <a href="{{ route('donor.dashboard') }}" class="btn btn-secondary btn-lg">Cancel</a>
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

    // Emergency checkbox handler
    emergencyCheckbox.addEventListener('change', function() {
        if (this.checked) {
            neededDateInput.disabled = true;
            neededDateInput.required = false;
            neededDateInput.value = '';
            dateHint.textContent = 'Blood needed immediately';
            dateHint.classList.add('text-danger', 'fw-bold');
        } else {
            neededDateInput.disabled = false;
            neededDateInput.required = true;
            dateHint.textContent = 'Select when blood is needed';
            dateHint.classList.remove('text-danger', 'fw-bold');
        }
    });

    // Trigger on load if emergency was checked
    if (emergencyCheckbox.checked) {
        emergencyCheckbox.dispatchEvent(new Event('change'));
    }

    // Location dropdowns
    divisionSelect.addEventListener('change', function() {
        loadDistricts(this.value);
    });

    districtSelect.addEventListener('change', function() {
        loadUpazilas(this.value);
    });

    function loadDistricts(division) {
        districtSelect.innerHTML = '<option value="">-- Select District --</option>';
        upazilaSelect.innerHTML = '<option value="">-- Select Upazila --</option>';
        
        if (division) {
            fetch(`/api/districts/${encodeURIComponent(division)}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(district => {
                        const option = new Option(district, district, false, district === oldDistrict);
                        districtSelect.add(option);
                    });
                    if (oldDistrict && divisionSelect.value === oldDivision) {
                        districtSelect.value = oldDistrict;
                        districtSelect.dispatchEvent(new Event('change'));
                    }
                });
        }
    }

    function loadUpazilas(district) {
        upazilaSelect.innerHTML = '<option value="">-- Select Upazila --</option>';
        
        if (district) {
            fetch(`/api/upazilas/${encodeURIComponent(district)}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(upazila => {
                        const option = new Option(upazila, upazila, false, upazila === oldUpazila);
                        upazilaSelect.add(option);
                    });
                    if (oldUpazila && districtSelect.value === oldDistrict) {
                        upazilaSelect.value = oldUpazila;
                    }
                });
        }
    }

    // Initialize on page load
    if (oldDivision) {
        loadDistricts(oldDivision);
    }

    // Phone number formatting
    document.querySelector('input[name="contact_number"]').addEventListener('input', function(e) {
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