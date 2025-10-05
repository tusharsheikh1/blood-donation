@extends('layouts.app')

@section('title', 'Find Blood Donors')

@push('styles')
@include('components.home.home-styles')
@endpush

@section('content')
<!-- Hero Section -->
@include('components.home.hero-section')

<div class="container main-content">
    <!-- Alerts -->
    @include('components.home.alerts')

    <!-- Search Section -->
    @include('components.home.search-section', [
        'bloodTypes' => $bloodTypes,
        'divisions' => $divisions
    ])

    <!-- Donors Section -->
    @include('components.home.donors-section', [
        'donors' => $donors
    ])

    <!-- Blood Requests Section -->
    @if($bloodRequests->count() > 0)
        @include('components.home.blood-requests-section', [
            'bloodRequests' => $bloodRequests
        ])
    @endif
</div>

@push('scripts')
@include('components.home.location-dropdown-script')
@endpush
@endsection