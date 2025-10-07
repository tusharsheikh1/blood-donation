<style>
/* Search Section Styles */
.search-section {
    margin-bottom: 3rem;
}

.search-card {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    border: 1px solid #e9ecef;
}

.form-label {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
}

.form-control-modern {
    border-radius: 8px;
    border: 1.5px solid #e9ecef;
    padding: 0.75rem 1rem;
    transition: all 0.3s ease;
}

.form-control-modern:focus {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.15);
}

/* --- SECTION HEADER STYLES --- */
.section-header {
    /* FIX: Explicitly set border-bottom to none to remove the red line. */
    border-bottom: none; 
    padding-bottom: 1rem;
    margin-bottom: 2rem;
}

.section-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: #212529;
}

.section-title i {
    color: var(--primary-red, #dc3545);
    margin-right: 0.5rem;
}

@media (max-width: 575px) {
    .search-card {
        padding: 1.25rem;
    }
}
</style>

<div class="search-section">
    <div class="section-header">
        <h2 class="section-title">
            <i class="bi bi-search"></i> Find Donors
        </h2>
        <p class="section-subtitle">Filter by blood type and location</p>
    </div>

    <div class="search-card">
        <form method="GET" action="{{ route('home') }}" id="searchForm">
            <div class="row g-3">
                <div class="col-md-3 col-sm-6">
                    <label class="form-label">Blood Type</label>
                    <select name="blood_type" class="form-select form-control-modern">
                        <option value="">All Types</option>
                        @foreach($bloodTypes as $type)
                            <option value="{{ $type }}" {{ request('blood_type') == $type ? 'selected' : '' }}>
                                {{ $type }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 col-sm-6">
                    <label class="form-label">Division</label>
                    <select name="division" id="division" class="form-select form-control-modern">
                        <option value="">All Divisions</option>
                        @foreach($divisions as $division)
                            <option value="{{ $division }}" {{ request('division') == $division ? 'selected' : '' }}>
                                {{ $division }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 col-sm-6">
                    <label class="form-label">District</label>
                    <select name="district" id="district" class="form-select form-control-modern">
                        <option value="">All Districts</option>
                    </select>
                </div>
                <div class="col-md-2 col-sm-6">
                    <label class="form-label">Upazila</label>
                    <select name="upazila" id="upazila" class="form-select form-control-modern">
                        <option value="">All Upazilas</option>
                    </select>
                </div>
                <div class="col-md-2 col-12">
                    <label class="form-label d-none d-md-block">&nbsp;</label>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-grow-1" id="search-submit-btn">
                            <i class="bi bi-search"></i> Search
                        </button>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary" title="Clear">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('searchForm');
    
    if (searchForm) {
        // Intercept form submission to use AJAX
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const searchParams = new URLSearchParams(formData);
            
            // Build the URL with current filters
            const url = this.getAttribute('action') + '?' + searchParams.toString();
            
            // Call the function from the donors section script to load new content
            if (window.loadDonorsContent) {
                // Pass false for isAppend to indicate a new search/replace
                window.loadDonorsContent(url, false);
            } else {
                // Fallback: submit the form normally if the AJAX script hasn't loaded
                this.submit();
            }
        });
    }
});
</script>