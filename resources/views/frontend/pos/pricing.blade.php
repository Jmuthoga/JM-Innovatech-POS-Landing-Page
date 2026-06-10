@extends('frontend.layouts.app')

@section('content')

<div class="retail-pricing-universe">

    <!-- ULTRA PREMIUM HERO WITH YOUTUBE BACKGROUND VIDEO -->
    <section class="position-relative overflow-hidden" style="height: 92vh; min-height: 650px;">

        <!-- YouTube Background Video -->
        <div class="position-absolute top-0 start-0 w-100 h-100" style="z-index:0; overflow:hidden;">
            <iframe
                src="https://www.youtube.com/embed/xT6IL3Mt1to?autoplay=1&mute=1&controls=0&loop=1&playlist=xT6IL3Mt1to&showinfo=0&modestbranding=1&rel=0"
                frameborder="0"
                allow="autoplay; fullscreen"
                allowfullscreen
                style="
                    position:absolute;
                    top:50%;
                    left:50%;
                    width:100%;
                    height:100%;
                    transform:translate(-50%, -50%);
                    pointer-events:none;
                    filter: brightness(0.55) contrast(1.1);
                ">
            </iframe>
        </div>

        <!-- Dark Gradient Overlay -->
        <div style="
            position:absolute;
            inset:0;
            background: linear-gradient(
                180deg,
                rgba(2,6,23,0.75) 0%,
                rgba(2,6,23,0.55) 50%,
                rgba(2,6,23,0.80) 100%
            );
            z-index:4;
        "></div>

        <!-- Soft Glow Effects -->
        <div style="
            position:absolute;
            top:-150px;
            left:-120px;
            width:400px;
            height:400px;
            background: rgba(11,79,163,0.25);
            filter: blur(90px);
            border-radius:50%;
            z-index:1;
        "></div>

        <div style="
            position:absolute;
            bottom:-180px;
            right:-120px;
            width:420px;
            height:420px;
            background: rgba(37,211,102,0.18);
            filter: blur(100px);
            border-radius:50%;
            z-index:1;
        "></div>

        <!-- HERO CONTENT -->
        <div class="container position-relative text-center text-white d-flex flex-column justify-content-center h-100"
            style="z-index:2;">

            <!-- Badge -->
            <div class="mb-3">
                <span class="badge px-3 py-2 rounded-pill"
                    style="
                        background: rgba(255,255,255,0.10);
                        border: 1px solid rgba(255,255,255,0.25);
                        backdrop-filter: blur(10px);
                        font-weight: 600;
                        letter-spacing: 0.12em;
                        font-size: 0.72rem;
                    ">
                    NEXT-GENERATION POS SYSTEM
                </span>
            </div>

            <!-- Title -->
            <h1 class="fw-bold mb-3"
                style="
                    font-size: clamp(2.2rem, 4vw, 3.5rem);
                    line-height: 1.1;
                    letter-spacing: -0.03em;
                ">
                A Complete Retail Operating System <br>
                Built for Scale & Control
            </h1>

            <!-- Subtitle -->
            <p class="mx-auto mb-4"
                style="max-width: 780px; font-size: 1.05rem; opacity:0.85; line-height:1.8;">
                Manage sales, inventory, M-Pesa payments, tax compliance, reporting, and multi-branch logistics —
                all in one powerful unified platform built for modern African retail businesses.
            </p>

            <!-- CTA Buttons -->
            <div class="d-flex flex-column flex-sm-row justify-content-center gap-3 mt-3">

                <a href="#pricing"
                class="btn px-4 py-2 fw-bold"
                style="
                        background:#0B4FA3;
                        color:#fff;
                        border-radius:10px;
                        box-shadow:0 10px 25px rgba(11,79,163,0.35);
                ">
                    View Pricing Plans
                </a>

                <a href="#jmi-setup-portal"
                class="btn px-4 py-2 fw-bold"
                style="
                        background:rgba(255,255,255,0.12);
                        color:#fff;
                        border:1px solid rgba(255,255,255,0.25);
                        border-radius:10px;
                        backdrop-filter: blur(10px);
                ">
                    Book Live Demo
                </a>

            </div>

            <!-- Trust line -->
            <div class="mt-4 small opacity-75">
                ✔ No Setup Fees &nbsp; • &nbsp; ✔ Instant Activation &nbsp; • &nbsp; ✔ M-Pesa Ready &nbsp; • &nbsp; ✔ KRA eTIMS Compliant
            </div>

        </div>
    </section>

    <!-- CORE FEATURE-INCLUSION PLAN DECK -->
    <section class="py-5">
        <section class="py-5">
            <div class="container text-center">

                <div class="d-flex justify-content-center mb-4">
                    <div class="pricing-toggle-hub" role="tablist">

                        <div class="pricing-toggle-indicator" id="toggleIndicator"></div>

                        <button type="button"
                            class="switch-node active-state"
                            id="trigger-monthly-mode"
                            onclick="executePricingShift('monthly')">
                            Monthly Billing
                        </button>

                        <button type="button"
                            class="switch-node"
                            id="trigger-annual-mode"
                            onclick="executePricingShift('annual')">
                            Annual Billing
                            <span class="save-tag">(Save 15%)</span>
                        </button>

                    </div>
                </div>

                <div class="row g-4 justify-content-center align-items-stretch">
                    ...
                </div>

            </div>
        </section>
        <div class="container">
            <div class="row g-4 justify-content-center align-items-stretch">
                
                <!-- PLAN TIER 1: LITE MODEL -->
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 d-flex">
                    <div class="package-deck-card w-100">
                        <div class="mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="text-muted small fw-bold text-uppercase">Single Kiosk</span>
                                <i class="fas fa-calculator text-muted"></i>
                            </div>
                            <h3 class="fw-bold text-brand-navy h4 mb-2">Lite Plan</h3>
                            <p class="text-muted small mb-0" style="min-height: 40px;">
                                Fundamental modules tracking a single, standalone retail setup.
                            </p>
                            <div class="py-3 my-3 border-top border-bottom border-light">
                                <div class="price-view-monthly"><span class="fs-2 fw-bold text-dark">Ksh 1,000</span><span class="text-muted small">/mo</span></div>
                                <div class="price-view-annual d-none"><span class="fs-2 fw-bold text-dark">Ksh 10,200</span><span class="text-muted small">/yr</span></div>
                            </div>
                        </div>

                        <div class="flex-grow-1 mb-4">
                            <div class="feature-divider-label text-success">Included in plan</div>
                            <ul class="list-unstyled mb-4 small">
                                <li class="mb-2 d-flex align-items-start gap-2 fw-bold">
                                    <i class="fas fa-check-circle text-success mt-1"></i>
                                    <span>1 Isolated Business Profile</span>
                                </li>
                                <li class="mb-2 d-flex align-items-start gap-2">
                                    <i class="fas fa-check-circle text-success mt-1"></i>
                                    <span>Manual Cash & Credit Ledgers</span>
                                </li>
                                <li class="mb-2 d-flex align-items-start gap-2">
                                    <i class="fas fa-check-circle text-success mt-1"></i>
                                    <span>Standard USB Barcode Reading</span>
                                </li>
                                <li class="mb-2 d-flex align-items-start gap-2">
                                    <i class="fas fa-check-circle text-success mt-1"></i>
                                    <span>Basic Daily Sales Reports</span>
                                </li>
                            </ul>

                            <div class="feature-divider-label text-danger">Not part of plan</div>
                            <ul class="list-unstyled mb-0 small text-muted opacity-65">
                                <li class="mb-2 d-flex align-items-start gap-2 text-danger fw-bold">
                                    <i class="fas fa-ban text-danger mt-1"></i>
                                    <span>No Extra Branches Supported</span>
                                </li>
                                <li class="mb-2 d-flex align-items-start gap-2">
                                    <i class="fas fa-ban text-danger mt-1"></i>
                                    <span>No Automated M-Pesa Syncer</span>
                                </li>
                                <li class="mb-2 d-flex align-items-start gap-2">
                                    <i class="fas fa-ban text-danger mt-1"></i>
                                    <span>No KRA eTIMS Payloads</span>
                                </li>
                            </ul>
                        </div>

                        <div class="mt-auto">
                            <a href="#jmi-setup-portal" class="action-route-anchor style-secondary">Get Lite Stack</a>
                        </div>
                    </div>
                </div>

                <!-- PLAN TIER 2: BASIC MODEL -->
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 d-flex">
                    <div class="package-deck-card w-100">
                        <div class="mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="text-muted small fw-bold text-uppercase">Standard Retail</span>
                                <i class="fas fa-store text-muted"></i>
                            </div>
                            <h3 class="fw-bold text-brand-navy h4 mb-2">Basic Plan</h3>
                            <p class="text-muted small mb-0" style="min-height: 40px;">
                                Active transaction engine featuring automated client checkout operations.
                            </p>
                            <div class="py-3 my-3 border-top border-bottom border-light">
                                <div class="price-view-monthly"><span class="fs-2 fw-bold text-dark">Ksh 1,500</span><span class="text-muted small">/mo</span></div>
                                <div class="price-view-annual d-none"><span class="fs-2 fw-bold text-dark">Ksh 15,300</span><span class="text-muted small">/yr</span></div>
                            </div>
                        </div>

                        <div class="flex-grow-1 mb-4">
                            <div class="feature-divider-label text-success">Included in plan</div>
                            <ul class="list-unstyled mb-4 small">
                                <li class="mb-2 d-flex align-items-start gap-2 fw-bold">
                                    <i class="fas fa-check-circle text-success mt-1"></i>
                                    <span>1 Main Business Instance</span>
                                </li>
                                <li class="mb-2 d-flex align-items-start gap-2 fw-bold text-brand-blue">
                                    <i class="fas fa-check-circle text-success mt-1"></i>
                                    <span>M-Pesa STK Push Integration</span>
                                </li>
                                <li class="mb-2 d-flex align-items-start gap-2">
                                    <i class="fas fa-check-circle text-success mt-1"></i>
                                    <span>Instant SMS Receipt Dispatch</span>
                                </li>
                                <li class="mb-2 d-flex align-items-start gap-2">
                                    <i class="fas fa-check-circle text-success mt-1"></i>
                                    <span>Smart Re-order & Expiry Alarms</span>
                                </li>
                                <li class="mb-2 d-flex align-items-start gap-2">
                                    <i class="fas fa-check-circle text-success mt-1"></i>
                                    <span>Gross Profit Margin Analytics</span>
                                </li>
                            </ul>

                            <div class="feature-divider-label text-danger">Not part of plan</div>
                            <ul class="list-unstyled mb-0 small text-muted opacity-65">
                                <li class="mb-2 d-flex align-items-start gap-2 text-danger fw-bold">
                                    <i class="fas fa-ban text-danger mt-1"></i>
                                    <span>No Extra Branches Supported</span>
                                </li>
                                <li class="mb-2 d-flex align-items-start gap-2">
                                    <i class="fas fa-ban text-danger mt-1"></i>
                                    <span>No KRA eTIMS Tax Compliance</span>
                                </li>
                            </ul>
                        </div>

                        <div class="mt-auto">
                            <a href="#jmi-setup-portal" class="action-route-anchor style-secondary">Select Basic</a>
                        </div>
                    </div>
                </div>

                <!-- PLAN TIER 3: BUSINESS PRO -->
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 d-flex">
                    <div class="package-deck-card w-100 pro-tier-accent">
                        <span class="pro-tier-badge">Recommended</span>
                        <div class="mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="text-brand-blue small fw-bold text-uppercase">Dual Store Setup</span>
                                <i class="fas fa-chart-line text-brand-blue"></i>
                            </div>
                            <h3 class="fw-bold text-brand-navy h4 mb-2">Business Pro</h3>
                            <p class="text-muted small mb-0" style="min-height: 40px;">
                                Advanced oversight, multi-till control parameters, and branch sync architecture.
                            </p>
                            <div class="py-3 my-3 border-top border-bottom border-light">
                                <div class="price-view-monthly"><span class="fs-2 fw-bold text-dark">Ksh 3,500</span><span class="text-muted small">/mo</span></div>
                                <div class="price-view-annual d-none"><span class="fs-2 fw-bold text-dark">Ksh 35,700</span><span class="text-muted small">/yr</span></div>
                            </div>
                        </div>

                        <div class="flex-grow-1 mb-4">
                            <div class="feature-divider-label text-success">Included in plan</div>
                            <ul class="list-unstyled mb-4 small">
                                <li class="mb-2 d-flex align-items-start gap-2 fw-bold text-brand-blue">
                                    <i class="fas fa-check-circle text-success mt-1"></i>
                                    <span>1 Main Store + 1 Extra Branch</span>
                                </li>
                                <li class="mb-2 d-flex align-items-start gap-2">
                                    <i class="fas fa-check-circle text-success mt-1"></i>
                                    <span>Automated M-Pesa Ledger Sync</span>
                                </li>
                                <li class="mb-2 d-flex align-items-start gap-2 fw-bold">
                                    <i class="fas fa-check-circle text-success mt-1"></i>
                                    <span>KRA eTIMS Middleware Compliance</span>
                                </li>
                                <li class="mb-2 d-flex align-items-start gap-2">
                                    <i class="fas fa-check-circle text-success mt-1"></i>
                                    <span>Stock Loss Alarms & User Roles</span>
                                </li>
                                <li class="mb-2 d-flex align-items-start gap-2">
                                    <i class="fas fa-check-circle text-success mt-1"></i>
                                    <span>Supplier Credit & Invoicing Modules</span>
                                </li>
                                <li class="mb-2 d-flex align-items-start gap-2">
                                    <i class="fas fa-check-circle text-success mt-1"></i>
                                    <span>End-of-Shift Automated Mail Audits</span>
                                </li>
                            </ul>

                            <div class="feature-divider-label text-danger">Not part of plan</div>
                            <ul class="list-unstyled mb-0 small text-muted opacity-65">
                                <li class="mb-2 d-flex align-items-start gap-2">
                                    <i class="fas fa-ban text-danger mt-1"></i>
                                    <span>No Multi-Store Complex Logistics</span>
                                </li>
                            </ul>
                        </div>

                        <div class="mt-auto">
                            <a href="#jmi-setup-portal" class="action-route-anchor style-primary">Go Business Pro</a>
                        </div>
                    </div>
                </div>

                <!-- PLAN TIER 4: MULTI-STORE ENTERPRISE -->
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 d-flex">
                    <div class="package-deck-card w-100 enterprise-tier-dark">
                        <div class="mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="text-brand-green small fw-bold text-uppercase">Enterprise Logistics</span>
                                <i class="fas fa-network-wired text-brand-green"></i>
                            </div>
                            <h3 class="fw-bold text-white h4 mb-2">Multi-Store</h3>
                            <p class="text-light opacity-75 small mb-0" style="min-height: 40px;">
                                Central orchestration system across nested multi-company operations.
                            </p>
                            <div class="py-3 my-3 border-top border-bottom border-secondary">
                                <div class="price-view-monthly"><span class="fs-2 fw-bold text-white">Ksh 7,500</span><span class="text-light opacity-75 small">/mo</span></div>
                                <div class="price-view-annual d-none"><span class="fs-2 fw-bold text-white">Ksh 76,500</span><span class="text-light opacity-75 small">/yr</span></div>
                            </div>
                        </div>

                        <div class="flex-grow-1 mb-4">
                            <div class="feature-divider-label text-success">Included in plan</div>
                            <ul class="list-unstyled mb-0 small text-light opacity-90">
                                <li class="mb-2 d-flex align-items-start gap-2 fw-bold text-brand-green">
                                    <i class="fas fa-check-circle text-success mt-1"></i>
                                    <span>1 Business with Unlimited Branches</span>
                                </li>
                                <li class="mb-2 d-flex align-items-start gap-2">
                                    <i class="fas fa-check-circle text-success mt-1"></i>
                                    <span>Inter-Store Stock Logistics Routing</span>
                                </li>
                                <li class="mb-2 d-flex align-items-start gap-2">
                                    <i class="fas fa-check-circle text-success mt-1"></i>
                                    <span>Consolidated Business HQ Metrics</span>
                                </li>
                                <li class="mb-2 d-flex align-items-start gap-2">
                                    <i class="fas fa-check-circle text-success mt-1"></i>
                                    <span>Tiered Price Profiles & Discounts</span>
                                </li>
                                <li class="mb-2 d-flex align-items-start gap-2">
                                    <i class="fas fa-check-circle text-success mt-1"></i>
                                    <span>Dedicated Isolated Cloud Hosting</span>
                                </li>
                                <li class="mb-2 d-flex align-items-start gap-2">
                                    <i class="fas fa-check-circle text-success mt-1"></i>
                                    <span>24/7 Dedicated Priority Account Desk</span>
                                </li>
                            </ul>
                        </div>

                        <div class="mt-auto">
                            <a href="#jmi-setup-portal" class="action-route-anchor style-light">Contact Enterprise Desk</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

<!-- EXPANDED 10-ROW HIGH-CONTRAST SYSTEM CAPABILITY MATRIX -->
    <section class="py-5 bg-white border-top border-bottom">
        <div class="container">
            <div class="text-center mb-4">
                <h2 class="fw-bold text-brand-navy h3 mb-2">System Capability Matrix</h2>
                <p class="text-muted small mx-auto" style="max-width: 500px;">
                    Core architectural modules and integration capacities across plan tiers.
                </p>
            </div>
            
            <div class="condensed-matrix-box table-responsive">
                <table class="table mb-0 w-100 align-middle">
                    <thead>
                        <tr>
                            <!-- Added explicit dark colors and bolding to ensure structural text visibility -->
                            <th class="matrix-header-node fw-bold text-dark" style="width: 40%; color: #0F172A !important; font-size: 0.95rem;">Core Capabilities</th>
                            <th class="matrix-header-node text-center fw-bold text-dark" style="width: 15%; color: #0F172A !important; font-size: 0.95rem;">Lite</th>
                            <th class="matrix-header-node text-center fw-bold text-dark" style="width: 15%; color: #0F172A !important; font-size: 0.95rem;">Basic</th>
                            <th class="matrix-header-node text-center fw-bold text-dark" style="width: 15%; color: #0F172A !important; font-size: 0.95rem;">Business</th>
                            <th class="matrix-header-node text-center fw-bold text-dark" style="width: 15%; color: #0F172A !important; font-size: 0.95rem;">Multi-Store</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- ROW 1: SCALE & BRANCHES -->
                        <tr>
                            <td class="matrix-cell-node fw-bold" style="color: #334155;"><i class="fas fa-network-wired text-muted me-2"></i> Supported Branch Network</td>
                            <td class="matrix-cell-node text-center text-muted small">Main Only (0 Branches)</td>
                            <td class="matrix-cell-node text-center text-muted small">Main Only (0 Branches)</td>
                            <td class="matrix-cell-node text-center text-brand-blue fw-bold small">Main + 1 Branch</td>
                            <td class="matrix-cell-node text-center text-success fw-bold small">Unlimited Branches</td>
                        </tr>

                        <!-- ROW 2: MPESA -->
                        <tr>
                            <td class="matrix-cell-node fw-bold" style="color: #334155;"><i class="fas fa-credit-card text-muted me-2"></i> M-Pesa STK API Integration</td>
                            <td class="matrix-cell-node text-center"><i class="fas fa-times text-danger opacity-50"></i></td>
                            <td class="matrix-cell-node text-center text-success"><i class="fas fa-check-circle fs-5"></i></td>
                            <td class="matrix-cell-node text-center text-success"><i class="fas fa-check-circle fs-5"></i></td>
                            <td class="matrix-cell-node text-center text-success"><i class="fas fa-check-circle fs-5"></i></td>
                        </tr>

                        <!-- ROW 3: eTIMS -->
                        <tr>
                            <td class="matrix-cell-node fw-bold" style="color: #334155;"><i class="fas fa-calculator text-muted me-2"></i> KRA eTIMS Tax Compliance</td>
                            <td class="matrix-cell-node text-center"><i class="fas fa-times text-danger opacity-50"></i></td>
                            <td class="matrix-cell-node text-center"><i class="fas fa-times text-danger opacity-50"></i></td>
                            <td class="matrix-cell-node text-center text-success"><i class="fas fa-check-circle fs-5"></i></td>
                            <td class="matrix-cell-node text-center text-success"><i class="fas fa-check-circle fs-5"></i></td>
                        </tr>

                        <!-- ROW 4: INVENTORY & ALERTS -->
                        <tr>
                            <td class="matrix-cell-node fw-bold" style="color: #334155;"><i class="fas fa-boxes text-muted me-2"></i> Expiry & Low-Stock Alerts</td>
                            <td class="matrix-cell-node text-center text-muted small">Manual Audit</td>
                            <td class="matrix-cell-node text-center text-success"><i class="fas fa-check-circle fs-5"></i></td>
                            <td class="matrix-cell-node text-center text-success"><i class="fas fa-check-circle fs-5"></i></td>
                            <td class="matrix-cell-node text-center text-success"><i class="fas fa-check-circle fs-5"></i></td>
                        </tr>

                        <!-- ROW 5: REPORTING -->
                        <tr>
                            <td class="matrix-cell-node fw-bold" style="color: #334155;"><i class="fas fa-chart-pie text-muted me-2"></i> Profit Analytics & Shift Audits</td>
                            <td class="matrix-cell-node text-center text-muted small">Basic Totals</td>
                            <td class="matrix-cell-node text-center text-muted small">Standard Reports</td>
                            <td class="matrix-cell-node text-center text-success fw-bold small">Automated Email Reports</td>
                            <td class="matrix-cell-node text-center text-success fw-bold small">Consolidated HQ Desk</td>
                        </tr>

                        <!-- ROW 6: HARDWARE -->
                        <tr>
                            <td class="matrix-cell-node fw-bold" style="color: #334155;"><i class="fas fa-print text-muted me-2"></i> POS Hardware Interfacing</td>
                            <td class="matrix-cell-node text-center text-muted small">Scanners / Printers</td>
                            <td class="matrix-cell-node text-center text-success fw-bold small">Scanners / Printers / Scales</td>
                            <td class="matrix-cell-node text-center text-success fw-bold small">Scanners / Printers / Scales</td>
                            <td class="matrix-cell-node text-center text-success fw-bold small">Scanners / Printers / Scales</td>
                        </tr>

                        <!-- ROW 7: CUSTOMER SMS RECIEPTS -->
                        <tr>
                            <td class="matrix-cell-node fw-bold" style="color: #334155;"><i class="fas fa-sms text-muted me-2"></i> Instant SMS Receipt Dispatch</td>
                            <td class="matrix-cell-node text-center"><i class="fas fa-times text-danger opacity-50"></i></td>
                            <td class="matrix-cell-node text-center"><i class="fas fa-times text-danger opacity-50"></i></td>
                            <td class="matrix-cell-node text-center text-success"><i class="fas fa-check-circle fs-5"></i></td>
                            <td class="matrix-cell-node text-center text-success"><i class="fas fa-check-circle fs-5"></i></td>
                        </tr>

                        <!-- ROW 8: TILLS & CASHIERS -->
                        <tr>
                            <td class="matrix-cell-node fw-bold" style="color: #334155;"><i class="fas fa-users-cog text-muted me-2"></i> Multi-Till & Cashier Controls</td>
                            <td class="matrix-cell-node text-center text-muted small">Single User</td>
                            <td class="matrix-cell-node text-center text-muted small">Max 2 Tills</td>
                            <td class="matrix-cell-node text-center text-success fw-bold small">Unlimited Tills</td>
                            <td class="matrix-cell-node text-center text-success fw-bold small">Unlimited Tills</td>
                        </tr>

                        <!-- ROW 9: CREDIT & SUPPLIER TRACKING -->
                        <tr>
                            <td class="matrix-cell-node fw-bold" style="color: #334155;"><i class="fas fa-file-invoice-dollar text-muted me-2"></i> Supplier Ledgers & Credit Accounts</td>
                            <td class="matrix-cell-node text-center"><i class="fas fa-times text-danger opacity-50"></i></td>
                            <td class="matrix-cell-node text-center text-success"><i class="fas fa-check-circle fs-5"></i></td>
                            <td class="matrix-cell-node text-center text-success"><i class="fas fa-check-circle fs-5"></i></td>
                            <td class="matrix-cell-node text-center text-success"><i class="fas fa-check-circle fs-5"></i></td>
                        </tr>

                        <!-- ROW 10: INTER-STORE TRANSFER LOGISTICS -->
                        <tr>
                            <td class="matrix-cell-node fw-bold" style="color: #334155;"><i class="fas fa-truck-loading text-muted me-2"></i> Inter-Branch Stock Transfers</td>
                            <td class="matrix-cell-node text-center"><i class="fas fa-times text-danger opacity-50"></i></td>
                            <td class="matrix-cell-node text-center"><i class="fas fa-times text-danger opacity-50"></i></td>
                            <td class="matrix-cell-node text-center"><i class="fas fa-times text-danger opacity-50"></i></td>
                            <td class="matrix-cell-node text-center text-success"><i class="fas fa-check-circle fs-5"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- INTEGRATED LIVE TESTING & INSTALLATION TOUR PORTAL -->
    <section id="jmi-setup-portal" class="py-5 bg-brand-navy text-white">
        <div class="container py-4">
            <div class="row align-items-center g-5">
                
                <div class="col-12 col-lg-6 text-center text-lg-start">
                    <span class="badge bg-success text-dark px-3 py-2 rounded-pill mb-3 fw-bold d-inline-block">
                        Test the Live App
                    </span>
                    <h3 class="fw-bold display-6 mb-3 text-white">
                        Try out our live testing system right now
                    </h3>
                    <p class="text-light opacity-75 mb-4 mx-auto mx-lg-0" style="max-width: 540px;">
                        Open our interactive evaluation sandbox to run test transactions, explore backend sales reports, and see how simple the system interface is to use.
                    </p>

                    <div class="p-4 rounded-4 mb-4 border border-secondary text-start mx-auto mx-lg-0" style="background: rgba(255,255,255,0.04); max-width: 500px;">
                        <h5 class="fw-bold text-white mb-2"><i class="fas fa-laptop me-2 text-success"></i> Instant Demonstration Link</h5>
                        <p class="small text-light opacity-75 mb-3">All login credentials are pre-filled on the terminal testing page screen.</p>
                        <a href="https://pos.jminnovatechsolution.co.ke" target="_blank" rel="noopener" class="jmi-posmodule-btn-primary border-0 w-100">
                            Launch Demo System <i class="fas fa-external-link-alt ms-2 small"></i>
                        </a>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="p-4 bg-white rounded-4 shadow text-dark mx-auto me-lg-0" style="max-width: 460px;">
                        <h5 class="fw-bold text-brand-navy mb-1">Book a Live Installation Tour</h5>
                        <p class="text-muted small mb-4">Fill out your details below and our tech team will configure a system for your shop.</p>

                        <form action="{{ route('pos.contact') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted mb-1">Your Name</label>
                                <input 
                                    type="text" 
                                    name="name"
                                    class="form-control rounded-3" 
                                    placeholder="e.g. Mary Atieno" 
                                    required
                                    style="padding: 0.6rem 0.75rem; border: 1px solid var(--border-color);"
                                >
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted mb-1">Business Sector</label>
                                <select 
                                    name="sector" 
                                    class="form-select rounded-3" 
                                    required
                                    style="padding: 0.6rem 0.75rem; border: 1px solid var(--border-color); background-image: url('data:image/svg+xml,%3csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 16 16\'%3e%3cpath fill=\'none\' stroke=\'%2364748b\' stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'m2 5 6 6 6-6\'/%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 0.75rem center; background-size: 14px 10px;"
                                >
                                    <option value="">What do you sell?...</option>

                                    <?php if(isset($allSectors) && count($allSectors) > 0): ?>
                                        <?php foreach($allSectors as $s): ?>
                                            <option value="<?php echo e($s->name); ?>">
                                                <?php echo e($s->name); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label small fw-bold text-muted mb-1">Mobile Phone Number</label>
                                <input 
                                    type="tel" 
                                    name="phone"
                                    class="form-control rounded-3" 
                                    placeholder="e.g. 0700000000" 
                                    required
                                    style="padding: 0.6rem 0.75rem; border: 1px solid var(--border-color);"
                                >
                            </div>

                            <button type="submit" class="jmi-posmodule-btn-primary w-100 border-0 py-2 rounded-3 fw-bold">
                                Request My Setup Quote <i class="fas fa-calendar-check ms-2"></i>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>

<!-- COMPACT SWITCH ENGINE ROUTINE -->
<script>
    function executePricingShift(mode) {
        const monthlyBtn = document.getElementById('trigger-monthly-mode');
        const annualBtn = document.getElementById('trigger-annual-mode');
        const indicator = document.getElementById('toggleIndicator');

        const monthlyPrices = document.querySelectorAll('.price-view-monthly');
        const annualPrices = document.querySelectorAll('.price-view-annual');

        const isAnnual = mode === 'annual';

        // button states
        monthlyBtn.classList.toggle('active-state', !isAnnual);
        annualBtn.classList.toggle('active-state', isAnnual);

        // price switching
        monthlyPrices.forEach(el => el.classList.toggle('d-none', isAnnual));
        annualPrices.forEach(el => el.classList.toggle('d-none', !isAnnual));

        // slider movement (magic part)
        if (isAnnual) {
            indicator.style.transform = "translateX(100%)";
        } else {
            indicator.style.transform = "translateX(0%)";
        }
    }
</script>
@endsection