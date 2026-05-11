<style>
:root {
    --jpos-blue: #0B4FA3;
    --jpos-blue-light: #0B4FA3;
    --jpos-green: #2E7D32;
    --jpos-green-light: #4CAF50;
}

/* =========================
   NAVBAR
========================= */

.navbar {
    background: #ffffff;
    border-bottom: 1px solid #eef2f7;
    transition: 0.3s ease;
    z-index: 999;
}

.navbar-brand {
    font-size: 1.45rem;
    color: #111827 !important;
    letter-spacing: -0.5px;
}

.logo-box {
    width: 42px;
    height: 42px;
    background: linear-gradient(135deg, var(--jpos-blue), var(--jpos-green));
    border-radius: 12px;
    color: white;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 10px;
    font-size: 16px;
}

/* NAV LINKS */

.navbar .nav-link {
    color: #374151 !important;
    font-weight: 600;
    font-size: 15px;
    margin: 0 10px;
    position: relative;
    transition: 0.3s ease;
}

.navbar .nav-link:hover {
    color: var(--jpos-blue) !important;
}

.navbar .nav-link::after {
    content: "";
    position: absolute;
    width: 0%;
    height: 2px;
    background: var(--jpos-blue);
    left: 0;
    bottom: -6px;
    transition: 0.3s;
    border-radius: 20px;
}

.navbar .nav-link:hover::after {
    width: 100%;
}

/* =========================
   BUTTONS
========================= */

.btn-signin {
    border: 1.5px solid #dbe4f0;
    color: var(--jpos-blue);
    font-weight: 600;
    border-radius: 10px;
    padding: 10px 24px;
    transition: 0.3s;
    background: white;
}

.btn-signin:hover {
    background: #f3f7fd;
    border-color: var(--jpos-blue);
    color: var(--jpos-blue);
}

.btn-started {
    background: linear-gradient(135deg, var(--jpos-green), var(--jpos-green-light));
    color: white;
    font-weight: 600;
    border: none;
    border-radius: 10px;
    padding: 10px 24px;
    box-shadow: 0 10px 25px rgba(46,125,50,0.18);
    transition: 0.3s;
}

.btn-started:hover {
    transform: translateY(-2px);
    color: white;
}

/* =========================
   MEGA DROPDOWN
========================= */

.mega-dropdown {
    position: relative;
}

/* desktop dropdown */
.mega-menu {
    width: 720px;
    border: none;
    border-radius: 22px;
    overflow: hidden;
    padding: 0;
    display: none;
    margin-top: 10px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.12);
    animation: fadeIn 0.25s ease;
}

/* LEFT */
.mega-left {
    padding: 22px;
    background: white;
}

.mega-badge {
    background: rgba(11,79,163,0.08);
    color: var(--jpos-blue);
    font-size: 11px;
    font-weight: 700;
    padding: 5px 11px;
    border-radius: 30px;
    display: inline-block;
    text-transform: uppercase;
}

.mega-title {
    font-size: 20px;
    font-weight: 700;
    color: #111827;
    margin-top: 12px;
    margin-bottom: 16px;
    line-height: 1.3;
}

.mega-item {
    display: flex;
    text-decoration: none;
    gap: 14px;
    padding: 10px;
    border-radius: 14px;
    transition: 0.3s;
    margin-bottom: 6px;
}

.mega-item:hover {
    background: #f8fbff;
    transform: translateX(4px);
}

.mega-icon {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, rgba(11,79,163,0.12), rgba(46,125,50,0.12));
    border-radius: 14px;
    color: var(--jpos-blue);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 19px;
}

.mega-item h6 {
    font-size: 14px;
    font-weight: 700;
}

.mega-item p {
    font-size: 12px;
    color: #6b7280;
}

/* RIGHT */
.mega-right {
    background: linear-gradient(180deg, #f8fbff, #f4fff6);
    padding: 22px;
}

.integration-title {
    font-size: 12px;
    font-weight: 700;
    color: var(--jpos-blue);
    text-transform: uppercase;
    margin-bottom: 16px;
}

.side-link {
    display: flex;
    justify-content: space-between;
    text-decoration: none;
    color: #1f2937;
    font-weight: 600;
    padding: 9px 0;
    border-bottom: 1px solid #e5e7eb;
    font-size: 13px;
}

.side-link:hover {
    color: var(--jpos-blue);
    padding-left: 5px;
}

.promo-card {
    background: white;
    border-radius: 16px;
    padding: 16px;
    margin-top: 16px;
}

/* =========================
   ANIMATION
========================= */

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(8px); }
    to { opacity: 1; transform: translateY(0); }
}

/* =========================
   RESPONSIVE DESIGN
========================= */

/* TABLETS */
@media (max-width: 992px) {

    .mega-menu {
        width: 100%;
        position: static;
        display: none !important;
        box-shadow: none;
        border-radius: 0;
    }

    .mega-dropdown:hover .mega-menu {
        display: block !important;
    }

    .mega-left,
    .mega-right {
        padding: 18px;
    }

    .navbar-nav {
        margin-left: 0 !important;
    }
}

/* MOBILE */
@media (min-width: 993px) {
    .mega-dropdown:hover .mega-menu {
        display: block;
    }
}

@media (max-width: 768px) {

    .navbar .nav-link {
        margin: 8px 0;
    }

    .mega-title {
        font-size: 16px;
    }

    .mega-item {
        flex-direction: row;
    }

    .promo-card {
        margin-top: 12px;
    }

    .btn-signin,
    .btn-started {
        width: 100%;
        margin-bottom: 8px;
    }

    .ms-auto {
        margin-left: 0 !important;
        width: 100%;
        justify-content: flex-start;
    }
}

/* SMALL PHONES */
@media (max-width: 480px) {

    .logo-box {
        width: 36px;
        height: 36px;
        font-size: 14px;
    }

    .navbar-brand {
        font-size: 1.1rem;
    }

    .mega-item p {
        font-size: 11px;
    }
}

@media (max-width: 992px) {
    .navbar-collapse {
        max-height: 90vh;
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
    }
}

</style>


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
            <li class="nav-item dropdown mega-dropdown">
                <a class="nav-link dropdown-toggle"
                href="#"
                role="button">
                    Products
                </a>
                <div class="dropdown-menu mega-menu">
                <!-- Left -->
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
                    <a class="nav-link" href="#partners">
                        Partners
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
                    Get Started
                </a>
            </div>
        </div>
    </div>
</nav>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const dropdown = document.querySelector(".mega-dropdown");
    const menu = document.querySelector(".mega-menu");
    const trigger = dropdown.querySelector(".nav-link");

    let isOpen = false;

    trigger.addEventListener("click", function (e) {
        // only block click on mobile
        if (window.innerWidth <= 992) {
            e.preventDefault();

            isOpen = !isOpen;
            menu.style.display = isOpen ? "block" : "none";
        }
    });

    document.addEventListener("click", function (e) {
        if (!dropdown.contains(e.target)) {
            menu.style.display = "none";
            isOpen = false;
        }
    });

    // reset on resize
    window.addEventListener("resize", function () {
        if (window.innerWidth > 992) {
            menu.style.display = "";
            isOpen = false;
        }
    });
});
</script>