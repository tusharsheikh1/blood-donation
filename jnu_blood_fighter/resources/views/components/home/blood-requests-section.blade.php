<style>
/* Modernized Blood Requests Section Styles (Simplified) */
.requests-section {
    margin-bottom: 5rem;
}

.section-header {
    margin-bottom: 2.5rem;
    text-align: center; /* Center the header content */
}

.section-title {
    font-weight: 800;
    color: #2c3e50;
    font-size: 2.25rem;
    display: inline-flex; /* Use inline-flex to center the content group */
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 0.5rem;
}

.section-title i {
    color: #d93d47; /* Match the UI Red */
    font-size: 2.5rem;
}

.badge-group {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-top: 1rem;
}

.badge-count, .badge-filter {
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 700;
    transition: all 0.3s ease;
    text-transform: uppercase;
}

.badge-count {
    background: #d93d47;
    color: white;
    box-shadow: 0 4px 10px rgba(217, 61, 71, 0.3);
}

.badge-filter {
    background: #adb5bd;
    color: white;
    font-weight: 600;
}

/* Modernizing the Pagination */
.pagination-wrapper {
    margin-top: 3rem;
    text-align: center;
}

.pagination {
    --bs-pagination-color: #495057;
    --bs-pagination-active-bg: #d93d47;
    --bs-pagination-active-border-color: #d93d47;
    --bs-pagination-hover-color: #d93d47;
    --bs-pagination-focus-box-shadow: 0 0 0 0.25rem rgba(217, 61, 71, 0.25);
    border-radius: 15px;
    display: inline-flex;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
}

.page-item .page-link {
    border: none;
    border-radius: 10px;
    margin: 0 5px;
    padding: 0.75rem 1rem;
    transition: all 0.3s ease;
}

.page-item.active .page-link {
    font-weight: 700;
    color: white;
    border-radius: 10px !important;
    background: #d93d47;
    box-shadow: 0 2px 8px rgba(217, 61, 71, 0.4);
    transform: translateY(-2px);
}

.page-item:not(.active) .page-link:hover {
    background-color: #f8d7da;
    color: #d93d47;
    transform: translateY(-1px);
}
</style>

<div class="requests-section">
    <div class="section-header">
        <h2 class="section-title">
            <i class="bi bi-heart-pulse-fill"></i> Urgent Blood Requests
        </h2>
        
        <div class="badge-group">
            <span class="badge-count">{{ $bloodRequests->total() }} Live Requests</span>
            @if(request()->hasAny(['blood_type', 'division', 'district', 'upazila']))
                <span class="badge badge-filter">
                    <i class="bi bi-funnel-fill"></i> Filtered Results
                </span>
            @endif
        </div>
    </div>

    <div class="row g-4">
        @foreach($bloodRequests as $request)
            {{-- MODIFIED COLUMN CLASS --}}
            <div class="col-12 col-lg-4">
                @include('components.home.blood-request-card', ['request' => $request])
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