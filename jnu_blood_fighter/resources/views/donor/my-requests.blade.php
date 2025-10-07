@extends('layouts.app')

@section('title', 'My Blood Requests')

@section('content')
<div class="container mt-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
        <h2 class="mb-3 mb-md-0 fw-bold"><i class="bi bi-clipboard-check-fill me-2 text-danger"></i> My Blood Requests</h2>
        <div>
            <a href="{{ route('blood-request.create') }}" class="btn btn-danger me-2 rounded-pill fw-bold">
                <i class="bi bi-plus-circle-fill me-1"></i> New Request
            </a>
            <a href="{{ route('donor.dashboard') }}" class="btn btn-outline-secondary rounded-pill fw-bold">
                <i class="bi bi-arrow-left me-1"></i> Back to Dashboard
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-3">
            <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @forelse($requests as $request)
        {{-- Card Design: Subtle shadow, border-start for active/emergency status --}}
        @php
            $cardClass = 'shadow-sm border-0 rounded-4';
            $borderClass = '';
            if ($request->status === 'active') {
                $cardClass .= ' bg-white';
                $borderClass = $request->is_emergency ? 'border-start border-5 border-danger' : 'border-start border-5 border-primary';
            } else {
                $cardClass .= ' bg-light text-muted';
                $borderClass = 'border-start border-5 border-secondary';
            }
        @endphp

        <div class="card mb-4 {{ $cardClass }} {{ $borderClass }}">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    
                    {{-- Blood Type & Quantity Column --}}
                    <div class="col-md-2 col-4 text-center border-end border-light">
                        <div class="blood-icon-large mb-2">{{ $request->blood_type }}</div>
                        <span class="badge bg-secondary fs-6 fw-bold p-2">{{ $request->blood_quantity }} bag(s)</span>
                        <br>
                        @if($request->status === 'active')
                            <span class="badge bg-success mt-2 p-2"><i class="bi bi-hourglass-split me-1"></i> Active</span>
                        @elseif($request->status === 'fulfilled')
                            <span class="badge bg-info mt-2 p-2"><i class="bi bi-check-circle-fill me-1"></i> Fulfilled</span>
                        @else
                            <span class="badge bg-secondary mt-2 p-2"><i class="bi bi-x-circle-fill me-1"></i> Cancelled</span>
                        @endif
                    </div>
                    
                    {{-- Request Details Column --}}
                    <div class="col-md-7 col-8">
                        <h5 class="mb-2 fw-bold text-dark">
                            {{ $request->patient_name }}
                            @if($request->is_emergency)
                                <span class="badge bg-danger ms-2"><i class="bi bi-exclamation-triangle-fill me-1"></i> EMERGENCY</span>
                            @elseif($request->isUrgent())
                                <span class="badge bg-warning text-dark ms-2"><i class="bi bi-clock-fill me-1"></i> URGENT</span>
                            @endif
                        </h5>
                        <p class="mb-1 small">
                            <span class="fw-bold">Reason:</span> {{ $request->disease }}
                        </p>
                        <p class="mb-1 small">
                            <span class="fw-bold">Hospital:</span> {{ $request->hospital_name }}
                        </p>
                        <p class="mb-1 small text-muted">
                            <i class="bi bi-geo-alt-fill me-1"></i> {{ $request->hospital_location }}, {{ $request->upazila }}, {{ $request->district }}
                        </p>
                        @if(!$request->is_emergency && $request->needed_date)
                            <p class="mb-1 small">
                                <span class="fw-bold text-danger">Needed By:</span> {{ $request->needed_date->format('M d, Y @ h:i A') }}
                            </p>
                        @endif
                        <p class="mb-1 small fw-bold">
                            <i class="bi bi-phone-fill me-1"></i> Contact: {{ $request->contact_number }}
                        </p>
                        @if($request->additional_notes)
                            <p class="mb-1 small text-info">
                                <span class="fw-bold">Notes:</span> {{ Str::limit($request->additional_notes, 100) }}
                            </p>
                        @endif
                        <p class="mb-0 mt-2 small text-end text-opacity-75">
                            Posted {{ $request->created_at->diffForHumans() }}
                        </p>
                    </div>
                    
                    {{-- Actions Column --}}
                    <div class="col-md-3 mt-3 mt-md-0">
                        @if($request->status === 'active')
                            <div class="d-grid gap-2">
                                <form method="POST" action="{{ route('blood-request.update-status', $request->id) }}">
                                    @csrf
                                    <input type="hidden" name="status" value="fulfilled">
                                    <button type="submit" class="btn btn-success w-100 fw-bold rounded-pill" onclick="return confirm('Are you sure you want to mark this request as FULFILLED? This action cannot be undone.')">
                                        <i class="bi bi-check-circle-fill me-1"></i> Mark Fulfilled
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('blood-request.update-status', $request->id) }}">
                                    @csrf
                                    <input type="hidden" name="status" value="cancelled">
                                    <button type="submit" class="btn btn-warning text-dark w-100 fw-bold rounded-pill" onclick="return confirm('Are you sure you want to CANCEL this request?')">
                                        <i class="bi bi-x-circle-fill me-1"></i> Cancel Request
                                    </button>
                                </form>
                            </div>
                            <hr class="my-2 d-md-none">
                        @endif
                        <form method="POST" action="{{ route('blood-request.destroy', $request->id) }}" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger w-100 rounded-pill" onclick="return confirm('WARNING: Deleting will permanently remove this request. Are you sure?')">
                                <i class="bi bi-trash-fill me-1"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="card shadow border-0 rounded-4">
            <div class="card-body text-center py-5">
                <i class="bi bi-inbox display-1 text-secondary mb-3"></i>
                <h4 class="text-muted fw-bold">No Blood Requests Yet</h4>
                <p class="text-muted mb-4">You haven't posted any blood requests. Start by posting one to reach potential donors!</p>
                <a href="{{ route('blood-request.create') }}" class="btn btn-danger btn-lg rounded-pill fw-bold">
                    <i class="bi bi-plus-circle-fill me-1"></i> Create Your First Request
                </a>
            </div>
        </div>
    @endforelse

    @if($requests->hasPages())
        <div class="mt-4">
            {{ $requests->links() }}
        </div>
    @endif
</div>

<style>
/* Custom modern blood icon */
.blood-icon-large {
    width: 70px;
    height: 70px;
    background: #dc3545; /* Bootstrap Danger Red */
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    font-weight: 900;
    margin: 0 auto;
    box-shadow: 0 0 0 5px rgba(220, 53, 69, 0.2); /* Subtle outer glow/ring */
    transition: all 0.3s ease;
}

.card:hover .blood-icon-large {
    box-shadow: 0 0 0 7px rgba(220, 53, 69, 0.3); 
    transform: scale(1.05);
}
</style>
@endsection