@extends('layouts.admin')

@section('title', 'Edit Donor')

@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="bi bi-pencil-square"></i> Edit Donor: {{ $donor->name }}</h4>
                    <a href="{{ route('admin.donors') }}" class="btn btn-sm btn-light">
                        <i class="bi bi-arrow-left"></i> Back to Donors
                    </a>
                </div>
                <div class="card-body p-4">
                    {{-- Error Messages --}}
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <strong><i class="bi bi-exclamation-triangle-fill"></i> Validation Errors!</strong>
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- Error Message --}}
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.donors.update', $donor->id) }}">
                        @csrf
                        
                        {{-- Personal Information Section --}}
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h6 class="mb-0"><i class="bi bi-person-fill"></i> Personal Information</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                        <input 
                                            type="text" 
                                            name="name" 
                                            class="form-control @error('name') is-invalid @enderror" 
                                            value="{{ old('name', $donor->name) }}" 
                                            required
                                            maxlength="255"
                                        >
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                                            <input type="email" class="form-control bg-light" value="{{ $donor->email }}" disabled>
                                        </div>
                                        <small class="text-muted"><i class="bi bi-lock-fill"></i> Email cannot be changed</small>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                                            <input 
                                                type="text" 
                                                name="phone" 
                                                class="form-control @error('phone') is-invalid @enderror" 
                                                value="{{ old('phone', $donor->phone) }}" 
                                                required
                                                maxlength="11"
                                                pattern="01[0-9]{9}"
                                                placeholder="01XXXXXXXXX"
                                            >
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        @error('phone')
                                        @else
                                            <small class="text-muted">Format: 01XXXXXXXXX (11 digits)</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Blood Type <span class="text-danger">*</span></label>
                                        <select name="blood_type" class="form-select @error('blood_type') is-invalid @enderror" required>
                                            @foreach(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'] as $type)
                                                <option value="{{ $type }}" {{ old('blood_type', $donor->blood_type) == $type ? 'selected' : '' }}>
                                                    {{ $type }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('blood_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Location Section --}}
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h6 class="mb-0"><i class="bi bi-geo-alt-fill"></i> Location Information</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label"><strong>Division</strong></label>
                                            <div class="p-2 bg-light rounded">
                                                <i class="bi bi-pin-map-fill text-primary"></i> {{ $donor->division }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label"><strong>District</strong></label>
                                            <div class="p-2 bg-light rounded">
                                                <i class="bi bi-pin-fill text-primary"></i> {{ $donor->district }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label"><strong>Upazila</strong></label>
                                            <div class="p-2 bg-light rounded">
                                                <i class="bi bi-geo-fill text-primary"></i> {{ $donor->upazila }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="alert alert-info mb-0">
                                    <i class="bi bi-info-circle-fill"></i> <strong>Note:</strong> Location details (Division, District, Upazila) cannot be changed from the admin panel for security reasons.
                                </div>
                            </div>
                        </div>

                        {{-- Address Section --}}
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h6 class="mb-0"><i class="bi bi-house-fill"></i> Address Details</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Detailed Address</label>
                                    <textarea class="form-control bg-light" rows="3" disabled>{{ $donor->address }}</textarea>
                                    <small class="text-muted"><i class="bi bi-lock-fill"></i> Address cannot be changed from admin panel</small>
                                </div>
                            </div>
                        </div>

                        {{-- Donation Status Section --}}
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h6 class="mb-0"><i class="bi bi-droplet-fill"></i> Donation Status</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Last Donation Date</label>
                                        <input 
                                            type="date" 
                                            name="last_donation_date" 
                                            class="form-control @error('last_donation_date') is-invalid @enderror" 
                                            value="{{ old('last_donation_date', $donor->last_donation_date?->format('Y-m-d')) }}"
                                            max="{{ date('Y-m-d') }}"
                                        >
                                        @error('last_donation_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @else
                                            <small class="text-muted">Leave empty if never donated before</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Availability Status</label>
                                        <div class="form-check form-switch mt-2" style="font-size: 1.1rem;">
                                            <input 
                                                class="form-check-input" 
                                                type="checkbox" 
                                                name="is_available" 
                                                id="is_available" 
                                                value="1" 
                                                {{ old('is_available', $donor->is_available) ? 'checked' : '' }}
                                                style="width: 3em; height: 1.5em;"
                                            >
                                            <label class="form-check-label ms-2" for="is_available">
                                                <strong>Available to donate blood</strong>
                                            </label>
                                        </div>
                                        @if($donor->last_donation_date)
                                            @if($donor->canDonate())
                                                <div class="alert alert-success mt-2 mb-0 py-2">
                                                    <i class="bi bi-check-circle-fill"></i> <strong>Eligible to donate now</strong><br>
                                                    <small>Last donation was {{ $donor->last_donation_date->diffForHumans() }}</small>
                                                </div>
                                            @else
                                                <div class="alert alert-warning mt-2 mb-0 py-2">
                                                    <i class="bi bi-exclamation-triangle-fill"></i> <strong>Must wait 3 months</strong><br>
                                                    <small>Last donation: {{ $donor->last_donation_date->format('M d, Y') }}</small>
                                                </div>
                                            @endif
                                        @else
                                            <div class="alert alert-info mt-2 mb-0 py-2">
                                                <i class="bi bi-info-circle-fill"></i> <strong>Never donated before</strong><br>
                                                <small>This donor is eligible to donate</small>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- System Information Section --}}
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h6 class="mb-0"><i class="bi bi-clock-history"></i> System Information</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="p-3 bg-light rounded">
                                            <strong><i class="bi bi-calendar-plus"></i> Registered:</strong><br>
                                            {{ $donor->created_at->format('M d, Y h:i A') }}<br>
                                            <small class="text-muted">{{ $donor->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="p-3 bg-light rounded">
                                            <strong><i class="bi bi-pencil-square"></i> Last Updated:</strong><br>
                                            {{ $donor->updated_at->format('M d, Y h:i A') }}<br>
                                            <small class="text-muted">{{ $donor->updated_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary btn-lg flex-fill">
                                <i class="bi bi-save"></i> Update Donor Information
                            </button>
                            <a href="{{ route('admin.donors') }}" class="btn btn-secondary btn-lg">
                                <i class="bi bi-x-lg"></i> Cancel
                            </a>
                            <button type="button" class="btn btn-outline-danger btn-lg" onclick="if(confirm('Are you sure you want to delete this donor? This action cannot be undone.')) { document.getElementById('delete-form').submit(); }">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </div>
                    </form>

                    {{-- Delete Form --}}
                    <form id="delete-form" method="POST" action="{{ route('admin.donors.delete', $donor->id) }}" class="d-none">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Phone number formatting
    const phoneInput = document.querySelector('input[name="phone"]');
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            // Remove non-numeric characters
            this.value = this.value.replace(/[^0-9]/g, '');
            
            // Limit to 11 digits
            if (this.value.length > 11) {
                this.value = this.value.slice(0, 11);
            }
        });
    }

    // Availability toggle feedback
    const availabilitySwitch = document.getElementById('is_available');
    if (availabilitySwitch) {
        availabilitySwitch.addEventListener('change', function() {
            const label = this.nextElementSibling;
            if (this.checked) {
                label.innerHTML = '<strong class="text-success">Available to donate blood</strong>';
            } else {
                label.innerHTML = '<strong class="text-danger">Not available to donate blood</strong>';
            }
        });
    }

    // Form submission confirmation
    const form = document.querySelector('form[action*="update"]');
    if (form) {
        form.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Updating...';
        });
    }
});
</script>
@endpush
@endsection