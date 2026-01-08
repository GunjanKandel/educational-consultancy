<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel') - Educational Consultancy</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #f4f6f9;
            overflow-x: hidden;
        }

        /* ===================== SIDEBAR ===================== */
        .sidebar {
            width: 260px;
            height: 100vh;
            background: linear-gradient(180deg, #4f46e5, #6366f1);
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            overflow-x: hidden;
            transition: all .3s ease;
            z-index: 1050;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 10px;
        }

        .sidebar-header {
            padding: 1.5rem 1rem;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }

        .sidebar-header h5 {
            color: #fff;
            margin-bottom: 0;
            font-weight: 600;
        }

        .sidebar-header small {
            color: rgba(255,255,255,.7);
        }

        .sidebar nav {
            padding: 1rem 0;
        }

        .sidebar a {
            color: rgba(255,255,255,.85);
            text-decoration: none;
            padding: 12px 18px;
            display: flex;
            align-items: center;
            border-radius: 10px;
            margin: 4px 12px;
            font-size: 14px;
            transition: all .2s ease;
        }

        .sidebar a i {
            width: 22px;
            margin-right: 10px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: rgba(255,255,255,.2);
            color: #fff;
            font-weight: 600;
        }

        /* ===================== MAIN CONTENT ===================== */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            transition: margin .3s ease;
        }

        /* ===================== TOPBAR ===================== */
        .topbar {
            background: #fff;
            padding: 0.75rem 1.25rem;
            box-shadow: 0 2px 10px rgba(0,0,0,.05);
            position: sticky;
            top: 0;
            z-index: 1040;
        }

        /* ===================== CARDS ===================== */
        .stats-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,.05);
            transition: transform .2s ease;
        }

        .stats-card:hover {
            transform: translateY(-4px);
        }

        /* ===================== MOBILE ===================== */
        @media (max-width: 991px) {
            .sidebar {
                left: -260px;
            }

            .sidebar.show {
                left: 0;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

<!-- ===================== SIDEBAR ===================== -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h5><i class="fas fa-graduation-cap me-2"></i>Admin Panel</h5>
        <small>Educational Consultancy</small>
    </div>

    <nav>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i> Dashboard
        </a>

        <a href="{{ route('admin.countries.index') }}" class="{{ request()->routeIs('admin.countries.*') ? 'active' : '' }}">
            <i class="fas fa-globe"></i> Countries
        </a>

        <a href="{{ route('admin.courses.index') }}" class="{{ request()->routeIs('admin.courses.*') ? 'active' : '' }}">
            <i class="fas fa-book"></i> Courses
        </a>

        <a href="{{ route('admin.universities.index') }}" class="{{ request()->routeIs('admin.universities.*') ? 'active' : '' }}">
            <i class="fas fa-university"></i> Universities
        </a>

        <a href="{{ route('admin.services.index') }}" class="{{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
            <i class="fas fa-concierge-bell"></i> Services
        </a>

        <a href="{{ route('admin.branches.index') }}" class="{{ request()->routeIs('admin.branches.*') ? 'active' : '' }}">
            <i class="fas fa-building"></i> Branches
        </a>

        <a href="{{ route('admin.teams.index') }}" class="{{ request()->routeIs('admin.teams.*') ? 'active' : '' }}">
            <i class="fas fa-users"></i> Team
        </a>

        <a href="{{ route('admin.blogs.index') }}" class="{{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
            <i class="fas fa-blog"></i> Blogs
        </a>

        <a href="{{ route('admin.applications.index') }}" class="{{ request()->routeIs('admin.applications.*') ? 'active' : '' }}">
            <i class="fas fa-file-alt"></i> Applications
        </a>

        <a href="{{ route('admin.contacts.index') }}" class="{{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
            <i class="fas fa-envelope"></i> Contacts
        </a>

        <a href="{{ route('admin.testimonials.index') }}" class="{{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
            <i class="fas fa-star"></i> Testimonials
        </a>

        <a href="{{ route('admin.events.index') }}" class="{{ request()->routeIs('admin.events.*') ? 'active' : '' }}">
            <i class="fas fa-calendar"></i> Events
        </a>

        <a href="{{ route('admin.scholarships.index') }}" class="{{ request()->routeIs('admin.scholarships.*') ? 'active' : '' }}">
            <i class="fas fa-graduation-cap"></i> Scholarships
        </a>

        <a href="{{ route('admin.appointments.index') }}" class="{{ request()->routeIs('admin.appointments.*') ? 'active' : '' }}">
            <i class="fas fa-clock"></i> Appointments
        </a>

        <a href="{{ route('admin.faqs.index') }}" class="{{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">
            <i class="fas fa-question-circle"></i> FAQs
        </a>

        <a href="{{ route('admin.pages.index') }}" class="{{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
            <i class="fas fa-file"></i> Pages
        </a>

        @if(auth()->user()->role === 'admin')
        <a href="{{ route('admin.settings.index') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <i class="fas fa-cog"></i> Settings
        </a>
        @endif
    </nav>
</div>

<!-- ===================== MAIN ===================== -->
<div class="main-content">

    <!-- TOPBAR -->
    <nav class="topbar d-flex align-items-center">
        <button class="btn btn-light d-lg-none me-2" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>

        <div class="ms-auto d-flex align-items-center">
            <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-primary btn-sm me-3">
                <i class="fas fa-external-link-alt me-1"></i> View Site
            </a>

            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fas fa-user-circle me-1"></i> {{ auth()->user()->name }}
                </button>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="fas fa-user me-2"></i> Profile
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- PAGE CONTENT -->
    <main class="p-4">
        @yield('content')
    </main>
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('sidebarToggle')?.addEventListener('click', () => {
        document.getElementById('sidebar').classList.toggle('show');
    });
</script>

</body>
</html>
