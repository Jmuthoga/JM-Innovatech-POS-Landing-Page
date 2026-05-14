@php

    // Later, you will fetch these from your Database in your Controller:
    // $categories = Category::where('active', true)->get();

    $categories = [
        'POS Systems',
        'POS Accessories',
        'Barcode Scanners',
        'Receipt Printers',
        'Cash Drawers',
        'ETIMS Devices',
        'Starlink Setup',
        'Networking Equipment',
        'Software Licenses'
    ];

@endphp

<!-- FIRST NAVBAR -->
<nav class="navbar navbar-expand-lg fixed-top py-3">
    <div class="container">
        <!-- LOGO -->
        <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
            <div class="logo-box">
                JM
            </div>
            JM Innovatech POS
        </a>

        <!-- MOBILE TOGGLER -->
        <button class="navbar-toggler border-0 shadow-none"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- NAVBAR -->
        <div class="collapse navbar-collapse" id="nav">

            <ul class="navbar-nav ms-5 align-items-lg-center">

                <li class="nav-item">
                    <a class="nav-link" href="/">
                        Home
                    </a>
                </li>

                <li class="nav-item dropdown mega-dropdown">
                    <a class="nav-link dropdown-toggle"
                       href="#"
                       role="button">
                        Products
                    </a>

                    <div class="dropdown-menu mega-menu">
                        <div class="row g-0">

                            <div class="col-lg-7 mega-left">

                                <span class="mega-badge">
                                    POS Solutions
                                </span>

                                <h3 class="mega-title">
                                    Smart retail tools built for modern businesses
                                </h3>

                                <a href="#" class="mega-item">
                                    <div class="mega-icon">
                                        <i class="fas fa-barcode"></i>
                                    </div>

                                    <div>
                                        <h6>POS Accessories</h6>

                                        <p>
                                            Barcode scanners, receipt printers,
                                            cash drawers and POS accessories.
                                        </p>
                                    </div>
                                </a>

                                <a href="#" class="mega-item">
                                    <div class="mega-icon">
                                        <i class="fas fa-cash-register"></i>
                                    </div>

                                    <div>
                                        <h6>Retail POS</h6>

                                        <p>
                                            Fast billing, automated receipts,
                                            sales tracking and stock management.
                                        </p>
                                    </div>
                                </a>

                                <a href="#" class="mega-item">
                                    <div class="mega-icon">
                                        <i class="fas fa-boxes"></i>
                                    </div>

                                    <div>
                                        <h6>Inventory Management</h6>

                                        <p>
                                            Monitor stock levels, suppliers,
                                            purchases and low stock alerts.
                                        </p>
                                    </div>
                                </a>

                                <a href="#" class="mega-item">
                                    <div class="mega-icon">
                                        <i class="fas fa-store"></i>
                                    </div>

                                    <div>
                                        <h6>Multi-Branch POS</h6>

                                        <p>
                                            Manage multiple business branches
                                            from one dashboard.
                                        </p>
                                    </div>
                                </a>

                            </div>

                            <!-- RIGHT -->
                            <div class="col-lg-5 mega-right">

                                <div class="integration-title">
                                    Integrations & Tools
                                </div>

                                <a href="#" class="side-link">
                                    MPESA Integration
                                    <i class="fas fa-arrow-right"></i>
                                </a>

                                <a href="#" class="side-link">
                                    E-commerce Integration
                                    <i class="fas fa-arrow-right"></i>
                                </a>

                                <a href="#" class="side-link">
                                    Barcode & Scanner Support
                                    <i class="fas fa-arrow-right"></i>
                                </a>

                                <a href="#" class="side-link">
                                    Receipt Printing
                                    <i class="fas fa-arrow-right"></i>
                                </a>

                                <a href="#" class="side-link">
                                    Customer Loyalty System
                                    <i class="fas fa-arrow-right"></i>
                                </a>

                                <div class="promo-card">

                                    <h6>
                                        Grow your business with JM Innovatech POS
                                    </h6>

                                    <p>
                                        Modern cloud POS system designed for
                                        retail businesses, supermarkets,
                                        pharmacies and wholesalers.
                                    </p>

                                    <a href="https://pos.jminnovatechsolution.co.ke"
                                       target="_blank"
                                       class="btn btn-started w-100">
                                        Get Started
                                    </a>

                                </div>

                            </div>

                        </div>
                    </div>
                </li>

                <!-- OTHER LINKS -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('shop') }}">
                        Shop
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#features">
                        Features
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#pricing">
                        Pricing
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#customers">
                        Customers
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#about">
                        About Us
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#support">
                        Support
                    </a>
                </li>

            </ul>

            <!-- RIGHT BUTTONS -->
            <div class="ms-auto d-flex align-items-center mt-3 mt-lg-0">

                <a href="#"
                   class="btn btn-signin me-2">
                    Sign In
                </a>

                <a href="https://pos.jminnovatechsolution.co.ke"
                   target="_blank"
                   class="btn btn-started">
                    POS Demo
                </a>

            </div>

        </div>
    </div>
</nav>

<!-- SECOND NAVBAR -->
<div class="secondary-navbar py-3">

    <div class="container">

        <div class="secondary-navbar-inner">

            <div class="search-section">

                <form action="{{ route('shop') }}" method="GET">

                    <div class="search-wrapper-new">

                        <i class="fas fa-search search-icon"></i>

                        <input type="text"
                               name="search"
                               placeholder="Search for product"
                               value="{{ request('search') }}"
                               required>

                        <button type="submit" class="search-btn">
                            Search
                        </button>

                    </div>

                </form>

            </div>

            <!-- MOBILE BOTTOM BAR / DESKTOP RIGHT ACTIONS -->
            <div class="top-actions">

                <!-- HOME -->
                <div class="action-item d-lg-none">
                    <a href="/" class="action-link">
                        <i class="fas fa-home"></i>
                        <span>Home</span>
                    </a>
                </div>

                <!-- SHOP -->
                <div class="action-item d-lg-none">
                    <a href="{{ route('shop') }}" class="action-link">
                        <i class="fas fa-store"></i>
                        <span>Shop</span>
                    </a>
                </div>

                <!-- CART -->
                <div class="action-item">
                    <a href="javascript:void(0)"
                       class="action-link"
                       data-bs-toggle="offcanvas"
                       data-bs-target="#offcanvasCart">

                        <div class="position-relative">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="cart-count">5</span>
                        </div>

                        <span>Cart</span>

                    </a>
                </div>

                <!-- WISHLIST -->
                <div class="action-item">
                    <a href="javascript:void(0)"
                       class="action-link"
                       data-bs-toggle="offcanvas"
                       data-bs-target="#offcanvasWishlist">

                        <div class="position-relative">
                            <i class="fas fa-heart"></i>
                            <span class="cart-count">2</span>
                        </div>

                        <span>Wishlist</span>

                    </a>
                </div>

                <!-- CATEGORIES -->
                <div class="action-item d-lg-none">
                    <a href="javascript:void(0)"
                       class="action-link"
                       data-bs-toggle="offcanvas"
                       data-bs-target="#offcanvasCategories">

                        <i class="fas fa-th-large"></i>
                        <span>Categories</span>

                    </a>
                </div>

<!-- DESKTOP ACCOUNT -->
<div class="action-item account-item d-none d-lg-block">

    <a href="javascript:void(0)"
       class="action-link account-btn">

        <div class="account-icon-wrapper">

            <i class="fas fa-user-circle"></i>

            @auth
                <span class="online-dot"></span>
            @endauth

        </div>

        <span>Account</span>

    </a>

    <!-- ACCOUNT DROPDOWN -->
    <div class="account-dropdown">

        @guest

            <div class="account-dropdown-header">

                <h6>Welcome</h6>

                <p>
                    Access your account and orders.
                </p>

            </div>

            <a href="" class="account-dropdown-link">
                <i class="fas fa-sign-in-alt"></i>
                Sign In
            </a>

            <a href="" class="account-dropdown-link">
                <i class="fas fa-user-plus"></i>
                Create Account
            </a>

        @else

            <div class="account-user-box">

                <div class="account-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div>
                    <h6>{{ auth()->user()->name }}</h6>
                    <small>{{ auth()->user()->email }}</small>
                </div>

            </div>

            <a href="#" class="account-dropdown-link">
                <i class="fas fa-user"></i>
                My Account
            </a>

            <a href="#" class="account-dropdown-link">
                <i class="fas fa-shopping-bag"></i>
                Orders
            </a>

            <a href="#" class="account-dropdown-link">
                <i class="fas fa-heart"></i>
                Wishlist
            </a>

            <button class="account-logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </button>

        @endguest

    </div>

</div>

<!-- MOBILE ACCOUNT -->
<div class="action-item d-lg-none">

    <a href="javascript:void(0)"
       class="action-link"
       data-bs-toggle="offcanvas"
       data-bs-target="#offcanvasAccount">

        <i class="fas fa-user-circle"></i>
        <span>Account</span>

    </a>

</div>

            </div>

        </div>

    </div>

</div>

<!-- =========================
    OFFCANVAS COMPONENTS
========================= -->

<!-- ================= MINI CART OFFCANVAS ================= -->
<div class="offcanvas offcanvas-end"
     tabindex="-1"
     id="offcanvasCart">

    <!-- HEADER -->
    <div class="offcanvas-header border-bottom bg-white">

        <div>
            <h5 class="fw-bold m-0">
                My Cart (3)
            </h5>

            <small class="text-muted">
                Recently added products
            </small>
        </div>

        <button type="button"
                class="btn-close shadow-none"
                data-bs-dismiss="offcanvas"></button>

    </div>

    <!-- BODY -->
    <div class="offcanvas-body bg-light">

        <!-- FREE SHIPPING ALERT -->
        <div class="alert border-0 d-flex align-items-center gap-2 mb-4"
             style="background:#eef7ff; color:var(--jpos-blue);">

            <i class="fas fa-truck fs-5"></i>

            <div>
                <strong>Free Delivery Available</strong>
                <div class="small">
                    Spend KES 5,000 more to unlock free shipping.
                </div>
            </div>

        </div>

        <!-- ================= ITEM ================= -->
        <div class="cart-product bg-white d-flex align-items-start gap-3 p-3 mb-3 rounded-4 border shadow-sm">

            <!-- IMAGE -->
            <div class="position-relative">

                <img src="{{ asset('assets/images/pos.png') }}"
                     class="rounded-3"
                     style="width:80px;height:80px;object-fit:cover;"
                     alt="Product">

            </div>

            <!-- CONTENT -->
            <div class="flex-grow-1">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <small class="text-success fw-semibold d-block mb-1">
                            In Stock
                        </small>

                        <h6 class="mb-1 fw-bold">
                            Barcode Scanner
                        </h6>

                        <small class="text-muted">
                            Honeywell Voyager
                        </small>

                    </div>

                    <button class="btn btn-sm btn-light border rounded-circle">
                        <i class="fas fa-times text-danger small"></i>
                    </button>

                </div>

                <!-- PRICE -->
                <div class="mt-2 d-flex align-items-center gap-2">

                    <span class="fw-bold"
                          style="color: var(--jpos-blue);">
                        KES 4,500
                    </span>

                    <small class="text-muted text-decoration-line-through">
                        KES 5,300
                    </small>

                </div>

                <!-- QTY -->
                <div class="d-flex justify-content-between align-items-center mt-3">

                    <div class="d-flex align-items-center border rounded-pill overflow-hidden">

                        <button class="btn btn-sm px-3 text-white border-0"
                                style="background: var(--jpos-blue);">
                            -
                        </button>

                        <span class="px-3 fw-bold">
                            1
                        </span>

                        <button class="btn btn-sm px-3 text-white border-0"
                                style="background: var(--jpos-green);">
                            +
                        </button>

                    </div>

                    <div class="fw-bold">
                        KES 4,500
                    </div>

                </div>

            </div>

        </div>

        <!-- ================= ITEM ================= -->
        <div class="cart-product bg-white d-flex align-items-start gap-3 p-3 mb-3 rounded-4 border shadow-sm">

            <div class="position-relative">

                <img src="{{ asset('assets/images/poster.png') }}"
                     class="rounded-3"
                     style="width:80px;height:80px;object-fit:cover;"
                     alt="Product">

            </div>

            <div class="flex-grow-1">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <small class="text-success fw-semibold d-block mb-1">
                            In Stock
                        </small>

                        <h6 class="mb-1 fw-bold">
                            POS Thermal Printer
                        </h6>

                        <small class="text-muted">
                            Epson TM-T20III
                        </small>

                    </div>

                    <button class="btn btn-sm btn-light border rounded-circle">
                        <i class="fas fa-times text-danger small"></i>
                    </button>

                </div>

                <div class="mt-2 d-flex align-items-center gap-2">

                    <span class="fw-bold"
                          style="color: var(--jpos-blue);">
                        KES 12,000
                    </span>

                    <small class="text-muted text-decoration-line-through">
                        KES 15,000
                    </small>

                </div>

                <div class="d-flex justify-content-between align-items-center mt-3">

                    <div class="d-flex align-items-center border rounded-pill overflow-hidden">

                        <button class="btn btn-sm px-3 text-white border-0"
                                style="background: var(--jpos-blue);">
                            -
                        </button>

                        <span class="px-3 fw-bold">
                            1
                        </span>

                        <button class="btn btn-sm px-3 text-white border-0"
                                style="background: var(--jpos-green);">
                            +
                        </button>

                    </div>

                    <div class="fw-bold">
                        KES 12,000
                    </div>

                </div>

            </div>

        </div>

        <!-- ================= ITEM ================= -->
        <div class="cart-product bg-white d-flex align-items-start gap-3 p-3 mb-4 rounded-4 border shadow-sm">

            <div class="position-relative">

                <img src="{{ asset('assets/images/pos.png') }}"
                     class="rounded-3"
                     style="width:80px;height:80px;object-fit:cover;"
                     alt="Product">

            </div>

            <div class="flex-grow-1">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <small class="text-success fw-semibold d-block mb-1">
                            In Stock
                        </small>

                        <h6 class="mb-1 fw-bold">
                            Cash Drawer
                        </h6>

                        <small class="text-muted">
                            Heavy Duty POS Drawer
                        </small>

                    </div>

                    <button class="btn btn-sm btn-light border rounded-circle">
                        <i class="fas fa-times text-danger small"></i>
                    </button>

                </div>

                <div class="mt-2 d-flex align-items-center gap-2">

                    <span class="fw-bold"
                          style="color: var(--jpos-blue);">
                        KES 8,500
                    </span>

                    <small class="text-muted text-decoration-line-through">
                        KES 10,000
                    </small>

                </div>

                <div class="d-flex justify-content-between align-items-center mt-3">

                    <div class="d-flex align-items-center border rounded-pill overflow-hidden">

                        <button class="btn btn-sm px-3 text-white border-0"
                                style="background: var(--jpos-blue);">
                            -
                        </button>

                        <span class="px-3 fw-bold">
                            1
                        </span>

                        <button class="btn btn-sm px-3 text-white border-0"
                                style="background: var(--jpos-green);">
                            +
                        </button>

                    </div>

                    <div class="fw-bold">
                        KES 8,500
                    </div>

                </div>

            </div>

        </div>

        <!-- SUMMARY -->
        <div class="bg-white rounded-4 border shadow-sm p-3">

            <div class="d-flex justify-content-between mb-2">

                <span class="text-muted">
                    Subtotal
                </span>

                <span class="fw-semibold">
                    KES 25,000
                </span>

            </div>

            <hr>

            <div class="d-flex justify-content-between align-items-center">

                <span class="fw-bold fs-5">
                    Total
                </span>

                <span class="fw-bold fs-5"
                      style="color: var(--jpos-blue);">

                    KES 25,000

                </span>

            </div>

        </div>

    </div>

    <!-- FOOTER -->
    <div class="offcanvas-footer p-3 border-top bg-white">

        <div class="d-grid gap-2">

            <!-- CHECKOUT -->
            <a href="{{ route('cart.index') }}"
            class="btn text-white fw-bold rounded-pill py-3"
            style="background: linear-gradient(135deg, var(--jpos-blue), var(--jpos-green));">

                View Full Cart
                <i class="fas fa-arrow-right ms-2"></i>

            </a>

        </div>

    </div>

</div>

<!-- ================= WISHLIST OFFCANVAS ================= -->
<div class="offcanvas offcanvas-end"
     tabindex="-1"
     id="offcanvasWishlist">

    <!-- HEADER -->
    <div class="offcanvas-header border-bottom bg-white">

        <div>
            <h5 class="fw-bold m-0">
                My Wishlist (3)
            </h5>

            <small class="text-muted">
                Saved products for later
            </small>
        </div>

        <button type="button"
                class="btn-close shadow-none"
                data-bs-dismiss="offcanvas"></button>

    </div>

    <!-- BODY -->
    <div class="offcanvas-body bg-light">

        <!-- ALERT -->
        <div class="alert border-0 d-flex align-items-center gap-2 mb-4"
             style="background:#fff4eb; color:var(--jpos-blue);">

            <i class="fas fa-heart fs-5"></i>

            <div>
                <strong>Your Wishlist</strong>

                <div class="small">
                    Save products and move them to cart anytime.
                </div>
            </div>

        </div>

        <!-- ================= ITEM ================= -->
        <div class="wishlist-product bg-white d-flex align-items-start gap-3 p-3 mb-3 rounded-4 border shadow-sm">

            <!-- IMAGE -->
            <div class="position-relative">

                <img src="{{ asset('assets/images/pos.png') }}"
                     class="rounded-3"
                     style="width:80px;height:80px;object-fit:cover;"
                     alt="Product">

            </div>

            <!-- CONTENT -->
            <div class="flex-grow-1">

                <!-- TOP -->
                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <small class="text-success fw-semibold d-block mb-1">
                            In Stock
                        </small>

                        <h6 class="mb-1 fw-bold">
                            Receipt Printer
                        </h6>

                        <small class="text-muted">
                            Epson Thermal Printer
                        </small>

                    </div>

                    <button class="btn btn-sm btn-light border rounded-circle flex-shrink-0">
                        <i class="fas fa-times text-danger small"></i>
                    </button>

                </div>

                <!-- PRICE -->
                <div class="mt-2 d-flex align-items-center gap-2">

                    <span class="fw-bold"
                          style="color: var(--jpos-blue);">

                        KES 8,000

                    </span>

                    <small class="text-muted text-decoration-line-through">
                        KES 10,500
                    </small>

                </div>

                <!-- ACTIONS -->
                <div class="d-flex justify-content-between align-items-center mt-3 gap-2">

                    <a href="#"
                       class="small fw-semibold text-decoration-none text-nowrap"
                       style="color: var(--jpos-blue);">

                        View Details

                    </a>

                    <a href="#"
                    class="btn btn-sm text-white rounded-pill px-3 text-nowrap d-inline-flex align-items-center"
                    style="background: linear-gradient(135deg, var(--jpos-blue), var(--jpos-green));">

                        <i class="fas fa-shopping-cart me-1"></i>
                        Add to Cart

                    </a>

                </div>

            </div>

        </div>

        <!-- ================= ITEM ================= -->
        <div class="wishlist-product bg-white d-flex align-items-start gap-3 p-3 mb-3 rounded-4 border shadow-sm">

            <div class="position-relative">

                <img src="{{ asset('assets/images/poster.png') }}"
                     class="rounded-3"
                     style="width:80px;height:80px;object-fit:cover;"
                     alt="Product">

            </div>

            <div class="flex-grow-1">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <small class="text-success fw-semibold d-block mb-1">
                            In Stock
                        </small>

                        <h6 class="mb-1 fw-bold">
                            Barcode Scanner
                        </h6>

                        <small class="text-muted">
                            Honeywell Voyager
                        </small>

                    </div>

                    <button class="btn btn-sm btn-light border rounded-circle flex-shrink-0">
                        <i class="fas fa-times text-danger small"></i>
                    </button>

                </div>

                <div class="mt-2 d-flex align-items-center gap-2">

                    <span class="fw-bold"
                          style="color: var(--jpos-blue);">

                        KES 4,500

                    </span>

                    <small class="text-muted text-decoration-line-through">
                        KES 5,500
                    </small>

                </div>

                <div class="d-flex justify-content-between align-items-center mt-3 gap-2">

                    <a href="#"
                       class="small fw-semibold text-decoration-none text-nowrap"
                       style="color: var(--jpos-blue);">

                        View Details

                    </a>

                    <a href="#"
                    class="btn btn-sm text-white rounded-pill px-3 text-nowrap d-inline-flex align-items-center"
                    style="background: linear-gradient(135deg, var(--jpos-blue), var(--jpos-green));">

                        <i class="fas fa-shopping-cart me-1"></i>
                        Add to Cart

                    </a>

                </div>

            </div>

        </div>

        <!-- ================= ITEM ================= -->
        <div class="wishlist-product bg-white d-flex align-items-start gap-3 p-3 mb-4 rounded-4 border shadow-sm">

            <div class="position-relative">

                <img src="{{ asset('assets/images/pos.png') }}"
                     class="rounded-3"
                     style="width:80px;height:80px;object-fit:cover;"
                     alt="Product">

            </div>

            <div class="flex-grow-1">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <small class="text-warning fw-semibold d-block mb-1">
                            Limited Stock
                        </small>

                        <h6 class="mb-1 fw-bold">
                            POS Cash Drawer
                        </h6>

                        <small class="text-muted">
                            Heavy Duty Drawer
                        </small>

                    </div>

                    <button class="btn btn-sm btn-light border rounded-circle flex-shrink-0">
                        <i class="fas fa-times text-danger small"></i>
                    </button>

                </div>

                <div class="mt-2 d-flex align-items-center gap-2">

                    <span class="fw-bold"
                          style="color: var(--jpos-blue);">

                        KES 12,000

                    </span>

                    <small class="text-muted text-decoration-line-through">
                        KES 14,000
                    </small>

                </div>

                <div class="d-flex justify-content-between align-items-center mt-3 gap-2">

                    <a href="#"
                       class="small fw-semibold text-decoration-none text-nowrap"
                       style="color: var(--jpos-blue);">

                        View Details

                    </a>

                    <a href="#"
                    class="btn btn-sm text-white rounded-pill px-3 text-nowrap d-inline-flex align-items-center"
                    style="background: linear-gradient(135deg, var(--jpos-blue), var(--jpos-green));">

                        <i class="fas fa-shopping-cart me-1"></i>
                        Add to Cart

                    </a>

                </div>

            </div>

        </div>

        <!-- EMPTY STATE -->
        <!--
        <div class="text-center py-5">

            <div class="mb-3">
                <i class="fas fa-heart text-muted fs-1"></i>
            </div>

            <h6 class="fw-bold">
                Your wishlist is empty
            </h6>

            <p class="text-muted small mb-0">
                Save products you love for later.
            </p>

        </div>
        -->

    </div>

    <!-- FOOTER -->
    <div class="offcanvas-footer p-3 border-top bg-white">

        <div class="d-grid gap-2">

            <a href="#"
            class="btn text-white fw-bold rounded-pill py-3 d-flex justify-content-center align-items-center"
            style="background: linear-gradient(135deg, var(--jpos-blue), var(--jpos-green));">

                <i class="fas fa-shopping-cart me-2"></i>
                Move All To Cart

            </a>

            <!-- CONTINUE SHOPPING -->
            <a href="#"
               class="btn fw-semibold rounded-pill py-2 border"
               style="border-color: var(--jpos-blue); color: var(--jpos-blue);">

                Continue Shopping

            </a>

        </div>

    </div>

</div>

<!-- Categories Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCategories">

    <div class="offcanvas-header border-bottom">

        <h5 class="fw-bold m-0">
            All Categories
        </h5>

        <button type="button"
                class="btn-close shadow-none"
                data-bs-dismiss="offcanvas"></button>

    </div>

    <div class="offcanvas-body p-0">

        <div class="category-grid">

            @foreach($categories as $category)

                <a href="{{ route('shop', ['category' => is_array($category) ? $category['name'] : $category]) }}"
                   class="category-card">

                    @php
                        $categoryName = strtolower(is_array($category) ? $category['name'] : $category);
                    @endphp

                    @switch($categoryName)

                        @case('pos systems')
                            <i class="fas fa-cash-register"></i>
                            @break

                        @case('pos accessories')
                            <i class="fas fa-plug"></i>
                            @break

                        @case('barcode scanners')
                            <i class="fas fa-barcode"></i>
                            @break

                        @case('receipt printers')
                            <i class="fas fa-print"></i>
                            @break

                        @case('cash drawers')
                            <i class="fas fa-box-open"></i>
                            @break

                        @case('etims devices')
                            <i class="fas fa-receipt"></i>
                            @break

                        @case('starlink setup')
                            <i class="fas fa-satellite-dish"></i>
                            @break

                        @case('networking equipment')
                            <i class="fas fa-network-wired"></i>
                            @break

                        @case('software licenses')
                            <i class="fas fa-laptop-code"></i>
                            @break

                        @default
                            <i class="fas fa-layer-group"></i>

                    @endswitch

                    <span>
                        {{ is_array($category) ? $category['name'] : $category }}
                    </span>

                </a>

            @endforeach

        </div>

    </div>

</div>

<!-- ACCOUNT OFFCANVAS -->
<div class="offcanvas offcanvas-end"
     tabindex="-1"
     id="offcanvasAccount">

    <div class="offcanvas-header border-bottom">

        <h5 class="fw-bold m-0">
            My Account
        </h5>

        <button type="button"
                class="btn-close shadow-none"
                data-bs-dismiss="offcanvas"></button>

    </div>

    <div class="offcanvas-body">

        @guest

            <div class="mobile-account-card">

                <div class="mobile-account-icon">
                    <i class="fas fa-user-circle"></i>
                </div>

                <h5>Welcome Back</h5>

                <p>
                    Sign in to manage your orders, wishlist and purchases.
                </p>

            </div>

            <a href=""
               class="mobile-account-link">

                <i class="fas fa-sign-in-alt"></i>
                Sign In

            </a>

            <a href=""
               class="mobile-account-link">

                <i class="fas fa-user-plus"></i>
                Create Account

            </a>

        @else

            <div class="mobile-user-box">

                <div class="mobile-user-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div>
                    <h6>{{ auth()->user()->name }}</h6>
                    <p>{{ auth()->user()->email }}</p>
                </div>

            </div>

            <a href="#" class="mobile-account-link">
                <i class="fas fa-user"></i>
                My Profile
            </a>

            <a href="#" class="mobile-account-link">
                <i class="fas fa-shopping-bag"></i>
                My Orders
            </a>

            <a href="#" class="mobile-account-link">
                <i class="fas fa-heart"></i>
                Wishlist
            </a>

            <form method="POST" action="">
                @csrf

                <button type="submit" class="mobile-logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </button>
            </form>

        @endguest

    </div>

</div>