<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS & Inventory System</title>
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <style>
        :root {
            --reddit-orange: #ff4500;
            --reddit-orange-hover: #e03e00;
            --dark-bg: #0d1117;
            --darker-bg: #161b22;
            --card-bg: #21262d;
            --border-color: #30363d;
            --text-primary: #f0f6fc;
            --text-secondary: #8b949e;
        }

        body {
            background-color: var(--dark-bg);
            color: var(--text-primary);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-weight: 500;
        }
        
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 280px;
            background: linear-gradient(180deg, var(--darker-bg) 0%, var(--card-bg) 100%);
            padding: 20px 0;
            z-index: 1000;
            border-right: 1px solid var(--border-color);
            box-shadow: 4px 0 12px rgba(0,0,0,0.3);
            overflow-y: auto;
        }
        
        .main-content {
            margin-left: 280px;
            padding: 20px;
            min-height: 100vh;
            background-color: var(--dark-bg);
        }
        
        .navbar {
            position: fixed;
            top: 0;
            left: 280px;
            right: 0;
            z-index: 1030;
            background: var(--darker-bg) !important;
            border-bottom: 1px solid var(--border-color);
            backdrop-filter: blur(10px);
            height: 70px;
        }
        
        .sidebar-brand {
            padding: 20px 25px;
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--reddit-orange);
            text-decoration: none;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 20px;
            display: block;
        }
        
        .sidebar .nav-link {
            color: var(--text-secondary);
            padding: 12px 25px;
            border-radius: 0;
            margin: 2px 15px;
            font-weight: 600;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }
        
        .sidebar .nav-link:hover {
            background: rgba(255, 69, 0, 0.1);
            color: var(--reddit-orange);
            border-left-color: var(--reddit-orange);
            transform: translateX(5px);
        }
        
        .sidebar .nav-link.active {
            background: rgba(255, 69, 0, 0.15);
            color: var(--reddit-orange);
            border-left-color: var(--reddit-orange);
            font-weight: 700;
        }
        
        .sidebar .nav-link i {
            width: 20px;
            margin-right: 12px;
            font-size: 1.1rem;
        }

        .card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.4);
        }

        .card-header {
            background: var(--darker-bg);
            border-bottom: 1px solid var(--border-color);
            font-weight: 700;
            padding: 20px 25px;
            border-radius: 12px 12px 0 0 !important;
        }

        .stat-card {
            background: linear-gradient(135deg, var(--card-bg) 0%, var(--darker-bg) 100%);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 25px;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--reddit-orange);
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(255, 69, 0, 0.2);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 900;
            color: var(--reddit-orange);
            line-height: 1;
        }

        .stat-label {
            color: var(--text-secondary);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
        }

        .stat-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 2.5rem;
            color: rgba(255, 69, 0, 0.3);
        }

        .btn-primary {
            background: var(--reddit-orange);
            border-color: var(--reddit-orange);
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: var(--reddit-orange-hover);
            border-color: var(--reddit-orange-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 69, 0, 0.3);
        }

        .table-dark {
            --bs-table-bg: var(--card-bg);
            --bs-table-striped-bg: var(--darker-bg);
            border: 1px solid var(--border-color);
        }

        .table-dark th {
            background: var(--darker-bg) !important;
            border-color: var(--border-color);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.9rem;
        }

        .table-dark td {
            border-color: var(--border-color);
        }

        .dropdown-menu {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.4);
        }

        .dropdown-item {
            color: var(--text-primary);
            font-weight: 500;
        }

        .dropdown-item:hover {
            background: rgba(255, 69, 0, 0.1);
            color: var(--reddit-orange);
        }

        .alert {
            border-radius: 8px;
            font-weight: 600;
            border: none;
        }

        .alert-success {
            background: rgba(40, 167, 69, 0.2);
            color: #28a745;
            border-left: 4px solid #28a745;
        }

        .alert-danger {
            background: rgba(220, 53, 69, 0.2);
            color: #dc3545;
            border-left: 4px solid #dc3545;
        }

        .form-control, .form-select {
            background: var(--darker-bg);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            border-radius: 8px;
            font-weight: 500;
        }

        .form-control:focus, .form-select:focus {
            background: var(--darker-bg);
            border-color: var(--reddit-orange);
            box-shadow: 0 0 0 0.2rem rgba(255, 69, 0, 0.25);
            color: var(--text-primary);
        }

        .form-control::placeholder {
            color: var(--text-secondary);
        }

        .page-title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 30px;
            position: relative;
            padding-left: 20px;
        }

        .page-title::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: var(--reddit-orange);
            border-radius: 2px;
        }

        .chart-container {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 25px;
        }

        .metric-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .badge {
            font-weight: 700;
            padding: 6px 12px;
            border-radius: 6px;
        }

        .btn-group .btn {
            margin: 0 2px;
        }

        code {
            background: var(--darker-bg);
            color: var(--reddit-orange);
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: 600;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .navbar {
                left: 0;
            }

            .metric-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        ::-webkit-scrollbar-track {
            background: var(--darker-bg);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--reddit-orange);
        }

        /* Loading Animation */
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .loading {
            animation: pulse 1.5s ease-in-out infinite;
        }

        /* Custom Badge Colors */
        .badge.bg-reddit {
            background-color: var(--reddit-orange) !important;
        }

        /* Pagination */
        .pagination {
            --bs-pagination-bg: var(--card-bg);
            --bs-pagination-border-color: var(--border-color);
            --bs-pagination-hover-bg: rgba(255, 69, 0, 0.1);
            --bs-pagination-hover-border-color: var(--reddit-orange);
            --bs-pagination-active-bg: var(--reddit-orange);
            --bs-pagination-active-border-color: var(--reddit-orange);
        }

        /* Modal */
        .modal-content {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
        }

        .modal-header {
            border-bottom: 1px solid var(--border-color);
        }

        .modal-footer {
            border-top: 1px solid var(--border-color);
        }

        /* Form Labels */
        .form-label {
            color: var(--text-primary);
            font-weight: 600;
            margin-bottom: 8px;
        }

        /* Invalid Feedback */
        .invalid-feedback {
            color: #dc3545;
            font-weight: 600;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }
    </style>
</head>
<body>
    <!-- Top Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <button class="btn btn-link d-md-none text-white me-3" id="sidebarToggle">
                <i class="bi bi-list fs-4"></i>
            </button>
            
            <span class="navbar-brand fw-bold fs-4">
                @if(auth()->user()->isSuperAdmin())
                    Super Admin Panel
                @elseif(auth()->user()->isAdmin())
                    Admin Dashboard
                @elseif(auth()->user()->isManager())
                    Manager Dashboard
                @else
                    POS Terminal
                @endif
            </span>
            
            <div class="dropdown">
                <a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle me-2 fs-5"></i>
                    <span class="fw-semibold d-none d-md-inline">{{ Auth::user()->name ?? Auth::user()->username }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li class="px-3 py-2 border-bottom border-secondary">
                        <small class="text-muted">Role: <strong class="text-reddit">{{ ucfirst(auth()->user()->role) }}</strong></small>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('users.show', Auth::user()) }}"><i class="bi bi-person me-2"></i>Profile</a></li>
                    <li><a class="dropdown-item" href="{{ route('users.edit', Auth::user()) }}"><i class="bi bi-gear me-2"></i>Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <a href="{{ route('home') }}" class="sidebar-brand text-decoration-none">
            <i class="bi bi-shop me-2"></i>POS System
        </a>
        
        <nav class="nav flex-column">
<<<<<<< HEAD
=======
<<<<<<< HEAD
            <span class="text-uppercase text-muted px-4 py-2 fw-bold" style="font-size: 0.8rem; letter-spacing: 1px;">MENU</span>
            
            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            @if(auth()->user()->isSuperAdmin())
            <a class="nav-link {{ request()->routeIs('super-admin.tenants.*') ? 'active' : '' }}" href="{{ route('super-admin.tenants.index') }}">
                <i class="bi bi-building"></i> Tenants
            </a>
            @endif

            @if(auth()->user()->isSuperAdmin() || auth()->user()->isAdmin())
            <a class="nav-link {{ request()->routeIs('branches.*') ? 'active' : '' }}" href="{{ route('branches.index') }}">
                <i class="bi bi-diagram-3"></i> Branches
            </a>
            @endif
            
            <a class="nav-link {{ request()->routeIs('pos.*') ? 'active' : '' }}" href="{{ route('pos.index') }}">
                <i class="bi bi-cart3"></i> POS
            </a>

            @if(!auth()->user()->isCashier())
            <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                <i class="bi bi-box-seam"></i> Products
            </a>
            
            <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                <i class="bi bi-people"></i> Users
            </a>
            
            <div class="dropdown dropend">
                <a class="nav-link dropdown-toggle {{ request()->routeIs('reports.*') ? 'active' : '' }}" 
                   href="#" role="button" data-bs-toggle="dropdown">
                    <i class="bi bi-graph-up"></i> Reports
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('reports.sales') }}">Sales Report</a></li>
                    <li><a class="dropdown-item" href="{{ route('reports.item-sales') }}">Item Sales</a></li>
                    <li><a class="dropdown-item" href="{{ route('reports.inventory') }}">Inventory</a></li>
                </ul>
            </div>
            @endif
            
            @if(auth()->user()->isSuperAdmin() || auth()->user()->isAdmin())
            <a class="nav-link {{ request()->routeIs('audit.*') ? 'active' : '' }}" href="{{ route('audit.index') }}">
                <i class="bi bi-journal-text"></i> Audit Trail
            </a>
            @endif
        </nav>
    </div>
=======
>>>>>>> f41a86787ad98728fcb8e5af070269ab7225977a
    <span class="text-uppercase text-muted px-4 py-2 fw-bold" style="font-size: 0.8rem; letter-spacing: 1px;">MENU</span>
    
    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>

    {{-- Super Admin Only --}}
    @if(auth()->user()->isSuperAdmin())
    <a class="nav-link {{ request()->routeIs('super-admin.tenants.*') ? 'active' : '' }}" href="{{ route('super-admin.tenants.index') }}">
        <i class="bi bi-building"></i> Tenants
    </a>
    @endif

    {{-- Admin Only --}}
    @if(auth()->user()->isSuperAdmin() || auth()->user()->isAdmin())
    <a class="nav-link {{ request()->routeIs('branches.*') ? 'active' : '' }}" href="{{ route('branches.index') }}">
        <i class="bi bi-diagram-3"></i> Branches
    </a>
    @endif
    
    {{-- All Users --}}
    <a class="nav-link {{ request()->routeIs('pos.*') ? 'active' : '' }}" href="{{ route('pos.index') }}">
        <i class="bi bi-cart3"></i> POS
    </a>

    {{-- Manager and Admin Only --}}
    @if(auth()->user()->isManager() || auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
    <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">
        <i class="bi bi-box-seam"></i> Products
    </a>
    @endif
    
    {{-- Manager and Admin Only --}}
    @if(auth()->user()->isManager() || auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
    <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
        <i class="bi bi-people"></i> Users
    </a>
    
<<<<<<< HEAD
    <div class="dropdown dropend">
        <a class="nav-link dropdown-toggle {{ request()->routeIs('reports.*') ? 'active' : '' }}" 
           href="#" role="button" data-bs-toggle="dropdown">
            <i class="bi bi-graph-up"></i> Reports
        </a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('reports.sales') }}">Sales Report</a></li>
            <li><a class="dropdown-item" href="{{ route('reports.item-sales') }}">Item Sales</a></li>
            <li><a class="dropdown-item" href="{{ route('reports.inventory') }}">Inventory</a></li>
        </ul>
    </div>
=======
    <li class="nav-item">
    <a class="nav-link d-flex justify-content-between align-items-center {{ request()->routeIs('reports.*') ? 'active' : '' }}" 
       href="#reportsSubmenu" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="reportsSubmenu">
        <span><i class="bi bi-graph-up"></i> Reports</span>
        <i class="bi bi-chevron-down small"></i>
    </a>
    <div class="collapse {{ request()->routeIs('reports.*') ? 'show' : '' }}" id="reportsSubmenu">
        <nav class="nav flex-column ms-3">
            <a class="nav-link {{ request()->routeIs('reports.sales') ? 'active' : '' }}" href="{{ route('reports.sales') }}">Sales Report</a>
            <a class="nav-link {{ request()->routeIs('reports.item-sales') ? 'active' : '' }}" href="{{ route('reports.item-sales') }}">Item Sales</a>
            <a class="nav-link {{ request()->routeIs('reports.inventory') ? 'active' : '' }}" href="{{ route('reports.inventory') }}">Inventory</a>
        </nav>
    </div>
</li>

>>>>>>> f41a86787ad98728fcb8e5af070269ab7225977a
    @endif
    
    {{-- Super Admin and Admin Only --}}
    @if(auth()->user()->isSuperAdmin() || auth()->user()->isAdmin())
    <a class="nav-link {{ request()->routeIs('audit.*') ? 'active' : '' }}" href="{{ route('audit.index') }}">
        <i class="bi bi-journal-text"></i> Audit Trail
    </a>
    @endif
</nav>
    </div>
<<<<<<< HEAD
=======
>>>>>>> 54ab4ca (Ready for Debugging)
>>>>>>> f41a86787ad98728fcb8e5af070269ab7225977a

    <!-- Main Content -->
    <div class="main-content" style="padding-top: 90px;">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        // Sidebar toggle for mobile
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.getElementById('sidebarToggle');
            
            if (window.innerWidth <= 768 && sidebar && toggle) {
                if (!sidebar.contains(event.target) && !toggle.contains(event.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });

        // Set CSRF token for AJAX requests
        if (typeof $ !== 'undefined') {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
        }
    </script>
    @stack('scripts')
</body>
</html>