@extends('layouts.app')

@section('title', 'Donor Dashboard')

@section('content')
<div class="container mt-5 mb-5 pt-3">
    
    {{-- Main Welcome Card --}}
    <div class="card shadow border-0 mb-4 rounded-4 bg-danger bg-gradient text-white">
        <div class="card-body p-4">
            @if(session('success'))
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
        {{-- Side Navigation --}}
        <div class="col-lg-3 mb-4 d-none d-lg-block">
            <div class="card shadow-sm border-0 rounded-4 sticky-top" style="top: 80px;">
                <div class="card-header bg-light border-0 rounded-top-4 py-3">
                    <h5 class="mb-0 text-dark fw-bold"><i class="bi bi-list me-2"></i> Quick Menu</h5>
                </div>
                <div class="list-group list-group-flush">
                    <a href="#kpi-summary" class="list-group-item list-group-item-action fw-bold d-flex align-items-center">
                        <i class="bi bi-graph-up-arrow me-3"></i> Donor Summary
                    </a>
                    <a href="#bmi-section" class="list-group-item list-group-item-action fw-bold d-flex align-items-center">
                        <i class="bi bi-heart-pulse me-3"></i> BMI & Health
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
            
            {{-- KPI Cards --}}
            <h3 class="fw-bold mb-3" id="kpi-summary">Donor Summary</h3>
            <div class="row">
                <div class="col-md-4 mb-4">
                    {{-- Card 1: Availability Status --}}
                    <div class="card bg-white shadow-sm border-0 rounded-4 h-100">
                        <form method="POST" action="{{ route('donor.profile.update') }}" id="availabilityForm">
                            @csrf
                            
                            <input type="hidden" name="name" value="{{ $donor->name }}">
                            <input type="hidden" name="phone" value="{{ $donor->phone }}">
                            <input type="hidden" name="blood_type" value="{{ $donor->blood_type }}">
                            <input type="hidden" name="division" value="{{ $donor->division }}">
                            <input type="hidden" name="district" value="{{ $donor->district }}">
                            <input type="hidden" name="upazila" value="{{ $donor->upazila }}">
                            <input type="hidden" name="address" value="{{ $donor->address }}">
                            <input type="hidden" name="last_donation_date" value="{{ $donor->last_donation_date?->format('Y-m-d') }}">
                            <input type="hidden" name="gender" value="{{ $donor->gender }}">
                            <input type="hidden" name="height_cm" value="{{ $donor->height_cm }}">
                            <input type="hidden" name="weight_kg" value="{{ $donor->weight_kg }}">
                            <input type="hidden" name="age" value="{{ $donor->age }}">

                            <div class="card-body text-center p-4">
                                <i class="bi bi-heart-pulse-fill display-4 mb-2 {{ $donor->is_available ? 'text-success' : 'text-secondary' }}"></i>
                                <h5 class="card-title text-muted text-uppercase mb-1 small">Availability Status</h5>
                                <h1 class="fw-bold mb-3 {{ $donor->is_available ? 'text-success' : 'text-secondary' }}" id="availabilityText">{{ $donor->is_available ? 'Available' : 'Not Available' }}</h1>
                                
                                <div class="form-check form-switch d-flex justify-content-center align-items-center gap-3">
                                    <label class="form-check-label fw-bold text-muted small" for="dashboard_is_available">
                                        Toggle Status
                                    </label>
                                    <input 
                                        class="form-check-input" 
                                        type="checkbox" 
                                        name="is_available"
                                        id="dashboard_is_available" 
                                        value="1" 
                                        {{ $donor->is_available ? 'checked' : '' }} 
                                        style="width: 3.5em; height: 1.8em; cursor: pointer;"
                                        onchange="document.getElementById('availabilityForm').submit()"
                                    >
                                </div>
                                
                                <p class="mt-3 mb-0 small text-muted">
                                    {{ $donor->is_available ? 'Ready to be contacted for a donation' : 'Marked as unavailable for donation' }}
                                </p>
                                <a href="{{ route('donor.profile') }}" class="btn btn-sm btn-outline-primary mt-3 rounded-pill">Edit Full Profile</a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    {{-- Card 2: Last Donation --}}
                    <div class="card bg-white shadow-sm border-0 rounded-4 h-100">
                        <form method="POST" action="{{ route('donor.profile.update') }}" id="lastDonationForm">
                            @csrf
                            
                            <input type="hidden" name="name" value="{{ $donor->name }}">
                            <input type="hidden" name="phone" value="{{ $donor->phone }}">
                            <input type="hidden" name="blood_type" value="{{ $donor->blood_type }}">
                            <input type="hidden" name="division" value="{{ $donor->division }}">
                            <input type="hidden" name="district" value="{{ $donor->district }}">
                            <input type="hidden" name="upazila" value="{{ $donor->upazila }}">
                            <input type="hidden" name="address" value="{{ $donor->address }}">
                            <input type="hidden" name="is_available" value="{{ $donor->is_available ? 1 : 0 }}">
                            <input type="hidden" name="gender" value="{{ $donor->gender }}">
                            <input type="hidden" name="height_cm" value="{{ $donor->height_cm }}">
                            <input type="hidden" name="weight_kg" value="{{ $donor->weight_kg }}">
                            <input type="hidden" name="age" value="{{ $donor->age }}">

                            <div class="card-body text-center p-4">
                                <i class="bi bi-calendar-check-fill display-4 text-info mb-2"></i>
                                <h5 class="card-title text-muted text-uppercase mb-1 small">Last Donation Date</h5>
                                
                                <input 
                                    type="date" 
                                    name="last_donation_date" 
                                    id="last_donation_date_input" 
                                    class="form-control text-center d-none" 
                                    value="{{ $donor->last_donation_date?->format('Y-m-d') }}"
                                    max="{{ now()->format('Y-m-d') }}"
                                    style="font-size: 1.5rem; font-weight: bold;"
                                >
                                
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
                                        {{ $donor->last_donation_date->diffForHumans() }}
                                    @else
                                        No donation record yet
                                    @endif
                                </p>

                                <button type="submit" id="save_date_btn" class="btn btn-sm btn-info text-white mt-3 rounded-pill d-none">
                                    Save New Date
                                </button>
                                
                                <a href="{{ route('donor.profile') }}" id="default_record_btn" class="btn btn-sm btn-outline-info mt-3 rounded-pill">Record New</a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    {{-- Card 3: Can Donate? --}}
                    <div class="card bg-white shadow-sm border-0 rounded-4 h-100">
                        <div class="card-body text-center p-4">
                            @php
                                $canDonate = $donor->canDonate();
                                $missingInfo = !$donor->gender || !$donor->height_cm || !$donor->weight_kg || !$donor->age;
                            @endphp
                            <i class="bi bi-droplet-half display-4 mb-2 
                                {{ $canDonate && !$missingInfo ? 'text-danger' : ($missingInfo ? 'text-info' : 'text-warning') }}"></i>
                            
                            <h5 class="card-title text-muted text-uppercase mb-1 small">Eligibility</h5>
                            <h1 class="fw-bold mb-2 
                                {{ $canDonate && !$missingInfo ? 'text-danger' : ($missingInfo ? 'text-info' : 'text-warning') }}">
                                {{ $canDonate && !$missingInfo ? 'Yes' : ($missingInfo ? 'Incomplete' : 'Not Yet') }}
                            </h1>
                            <p class="mb-0 small text-muted">
                                @if($missingInfo)
                                    Please complete your profile (Gender, Age, Height, & Weight) to confirm eligibility.
                                @elseif($canDonate)
                                    You are currently eligible to donate.
                                @else
                                    @php
                                        $nextDonationDate = $donor->last_donation_date?->copy()->addMonths(3); 
                                        $remainingTime = $nextDonationDate ? now()->diffForHumans($nextDonationDate, \Carbon\CarbonInterface::DIFF_ABSOLUTE) : 'N/A';
                                    @endphp
                                    Wait period: {{ $remainingTime }} remaining.
                                @endif
                            </p>
                            <a href="{{ route('donor.profile') }}" class="btn btn-sm btn-outline-{{ $missingInfo ? 'info' : 'secondary' }} mt-3 rounded-pill">
                                {{ $missingInfo ? 'Complete Profile' : 'View Profile Details' }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr class="my-4">

            {{-- BMI & Health Section --}}
            <h3 class="fw-bold mb-3" id="bmi-section"><i class="bi bi-heart-pulse me-2 text-danger"></i> BMI & Health Information</h3>
            @if($donor->getBMI())
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <div class="card shadow-sm border-0 rounded-4 h-100">
                            <div class="card-body text-center p-4">
                                <i class="bi bi-speedometer2 display-4 text-{{ $donor->getBMIColor() }} mb-3"></i>
                                <h5 class="card-title text-muted text-uppercase mb-1 small">Your BMI</h5>
                                <h1 class="fw-bold text-{{ $donor->getBMIColor() }} mb-2">{{ $donor->getBMI() }}</h1>
                                <span class="badge bg-{{ $donor->getBMIColor() }} fs-6 p-2">{{ $donor->getBMICategory() }}</span>
                                
                                <div class="mt-4">
                                    <div class="progress" style="height: 25px;">
                                        @php
                                            $bmi = $donor->getBMI();
                                            $percentage = min(($bmi / 40) * 100, 100);
                                        @endphp
                                        <div class="progress-bar bg-{{ $donor->getBMIColor() }}" role="progressbar" 
                                             style="width: {{ $percentage }}%;" 
                                             aria-valuenow="{{ $bmi }}" aria-valuemin="0" aria-valuemax="40">
                                            {{ $bmi }}
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2 small text-muted">
                                        <span>18.5</span>
                                        <span>25</span>
                                        <span>30</span>
                                        <span>40+</span>
                                    </div>
                                </div>
                                
                                <p class="mt-3 mb-0 small text-muted">
                                    @if($donor->getBMICategory() === 'Normal')
                                        <i class="bi bi-check-circle-fill text-success"></i> Your BMI is in the healthy range!
                                    @elseif($donor->getBMICategory() === 'Underweight')
                                        <i class="bi bi-info-circle-fill text-warning"></i> Consider gaining weight for optimal health.
                                    @elseif($donor->getBMICategory() === 'Overweight')
                                        <i class="bi bi-exclamation-triangle-fill text-warning"></i> Consider maintaining a healthy weight.
                                    @else
                                        <i class="bi bi-exclamation-circle-fill text-danger"></i> Please consult a healthcare provider.
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <div class="card shadow-sm border-0 rounded-4 h-100">
                            <div class="card-body p-4">
                                <h5 class="mb-3 fw-bold text-primary"><i class="bi bi-info-circle me-2"></i> BMI Categories</h5>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2 pb-2 border-bottom">
                                        <span class="badge bg-warning text-dark me-2">Underweight</span> 
                                        <span class="text-muted">BMI < 18.5</span>
                                    </li>
                                    <li class="mb-2 pb-2 border-bottom">
                                        <span class="badge bg-success me-2">Normal</span> 
                                        <span class="text-muted">BMI 18.5 - 24.9</span>
                                    </li>
                                    <li class="mb-2 pb-2 border-bottom">
                                        <span class="badge bg-warning text-dark me-2">Overweight</span> 
                                        <span class="text-muted">BMI 25 - 29.9</span>
                                    </li>
                                    <li class="mb-0">
                                        <span class="badge bg-danger me-2">Obese</span> 
                                        <span class="text-muted">BMI ≥ 30</span>
                                    </li>
                                </ul>
                                
                                <div class="alert alert-info mt-3 mb-0 rounded-3" role="alert">
                                    <i class="bi bi-lightbulb-fill me-2"></i>
                                    <small><strong>Note:</strong> BMI is a screening tool. Consult healthcare providers for complete health assessment.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-warning rounded-3 d-flex align-items-center" role="alert">
                    <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>
                    <div>
                        <h5 class="alert-heading mb-1">BMI Not Available</h5>
                        <p class="mb-0">Please update your age, height and weight in your profile to see your BMI calculation.</p>
                    </div>
                    <a href="{{ route('donor.profile') }}" class="btn btn-warning ms-auto">Update Now</a>
                </div>
            @endif

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
                        <span class="fw-bold text-muted w-50"><i class="bi bi-gender-ambiguous me-2 text-primary"></i> Gender:</span>
                        <span class="w-50 text-end">{{ $donor->gender ?? 'N/A' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <span class="fw-bold text-muted w-50"><i class="bi bi-cake2 me-2 text-primary"></i> Age:</span>
                        <span class="w-50 text-end">{{ $donor->age ? $donor->age . ' years' : 'N/A' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <span class="fw-bold text-muted w-50"><i class="bi bi-arrow-bar-up me-2 text-primary"></i> Height:</span>
                        <span class="w-50 text-end">{{ $donor->getHeightInFeetAndInches() }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <span class="fw-bold text-muted w-50"><i class="bi bi-clipboard-data me-2 text-primary"></i> Weight:</span>
                        <span class="w-50 text-end">{{ $donor->weight_kg ? $donor->weight_kg . ' kg' : 'N/A' }}</span>
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
    
    function updateAvailabilityDisplay(isChecked) {
        availabilityText.textContent = isChecked ? 'Available' : 'Not Available';
        availabilityText.classList.toggle('text-success', isChecked);
        availabilityText.classList.toggle('text-secondary', !isChecked);

        const icon = availabilitySwitch.closest('.card-body').querySelector('.bi-heart-pulse-fill');
        icon.classList.toggle('text-success', isChecked);
        icon.classList.toggle('text-secondary', !isChecked);
    }
    
    availabilitySwitch.addEventListener('change', function() {
        updateAvailabilityDisplay(this.checked);
    });

    updateAvailabilityDisplay(availabilitySwitch.checked);

    const lastDonationInput = document.getElementById('last_donation_date_input');
    const lastDonationDisplay = document.getElementById('last_donation_display');
    const editDateBtn = document.getElementById('edit_date_btn');
    const saveDateBtn = document.getElementById('save_date_btn');
    const defaultRecordBtn = document.getElementById('default_record_btn');
    
    editDateBtn.addEventListener('click', function() {
        lastDonationDisplay.classList.add('d-none');
        defaultRecordBtn.classList.add('d-none');
        lastDonationInput.classList.remove('d-none');
        saveDateBtn.classList.remove('d-none');
        lastDonationInput.focus();
        lastDonationInput.value = lastDonationInput.value || '{{ $donor->last_donation_date?->format('Y-m-d') }}';
    });
    
    lastDonationInput.addEventListener('blur', function() {
        if (lastDonationInput.value === '') {
            lastDonationInput.classList.add('d-none');
            saveDateBtn.classList.add('d-none');
            lastDonationDisplay.classList.remove('d-none');
            defaultRecordBtn.classList.remove('d-none');
        }
    });
});
</script>
@endpush

@endsection