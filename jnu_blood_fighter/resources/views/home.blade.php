@extends('layouts.app')

@section('title', 'Find Blood Donors')

@section('content')
<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 text-center text-lg-start">
                <h1 class="hero-title">Find Blood Donors <span class="text-highlight">Near You</span></h1>
                <p class="hero-subtitle">Connect with life-savers in your community. Every donation counts.</p>
                <div class="hero-actions">
                    @auth('web')
                        <a href="{{ route('donor.dashboard') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-speedometer2"></i> My Dashboard
                        </a>
                        <a href="{{ route('blood-request.create') }}" class="btn btn-outline-primary btn-lg">
                            <i class="bi bi-megaphone-fill"></i> Request Blood
                        </a>
                    @else
                        <a href="{{ route('donor.register') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-heart-fill"></i> Become a Donor
                        </a>
                        <a href="{{ route('donor.login') }}" class="btn btn-outline-primary btn-lg">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </a>
                    @endauth
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block">
                <div class="hero-illustration">
                    <div class="floating-card">
                        <i class="bi bi-droplet-fill"></i>
                        <span>Save Lives</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container main-content">
    <!-- Alerts -->
    @if(session('success'))
        <div class="alert alert-success alert-modern" role="alert">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-modern" role="alert">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <span>{{ session('error') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Search Section -->
    <div class="search-section">
        <div class="section-header">
            <h2 class="section-title">
                <i class="bi bi-search"></i> Find Donors
            </h2>
            <p class="section-subtitle">Filter by blood type and location</p>
        </div>

        <div class="search-card">
            <form method="GET" action="{{ route('home') }}" id="searchForm">
                <div class="row g-3">
                    <div class="col-md-3 col-sm-6">
                        <label class="form-label">Blood Type</label>
                        <select name="blood_type" class="form-select form-control-modern">
                            <option value="">All Types</option>
                            @foreach($bloodTypes as $type)
                                <option value="{{ $type }}" {{ request('blood_type') == $type ? 'selected' : '' }}>
                                    {{ $type }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <label class="form-label">Division</label>
                        <select name="division" id="division" class="form-select form-control-modern">
                            <option value="">All Divisions</option>
                            @foreach($divisions as $division)
                                <option value="{{ $division }}" {{ request('division') == $division ? 'selected' : '' }}>
                                    {{ $division }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 col-sm-6">
                        <label class="form-label">District</label>
                        <select name="district" id="district" class="form-select form-control-modern">
                            <option value="">All Districts</option>
                        </select>
                    </div>
                    <div class="col-md-2 col-sm-6">
                        <label class="form-label">Upazila</label>
                        <select name="upazila" id="upazila" class="form-select form-control-modern">
                            <option value="">All Upazilas</option>
                        </select>
                    </div>
                    <div class="col-md-2 col-12">
                        <label class="form-label d-none d-md-block">&nbsp;</label>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary flex-grow-1">
                                <i class="bi bi-search"></i> Search
                            </button>
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary" title="Clear">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Donors Section -->
    <div class="donors-section">
        <div class="section-header">
            <div class="d-flex align-items-center gap-3 flex-wrap">
                <h2 class="section-title mb-0">
                    <i class="bi bi-people-fill"></i> Available Donors
                </h2>
                <span class="badge-count">{{ $donors->total() }}</span>
                @if(request()->hasAny(['blood_type', 'division', 'district', 'upazila']))
                    <span class="badge badge-filter">
                        <i class="bi bi-funnel-fill"></i> Filtered
                    </span>
                @endif
            </div>
        </div>

        @forelse($donors as $donor)
            <div class="donor-card">
                <div class="donor-blood-type">
                    <div class="blood-badge">{{ $donor->blood_type }}</div>
                    @if($donor->canDonate())
                        <span class="status-badge status-ready">Ready</span>
                    @else
                        <span class="status-badge status-wait">Wait</span>
                    @endif
                </div>
                
                <div class="donor-info">
                    <h3 class="donor-name">{{ $donor->name }}</h3>
                    <div class="donor-location">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>{{ $donor->upazila }}, {{ $donor->district }}, {{ $donor->division }}</span>
                    </div>
                    
                    @if($donor->last_donation_date)
                        <div class="donor-meta">
                            <i class="bi bi-calendar-check-fill"></i>
                            <span>Last donated {{ $donor->last_donation_date->diffForHumans() }}</span>
                        </div>
                        @if($donor->canDonate())
                            <div class="donor-status-text success">
                                <i class="bi bi-check-circle-fill"></i> Eligible to donate now
                            </div>
                        @else
                            <div class="donor-status-text warning">
                                <i class="bi bi-clock-fill"></i> Will be eligible soon
                            </div>
                        @endif
                    @else
                        <div class="donor-status-text new">
                            <i class="bi bi-star-fill"></i> First time donor
                        </div>
                    @endif
                </div>

                <div class="donor-action">
                    <a href="tel:{{ $donor->phone }}" class="btn btn-success btn-call">
                        <i class="bi bi-telephone-fill"></i>
                        <span class="d-none d-sm-inline">Call Now</span>
                    </a>
                    <small class="phone-number">{{ $donor->phone }}</small>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <i class="bi bi-search"></i>
                <h3>No Donors Found</h3>
                <p>
                    @if(request()->hasAny(['blood_type', 'division', 'district', 'upazila']))
                        No donors match your search criteria. Try adjusting your filters.
                    @else
                        No donors are currently registered in the system.
                    @endif
                </p>
                <div class="empty-actions">
                    @if(request()->hasAny(['blood_type', 'division', 'district', 'upazila']))
                        <a href="{{ route('home') }}" class="btn btn-outline-primary">
                            <i class="bi bi-x-circle"></i> Clear Filters
                        </a>
                    @endif
                    <a href="{{ route('donor.register') }}" class="btn btn-primary">
                        <i class="bi bi-person-plus-fill"></i> Register as Donor
                    </a>
                </div>
            </div>
        @endforelse

        @if($donors->hasPages())
            <div class="pagination-wrapper">
                <nav aria-label="Donors pagination">
                    {{ $donors->appends(request()->query())->links() }}
                </nav>
            </div>
        @endif
    </div>

    <!-- Blood Requests Section -->
    @if($bloodRequests->count() > 0)
        <div class="requests-section">
            <div class="section-header">
                <div class="d-flex align-items-center gap-3 flex-wrap">
                    <h2 class="section-title mb-0">
                        <i class="bi bi-megaphone-fill"></i> Urgent Blood Requests
                    </h2>
                    <span class="badge-count emergency">{{ $bloodRequests->total() }}</span>
                    @if(request()->hasAny(['blood_type', 'division', 'district', 'upazila']))
                        <span class="badge badge-filter">
                            <i class="bi bi-funnel-fill"></i> Filtered
                        </span>
                    @endif
                </div>
            </div>

            <div class="row g-4">
                @foreach($bloodRequests as $request)
                    <div class="col-lg-6">
                        <div class="request-card {{ $request->is_emergency ? 'emergency' : ($request->isUrgent() ? 'urgent' : '') }}">
                            @if($request->is_emergency)
                                <div class="request-badge emergency">
                                    <i class="bi bi-exclamation-triangle-fill"></i> EMERGENCY
                                </div>
                            @elseif($request->isUrgent())
                                <div class="request-badge urgent">
                                    <i class="bi bi-clock-fill"></i> URGENT
                                </div>
                            @endif

                            <div class="request-content">
                                <div class="request-header">
                                    <div class="blood-badge-compact">{{ $request->blood_type }}</div>
                                    <span class="blood-quantity-compact">{{ $request->blood_quantity }} bag(s)</span>
                                </div>

                                <div class="request-info">
                                    <h3 class="request-patient">{{ $request->patient_name }}</h3>
                                    
                                    <div class="request-detail">
                                        <i class="bi bi-heart-pulse-fill"></i>
                                        <span><strong>Reason:</strong> {{ $request->disease }}</span>
                                    </div>
                                    
                                    <div class="request-detail">
                                        <i class="bi bi-hospital-fill"></i>
                                        <span><strong>Hospital:</strong> {{ $request->hospital_name }}</span>
                                    </div>
                                    
                                    <div class="request-detail">
                                        <i class="bi bi-geo-alt-fill"></i>
                                        <span>{{ $request->hospital_location }}, {{ $request->upazila }}, {{ $request->district }}</span>
                                    </div>

                                    @if(!$request->is_emergency && $request->needed_date)
                                        <div class="request-detail">
                                            <i class="bi bi-calendar-event-fill"></i>
                                            <span>
                                                <strong>Needed:</strong> {{ $request->needed_date->format('M d, Y h:i A') }}
                                                <small class="text-muted d-block ms-4">({{ $request->needed_date->diffForHumans() }})</small>
                                            </span>
                                        </div>
                                    @endif

                                    @if($request->additional_notes)
                                        <div class="request-notes-compact">
                                            <i class="bi bi-info-circle-fill"></i>
                                            <span>{{ Str::limit($request->additional_notes, 100) }}</span>
                                        </div>
                                    @endif

                                    <div class="request-footer">
                                        <a href="tel:{{ $request->contact_number }}" class="btn btn-success">
                                            <i class="bi bi-telephone-fill"></i> {{ $request->contact_number }}
                                        </a>
                                        <span class="request-time">{{ $request->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($bloodRequests->hasPages())
                <div class="pagination-wrapper">
                    <nav aria-label="Blood requests pagination">
                        {{ $bloodRequests->appends(request()->query())->links() }}
                    </nav>
                </div>
            @endif
        </div>
    @endif
</div>

<style>
/* ================================
   Modern Blood Donor Finder Styles
   ================================ */

:root {
    --primary-color: #dc3545;
    --primary-dark: #c82333;
    --primary-light: #f8d7da;
    --success-color: #28a745;
    --warning-color: #ffc107;
    --text-dark: #2c3e50;
    --text-muted: #6c757d;
    --border-color: #e9ecef;
    --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.08);
    --shadow-lg: 0 8px 24px rgba(0, 0, 0, 0.12);
    --radius-sm: 8px;
    --radius-md: 12px;
    --radius-lg: 16px;
}

/* Hero Section */
.hero-section {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    padding: 80px 0 60px;
    margin-bottom: 60px;
    position: relative;
    overflow: hidden;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
}

.hero-title {
    font-size: clamp(2rem, 5vw, 3.5rem);
    font-weight: 800;
    color: white;
    margin-bottom: 1rem;
    line-height: 1.2;
}

.text-highlight {
    background: linear-gradient(to right, #fff, rgba(255, 255, 255, 0.8));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-subtitle {
    font-size: clamp(1rem, 2vw, 1.25rem);
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 2rem;
}

.hero-actions {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.hero-actions .btn {
    padding: 0.875rem 2rem;
    font-weight: 600;
    border-radius: var(--radius-md);
    transition: all 0.3s ease;
    position: relative;
    z-index: 10;
    cursor: pointer;
}

.hero-actions .btn-primary {
    background: white !important;
    color: var(--primary-color) !important;
    border: 2px solid white !important;
}

.hero-actions .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(255, 255, 255, 0.3);
    background: #f8f9fa !important;
}

.hero-actions .btn-outline-primary {
    border: 2px solid white !important;
    color: white !important;
    background: transparent !important;
}

.hero-actions .btn-outline-primary:hover {
    background: white !important;
    color: var(--primary-color) !important;
}

.floating-card {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    padding: 3rem;
    border-radius: var(--radius-lg);
    text-align: center;
    animation: float 3s ease-in-out infinite;
}

.floating-card i {
    font-size: 4rem;
    color: white;
    display: block;
    margin-bottom: 1rem;
}

.floating-card span {
    color: white;
    font-size: 1.5rem;
    font-weight: 700;
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-20px); }
}

/* Main Content */
.main-content {
    padding-bottom: 80px;
}

/* Section Headers */
.section-header {
    margin-bottom: 2rem;
}

.section-title {
    font-size: clamp(1.5rem, 3vw, 2rem);
    font-weight: 700;
    color: var(--text-dark);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.section-subtitle {
    color: var(--text-muted);
    margin-top: 0.5rem;
    font-size: 1rem;
}

.badge-count {
    background: var(--primary-color);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.875rem;
}

.badge-count.emergency {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}

.badge-filter {
    background: #e3f2fd;
    color: #1976d2;
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-size: 0.875rem;
    font-weight: 600;
}

/* Alert Modern */
.alert-modern {
    border: none;
    border-radius: var(--radius-md);
    padding: 1rem 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 2rem;
    box-shadow: var(--shadow-md);
}

.alert-modern i {
    font-size: 1.5rem;
}

.alert-modern .btn-close {
    margin-left: auto;
}

/* Search Section */
.search-section {
    margin-bottom: 3rem;
}

.search-card {
    background: white;
    border-radius: var(--radius-lg);
    padding: 2rem;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-color);
}

.form-label {
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
}

.form-control-modern {
    border-radius: var(--radius-sm);
    border: 1.5px solid var(--border-color);
    padding: 0.75rem 1rem;
    transition: all 0.3s ease;
}

.form-control-modern:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.15);
}

/* Donor Cards */
.donors-section {
    margin-bottom: 4rem;
}

.donor-card {
    background: white;
    border-radius: var(--radius-lg);
    padding: 1.5rem;
    margin-bottom: 1rem;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-color);
    display: grid;
    grid-template-columns: auto 1fr auto;
    gap: 1.5rem;
    align-items: center;
    transition: all 0.3s ease;
}

.donor-card:hover {
    box-shadow: var(--shadow-md);
    transform: translateY(-2px);
    border-color: var(--primary-color);
}

.donor-blood-type {
    text-align: center;
}

.blood-badge {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: 700;
    box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
    margin-bottom: 0.5rem;
}

.blood-badge.large {
    width: 90px;
    height: 90px;
    font-size: 1.75rem;
}

.status-badge {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 600;
}

.status-ready {
    background: #d4edda;
    color: #155724;
}

.status-wait {
    background: #fff3cd;
    color: #856404;
}

.donor-info {
    flex: 1;
}

.donor-name {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
}

.donor-location,
.donor-meta {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--text-muted);
    font-size: 0.875rem;
    margin-bottom: 0.25rem;
}

.donor-location i,
.donor-meta i {
    color: var(--primary-color);
}

.donor-status-text {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    margin-top: 0.5rem;
    font-weight: 600;
}

.donor-status-text.success {
    color: var(--success-color);
}

.donor-status-text.warning {
    color: #856404;
}

.donor-status-text.new {
    color: #0056b3;
}

.donor-action {
    text-align: center;
}

.btn-call {
    padding: 0.75rem 1.5rem;
    border-radius: var(--radius-md);
    font-weight: 600;
    margin-bottom: 0.5rem;
    white-space: nowrap;
}

.phone-number {
    display: block;
    color: var(--text-muted);
    font-size: 0.75rem;
}

/* Request Cards */
.requests-section {
    margin-bottom: 4rem;
}

.request-card {
    background: white;
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-md);
    border: 2px solid var(--border-color);
    height: 100%;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
}

.request-card:hover {
    box-shadow: var(--shadow-lg);
    transform: translateY(-4px);
}

.request-card.emergency {
    border-color: var(--primary-color);
    animation: borderPulse 2s infinite;
}

.request-card.urgent {
    border-color: var(--warning-color);
}

@keyframes borderPulse {
    0%, 100% { border-color: var(--primary-color); }
    50% { border-color: #ff4d5e; }
}

.request-badge {
    padding: 0.625rem 1rem;
    font-weight: 700;
    font-size: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.request-badge.emergency {
    background: var(--primary-color);
    color: white;
}

.request-badge.urgent {
    background: var(--warning-color);
    color: #000;
}

.request-content {
    padding: 1.25rem;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.request-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid var(--border-color);
}

.blood-badge-compact {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    font-weight: 700;
    box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
}

.blood-quantity-compact {
    background: #f8f9fa;
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-weight: 700;
    font-size: 0.875rem;
    color: var(--text-dark);
    border: 1px solid var(--border-color);
}

.request-info {
    flex: 1;
}

.request-patient {
    font-size: 1.125rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 0.875rem;
    line-height: 1.3;
}

.request-detail {
    display: flex;
    align-items: flex-start;
    gap: 0.625rem;
    margin-bottom: 0.625rem;
    font-size: 0.8125rem;
    color: var(--text-dark);
}

.request-detail i {
    color: var(--primary-color);
    margin-top: 2px;
    font-size: 0.875rem;
    flex-shrink: 0;
}

.request-detail span {
    line-height: 1.4;
}

.request-notes-compact {
    background: #fff3cd;
    padding: 0.625rem;
    border-radius: var(--radius-sm);
    font-size: 0.75rem;
    color: #856404;
    margin: 0.875rem 0;
    display: flex;
    gap: 0.5rem;
    align-items: flex-start;
    border-left: 3px solid var(--warning-color);
}

.request-notes-compact i {
    flex-shrink: 0;
    margin-top: 2px;
}

.request-footer {
    margin-top: auto;
    padding-top: 1rem;
    border-top: 1px solid var(--border-color);
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.request-footer .btn {
    border-radius: var(--radius-sm);
    font-weight: 600;
    padding: 0.625rem 1rem;
}

.request-time {
    font-size: 0.7rem;
    color: var(--text-muted);
    text-align: center;
    background: #f8f9fa;
    padding: 0.375rem 0.75rem;
    border-radius: 50px;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-sm);
}

.empty-state i {
    font-size: 5rem;
    color: var(--border-color);
    margin-bottom: 1rem;
}

.empty-state h3 {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
}

.empty-state p {
    color: var(--text-muted);
    margin-bottom: 2rem;
}

.empty-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

/* Pagination Fixes */
.pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 2rem;
}

.pagination-wrapper nav {
    width: 100%;
    display: flex;
    justify-content: center;
}

.pagination {
    display: flex;
    padding-left: 0;
    list-style: none;
    border-radius: var(--radius-md);
    gap: 0.5rem;
    flex-wrap: wrap;
    justify-content: center;
}

.page-item {
    margin: 0;
}

.page-link {
    position: relative;
    display: block;
    padding: 0.5rem 0.75rem;
    color: var(--primary-color);
    text-decoration: none;
    background-color: #fff;
    border: 1px solid var(--border-color);
    border-radius: var(--radius-sm);
    transition: all 0.3s ease;
}

.page-link:hover {
    z-index: 2;
    color: var(--primary-dark);
    background-color: var(--primary-light);
    border-color: var(--primary-color);
}

.page-link:focus {
    z-index: 3;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
}

.page-item.active .page-link {
    z-index: 3;
    color: #fff;
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.page-item.disabled .page-link {
    color: var(--text-muted);
    pointer-events: none;
    background-color: #fff;
    border-color: var(--border-color);
    opacity: 0.5;
}

/* Mobile Responsive */
@media (max-width: 991px) {
    .hero-section {
        padding: 60px 0 40px;
        margin-bottom: 40px;
    }
    
    .donor-card {
        grid-template-columns: auto 1fr;
        gap: 1rem;
    }
    
    .donor-action {
        grid-column: 1 / -1;
    }
    
    .btn-call {
        width: 100%;
    }
}

@media (max-width: 767px) {
    .blood-badge-compact {
        width: 50px;
        height: 50px;
        font-size: 1rem;
    }
    
    .request-patient {
        font-size: 1rem;
    }
    
    .request-detail {
        font-size: 0.75rem;
    }
}

@media (max-width: 575px) {
    .hero-actions {
        flex-direction: column;
        width: 100%;
    }
    
    .hero-actions .btn {
        width: 100%;
    }
    
    .search-card {
        padding: 1.25rem;
    }
    
    .donor-card {
        padding: 1rem;
        grid-template-columns: 1fr;
        text-align: center;
    }
    
    .donor-info {
        text-align: center;
    }
    
    .donor-location,
    .donor-meta,
    .donor-status-text {
        justify-content: center;
    }
    
    .blood-badge {
        margin: 0 auto 0.5rem;
    }
    
    .badge-count {
        font-size: 0.75rem;
        padding: 0.375rem 0.75rem;
    }
    
    .section-title {
        font-size: 1.25rem;
    }
    
    .page-link {
        padding: 0.375rem 0.625rem;
        font-size: 0.875rem;
    }
    
    .pagination {
        gap: 0.25rem;
    }
}
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const oldDivision = '{{ request('division') }}';
    const oldDistrict = '{{ request('district') }}';
    const oldUpazila = '{{ request('upazila') }}';

    const divisionSelect = document.getElementById('division');
    const districtSelect = document.getElementById('district');
    const upazilaSelect = document.getElementById('upazila');

    function setLoading(element, isLoading, text = 'Loading...') {
        if (isLoading) {
            element.disabled = true;
            element.innerHTML = `<option value="">${text}</option>`;
        } else {
            element.disabled = false;
        }
    }

    function showError(message) {
        console.error(message);
    }

    divisionSelect.addEventListener('change', function() {
        const division = this.value;
        loadDistricts(division);
    });

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

    if (oldDivision) {
        loadDistricts(oldDivision);
    }
});
</script>
@endpush
@endsection