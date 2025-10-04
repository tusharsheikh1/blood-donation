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

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-people-fill"></i> Manage Donors</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back to Dashboard
        </a>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h6 class="mb-3"><i class="bi bi-funnel"></i> Filter Donors</h6>
            <form method="GET" action="{{ route('admin.donors') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <input 
                            type="text" 
                            name="search" 
                            class="form-control" 
                            placeholder="Search by name, email, or phone" 
                            value="{{ request('search') }}"
                        >
                    </div>
                    <div class="col-md-2">
                        <select name="blood_type" class="form-select">
                            <option value="">All Blood Types</option>
                            @foreach(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'] as $type)
                                <option value="{{ $type }}" {{ request('blood_type') == $type ? 'selected' : '' }}>
                                    {{ $type }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="division" class="form-select">
                            <option value="">All Divisions</option>
                            @foreach(['Dhaka', 'Chattogram', 'Rajshahi', 'Khulna', 'Barishal', 'Sylhet', 'Rangpur', 'Mymensingh'] as $division)
                                <option value="{{ $division }}" {{ request('division') == $division ? 'selected' : '' }}>
                                    {{ $division }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary flex-fill">
                                <i class="bi bi-search"></i> Search
                            </button>
                            <a href="{{ route('admin.donors') }}" class="btn btn-secondary" title="Clear filters">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0">All Donors ({{ $donors->total() }})</h5>
            @if(request()->hasAny(['search', 'blood_type', 'division']))
                <span class="badge bg-info">
                    <i class="bi bi-funnel-fill"></i> Filters Active
                </span>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Blood</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Last Donation</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donors as $donor)
                            <tr>
                                <td>{{ $donor->id }}</td>
                                <td>{{ $donor->name }}</td>
                                <td><a href="mailto:{{ $donor->email }}">{{ $donor->email }}</a></td>
                                <td><a href="tel:{{ $donor->phone }}">{{ $donor->phone }}</a></td>
                                <td><span class="badge bg-danger">{{ $donor->blood_type }}</span></td>
                                <td>
                                    <small>
                                        {{ $donor->upazila }}<br>
                                        {{ $donor->district }}, {{ $donor->division }}
                                    </small>
                                </td>
                                <td>
                                    @if($donor->is_available)
                                        <span class="badge bg-success">Available</span>
                                    @else
                                        <span class="badge bg-secondary">Unavailable</span>
                                    @endif
                                </td>
                                <td>
                                    @if($donor->last_donation_date)
                                        <small>{{ $donor->last_donation_date->format('M d, Y') }}</small>
                                    @else
                                        <span class="text-muted">Never</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.donors.edit', $donor->id) }}" class="btn btn-outline-primary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.donors.delete', $donor->id) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete {{ $donor->name }}? This action cannot be undone.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4">
                                    <i class="bi bi-inbox display-4 text-muted d-block mb-2"></i>
                                    <p class="text-muted mb-0">
                                        @if(request()->hasAny(['search', 'blood_type', 'division']))
                                            No donors found matching your criteria. <a href="{{ route('admin.donors') }}">Clear filters</a>
                                        @else
                                            No donors registered yet.
                                        @endif
                                    </p>
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