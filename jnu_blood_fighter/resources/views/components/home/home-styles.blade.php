<style>
/* ================================
   Blood Donor Finder - All Styles
   ================================ */

:root {
    --primary-color: #dc3545;
    --primary-dark: #c82333;
    --primary-light: #f8d7da;
    --success-color: #28a745;
    --warning-color: #ffc107;
    --text-dark: #2c3e50;
    --text-muted: #6c757d;
    --border-color: #e9ecef;
    --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.08);
    --shadow-lg: 0 8px 24px rgba(0, 0, 0, 0.12);
    --radius-sm: 8px;
    --radius-md: 12px;
    --radius-lg: 16px;
}

* {
    box-sizing: border-box;
}

body {
    overflow-x: hidden;
}

/* Main Content */
.main-content {
    padding-bottom: 80px;
}

/* Hero Section */
.hero-section {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    padding: 80px 0 60px;
    margin-bottom: 60px;
    position: relative;
    overflow: hidden;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
}

.hero-title {
    font-size: clamp(2rem, 5vw, 3.5rem);
    font-weight: 800;
    color: white;
    margin-bottom: 1rem;
    line-height: 1.2;
}

.text-highlight {
    background: linear-gradient(to right, #fff, rgba(255, 255, 255, 0.8));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-subtitle {
    font-size: clamp(1rem, 2vw, 1.25rem);
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 2rem;
}

.hero-actions {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.hero-actions .btn {
    padding: 0.875rem 2rem;
    font-weight: 600;
    border-radius: 12px;
    transition: all 0.3s ease;
    position: relative;
    z-index: 10;
    cursor: pointer;
}

.hero-actions .btn-primary {
    background: white !important;
    color: #dc3545 !important;
    border: 2px solid white !important;
}

.hero-actions .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(255, 255, 255, 0.3);
    background: #f8f9fa !important;
}

.hero-actions .btn-outline-primary {
    border: 2px solid white !important;
    color: white !important;
    background: transparent !important;
}

.hero-actions .btn-outline-primary:hover {
    background: white !important;
    color: #dc3545 !important;
}

.floating-card {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    padding: 3rem;
    border-radius: 16px;
    text-align: center;
    animation: float 3s ease-in-out infinite;
}

.floating-card i {
    font-size: 4rem;
    color: white;
    display: block;
    margin-bottom: 1rem;
}

.floating-card span {
    color: white;
    font-size: 1.5rem;
    font-weight: 700;
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-20px); }
}

/* Alert Styles */
.alert-modern {
    border: none;
    border-radius: 12px;
    padding: 1rem 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.alert-modern i {
    font-size: 1.5rem;
}

.alert-modern .btn-close {
    margin-left: auto;
}

/* Section Headers */
.section-header {
    margin-bottom: 2rem;
}

.section-title {
    font-size: clamp(1.5rem, 3vw, 2rem);
    font-weight: 700;
    color: var(--text-dark);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.section-subtitle {
    color: var(--text-muted);
    margin-top: 0.5rem;
    font-size: 1rem;
}

/* Badges */
.badge-count {
    background: var(--primary-color);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.875rem;
    display: inline-block;
}

.badge-count.emergency {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}

.badge-filter {
    background: #e3f2fd;
    color: #1976d2;
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-size: 0.875rem;
    font-weight: 600;
    display: inline-block;
}

/* Search Section */
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

/* Donors Section */
.donors-section {
    margin-bottom: 4rem;
}

/* Donor Card */
.donor-card {
    background: white;
    border-radius: 16px;
    padding: 1.5rem;
    margin-bottom: 1rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    border: 1px solid #e9ecef;
    display: grid;
    grid-template-columns: auto 1fr auto;
    gap: 1.5rem;
    align-items: center;
    transition: all 0.3s ease;
}

.donor-card:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    transform: translateY(-2px);
    border-color: #dc3545;
}

.donor-blood-type {
    text-align: center;
}

.blood-badge {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, #dc3545, #c82333);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: 700;
    box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
    margin-bottom: 0.5rem;
}

.status-badge {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 600;
}

.status-ready {
    background: #d4edda;
    color: #155724;
}

.status-wait {
    background: #fff3cd;
    color: #856404;
}

.donor-info {
    flex: 1;
}

.donor-name {
    font-size: 1.25rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.donor-location,
.donor-meta {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #6c757d;
    font-size: 0.875rem;
    margin-bottom: 0.25rem;
}

.donor-location i,
.donor-meta i {
    color: #dc3545;
}

.donor-status-text {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    margin-top: 0.5rem;
    font-weight: 600;
}

.donor-status-text.success {
    color: #28a745;
}

.donor-status-text.warning {
    color: #856404;
}

.donor-status-text.new {
    color: #0056b3;
}

.donor-action {
    text-align: center;
}

.btn-call {
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    font-weight: 600;
    margin-bottom: 0.5rem;
    white-space: nowrap;
}

.phone-number {
    display: block;
    color: #6c757d;
    font-size: 0.75rem;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 16px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.empty-state i {
    font-size: 5rem;
    color: #e9ecef;
    margin-bottom: 1rem;
}

.empty-state h3 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.empty-state p {
    color: #6c757d;
    margin-bottom: 2rem;
}

.empty-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

/* Blood Requests Section */
.requests-section {
    margin-bottom: 4rem;
}

/* Blood Request Card */
.request-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    border: 2px solid #e9ecef;
    height: 100%;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
}

.request-card:hover {
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    transform: translateY(-4px);
}

.request-card.emergency {
    border-color: #dc3545;
    animation: borderPulse 2s infinite;
}

.request-card.urgent {
    border-color: #ffc107;
}

@keyframes borderPulse {
    0%, 100% { border-color: #dc3545; }
    50% { border-color: #ff4d5e; }
}

.request-badge {
    padding: 0.625rem 1rem;
    font-weight: 700;
    font-size: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.request-badge.emergency {
    background: #dc3545;
    color: white;
}

.request-badge.urgent {
    background: #ffc107;
    color: #000;
}

.request-content {
    padding: 1.25rem;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.request-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #e9ecef;
}

.blood-badge-compact {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #dc3545, #c82333);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    font-weight: 700;
    box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
}

.blood-quantity-compact {
    background: #f8f9fa;
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-weight: 700;
    font-size: 0.875rem;
    color: #2c3e50;
    border: 1px solid #e9ecef;
}

.request-info {
    flex: 1;
}

.request-patient {
    font-size: 1.125rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 0.875rem;
    line-height: 1.3;
}

.request-detail {
    display: flex;
    align-items: flex-start;
    gap: 0.625rem;
    margin-bottom: 0.625rem;
    font-size: 0.8125rem;
    color: #2c3e50;
}

.request-detail i {
    color: #dc3545;
    margin-top: 2px;
    font-size: 0.875rem;
    flex-shrink: 0;
}

.request-detail span {
    line-height: 1.4;
}

.request-notes-compact {
    background: #fff3cd;
    padding: 0.625rem;
    border-radius: 8px;
    font-size: 0.75rem;
    color: #856404;
    margin: 0.875rem 0;
    display: flex;
    gap: 0.5rem;
    align-items: flex-start;
    border-left: 3px solid #ffc107;
}

.request-notes-compact i {
    flex-shrink: 0;
    margin-top: 2px;
}

.request-footer {
    margin-top: auto;
    padding-top: 1rem;
    border-top: 1px solid #e9ecef;
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.request-footer .btn {
    border-radius: 8px;
    font-weight: 600;
    padding: 0.625rem 1rem;
}

.request-time {
    font-size: 0.7rem;
    color: #6c757d;
    text-align: center;
    background: #f8f9fa;
    padding: 0.375rem 0.75rem;
    border-radius: 50px;
}

/* Pagination */
.pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 2rem;
}

.pagination-wrapper nav {
    width: 100%;
    display: flex;
    justify-content: center;
}

.pagination {
    display: flex;
    padding-left: 0;
    list-style: none;
    border-radius: 12px;
    gap: 0.5rem;
    flex-wrap: wrap;
    justify-content: center;
}

.page-item {
    margin: 0;
}

.page-link {
    position: relative;
    display: block;
    padding: 0.5rem 0.75rem;
    color: #dc3545;
    text-decoration: none;
    background-color: #fff;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.page-link:hover {
    z-index: 2;
    color: #c82333;
    background-color: #f8d7da;
    border-color: #dc3545;
}

.page-link:focus {
    z-index: 3;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
}

.page-item.active .page-link {
    z-index: 3;
    color: #fff;
    background-color: #dc3545;
    border-color: #dc3545;
}

.page-item.disabled .page-link {
    color: #6c757d;
    pointer-events: none;
    background-color: #fff;
    border-color: #e9ecef;
    opacity: 0.5;
}

/* Mobile Responsive */
@media (max-width: 991px) {
    .hero-section {
        padding: 60px 0 40px;
        margin-bottom: 40px;
    }
    
    .donor-card {
        grid-template-columns: auto 1fr;
        gap: 1rem;
    }
    
    .donor-action {
        grid-column: 1 / -1;
    }
    
    .btn-call {
        width: 100%;
    }
}

@media (max-width: 767px) {
    .blood-badge-compact {
        width: 50px;
        height: 50px;
        font-size: 1rem;
    }
    
    .request-patient {
        font-size: 1rem;
    }
    
    .request-detail {
        font-size: 0.75rem;
    }
}

@media (max-width: 575px) {
    .hero-actions {
        flex-direction: column;
        width: 100%;
    }
    
    .hero-actions .btn {
        width: 100%;
    }
    
    .search-card {
        padding: 1.25rem;
    }
    
    .donor-card {
        padding: 1rem;
        grid-template-columns: 1fr;
        text-align: center;
    }
    
    .donor-info {
        text-align: center;
    }
    
    .donor-location,
    .donor-meta,
    .donor-status-text {
        justify-content: center;
    }
    
    .blood-badge {
        margin: 0 auto 0.5rem;
    }
    
    .badge-count {
        font-size: 0.75rem;
        padding: 0.375rem 0.75rem;
    }
    
    .section-title {
        font-size: 1.25rem;
    }
    
    .page-link {
        padding: 0.375rem 0.625rem;
        font-size: 0.875rem;
    }
    
    .pagination {
        gap: 0.25rem;
    }
}

/* ================================
   ULTRA-MODERN HERO SECTION
   Next-Gen Design System
   ================================ */

:root {
    --hero-primary: #dc3545;
    --hero-primary-dark: #c82333;
    --hero-gradient-start: #ff4d5e;
    --hero-gradient-end: #c82333;
    --hero-text: #ffffff;
    --hero-text-secondary: rgba(255, 255, 255, 0.9);
    --shadow-elevation-1: 0 2px 8px rgba(0, 0, 0, 0.08);
    --shadow-elevation-2: 0 4px 16px rgba(0, 0, 0, 0.12);
    --shadow-elevation-3: 0 8px 32px rgba(0, 0, 0, 0.16);
    --shadow-elevation-4: 0 16px 48px rgba(0, 0, 0, 0.20);
}

/* Main Hero Container */
.hero-section-ultra-modern {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    overflow: hidden;
    padding: 120px 0 100px;
}

/* Animated Background */
.hero-bg-wrapper {
    position: absolute;
    inset: 0;
    z-index: 0;
}

.animated-gradient {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, 
        var(--hero-gradient-start) 0%, 
        var(--hero-primary) 50%, 
        var(--hero-gradient-end) 100%);
    animation: gradient-shift-bg 15s ease infinite;
    background-size: 200% 200%;
}

@keyframes gradient-shift-bg {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

.grid-overlay {
    position: absolute;
    inset: 0;
    background-image: 
        linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
    background-size: 50px 50px;
    opacity: 0.5;
}

/* Particle Animation */
.particle-container {
    position: absolute;
    inset: 0;
}

.particle {
    position: absolute;
    width: 4px;
    height: 4px;
    background: rgba(255, 255, 255, 0.6);
    border-radius: 50%;
    animation: float-particles 20s infinite ease-in-out;
}

.particle:nth-child(1) { left: 10%; top: 20%; animation-delay: 0s; animation-duration: 15s; }
.particle:nth-child(2) { left: 30%; top: 40%; animation-delay: 2s; animation-duration: 18s; }
.particle:nth-child(3) { left: 50%; top: 30%; animation-delay: 4s; animation-duration: 20s; }
.particle:nth-child(4) { left: 70%; top: 50%; animation-delay: 1s; animation-duration: 16s; }
.particle:nth-child(5) { left: 85%; top: 25%; animation-delay: 3s; animation-duration: 19s; }
.particle:nth-child(6) { left: 15%; top: 60%; animation-delay: 5s; animation-duration: 17s; }

@keyframes float-particles {
    0%, 100% { transform: translate(0, 0) scale(1); opacity: 0; }
    10% { opacity: 1; }
    90% { opacity: 1; }
    50% { transform: translate(50px, -100px) scale(1.5); }
}

/* Content Wrapper */
.hero-content-wrapper {
    position: relative;
    z-index: 2;
}

/* Top Pill Badge */
.hero-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    padding: 8px 20px;
    border-radius: 100px;
    margin-bottom: 24px;
    box-shadow: var(--shadow-elevation-2);
    animation: slide-in-top 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

@keyframes slide-in-top {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.pill-icon {
    font-size: 18px;
    animation: bounce-icon 2s infinite;
}

@keyframes bounce-icon {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-4px); }
}

.pill-text {
    color: var(--hero-text);
    font-weight: 600;
    font-size: 14px;
}

.pill-badge {
    background: rgba(255, 255, 255, 0.25);
    color: white;
    padding: 4px 12px;
    border-radius: 100px;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    animation: pulse-badge 2s infinite;
}

@keyframes pulse-badge {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

/* Main Heading */
.hero-heading {
    font-size: clamp(3rem, 8vw, 5.5rem);
    font-weight: 900;
    line-height: 1.1;
    margin-bottom: 24px;
    letter-spacing: -0.02em;
}

.heading-line {
    display: block;
    color: var(--hero-text);
}

.heading-highlight {
    position: relative;
    display: inline-block;
}

.text-morph {
    background: linear-gradient(135deg, #ffffff 0%, rgba(255, 255, 255, 0.8) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: text-glow 3s ease-in-out infinite;
}

@keyframes text-glow {
    0%, 100% { filter: brightness(1); }
    50% { filter: brightness(1.2); }
}

.heading-underline {
    position: absolute;
    bottom: 8px;
    left: 0;
    right: 0;
    height: 16px;
    background: rgba(255, 255, 255, 0.3);
    border-radius: 8px;
    z-index: -1;
    animation: expand-underline 1s cubic-bezier(0.16, 1, 0.3, 1) 0.5s both;
}

@keyframes expand-underline {
    from {
        transform: scaleX(0);
        opacity: 0;
    }
    to {
        transform: scaleX(1);
        opacity: 1;
    }
}

/* Description */
.hero-description {
    font-size: clamp(1.125rem, 2vw, 1.375rem);
    color: var(--hero-text-secondary);
    line-height: 1.7;
    margin-bottom: 32px;
    max-width: 600px;
}

/* Features List */
.hero-features {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
    margin-bottom: 40px;
    max-width: 500px;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 12px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    padding: 12px 16px;
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.15);
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}

.feature-item:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
    box-shadow: var(--shadow-elevation-2);
}

.feature-icon {
    font-size: 24px;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 10px;
}

.feature-item span {
    color: var(--hero-text);
    font-weight: 600;
    font-size: 14px;
}

/* CTA Buttons */
.hero-cta-wrapper {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
    margin-bottom: 48px;
}

.btn-modern {
    position: relative;
    display: inline-flex;
    align-items: center;
    gap: 12px;
    padding: 18px 28px;
    border-radius: 16px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    overflow: hidden;
    border: 2px solid transparent;
}

.btn-primary-modern {
    background: white;
    color: var(--hero-primary);
    box-shadow: var(--shadow-elevation-3);
}

.btn-primary-modern::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(220, 53, 69, 0.1), transparent);
    opacity: 0;
    transition: opacity 0.3s;
}

.btn-primary-modern:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-elevation-4);
    color: var(--hero-primary-dark);
}

.btn-primary-modern:hover::before {
    opacity: 1;
}

.btn-secondary-modern {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    color: white;
    border-color: rgba(255, 255, 255, 0.3);
}

.btn-secondary-modern:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: translateY(-4px);
    border-color: rgba(255, 255, 255, 0.5);
    color: white;
}

.btn-icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(220, 53, 69, 0.1);
    border-radius: 10px;
    flex-shrink: 0;
}

.btn-primary-modern .btn-icon {
    background: rgba(220, 53, 69, 0.1);
    color: var(--hero-primary);
}

.btn-secondary-modern .btn-icon {
    background: rgba(255, 255, 255, 0.2);
    font-size: 20px;
}

.btn-content {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 2px;
}

.btn-text {
    font-size: 16px;
    line-height: 1;
}

.btn-subtext {
    font-size: 12px;
    font-weight: 500;
    opacity: 0.7;
}

.btn-arrow {
    font-size: 20px;
    transition: transform 0.3s;
}

.btn-modern:hover .btn-arrow {
    transform: translateX(4px);
}

/* Trust Bar */
.trust-bar {
    display: flex;
    align-items: center;
    gap: 24px;
    padding: 20px 24px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    max-width: 500px;
}

.trust-item {
    display: flex;
    align-items: center;
    gap: 12px;
}

.trust-avatar-group {
    display: flex;
    align-items: center;
}

.trust-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    border: 2px solid var(--hero-primary);
    margin-left: -8px;
}

.trust-avatar:first-child {
    margin-left: 0;
}

.trust-avatar-more {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    font-weight: 700;
    color: white;
    border: 2px solid var(--hero-primary);
    margin-left: -8px;
}

.trust-text {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.trust-text strong {
    color: white;
    font-size: 14px;
    font-weight: 700;
}

.trust-text span {
    color: rgba(255, 255, 255, 0.8);
    font-size: 12px;
}

.trust-divider {
    width: 1px;
    height: 40px;
    background: rgba(255, 255, 255, 0.2);
}

.trust-rating {
    display: flex;
    align-items: center;
    gap: 6px;
}

.star {
    font-size: 20px;
}

.rating-number {
    font-size: 24px;
    font-weight: 800;
    color: white;
}

/* Hero Visual */
.hero-visual-wrapper {
    position: relative;
    height: 600px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* 3D Card Stack */
.card-stack {
    position: relative;
    width: 400px;
    height: 500px;
    perspective: 1500px;
}

.donor-card-3d {
    position: absolute;
    width: 100%;
    background: white;
    border-radius: 24px;
    padding: 24px;
    box-shadow: var(--shadow-elevation-4);
    transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

.card-front {
    z-index: 3;
    transform: translateZ(0) rotateY(0deg);
    animation: card-float 6s ease-in-out infinite;
}

.card-middle {
    z-index: 2;
    transform: translateZ(-100px) translateY(40px) scale(0.9) rotateY(-5deg);
    opacity: 0.6;
}

.card-back {
    z-index: 1;
    transform: translateZ(-200px) translateY(80px) scale(0.8) rotateY(-10deg);
    opacity: 0.3;
}

@keyframes card-float {
    0%, 100% { transform: translateZ(0) translateY(0) rotateY(0deg); }
    50% { transform: translateZ(20px) translateY(-15px) rotateY(3deg); }
}

.card-glow {
    position: absolute;
    inset: -2px;
    background: linear-gradient(135deg, var(--hero-primary), transparent);
    border-radius: 24px;
    opacity: 0;
    z-index: -1;
    transition: opacity 0.3s;
}

.card-front:hover .card-glow {
    opacity: 0.4;
    animation: glow-pulse 2s ease-in-out infinite;
}

@keyframes glow-pulse {
    0%, 100% { opacity: 0.4; }
    50% { opacity: 0.6; }
}

/* Card Header */
.card-header-3d {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}

.donor-info-mini {
    display: flex;
    align-items: center;
    gap: 12px;
}

.donor-avatar-3d {
    position: relative;
    width: 56px;
    height: 56px;
    background: linear-gradient(135deg, #f8d7da, #f5c2c7);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
}

.status-ring {
    position: absolute;
    top: -3px;
    right: -3px;
    width: 16px;
    height: 16px;
    background: #28a745;
    border: 3px solid white;
    border-radius: 50%;
    animation: pulse-ring 2s infinite;
}

@keyframes pulse-ring {
    0%, 100% {
        box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7);
    }
    50% {
        box-shadow: 0 0 0 8px rgba(40, 167, 69, 0);
    }
}

.donor-details h4 {
    font-size: 18px;
    font-weight: 700;
    color: #2c3e50;
    margin: 0;
}

.donor-details p {
    font-size: 13px;
    color: #6c757d;
    margin: 4px 0 0;
    display: flex;
    align-items: center;
    gap: 4px;
}

.location-pin {
    font-size: 12px;
}

.blood-badge-3d {
    position: relative;
    width: 64px;
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.badge-inner {
    width: 56px;
    height: 56px;
    background: linear-gradient(135deg, var(--hero-primary), var(--hero-primary-dark));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    font-weight: 800;
    color: white;
    box-shadow: var(--shadow-elevation-2);
    z-index: 1;
}

.badge-ring {
    position: absolute;
    inset: 0;
    border: 3px solid var(--hero-primary);
    border-radius: 50%;
    opacity: 0.3;
    animation: expand-ring 2s infinite;
}

@keyframes expand-ring {
    0% {
        transform: scale(1);
        opacity: 0.3;
    }
    100% {
        transform: scale(1.3);
        opacity: 0;
    }
}

/* Card Body */
.card-body-3d {
    margin-bottom: 20px;
}

.stat-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin-bottom: 20px;
}

.stat-col {
    text-align: center;
    padding: 12px;
    background: #f8f9fa;
    border-radius: 12px;
}

.stat-label {
    display: block;
    font-size: 11px;
    color: #6c757d;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 6px;
}

.stat-value {
    display: block;
    font-size: 18px;
    font-weight: 800;
    color: #2c3e50;
}

.availability-bar {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    background: linear-gradient(135deg, #d4edda, #c3e6cb);
    border-radius: 12px;
}

.availability-indicator {
    width: 12px;
    height: 12px;
    background: #28a745;
    border-radius: 50%;
    animation: pulse-indicator 2s infinite;
}

@keyframes pulse-indicator {
    0%, 100% {
        transform: scale(1);
        opacity: 1;
    }
    50% {
        transform: scale(1.3);
        opacity: 0.7;
    }
}

.availability-bar span {
    font-size: 14px;
    font-weight: 700;
    color: #155724;
}

/* Card Footer */
.card-footer-3d {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 8px;
}

.quick-action-btn {
    padding: 10px;
    border: 2px solid #e9ecef;
    background: white;
    border-radius: 10px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
    font-size: 12px;
    font-weight: 600;
    color: #2c3e50;
    cursor: pointer;
    transition: all 0.3s;
}

.quick-action-btn:hover {
    transform: translateY(-2px);
    border-color: var(--hero-primary);
    color: var(--hero-primary);
    box-shadow: var(--shadow-elevation-1);
}

.btn-icon-small {
    font-size: 20px;
}

/* Floating Stats */
.floating-stat {
    position: absolute;
    display: flex;
    align-items: center;
    gap: 12px;
    background: white;
    padding: 16px 20px;
    border-radius: 16px;
    box-shadow: var(--shadow-elevation-3);
    animation: float-stat 4s ease-in-out infinite;
}

.floating-stat-1 {
    top: 10%;
    right: -50px;
    animation-delay: 0s;
}

.floating-stat-2 {
    bottom: 30%;
    left: -60px;
    animation-delay: 1.5s;
}

.floating-stat-3 {
    top: 50%;
    right: -40px;
    animation-delay: 3s;
}

@keyframes float-stat {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-20px);
    }
}

.stat-icon-wrapper {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, var(--hero-primary), var(--hero-primary-dark));
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
    flex-shrink: 0;
}

.stat-icon-wrapper.success {
    background: linear-gradient(135deg, #28a745, #218838);
}

.stat-icon-wrapper.info {
    background: linear-gradient(135deg, #17a2b8, #138496);
}

.stat-content-wrapper {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.stat-number-animated {
    font-size: 24px;
    font-weight: 800;
    color: #2c3e50;
    line-height: 1;
}

.stat-label-small {
    font-size: 12px;
    color: #6c757d;
    font-weight: 600;
}

/* Decorative Elements */
.deco-circle {
    position: absolute;
    border-radius: 50%;
    border: 2px dashed rgba(220, 53, 69, 0.3);
}

.deco-1 {
    width: 200px;
    height: 200px;
    top: -50px;
    left: -50px;
    animation: rotate-deco 20s linear infinite;
}

.deco-2 {
    width: 150px;
    height: 150px;
    bottom: 0;
    right: -30px;
    animation: rotate-deco 15s linear infinite reverse;
}

@keyframes rotate-deco {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

.deco-line {
    position: absolute;
    top: 50%;
    left: -100px;
    right: -100px;
    height: 2px;
    background: linear-gradient(90deg, 
        transparent, 
        rgba(220, 53, 69, 0.2) 20%, 
        rgba(220, 53, 69, 0.2) 80%, 
        transparent);
    transform: translateY(-50%);
}

/* Wave */
.hero-wave-modern {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 1;
}

.hero-wave-modern svg {
    display: block;
    width: 100%;
    height: auto;
}

/* Utility */
.min-vh-70 {
    min-height: 70vh;
}

/* Responsive Design */
@media (max-width: 1400px) {
    .floating-stat-1,
    .floating-stat-2,
    .floating-stat-3 {
        display: none;
    }
}

@media (max-width: 991px) {
    .hero-section-ultra-modern {
        padding: 80px 0 80px;
        min-height: auto;
    }

    .hero-heading {
        font-size: clamp(2.5rem, 7vw, 4rem);
    }

    .hero-features {
        grid-template-columns: 1fr;
        max-width: 100%;
    }

    .trust-bar {
        flex-direction: column;
        align-items: flex-start;
        max-width: 100%;
    }

    .trust-divider {
        width: 100%;
        height: 1px;
    }
}

@media (max-width: 767px) {
    .hero-section-ultra-modern {
        padding: 60px 0 60px;
    }

    .hero-pill {
        font-size: 12px;
        padding: 6px 16px;
    }

    .pill-icon {
        font-size: 16px;
    }

    .hero-heading {
        font-size: 2.5rem;
        margin-bottom: 20px;
    }

    .hero-description {
        font-size: 1rem;
        margin-bottom: 24px;
    }

    .hero-features {
        margin-bottom: 32px;
    }

    .feature-item {
        padding: 10px 14px;
    }

    .feature-icon {
        width: 36px;
        height: 36px;
        font-size: 20px;
    }

    .hero-cta-wrapper {
        flex-direction: column;
        width: 100%;
        gap: 12px;
    }

    .btn-modern {
        width: 100%;
        justify-content: center;
        padding: 16px 24px;
    }

    .trust-bar {
        padding: 16px 20px;
    }
}

@media (max-width: 575px) {
    .hero-heading {
        font-size: 2rem;
    }

    .heading-underline {
        height: 12px;
        bottom: 4px;
    }

    .hero-description {
        font-size: 0.938rem;
    }

    .feature-item span {
        font-size: 13px;
    }

    .btn-text {
        font-size: 15px;
    }

    .btn-subtext {
        font-size: 11px;
    }

    .trust-avatar,
    .trust-avatar-more {
        width: 32px;
        height: 32px;
        font-size: 14px;
    }

    .trust-text strong {
        font-size: 13px;
    }

    .trust-text span {
        font-size: 11px;
    }

    .rating-number {
        font-size: 20px;
    }
}

/* Performance Optimizations */
@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}

/* Dark Mode Support (if needed) */
@media (prefers-color-scheme: dark) {
    .donor-card-3d {
        background: #2c3e50;
        color: white;
    }

    .donor-details h4 {
        color: white;
    }

    .donor-details p {
        color: rgba(255, 255, 255, 0.7);
    }

    .stat-col {
        background: #34495e;
    }

    .stat-value {
        color: white;
    }

    .quick-action-btn {
        background: #34495e;
        border-color: #4a5f7f;
        color: white;
    }

    .floating-stat {
        background: #2c3e50;
        color: white;
    }

    .stat-number-animated {
        color: white;
    }
}
</style>

