@extends('layouts.app')

@section('title', 'Find Blood Donors')

@section('content')
<div class="hero text-center">
    <div class="container">
        <h1 class="display-4 fw-bold">Find Blood Donors Near You</h1>
        <p class="lead">Connect with donors and save lives</p>
        <div class="mt-3">
            <a href="{{ route('donor.register') }}" class="btn btn-light btn-lg me-2">
                <i class="bi bi-person-plus-fill"></i> Become a Donor
            </a>
            @auth('web')
                <a href="{{ route('donor.dashboard') }}" class="btn btn-outline-light btn-lg">
                    <i class="bi bi-speedometer2"></i> My Dashboard
                </a>
            @else
                <a href="{{ route('donor.login') }}" class="btn btn-outline-light btn-lg">
                    <i class="bi bi-box-arrow-in-right"></i> Donor Login
                </a>
            @endauth
        </div>
    </div>
</div>

<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title mb-3"><i class="bi bi-funnel-fill"></i> Search for Donors</h5>
            <form method="GET" action="{{ route('home') }}" id="searchForm">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Blood Type</label>
                        <select name="blood_type" class="form-select">
                            <option value="">All Blood Types</option>
                            @foreach($bloodTypes as $type)
                                <option value="{{ $type }}" {{ request('blood_type') == $type ? 'selected' : '' }}>
                                    {{ $type }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Division</label>
                        <select name="division" id="division" class="form-select">
                            <option value="">All Divisions</option>
                            @foreach($divisions as $division)
                                <option value="{{ $division }}" {{ request('division') == $division ? 'selected' : '' }}>
                                    {{ $division }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">District</label>
                        <select name="district" id="district" class="form-select">
                            <option value="">All Districts</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Upazila</label>
                        <select name="upazila" id="upazila" class="form-select">
                            <option value="">All Upazilas</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small">&nbsp;</label>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="bi bi-search"></i> Search
                            </button>
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary" title="Clear filters">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">
            <i class="bi bi-people-fill"></i> Available Donors 
            <span class="badge bg-danger">{{ $donors->total() }}</span>
        </h4>
        @if(request()->hasAny(['blood_type', 'division', 'district', 'upazila']))
            <span class="badge bg-info">
                <i class="bi bi-funnel-fill"></i> Filters Active
            </span>
        @endif
    </div>
    
    @forelse($donors as $donor)
        <div class="card mb-3 shadow-sm hover-shadow">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-2 text-center">
                        <div class="blood-icon">{{ $donor->blood_type }}</div>
                    </div>
                    <div class="col-md-7">
                        <h5 class="mb-2">{{ $donor->name }}</h5>
                        <p class="mb-1 text-muted">
                            <i class="bi bi-geo-alt-fill text-danger"></i> 
                            {{ $donor->upazila }}, {{ $donor->district }}, {{ $donor->division }}
                        </p>
                        @if($donor->last_donation_date)
                            <small class="text-muted">
                                <i class="bi bi-calendar-check-fill text-warning"></i> 
                                Last donated: {{ $donor->last_donation_date->diffForHumans() }}
                                @if($donor->canDonate())
                                    <span class="badge bg-success ms-2">Can donate now</span>
                                @else
                                    <span class="badge bg-warning text-dark ms-2">Not eligible yet</span>
                                @endif
                            </small>
                        @else
                            <small class="text-success">
                                <i class="bi bi-star-fill"></i> Never donated before
                            </small>
                        @endif
                    </div>
                    <div class="col-md-3 text-end">
                        <a href="tel:{{ $donor->phone }}" class="btn btn-success btn-lg">
                            <i class="bi bi-telephone-fill"></i> Call Now
                        </a>
                        <small class="d-block text-muted mt-1">{{ $donor->phone }}</small>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="card shadow-sm">
            <div class="card-body text-center py-5">
                <i class="bi bi-search display-1 text-muted mb-3"></i>
                <h5 class="text-muted">No Donors Found</h5>
                <p class="text-muted mb-3">
                    @if(request()->hasAny(['blood_type', 'division', 'district', 'upazila']))
                        No donors match your search criteria. Try adjusting your filters.
                    @else
                        No donors are currently registered in the system.
                    @endif
                </p>
                <div class="d-flex gap-2 justify-content-center">
                    @if(request()->hasAny(['blood_type', 'division', 'district', 'upazila']))
                        <a href="{{ route('home') }}" class="btn btn-outline-primary">
                            <i class="bi bi-x-circle"></i> Clear Filters
                        </a>
                    @endif
                    <a href="{{ route('donor.register') }}" class="btn btn-danger">
                        <i class="bi bi-person-plus-fill"></i> Register as First Donor
                    </a>
                </div>
            </div>
        </div>
    @endforelse

    @if($donors->hasPages())
        <div class="mt-4">
            {{ $donors->appends(request()->query())->links() }}
        </div>
    @endif
</div>

<style>
.hover-shadow {
    transition: all 0.3s ease;
}

.hover-shadow:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Store old values for restoring on page load
    const oldDivision = '{{ request('division') }}';
    const oldDistrict = '{{ request('district') }}';
    const oldUpazila = '{{ request('upazila') }}';

    const divisionSelect = document.getElementById('division');
    const districtSelect = document.getElementById('district');
    const upazilaSelect = document.getElementById('upazila');

    // Helper function to show loading state
    function setLoading(element, isLoading, text = 'Loading...') {
        if (isLoading) {
            element.disabled = true;
            element.innerHTML = `<option value="">${text}</option>`;
        } else {
            element.disabled = false;
        }
    }

    // Helper function to show error
    function showError(message) {
        console.error(message);
        // You could also show a toast notification here
    }

    // Load districts when division changes
    divisionSelect.addEventListener('change', function() {
        const division = this.value;
        loadDistricts(division);
    });

    // Load upazilas when district changes
    districtSelect.addEventListener('change', function() {
        const district = this.value;
        loadUpazilas(district);
    });

    function loadDistricts(division) {
        districtSelect.innerHTML = '<option value="">All Districts</option>';
        upazilaSelect.innerHTML = '<option value="">All Upazilas</option>';
        
        if (!division) {
            return;
        }

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

                districtSelect.innerHTML = '<option value="">All Districts</option>';
                data.forEach(district => {
                    const option = new Option(district, district, false, district === oldDistrict);
                    districtSelect.add(option);
                });
                
                setLoading(districtSelect, false);

                // If there was an old district value, select it and load upazilas
                if (oldDistrict && divisionSelect.value === oldDivision) {
                    districtSelect.value = oldDistrict;
                    loadUpazilas(oldDistrict);
                }
            })
            .catch(error => {
                showError('Error loading districts: ' + error.message);
                districtSelect.innerHTML = '<option value="">Error loading districts</option>';
                setLoading(districtSelect, false);
            });
    }

    function loadUpazilas(district) {
        upazilaSelect.innerHTML = '<option value="">All Upazilas</option>';
        
        if (!district) {
            return;
        }

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

                upazilaSelect.innerHTML = '<option value="">All Upazilas</option>';
                data.forEach(upazila => {
                    const option = new Option(upazila, upazila, false, upazila === oldUpazila);
                    upazilaSelect.add(option);
                });
                
                setLoading(upazilaSelect, false);

                // If there was an old upazila value, select it
                if (oldUpazila && districtSelect.value === oldDistrict) {
                    upazilaSelect.value = oldUpazila;
                }
            })
            .catch(error => {
                showError('Error loading upazilas: ' + error.message);
                upazilaSelect.innerHTML = '<option value="">Error loading upazilas</option>';
                setLoading(upazilaSelect, false);
            });
    }

    // Initialize on page load if there's a selected division
    if (oldDivision) {
        loadDistricts(oldDivision);
    }
});
</script>
@endpush
@endsection