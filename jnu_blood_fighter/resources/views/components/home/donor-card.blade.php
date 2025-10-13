<style>
/* --- Donor Card Styles (Modernized, Hybrid Layout) --- */
.donor-card {
    /* Base Card: Grid container for the internal elements */
    background: white;
    border-radius: 18px;
    padding: 1.5rem; 
    margin-bottom: 1.25rem;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
    border: 1px solid #f1f3f5;
    
    /* NEW Layout: Using flex to stack the main content area (top) and the button (bottom) */
    display: flex;
    flex-direction: column;
    height: 100%; /* Important for grid items to have uniform height */
    
    transition: all 0.4s cubic-bezier(0.25, 0, 0.25, 1);
    overflow: hidden;
    position: relative;
}

/* Internal content wrapper (Blood Type + Info) */
.donor-content-wrapper {
    display: grid;
    /* Two columns: 90px wide for blood badge, rest for info */
    grid-template-columns: 90px 1fr;
    gap: 1rem;
    margin-bottom: 1rem; /* Space before the call button */
    flex-grow: 1; /* Allows this section to fill space, pushing the button down */
}


/* Subtle border glow on hover (kept) */
.donor-card:hover {
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transform: translateY(-4px);
    border-color: var(--primary-red, #dc3545);
}

/* Vertical red line indicator (kept) */
.donor-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background-color: var(--primary-red, #dc3545);
    transform: translateX(-100%);
    transition: transform 0.4s ease;
}

.donor-card:hover::before {
    transform: translateX(0);
}

/* Blood Type Badge & Status (Left Column) */
.donor-blood-and-status {
    text-align: center;
    align-self: start; /* Align to the top of the content wrapper */
}

.blood-badge {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, var(--primary-red, #dc3545), var(--dark-red, #c82333));
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.6rem;
    font-weight: 800;
    box-shadow: 0 6px 16px rgba(220, 53, 69, 0.4);
    margin: 0 auto 0.6rem;
    position: relative;
    overflow: hidden;
}

/* Status Badges - Placed immediately below the blood badge */
.status-badge {
    display: inline-block;
    padding: 0.2rem 0.8rem;
    border-radius: 50px;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-top: 0.2rem;
}

.status-ready {
    background: #e6ffed;
    color: #1a7a3b;
    border: 1px solid #c3e6cb;
}

.status-wait {
    background: #fff8e6;
    color: #a87e00;
    border: 1px solid #ffeeba;
}

/* Donor Info (Right Column) */
.donor-info {
    text-align: left; /* Align text to the left */
}

.donor-name {
    font-size: 1.3rem;
    font-weight: 700;
    color: #212529;
    margin-bottom: 0.5rem;
    line-height: 1.2;
}

/* Location and Donation Meta */
.donor-location,
.donor-meta,
.donor-status-text {
    display: flex;
    align-items: center;
    justify-content: flex-start; /* Align icons and text to the left */
    gap: 0.4rem; 
    color: #495057;
    font-size: 0.9rem; 
    margin-bottom: 0.4rem; 
    line-height: 1.4;
    padding-top: 0;
    border-top: none; /* Remove separator line from info section */
}

.donor-location i,
.donor-meta i,
.donor-status-text i {
    color: var(--primary-red, #dc3545);
    font-size: 1rem;
}

/* Eligibility Status Text */
.donor-status-text {
    margin-top: 0.5rem;
}

.donor-status-text.success {
    color: #28a745;
}

.donor-status-text.warning {
    color: #ffc107;
}


/* Donor Action - Contact Button (Full Width Bottom) */
.donor-action {
    text-align: center;
    min-width: 100%;
}

.btn-call {
    /* Full width button in the card */
    background: linear-gradient(45deg, #28a745 0%, #1e7e34 100%);
    color: white;
    border: none;
    padding: 0.75rem 1rem;
    border-radius: 12px;
    font-weight: 600;
    white-space: nowrap;
    box-shadow: 0 4px 10px rgba(40, 167, 69, 0.3);
    transition: all 0.3s ease;
    display: block;
    font-size: 1rem;
    text-decoration: none;
}

.btn-call:hover {
    color: white;
    box-shadow: 0 6px 15px rgba(40, 167, 69, 0.5);
    transform: translateY(-1px) scale(1.01);
}

.btn-call i {
    margin-right: 0.5rem;
}

/* Email button variant */
.btn-email {
    background: linear-gradient(45deg, #007bff 0%, #0056b3 100%);
    box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3);
}

.btn-email:hover {
    box-shadow: 0 6px 15px rgba(0, 123, 255, 0.5);
}


/* ======================================================= */
/* DESKTOP-ONLY SIZE REDUCTIONS (>= 1200px)                */
/* This ensures changes only affect the 4-column grid view */
/* ======================================================= */
@media (min-width: 1200px) {
    
    .donor-card {
        padding: 1.25rem; /* Slightly less padding */
    }

    /* Blood Group Badge Size */
    .donor-content-wrapper {
        grid-template-columns: 80px 1fr; /* Reduce left column width */
        gap: 0.75rem; /* Reduce gap */
    }

    .blood-badge {
        width: 60px; /* Reduce shape size */
        height: 60px; /* Reduce shape size */
        font-size: 1.4rem; /* Reduce text size */
    }

    /* Donor Name Text Size */
    .donor-name {
        font-size: 1.15rem; /* Reduce text size */
        margin-bottom: 0.4rem;
    }

    /* Location, Last Donated, Eligibility Text Size */
    .donor-location,
    .donor-meta,
    .donor-status-text {
        font-size: 0.85rem; /* Reduce text size */
        margin-bottom: 0.3rem; /* Tighter spacing */
    }

    .donor-location i,
    .donor-meta i,
    .donor-status-text i {
        font-size: 0.9rem; /* Reduce icon size */
    }

    /* Call Button Size */
    .btn-call {
        padding: 0.6rem 0.8rem; /* Reduce button padding/height */
        font-size: 0.9rem; /* Reduce button text size */
        border-radius: 10px; /* Slight roundness reduction */
        margin-top: 1rem; /* Adjust spacing */
    }
}
</style>

<div class="donor-card">
    <div class="donor-content-wrapper">
        
        {{-- LEFT COLUMN: Blood Type and Status --}}
        <div class="donor-blood-and-status">
            <div class="blood-badge">{{ $donor->blood_type }}</div>
            @if($donor->canDonate())
                <span class="status-badge status-ready">Ready</span>
            @else
                <span class="status-badge status-wait">Wait</span>
            @endif
        </div>
        
        {{-- RIGHT COLUMN: Donor Info --}}
        <div class="donor-info">
            <h3 class="donor-name">{{ $donor->name }}</h3>
            
            {{-- Location --}}
            <div class="donor-location">
                <i class="bi bi-geo-alt-fill"></i>
                <span>{{ $donor->upazila }}, {{ $donor->district }}, {{ $donor->division }}</span>
            </div>
            
            @if($donor->last_donation_date)
                {{-- Last Donation Date --}}
                <div class="donor-meta">
                    <i class="bi bi-calendar-check-fill"></i>
                    <span>Last donated {{ $donor->last_donation_date->diffForHumans() }}</span>
                </div>
                
                {{-- Eligibility Status Text --}}
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
                {{-- New Donor Status --}}
                <div class="donor-status-text new">
                    <i class="bi bi-star-fill"></i> First time donor
                </div>
            @endif
        </div>
    </div>
    
    {{-- BOTTOM ROW: Donor Action - Contact Button (Phone or Email based on preference) --}}
    <div class="donor-action">
        @if($donor->share_phone)
            {{-- Show Phone Number --}}
            <a href="tel:{{ $donor->phone }}" class="btn btn-call">
                <i class="bi bi-telephone-fill"></i>
                <span>Call: {{ $donor->phone }}</span> 
            </a>
        @else
            {{-- Show Email Address --}}
            <a href="mailto:{{ $donor->email }}" class="btn btn-call btn-email">
                <i class="bi bi-envelope-fill"></i>
                <span>Email: {{ $donor->email }}</span> 
            </a>
        @endif
    </div>
</div>