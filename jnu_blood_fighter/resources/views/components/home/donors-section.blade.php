<style>
/* --- Donors Section Styles (Modernized) --- */
.donors-section {
    margin-bottom: 4rem;
}

.section-header {
    border-bottom: 2px solid var(--light-red, #f8d7da); /* Subtle separator */
    padding-bottom: 1rem;
    margin-bottom: 2rem; /* Increased spacing */
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

/* Badge Styling */
.badge-count {
    background-color: var(--primary-red, #dc3545);
    color: white;
    padding: 0.4rem 1rem;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 700;
    box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
    transform: rotate(2deg); /* Slightly playful */
    transition: transform 0.3s ease;
}

.badge-count:hover {
    transform: rotate(0deg) scale(1.05);
}

.badge-filter {
    background-color: #f1f3f5;
    color: #495057;
    border: 1px solid #dee2e6;
    padding: 0.4rem 1rem;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.badge-filter i {
    color: #007bff; /* Use a distinct color for filtering */
    margin-right: 0.3rem;
}

.badge-filter:hover {
    background-color: #e9ecef;
    color: #212529;
}

/* NEW CSS for 4-Column Grid Layout */
.donors-grid {
    display: grid;
    /* Default: Stack on mobile (1 column) */
    grid-template-columns: repeat(1, 1fr);
    gap: 1.5rem; /* Gap between cards */
}

/* Tablet/Small Desktop: 2 columns */
@media (min-width: 768px) {
    .donors-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* Desktop: 4 columns */
@media (min-width: 1200px) {
    .donors-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}

/* Pagination - Hide default pagination as we use AJAX button */
.pagination-wrapper {
    display: none; /* Hide default pagination links */
}

/* See More Button Styling */
.btn-see-more {
    display: block;
    width: 100%;
    margin-top: 2rem;
    font-size: 1.1rem;
    font-weight: 700;
    border-radius: 12px;
}

/* Loading state indicator for button */
.loading {
    pointer-events: none;
    opacity: 0.7;
}

/* Class to visually hide content */
.d-none {
    display: none !important;
}
</style>

<div class="donors-section">
    <div class="section-header">
        <div class="d-flex align-items-center gap-3 flex-wrap">
            <h2 class="section-title mb-0">
                <i class="bi bi-people-fill"></i> Available Donors
            </h2>
            <span class="badge-count">{{ $donors->total() }}</span>
            @if(request()->hasAny(['blood_type', 'division', 'district', 'upazila']))
                <span class="badge badge-filter">
                    <i class="bi bi-funnel-fill"></i> Filtered
                </span>
            @endif
        </div>
    </div>

    {{-- Container for dynamic loading --}}
    <div class="donors-grid" id="donors-grid">
        @forelse($donors as $donor)
            {{-- Assuming $donors collection already limits to the correct items for the current page --}}
            @include('components.home.donor-card', ['donor' => $donor])
        @empty
            @include('components.home.empty-donors-state')
        @endforelse
    </div>

    {{-- "See More" button logic --}}
    @if($donors->hasMorePages())
        <div class="text-center" id="see-more-wrapper">
            {{-- Set data-next-page to the URL of the next page --}}
            <a href="#" 
               class="btn btn-primary btn-see-more"
               id="see-more-button"
               data-next-page="{{ $donors->nextPageUrl() }}">
                <i class="bi bi-arrow-down-circle-fill"></i> Load More Donors
            </a>
        </div>
    @endif
    
    {{-- Pagination wrapper (Hidden by default, used for structural data/links) --}}
    <div class="pagination-wrapper" id="pagination-links">
        <nav aria-label="Donors pagination">
            {{ $donors->appends(request()->query())->links() }}
        </nav>
    </div>
</div>

{{-- **AJAX SCRIPT for Dynamic Loading and Filtering** --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const seeMoreButton = document.getElementById('see-more-button');
    const donorsGrid = document.getElementById('donors-grid');
    const seeMoreWrapper = document.getElementById('see-more-wrapper');
    const searchSubmitBtn = document.getElementById('search-submit-btn'); // From search-section

    /**
     * Reusable function to fetch and load content via AJAX.
     * @param {string} url - The URL to fetch (with search/pagination parameters).
     * @param {boolean} isAppend - True to append content ("Load More"), False to replace content (New Search).
     */
    window.loadDonorsContent = function(url, isAppend = false) {
        if (!url) return;

        // Determine which element to show the loading state on
        const loadingElement = isAppend ? seeMoreButton : searchSubmitBtn;
        if (loadingElement) {
            loadingElement.classList.add('loading');
            loadingElement.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
        }
        
        // Disable both buttons during load to prevent double-clicks
        if (seeMoreButton) seeMoreButton.classList.add('loading');
        if (searchSubmitBtn) searchSubmitBtn.classList.add('loading');


        fetch(url, {
            headers: {
                // Crucial header for Laravel to detect an AJAX request
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(html => {
            // 1. Parse the response
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');

            const newDonorsGrid = doc.getElementById('donors-grid');
            const newHeader = doc.querySelector('.donors-section > .section-header'); // Get the new header content
            const newPaginationLinks = doc.getElementById('pagination-links');

            // 2. Update the Donors Grid Content
            if (newDonorsGrid) {
                if (isAppend) {
                    // Append new cards for "Load More"
                    Array.from(newDonorsGrid.children).forEach(card => {
                        donorsGrid.appendChild(card);
                    });
                } else {
                    // Replace all content for initial Search/Filter
                    donorsGrid.innerHTML = newDonorsGrid.innerHTML;
                    
                    // Update the section header (donor count and filter badge)
                    const currentHeader = document.querySelector('.donors-section > .section-header');
                    if (currentHeader && newHeader) {
                        currentHeader.innerHTML = newHeader.innerHTML;
                    }

                    // Scroll to the top of the donor list after a filter search
                     window.scrollTo({
                        top: donorsGrid.offsetTop - 100, // 100px buffer from the top
                        behavior: 'smooth'
                    });
                }
            }
            
            // 3. Update the 'See More' button state
            if (seeMoreButton && seeMoreWrapper && newPaginationLinks) {
                const paginator = newPaginationLinks.querySelector('.pagination');
                
                if (paginator) {
                    // Get the URL from the last item in the pagination list (which is the "Next" link)
                    const nextLink = paginator.querySelector('.page-item:last-child .page-link');
                    const isNextPageAvailable = nextLink && nextLink.getAttribute('href');

                    if (isNextPageAvailable) {
                        // Update the button with the new next page URL
                        seeMoreButton.setAttribute('data-next-page', isNextPageAvailable);
                        seeMoreWrapper.classList.remove('d-none');
                    } else {
                        // No more pages, hide the button
                        seeMoreWrapper.classList.add('d-none');
                        seeMoreButton.setAttribute('data-next-page', '');
                    }
                } else {
                    // Fallback: If no pagination component, assume no more pages.
                    seeMoreWrapper.classList.add('d-none');
                    seeMoreButton.setAttribute('data-next-page', '');
                }
            }

            // 4. Update the URL in the address bar (Crucial for sharing/refreshing a filtered search)
            if (!isAppend) {
                history.pushState(null, '', url);
            }
        })
        .catch(error => {
            console.error('Error loading donors:', error);
            alert('Could not load donors. Please check the console.');
        })
        .finally(() => {
            // Restore button states
            if (seeMoreButton) {
                seeMoreButton.classList.remove('loading');
                seeMoreButton.innerHTML = '<i class="bi bi-arrow-down-circle-fill"></i> Load More Donors';
            }
            if (searchSubmitBtn) {
                 searchSubmitBtn.classList.remove('loading');
                 searchSubmitBtn.innerHTML = '<i class="bi bi-search"></i> Search';
            }
        });
    };
    // --- End of reusable function ---


    // --- "Load More" Button Event Listener ---
    if (seeMoreButton) {
        seeMoreButton.addEventListener('click', function(e) {
            e.preventDefault();
            
            let nextPageUrl = this.getAttribute('data-next-page');
            
            if (!nextPageUrl || this.classList.contains('loading')) {
                return;
            }

            // Call the reusable function with isAppend = true
            window.loadDonorsContent(nextPageUrl, true);
        });
    }

    // Optional: Re-run search on popstate (browser back/forward button)
    window.addEventListener('popstate', function() {
        const currentUrl = window.location.href;
        // Check if we are on the home page with search parameters
        if (currentUrl.includes('?') && window.location.pathname === '{{ route('home', [], false) }}') {
            // Reload donors based on the new URL from history, but don't append
            window.loadDonorsContent(currentUrl, false);
        }
    });

});
</script>