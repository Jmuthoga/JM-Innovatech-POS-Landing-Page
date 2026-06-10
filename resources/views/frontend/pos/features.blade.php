@extends('frontend.layouts.app')

@section('content')

<section class="jmi-posmodule-hero-block">
    <div class="container">
        <div class="row align-items-center g-4 g-lg-5">
            <div class="col-12 col-lg-7 text-center text-lg-start">
                <span class="badge bg-white text-brand-blue border px-3 py-2 rounded-pill fw-bold mb-3 shadow-sm d-inline-block text-wrap max-width-100">
                    Simple Shop Management • Safe Data Storage • Accurate Receipts
                </span>
                
                <h1 class="jmi-posmodule-main-title mb-3">
                    Easy Point of Sale System Built For Your Business
                </h1>
                
                <p class="text-muted fs-5 mb-4 mx-auto mx-lg-0" style="max-width: 600px;">
                    Keep track of your daily sales, manage your stock levels, receive mobile payments automatically, and stop stock loss. Simple to learn and works perfectly for any shop in Kenya.
                </p>

                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center justify-content-lg-start px-3 px-sm-0">
                    <a href="https://pos.jminnovatechsolution.co.ke" target="_blank" rel="noopener" class="jmi-posmodule-btn-sandbox shadow-sm">
                        <i class="fas fa-desktop me-2"></i> Open Live POS Demo
                    </a>
                    <a href="#jmi-setup-portal" class="jmi-posmodule-btn-primary shadow-sm">
                        Talk To Our Team <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>

                <div class="row mt-4 mt-lg-5 g-3 justify-content-center justify-content-lg-start text-muted small">
                    <div class="col-auto d-flex align-items-center gap-2">
                        <i class="fas fa-check-circle text-success"></i> <span>M-Pesa Connected</span>
                    </div>
                    <div class="col-auto d-flex align-items-center gap-2">
                        <i class="fas fa-check-circle text-success"></i> <span>Web Based</span>
                    </div>
                    <div class="col-auto d-flex align-items-center gap-2">
                        <i class="fas fa-check-circle text-success"></i> <span>eTIMS Ready</span>
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-lg-5 d-flex justify-content-center justify-content-lg-end">
                <div class="p-2 bg-white rounded-4 shadow-md border w-100">
                    <img src="{{ asset('assets/images/retailpos.jpg') }}" 
                        alt="POS System Terminal Layout View" 
                        class="img-fluid rounded-3 w-100">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light border-top border-bottom">
    <div class="container">
        
        <div class="text-center mb-5 px-2">
            <h2 class="fw-bold text-brand-navy">Custom Built For Different Industries</h2>
            <p class="text-muted mx-auto mb-0" style="max-width: 600px;">
                Explore our system profiles optimized for specific setups.
            </p>
        </div>

        <div class="row g-4 justify-content-center row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-5 mb-5" id="jmi-matrix-shelf">

            @foreach($businesses as $index => $business)

            <div class="col jmi-business-wrapper">
                <div class="jmi-business-card shadow-sm">

                    <div class="jmi-card-img-wrapper">
                        <img src="{{ $business->image }}" class="jmi-card-img" alt="{{ $business->name }}">
                    </div>

                    <div class="jmi-card-body">

                        <h6 class="jmi-card-title text-truncate">
                            {{ $index + 1 }}. {{ $business->name }}
                        </h6>

                        <p class="text-muted small flex-grow-1 mb-3">
                            {{ $business->description }}
                        </p>

                        <div class="mb-2">
                            @foreach($business->features as $feature)
                                <div class="jmi-feature-row">
                                    <i class="fas fa-check text-success"></i>
                                    <span>{{ $feature }}</span>
                                </div>
                            @endforeach
                        </div>

                        <a href="#jmi-setup-portal" class="jmi-card-action-link">
                            Setup Features <i class="fas fa-angle-right ms-2"></i>
                        </a>

                    </div>
                </div>
            </div>

            @endforeach

        </div>

        <div class="jmi-pagination-container shadow-sm mx-1 d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
            
            <div class="text-center text-md-start">
                <p class="mb-0 text-muted small">
                    Showing 
                    <span class="fw-bold text-dark">
                        {{ $businesses->firstItem() ?? 0 }}
                    </span>
                    to 
                    <span class="fw-bold text-dark">
                        {{ $businesses->lastItem() ?? 0 }}
                    </span>
                    of 
                    <span class="fw-bold text-dark">
                        {{ $businesses->total() }}
                    </span>
                    enterprise profiles
                </p>
            </div>

            <div class="text-center text-md-end jmi-pagination-wrapper">
                {{ $businesses->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>

        </div>

    </div>
</section>

<section class="py-5 bg-white">
    <div class="container py-3">
        <div class="text-center mb-5 px-2">
            <h2 class="fw-bold text-brand-navy">Compare System Versions</h2>
            <p class="text-muted mx-auto mb-0" style="max-width: 500px;">Pick the right system capacity for your current business scale.</p>
        </div>

        <div class="table-responsive rounded-3 border mx-2 mx-md-0">
            <table class="table mb-0 text-start alignment-middle">
                <thead>
                    <tr>
                        <th class="jmi-posmodule-matrix-th">Core System Features</th>
                        <th class="jmi-posmodule-matrix-th text-center">Basic Plan</th>
                        <th class="jmi-posmodule-matrix-th text-center">Business Pro</th>
                        <th class="jmi-posmodule-matrix-th text-center">Multi-Store Enterprise</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="jmi-posmodule-matrix-td fw-bold text-wrap" style="min-width: 220px;">M-Pesa STK Push Integration</td>
                        <td class="jmi-posmodule-matrix-td text-center text-success"><i class="fas fa-circle-check fs-5"></i></td>
                        <td class="jmi-posmodule-matrix-td text-center text-success"><i class="fas fa-circle-check fs-5"></i></td>
                        <td class="jmi-posmodule-matrix-td text-center text-success"><i class="fas fa-circle-check fs-5"></i></td>
                    </tr>
                    <tr>
                        <td class="jmi-posmodule-matrix-td fw-bold text-wrap">Automatic SMS Receipt Notification</td>
                        <td class="jmi-posmodule-matrix-td text-center text-success"><i class="fas fa-circle-check fs-5"></i></td>
                        <td class="jmi-posmodule-matrix-td text-center text-success"><i class="fas fa-circle-check fs-5"></i></td>
                        <td class="jmi-posmodule-matrix-td text-center text-success"><i class="fas fa-circle-check fs-5"></i></td>
                    </tr>
                    <tr>
                        <td class="jmi-posmodule-matrix-td fw-bold text-wrap">Offline Mode (Works with No Internet)</td>
                        <td class="jmi-posmodule-matrix-td text-center text-success"><i class="fas fa-circle-check fs-5"></i></td>
                        <td class="jmi-posmodule-matrix-td text-center text-success"><i class="fas fa-circle-check fs-5"></i></td>
                        <td class="jmi-posmodule-matrix-td text-center text-success"><i class="fas fa-circle-check fs-5"></i></td>
                    </tr>
                    <tr>
                        <td class="jmi-posmodule-matrix-td fw-bold text-wrap">Custom Barcode Label Generator Design</td>
                        <td class="jmi-posmodule-matrix-td text-center text-success"><i class="fas fa-circle-check fs-5"></i></td>
                        <td class="jmi-posmodule-matrix-td text-center text-success"><i class="fas fa-circle-check fs-5"></i></td>
                        <td class="jmi-posmodule-matrix-td text-center text-success"><i class="fas fa-circle-check fs-5"></i></td>
                    </tr>
                    <tr>
                        <td class="jmi-posmodule-matrix-td fw-bold text-wrap">Daily Automatic Email Closing Reports</td>
                        <td class="jmi-posmodule-matrix-td text-center text-muted"><i class="fas fa-circle-minus fs-5 opacity-50"></i></td>
                        <td class="jmi-posmodule-matrix-td text-center text-success"><i class="fas fa-circle-check fs-5"></i></td>
                        <td class="jmi-posmodule-matrix-td text-center text-success"><i class="fas fa-circle-check fs-5"></i></td>
                    </tr>
                    <tr>
                        <td class="jmi-posmodule-matrix-td fw-bold text-wrap">KRA eTIMS Tax Compliant Logs</td>
                        <td class="jmi-posmodule-matrix-td text-center text-muted"><i class="fas fa-circle-minus fs-5 opacity-50"></i></td>
                        <td class="jmi-posmodule-matrix-td text-center text-success"><i class="fas fa-circle-check fs-5"></i></td>
                        <td class="jmi-posmodule-matrix-td text-center text-success"><i class="fas fa-circle-check fs-5"></i></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

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
                            style="padding: 0.6rem 0.75rem;"
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted mb-1">Business Sector</label>
                        <select 
                            name="sector" 
                            class="form-select rounded-3" 
                            required
                            style="padding: 0.6rem 0.75rem;"
                        >
                            <option value="">What do you sell?...</option>

                            @foreach($allSectors as $sector)
                                <option value="{{ $sector->name }}">
                                    {{ $sector->name }}
                                </option>
                            @endforeach

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
                            style="padding: 0.6rem 0.75rem;"
                        >
                    </div>

                    <button type="submit" class="jmi-posmodule-btn-primary w-100 border-0 py-2 rounded-3">
                        Request My Setup Quote <i class="fas fa-calendar-check ms-2"></i>
                    </button>
                </form>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.pagination a').forEach(link => {
        link.addEventListener('click', function () {
            setTimeout(() => {
                document.getElementById('jmi-matrix-shelf')
                    ?.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 200);
        });
    });
});
</script>
@endsection