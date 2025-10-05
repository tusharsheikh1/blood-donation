<style>
/* Donor Card Styles */
.donor-card {
    background: white;
    border-radius: 16px;
    padding: 1.5rem;
    margin-bottom: 1rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    border: 1px solid #e9ecef;
    display: grid;
    grid-template-columns: auto 1fr auto;
    gap: 1.5rem;
    align-items: center;
    transition: all 0.3s ease;
}

.donor-card:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    transform: translateY(-2px);
    border-color: #dc3545;
}

.donor-blood-type {
    text-align: center;
}

.blood-badge {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, #dc3545, #c82333);
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
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.donor-location,
.donor-meta {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #6c757d;
    font-size: 0.875rem;
    margin-bottom: 0.25rem;
}

.donor-location i,
.donor-meta i {
    color: #dc3545;
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
    color: #28a745;
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
    border-radius: 12px;
    font-weight: 600;
    margin-bottom: 0.5rem;
    white-space: nowrap;
}

.phone-number {
    display: block;
    color: #6c757d;
    font-size: 0.75rem;
}

@media (max-width: 991px) {
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

@media (max-width: 575px) {
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
}
</style>

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