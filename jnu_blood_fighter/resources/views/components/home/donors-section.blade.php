<style>
/* Donors Section Styles */
.donors-section {
    margin-bottom: 4rem;
}
</style>

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
        @include('components.home.donor-card', ['donor' => $donor])
    @empty
        @include('components.home.empty-donors-state')
    @endforelse

    @if($donors->hasPages())
        <div class="pagination-wrapper">
            <nav aria-label="Donors pagination">
                {{ $donors->appends(request()->query())->links() }}
            </nav>
        </div>
    @endif
</div>