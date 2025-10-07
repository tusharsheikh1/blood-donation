<style>
/* * Modern Empty State - Emphasizing Softness, Depth, and Hierarchy 
 */
.empty-state {
    text-align: center;
    padding: 5rem 3rem; /* Increased vertical padding for more 'air' */
    background: #fcfdfe; /* Very light off-white (less harsh than pure white) */
    border-radius: 16px; /* Slightly more rounded for a friendlier feel */
    /* Modern shadow with high vertical offset for floating effect */
    box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.08), 
                0 4px 6px -2px rgba(0, 0, 0, 0.03);
    border: 1px solid #e0e6f0; /* Subtle, light border for depth */
    transition: transform 0.3s ease-in-out; /* Add transition for hover effect */
}

/* Subtle Hover Effect (Modern UX Touch) */
.empty-state:hover {
    transform: translateY(-2px); /* Lifts card slightly on hover */
    box-shadow: 0 15px 35px -5px rgba(0, 0, 0, 0.1), 
                0 6px 8px -3px rgba(0, 0, 0, 0.05);
}

/* Updated Icon Styling: Gradient/Brand Color Focus */
.empty-state i {
    font-size: 4.5rem; /* A bit larger */
    /* Use a primary color, slightly muted for modern feel */
    color: #a3b1c6; 
    margin-bottom: 2rem; /* Increased spacing */
    
    /* OPTIONAL: If you can use a pseudo-element or actual element, you can add a background/shadow glow for a Glassmorphism effect. */
}

/* Typography & Hierarchy */
.empty-state h3 {
    font-size: 1.8rem; /* Larger and bolder for clear focus */
    font-weight: 700; /* Back to 700 for maximum contrast on the title */
    color: #1f2937; /* Very dark grey, not black */
    margin-bottom: 0.8rem;
    letter-spacing: -0.02em; /* Subtle tightening of letters is a modern trend */
}

.empty-state p {
    font-size: 1.1rem; /* Highly readable body text */
    color: #6b7280; /* Softer body text color (less harsh contrast) */
    max-width: 500px;
    margin: 0 auto 2.5rem auto; /* Generous bottom margin */
    line-height: 1.6;
}

.empty-actions {
    display: flex;
    gap: 1.25rem; /* Increased gap */
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 2rem;
}

/* Button Modernization */
.empty-actions .btn {
    font-weight: 600;
    padding: 0.75rem 1.75rem; /* Larger, more substantial buttons */
    border-radius: 10px; /* Softer, more modern button corners */
    transition: all 0.2s ease;
}

/* Primary Button (Use a slightly deeper, more vibrant brand color) */
.empty-actions .btn-primary {
    --bs-btn-bg: #e31b23; 
    --bs-btn-border-color: #e31b23;
    --bs-btn-hover-bg: #c5161c;
    --bs-btn-hover-border-color: #c5161c;
    box-shadow: 0 4px 10px rgba(227, 27, 35, 0.3); /* Add button shadow for depth */
}

/* Outline Button (Clean and accessible) */
.empty-actions .btn-outline-primary {
    --bs-btn-color: #e31b23;
    --bs-btn-border-color: #e31b23;
    --bs-btn-hover-color: #ffffff;
    --bs-btn-hover-bg: #e31b23;
    --bs-btn-hover-border-color: #e31b23;
}

.empty-actions .btn i {
    margin-right: 0.4rem;
    font-size: 1rem; 
}
</style>

<div class="empty-state">
    <i class="bi bi-database-exclamation"></i> 
    <h3>No Donors Found</h3>
    <p>
        @if(request()->hasAny(['blood_type', 'division', 'district', 'upazila']))
            Your search yielded no results. Please **check your spelling** or try clearing the filters to see all registered donors.
        @else
            No donors are currently registered in the system. Be the **first to register** and help us grow our life-saving community!
        @endif
    </p>
    <div class="empty-actions">
        @if(request()->hasAny(['blood_type', 'division', 'district', 'upazila']))
            <a href="{{ route('home') }}" class="btn btn-outline-primary">
                <i class="bi bi-funnel-fill"></i> Reset Search Filters
            </a>
        @endif
        <a href="{{ route('donor.register') }}" class="btn btn-primary">
            <i class="bi bi-person-plus-fill"></i> Register as Donor
        </a>
    </div>
</div>