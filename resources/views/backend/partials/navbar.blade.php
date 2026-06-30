<style>
    #top-navbar {
        height: var(--navbar-height, 65px);
        background-color: #ffffff;
        border-bottom: 1px solid #eaecf0; /* Softer border color popular in modern SaaS templates */
        position: fixed;
        top: 0;
        right: 0;
        left: var(--sidebar-width, 260px);
        z-index: 1020;
        transition: left var(--transition-speed, 0.25s) cubic-bezier(0.4, 0, 0.2, 1);
        padding: 0 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    /* Shift layout margins dynamically along with the master body layout class overrides */
    body.sidebar-collapsed #top-navbar {
        left: var(--sidebar-collapsed-width, 70px);
    }

    /* --- Toggle Trigger UI --- */
    .toggle-btn {
        background: none;
        border: none;
        font-size: 1.35rem;
        color: #475467;
        cursor: pointer;
        padding: 0.35rem;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }
    .toggle-btn:hover {
        background-color: #f2f4f7;
        color: var(--jpos-blue, #0b4fa3);
    }

    /* --- Shopify-Style Search Bar UI --- */
    .search-box {
        position: relative;
    }
    .search-box i {
        position: absolute;
        left: 0.85rem;
        top: 50%;
        transform: translateY(-50%);
        color: #667085;
        font-size: 0.95rem;
    }
    .search-input {
        background-color: #f8f9fa;
        border: 1px solid #d0d5dd;
        border-radius: 8px;
        padding-left: 2.5rem;
        font-size: 0.875rem;
        width: 320px; /* Widened slightly for standard administrative monitors */
        height: 38px;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .search-input:focus {
        background-color: #ffffff;
        border-color: var(--jpos-blue, #0b4fa3);
        box-shadow: 0 0 0 4px rgba(11, 79, 163, 0.12);
        outline: none;
    }

    /* --- Premium E-commerce Control Action Buttons --- */
    .nav-action-btn {
        background: none;
        border: none;
        color: #667085;
        padding: 0.4rem;
        border-radius: 8px;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .nav-action-btn:hover {
        background-color: #f2f4f7;
        color: #1d2939;
    }
    
    /* Clean CSS Custom Animation Layer for Dropdowns */
    .dropdown-menu {
        animation: navDropdownFade 0.2s ease-out;
        box-shadow: 0 12px 16px -4px rgba(16, 24, 40, 0.08), 0 4px 6px -2px rgba(16, 24, 40, 0.03) !important;
    }
    @keyframes navDropdownFade {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .dropdown-item {
        font-size: 0.875rem;
        color: #344054;
        transition: background-color 0.15s ease;
    }
    .dropdown-item:hover {
        background-color: #f9fafb;
    }

    /* Breakpoint protection resetting margins for tablet/mobile viewports */
    @media (max-width: 991.98px) {
        #top-navbar {
            left: 0 !important;
            width: 100% !important;
            padding: 0 1rem;
        }
    }
</style>

<header id="top-navbar">
    <div class="d-flex align-items-center gap-3">
        <button class="toggle-btn" onclick="toggleSidebar()" aria-label="Toggle Side Navigation">
            <i class="bi bi-list"></i>
        </button>
        
        <div class="search-box d-none d-md-block">
            <i class="bi bi-search"></i>
            <input type="text" class="form-control search-input" placeholder="Search orders, products, customers...">
        </div>
    </div>

    <div class="d-flex align-items-center gap-2 gap-sm-3">

        <div class="dropdown d-none d-sm-block">
            <button class="btn btn-sm btn-light border fw-medium d-flex align-items-center gap-1.5 py-1.5 px-2.5" style="border-radius: 8px; font-size: 0.85rem;" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-plus-lg me-1"></i> Quick Action
            </button>
            <ul class="dropdown-menu dropdown-menu-end border-0 mt-2 rounded-3 p-1">
                <li><a class="dropdown-item py-2 rounded-2" href="#"><i class="bi bi-tag text-muted me-2"></i> Add New Product</a></li>
                <li><a class="dropdown-item py-2 rounded-2" href="#"><i class="bi bi-percent text-muted me-2"></i> Create Coupon</a></li>
                <li><a class="dropdown-item py-2 rounded-2" href="#"><i class="bi bi-file-earmark-bar-graph text-muted me-2"></i> Generate Report</a></li>
            </ul>
        </div>

        <button class="nav-action-btn position-relative" style="font-size: 1.2rem;" aria-label="Notifications Panel">
            <i class="bi bi-bell"></i>
            <span class="position-absolute top-2 start-2 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
        </button>
        
        <hr class="vr d-none d-sm-block my-2" style="height: 24px; color: #d0d5dd; opacity: 1;">
        
        <div class="dropdown">
            <a href="javascript:void(0);" class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark" 
               data-bs-toggle="dropdown" 
               data-bs-display="static" 
               aria-expanded="false">
                <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold me-2" 
                     style="width: 36px; height: 36px; background: linear-gradient(135deg, var(--jpos-blue) 0%, var(--jpos-blue-light) 100%); font-size: 0.85rem; letter-spacing: 0.5px; box-shadow: 0 2px 4px rgba(11,79,163,0.15);">
                    {{ strtoupper(substr(auth('admin')->user()->name ?? 'A', 0, 1)) }}
                </div>
                
                <div class="text-start d-none d-sm-block me-1">
                    <span class="fw-semibold text-dark d-block lh-1" style="font-size: 0.85rem; color: #1d2939 !important;">{{ auth('admin')->user()->name ?? 'Administrator' }}</span>
                    <small class="text-muted text-uppercase fw-medium" style="font-size: 0.65rem; letter-spacing: 0.5px;">Store Manager</small>
                </div>
            </a>
            
            <ul class="dropdown-menu dropdown-menu-end border-0 mt-2 rounded-3 p-1">
                <li>
                    <a class="dropdown-item py-2 rounded-2" href="#">
                        <i class="bi bi-person me-2 text-muted"></i> Account Profile
                    </a>
                </li>
                <li>
                    <a class="dropdown-item py-2 rounded-2" href="#">
                        <i class="bi bi-gear me-2 text-muted"></i> Store Settings
                    </a>
                </li>
                <li><hr class="dropdown-divider my-1 text-black-50" style="opacity: 0.1;"></li>
                <li>
                    <form action="{{ route('admin.logout') }}" method="POST" class="m-0 p-0">
                        @csrf
                        <button type="submit" class="dropdown-item py-2 rounded-2 text-danger d-flex align-items-center w-100 border-0 bg-transparent">
                            <i class="bi bi-power me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>