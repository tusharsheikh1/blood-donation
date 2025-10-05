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
</style>