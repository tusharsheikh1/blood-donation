<style>
/* Blood Request Card Styles */
.request-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    border: 2px solid #e9ecef;
    height: 100%;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
}

.request-card:hover {
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    transform: translateY(-4px);
}

.request-card.emergency {
    border-color: #dc3545;
    animation: borderPulse 2s infinite;
}

.request-card.urgent {
    border-color: #ffc107;
}

@keyframes borderPulse {
    0%, 100% { border-color: #dc3545; }
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
    background: #dc3545;
    color: white;
}

.request-badge.urgent {
    background: #ffc107;
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
    border-bottom: 2px solid #e9ecef;
}

.blood-badge-compact {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #dc3545, #c82333);
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
    color: #2c3e50;
    border: 1px solid #e9ecef;
}

.request-info {
    flex: 1;
}

.request-patient {
    font-size: 1.125rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 0.875rem;
    line-height: 1.3;
}

.request-detail {
    display: flex;
    align-items: flex-start;
    gap: 0.625rem;
    margin-bottom: 0.625rem;
    font-size: 0.8125rem;
    color: #2c3e50;
}

.request-detail i {
    color: #dc3545;
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
    border-radius: 8px;
    font-size: 0.75rem;
    color: #856404;
    margin: 0.875rem 0;
    display: flex;
    gap: 0.5rem;
    align-items: flex-start;
    border-left: 3px solid #ffc107;
}

.request-notes-compact i {
    flex-shrink: 0;
    margin-top: 2px;
}

.request-footer {
    margin-top: auto;
    padding-top: 1rem;
    border-top: 1px solid #e9ecef;
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.request-footer .btn {
    border-radius: 8px;
    font-weight: 600;
    padding: 0.625rem 1rem;
}

.request-time {
    font-size: 0.7rem;
    color: #6c757d;
    text-align: center;
    background: #f8f9fa;
    padding: 0.375rem 0.75rem;
    border-radius: 50px;
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
</style>

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