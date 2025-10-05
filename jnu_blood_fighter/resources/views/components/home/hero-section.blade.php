<div class="hero-section-ultra-modern">
    <!-- Animated Background -->
    <div class="hero-bg-wrapper">
        <div class="animated-gradient"></div>
        <div class="grid-overlay"></div>
        <div class="particle-container">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>
    </div>

    <div class="container position-relative">
        <div class="row align-items-center min-vh-70">
            <!-- Left Content -->
            <div class="col-lg-6 hero-content-wrapper">
                <!-- Top Badge -->
                <div class="hero-pill" data-aos="fade-down">
                    <span class="pill-icon">🩸</span>
                    <span class="pill-text">Trusted by 1000+ Life Savers</span>
                    <span class="pill-badge">Live</span>
                </div>

                <!-- Main Heading -->
                <h1 class="hero-heading" data-aos="fade-up" data-aos-delay="100">
                    <span class="heading-line">Find Blood</span>
                    <span class="heading-line heading-highlight">
                        <span class="text-morph">Donors</span>
                        <span class="heading-underline"></span>
                    </span>
                    <span class="heading-line">Instantly</span>
                </h1>

                <!-- Subtitle -->
                <p class="hero-description" data-aos="fade-up" data-aos-delay="200">
                    Connect with verified blood donors in seconds. Our AI-powered platform 
                    matches you with the nearest donors based on blood type and location.
                </p>

                <!-- Features List -->
                <div class="hero-features" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-item">
                        <div class="feature-icon">⚡</div>
                        <span>Instant Match</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">🛡️</div>
                        <span>Verified Donors</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">📍</div>
                        <span>GPS Tracking</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">🔔</div>
                        <span>Real-time Alerts</span>
                    </div>
                </div>

                <!-- CTA Buttons -->
                <div class="hero-cta-wrapper" data-aos="fade-up" data-aos-delay="400">
                    @auth('web')
                        <a href="{{ route('donor.dashboard') }}" class="btn-modern btn-primary-modern">
                            <span class="btn-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                            </span>
                            <span class="btn-content">
                                <span class="btn-text">My Dashboard</span>
                                <span class="btn-subtext">View your profile</span>
                            </span>
                            <span class="btn-arrow">→</span>
                        </a>
                        <a href="{{ route('blood-request.create') }}" class="btn-modern btn-secondary-modern">
                            <span class="btn-icon">📢</span>
                            <span class="btn-content">
                                <span class="btn-text">Request Blood</span>
                                <span class="btn-subtext">Emergency help</span>
                            </span>
                        </a>
                    @else
                        <a href="{{ route('donor.register') }}" class="btn-modern btn-primary-modern">
                            <span class="btn-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="8.5" cy="7" r="4"></circle>
                                    <line x1="20" y1="8" x2="20" y2="14"></line>
                                    <line x1="23" y1="11" x2="17" y2="11"></line>
                                </svg>
                            </span>
                            <span class="btn-content">
                                <span class="btn-text">Become a Donor</span>
                                <span class="btn-subtext">Join 1000+ heroes</span>
                            </span>
                            <span class="btn-arrow">→</span>
                        </a>
                        <a href="{{ route('donor.login') }}" class="btn-modern btn-secondary-modern">
                            <span class="btn-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                                    <polyline points="10 17 15 12 10 7"></polyline>
                                    <line x1="15" y1="12" x2="3" y2="12"></line>
                                </svg>
                            </span>
                            <span class="btn-content">
                                <span class="btn-text">Sign In</span>
                                <span class="btn-subtext">Access account</span>
                            </span>
                        </a>
                    @endauth
                </div>

                <!-- Trust Indicators -->
                <div class="trust-bar" data-aos="fade-up" data-aos-delay="500">
                    <div class="trust-item">
                        <div class="trust-avatar-group">
                            <div class="trust-avatar">👤</div>
                            <div class="trust-avatar">👤</div>
                            <div class="trust-avatar">👤</div>
                            <div class="trust-avatar-more">+{{ App\Models\Donor::count() }}</div>
                        </div>
                        <div class="trust-text">
                            <strong>Active Donors</strong>
                            <span>Ready to help</span>
                        </div>
                    </div>
                    <div class="trust-divider"></div>
                    <div class="trust-item">
                        <div class="trust-rating">
                            <span class="star">⭐</span>
                            <span class="rating-number">4.9</span>
                        </div>
                        <div class="trust-text">
                            <strong>User Rating</strong>
                            <span>500+ reviews</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Illustration -->
            <div class="col-lg-6 d-none d-lg-block">
                <div class="hero-visual-wrapper" data-aos="fade-left" data-aos-delay="200">
                    <!-- 3D Card Stack -->
                    <div class="card-stack">
                        <!-- Card 1 - Front -->
                        <div class="donor-card-3d card-front">
                            <div class="card-glow"></div>
                            <div class="card-header-3d">
                                <div class="donor-info-mini">
                                    <div class="donor-avatar-3d">
                                        <span class="avatar-emoji">👨‍⚕️</span>
                                        <div class="status-ring"></div>
                                    </div>
                                    <div class="donor-details">
                                        <h4>Ahmed Khan</h4>
                                        <p><span class="location-pin">📍</span> Dhaka, 2.5 km</p>
                                    </div>
                                </div>
                                <div class="blood-badge-3d">
                                    <div class="badge-inner">O+</div>
                                    <div class="badge-ring"></div>
                                </div>
                            </div>
                            <div class="card-body-3d">
                                <div class="stat-row">
                                    <div class="stat-col">
                                        <span class="stat-label">Donations</span>
                                        <span class="stat-value">12</span>
                                    </div>
                                    <div class="stat-col">
                                        <span class="stat-label">Response</span>
                                        <span class="stat-value">2m</span>
                                    </div>
                                    <div class="stat-col">
                                        <span class="stat-label">Rating</span>
                                        <span class="stat-value">⭐ 5.0</span>
                                    </div>
                                </div>
                                <div class="availability-bar">
                                    <div class="availability-indicator"></div>
                                    <span>Available Now</span>
                                </div>
                            </div>
                            <div class="card-footer-3d">
                                <button class="quick-action-btn call">
                                    <span class="btn-icon-small">📞</span>
                                    Call
                                </button>
                                <button class="quick-action-btn message">
                                    <span class="btn-icon-small">💬</span>
                                    Message
                                </button>
                                <button class="quick-action-btn location">
                                    <span class="btn-icon-small">📍</span>
                                    Location
                                </button>
                            </div>
                        </div>

                        <!-- Card 2 - Middle -->
                        <div class="donor-card-3d card-middle">
                            <div class="card-header-3d">
                                <div class="donor-info-mini">
                                    <div class="donor-avatar-3d">
                                        <span class="avatar-emoji">👩‍⚕️</span>
                                    </div>
                                    <div class="donor-details">
                                        <h4>Sarah Ali</h4>
                                        <p>Chattogram</p>
                                    </div>
                                </div>
                                <div class="blood-badge-3d">A+</div>
                            </div>
                        </div>

                        <!-- Card 3 - Back -->
                        <div class="donor-card-3d card-back">
                            <div class="card-header-3d">
                                <div class="donor-info-mini">
                                    <div class="donor-avatar-3d">
                                        <span class="avatar-emoji">👨</span>
                                    </div>
                                    <div class="donor-details">
                                        <h4>Rahul Dev</h4>
                                        <p>Sylhet</p>
                                    </div>
                                </div>
                                <div class="blood-badge-3d">B+</div>
                            </div>
                        </div>
                    </div>

                    <!-- Floating Stats -->
                    <div class="floating-stat floating-stat-1">
                        <div class="stat-icon-wrapper">
                            <div class="stat-icon">🚀</div>
                        </div>
                        <div class="stat-content-wrapper">
                            <div class="stat-number-animated">{{ App\Models\Donor::where('is_available', true)->count() }}</div>
                            <div class="stat-label-small">Available Now</div>
                        </div>
                    </div>

                    <div class="floating-stat floating-stat-2">
                        <div class="stat-icon-wrapper success">
                            <div class="stat-icon">✓</div>
                        </div>
                        <div class="stat-content-wrapper">
                            <div class="stat-number-animated">98%</div>
                            <div class="stat-label-small">Success Rate</div>
                        </div>
                    </div>

                    <div class="floating-stat floating-stat-3">
                        <div class="stat-icon-wrapper info">
                            <div class="stat-icon">⚡</div>
                        </div>
                        <div class="stat-content-wrapper">
                            <div class="stat-number-animated">&lt;5m</div>
                            <div class="stat-label-small">Avg Response</div>
                        </div>
                    </div>

                    <!-- Decorative Elements -->
                    <div class="deco-circle deco-1"></div>
                    <div class="deco-circle deco-2"></div>
                    <div class="deco-line"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Wave -->
    <div class="hero-wave-modern">
        <svg viewBox="0 0 1440 120" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <linearGradient id="waveGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" style="stop-color:#ffffff;stop-opacity:0.8" />
                    <stop offset="100%" style="stop-color:#ffffff;stop-opacity:1" />
                </linearGradient>
            </defs>
            <path fill="url(#waveGradient)" d="M0,64L48,69.3C96,75,192,85,288,80C384,75,480,53,576,48C672,43,768,53,864,64C960,75,1056,85,1152,80C1248,75,1344,53,1392,42.7L1440,32L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z"></path>
        </svg>
    </div>
</div>

<!-- AOS Animation Library (Add to layout if not present) -->
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 50
        });
    });
</script>