{{-- Blood Type Summary Component --}}
<div class="card shadow-sm mb-4">
    <div class="card-header bg-danger text-white">
        <h5 class="mb-0">
            <i class="bi bi-droplet-fill"></i> Available Donors by Blood Type
        </h5>
    </div>
    <div class="card-body">
        <div class="row g-3">
            @php
                $bloodTypes = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];
                $bloodTypeCounts = \App\Models\Donor::where('is_available', true)
                    ->select('blood_type', \DB::raw('count(*) as count'))
                    ->groupBy('blood_type')
                    ->pluck('count', 'blood_type')
                    ->toArray();
            @endphp

            @foreach($bloodTypes as $type)
                @php
                    $count = $bloodTypeCounts[$type] ?? 0;
                    $percentage = $totalDonors > 0 ? round(($count / $totalDonors) * 100, 1) : 0;
                @endphp
                <div class="col-6 col-md-3">
                    <a href="{{ route('home', ['blood_type' => $type]) }}" 
                       class="text-decoration-none blood-type-card {{ $count > 0 ? '' : 'disabled' }}">
                        <div class="card h-100 border-0 {{ $count > 0 ? 'bg-light hover-card' : 'bg-light opacity-50' }}">
                            <div class="card-body text-center p-3">
                                <div class="blood-type-icon {{ $count > 0 ? 'text-danger' : 'text-muted' }} mb-2">
                                    {{ $type }}
                                </div>
                                <h3 class="mb-1 {{ $count > 0 ? 'text-danger' : 'text-muted' }}">
                                    {{ $count }}
                                </h3>
                                <small class="text-muted d-block">
                                    {{ $count > 0 ? ($count == 1 ? 'donor' : 'donors') : 'No donors' }}
                                </small>
                                @if($count > 0 && $totalDonors > 0)
                                    <div class="progress mt-2" style="height: 4px;">
                                        <div class="progress-bar bg-danger" 
                                             role="progressbar" 
                                             style="width: {{ $percentage }}%"
                                             aria-valuenow="{{ $percentage }}" 
                                             aria-valuemin="0" 
                                             aria-valuemax="100">
                                        </div>
                                    </div>
                                    <small class="text-muted">{{ $percentage }}%</small>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        @if($totalDonors > 0)
            <div class="mt-4 pt-3 border-top">
                <div class="row text-center">
                    <div class="col-md-4">
                        <div class="stat-box">
                            <i class="bi bi-people-fill text-primary fs-3"></i>
                            <h4 class="mt-2 mb-0">{{ $totalDonors }}</h4>
                            <small class="text-muted">Total Donors</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-box">
                            <i class="bi bi-check-circle-fill text-success fs-3"></i>
                            <h4 class="mt-2 mb-0">{{ \App\Models\Donor::where('is_available', true)->count() }}</h4>
                            <small class="text-muted">Available Now</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-box">
                            <i class="bi bi-geo-alt-fill text-danger fs-3"></i>
                            <h4 class="mt-2 mb-0">{{ \App\Models\Donor::distinct('division')->count('division') }}</h4>
                            <small class="text-muted">Divisions Covered</small>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
.blood-type-icon {
    font-size: 2rem;
    font-weight: bold;
    font-family: 'Arial Black', sans-serif;
}

.hover-card {
    transition: all 0.3s ease;
    cursor: pointer;
}

.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(220, 53, 69, 0.25) !important;
}

.blood-type-card.disabled {
    cursor: not-allowed;
    pointer-events: none;
}

.stat-box {
    padding: 1rem;
}

@media (max-width: 768px) {
    .blood-type-icon {
        font-size: 1.5rem;
    }
}
</style>