<style>
/* Pixel-Perfect UI/UX Inspired Blood Request Card Styles */

/* Color Variables adjusted for correct contrast and theme */
:root {
    --ref-urgent-red: #da3c46; /* Brighter red for urgent banner/icons (Original UI color) */
    --ref-blood-red: #780606; /* Deep blood color for blood type circle/badge */
    --ref-green: #37b752; /* The specific green for the CTA button */
    --ref-dark-text: #343a40; /* Darker text for main info, like "Patient Condition" */
    --ref-light-text: #6c757d; /* Lighter text for secondary info, like "Posted" */
    --ref-lighter-text-value: #495057; /* For detailed text values */

    /* NEW COLORS for conditional urgency */
    --ref-emergency-red: #dc3545; /* Standard emergency red */
    --ref-urgent-yellow: #ffc107; /* Standard urgent yellow */
}

.request-card {
    background: #ffffff;
    border-radius: 16px; 
    overflow: hidden;
    /* Elevated shadow effect as seen in the image */
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1), 0 0 0 1px rgba(0, 0, 0, 0.05); 
    height: 100%;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    position: relative;
    text-align: center; /* All card content is centrally aligned */
}

.request-card:hover {
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15); 
    transform: translateY(-3px);
}

/* Base Header Banner Style */
.request-header-banner {
    color: white;
    padding: 1rem;
    font-weight: 700;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    border-top-left-radius: 16px;
    border-top-right-radius: 16px;
}

/* Style for IMMIDIATE/EMERGENCY Need (User requested red) */
.request-header-banner.emergency {
    background: var(--ref-emergency-red);
}

/* Style for URGENT/SPECIFIC DATE Need (User requested yellow) */
.request-header-banner.urgent-date {
    background: var(--ref-urgent-yellow);
    color: #343a40; /* Dark text for yellow background */
}


.request-header-banner i {
    font-size: 1.2rem; /* Bell icon size */
}

/* Container for blood type circle and quantity badge */
.blood-type-container {
    position: relative;
    width: 110px; 
    height: 110px; 
    margin: 1.5rem auto 1rem; 
}

/* Blood Type Circle (Deep blood red for theme) */
.blood-type-circle {
    width: 100%;
    height: 100%;
    background: var(--ref-blood-red);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem; 
    font-weight: 800;
    box-shadow: 0 6px 20px rgba(120, 6, 6, 0.4); 
}

/* Quantity Badge positioned over the blood type circle */
.quantity-badge {
    position: absolute;
    top: 5px; 
    right: -25px; 
    background: var(--ref-blood-red); 
    color: white; 
    padding: 0.2rem 0.6rem;
    border-radius: 10px;
    font-size: 0.85rem;
    font-weight: 600;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    white-space: nowrap; 
    border: 1px solid var(--ref-blood-red); 
}

.request-title {
    font-size: 1.25rem; 
    font-weight: 700; 
    color: var(--ref-dark-text); 
    margin-bottom: 2rem; 
}

/* Info List */
.request-info-list {
    text-align: left; 
    padding: 0 1.5rem; 
    flex: 1; 
}

.request-detail-line {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem; 
    margin-bottom: 1.5rem; 
    font-size: 0.95rem; 
    color: var(--ref-dark-text); 
}

.request-detail-line i {
    color: var(--ref-urgent-red); /* Brighter red for icons */
    margin-top: 3px; 
    font-size: 1.1rem; 
    flex-shrink: 0; 
}

.request-detail-line span {
    font-weight: 500; 
    color: var(--ref-dark-text); 
    line-height: 1.3;
}

.request-detail-line strong {
    font-weight: 500; 
    color: var(--ref-lighter-text-value); 
}


/* Call to Action Button */
.request-footer {
    padding: 1.5rem; 
    padding-top: 2rem; 
}

.btn-contact {
    /* Large rounded corners from image */
    border-radius: 14px; 
    font-weight: 600; 
    padding: 1rem 1rem; 
    background: var(--ref-green); 
    color: white;
    /* Shadow adjusted to match the new button image's softer shadow */
    box-shadow: 0 4px 12px rgba(55, 183, 82, 0.4); 
    border: none;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem; /* Increased gap to match image spacing */
    width: 100%;
    text-decoration: none;
    font-size: 1.2rem; /* Slightly larger text for prominence */
}

.btn-contact:hover {
    box-shadow: 0 6px 18px rgba(55, 183, 82, 0.5);
    background: #2f9d45; 
    transform: translateY(-1px);
}

.request-posted-time {
    font-size: 0.75rem; 
    color: var(--ref-light-text); 
    margin-top: 1rem;
    font-weight: 500;
}

@media (max-width: 767px) {
    /* Adjustments for smaller screens, if necessary */
    .blood-type-container {
        width: 100px;
        height: 100px;
    }
    .blood-type-circle {
        font-size: 2.2rem;
    }
    .quantity-badge {
        right: -15px; /* Adjust for smaller circle */
    }
    .request-info-list {
        padding: 0 1rem;
    }
}
</style>

<div class="request-card">
    
    {{-- CONDITIONAL HEADER BANNER LOGIC --}}
    @if($request->is_emergency)
        <div class="request-header-banner emergency">
            <i class="bi bi-exclamation-triangle-fill"></i> EMERGENCY
        </div>
    @elseif($request->needed_date && $request->needed_date->isFuture())
        {{-- Urgent date set, but not an emergency (not within 24 hours, based on model logic) --}}
        <div class="request-header-banner urgent-date">
            <i class="bi bi-clock-fill"></i> URGENT REQUEST
        </div>
    @elseif($request->isUrgent())
         {{-- If it's urgent (within 24h) but not marked emergency, we default to the bright red urgent color --}}
        <div class="request-header-banner emergency">
            <i class="bi bi-bell-fill"></i> URGENT REQUEST
        </div>
    @endif

    <div class="content-wrapper">
        
        <div class="blood-type-container">
            {{-- Blood Type Circle (Deep blood color) --}}
            <div class="blood-type-circle">{{ $request->blood_type }}</div>
            {{-- Quantity Badge (Deep blood color) --}}
            <span class="quantity-badge">{{ $request->blood_quantity }} bag(s)</span>
        </div>
        
        {{-- Title --}}
        <h3 class="request-title">Urgent Blood Donation Needed</h3>

        {{-- Info List --}}
        <div class="request-info-list">
            
            {{-- Patient Condition (Heart icon) --}}
            <div class="request-detail-line">
                <i class="bi bi-heart-fill"></i>
                <span>Patient Condition: <strong>{{ Str::limit($request->disease, 30, '...') }}</strong></span>
            </div>
            
            {{-- Hospital (Cross/Plus icon) --}}
            <div class="request-detail-line">
                <i class="bi bi-plus-circle-fill"></i> 
                <span>Hospital: <strong>{{ Str::limit($request->hospital_name, 30, '...') }}</strong></span>
            </div>
            
            {{-- Location (Pin icon) --}}
            <div class="request-detail-line">
                <i class="bi bi-geo-alt-fill"></i>
                <span>Location: <strong>{{ $request->hospital_location }}, {{ $request->upazila }}, {{ $request->district }}</strong></span>
            </div>

            {{-- Needed By Date (Calendar icon) --}}
            <div class="request-detail-line">
                <i class="bi bi-calendar-event-fill"></i>
                <span>
                    @if($request->is_emergency)
                        Needed **IMMEDIATELY**
                    @elseif($request->needed_date)
                        Needed in **{{ $request->needed_date->diffForHumans(null, true) }}**
                        <br>
                        <small>{{ $request->needed_date->format('M d, Y h:i A') }}</small>
                    @else
                        Needed **AS SOON AS POSSIBLE**
                    @endif
                </span>
            </div>
        </div>

        {{-- Footer/CTA --}}
        <div class="request-footer">
            <a href="tel:{{ $request->contact_number }}" class="btn-contact">
                <i class="bi bi-telephone-fill"></i> Call: {{ $request->contact_number }}
            </a>
            <p class="request-posted-time">Posted: {{ $request->created_at->diffForHumans() }}</p>
        </div>
    </div>
</div>