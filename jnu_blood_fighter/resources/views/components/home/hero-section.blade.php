<div class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 text-center text-lg-start">
                <h1 class="hero-title">Find Blood Donors <span class="text-highlight">Near You</span></h1>
                <p class="hero-subtitle">Connect with life-savers in your community. Every donation counts.</p>
                <div class="hero-actions">
                    @auth('web')
                        <a href="{{ route('donor.dashboard') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-speedometer2"></i> My Dashboard
                        </a>
                        <a href="{{ route('blood-request.create') }}" class="btn btn-outline-primary btn-lg">
                            <i class="bi bi-megaphone-fill"></i> Request Blood
                        </a>
                    @else
                        <a href="{{ route('donor.register') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-heart-fill"></i> Become a Donor
                        </a>
                        <a href="{{ route('donor.login') }}" class="btn btn-outline-primary btn-lg">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </a>
                    @endauth
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block">
                <div class="hero-illustration">
                    <div class="floating-card">
                        <i class="bi bi-droplet-fill"></i>
                        <span>Save Lives</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>