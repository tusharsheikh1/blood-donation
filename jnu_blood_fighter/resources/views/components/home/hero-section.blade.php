<style>
/* Ultra Modern Hero Section with Wave Design */
.hero-section {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 50%, #b21f2d 100%);
    padding: 5rem 0 8rem;
    position: relative;
    overflow: hidden;
    min-height: 75vh;
    display: flex;
    align-items: center;
}

/* Animated Wave Design */
.wave-container {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    overflow: hidden;
    line-height: 0;
    transform: rotate(180deg);
}

.wave-container svg {
    position: relative;
    display: block;
    width: calc(100% + 1.3px);
    height: 150px;
}

.wave-path-1 {
    fill: #f8f9fa;
    opacity: 0.3;
    animation: wave-animation-1 15s ease-in-out infinite;
}

.wave-path-2 {
    fill: #f8f9fa;
    opacity: 0.5;
    animation: wave-animation-2 12s ease-in-out infinite;
}

.wave-path-3 {
    fill: #f8f9fa;
    animation: wave-animation-3 10s ease-in-out infinite;
}

@keyframes wave-animation-1 {
    0%, 100% {
        transform: translateX(0) translateY(0);
    }
    50% {
        transform: translateX(-25px) translateY(5px);
    }
}

@keyframes wave-animation-2 {
    0%, 100% {
        transform: translateX(0) translateY(0);
    }
    50% {
        transform: translateX(25px) translateY(-8px);
    }
}

@keyframes wave-animation-3 {
    0%, 100% {
        transform: translateX(0) translateY(0);
    }
    50% {
        transform: translateX(-15px) translateY(-5px);
    }
}

/* Animated background elements */
.hero-section::before,
.hero-section::after {
    content: '';
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.05);
    animation: float 20s infinite ease-in-out;
}

.hero-section::before {
    width: 600px;
    height: 600px;
    top: -200px;
    right: -150px;
    animation-delay: 0s;
}

.hero-section::after {
    width: 400px;
    height: 400px;
    bottom: -100px;
    left: -100px;
    animation-delay: 5s;
}

@keyframes float {
    0%, 100% {
        transform: translate(0, 0) scale(1);
    }
    33% {
        transform: translate(30px, -30px) scale(1.1);
    }
    66% {
        transform: translate(-20px, 20px) scale(0.9);
    }
}

/* Floating particles */
.particle {
    position: absolute;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 50%;
    pointer-events: none;
    animation: particle-float 15s infinite ease-in-out;
}

.particle:nth-child(1) {
    width: 8px;
    height: 8px;
    top: 20%;
    left: 10%;
    animation-delay: 0s;
}

.particle:nth-child(2) {
    width: 12px;
    height: 12px;
    top: 60%;
    left: 80%;
    animation-delay: 3s;
}

.particle:nth-child(3) {
    width: 6px;
    height: 6px;
    top: 80%;
    left: 20%;
    animation-delay: 6s;
}

.particle:nth-child(4) {
    width: 10px;
    height: 10px;
    top: 30%;
    left: 70%;
    animation-delay: 9s;
}

.particle:nth-child(5) {
    width: 14px;
    height: 14px;
    top: 50%;
    left: 50%;
    animation-delay: 12s;
}

@keyframes particle-float {
    0%, 100% {
        transform: translateY(0) translateX(0);
        opacity: 0;
    }
    10% {
        opacity: 1;
    }
    90% {
        opacity: 1;
    }
    100% {
        transform: translateY(-120px) translateX(60px);
        opacity: 0;
    }
}

.hero-content {
    position: relative;
    z-index: 2;
    color: white;
}

/* Live Badge */
.live-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.95rem;
    margin-bottom: 2rem;
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    animation: pulse-glow 2s infinite;
}

@keyframes pulse-glow {
    0%, 100% {
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1), 0 0 20px rgba(255, 255, 255, 0.2);
    }
    50% {
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1), 0 0 30px rgba(255, 255, 255, 0.4);
    }
}

.live-indicator {
    width: 12px;
    height: 12px;
    background: #4ade80;
    border-radius: 50%;
    animation: pulse-dot 1.5s infinite;
    box-shadow: 0 0 0 0 rgba(74, 222, 128, 0.7);
}

@keyframes pulse-dot {
    0% {
        box-shadow: 0 0 0 0 rgba(74, 222, 128, 0.7);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(74, 222, 128, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(74, 222, 128, 0);
    }
}

/* Hero Title */
.hero-title {
    font-size: 4.5rem;
    font-weight: 900;
    line-height: 1.1;
    margin-bottom: 1.5rem;
    text-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    letter-spacing: -0.02em;
}

.hero-title-gradient {
    background: linear-gradient(to right, #ffffff 0%, #f8d7da 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Hero Description */
.hero-description {
    font-size: 1.35rem;
    line-height: 1.7;
    margin-bottom: 2.5rem;
    opacity: 0.95;
    max-width: 650px;
    font-weight: 400;
}

/* Feature Pills */
.feature-pills {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 3rem;
}

.feature-pill {
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    padding: 0.75rem 1.25rem;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1rem;
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
}

.feature-pill:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

.feature-pill i {
    font-size: 1.25rem;
}

/* CTA Buttons */
.hero-cta {
    display: flex;
    gap: 1.25rem;
    flex-wrap: wrap;
}

.btn-hero {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1.15rem 2.5rem;
    border-radius: 14px;
    font-weight: 700;
    font-size: 1.1rem;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    border: none;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.btn-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.btn-hero:hover::before {
    left: 100%;
}

.btn-hero-primary {
    background: white;
    color: #dc3545;
}

.btn-hero-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(255, 255, 255, 0.3);
    color: #dc3545;
}

.btn-hero-secondary {
    background: transparent;
    color: white;
    border: 2px solid rgba(255, 255, 255, 0.5);
}

.btn-hero-secondary:hover {
    background: rgba(255, 255, 255, 0.15);
    border-color: white;
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
    color: white;
}

.btn-hero i {
    font-size: 1.3rem;
    transition: transform 0.3s ease;
}

.btn-hero:hover i {
    transform: scale(1.15);
}

/* ========================================= */
/* DEMO DONOR CARD - DESKTOP ONLY */
/* ========================================= */
.demo-card-wrapper {
    position: relative;
    z-index: 2;
    display: none; /* Hidden by default (mobile) */
}

@media (min-width: 992px) {
    .demo-card-wrapper {
        display: block;
        animation: float-card 6s ease-in-out infinite;
    }
}

@keyframes float-card {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-20px);
    }
}

.demo-donor-card {
    background: white;
    border-radius: 24px;
    padding: 1.75rem;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    max-width: 340px;
    margin: 0 auto;
    position: relative;
}

/* Card Header */
.demo-card-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.25rem;
    position: relative;
}

.demo-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    position: relative;
}

.demo-avatar::after {
    content: '';
    position: absolute;
    width: 12px;
    height: 12px;
    background: #4ade80;
    border: 3px solid white;
    border-radius: 50%;
    top: -2px;
    right: -2px;
    animation: pulse-dot 1.5s infinite;
}

.demo-info {
    flex: 1;
}

.demo-name {
    font-size: 1.15rem;
    font-weight: 700;
    color: #1f2937;
    margin: 0;
    line-height: 1.2;
}

.demo-location {
    font-size: 0.85rem;
    color: #6b7280;
    display: flex;
    align-items: center;
    gap: 0.25rem;
    margin-top: 0.25rem;
}

.demo-location i {
    color: #dc3545;
    font-size: 0.75rem;
}

.demo-blood-badge {
    width: 55px;
    height: 55px;
    background: linear-gradient(135deg, #dc3545 0%, #b91c1c 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
    font-weight: 800;
    box-shadow: 0 8px 20px rgba(220, 53, 69, 0.4);
}

/* Stats Section */
.demo-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0.75rem;
    margin-bottom: 1.25rem;
}

.demo-stat {
    text-align: center;
}

.demo-stat-label {
    font-size: 0.7rem;
    color: #9ca3af;
    text-transform: uppercase;
    font-weight: 600;
    letter-spacing: 0.5px;
    margin-bottom: 0.25rem;
}

.demo-stat-value {
    font-size: 1.35rem;
    font-weight: 800;
    color: #1f2937;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.25rem;
}

.demo-stat-value i {
    color: #fbbf24;
    font-size: 1.1rem;
}

/* Availability Badge */
.demo-availability {
    background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
    padding: 0.85rem 1rem;
    border-radius: 12px;
    text-align: center;
    margin-bottom: 1.25rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.demo-availability i {
    color: #059669;
    font-size: 1rem;
}

.demo-availability-text {
    color: #059669;
    font-weight: 700;
    font-size: 0.95rem;
}

/* Action Buttons */
.demo-actions {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0.75rem;
}

.demo-action-btn {
    background: #f9fafb;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    padding: 1rem 0.5rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    cursor: pointer;
}

.demo-action-btn:hover {
    background: #f3f4f6;
    border-color: #dc3545;
    transform: translateY(-2px);
}

.demo-action-icon {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    color: white;
}

.demo-action-icon.call {
    background: linear-gradient(135deg, #dc3545 0%, #b91c1c 100%);
}

.demo-action-icon.message {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
}

.demo-action-icon.location {
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
}

.demo-action-label {
    font-size: 0.8rem;
    font-weight: 600;
    color: #4b5563;
}

/* Responsive Design */
@media (max-width: 991px) {
    .demo-card-wrapper {
        display: none !important; /* Force hide on tablets and mobile */
    }
}

@media (max-width: 768px) {
    .hero-section {
        padding: 4rem 0 6rem;
        min-height: auto;
    }

    .wave-container svg {
        height: 100px;
    }

    .hero-title {
        font-size: 3rem;
    }

    .hero-description {
        font-size: 1.1rem;
    }

    .feature-pills {
        margin-bottom: 2rem;
    }

    .feature-pill {
        font-size: 0.9rem;
        padding: 0.65rem 1rem;
    }

    .hero-cta {
        flex-direction: column;
    }

    .btn-hero {
        width: 100%;
        justify-content: center;
        padding: 1rem 2rem;
    }

    .hero-section::before {
        width: 400px;
        height: 400px;
    }

    .hero-section::after {
        width: 300px;
        height: 300px;
    }
}

@media (max-width: 480px) {
    .hero-title {
        font-size: 2.5rem;
    }

    .wave-container svg {
        height: 80px;
    }

    .live-badge {
        padding: 0.6rem 1.2rem;
        font-size: 0.85rem;
    }

    .hero-description {
        font-size: 1rem;
    }
}
</style>

<section class="hero-section">
    <!-- Animated Wave Design -->
    <div class="wave-container">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path class="wave-path-1" d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25"></path>
            <path class="wave-path-2" d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5"></path>
            <path class="wave-path-3" d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"></path>
        </svg>
    </div>
    
    <!-- Animated Particles -->
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    
    <div class="container">
        <div class="row align-items-center">
            <!-- Left Column: Content -->
            <div class="col-lg-7">
                <div class="hero-content">
                    <!-- Live Status Badge -->
                    <div class="live-badge">
                        <span class="live-indicator"></span>
                        <span>Trusted by 1000+ Life Savers</span>
                        <span class="badge bg-light text-danger ms-2 fw-bold">LIVE</span>
                    </div>

                    <!-- Main Headline -->
                    <h1 class="hero-title">
                        Find Blood Donors
                        <span class="d-block hero-title-gradient">Instantly</span>
                    </h1>

                    <!-- Description -->
                    <p class="hero-description">
                        Connect with verified blood donors in seconds. Our AI-powered platform matches you with the nearest donors based on blood type and location.
                    </p>

                    <!-- Feature Pills -->
                    <div class="feature-pills">
                        <div class="feature-pill">
                            <i class="bi bi-lightning-charge-fill"></i>
                            <span>Instant Match</span>
                        </div>
                        <div class="feature-pill">
                            <i class="bi bi-shield-fill-check"></i>
                            <span>Verified Donors</span>
                        </div>
                    </div>

                    <!-- Call-to-Action Buttons -->
                    <div class="hero-cta">
                        <a href="{{ route('donor.register') }}" class="btn-hero btn-hero-primary">
                            <i class="bi bi-person-plus-fill"></i>
                            <span>Become a Donor</span>
                        </a>
                        <a href="{{ route('donor.login') }}" class="btn-hero btn-hero-secondary">
                            <i class="bi bi-box-arrow-in-right"></i>
                            <span>Sign In</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Column: Demo Donor Card (Desktop Only) -->
            <div class="col-lg-5">
                <div class="demo-card-wrapper">
                    <div class="demo-donor-card">
                        <!-- Card Header -->
                        <div class="demo-card-header">
                            <div class="demo-avatar">
                                👨
                            </div>
                            <div class="demo-info">
                                <h3 class="demo-name">Ahmed Khan</h3>
                                <p class="demo-location">
                                    <i class="bi bi-geo-alt-fill"></i>
                                    Dhaka, 2.5 km
                                </p>
                            </div>
                            <div class="demo-blood-badge">O+</div>
                        </div>

                        <!-- Stats -->
                        <div class="demo-stats">
                            <div class="demo-stat">
                                <div class="demo-stat-label">Donations</div>
                                <div class="demo-stat-value">12</div>
                            </div>
                            <div class="demo-stat">
                                <div class="demo-stat-label">Response</div>
                                <div class="demo-stat-value">2m</div>
                            </div>
                            <div class="demo-stat">
                                <div class="demo-stat-label">Rating</div>
                                <div class="demo-stat-value">
                                    <i class="bi bi-star-fill"></i> 5.0
                                </div>
                            </div>
                        </div>

                        <!-- Availability -->
                        <div class="demo-availability">
                            <i class="bi bi-circle-fill"></i>
                            <span class="demo-availability-text">Available Now</span>
                        </div>

                        <!-- Actions -->
                        <div class="demo-actions">
                            <div class="demo-action-btn">
                                <div class="demo-action-icon call">
                                    <i class="bi bi-telephone-fill"></i>
                                </div>
                                <span class="demo-action-label">Call</span>
                            </div>
                            <div class="demo-action-btn">
                                <div class="demo-action-icon message">
                                    <i class="bi bi-chat-dots-fill"></i>
                                </div>
                                <span class="demo-action-label">Message</span>
                            </div>
                            <div class="demo-action-btn">
                                <div class="demo-action-icon location">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                                <span class="demo-action-label">Location</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>