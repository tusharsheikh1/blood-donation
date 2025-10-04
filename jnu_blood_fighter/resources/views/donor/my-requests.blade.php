@extends('layouts.app')

@section('title', 'My Blood Requests')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-clipboard-check-fill"></i> My Blood Requests</h2>
        <div>
            <a href="{{ route('blood-request.create') }}" class="btn btn-danger me-2">
                <i class="bi bi-plus-circle-fill"></i> New Request
            </a>
            <a href="{{ route('donor.dashboard') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </div>

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

    @forelse($requests as $request)
        <div class="card mb-3 shadow-sm {{ $request->status === 'active' ? ($request->is_emergency ? 'border-danger border-2' : '') : 'bg-light' }}">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2 text-center">
                        <div class="blood-icon-large mb-2">{{ $request->blood_type }}</div>
                        <span class="badge bg-secondary">{{ $request->blood_quantity }} bag(s)</span>
                        <br>
                        @if($request->status === 'active')
                            <span class="badge bg-success mt-2">Active</span>
                        @elseif($request->status === 'fulfilled')
                            <span class="badge bg-info mt-2">Fulfilled</span>
                        @else
                            <span class="badge bg-secondary mt-2">Cancelled</span>
                        @endif
                    </div>
                    <div class="col-md-7">
                        <h5 class="mb-2">
                            {{ $request->patient_name }}
                            @if($request->is_emergency)
                                <span class="badge bg-danger"><i class="bi bi-exclamation-triangle-fill"></i> EMERGENCY</span>
                            @elseif($request->isUrgent())
                                <span class="badge bg-warning text-dark"><i class="bi bi-clock-fill"></i> URGENT</span>
                            @endif
                        </h5>
                        <p class="mb-1"><strong>Disease:</strong> {{ $request->disease }}</p>
                        <p class="mb-1"><strong>Hospital:</strong> {{ $request->hospital_name }}</p>
                        <p class="mb-1"><strong>Location:</strong> {{ $request->hospital_location }}, {{ $request->upazila }}, {{ $request->district }}</p>
                        @if(!$request->is_emergency && $request->needed_date)
                            <p class="mb-1"><strong>Needed:</strong> {{ $request->needed_date->format('M d, Y h:i A') }}</p>
                        @endif
                        <p class="mb-1"><strong>Contact:</strong> {{ $request->contact_number }}</p>
                        @if($request->additional_notes)
                            <p class="mb-1 small text-muted"><strong>Notes:</strong> {{ $request->additional_notes }}</p>
                        @endif
                        <p class="mb-0 small text-muted">Posted {{ $request->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="col-md-3 text-end">
                        @if($request->status === 'active')
                            <div class="btn-group-vertical w-100 gap-2">
                                <form method="POST" action="{{ route('blood-request.update-status', $request->id) }}" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="status" value="fulfilled">
                                    <button type="submit" class="btn btn-success w-100" onclick="return confirm('Mark this request as fulfilled?')">
                                        <i class="bi bi-check-circle-fill"></i> Mark Fulfilled
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('blood-request.update-status', $request->id) }}" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="status" value="cancelled">
                                    <button type="submit" class="btn btn-warning w-100" onclick="return confirm('Cancel this request?')">
                                        <i class="bi bi-x-circle-fill"></i> Cancel
                                    </button>
                                </form>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('blood-request.destroy', $request->id) }}" class="d-inline mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger w-100" onclick="return confirm('Delete this request permanently?')">
                                <i class="bi bi-trash-fill"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="card shadow-sm">
            <div class="card-body text-center py-5">
                <i class="bi bi-inbox display-1 text-muted mb-3"></i>
                <h5 class="text-muted">No Blood Requests Yet</h5>
                <p class="text-muted mb-3">You haven't posted any blood requests.</p>
                <a href="{{ route('blood-request.create') }}" class="btn btn-danger">
                    <i class="bi bi-plus-circle-fill"></i> Create Your First Request
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
.blood-icon-large {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: bold;
    margin: 0 auto;
    box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
}
</style>
@endsection