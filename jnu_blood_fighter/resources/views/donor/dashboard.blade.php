@extends('layouts.app')

@section('title', 'Donor Dashboard')

@section('content')
<div class="container mt-5 mb-5 pt-3">
    
    {{-- Main Welcome Card (Refined) --}}
    <div class="card shadow border-0 mb-4 rounded-4 bg-danger bg-gradient text-white">
        <div class="card-body p-4">
            @if(session('success'))
                {{-- Move general session success to main layout or keep here for dashboard-specific messages --}}
                <div class="alert alert-light alert-dismissible fade show mb-4 rounded-3 text-dark" role="alert">
                    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                <div>
                    <h2 class="mb-1 fw-bold"><i class="bi bi-person-check-fill me-2"></i> Welcome Back, {{ $donor->name }}!</h2>
                    <p class="mb-0 fs-5">Your Blood Type: <span class="badge bg-light text-danger fs-6 fw-bold p-2">{{ $donor->blood_type }}</span></p>
                </div>
                <div class="mt-3 mt-md-0 d-flex gap-2">
                    <a href="{{ route('blood-request.create') }}" class="btn btn-light text-danger fw-bold rounded-pill shadow-sm d-none d-md-inline-flex">
                        <i class="bi bi-megaphone-fill me-1"></i> Request Blood
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Side Navigation / Donor Status Summary (Sidebar-like structure) --}}
        <div class="col-lg-3 mb-4 d-none d-lg-block">
            <div class="card shadow-sm border-0 rounded-4 sticky-top" style="top: 80px;">
                <div class="card-header bg-light border-0 rounded-top-4 py-3">
                    <h5 class="mb-0 text-dark fw-bold"><i class="bi bi-list me-2"></i> Quick Menu</h5>
                </div>
                <div class="list-group list-group-flush">
                    <a href="#kpi-summary" class="list-group-item list-group-item-action fw-bold d-flex align-items-center">
                        <i class="bi bi-graph-up-arrow me-3"></i> Donor Summary
                    </a>
                    <a href="#personal-info" class="list-group-item list-group-item-action fw-bold d-flex align-items-center">
                        <i class="bi bi-person-vcard me-3"></i> Personal Info
                    </a>
                    <a href="#location-info" class="list-group-item list-group-item-action fw-bold d-flex align-items-center">
                        <i class="bi bi-geo-alt-fill me-3"></i> Location Details
                    </a>
                    <a href="#actions" class="list-group-item list-group-item-action fw-bold d-flex align-items-center">
                        <i class="bi bi-lightning-fill me-3"></i> Quick Actions
                    </a>
                    <a href="{{ route('donor.profile') }}" class="list-group-item list-group-item-action text-primary fw-bold d-flex align-items-center">
                        <i class="bi bi-pencil-square me-3"></i> Edit Profile
                    </a>
                    <a href="{{ route('blood-request.create') }}" class="list-group-item list-group-item-action text-danger fw-bold d-flex align-items-center">
                        <i class="bi bi-megaphone me-3"></i> Post New Request
                    </a>
                </div>
            </div>
        </div>

        {{-- Main Content Column --}}
        <div class="col-lg-9">
            
            {{-- KPI Cards - Clean, high-contrast, modern metric blocks --}}
            <h3 class="fw-bold mb-3" id="kpi-summary">Donor Summary</h3>
            <div class="row">
                <div class="col-md-4 mb-4">
                    {{-- Card 1: Availability Status --}}
                    <div class="card bg-white shadow-sm border-0 rounded-4 h-100">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-heart-pulse-fill display-4 mb-2 {{ $donor->is_available ? 'text-success' : 'text-secondary' }}"></i>
                            <h5 class="card-title text-muted text-uppercase mb-1 small">Availability Status</h5>
                            <h1 class="fw-bold mb-3 {{ $donor->is_available ? 'text-success' : 'text-secondary' }}" id="availabilityText">{{ $donor->is_available ? 'Available' : 'Not Available' }}</h1>
                            
                            {{-- Button/Switch Integration --}}
                            <div class="form-check form-switch d-flex justify-content-center align-items-center gap-3">
                                <label class="form-check-label fw-bold text-muted small" for="dashboard_is_available">
                                    Toggle Status
                                </label>
                                <input 
                                    class="form-check-input" 
                                    type="checkbox" 
                                    name="dashboard_is_available_toggle"
                                    id="dashboard_is_available" 
                                    value="1" 
                                    {{ $donor->is_available ? 'checked' : '' }} 
                                    style="width: 3.5em; height: 1.8em; cursor: pointer;"
                                >
                            </div>
                            
                            <p class="mt-3 mb-0 small text-muted">
                                {{ $donor->is_available ? 'Ready to be contacted for a donation' : 'Marked as unavailable for donation' }}
                            </p>
                            <a href="{{ route('donor.profile') }}" class="btn btn-sm btn-outline-primary mt-3 rounded-pill">Update Status on Profile</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    {{-- Card 2: Last Donation (UPDATED for direct date input and fixed to use POST) --}}
                    <div class="card bg-white shadow-sm border-0 rounded-4 h-100">
                        <form method="POST" action="{{ route('donor.profile.update') }}" id="lastDonationForm">
                            @csrf
                            {{-- Removed @method('PUT') to fix the MethodNotAllowedHttpException --}}
                            <div class="card-body text-center p-4">
                                <i class="bi bi-calendar-check-fill display-4 text-info mb-2"></i>
                                <h5 class="card-title text-muted text-uppercase mb-1 small">Last Donation Date</h5>
                                
                                {{-- Hidden Date Input that will be triggered by the icon --}}
                                <input 
                                    type="date" 
                                    name="last_donation_date" 
                                    id="last_donation_date_input" 
                                    class="form-control text-center d-none" 
                                    value="{{ $donor->last_donation_date?->format('Y-m-d') }}"
                                    max="{{ now()->format('Y-m-d') }}"
                                    style="font-size: 1.5rem; font-weight: bold;"
                                >
                                
                                {{-- Displayed Value and Trigger Button --}}
                                <div class="d-flex justify-content-center align-items-center mb-2" id="last_donation_display">
                                    <h1 class="fw-bold mb-0 text-info me-2">
                                        @if($donor->last_donation_date)
                                            {{ $donor->last_donation_date->format('M d, Y') }}
                                        @else
                                            Never
                                        @endif
                                    </h1>
                                    <button type="button" id="edit_date_btn" class="btn btn-sm btn-outline-info rounded-circle p-0" style="width: 25px; height: 25px; line-height: 1;">
                                        <i class="bi bi-pencil-fill small"></i>
                                    </button>
                                </div>
                                
                                <p class="mb-0 small text-muted" id="last_donation_diff">
                                    @if($donor->last_donation_date)
                                        {{ $donor->last_donation_date->diffForHumans() }} ago
                                    @else
                                        No donation record yet
                                    @endif
                                </p>

                                {{-- Submit/Save Button (Initially Hidden) --}}
                                <button type="submit" id="save_date_btn" class="btn btn-sm btn-info text-white mt-3 rounded-pill d-none">
                                    Save New Date
                                </button>
                                
                                {{-- Placeholder/Fallback Button (Initially Visible) --}}
                                <a href="{{ route('donor.profile') }}" id="default_record_btn" class="btn btn-sm btn-outline-info mt-3 rounded-pill">Record New</a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    {{-- Card 3: Can Donate? (FIXED) --}}
                    <div class="card bg-white shadow-sm border-0 rounded-4 h-100">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-droplet-half display-4 mb-2 {{ $donor->canDonate() ? 'text-danger' : 'text-warning' }}"></i>
                            <h5 class="card-title text-muted text-uppercase mb-1 small">Eligibility</h5>
                            <h1 class="fw-bold mb-2 {{ $donor->canDonate() ? 'text-danger' : 'text-warning' }}">{{ $donor->canDonate() ? 'Yes' : 'Not Yet' }}</h1>
                            <p class="mb-0 small text-muted">
                                @if($donor->canDonate())
                                    You are currently eligible to donate
                                @else
                                    {{-- FIX: Calculate 3 months from last donation and find the difference to now --}}
                                    @php
                                        // Use copy() to safely modify the date, and check if it exists before calling methods
                                        $nextDonationDate = $donor->last_donation_date?->copy()->addMonths(3); 
                                        $remainingTime = $nextDonationDate ? now()->diffForHumans($nextDonationDate, \Carbon\CarbonInterface::DIFF_ABSOLUTE) : 'N/A';
                                    @endphp
                                    Wait period: {{ $remainingTime }} remaining 
                                @endif
                            </p>
                            <span class="btn btn-sm btn-outline-secondary mt-3 rounded-pill invisible">...</span> {{-- Placeholder to match height --}}
                        </div>
                    </div>
                </div>
            </div>
            
            <hr class="my-4">

            {{-- Personal Information Table --}}
            <h3 class="fw-bold mb-3" id="personal-info">Personal Information</h3>
            <div class="card shadow border-0 rounded-4 mb-4">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <span class="fw-bold text-muted w-50"><i class="bi bi-envelope me-2 text-primary"></i> Email:</span>
                        <span class="w-50 text-end text-break">{{ $donor->email }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <span class="fw-bold text-muted w-50"><i class="bi bi-phone me-2 text-primary"></i> Phone:</span>
                        <span class="w-50 text-end">{{ $donor->phone }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <span class="fw-bold text-muted w-50"><i class="bi bi-droplet me-2 text-primary"></i> Blood Type:</span>
                        <span class="badge bg-danger fs-6 fw-bold p-2 w-50 text-end">{{ $donor->blood_type }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <span class="fw-bold text-muted w-50"><i class="bi bi-calendar-event me-2 text-primary"></i> Member Since:</span>
                        <span class="w-50 text-end">{{ $donor->created_at->format('M d, Y') }} ({{ $donor->created_at->diffForHumans() }})</span>
                    </li>
                </ul>
            </div>
            
            <hr class="my-4">

            {{-- Location Details Table --}}
            <h3 class="fw-bold mb-3" id="location-info">Location Details</h3>
            <div class="card shadow border-0 rounded-4 mb-4">
                <ul class="list-group list-group-flush">
                     <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <span class="fw-bold text-muted w-50"><i class="bi bi-map me-2 text-primary"></i> Division:</span>
                        <span class="w-50 text-end">{{ $donor->division }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <span class="fw-bold text-muted w-50"><i class="bi bi-house me-2 text-primary"></i> District:</span>
                        <span class="w-50 text-end">{{ $donor->district }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <span class="fw-bold text-muted w-50"><i class="bi bi-pin me-2 text-primary"></i> Upazila:</span>
                        <span class="w-50 text-end">{{ $donor->upazila }}</span>
                    </li>
                    <li class="list-group-item d-flex p-3">
                        <span class="fw-bold text-muted me-3 w-25"><i class="bi bi-signpost me-2 text-primary"></i> Address:</span>
                        <span class="text-end flex-fill text-break">{{ $donor->address }}</span>
                    </li>
                </ul>
            </div>
            
            <hr class="my-4">

            {{-- Quick Actions --}}
            <h3 class="fw-bold mb-3" id="actions">Quick Actions</h3>
            <div class="card shadow border-0 rounded-4 mb-4">
                <div class="card-body p-4">
                    <div class="row row-cols-2 row-cols-md-4 g-3">
                        <div class="col">
                            <a href="{{ route('home') }}" class="btn btn-outline-primary w-100 py-3 rounded-3 fw-bold">
                                <i class="bi bi-search d-block fs-4 mb-1"></i> Find Donors
                            </a>
                        </div>
                        <div class="col">
                            <a href="{{ route('blood-request.create') }}" class="btn btn-danger w-100 py-3 rounded-3 fw-bold">
                                <i class="bi bi-megaphone-fill d-block fs-4 mb-1"></i> Request Blood
                            </a>
                        </div>
                        <div class="col">
                            <a href="{{ route('blood-request.my-requests') }}" class="btn btn-outline-info w-100 py-3 rounded-3 fw-bold">
                                <i class="bi bi-clipboard-check-fill d-block fs-4 mb-1"></i> My Requests
                            </a>
                        </div>
                        <div class="col">
                            <a href="{{ route('donor.profile') }}" class="btn btn-outline-success w-100 py-3 rounded-3 fw-bold">
                                <i class="bi bi-pencil-fill d-block fs-4 mb-1"></i> Update Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Logout Button --}}
            <div class="row">
                <div class="col-12">
                    <form method="POST" action="{{ route('donor.logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-dark w-100 btn-lg rounded-3 fw-bold mb-5">
                            <i class="bi bi-box-arrow-right me-2"></i> Secure Logout
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const availabilitySwitch = document.getElementById('dashboard_is_available');
    const availabilityText = document.getElementById('availabilityText');
    
    // --- Availability Toggle Logic (Existing) ---
    function updateAvailabilityDisplay(isChecked) {
        // Toggle the text content
        availabilityText.textContent = isChecked ? 'Available' : 'Not Available';

        // Toggle text color class
        availabilityText.classList.toggle('text-success', isChecked);
        availabilityText.classList.toggle('text-secondary', !isChecked);

        // Toggle icon color class
        const icon = availabilitySwitch.closest('.card-body').querySelector('.bi-heart-pulse-fill');
        icon.classList.toggle('text-success', isChecked);
        icon.classList.toggle('text-secondary', !isChecked);
    }
    
    // Attach event listener to the switch
    availabilitySwitch.addEventListener('change', function() {
        updateAvailabilityDisplay(this.checked);
        
        // NOTE: The form submission logic was removed as the route 
        // ('donor.profile.updateAvailability') is not defined in the provided 
        // files. To actually update the status in the database, a user must 
        // visit the full profile page OR a dedicated AJAX endpoint needs 
        // to be set up.
        console.log('Availability toggled. Please click "Update Status on Profile" to make it permanent.');
    });

    // Initialize display state on load
    updateAvailabilityDisplay(availabilitySwitch.checked);


    // --- Last Donation Quick Update Logic (NEW) ---
    const lastDonationInput = document.getElementById('last_donation_date_input');
    const lastDonationDisplay = document.getElementById('last_donation_display');
    const editDateBtn = document.getElementById('edit_date_btn');
    const saveDateBtn = document.getElementById('save_date_btn');
    const defaultRecordBtn = document.getElementById('default_record_btn');
    
    editDateBtn.addEventListener('click', function() {
        // Hide display and "Record New" button
        lastDonationDisplay.classList.add('d-none');
        defaultRecordBtn.classList.add('d-none');
        
        // Show the date input and "Save" button
        lastDonationInput.classList.remove('d-none');
        saveDateBtn.classList.remove('d-none');
        
        // Focus the input to open the date picker immediately
        lastDonationInput.focus();
        
        // Ensure the input field value is set correctly when opened, 
        // so clicking 'Save' without changing the date still works.
        lastDonationInput.value = lastDonationInput.value || '{{ $donor->last_donation_date?->format('Y-m-d') }}';
    });
    
    // Optional: Hide input if user clicks away or presses escape (better UX)
    lastDonationInput.addEventListener('blur', function() {
        // We will only hide if the input is empty (meaning they effectively canceled the change)
        if (lastDonationInput.value === '') {
            // Revert display to original state
            lastDonationInput.classList.add('d-none');
            saveDateBtn.classList.add('d-none');
            lastDonationDisplay.classList.remove('d-none');
            defaultRecordBtn.classList.remove('d-none');
        }
    });

    // Submitting the form will send only the 'last_donation_date' field, 
    // which should be handled by the controller's update logic.

});
</script>
@endpush


@endsection