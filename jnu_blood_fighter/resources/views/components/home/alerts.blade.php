<style>
/* --- Modern Alert Styles --- */
.alert-modern {
    border: none;
    border-radius: 12px;
    padding: 1.25rem 2rem; /* Slightly larger padding */
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 2rem;
    /* More pronounced, softer shadow */
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08), 0 0 0 1px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Add transition for hover effect */
}

/* Optional: Slight lift on hover */
.alert-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12), 0 0 0 1px rgba(0, 0, 0, 0.05);
}

.alert-modern i {
    font-size: 1.75rem; /* Larger icon */
    line-height: 0; /* Ensures the icon aligns well with text */
}

/* Text style for better readability */
.alert-modern span {
    font-weight: 500;
}

.alert-modern .btn-close {
    margin-left: auto;
    border: none;
    background: transparent;
    opacity: 0.6;
    transition: opacity 0.2s ease;
    padding: 0.5rem; /* Add padding for a better click target */
    line-height: 1;
}

.alert-modern .btn-close:hover {
    opacity: 1;
}

/* --- Color Overrides for Modern Look (assuming Bootstrap's color variables) --- */

/* Success - Softer Green */
.alert-modern.alert-success {
    background-color: #e6f7ee; /* Lighter background */
    color: #1a7f5a; /* Deeper text color */
}
.alert-modern.alert-success i {
    color: #38c172; /* The primary green color */
}

/* Error - Softer Red */
.alert-modern.alert-danger {
    background-color: #fcebeb;
    color: #b03a3a;
}
.alert-modern.alert-danger i {
    color: #e3342f;
}

/* New: Warning - Amber/Orange */
.alert-modern.alert-warning {
    background-color: #fff4e5;
    color: #a05a10;
}
.alert-modern.alert-warning i {
    color: #f6993f;
}
</style>

@if(session('success'))
    <div class="alert alert-success alert-modern" role="alert">
        <i class="bi bi-check-circle-fill"></i>
        <span>{{ session('success') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-modern" role="alert">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <span>{{ session('error') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- New: Warning Alert --}}
@if(session('warning'))
    <div class="alert alert-warning alert-modern" role="alert">
        <i class="bi bi-exclamation-circle-fill"></i>
        <span>{{ session('warning') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif