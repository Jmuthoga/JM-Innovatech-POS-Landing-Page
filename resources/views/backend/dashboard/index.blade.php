@extends('backend.layouts.admin')

@section('title', 'JPOS Systems Enterprise Dashboard')

@section('content')
<style>
    :root {
        --jpos-blue-dark: #0f172a;
        --jpos-blue: #1e3a8a;
        --jpos-blue-light: #3b82f6;
        --jpos-blue-accent: #60a5fa;
        --jpos-green: #10b981;
        --jpos-amber: #f59e0b;
        --jpos-rose: #f43f5e;
        --jpos-slate-50: #f8fafc;
        --jpos-slate-100: #f1f5f9;
        --jpos-slate-200: #e2e8f0;
        --jpos-slate-400: #94a3b8;
        --jpos-slate-700: #334155;
        --jpos-slate-900: #0f172a;
        --sidebar-width: var(--sidebar-width, 260px);
        --transition-speed: 0.25s;
    }

    #main-wrapper {
        margin-left: var(--sidebar-width);
        transition: margin-left var(--transition-speed) cubic-bezier(0.4, 0, 0.2, 1);
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        background-color: #f1f5f9;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }

    body.sidebar-collapsed #main-wrapper {
        margin-left: var(--sidebar-collapsed-width, 70px);
    }

    .main-content {
        margin-top: var(--navbar-height, 20px);
        padding: 2rem 2.5rem;
        flex-grow: 1;
    }

    .admin-card {
        background: #ffffff;
        border: 1px solid var(--jpos-slate-200);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        border-radius: 12px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        position: relative;
        overflow: hidden;
    }

    .admin-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.04);
    }

    .gradient-card-blue {
        background: linear-gradient(135deg, #1e3a8a 0%, #0f172a 100%);
        color: #ffffff;
    }

    .gradient-card-green {
        background: linear-gradient(135deg, #059669 0%, #064e3b 100%);
        color: #ffffff;
    }

    .icon-box {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .trend-indicator {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.25rem 0.5rem;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        gap: 2px;
    }

    .trend-up { background-color: rgba(16, 185, 129, 0.15); color: #10b981; }
    .trend-down { background-color: rgba(244, 63, 94, 0.15); color: #f43f5e; }

    .table-modern thead th {
        background-color: var(--jpos-slate-50);
        color: var(--jpos-slate-700);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        padding: 1rem;
        border-bottom: 2px solid var(--jpos-slate-200);
    }

    .table-modern tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid var(--jpos-slate-100);
        color: var(--jpos-slate-900);
    }

    .status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
    }
    
    .status-dot-live {
        background-color: var(--jpos-green);
        box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
        animation: pulse-green 2s infinite;
    }

    @keyframes pulse-green {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.5); }
        70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
    }

    .progress-bar-sm {
        height: 6px;
        border-radius: 3px;
    }

    .avatar-circle {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: var(--jpos-slate-200);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: var(--jpos-slate-700);
        font-size: 0.85rem;
    }

    .timeline-widget {
        position: relative;
        padding-left: 20px;
    }
    .timeline-widget::before {
        content: '';
        position: absolute;
        left: 5px;
        top: 5px;
        bottom: 5px;
        width: 2px;
        background-color: var(--jpos-slate-200);
    }
    .timeline-item {
        position: relative;
        padding-bottom: 1.25rem;
    }
    .timeline-item::before {
        content: '';
        position: absolute;
        left: -19px;
        top: 4px;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: var(--jpos-blue);
        border: 2px solid #fff;
    }
    .timeline-item.success::before { background-color: var(--jpos-green); }
    .timeline-item.warning::before { background-color: var(--jpos-amber); }
    .timeline-item.danger::before { background-color: var(--jpos-rose); }

    .quick-action-btn {
        transition: all 0.2s;
        border: 1px solid var(--jpos-slate-200);
    }
    .quick-action-btn:hover {
        background-color: var(--jpos-blue);
        color: #fff !important;
        border-color: var(--jpos-blue);
    }

    @media (max-width: 991.98px) {
        #main-wrapper { margin-left: 0 !important; }
        .main-content { padding: 1.25rem; }
    }
</style>

<div id="main-wrapper">
    <main class="main-content">
        <div class="container-fluid p-0">

            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                <div>
                    <h1 class="h3 fw-bold text-dark mb-1">Overview Dashboard</h1>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button class="btn btn-sm btn-white bg-white border shadow-sm px-3 dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="bi bi-calendar3 me-2"></i> This Month
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Today</a></li>
                        <li><a class="dropdown-item" href="#">Last 7 Days</a></li>
                        <li><a class="dropdown-item" href="#">This Month</a></li>
                        <li><a class="dropdown-item" href="#">Financial Year</a></li>
                    </ul>
                    <button class="btn btn-sm btn-primary shadow-sm px-3" onclick="window.print()">
                        <i class="bi bi-printer me-2"></i> Report
                    </button>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card admin-card p-4 border-start border-4" style="border-color: var(--jpos-blue) !important;">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h6 class="text-muted text-uppercase mb-1 small fw-bold" style="letter-spacing: 0.5px;">Gross Revenue</h6>
                                <h3 class="mb-0 fw-bold text-dark" id="gross-sales-val">KES {{ number_format($grossSales ?? 489200) }}</h3>
                            </div>
                            <div class="icon-box bg-primary-subtle text-primary">
                                <i class="bi bi-currency-exchange"></i>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-3 pt-2 border-top">
                            <span class="trend-indicator trend-up"><i class="bi bi-arrow-up"></i> +14.8%</span>
                            <span class="text-muted small">vs last month</span>
                        </div>
                        <div class="mt-2">
                            <div class="progress progress-bar-sm">
                                <div class="progress-bar bg-primary" style="width: 82%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card admin-card p-4 border-start border-4" style="border-color: var(--jpos-green) !important;">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h6 class="text-muted text-uppercase mb-1 small fw-bold" style="letter-spacing: 0.5px;">Settled Orders</h6>
                                <h3 class="mb-0 fw-bold text-dark">{{ number_format($settledOrders ?? 1842) }}</h3>
                            </div>
                            <div class="icon-box bg-success-subtle text-success">
                                <i class="bi bi-bag-check-fill"></i>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-3 pt-2 border-top">
                            <span class="trend-indicator trend-up"><i class="bi bi-arrow-up"></i> +6.2%</span>
                            <span class="text-muted small">Abandonment: 4.2%</span>
                        </div>
                        <div class="mt-2">
                            <div class="progress progress-bar-sm">
                                <div class="progress-bar bg-success" style="width: 91%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card admin-card p-4 border-start border-4" style="border-color: var(--jpos-amber) !important;">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h6 class="text-muted text-uppercase mb-1 small fw-bold" style="letter-spacing: 0.5px;">Avg Basket Value</h6>
                                <h3 class="mb-0 fw-bold text-dark">KES {{ number_format($avgBasket ?? 4850) }}</h3>
                            </div>
                            <div class="icon-box bg-warning-subtle text-warning">
                                <i class="bi bi-cart-dash-fill"></i>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-3 pt-2 border-top">
                            <span class="trend-indicator trend-down"><i class="bi bi-arrow-down"></i> -1.8%</span>
                            <span class="text-muted small">vs last week</span>
                        </div>
                        <div class="mt-2">
                            <div class="progress progress-bar-sm">
                                <div class="progress-bar bg-warning" style="width: 68%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card admin-card p-4 border-start border-4" style="border-color: var(--jpos-rose) !important;">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h6 class="text-muted text-uppercase mb-1 small fw-bold" style="letter-spacing: 0.5px;">New Customers</h6>
                                <h3 class="mb-0 fw-bold text-dark">{{ number_format($newCustomers ?? 668) }}</h3>
                            </div>
                            <div class="icon-box bg-danger-subtle text-danger">
                                <i class="bi bi-people-fill"></i>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-3 pt-2 border-top">
                            <span class="trend-indicator trend-up"><i class="bi bi-arrow-up"></i> +12.4%</span>
                            <span class="text-muted small">Conversion: 3.8%</span>
                        </div>
                        <div class="mt-2">
                            <div class="progress progress-bar-sm">
                                <div class="progress-bar bg-danger" style="width: 76%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-12 col-xl-8">
                    <div class="card admin-card p-4 h-100">
                        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                            <div>
                                <h5 class="fw-bold text-dark mb-0">Financial Velocity & Revenue Streams</h5>
                                <span class="text-muted small">Aggregated billing operations metrics parsed down to distinct temporal points.</span>
                            </div>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-secondary active" id="btn-chart-rev">Revenue</button>
                                <button class="btn btn-outline-secondary" id="btn-chart-ord">Volume</button>
                            </div>
                        </div>
                        <div style="position: relative; height: 320px; width: 100%;">
                            <canvas id="jposFinanceChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-4">
                    <div class="card admin-card p-4 h-100">
                        <div class="mb-3">
                            <h5 class="fw-bold text-dark mb-0">Payment Clearings</h5>
                            <span class="text-muted small">Channel allocation percentages.</span>
                        </div>
                        <div style="position: relative; height: 200px; width: 100%;" class="mb-3">
                            <canvas id="jposPaymentChart"></canvas>
                        </div>
                        <div class="d-flex flex-column gap-2 mt-2">
                            <div class="d-flex justify-content-between align-items-center small border-bottom pb-1">
                                <span><i class="bi bi-phone text-success me-2"></i>MPESA Paybill (C2B)</span>
                                <span class="fw-bold text-dark">74.2%</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center small border-bottom pb-1">
                                <span><i class="bi bi-credit-card text-primary me-2"></i>Visa/Mastercard</span>
                                <span class="fw-bold text-dark">18.5%</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center small">
                                <span><i class="bi bi-bank text-info me-2"></i>Bank EFT / Pesalink</span>
                                <span class="fw-bold text-dark">7.3%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-12 col-xl-9">
                    <div class="card admin-card p-0">
                        <div class="p-4 d-flex justify-content-between align-items-center flex-wrap gap-3 border-bottom">
                            <div>
                                <h5 class="fw-bold text-dark mb-0">Transactional Ledger Master</h5>
                                <p class="text-muted small mb-0">Verified programmatic purchases capturing system parameters and client tokens.</p>
                            </div>
                            <div class="d-flex gap-2">
                                <select class="form-select form-select-sm border shadow-sm">
                                    <option>All Pipelines</option>
                                    <option>Settled</option>
                                    <option>Awaiting Validation</option>
                                    <option>Failed</option>
                                </select>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-modern table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Tracking ID</th>
                                        <th>Client Profile</th>
                                        <th>Channel / Gateway</th>
                                        <th>Status</th>
                                        <th>Valuation</th>
                                        <th class="text-end">Execution</th>
                                    </tr>
                                </thead>
                                <tbody class="small">
                                    @if(isset($orders) && count($orders) > 0)
                                        @foreach($orders as $order)
                                        <tr>
                                            <td class="fw-bold text-primary">#{{ $order->reference_id }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="avatar-circle">{{ strtoupper(substr($order->customer_name, 0, 2)) }}</div>
                                                    <div>
                                                        <div class="fw-bold text-dark">{{ $order->customer_name }}</div>
                                                        <span class="text-muted style-text" style="font-size:0.75rem;">{{ $order->customer_email }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $order->payment_method }}</td>
                                            <td>
                                                <span class="badge {{ $order->status == 'completed' ? 'bg-success-subtle text-success' : 'bg-warning-subtle text-warning' }} px-2 py-1 rounded">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td class="fw-bold">KES {{ number_format($order->total_amount) }}</td>
                                            <td class="text-end">
                                                <button class="btn btn-sm btn-light border" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i></button>
                                                <ul class="dropdown-menu dropdown-menu-end small">
                                                    <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>Inspect Logs</a></li>
                                                    <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-slash-circle me-2"></i>Abort</a></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="fw-bold text-dark">#TXN-9482A</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="avatar-circle">EK</div>
                                                    <div>
                                                        <div class="fw-bold text-dark">Emmanuel Kipchumba</div>
                                                        <span class="text-muted" style="font-size:0.75rem;">kip@jpos-enterprise.co.ke</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><div>M-Pesa Express</div><span class="text-muted uppercase" style="font-size:0.7rem;">REF: QGR81HD94K</span></td>
                                            <td><span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 rounded-2 fw-semibold">Settled</span></td>
                                            <td class="fw-bold">KES 142,500</td>
                                            <td class="text-end">
                                                <button class="btn btn-sm btn-light border-0" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i></button>
                                                <ul class="dropdown-menu dropdown-menu-end small">
                                                    <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>Inspect Logs</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="bi bi-receipt me-2"></i>Print Ledger</a></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold text-dark">#TXN-9481B</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="avatar-circle bg-primary-subtle text-primary">AN</div>
                                                    <div>
                                                        <div class="fw-bold text-dark">Agnes Nekesa</div>
                                                        <span class="text-muted" style="font-size:0.75rem;">nekesa@hub.ke</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><div>Visa Direct Gateway</div><span class="text-muted uppercase" style="font-size:0.7rem;">STANBIC SECURE ACQ</span></td>
                                            <td><span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-1 rounded-2 fw-semibold">Validating</span></td>
                                            <td class="fw-bold">KES 8,450</td>
                                            <td class="text-end">
                                                <button class="btn btn-sm btn-light border-0" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i></button>
                                                <ul class="dropdown-menu dropdown-menu-end small">
                                                    <li><a class="dropdown-item" href="#"><i class="bi bi-shield-check me-2"></i>Force Approve</a></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold text-dark">#TXN-9480C</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="avatar-circle">OW</div>
                                                    <div>
                                                        <div class="fw-bold text-dark">Otieno Wafula</div>
                                                        <span class="text-muted" style="font-size:0.75rem;">otieno.w@domain.com</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><div>M-Pesa Paybill</div><span class="text-muted uppercase" style="font-size:0.7rem;">REF: QGT02JD81L</span></td>
                                            <td><span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 rounded-2 fw-semibold">Settled</span></td>
                                            <td class="fw-bold">KES 22,900</td>
                                            <td class="text-end">
                                                <button class="btn btn-sm btn-light border-0" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold text-dark">#TXN-9479D</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="avatar-circle bg-danger-subtle text-danger">JM</div>
                                                    <div>
                                                        <div class="fw-bold text-dark">Jane Mwangi</div>
                                                        <span class="text-muted" style="font-size:0.75rem;">jmwangi@retail.co.ke</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><div>Mastercard Online</div><span class="text-muted uppercase" style="font-size:0.7rem;">AUTH TIMEOUT ERR</span></td>
                                            <td><span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1 rounded-2 fw-semibold">Failed</span></td>
                                            <td class="fw-bold">KES 46,100</td>
                                            <td class="text-end">
                                                <button class="btn btn-sm btn-light border-0" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i></button>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="p-4 d-flex justify-content-between align-items-center flex-wrap border-top gap-2">
                            <span class="small text-muted">Iterating lines <strong>1-4</strong> out of 1,280 verified logs.</span>
                            <nav>
                                <ul class="pagination pagination-sm mb-0">
                                    <li class="page-item disabled"><a class="page-link" href="#">Prev</a></li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-3">
                    <div class="card admin-card p-4 mb-4">
                        <h6 class="fw-bold text-dark mb-3">Quick Control Terminal</h6>
                        <div class="row g-2">
                            <div class="col-6">
                                <a href="#" class="btn btn-light quick-action-btn w-100 py-3 text-center d-flex flex-column align-items-center gap-1 rounded-3">
                                    <i class="bi bi-box-seam text-primary fs-4"></i>
                                    <span class="small font-weight-bold" style="font-size:0.7rem;">+ Product</span>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="#" class="btn btn-light quick-action-btn w-100 py-3 text-center d-flex flex-column align-items-center gap-1 rounded-3">
                                    <i class="bi bi-percent text-success fs-4"></i>
                                    <span class="small font-weight-bold" style="font-size:0.7rem;">+ Discount</span>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="#" class="btn btn-light quick-action-btn w-100 py-3 text-center d-flex flex-column align-items-center gap-1 rounded-3">
                                    <i class="bi bi-people text-info fs-4"></i>
                                    <span class="small font-weight-bold" style="font-size:0.7rem;">Customers</span>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="#" class="btn btn-light quick-action-btn w-100 py-3 text-center d-flex flex-column align-items-center gap-1 rounded-3">
                                    <i class="bi bi-sliders text-warning fs-4"></i>
                                    <span class="small font-weight-bold" style="font-size:0.7rem;">Settings</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card admin-card p-4 mb-4">
                        <h6 class="fw-bold text-dark mb-3 d-flex justify-content-between align-items-center">
                            <span>Warehouse Exceptions</span>
                            <span class="badge bg-danger rounded-pill px-2 py-1" style="font-size:0.65rem;">3 Alert Lines</span>
                        </h6>
                        <div class="d-flex flex-column gap-3">
                            <div class="p-2 bg-light rounded d-flex align-items-start gap-2 border-start border-3 border-danger">
                                <i class="bi bi-exclamation-triangle text-danger mt-1"></i>
                                <div>
                                    <div class="small fw-bold text-dark">Nairobi Hub Out of Stock</div>
                                    <span class="text-muted d-block" style="font-size: 0.7rem;">JPOS Wireless Powerbank Pro < 5 units.</span>
                                </div>
                            </div>
                            <div class="p-2 bg-light rounded d-flex align-items-start gap-2 border-start border-3 border-warning">
                                <i class="bi bi-truck text-warning mt-1"></i>
                                <div>
                                    <div class="small fw-bold text-dark">Mombasa Transit Hold</div>
                                    <span class="text-muted d-block" style="font-size: 0.7rem;">Batch #MSA-984 awaiting customs authorization.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-12 col-xl-6">
                    <div class="card admin-card p-4">
                        <h5 class="fw-bold text-dark mb-3">Top Selling Production Line</h5>
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <thead>
                                    <tr class="text-muted small border-bottom">
                                        <th>Product Name</th>
                                        <th>Category</th>
                                        <th>Units Sold</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody class="small">
                                    <tr>
                                        <td class="fw-bold text-dark">JPOS POS Terminal V2</td>
                                        <td>Hardware</td>
                                        <td>842 Pcs</td>
                                        <td><span class="badge bg-success text-white px-2 py-1 rounded">In Stock</span></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-dark">Smart Scan Barcode Reader</td>
                                        <td>Accessories</td>
                                        <td>612 Pcs</td>
                                        <td><span class="badge bg-success text-white px-2 py-1 rounded">In Stock</span></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-dark">Thermal Receipt Paper Roll</td>
                                        <td>Consumables</td>
                                        <td>450 Pcs</td>
                                        <td><span class="badge bg-warning text-dark px-2 py-1 rounded">Low Stock</span></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-dark">Enterprise Ledger Subscription</td>
                                        <td>Software</td>
                                        <td>389 Lic</td>
                                        <td><span class="badge bg-success text-white px-2 py-1 rounded">Digital</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-6">
                    <div class="card admin-card p-4">
                        <h5 class="fw-bold text-dark mb-3">System Execution Audit Timeline</h5>
                        <div class="timeline-widget">
                            <div class="timeline-item success">
                                <span class="text-muted d-block small" style="font-size:0.7rem;">12:34 PM</span>
                                <span class="fw-bold text-dark d-block small">MPESA Callback Dispatched</span>
                                <span class="text-muted d-block" style="font-size:0.75rem;">Payment registration handshake completed successfully for TXN-9482A.</span>
                            </div>
                            <div class="timeline-item warning">
                                <span class="text-muted d-block small" style="font-size:0.7rem;">11:20 AM</span>
                                <span class="fw-bold text-dark d-block small">Inventory Fallback Alert Triggered</span>
                                <span class="text-muted d-block" style="font-size:0.75rem;">Consumables item metrics passed minimum baseline tolerance thresholds.</span>
                            </div>
                            <div class="timeline-item danger">
                                <span class="text-muted d-block small" style="font-size:0.7rem;">09:15 AM</span>
                                <span class="fw-bold text-dark d-block small">Gateway Handshake Failover</span>
                                <span class="text-muted d-block" style="font-size:0.75rem;">Stanbic primary node route failed. Diverted load to backup fallback lines.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // TIME SERIES REVENUE/VOLUME CHART
        const ctxFinance = document.getElementById('jposFinanceChart').getContext('2d');
        let financeChart = new Chart(ctxFinance, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Gross Revenue (KES)',
                    data: [1800000, 2200000, 2100000, 2900000, 3400000, 4892400, 4200000, 4600000, 5100000, 4900000, 5500000, 6200000],
                    borderColor: '#1e3a8a',
                    backgroundColor: 'rgba(30, 58, 138, 0.05)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.3,
                    pointRadius: 4,
                    pointBackgroundColor: '#1e3a8a'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { grid: { color: '#f1f5f9' }, ticks: { color: '#94a3b8', font: { size: 11 } } },
                    x: { grid: { display: false }, ticks: { color: '#94a3b8', font: { size: 11 } } }
                }
            }
        });

        // PAYMENT CHANNEL RATIO PIE CHART
        const ctxPayment = document.getElementById('jposPaymentChart').getContext('2d');
        new Chart(ctxPayment, {
            type: 'doughnut',
            data: {
                labels: ['MPESA', 'Card', 'Bank EFT'],
                datasets: [{
                    data: [74.2, 18.5, 7.3],
                    backgroundColor: ['#10b981', '#1e3a8a', '#0dcaf0'],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                cutout: '75%'
            }
        });

        // INTERACTIVE DATA OVERLAYS CONTROLS
        document.getElementById('btn-chart-rev').addEventListener('click', function() {
            this.classList.add('active');
            document.getElementById('btn-chart-ord').classList.remove('active');
            financeChart.data.datasets[0].label = 'Gross Revenue (KES)';
            financeChart.data.datasets[0].data = [1800000, 2200000, 2100000, 2900000, 3400000, 4892400, 4200000, 4600000, 5100000, 4900000, 5500000, 6200000];
            financeChart.update();
        });

        document.getElementById('btn-chart-ord').addEventListener('click', function() {
            this.classList.add('active');
            document.getElementById('btn-chart-rev').classList.remove('active');
            financeChart.data.datasets[0].label = 'Settled Orders';
            financeChart.data.datasets[0].data = [450, 520, 490, 700, 810, 1842, 1100, 1250, 1400, 1310, 1620, 1950];
            financeChart.update();
        });

        // REALTIME SYSTEM SIMULATION HANDLERS
        setInterval(() => {
            const load = Math.floor(Math.random() * (35 - 15 + 1)) + 15;
            document.getElementById('cpu-load').innerText = load + '%';
        }, 3000);
    });
</script>
@endsection