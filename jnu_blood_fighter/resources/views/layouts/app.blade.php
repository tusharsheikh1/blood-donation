<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - JnU LifeDrop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-red: #dc3545;
            --dark-red: #c82333;
            --light-red: #f8d7da;
            --accent-red: #ff4757;
            --logo-dark-red: #a71d2a;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            position: relative;
            overflow-x: hidden;
        }
        
        /* START: Style adjustment for fixed bottom nav on mobile */
        @media (max-width: 991.98px) {
            body {
                padding-bottom: 70px;
            }
        }
        /* END: Style adjustment for fixed bottom nav on mobile */

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 50%, rgba(220, 53, 69, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(220, 53, 69, 0.03) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        main {
            position: relative;
            z-index: 1;
        }

        /* Ultra Modern Navbar */
        .navbar-custom {
            background: rgba(220, 53, 69, 0.98);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            box-shadow: none;
            padding: 1.25rem 0;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border-bottom: none; 
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-custom.scrolled {
            padding: 0.75rem 0;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            background: rgba(220, 53, 69, 1);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover {
            transform: translateY(-2px);
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: white !important;
        }

        .nav-link {
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1);
            transition: left 0.3s ease;
        }

        .nav-link:hover::before {
            left: 0;
        }

        .nav-link:hover {
            transform: translateY(-2px);
            background: rgba(255, 255, 255, 0.1);
        }

        .nav-link i {
            margin-right: 0.25rem;
            transition: transform 0.3s ease;
        }

        .nav-link:hover i {
            transform: scale(1.2);
        }

        .navbar-toggler {
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            padding: 0.5rem;
            transition: all 0.3s ease;
        }

        .navbar-toggler:hover {
            border-color: white;
            background: rgba(255, 255, 255, 0.1);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Dropdown Menu */
        .dropdown-menu {
            border: none;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            border-radius: 12px;
            padding: 0.5rem;
            margin-top: 0.5rem;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dropdown-item {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            margin-bottom: 0.25rem;
        }

        .dropdown-item:hover {
            background-color: var(--light-red);
            color: var(--primary-red);
            transform: translateX(5px);
        }

        .dropdown-item i {
            margin-right: 0.5rem;
            transition: transform 0.3s ease;
        }

        .dropdown-item:hover i {
            transform: scale(1.2);
        }

        .dropdown-divider {
            margin: 0.5rem 0;
            opacity: 0.1;
        }

        /* Main Content Area */
        main {
            flex: 1;
        }

        /* Modern Footer */
        footer {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.1);
            margin-top: auto;
        }

        footer p {
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        footer a {
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
        }

        footer a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-red);
            transition: width 0.3s ease;
        }

        footer a:hover::after {
            width: 100%;
        }

        footer a:hover {
            color: var(--primary-red) !important;
        }

        /* Utility Classes */
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        }

        .btn {
            border-radius: 10px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-red) 0%, var(--dark-red) 100%);
        }

        /* Smooth Scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Content Container */
        .container {
            max-width: 1200px;
        }

        /* Alert Styling */
        .alert {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        /* Form Controls */
        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 0.75rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-red);
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.15);
        }

        /* Loading Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.6s ease;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-link {
                padding: 0.5rem !important;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                @include('components.logo')
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="bi bi-search"></i> Find Donors
                        </a>
                    </li>
                    @auth('web')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('donor.dashboard') }}">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i> {{ Auth::guard('web')->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('donor.profile') }}">
                                    <i class="bi bi-pencil"></i> Edit Profile
                                </a></li>
                                <li>
                                    <form method="POST" action="{{ route('donor.logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="bi bi-box-arrow-right"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('donor.register') }}">
                                <i class="bi bi-person-plus"></i> Register
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('donor.login') }}">
                                <i class="bi bi-box-arrow-in-right"></i> Login
                            </a>
                        </li>
                    @endauth
                    @auth('admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-shield-check"></i> Admin Panel
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-dark text-white text-center py-4">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} JnU LifeDrop. Saving Lives Together.</p>
            <small class="text-muted">
                <a href="{{ route('admin.login') }}" class="text-muted">Admin Login</a>
            </small>
        </div>
    </footer>
    
    {{-- START: Sticky Mobile Menu --}}
    @auth('web')
        <nav class="navbar fixed-bottom navbar-light bg-white border-top shadow-lg d-lg-none p-0" style="z-index: 1020;">
            <div class="container-fluid">
                <div class="row w-100 g-0">
                    <div class="col text-center">
                        <a class="nav-link p-2 text-dark" href="{{ url('/') }}" aria-label="Home">
    <i class="bi bi-grid-fill d-block fs-5"></i>
    <small>Home</small>
</a>

                    </div>
                    <div class="col text-center">
                        <a class="nav-link p-2 text-dark" href="{{ route('donor.dashboard') }}" aria-label="Dashboard">
    <i class="bi bi-speedometer2 d-block fs-5"></i>
    <small>Dashboard</small>
</a>

                    </div>
                    <div class="col text-center">
                        <a class="nav-link p-2 text-primary" href="{{ route('blood-request.my-requests') }}" aria-label="My Requests">
                            <i class="bi bi-clipboard-check-fill d-block fs-5"></i>
                            <small>Requests</small>
                        </a>
                    </div>
                    <div class="col text-center">
                        <a class="nav-link p-2 text-success" href="{{ route('donor.profile') }}" aria-label="Edit Profile">
                            <i class="bi bi-person-fill d-block fs-5"></i>
                            <small>Profile</small>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    @endauth
    {{-- END: Sticky Mobile Menu --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add scrolled class to navbar on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar-custom');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Add fade-in animation to content
        document.addEventListener('DOMContentLoaded', function() {
            const content = document.querySelector('main');
            if (content) {
                content.classList.add('fade-in');
            }
        });
    </script>
    @stack('scripts')
</body>
</html>