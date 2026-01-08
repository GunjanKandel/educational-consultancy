<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Home') - Educational Consultancy</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        /* ============================================
           PROJECT 1 COLOR SCHEME APPLIED
           ============================================ */
        :root {
            --primary-color: #0a4d68;
            --secondary-color: #088395;
            --accent-color: #05bfdb;
            --light-bg: #f8f9fa;
            --dark-text: #2c3e50;
            --gradient-primary: linear-gradient(135deg, #0a4d68 0%, #088395 100%);
            --gradient-accent: linear-gradient(135deg, #088395, #05bfdb);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            color: var(--dark-text);
            line-height: 1.6;
        }

        /* ============================================
           NAVIGATION BAR STYLING
           ============================================ */
        .navbar {
            background: rgba(10, 77, 104, 0.98) !important;
            backdrop-filter: blur(15px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 1.2rem 0;
            transition: all 0.4s ease;
        }

        .navbar.scrolled {
            padding: 0.8rem 0;
            background: rgba(10, 77, 104, 1) !important;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.2);
        }

        .navbar-brand {
            font-size: 1.6rem;
            font-weight: 800;
            color: #ffffff !important;
            letter-spacing: 0.5px;
            transition: transform 0.3s;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .navbar-brand i {
            color: var(--accent-color);
            margin-right: 8px;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.95) !important;
            font-weight: 500;
            font-size: 0.95rem;
            padding: 0.5rem 1rem !important;
            margin: 0 0.2rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 5px;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--accent-color);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 60%;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--accent-color) !important;
            background: rgba(5, 191, 219, 0.1);
        }

        .btn-apply-nav {
            background: var(--accent-color) !important;
            color: white !important;
            padding: 0.65rem 1.8rem !important;
            border-radius: 30px;
            font-weight: 600;
            border: none;
            margin-left: 1rem;
            transition: all 0.4s ease;
            box-shadow: 0 4px 15px rgba(5, 191, 219, 0.3);
        }

        .btn-apply-nav:hover {
            background: var(--secondary-color) !important;
            transform: translateY(-3px);
            box-shadow: 0 6px 25px rgba(5, 191, 219, 0.5);
        }

        /* ============================================
           HERO SECTION WITH PROJECT 1 GRADIENT
           ============================================ */
        .hero-section {
            background: var(--gradient-primary);
            color: white;
            padding: 140px 0 100px;
            position: relative;
            overflow: hidden;
            min-height: 600px;
        }

        .hero-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.08)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
            background-size: cover;
            background-position: bottom;
            opacity: 0.4;
        }

        .hero-section::after {
            content: "";
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(5, 191, 219, 0.2), transparent);
            top: -100px;
            right: -100px;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-30px); }
        }

        .hero-section .container {
            position: relative;
            z-index: 2;
        }

        .hero-section h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .hero-section .lead {
            font-size: 1.25rem;
            font-weight: 400;
            opacity: 0.95;
            margin-bottom: 2.5rem;
            line-height: 1.8;
        }

        .hero-section .btn {
            padding: 1rem 2.5rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.05rem;
            transition: all 0.4s ease;
            border: 2px solid white;
        }

        .hero-section .btn-light {
            background: white;
            color: var(--primary-color);
            border-color: white;
        }

        .hero-section .btn-light:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 30px rgba(255, 255, 255, 0.3);
            background: #ffffff;
        }

        .hero-section .btn-outline-light:hover {
            background: white;
            color: var(--primary-color);
            transform: translateY(-4px);
        }

        .hero-section img {
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: fadeInRight 1s ease-out;
        }

        /* ============================================
           STATS CARDS WITH PROJECT 1 STYLE
           ============================================ */
        .stats-section {
            background: var(--light-bg);
            padding: 80px 0;
        }

        .stats-card {
            background: white;
            border-radius: 20px;
            padding: 3rem 2rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid rgba(8, 131, 149, 0.1);
            height: 100%;
        }

        .stats-card:hover {
            transform: translateY(-15px) scale(1.03);
            box-shadow: 0 20px 50px rgba(8, 131, 149, 0.2);
            border-color: var(--accent-color);
        }

        .stats-card i {
            color: var(--secondary-color);
            transition: all 0.4s ease;
        }

        .stats-card:hover i {
            color: var(--accent-color);
            transform: scale(1.15) rotateY(360deg);
        }

        .stats-card h2 {
            font-size: 3rem;
            font-weight: 800;
            color: var(--primary-color);
            margin: 1.5rem 0 0.5rem;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .stats-card p {
            color: #6c757d;
            font-weight: 500;
            font-size: 1rem;
        }

        /* ============================================
           SECTION HEADERS
           ============================================ */
        .section-title {
            font-size: 2.8rem;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--gradient-accent);
            border-radius: 2px;
        }

        .section-subtitle {
            color: #6c757d;
            font-size: 1.15rem;
            margin-bottom: 4rem;
            font-weight: 400;
        }

        /* ============================================
           COURSE CARDS WITH PROJECT 1 COLORS
           ============================================ */
        .course-card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background: white;
            height: 100%;
        }

        .course-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 50px rgba(8, 131, 149, 0.25);
        }

        .course-card .card-img-top,
        .course-card .bg-gradient {
            height: 220px;
            object-fit: cover;
        }

        .course-card .bg-gradient {
            background: var(--gradient-accent) !important;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .course-card .bg-gradient i {
            color: white;
            font-size: 4rem;
            opacity: 0.9;
        }

        .course-card .badge {
            background: var(--accent-color) !important;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
        }

        .course-card .card-title {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 1.25rem;
            margin: 1rem 0;
        }

        .course-card .card-footer {
            background: transparent;
            border: none;
            padding: 1.5rem;
        }

        /* ============================================
           BUTTONS WITH PROJECT 1 STYLING
           ============================================ */
        .btn-primary {
            background: var(--gradient-primary);
            border: none;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            font-weight: 600;
            color: white;
            transition: all 0.4s ease;
            box-shadow: 0 5px 20px rgba(8, 131, 149, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(8, 131, 149, 0.5);
            background: var(--gradient-accent);
        }

        .btn-outline-primary {
            color: var(--secondary-color);
            border: 2px solid var(--secondary-color);
            border-radius: 50px;
            padding: 0.7rem 1.8rem;
            font-weight: 600;
            transition: all 0.3s ease;
            background: transparent;
        }

        .btn-outline-primary:hover {
            background: var(--secondary-color);
            color: white;
            border-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(8, 131, 149, 0.3);
        }

        /* ============================================
           COUNTRY CARDS
           ============================================ */
        .country-card {
            transition: all 0.3s ease;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .country-card:hover {
            transform: scale(1.08);
            box-shadow: 0 15px 40px rgba(8, 131, 149, 0.2);
        }

        .country-card i {
            color: var(--secondary-color);
        }

        .country-card h6 {
            color: var(--primary-color);
            font-weight: 700;
        }

        /* ============================================
           SERVICE CARDS
           ============================================ */
        .service-card i {
            color: var(--secondary-color);
            transition: all 0.3s ease;
        }

        .service-card:hover i {
            color: var(--accent-color);
            transform: scale(1.1);
        }

        .service-card .card-title {
            color: var(--primary-color);
            font-weight: 700;
        }

        /* ============================================
           TESTIMONIAL CARDS
           ============================================ */
        .testimonial-card {
            border-radius: 15px;
            transition: all 0.3s ease;
        }

        .testimonial-card:hover {
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .testimonial-card .rounded-circle {
            border: 3px solid var(--accent-color) !important;
        }

        /* ============================================
           CTA SECTION
           ============================================ */
        .cta-section {
            background: var(--gradient-primary);
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 50%, rgba(5, 191, 219, 0.2), transparent),
                        radial-gradient(circle at 80% 50%, rgba(8, 131, 149, 0.2), transparent);
        }

        .cta-section .container {
            position: relative;
            z-index: 1;
        }

        .cta-section .btn-light {
            background: white;
            color: var(--primary-color);
            padding: 1rem 2.5rem;
            border-radius: 50px;
            font-weight: 700;
            transition: all 0.4s ease;
            box-shadow: 0 5px 20px rgba(255, 255, 255, 0.3);
        }

        .cta-section .btn-light:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 35px rgba(255, 255, 255, 0.5);
        }

        /* ============================================
           FOOTER WITH PROJECT 1 COLORS
           ============================================ */
        .footer {
            background: var(--primary-color);
            color: white;
            padding: 80px 0 30px;
        }

        .footer h5, .footer h6 {
            color: var(--accent-color);
            font-weight: 700;
            margin-bottom: 1.5rem;
            font-size: 1.2rem;
        }

        .footer a {
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .footer a:hover {
            color: var(--accent-color);
            transform: translateX(5px);
        }

        .footer .social-links a {
            color: rgba(255, 255, 255, 0.85);
            font-size: 1.4rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }

        .footer .social-links a:hover {
            color: white;
            background: var(--accent-color);
            transform: translateY(-5px) rotate(360deg);
        }

        .footer hr {
            border-color: rgba(255, 255, 255, 0.1);
            margin: 3rem 0 2rem;
        }

        .footer ul {
            list-style: none;
            padding: 0;
        }

        .footer ul li {
            margin-bottom: 0.8rem;
        }

        /* ============================================
           RESPONSIVE DESIGN
           ============================================ */
        @media (max-width: 991px) {
            .navbar-collapse {
                background: rgba(10, 77, 104, 0.98);
                padding: 1rem;
                border-radius: 10px;
                margin-top: 1rem;
            }

            .btn-apply-nav {
                margin-left: 0 !important;
                margin-top: 1rem;
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 100px 0 60px;
            }

            .hero-section h1 {
                font-size: 2.2rem;
            }

            .hero-section .lead {
                font-size: 1.05rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .stats-card h2 {
                font-size: 2.2rem;
            }
        }

        @media (max-width: 576px) {
            .hero-section h1 {
                font-size: 1.8rem;
            }

            .section-title {
                font-size: 1.7rem;
            }

            .stats-card {
                padding: 2rem 1rem;
            }
        }

        /* ============================================
           ANIMATIONS
           ============================================ */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(40px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-fade-in {
            animation: fadeInUp 0.8s ease-out;
        }

        /* Smooth Scrolling */
        html {
            scroll-behavior: smooth;
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-graduation-cap"></i>EduConsult
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('courses.*') ? 'active' : '' }}" href="{{ route('courses.index') }}">Courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('countries.*') ? 'active' : '' }}" href="{{ route('countries.index') }}">Countries</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}" href="{{ route('services') }}">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('blogs.*') ? 'active' : '' }}" href="{{ route('blogs.index') }}">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact.*') ? 'active' : '' }}" href="{{ route('contact.index') }}">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-apply-nav" href="{{ route('application.create') }}">Apply Now</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="mb-3">
                        <i class="fas fa-graduation-cap me-2"></i>EduConsult
                    </h5>
                    <p style="color: rgba(255,255,255,0.7);">Your trusted partner for international education and career guidance.</p>
                    <div class="social-links mt-4">
                        <a href="#" class="me-2"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="me-2"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="me-2"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h6>Quick Links</h6>
                    <ul>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('services') }}">Our Services</a></li>
                        <li><a href="{{ route('team') }}">Our Team</a></li>
                        <li><a href="{{ route('contact.index') }}">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h6>Resources</h6>
                    <ul>
                        <li><a href="{{ route('blogs.index') }}">Blog</a></li>
                        <li><a href="{{ route('events.index') }}">Events</a></li>
                        <li><a href="{{ route('scholarships.index') }}">Scholarships</a></li>
                        <li><a href="{{ route('faqs') }}">FAQs</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h6>Contact Info</h6>
                    <ul style="list-style: none; padding: 0;">
                        <li style="color: rgba(255,255,255,0.7); margin-bottom: 0.8rem;">
                            <i class="fas fa-map-marker-alt me-2"></i>Bharatpur, Chitwan
                        </li>
                        <li style="color: rgba(255,255,255,0.7); margin-bottom: 0.8rem;">
                            <i class="fas fa-phone me-2"></i>+977 123456789
                        </li>
                        <li style="color: rgba(255,255,255,0.7);">
                            <i class="fas fa-envelope me-2"></i>info@educonsult.com
                        </li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="text-center" style="color: rgba(255,255,255,0.7);">
                <p class="mb-0">&copy; {{ date('Y') }} Educational Consultancy. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Enhanced Navbar Scroll Effect
        let lastScroll = 0;
        const navbar = document.querySelector('.navbar');
        
        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            
            if (currentScroll > 100) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
            
            lastScroll = currentScroll;
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== '#' && href !== '#!') {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>