@extends('layouts.app')

@section('title', 'Donor Dashboard')

@section('content')
<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-0">Welcome, {{ $donor->name }}!</h4>
                            <p class="text-muted mb-0">Blood Type: <span class="badge bg-danger">{{ $donor->blood_type }}</span></p>
                        </div>
                        <div>
                            <a href="{{ route('donor.profile') }}" class="btn btn-primary me-2">
                                <i class="bi bi-pencil-fill"></i> Edit Profile
                            </a>
                            <a href="{{ route('blood-request.create') }}" class="btn btn-danger">
                                <i class="bi bi-megaphone-fill"></i> Request Blood
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-danger shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Availability Status</h5>
                    <h2>{{ $donor->is_available ? 'Available' : 'Not Available' }}</h2>
                    <p class="mb-0">
                        @if($donor->is_available)
                            <i class="bi bi-check-circle"></i> Ready to donate
                        @else
                            <i class="bi bi-x-circle"></i> Currently unavailable
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card text-white bg-info shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Last Donation</h5>
                    <h2>
                        @if($donor->last_donation_date)
                            {{ $donor->last_donation_date->format('M d, Y') }}
                        @else
                            Never
                        @endif
                    </h2>
                    <p class="mb-0">
                        @if($donor->last_donation_date)
                            {{ $donor->last_donation_date->diffForHumans() }}
                        @else
                            No donation record
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Can Donate?</h5>
                    <h2>{{ $donor->canDonate() ? 'Yes' : 'Not Yet' }}</h2>
                    <p class="mb-0">
                        @if($donor->canDonate())
                            You are eligible to donate
                        @else
                            Wait 3 months after last donation
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Personal Information</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="40%">Email:</th>
                            <td>{{ $donor->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone:</th>
                            <td>{{ $donor->phone }}</td>
                        </tr>
                        <tr>
                            <th>Blood Type:</th>
                            <td><span class="badge bg-danger">{{ $donor->blood_type }}</span></td>
                        </tr>
                        <tr>
                            <th>Member Since:</th>
                            <td>{{ $donor->created_at->format('M d, Y') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Location</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="40%">Division:</th>
                            <td>{{ $donor->division }}</td>
                        </tr>
                        <tr>
                            <th>District:</th>
                            <td>{{ $donor->district }}</td>
                        </tr>
                        <tr>
                            <th>Upazila:</th>
                            <td>{{ $donor->upazila }}</td>
                        </tr>
                        <tr>
                            <th>Address:</th>
                            <td>{{ $donor->address }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0">Quick Actions</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <a href="{{ route('home') }}" class="btn btn-outline-primary w-100">
                        <i class="bi bi-search"></i> Find Other Donors
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="{{ route('blood-request.create') }}" class="btn btn-outline-danger w-100">
                        <i class="bi bi-megaphone-fill"></i> Request Blood
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="{{ route('blood-request.my-requests') }}" class="btn btn-outline-info w-100">
                        <i class="bi bi-clipboard-check-fill"></i> My Requests
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="{{ route('donor.profile') }}" class="btn btn-outline-success w-100">
                        <i class="bi bi-pencil"></i> Update Profile
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="{{ route('donor.logout') }}" class="d-inline w-100">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger w-100">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection