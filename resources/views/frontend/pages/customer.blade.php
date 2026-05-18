@extends('frontend.layouts.app')

@section('content')

<div class="py-5 bg-light min-vh-screen">
    <div class="container-xl">
        
        <!-- Status Flash Notifications -->
        @if(session('success'))
            <div class="alert alert-success d-flex align-items-center gap-3 mb-4 shadow-sm border-0 border-start border-4 border-success rounded-3" role="alert">
                <i class="fa-solid fa-circle-check fs-5 text-success"></i>
                <div class="fw-medium small text-success-emphasis">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- Executive Welcome Banner Component -->
        <div class="premium-banner rounded-3 p-4 p-md-5 text-white shadow-sm mb-4 position-relative overflow-hidden">
            <div class="banner-grid-overlay"></div>
            <div class="row align-items-center justify-content-between position-relative z-3 g-4">
                <div class="col-12 col-md-7">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge text-uppercase tracking-wider bg-white bg-opacity-10 text-white rounded-1 px-2.5 py-1 fw-semibold border border-white-10 small" style="font-size: 0.75rem;">
                            Client Portal
                        </span>
                        <span class="text-white-50 small">&bull; ID: #{{ str_pad($customer['id'] ?? '1', 6, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <h1 class="h3 fw-bold tracking-tight text-white mb-1">Welcome Back, {{ $customer['first_name'] }} {{ $customer['last_name'] }}</h1>
                    <p class="text-white-50 small mb-0 opacity-85">Manage your active procurement contracts, update dispatch locations, and request immediate parcel status audits.</p>
                </div>
                <div class="col-12 col-md-5 text-md-end">
                    <div class="d-flex flex-wrap gap-2 justify-content-md-end">
                        <button onclick="switchTab('orders')" class="btn btn-brand-blue text-white btn-sm px-3 py-2 rounded-2 fw-medium d-flex align-items-center gap-2 shadow-sm border-0">
                            <i class="fa-solid fa-boxes-stacked small"></i> View Purchase Ledger
                        </button>
                        <button onclick="focusTracker()" class="btn btn-light btn-sm bg-white border px-3 py-2 rounded-2 fw-medium d-flex align-items-center gap-2 text-dark shadow-sm">
                            <i class="fa-solid fa-magnifying-glass small text-dark"></i> Track Order Shipment
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Account Workspace Grid Layout -->
        <div class="row g-4">
            
            <!-- Navigation Sidebar Panel -->
            <div class="col-12 col-lg-3">
                <div class="bg-white border rounded-3 p-3 shadow-sm sticky-sidebar" style="border-color: var(--border-color);">
                    <div class="d-flex align-items-center gap-3 pb-3 mb-3" style="border-bottom: 1px solid var(--border-color);">
                        <div class="flex-shrink-0 d-flex align-items-center justify-content-center bg-brand-blue rounded-2 fw-bold text-white fs-5 shadow-sm" style="width: 44px; height: 44px;">
                            {{ strtoupper(substr(auth()->user()->first_name, 0, 1) . substr(auth()->user()->last_name, 0, 1)) }}
                        </div>
                        <div class="overflow-hidden">
                            <h6 class="fw-bold text-dark mb-0 text-truncate" style="font-size: 0.95rem;">{{ $customer['first_name'] }} {{ $customer['last_name'] }}</h6>
                            <p class="small text-muted text-truncate mb-0" style="font-size: 0.8rem;">{{ $customer['email'] }}</p>
                        </div>
                    </div>
                    
                    <nav class="nav flex-column gap-1">
                        <button onclick="switchTab('overview')" id="tab-btn-overview" class="tab-btn active w-100 d-flex align-items-center justify-content-between px-3 py-2.5 small fw-semibold rounded-2 text-start">
                            <span class="d-flex align-items-center gap-2.5"><i class="fa-solid fa-chart-pie opacity-75"></i> Overview Dashboard</span>
                            <i class="fa-solid fa-chevron-right style-arrow small opacity-25"></i>
                        </button>
                        
                        <button onclick="switchTab('orders')" id="tab-btn-orders" class="tab-btn w-100 d-flex align-items-center justify-content-between px-3 py-2.5 small fw-semibold rounded-2 text-start">
                            <span class="d-flex align-items-center gap-2.5"><i class="fa-solid fa-clock-rotate-left opacity-75"></i> Purchase History</span>
                            <span class="badge bg-dark bg-opacity-10 text-dark fw-bold px-2 py-0.5 rounded-pill" style="font-size: 0.75rem;">{{ count($orders) }}</span>
                        </button>
                        
                        <button onclick="switchTab('profile')" id="tab-btn-profile" class="tab-btn w-100 d-flex align-items-center justify-content-between px-3 py-2.5 small fw-semibold rounded-2 text-start">
                            <span class="d-flex align-items-center gap-2.5"><i class="fa-solid fa-truck-ramp-box opacity-75"></i> Delivery Profile</span>
                            <i class="fa-solid fa-chevron-right style-arrow small opacity-25"></i>
                        </button>

                        <button onclick="switchTab('security')" id="tab-btn-security" class="tab-btn w-100 d-flex align-items-center justify-content-between px-3 py-2.5 small fw-semibold rounded-2 text-start">
                            <span class="d-flex align-items-center gap-2.5"> <i class="fa-solid fa-lock opacity-75"></i>Security Settings </span>
                            <i class="fa-solid fa-chevron-right style-arrow small opacity-25"></i>
                        </button>
                    </nav>

                    <div class="mt-4 pt-3" style="border-top: 1px solid var(--border-color);">
                        <a href="{{ route('shop') }}" class="btn btn-outline-secondary w-100 d-flex align-items-center justify-content-center gap-2 fw-medium small py-2 rounded-2 text-dark border">
                            <i class="fa-solid fa-bag-shopping text-muted"></i> Return to Shop Catalog
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Context Content Display Board -->
            <div class="col-12 col-lg-9">
                
                <!-- ================= PANEL 1: OVERVIEW ================= -->
                <div id="tab-panel-overview" class="tab-panel d-flex flex-column gap-4">
                    
                    <!-- Advanced Interactive Order Tracking Component -->
                    <div class="account-card p-4 border border-brand-blue border-opacity-25 bg-white">
                        <div class="row align-items-center g-3">
                            <div class="col-12 col-md-5">
                                <h6 class="fw-bold text-dark mb-1"><i class="fa-solid fa-crosshairs text-brand-blue me-1"></i> Live Real-Time Order Tracking</h6>
                                <p class="text-muted small mb-0">Input your system dispatch tracking number below to audit route status steps.</p>
                            </div>
                            <div class="col-12 col-md-7">
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted border-end-0"><i class="fa-solid fa-hashtag small"></i></span>
                                    <select class="form-select border-start-0 small" id="trackerInput" style="font-size: 0.875rem;">
                                        <option value="">Select an active contract code...</option>
                                        @foreach($orders as $order)
                                            <option value="{{ $order['order_number'] }}" data-status="{{ $order['status'] }}">
                                                {{ $order['order_number'] }} — KES {{ number_format($order['total_order_amount']) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button class="btn bg-brand-blue text-white btn-audit-engine px-4 py-2 fw-semibold small d-flex align-items-center gap-2" onclick="processTrackingAudit()" type="button">
                                        <i class="fa-solid fa-chart-network small opacity-75"></i> Track Order
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Dynamic Visual Progress Map State Container -->
                        <div id="trackingTimelineContainer" class="d-none mt-4 pt-4 border-top" style="border-top: 1px dashed var(--border-color);">
                            <div class="d-flex align-items-center justify-content-between mb-3 bg-light p-2.5 rounded-2">
                                <span class="small fw-semibold text-muted">Track Code: <strong class="text-dark" id="displayOrderNum"></strong></span>
                                <span class="badge bg-brand-blue text-white rounded px-2.5 py-1" id="displayOrderStatus"></span>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center pt-2 px-2">
                                <div class="tracking-step" id="step-placed">
                                    <div class="step-icon"><i class="fa-solid fa-file-signature"></i></div>
                                    <span class="d-block fw-bold text-dark small" style="font-size: 0.75rem;">Order Booked</span>
                                </div>
                                <div class="tracking-step" id="step-processing">
                                    <div class="step-icon"><i class="fa-solid fa-gears"></i></div>
                                    <span class="d-block fw-bold text-dark small" style="font-size: 0.75rem;">Processing</span>
                                </div>
                                <div class="tracking-step" id="step-shipped">
                                    <div class="step-icon"><i class="fa-solid fa-truck"></i></div>
                                    <span class="d-block fw-bold text-dark small" style="font-size: 0.75rem;">In Transit</span>
                                </div>
                                <div class="tracking-step" id="step-delivered">
                                    <div class="step-icon"><i class="fa-solid fa-house-chimney-user"></i></div>
                                    <span class="d-block fw-bold text-dark small" style="font-size: 0.75rem;">Delivered</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics Analytic Widgets -->
                    <div class="row g-3">
                        <div class="col-12 col-sm-4">
                            <div class="account-card p-4 d-flex align-items-center justify-content-between h-100">
                                <div>
                                    <p class="small fw-bold text-uppercase tracking-wider mb-1" style="color: var(--text-muted); font-size: 0.75rem;">Total Orders</p>
                                    <h3 class="fw-bold m-0 text-dark">{{ count($orders) }}</h3>
                                </div>
                                <div class="rounded-2 d-flex align-items-center justify-content-center fs-5" style="width: 44px; height: 44px; background-color: rgba(11, 79, 163, 0.05); color: var(--brand-blue);"><i class="fa-solid fa-file-invoice-dollar"></i></div>
                            </div>
                        </div>
                        
                        <div class="col-12 col-sm-4">
                            <div class="account-card p-4 d-flex align-items-center justify-content-between h-100">
                                <div>
                                    <p class="small fw-bold text-uppercase tracking-wider mb-1" style="color: var(--text-muted); font-size: 0.75rem;">Settled Transactions</p>
                                    <h3 class="fw-bold m-0 text-dark">
                                        {{ collect($orders)->where('status', 'Paid')->count() }}
                                    </h3>
                                </div>
                                <div class="bg-success bg-opacity-10 text-success rounded-2 d-flex align-items-center justify-content-center fs-5" style="width: 44px; height: 44px;"><i class="fa-solid fa-circle-check"></i></div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-4">
                            <div class="account-card p-4 d-flex align-items-center justify-content-between h-100">
                                <div>
                                    <p class="small fw-bold text-uppercase tracking-wider mb-1" style="color: var(--text-muted); font-size: 0.75rem;">On-Delivery Pending</p>
                                    <h3 class="fw-bold m-0 text-dark">
                                        {{ collect($orders)->where('status', 'Pending Delivery Payment')->count() }}
                                    </h3>
                                </div>
                                <div class="bg-warning bg-opacity-10 text-warning-emphasis rounded-2 d-flex align-items-center justify-content-center fs-5" style="width: 44px; height: 44px;"><i class="fa-solid fa-truck-fast"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4">
                        <!-- Left Subcard: Default Shipping Coordinates -->
                        <div class="col-12 col-md-5">
                            <div class="account-card p-4 d-flex flex-column justify-content-between h-100">
                                <div>
                                    <div class="d-flex align-items-center justify-content-between pb-2 mb-3" style="border-bottom: 1px solid var(--border-color);">
                                        <h6 class="fw-bold text-dark small m-0 d-flex align-items-center gap-2"><i class="fa-solid fa-location-dot text-brand-blue"></i> Primary Shipping Node</h6>
                                        <button onclick="switchTab('profile')" class="btn btn-link p-0 small text-brand-blue fw-semibold text-decoration-none">Modify</button>
                                    </div>
                                    <p class="text-dark fw-bold small mb-1">{{ $customer['name'] }}</p>
                                    <p class="small lh-base mb-0" style="color: var(--text-muted);">
                                        {{ $customer['address'] }}<br>
                                        {{ $customer['town'] }}, {{ $customer['county'] }} County<br>
                                        Kenya
                                    </p>
                                </div>
                                <div class="mt-4 pt-2 border-top small" style="border-top: 1px solid var(--border-color); color: var(--text-muted);">
                                    <i class="fa-solid fa-phone text-muted me-1"></i> Helpline: {{ $customer['phone'] }}
                                </div>
                            </div>
                        </div>

                        <!-- Right Subcard: Brief Recent Invoice Log -->
                        <div class="col-12 col-md-7">
                            <div class="account-card p-4 h-100">
                                <div class="d-flex align-items-center justify-content-between pb-2 mb-3" style="border-bottom: 1px solid var(--border-color);">
                                    <h6 class="fw-bold text-dark small m-0 d-flex align-items-center gap-2"><i class="fa-solid fa-clock text-muted"></i> Recent Activity</h6>
                                    <button onclick="switchTab('orders')" class="btn btn-link p-0 small text-brand-blue fw-semibold text-decoration-none">Ledger Ledger</button>
                                </div>

                                @if(empty($orders))
                                    <div class="text-center py-4 small" style="color: var(--text-muted);">
                                        <i class="fa-solid fa-folder-open fs-3 mb-2 d-block text-black-50 opacity-25"></i> Pipeline records empty.
                                    </div>
                                @else
                                    <div class="d-flex flex-column gap-2.5">
                                        @foreach($orders->sortByDesc('created_at')->take(3) as $order)
                                            <div class="d-flex align-items-center justify-content-between small pb-2 border-bottom border-light">
                                                <div>
                                                    <p class="fw-bold text-dark mb-0">{{ $order['order_number'] }}</p>
                                                    <p class="small text-muted mb-0" style="font-size: 0.75rem;">{{ $order['created_at'] }}</p>
                                                </div>
                                                <div class="text-end">
                                                    <p class="fw-bold text-dark mb-0">KES {{ number_format($order['total_order_amount']) }}</p>
                                                    <span class="badge rounded mt-0.5 style-badge fw-semibold" style="font-size: 0.7rem; {{ $order['status'] === 'Paid' ? 'background: #e6f7ed; color: #1f7842;' : 'background: #fff9db; color: #b25e00;' }}">
                                                        {{ $order['status'] }}
                                                    </span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================= PANEL 2: PURCHASE LOG ================= -->
                <div id="tab-panel-orders" class="tab-panel d-flex flex-column gap-3 d-none">
                    <div class="account-card p-4">
                        <h2 class="fw-bold h5 text-dark tracking-tight mb-1"><i class="fa-solid fa-receipt text-brand-blue me-2"></i>Order Procurement Ledger</h2>
                        <p class="small mb-0" style="color: var(--text-muted);">Review configuration parameters, check outstanding balances, and track packages line-by-line.</p>
                    </div>

                    @if(empty($orders))
                        <div class="account-card p-5 text-center">
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 border" style="width: 60px; height: 60px;">
                                <i class="fa-solid fa-boxes-packing fs-4 text-muted opacity-50"></i>
                            </div>
                            <h3 class="fw-bold text-dark h5">No historical records found</h3>
                            <p class="small mx-auto mb-4 text-muted" style="max-width: 350px;">Your purchase configuration log is empty. Visit the marketplace catalog to initialize active tracking pipelines.</p>
                            <a href="{{ route('shop') }}" class="btn bg-brand-blue text-white fw-medium small px-4 py-2 rounded-2 shadow-sm">
                                Explore Store Catalog
                            </a>
                        </div>
                    @else
                        @foreach($orders->sortByDesc('created_at') as $index => $order)
                            <div class="account-card overflow-hidden">
                                <!-- Box Header Meta Details Container -->
                                <div class="bg-light border-bottom px-4 py-3 d-flex flex-wrap align-items-center justify-content-between gap-3" style="border-color: var(--border-color);">
                                    <div class="d-flex align-items-center gap-4 small">
                                        <div>
                                            <p class="small mb-0 text-muted" style="font-size: 0.75rem;">Order Code</p>
                                            <p class="fw-bold text-dark tracking-wide mb-0 mt-0.5">{{ $order['order_number'] }}</p>
                                        </div>
                                        <div>
                                            <p class="small mb-0 text-muted" style="font-size: 0.75rem;">Placement Date</p>
                                            <p class="fw-medium text-secondary mb-0 mt-0.5">{{ $order['created_at'] }}</p>
                                        </div>
                                        <div class="d-none d-sm-block">
                                            <p class="small mb-0 text-muted" style="font-size: 0.75rem;">Payment Method</p>
                                            <p class="fw-medium text-secondary mb-0 mt-0.5">{{ $order['payment_method'] }}</p>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center gap-3">
                                        <span class="badge rounded small fw-bold px-2.5 py-1.5 
                                            {{ $order['status'] === 'Paid' ? 'bg-success bg-opacity-10 text-success' : 'bg-warning bg-opacity-10 text-warning-emphasis' }}">
                                            <i class="fa-solid {{ $order['status'] === 'Paid' ? 'fa-circle-check' : 'fa-truck-fast' }} me-1"></i>
                                            {{ $order['status'] }}
                                        </span>
                                        <button onclick="toggleItems('details-{{ $index }}')" class="btn btn-light bg-white border p-1.5 rounded-2 text-secondary small shadow-sm">
                                            <i class="fa-solid fa-chevron-down transition" id="icon-details-{{ $index }}" style="transition: transform 0.2s;"></i>
                                        </button>
                                        <button onclick="window.print()"
                                            class="btn btn-light border btn-sm rounded-2 small shadow-sm">
                                            <i class="fa-solid fa-print"></i>
                                        </button>
                                        <a href="#"
                                            class="btn btn-light border btn-sm rounded-2 small shadow-sm">
                                            <i class="fa-solid fa-file-pdf text-danger"></i>
                                        </a>
                                    </div>
                                </div>

                                <!-- Collapsible Context Line Items Breakdown -->
                                <div id="details-{{ $index }}" class="d-none">
                                    <div class="px-4 pt-4">

                                        @if($order['status'] === 'Paid')
                                            <div class="alert alert-success border-0 rounded-3 fw-bold small d-inline-flex align-items-center gap-2">
                                                <i class="fa-solid fa-circle-check"></i>
                                                PAYMENT VERIFIED
                                            </div>
                                        @else
                                            <div class="alert alert-warning border-0 rounded-3 fw-bold small d-inline-flex align-items-center gap-2">
                                                <i class="fa-solid fa-truck"></i>
                                                PAY AFTER DELIVERY
                                            </div>
                                        @endif

                                    </div>

                                    <div class="px-4 py-2 bg-white">
                                        @foreach($order['items'] as $item)
                                            <div class="py-3 d-flex align-items-center justify-content-between gap-3 small border-bottom-dashed">
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="rounded-2 object-fit-contain bg-light border p-1 flex-shrink-0" style="width: 44px; height: 44px;">
                                                    <div>
                                                        <h6 class="fw-bold text-dark mb-0 small lh-sm">{{ $item['name'] }}</h6>
                                                        <p class="small text-muted mb-0 mt-0.5" style="font-size: 0.75rem;">Qty: {{ $item['qty'] }} @ KES {{ number_format($item['price']) }}</p>
                                                    </div>
                                                </div>
                                                <div class="text-end fw-bold text-dark flex-shrink-0">
                                                    KES {{ number_format($item['price'] * $item['qty']) }}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Logistics/COD Balance Invoice Footer Breakdown -->
                                    <div class="bg-light bg-opacity-50 border-top px-4 py-3 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 small" style="border-color: var(--border-color);">
                                        <div class="d-flex flex-column gap-1" style="color: var(--text-muted); font-size: 0.8rem;">

                                            @if(isset($order['shipping_paid']))
                                                <p class="mb-0">
                                                    <i class="fa-solid fa-truck text-brand-blue me-1" style="width: 16px;"></i>
                                                    Logistics Booking Paid:
                                                    <span class="fw-bold text-dark">
                                                        KES {{ number_format($order['shipping_paid']) }}
                                                    </span>
                                                </p>
                                            @endif

                                            @if(isset($order['amount_due_on_delivery']))
                                                <p class="mb-0">
                                                    <i class="fa-solid fa-wallet text-success me-1" style="width: 16px;"></i>
                                                    Due On Delivery (COD):
                                                    <span class="fw-bold text-dark bg-warning bg-opacity-25 px-1.5 py-0.5 rounded">
                                                        KES {{ number_format($order['amount_due_on_delivery']) }}
                                                    </span>
                                                </p>
                                            @endif

                                            {{-- ADD IT HERE --}}
                                            @if(!empty($order['customer_note']))
                                                <p class="mb-0">
                                                    <i class="fa-solid fa-note-sticky text-brand-blue me-1"></i>
                                                    Delivery Note:
                                                    <span class="fw-semibold text-dark">
                                                        {{ $order['customer_note'] }}
                                                    </span>
                                                </p>
                                            @endif

                                        </div>
                                        <div class="text-sm-end">
                                            <span class="text-muted small" style="font-size: 0.75rem;">Total Value Paid</span>
                                            <p class="h6 fw-bold text-brand-navy mb-0 mt-0.5">KES {{ number_format($order['total_order_amount']) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <!-- ================= PANEL 3: SHIPPING COORDINATES (EDITABLE) ================= -->
                <div id="tab-panel-profile" class="tab-panel d-flex flex-column gap-4 d-none">
                    <div class="account-card p-4">
                        <form action="{{ route('customer.profile.update') }}" method="POST" id="profileUpdateForm">
                            @csrf
                            <div class="d-flex align-items-center justify-content-between pb-3 mb-4" style="border-bottom: 1px solid var(--border-color);">
                                <div>
                                    <h2 class="fw-bold h5 text-dark tracking-tight mb-1"><i class="fa-solid fa-id-card text-brand-blue me-1"></i> Interactive Delivery Coordinates</h2>
                                    <p class="small text-muted mb-0">Manage current contact parameters utilized during delivery assignments.</p>
                                </div>
                                <button type="button" id="toggleEditBtn" onclick="enableProfileEditing()" class="btn btn-outline-primary btn-sm px-3 rounded-2 fw-medium d-flex align-items-center gap-1.5">
                                    <i class="fa-solid fa-user-pen small"></i> <span>Edit Details</span>
                                </button>
                            </div>

                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <label class="d-block small fw-bold text-uppercase tracking-wider mb-1.5 text-muted" style="font-size: 0.75rem;">Customer First Name</label>
                                    <input type="text" name="first_name" class="form-control form-control-muted bg-light border rounded-2 small" value="{{ $customer['first_name'] }}" disabled required>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <label class="d-block small fw-bold text-uppercase tracking-wider mb-1.5 text-muted" style="font-size: 0.75rem;">Customer Last Name</label>
                                    <input type="text" name="last_name" class="form-control form-control-muted bg-light border rounded-2 small" value="{{ $customer['last_name'] }}" disabled required>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <label class="d-block small fw-bold text-uppercase tracking-wider mb-1.5 text-muted" style="font-size: 0.75rem;">Customer Email</label>
                                    <input type="email" name="email" class="form-control form-control-muted bg-light border rounded-2 small" value="{{ $customer['email'] }}" disabled required>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <label class="d-block small fw-bold text-uppercase tracking-wider mb-1.5 text-muted" style="font-size: 0.75rem;">Phone Contact</label>
                                    <input type="text" name="phone" class="form-control form-control-muted bg-light border rounded-2 small" value="{{ $customer['phone'] }}" disabled required>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <label class="d-block small fw-bold text-uppercase tracking-wider mb-1.5 text-muted" style="font-size: 0.75rem;">Street / Building Address</label>
                                    <input type="text" name="address" class="form-control form-control-muted bg-light border rounded-2 small" value="{{ $customer['address'] }}" disabled required>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <label class="d-block small fw-bold text-uppercase tracking-wider mb-1.5 text-muted" style="font-size: 0.75rem;">Town</label>
                                    <input type="text" name="town" class="form-control form-control-muted bg-light border rounded-2 small" value="{{ $customer['town'] }}" disabled required>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <label class="d-block small fw-bold text-uppercase tracking-wider mb-1.5 text-muted" style="font-size: 0.75rem;">County Region</label>
                                    <input type="text" name="county" class="form-control form-control-muted bg-light border rounded-2 small" value="{{ $customer['county'] }}" disabled required>
                                </div>

                                <!-- Billing Information -->
                                <div class="col-12 mt-2">
                                    <div class="bg-light rounded-3 p-3 border">
                                        <h6 class="fw-bold small text-dark mb-3">
                                            <i class="fa-solid fa-file-invoice me-1 text-brand-blue"></i>
                                            Shipping Information
                                        </h6>

                                        <div class="row g-3">

                                            <div class="col-md-6">
                                                <label class="small text-muted fw-bold mb-1">
                                                    Shipping Name
                                                </label>

                                                <input type="text" name="shipping_name"
                                                    class="form-control bg-light"
                                                    value="{{ $customer['shipping_name'] }}"
                                                    disabled>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="small text-muted fw-bold mb-1">
                                                    Shipping Phone
                                                </label>

                                                <input type="text" name="shipping_phone"
                                                    class="form-control bg-light"
                                                    value="{{ $customer['shipping_phone'] }}"
                                                    disabled>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="small text-muted fw-bold mb-1">
                                                    Shipping Email
                                                </label>

                                                <input type="email" name="shipping_email"
                                                    class="form-control bg-light"
                                                    value="{{ $customer['shipping_email'] }}"
                                                    disabled>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="small text-muted fw-bold mb-1">
                                                    Shipping Address
                                                </label>

                                                <input type="text" name="shipping_address"
                                                    class="form-control bg-light"
                                                    value="{{ $customer['shipping_address'] }}"
                                                    disabled>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="small text-muted fw-bold mb-1">
                                                    Shipping Town
                                                </label>

                                                <input type="text" name="shipping_town"
                                                    class="form-control bg-light"
                                                    value="{{ $customer['shipping_town'] }}"
                                                    disabled>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="small text-muted fw-bold mb-1">
                                                    Shipping County
                                                </label>

                                                @php
                                                    $counties = [
                                                        'baringo' => 'Baringo',
                                                        'bomet' => 'Bomet',
                                                        'bungoma' => 'Bungoma',
                                                        'busia' => 'Busia',
                                                        'elgeyo-marakwet' => 'Elgeyo Marakwet',
                                                        'embu' => 'Embu',
                                                        'garissa' => 'Garissa',
                                                        'homa-bay' => 'Homa Bay',
                                                        'isiolo' => 'Isiolo',
                                                        'kajiado' => 'Kajiado',
                                                        'kakamega' => 'Kakamega',
                                                        'kericho' => 'Kericho',
                                                        'kiambu' => 'Kiambu',
                                                        'kilifi' => 'Kilifi',
                                                        'kirinyaga' => 'Kirinyaga',
                                                        'kisii' => 'Kisii',
                                                        'kisumu' => 'Kisumu',
                                                        'kitui' => 'Kitui',
                                                        'kwale' => 'Kwale',
                                                        'laikipia' => 'Laikipia',
                                                        'lamu' => 'Lamu',
                                                        'machakos' => 'Machakos',
                                                        'makueni' => 'Makueni',
                                                        'mandera' => 'Mandera',
                                                        'marsabit' => 'Marsabit',
                                                        'meru' => 'Meru',
                                                        'migori' => 'Migori',
                                                        'mombasa' => 'Mombasa',
                                                        'muranga' => "Murang'a",
                                                        'nairobi' => 'Nairobi',
                                                        'nakuru' => 'Nakuru',
                                                        'nandi' => 'Nandi',
                                                        'narok' => 'Narok',
                                                        'nyamira' => 'Nyamira',
                                                        'nyandarua' => 'Nyandarua',
                                                        'nyeri' => 'Nyeri',
                                                        'samburu' => 'Samburu',
                                                        'siaya' => 'Siaya',
                                                        'taita-taveta' => 'Taita Taveta',
                                                        'tana-river' => 'Tana River',
                                                        'tharaka-nithi' => 'Tharaka-Nithi',
                                                        'trans-nzoia' => 'Trans Nzoia',
                                                        'turkana' => 'Turkana',
                                                        'uasin-gishu' => 'Uasin Gishu',
                                                        'vihiga' => 'Vihiga',
                                                        'wajir' => 'Wajir',
                                                        'west-pokot' => 'West Pokot',
                                                    ];
                                                @endphp

                                                <select name="shipping_county"
                                                    class="form-control bg-light"
                                                    disabled>

                                                    @foreach($counties as $value => $label)
                                                        <option value="{{ $value }}"
                                                            {{ $customer['shipping_county'] == $value ? 'selected' : '' }}>
                                                            {{ $label }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Submit Row -->
                            <div class="col-12 d-none mt-4 pt-3 text-end" id="formActionsRow" style="border-top: 1px dashed var(--border-color)">
                                <button type="button" onclick="cancelProfileEditing()" class="btn btn-light border btn-sm px-3 rounded-2 me-2 small text-dark">Cancel</button>
                                <button type="submit" class="btn bg-brand-green text-black btn-sm px-4 rounded-2 small shadow-sm">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- ================= PANEL 4: SECURITY ================= -->
                <div id="tab-panel-security" class="tab-panel d-flex flex-column gap-4 d-none">
                    <div class="account-card p-4">
                        <div class="d-flex align-items-center justify-content-between pb-3 mb-4"
                            style="border-bottom: 1px solid var(--border-color);">
                            <div>
                                <h2 class="fw-bold h5 text-dark tracking-tight mb-1">
                                    <i class="fa-solid fa-shield-halved text-brand-blue me-1"></i>
                                    Account Security
                                </h2>
                                <p class="small text-muted mb-0">
                                    Update your account password securely.
                                </p>
                            </div>
                        </div>
                        <form action="#" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="small fw-bold text-muted mb-1">
                                        Current Password
                                    </label>
                                    <input type="password"
                                        class="form-control rounded-2"
                                        placeholder="Enter current password">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="small fw-bold text-muted mb-1">
                                        New Password
                                    </label>
                                    <input type="password"
                                        class="form-control rounded-2"
                                        placeholder="Enter new password">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="small fw-bold text-muted mb-1">
                                        Confirm Password
                                    </label>
                                    <input type="password"
                                        class="form-control rounded-2"
                                        placeholder="Confirm new password">
                                </div>
                                <div class="col-12 text-end pt-2">
                                    <button type="submit"
                                            class="btn bg-brand-blue text-white px-4 rounded-2 shadow-sm">
                                        Update Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    /**
     * Handles switching display views and syncing CSS highlight classes across nav buttons
     */
    function switchTab(tabId) {
        document.querySelectorAll('.tab-panel').forEach(panel => panel.classList.add('d-none'));
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));

        document.getElementById(`tab-panel-${tabId}`).classList.remove('d-none');
        const activeBtn = document.getElementById(`tab-btn-${tabId}`);
        if(activeBtn) {
            activeBtn.classList.add('active');
        }
    }

    /**
     * Alternates collapsible panels containing transaction lines
     */
    function toggleItems(elementId) {
        const container = document.getElementById(elementId);
        const chevronIcon = document.getElementById(`icon-${elementId}`);
        
        if(container.classList.contains('d-none')) {
            container.classList.remove('d-none');
            chevronIcon.classList.add('rotate-180');
        } else {
            container.classList.add('d-none');
            chevronIcon.classList.remove('rotate-180');
        }
    }

    /**
     * Shifts viewport focus to tracking selector module
     */
    function focusTracker() {
        switchTab('overview');
        const inputField = document.getElementById('trackerInput');
        inputField.focus();
        inputField.classList.add('border-brand-blue');
        setTimeout(() => inputField.classList.remove('border-brand-blue'), 1500);
    }

    /**
     * Calculates pipeline tracking milestone metrics dynamically
     */
    function processTrackingAudit() {
        const selectEl = document.getElementById('trackerInput');
        const selectedOption = selectEl.options[selectEl.selectedIndex];
        const orderValue = selectEl.value;

        if (!orderValue) {
            alert('Please select or specify a valid procurement code string.');
            return;
        }

        const statusText = selectedOption.getAttribute('data-status') || 'Pending';
        
        // Update display labels
        document.getElementById('displayOrderNum').innerText = orderValue;
        document.getElementById('displayOrderStatus').innerText = statusText;

        // Reset visual tracker states
        const steps = ['step-placed', 'step-processing', 'step-shipped', 'step-delivered'];
        steps.forEach(id => {
            document.getElementById(id).classList.remove('active', 'completed');
        });

        // Evaluate milestone status layers
        if (statusText === 'Paid') {
            document.getElementById('step-placed').classList.add('completed');
            document.getElementById('step-processing').classList.add('completed');
            document.getElementById('step-shipped').classList.add('completed');
            document.getElementById('step-delivered').classList.add('active');
        } else if (statusText.includes('Delivery') || statusText.includes('Transit')) {
            document.getElementById('step-placed').classList.add('completed');
            document.getElementById('step-processing').classList.add('completed');
            document.getElementById('step-shipped').classList.add('active');
        } else {
            document.getElementById('step-placed').classList.add('completed');
            document.getElementById('step-processing').classList.add('active');
        }

        // Reveal view container
        document.getElementById('trackingTimelineContainer').classList.remove('d-none');
    }

    /**
     * Enables fields inside the customer delivery coordinates form
     */
    function enableProfileEditing() {
        const form = document.getElementById('profileUpdateForm');

        // include select + textarea too
        const fields = form.querySelectorAll('input, select, textarea');

        fields.forEach(field => {
            field.removeAttribute('disabled');
            field.classList.remove('bg-light');
            field.style.backgroundColor = '#ffffff';
        });

        document.getElementById('formActionsRow').classList.remove('d-none');

        const toggleBtn = document.getElementById('toggleEditBtn');
        toggleBtn.classList.add('d-none');
    }

    /**
     * Disables fields and resets form status layout
     */
    function cancelProfileEditing() {
        const form = document.getElementById('profileUpdateForm');

        const fields = form.querySelectorAll('input, select, textarea');

        fields.forEach(field => {
            field.setAttribute('disabled', 'disabled');
            field.classList.add('bg-light');
        });

        document.getElementById('formActionsRow').classList.add('d-none');

        const toggleBtn = document.getElementById('toggleEditBtn');
        toggleBtn.classList.remove('d-none');
    }
</script>
@endsection