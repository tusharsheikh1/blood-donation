@extends('layouts.admin')

@section('title', 'Manage Donors')

@section('content')
<div class="container-fluid mt-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-search"></i> Filter Donors</h5>
            @if(request()->anyFilled(['search', 'blood_type', 'division', 'district', 'upazila', 'available']))
                <a href="{{ route('admin.donors') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-x-circle"></i> Clear Filters
                </a>
            @endif
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.donors') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Search (Name / Email / Phone)</label>
                        <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="e.g. Rahim, 017..., rahim@mail.com">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Blood Type</label>
                        <select class="form-select" name="blood_type">
                            <option value="">Any</option>
                            @foreach(['A+','A-','B+','B-','O+','O-','AB+','AB-'] as $bt)
                                <option value="{{ $bt }}" @selected(request('blood_type')===$bt)>{{ $bt }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Availability</label>
                        <select class="form-select" name="available">
                            <option value="">Any</option>
                            <option value="1" @selected(request('available')==='1')>Available</option>
                            <option value="0" @selected(request('available')==='0')>Not Available</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Division</label>
                        <select class="form-select" name="division" id="division">
                            <option value="">Any</option>
                            @foreach(($divisions ?? []) as $div)
                                <option value="{{ $div['en'] }}" @selected(request('division')===$div['en'])>{{ $div['en'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">District</label>
                        <select class="form-select" name="district" id="district">
                            <option value="">Any</option>
                            @if(request('district'))
                                <option selected>{{ request('district') }}</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Upazila</label>
                        <select class="form-select" name="upazila" id="upazila">
                            <option value="">Any</option>
                            @if(request('upazila'))
                                <option selected>{{ request('upazila') }}</option>
                            @endif
                        </select>
                    </div>

                    <div class="col-md-12 d-flex gap-2">
                        <button class="btn btn-primary">
                            <i class="bi bi-funnel"></i> Apply
                        </button>
                        <a href="{{ route('admin.donors') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-counterclockwise"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0">All Donors ({{ $donors->total() }})</h5>
            <div class="d-flex align-items-center gap-2">
                @if(request()->hasAny(['search', 'blood_type', 'division']))
                    <span class="badge bg-info">
                        <i class="bi bi-funnel-fill"></i> Filters Active
                    </span>
                @endif
                <a href="{{ route('admin.donors.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i> New Donor
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Donor</th>
                            <th>Blood</th>
                            <th>Contact</th>
                            <th>Location</th>
                            <th>Availability</th>
                            <th>Last Donation</th>
                            <th>Stats</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donors as $index => $donor)
                            <tr>
                                <td>{{ $donors->firstItem() + $index }}</td>
                                <td>
                                    <div class="fw-semibold">{{ $donor->name }}</div>
                                    <div class="text-muted small">{{ $donor->email }}</div>
                                </td>
                                <td>
                                    <span class="badge bg-danger-subtle text-danger fw-semibold">{{ $donor->blood_type }}</span>
                                </td>
                                <td>
                                    <div>
                                        <a href="tel:{{ $donor->phone }}">{{ $donor->phone }}</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="small">
                                        {{ $donor->upazila ? $donor->upazila . ', ' : '' }}
                                        {{ $donor->district ? $donor->district . ', ' : '' }}
                                        {{ $donor->division }}
                                    </div>
                                </td>
                                <td>
                                    @if($donor->is_available)
                                        <span class="badge bg-success"><i class="bi bi-check2-circle"></i> Available</span>
                                    @else
                                        <span class="badge bg-secondary"><i class="bi bi-slash-circle"></i> Not Available</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="small">
                                        {{ $donor->last_donation_date ? \Carbon\Carbon::parse($donor->last_donation_date)->format('d M Y') : '—' }}
                                    </div>
                                </td>
                                <td>
                                    <div class="small text-muted">
                                        Age: {{ $donor->age ?? '—' }} |
                                        H: {{ $donor->height_cm ? $donor->height_cm . ' cm' : '—' }} |
                                        W: {{ $donor->weight_kg ? $donor->weight_kg . ' kg' : '—' }}
                                    </div>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.donors.edit', $donor->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.donors.delete', $donor->id) }}" method="POST" onsubmit="return confirm('Delete this donor?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">
                                    <i class="bi bi-inboxes"></i> No donors found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($donors->hasPages())
                <div class="mt-4">
                    {{ $donors->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
    const division = document.getElementById('division');
    const district = document.getElementById('district');
    const upazila  = document.getElementById('upazila');

    async function fetchJSON(url) {
        try {
            const res = await fetch(url);
            return await res.json();
        } catch (e) {
            return [];
        }
    }

    if (division) {
        division.addEventListener('change', async function () {
            const div = this.value;
            district.innerHTML = '<option value="">Any</option>';
            upazila.innerHTML = '<option value="">Any</option>';
            if (!div) return;

            const items = await fetchJSON(`/api/districts/${encodeURIComponent(div)}`);
            (Array.isArray(items) ? items : []).forEach(d => {
                const opt = document.createElement('option');
                opt.value = d; opt.textContent = d;
                district.appendChild(opt);
            });
        });
    }

    if (district) {
        district.addEventListener('change', async function () {
            const dist = this.value;
            upazila.innerHTML = '<option value="">Any</option>';
            if (!dist) return;

            const items = await fetchJSON(`/api/upazilas/${encodeURIComponent(dist)}`);
            (Array.isArray(items) ? items : []).forEach(u => {
                const opt = document.createElement('option');
                opt.value = u; opt.textContent = u;
                upazila.appendChild(opt);
            });
        });
    }
})();
</script>
@endpush
