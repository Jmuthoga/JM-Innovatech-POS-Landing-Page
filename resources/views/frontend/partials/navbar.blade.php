@php
    $miniCart = session()->get('cart', []);
    $miniCartCount = collect($miniCart)->sum('qty');
    $miniSubtotal = collect($miniCart)->sum(fn($i) => $i['price'] * $i['qty']);
@endphp

<!-- ================= FIRST NAVBAR ================= -->
<nav class="navbar navbar-expand-lg fixed-top py-3">
    <div class="container">
        <!-- LOGO -->
        <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
            <div class="logo-box">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo">
            </div>
            Business Solutions
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

                                <a href="{{ route('shop') }}" class="mega-item">
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

                                <a href="{{ route('pos.pricing') }}" class="mega-item">
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

                                <a href="{{ route('pos.pricing') }}" class="mega-item">
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

                                <a href="{{ route('pos.pricing') }}" class="mega-item">
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

                                <a href="{{ route('pos.pricing') }}" class="side-link">
                                    MPESA Integration
                                    <i class="fas fa-arrow-right"></i>
                                </a>

                                <a href="{{ route('pos.pricing') }}" class="side-link">
                                    E-commerce Integration
                                    <i class="fas fa-arrow-right"></i>
                                </a>

                                <a href="{{ route('pos.pricing') }}" class="side-link">
                                    Barcode & Scanner Support
                                    <i class="fas fa-arrow-right"></i>
                                </a>

                                <a href="{{ route('pos.pricing') }}" class="side-link">
                                    Receipt Printing
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
                    <a class="nav-link" href="{{ route('pos.features') }}">
                        Features
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pos.pricing') }}">
                        Pricing
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pos.about') }}">
                        About Us
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pos.support') }}">
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

<!-- ================= SECOND NAVBAR ================= -->
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
                            <span class="cart-count">{{ $miniCartCount }}</span>
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
                            <span class="cart-count">{{ $wishlistCount ?? 0 }}</span>
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

                    <a href="javascript:void(0)" class="action-link account-btn">
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
                                <p>Access your account and orders.</p>
                            </div>

                            <a href="{{ route('login') }}" class="account-dropdown-link">
                                <i class="fas fa-sign-in-alt"></i> Sign In
                            </a>

                            <a href="{{ route('signup') }}" class="account-dropdown-link">
                                <i class="fas fa-user-plus"></i> Create Account
                            </a>
                        @else
                            <div class="account-user-box">
                                <div class="account-avatar">
                                    {{ strtoupper(substr(auth()->user()->first_name, 0, 1) . substr(auth()->user()->last_name, 0, 1)) }}
                                </div>
                                <div>
                                    <h6>Hello, {{ auth()->user()->first_name }}</h6>
                                    <small>{{ auth()->user()->email }}</small>
                                </div>
                            </div>

                            <a href="{{ route('customer.account') }}" class="account-dropdown-link">
                                <i class="fas fa-user"></i> My Account
                            </a>

                            <a href="{{ route('customer.account') }}#orders" class="account-dropdown-link">
                                <i class="fas fa-shopping-bag"></i> Orders
                            </a>

                            <a href="{{ route('cart.index') }}" class="account-dropdown-link">
                                <i class="fas fa-check-circle"></i>
                                Complete Order
                            </a>

                            <!-- Authentic Secure Logout Form Submit Wrapper -->
                            <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                                @csrf
                                <button type="submit" class="account-logout-btn w-100 border-0 bg-transparent text-danger d-flex align-items-center justify-content-center gap-2">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
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
                My Cart ({{ $miniCartCount }})
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

        <!-- ================= ITEMS ================= -->
        @forelse($miniCart as $item)
            @php
                $lineTotal = $item['price'] * $item['qty'];
                $old = $item['old_price'] ?? $item['price'];
            @endphp

            <div class="cart-product bg-white d-flex align-items-start gap-3 p-3 mb-3 rounded-4 border shadow-sm">

                <!-- IMAGE -->
                <div class="position-relative">

                    <img src="{{ $item['image'] }}"
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
                                {{ $item['name'] }}
                            </h6>

                            <small class="text-muted">
                                {{ $item['brand'] ?? '' }}
                            </small>

                        </div>

                        <form method="POST" action="{{ route('cart.remove', $item['id']) }}">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-sm btn-light border rounded-circle">
                                <i class="fas fa-times text-danger small"></i>
                            </button>
                        </form>

                    </div>

                    <!-- PRICE -->
                    <div class="mt-2 d-flex align-items-center gap-2">

                        <span class="fw-bold" style="color: var(--jpos-blue);">
                            KES {{ number_format($item['price']) }}
                        </span>

                        @if(isset($item['old_price']))
                            <small class="text-muted text-decoration-line-through">
                                KES {{ number_format($item['old_price']) }}
                            </small>
                        @endif

                    </div>

                    <!-- QTY -->
                    <div class="d-flex justify-content-between align-items-center mt-3">

                        <div class="d-flex align-items-center border rounded-pill overflow-hidden">

                            <form method="POST" action="{{ route('cart.decrease', $item['id']) }}">
                                @csrf
                                <button class="btn btn-sm px-3 text-white border-0"
                                        style="background: var(--jpos-blue);">
                                    -
                                </button>
                            </form>

                            <span class="px-3 fw-bold">
                                {{ $item['qty'] }}
                            </span>

                            <form method="POST" action="{{ route('cart.increase', $item['id']) }}">
                                @csrf
                                <button class="btn btn-sm px-3 text-white border-0"
                                        style="background: var(--jpos-green);">
                                    +
                                </button>
                            </form>

                        </div>

                        <div class="fw-bold">
                            KES {{ number_format($lineTotal) }}
                        </div>

                    </div>

                </div>

            </div>

        @empty
            <div class="text-center py-5 text-muted">
                <i class="fas fa-shopping-cart fs-3 mb-2"></i>
                <p>Your cart is empty</p>
            </div>
        @endforelse

        <!-- SUMMARY -->
        <div class="bg-white rounded-4 border shadow-sm p-3">

            <div class="d-flex justify-content-between mb-2">

                <span class="text-muted">
                    Subtotal
                </span>

                <span class="fw-semibold">
                    KES {{ number_format($miniSubtotal) }}
                </span>

            </div>

            <hr>

            <div class="d-flex justify-content-between align-items-center">

                <span class="fw-bold fs-5">
                    Total
                </span>

                <span class="fw-bold fs-5"
                      style="color: var(--jpos-blue);">

                    KES {{ number_format($miniSubtotal) }}

                </span>

            </div>

        </div>

    </div>

    <!-- FOOTER -->
    <div class="offcanvas-footer p-3 border-top bg-white">

        <div class="d-grid gap-2">

        <!-- VIEW FULL CART -->
        <a href="{{ auth()->check() || session('mock_logged_in')
            ? route('cart.index')
            : route('cart.login.redirect') }}"
            class="btn text-white fw-bold rounded-pill py-3"
            style="background: linear-gradient(135deg, var(--jpos-blue), var(--jpos-green));">

            @auth
                View Full Cart
            @else
                Login to View Cart
            @endauth

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
                My Wishlist ({{ $wishlistCount ?? 0 }})
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

        <!-- ================= ITEMS ================= -->
        @forelse($wishlist as $item)

            @php
                $lineTotal = $item['price'] * ($item['qty'] ?? 1);
            @endphp

            <div class="wishlist-product bg-white d-flex align-items-start gap-3 p-3 mb-3 rounded-4 border shadow-sm">

                <!-- IMAGE -->
                <div class="position-relative">

                    <img src="{{ $item['image'] }}"
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
                                {{ $item['name'] }}
                            </h6>

                            <small class="text-muted">
                                {{ $item['brand'] ?? '' }}
                            </small>

                        </div>

                        <!-- REMOVE FROM WISHLIST -->
                        <form method="POST" action="{{ route('wishlist.remove', $item['id']) }}">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-sm btn-light border rounded-circle flex-shrink-0">
                                <i class="fas fa-times text-danger small"></i>
                            </button>
                        </form>

                    </div>

                    <!-- PRICE -->
                    <div class="mt-2 d-flex align-items-center gap-2">

                        <span class="fw-bold" style="color: var(--jpos-blue);">
                            KES {{ number_format($item['price']) }}
                        </span>

                        @if(isset($item['old_price']))
                            <small class="text-muted text-decoration-line-through">
                                KES {{ number_format($item['old_price']) }}
                            </small>
                        @endif

                    </div>

                    <!-- ACTIONS -->
                    <div class="d-flex justify-content-between align-items-center mt-3 gap-2">

                        <!-- VIEW -->
                        <a href="{{ route('product.show', $item['id']) }}"
                           class="small fw-semibold text-decoration-none text-nowrap"
                           style="color: var(--jpos-blue);">

                            View Details

                        </a>

                        <!-- MOVE TO CART -->
                    <form method="POST" action="{{ route('wishlist.move.single', $item['id']) }}" class="m-0">
                        @csrf

                        <button class="btn btn-sm text-white rounded-pill px-3 text-nowrap d-inline-flex align-items-center"
                                style="background: linear-gradient(135deg, var(--jpos-blue), var(--jpos-green));">

                            <i class="fas fa-shopping-cart me-1"></i>
                            Add to Cart

                        </button>
                    </form>

                    </div>

                </div>

            </div>

        @empty

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

        @endforelse

    </div>

    <!-- FOOTER -->
    <div class="offcanvas-footer p-3 border-top bg-white">

        <div class="d-flex gap-2">

            <!-- MOVE ALL TO CART -->
            <form method="POST"
                action="{{ route('wishlist.move.all') }}"
                class="flex-fill m-0">

                @csrf

                <button class="btn btn-sm text-white fw-semibold rounded-pill w-100 d-flex justify-content-center align-items-center py-2"
                        style="background: linear-gradient(135deg, var(--jpos-blue), var(--jpos-green));">

                    <i class="fas fa-shopping-cart me-1"></i>
                    Move All To Cart

                </button>

            </form>

            <!-- CONTINUE SHOPPING -->
            <a href="{{ route('shop') }}"
            class="btn btn-sm fw-semibold rounded-pill flex-fill d-flex justify-content-center align-items-center py-2 border"
            style="border-color: var(--jpos-blue); color: var(--jpos-blue);">

                Continue Shopping

            </a>

        </div>

    </div>

</div>

<!-- ================= Categories Offcanvas ================= -->
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

            @foreach($categoriesList as $cat)

                @php
                    $categoryName = strtolower($cat);
                @endphp

                <a href="{{ route('shop', ['category' => $cat]) }}"
                class="category-card">

                    @switch($categoryName)

                        {{-- POS SYSTEMS --}}
                        @case('pos systems')
                            <i class="fas fa-cash-register"></i>
                            @break

                        @case('pos accessories')
                            <i class="fas fa-plug"></i>
                            @break

                        {{-- BARCODE / PRINTING --}}
                        @case('barcode scanners')
                            <i class="fas fa-barcode"></i>
                            @break

                        @case('receipt printers')
                            <i class="fas fa-print"></i>
                            @break

                        @case('printers')
                            <i class="fas fa-print"></i>
                            @break

                        {{-- CASH --}}
                        @case('cash drawers')
                            <i class="fas fa-box-open"></i>
                            @break

                        {{-- ETIMS --}}
                        @case('etims devices')
                            <i class="fas fa-receipt"></i>
                            @break

                        {{-- NETWORKING --}}
                        @case('starlink setup')
                            <i class="fas fa-satellite-dish"></i>
                            @break

                        @case('networking equipment')
                            <i class="fas fa-network-wired"></i>
                            @break

                        @case('networking')
                            <i class="fas fa-network-wired"></i>
                            @break

                        {{-- SOFTWARE --}}
                        @case('software licenses')
                            <i class="fas fa-laptop-code"></i>
                            @break

                        @case('software')
                            <i class="fas fa-laptop-code"></i>
                            @break

                        {{-- COMPUTERS --}}
                        @case('computers')
                            <i class="fas fa-desktop"></i>
                            @break

                        @case('desktop computers')
                            <i class="fas fa-desktop"></i>
                            @break

                        @case('laptops')
                            <i class="fas fa-laptop"></i>
                            @break

                        @case('computer accessories')
                            <i class="fas fa-keyboard"></i>
                            @break

                        {{-- ELECTRONICS --}}
                        @case('electronics')
                            <i class="fas fa-microchip"></i>
                            @break

                        {{-- TV --}}
                        @case('tv')
                        @case('tvs')
                        @case('televisions')
                        @case('smart tvs')
                            <i class="fas fa-tv"></i>
                            @break

                        {{-- PHONES --}}
                        @case('phones')
                        @case('smartphones')
                        @case('mobile phones')
                            <i class="fas fa-mobile-alt"></i>
                            @break

                        {{-- CAMERAS --}}
                        @case('cameras')
                            <i class="fas fa-camera"></i>
                            @break

                        {{-- GAMING --}}
                        @case('gaming')
                            <i class="fas fa-gamepad"></i>
                            @break

                        {{-- ACCESSORIES --}}
                        @case('accessories')
                            <i class="fas fa-headphones"></i>
                            @break

                        {{-- SECURITY --}}
                        @case('cctv')
                        @case('cctv cameras')
                        @case('security cameras')
                        @case('surveillance')
                            <i class="fas fa-video"></i>
                            @break

                        @case('security systems')
                            <i class="fas fa-shield-alt"></i>
                            @break

                        {{-- DEFAULT --}}
                        @default
                            <i class="fas fa-layer-group"></i>

                    @endswitch

                    <span>{{ $cat }}</span>

                </a>

            @endforeach

        </div>

    </div>

</div>

<!-- ================= ACCOUNT OFFCANVAS ================= -->
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

            <a href="{{ route('login') }}"
               class="mobile-account-link">

                <i class="fas fa-sign-in-alt"></i>
                Sign In

            </a>

            <a href="{{ route('signup') }}"
               class="mobile-account-link">

                <i class="fas fa-user-plus"></i>
                Create Account

            </a>

        @else

            <div class="mobile-user-box">

            <div class="mobile-user-avatar">
                {{ strtoupper(substr(auth()->user()->first_name, 0, 1) . substr(auth()->user()->last_name, 0, 1)) }}
            </div>

                <div>
                    <h6>Hello, {{ auth()->user()->first_name }}</h6>
                    <p>{{ auth()->user()->email }}</p>
                </div>

            </div>

            <a href="{{ route('customer.account') }}" class="mobile-account-link">
                <i class="fas fa-user"></i>
                My Profile
            </a>

            <a href="{{ route('customer.account') }}#orders" class="mobile-account-link">
                <i class="fas fa-shopping-bag"></i>
                My Orders
            </a>

            <a href="{{ route('cart.index') }}" class="mobile-account-link">
                <i class="fas fa-check-circle"></i>
                Complete Order
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="mobile-logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </button>
            </form>

        @endguest

    </div>

</div>