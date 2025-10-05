<style>
/* Blood Requests Section Styles */
.requests-section {
    margin-bottom: 4rem;
}
</style>

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