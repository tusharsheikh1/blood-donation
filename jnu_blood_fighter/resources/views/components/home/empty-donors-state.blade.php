<style>
/* Empty State Styles */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 16px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.empty-state i {
    font-size: 5rem;
    color: #e9ecef;
    margin-bottom: 1rem;
}

.empty-state h3 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.empty-state p {
    color: #6c757d;
    margin-bottom: 2rem;
}

.empty-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}
</style>

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