<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JPos Sidebar Component</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    
    <style>
        :root {
            --jpos-blue: #0b4fa3;
            --jpos-blue-light: #1662c4; 
            --jpos-green: #2e7d32;
            --jpos-green-light: #4caf50;
            --sidebar-width: 260px;
            --sidebar-collapsed-width: 70px;
            --transition-speed: 0.25s;
        }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            margin: 0;
            background-color: #f6f6f7;
        }

        /* --- STYLES FOR THE TOGGLE BUTTON OUTSIDE SIDEBAR --- */
        .sidebar-toggle-trigger {
            position: fixed;
            top: 15px;
            left: 20px;
            z-index: 1050;
            background: #ffffff;
            border: 1px solid #e3e3e3;
            border-radius: 6px;
            padding: 6px 12px;
            cursor: pointer;
            transition: all var(--transition-speed);
        }
        body.sidebar-collapsed .sidebar-toggle-trigger {
            left: calc(var(--sidebar-collapsed-width) + 15px);
        }
        @media (min-width: 992px) {
            body:not(.sidebar-collapsed) .sidebar-toggle-trigger {
                left: calc(var(--sidebar-width) + 15px);
            }
        }

        /* --- BASE SIDEBAR STYLES --- */
        #sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1040;
            background-color: var(--jpos-blue);
            color: #ffffff;
            transition: width var(--transition-speed) cubic-bezier(0.4, 0, 0.2, 1), left var(--transition-speed) ease;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 10px rgba(0,0,0,0.05);
        }

        /* Sidebar Brand */
        .sidebar-brand {
            height: 65px;
            display: flex;
            align-items: center;
            padding: 0 1.25rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            white-space: nowrap;
            overflow: hidden;
        }
        .brand-logo {
            background: var(--jpos-green);
            color: white;
            border-radius: 6px;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            transition: margin var(--transition-speed);
        }

        /* Navigation Links */
        .sidebar-nav {
            flex-grow: 1;
            padding: 1rem 0;
            overflow-y: auto;
            overflow-x: hidden;
        }
        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.25rem;
            color: rgba(255,255,255,0.75);
            text-decoration: none;
            transition: all var(--transition-speed);
            border-left: 3px solid transparent;
            white-space: nowrap;
            cursor: pointer;
        }
        .sidebar-link:hover, .sidebar-link.active {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.08);
        }
        .sidebar-link.active {
            border-left-color: var(--jpos-green-light);
            background-color: rgba(0, 0, 0, 0.15);
        }
        .sidebar-link i {
            font-size: 1.25rem;
            min-width: 30px;
            transition: margin var(--transition-speed);
        }

        /* Dropdowns */
        .sidebar-dropdown {
            background: rgba(0, 0, 0, 0.1);
            list-style: none;
            padding-left: 0;
            max-height: 0;
            overflow: hidden;
            transition: max-height var(--transition-speed) ease-out;
        }
        .sidebar-dropdown.show {
            max-height: 500px;
        }
        .sidebar-dropdown .sidebar-link {
            padding-left: 3.25rem;
            font-size: 0.9rem;
        }
        .arrow-icon {
            margin-left: auto;
            transition: transform var(--transition-speed);
            font-size: 0.85rem !important;
        }
        .sidebar-link[aria-expanded="true"] .arrow-icon {
            transform: rotate(90deg);
        }

        /* Profile Footer */
        .sidebar-profile {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding: 1rem 1.25rem;
            background: rgba(0,0,0,0.15);
            white-space: nowrap;
            overflow: hidden;
            transition: padding var(--transition-speed);
        }
        .nav-badge {
            font-size: 0.75rem;
            background-color: var(--jpos-green-light);
            color: white;
            padding: 0.2rem 0.5rem;
            border-radius: 10px;
        }

        /* --- LARGE SCREENS: COLLAPSED STATE (ICONS PUSHED TO LEFT) --- */
        @media (min-width: 992px) {
            body.sidebar-collapsed #sidebar {
                width: var(--sidebar-collapsed-width);
            }
            body.sidebar-collapsed #sidebar .brand-text,
            body.sidebar-collapsed #sidebar .link-text,
            body.sidebar-collapsed #sidebar .arrow-icon,
            body.sidebar-collapsed #sidebar .profile-text,
            body.sidebar-collapsed #sidebar .badge-text {
                display: none !important;
            }
            body.sidebar-collapsed #sidebar .sidebar-dropdown {
                display: none !important; 
            }
            body.sidebar-collapsed #sidebar .sidebar-brand {
                padding: 0 1.25rem; /* Matches left-alignment spacing */
            }
            body.sidebar-collapsed #sidebar .sidebar-link {
                justify-content: flex-start;
                padding: 0.75rem 1.25rem; /* Keeps padding identical to pull icons left */
                border-left: none;
            }
            body.sidebar-collapsed #sidebar .sidebar-link i {
                min-width: unset;
                margin: 0;
            }
            body.sidebar-collapsed #sidebar .sidebar-profile {
                padding: 1rem 1.25rem; /* Retains left side spacing for avatar image */
            }
        }

        /* --- MOBILE SCREENS: COMPLETELY HIDDEN BY DEFAULT --- */
        @media (max-width: 991.98px) {
            .sidebar-toggle-trigger {
                left: 20px !important; 
            }
            #sidebar {
                left: calc(-1 * var(--sidebar-width)); 
            }
            body.sidebar-open #sidebar {
                left: 0; 
            }
            #sidebar-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                background: rgba(0, 0, 0, 0.4);
                z-index: 1030;
                display: none;
                backdrop-filter: blur(2px);
            }
            body.sidebar-open #sidebar-overlay {
                display: block;
            }
        }

        /* Tooltip Custom configurations */
        .custom-tooltip {
            --bs-tooltip-bg: #000;
            --bs-tooltip-color: #fff;
        }
    </style>
</head>
<body>

    <button class="sidebar-toggle-trigger" onclick="toggleSidebar()" aria-label="Toggle Sidebar Navigation">
        <i class="bi bi-list"></i>
    </button>

    <div id="sidebar-overlay" onclick="toggleSidebar()"></div>

    <aside id="sidebar">
        <div class="sidebar-brand">
            <div class="brand-logo">J</div>
            <span class="ms-3 fw-bold fs-5 brand-text text-white">JPos Admin</span>
        </div>

        <nav class="sidebar-nav">
            <a href="#" class="sidebar-link active" data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard">
                <i class="bi bi-speedometer2"></i>
                <span class="ms-3 link-text">Dashboard</span>
            </a>

            <div>
                <a class="sidebar-link" onclick="toggleDropdown(this)" data-bs-toggle="tooltip" data-bs-placement="right" title="Products">
                    <i class="bi bi-box-seam"></i>
                    <span class="ms-3 link-text">Products</span>
                    <i class="bi bi-chevron-right arrow-icon"></i>
                </a>
                <ul class="sidebar-dropdown">
                    <li><a href="#" class="sidebar-link">All Products</a></li>
                    <li><a href="#" class="sidebar-link">Inventory</a></li>
                    <li><a href="#" class="sidebar-link">Categories</a></li>
                </ul>
            </div>

            <a href="#" class="sidebar-link" data-bs-toggle="tooltip" data-bs-placement="right" title="Orders">
                <i class="bi bi-cart3"></i>
                <span class="ms-3 link-text">Orders</span>
                <span class="ms-auto badge-text nav-badge">12 New</span>
            </a>

            <a href="#" class="sidebar-link" data-bs-toggle="tooltip" data-bs-placement="right" title="Customers">
                <i class="bi bi-people"></i>
                <span class="ms-3 link-text">Customers</span>
            </a>

            <a href="#" class="sidebar-link" data-bs-toggle="tooltip" data-bs-placement="right" title="Settings">
                <i class="bi bi-gear"></i>
                <span class="ms-3 link-text">Settings</span>
            </a>
        </nav>

        <div class="sidebar-profile d-flex align-items-center">
            <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
                style="width:36px;height:36px;background:rgba(255,255,255,.18);font-size:.9rem;">
                {{ strtoupper(substr(auth('admin')->user()->name ?? 'A', 0, 1)) }}
            </div>

            <div class="ms-3 profile-text">
                <p class="mb-0 fw-semibold text-white lh-sm" style="font-size:0.9rem;">
                    {{ auth('admin')->user()->name ?? 'Administrator' }}
                </p>
                <small class="text-white-50" style="font-size:0.75rem;">
                    Store Manager
                </small>
            </div>
        </div>
    </aside>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let tooltipInstances = [];

        function initTooltips() {
            const isCollapsed = document.body.classList.contains('sidebar-collapsed');
            const isDesktop = window.innerWidth >= 992;
            
            tooltipInstances.forEach(t => t.destroy());
            tooltipInstances = [];

            if (isCollapsed && isDesktop) {
                const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
                tooltipInstances = [...tooltipTriggerList].map(el => new bootstrap.Tooltip(el, {
                    customClass: 'custom-tooltip'
                }));
            }
        }

        function toggleSidebar() {
            const isDesktop = window.innerWidth >= 992;

            if (isDesktop) {
                document.body.classList.toggle('sidebar-collapsed');
                const isCollapsed = document.body.classList.contains('sidebar-collapsed');
                localStorage.setItem('sidebarState', isCollapsed ? 'collapsed' : 'expanded');
                initTooltips();
            } else {
                document.body.classList.toggle('sidebar-open');
            }
        }

        function toggleDropdown(element) {
            if (document.body.classList.contains('sidebar-collapsed') && window.innerWidth >= 992) {
                return;
            }
            
            const dropdown = element.nextElementSibling;
            const isExpanded = element.getAttribute('aria-expanded') === 'true';
            
            element.setAttribute('aria-expanded', !isExpanded);
            dropdown.classList.toggle('show');
        }

        document.addEventListener("DOMContentLoaded", function() {
            const savedState = localStorage.getItem('sidebarState');
            const isDesktop = window.innerWidth >= 992;

            if (savedState === 'collapsed' && isDesktop) {
                document.body.classList.add('sidebar-collapsed');
            }
            
            initTooltips();
            
            window.addEventListener('resize', () => {
                if (window.innerWidth < 992) {
                    document.body.classList.remove('sidebar-collapsed');
                } else {
                    document.body.classList.remove('sidebar-open');
                }
                initTooltips();
            });
        });
    </script>
</body>
</html>