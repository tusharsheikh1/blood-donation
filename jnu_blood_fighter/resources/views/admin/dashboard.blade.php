@extends('layouts.admin')

@section('title', 'Admin Dashboard')

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

    <h2 class="mb-4">Admin Dashboard</h2>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-danger shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Donors</h5>
                    <h2 class="display-4">{{ $stats['total_donors'] }}</h2>
                    <p class="mb-0"><i class="bi bi-people-fill"></i> Registered</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">Available Donors</h5>
                    <h2 class="display-4">{{ $stats['available_donors'] }}</h2>
                    <p class="mb-0"><i class="bi bi-check-circle-fill"></i> Ready to donate</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">Blood Types</h5>
                    <h2 class="display-4">{{ $stats['by_blood_type']->count() }}</h2>
                    <p class="mb-0"><i class="bi bi-droplet-fill"></i> Types available</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">Divisions</h5>
                    <h2 class="display-4">{{ $stats['by_division']->count() }}</h2>
                    <p class="mb-0"><i class="bi bi-geo-alt-fill"></i> Locations</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="bi bi-droplet-fill"></i> Donors by Blood Type</h5>
                </div>
                <div class="card-body">
                    @if($stats['total_donors'] > 0)
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Blood Type</th>
                                    <th class="text-end">Count</th>
                                    <th class="text-end">Percentage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stats['by_blood_type'] as $stat)
                                    <tr>
                                        <td><span class="badge bg-danger">{{ $stat->blood_type }}</span></td>
                                        <td class="text-end">{{ $stat->count }}</td>
                                        <td class="text-end">{{ round(($stat->count / $stats['total_donors']) * 100, 1) }}%</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info mb-0">
                            <i class="bi bi-info-circle"></i> No donors registered yet.
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="bi bi-geo-alt-fill"></i> Donors by Division</h5>
                </div>
                <div class="card-body">
                    @if($stats['total_donors'] > 0)
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Division</th>
                                    <th class="text-end">Donors</th>
                                    <th class="text-end">Percentage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stats['by_division'] as $stat)
                                    <tr>
                                        <td>{{ $stat->division }}</td>
                                        <td class="text-end">{{ $stat->count }}</td>
                                        <td class="text-end">{{ round(($stat->count / $stats['total_donors']) * 100, 1) }}%</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info mb-0">
                            <i class="bi bi-info-circle"></i> No donors registered yet.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-clock-history"></i> Recent Donors</h5>
            <a href="{{ route('admin.donors') }}" class="btn btn-sm btn-primary">
                <i class="bi bi-list"></i> View All Donors
            </a>
        </div>
        <div class="card-body">
            @if($stats['recent_donors']->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Blood Type</th>
                                <th>Division</th>
                                <th>District</th>
                                <th>Upazila</th>
                                <th>Contact</th>
                                <th>Status</th>
                                <th>Registered</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stats['recent_donors'] as $donor)
                                <tr>
                                    <td>{{ $donor->name }}</td>
                                    <td><span class="badge bg-danger">{{ $donor->blood_type }}</span></td>
                                    <td>{{ $donor->division }}</td>
                                    <td>{{ $donor->district }}</td>
                                    <td>{{ $donor->upazila }}</td>
                                    <td><a href="tel:{{ $donor->phone }}">{{ $donor->phone }}</a></td>
                                    <td>
                                        @if($donor->is_available)
                                            <span class="badge bg-success">Available</span>
                                        @else
                                            <span class="badge bg-secondary">Unavailable</span>
                                        @endif
                                    </td>
                                    <td>{{ $donor->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info mb-0">
                    <i class="bi bi-info-circle"></i> No donors registered yet. <a href="{{ route('donor.register') }}">Register the first donor</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection