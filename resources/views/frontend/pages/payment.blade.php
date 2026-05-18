@extends('frontend.layouts.app')

@section('content')
<!-- Custom Isolated Checkout Styles -->
<style>
    :root {
        --checkout-primary: #0056b3;
        --checkout-primary-hover: #004085;
        --checkout-success: #198754;
        --checkout-dark: #212529;
        --checkout-muted: #6c757d;
        --checkout-border: #e2e8f0;
        --checkout-bg-light: #f8f9fa;
        --checkout-bg-active: #fafdff;
    }

    .payment-page-wrapper {
        font-family: system-ui, -apple-system, sans-serif;
    }

    /* Card Containers */
    .payment-page-wrapper .cart-card {
        background: #ffffff;
        border: 1px solid var(--checkout-border);
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
    }

    .payment-page-wrapper .secure-badge {
        background-color: #ffffff;
        border: 1px solid var(--checkout-border);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
    }

    .payment-page-wrapper .section-title {
        color: var(--checkout-dark);
        font-weight: 700;
        letter-spacing: -0.01em;
    }

    /* Custom Radio Option Cards */
    .payment-page-wrapper .payment-method-card {
        background: #ffffff;
        border: 1px solid var(--checkout-border);
        border-radius: 8px;
        transition: all 0.2s ease-in-out;
        cursor: pointer;
    }

    .payment-page-wrapper .payment-method-card:hover {
        border-color: var(--checkout-primary);
    }

    /* Selected Active State Trigger */
    .payment-page-wrapper .payment-method-card.option-active {
        border-color: var(--checkout-primary);
        background-color: var(--checkout-bg-active);
        box-shadow: 0 4px 12px rgba(0, 86, 179, 0.04);
    }

    /* Custom Dynamic Radio Indicator UI */
    .payment-page-wrapper .custom-radio-indicator {
        width: 20px;
        height: 20px;
        border: 2px solid #cbd5e1;
        border-radius: 50%;
        position: relative;
        transition: all 0.2s ease;
        background: #ffffff;
    }

    .payment-page-wrapper .payment-method-card.option-active .custom-radio-indicator {
        border-color: var(--checkout-primary);
    }

    .payment-page-wrapper .payment-method-card.option-active .custom-radio-indicator::after {
        content: '';
        position: absolute;
        width: 10px;
        height: 10px;
        background: var(--checkout-primary);
        border-radius: 50%;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    /* Primary Form Modifications */
    .payment-page-wrapper .form-control:focus {
        border-color: var(--checkout-primary);
        box-shadow: 0 0 0 3px rgba(0, 86, 179, 0.15);
    }

    .payment-page-wrapper .btn-checkout {
        background-color: var(--checkout-primary);
        color: #ffffff;
        border: none;
        font-weight: 600;
        border-radius: 6px;
        transition: background-color 0.2s ease;
    }

    .payment-page-wrapper .btn-checkout:hover {
        background-color: var(--checkout-primary-hover);
        color: #ffffff;
    }

    /* Item Summary Scrollbar */
    .payment-page-wrapper .style-scroll::-webkit-scrollbar {
        width: 5px;
    }
    .payment-page-wrapper .style-scroll::-webkit-scrollbar-track {
        background: transparent;
    }
    .payment-page-wrapper .style-scroll::-webkit-scrollbar-thumb {
        background: var(--checkout-border);
        border-radius: 10px;
    }
</style>

<div class="container py-4 payment-page-wrapper">
    <!-- Modern Header Securing Badging -->
    <div class="row mb-4 align-items-center">
        <div class="col-sm-8 text-center text-sm-start">
            <h2 class="section-title mb-1" style="font-size: 1.5rem;"><i class="fas fa-lock me-2"></i> Secure Checkout</h2>
            <p class="small text-muted mb-0">Select your preferred payment method to complete your order safely.</p>
        </div>
        <div class="col-sm-4 text-center text-sm-end mt-3 mt-sm-0">
            <span class="secure-badge px-3 py-2 rounded d-inline-flex align-items-center gap-2">
                <i class="fas fa-shield-alt text-success"></i>
                <span class="small fw-bold text-dark">256-Bit SSL Encrypted</span>
            </span>
        </div>
    </div>

    <div class="row g-3">
        <!-- LEFT COLUMN: PAYMENT METHOD SELECTION -->
        <div class="col-lg-8">
            <form action="{{ route('checkout.payment.submit') }}" method="POST" id="payment-form">
                @csrf
                
                <div class="cart-card p-4 mb-3">
                    <h3 class="section-title mb-4" style="font-size: 1.1rem;">Choose Payment Method</h3>
                    
                    <!-- M-Pesa Option -->
                    <div class="payment-method-card p-3 mb-3 option-active" id="wrapper-mpesa">
                        <div class="form-check d-flex align-items-start position-relative w-100 p-0">
                            <input class="form-check-input payment-radio position-absolute opacity-0" type="radio" name="payment_method" id="method-mpesa" value="mpesa" checked>
                            <div class="custom-radio-indicator me-3 mt-1 flex-shrink-0"></div>
                            <label class="form-check-label d-flex align-items-center justify-content-between w-100 style-pointer" for="method-mpesa" style="cursor: pointer;">
                                <div class="pe-3">
                                    <span class="d-block h6 fw-bold text-dark mb-1">Lipa na M-Pesa</span>
                                    <p class="text-muted small mb-0 lh-base">Receive an instant secure STK PIN authorization prompt on your mobile number.</p>
                                </div>
                                <img src="{{ asset('assets/payments/mpesa-logo.svg') }}" alt="Mpesa" class="img-fluid object-fit-contain flex-shrink-0" style="height: 60px; width: auto;">
                            </label>
                        </div>
                        
                        <!-- M-Pesa Dynamic Content -->
                        <div class="collapsible-fields mt-3 ps-4 pt-2" id="fields-mpesa">
                            <div class="p-3 rounded" style="max-width: 440px; background-color: var(--checkout-bg-light); border: 1px solid var(--checkout-border);">
                                <label class="form-label small fw-bold text-dark mb-1">M-Pesa Mobile Number</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-white border-end-0 text-muted fw-semibold" style="border-color: #cbd5e1;">+254</span>
                                    <input type="tel" name="mpesa_phone" class="form-control form-control-sm shadow-none ps-2 fw-semibold" 
                                           style="border-color: #cbd5e1;" placeholder="712345678" autocomplete="tel" required
                                           value="{{ $orderSummaryData['shipping_information']['shipping_phone'] ?? '' }}">
                                </div>
                                <div class="form-text text-muted small mt-2 d-flex gap-2 align-items-start" style="font-size: 0.8rem;">
                                    <i class="fas fa-info-circle mt-0.5"></i> 
                                    <span>Keep your handset unlocked to authorize the instant SIM-toolkit secure PIN prompt layout.</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Option -->
                    <div class="payment-method-card p-3 mb-3" id="wrapper-card">
                        <div class="form-check d-flex align-items-start position-relative w-100 p-0">
                            <input class="form-check-input payment-radio position-absolute opacity-0" type="radio" name="payment_method" id="method-card" value="card">
                            <div class="custom-radio-indicator me-3 mt-1 flex-shrink-0"></div>
                            <label class="form-check-label d-flex align-items-center justify-content-between w-100 style-pointer" for="method-card" style="cursor: pointer;">
                                <div class="pe-3">
                                    <span class="d-block h6 fw-bold text-dark mb-1">Credit / Debit Card</span>
                                    <p class="text-muted small mb-0 lh-base">Secure routing parameters via global Visa and Mastercard verification pipelines.</p>
                                </div>
                                <div class="d-flex gap-2 align-items-center flex-shrink-0">
                                    <img src="{{ asset('assets/payments/visa-logo.svg') }}" alt="Visa" class="img-fluid" style="height: 46px;">
                                    <img src="{{ asset('assets/payments/mastercard-logo.svg') }}" alt="Mastercard" class="img-fluid" style="height: 46px;">
                                </div>
                            </label>
                        </div>

                        <!-- Card Fields Container -->
                        <div class="mt-3 ps-4 d-none collapsible-fields" id="fields-card">
                            <div class="p-3 rounded text-center border border-dashed mt-2" style="background-color: var(--checkout-bg-light); border-color: #cbd5e1;">
                                <p class="small text-muted mb-0 py-1">
                                    <i class="fas fa-shield-alt me-1"></i> Multi-currency direct bank check payment gateway module initialized.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Airtel Money Option -->
                    <div class="payment-method-card p-3 mb-2" id="wrapper-airtel">
                        <div class="form-check d-flex align-items-start position-relative w-100 p-0">
                            <input class="form-check-input payment-radio position-absolute opacity-0" type="radio" name="payment_method" id="method-airtel" value="airtel">
                            <div class="custom-radio-indicator me-3 mt-1 flex-shrink-0"></div>
                            <label class="form-check-label d-flex align-items-center justify-content-between w-100 style-pointer" for="method-airtel" style="cursor: pointer;">
                                <div class="pe-3">
                                    <span class="d-block h6 fw-bold text-dark mb-1">Airtel Money</span>
                                    <p class="text-muted small mb-0 lh-base">Process merchant payments seamlessly matching native standard toolkit configurations.</p>
                                </div>
                                <img src="{{ asset('assets/payments/airtel-logo.svg') }}" alt="Airtel" class="img-fluid flex-shrink-0" style="height: 60px;">
                            </label>
                        </div>
                        
                        <!-- Airtel Fields Container -->
                        <div class="mt-3 ps-4 d-none collapsible-fields" id="fields-airtel">
                            <div class="p-3 rounded text-center border border-dashed mt-2" style="background-color: var(--checkout-bg-light); border-color: #cbd5e1;">
                                <p class="small text-muted mb-0 py-1">
                                    <i class="fas fa-info-circle me-1"></i> Airtel Express balance verification processing protocol asset panel.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- PAY ON DELIVERY OPTION -->
                    <div class="payment-method-card p-3 mb-2" id="wrapper-cod">

                        <div class="form-check d-flex align-items-start position-relative w-100 p-0">

                            <input class="form-check-input payment-radio position-absolute opacity-0"
                                type="radio"
                                name="payment_method"
                                id="method-cod"
                                value="cod">

                            <div class="custom-radio-indicator me-3 mt-1 flex-shrink-0"></div>

                            <label class="form-check-label d-flex align-items-center justify-content-between w-100 style-pointer"
                                for="method-cod"
                                style="cursor: pointer;">

                                <div class="pe-3">
                                    <span class="d-block h6 fw-bold text-dark mb-1">
                                        Pay on Delivery
                                    </span>

                                    <p class="text-muted small mb-0 lh-base">
                                        Pay after your order is delivered successfully. Shipping fee must be paid during checkout.
                                    </p>
                                </div>

                                <i class="fas fa-truck text-primary fs-4"></i>

                            </label>
                        </div>

                        <!-- COD INFO -->
                        <div class="mt-3 ps-4 d-none collapsible-fields" id="fields-cod">

                            <div class="p-3 rounded"
                                style="background-color: var(--checkout-bg-light); border: 1px solid var(--checkout-border);">

                                <p class="small text-muted mb-0">
                                    <i class="fas fa-info-circle me-1"></i>

                                    You will only pay the product amount after delivery confirmation.
                                    Shipping charges are required now to process dispatch.
                                </p>

                            </div>

                        </div>

                    </div>
                </div>

                <!-- Primary Callout Trigger -->
                <button type="submit"
                        class="btn btn-checkout w-100 py-3 mb-3"
                        id="submit-payment-btn">

                    <i class="fas fa-lock me-2"></i>

                    <span id="checkout-button-text">
                        Complete Payment: KES {{ number_format($orderSummaryData['net_total']) }}
                    </span>

                </button>
            </form>
        </div>

        <!-- RIGHT COLUMN: SUMMARY BREAKDOWN -->
        <div class="col-lg-4">
            <div class="summary-sidebar">
                <div class="cart-card p-3">
                    <h3 class="section-title mb-3" style="font-size: 1rem;">Order Manifest</h3>
                    
                    <!-- Delivery Address Overview -->
                    <div class="mb-3 p-3 rounded" style="background-color: var(--checkout-bg-light); border: 1px solid var(--checkout-border);">
                        <span class="d-block text-uppercase fw-bold text-muted mb-1" style="font-size: 0.65rem; letter-spacing: 0.5px;">Shipping Destination</span>
                        <div class="fw-bold text-dark mb-1" style="font-size: 0.9rem;">
                            {{ $orderSummaryData['shipping_information']['shipping_name'] ?? 'Guest Customer' }} </br>
                            {{ $orderSummaryData['shipping_information']['shipping_phone'] ?? '' }}
                        </div>
                        <div class="text-muted small lh-sm" style="font-size: 0.85rem;">
                        {{ $orderSummaryData['shipping_information']['shipping_address'] ?? '' }},
                        {{ ucfirst($orderSummaryData['shipping_information']['shipping_town'] ?? '') }},
                        {{ ucfirst($orderSummaryData['shipping_information']['shipping_county'] ?? '') }}
                        </div>
                    </div>

                    <!-- Scrollable Items Container -->
                    <div class="overflow-y-auto mb-3 pe-1 style-scroll" style="max-height: 180px;">
                        @foreach($orderSummaryData['cart_items'] as $item)
                        <div class="d-flex align-items-start justify-content-between py-2 border-bottom" style="border-color: #f1f5f9 !important;">
                            <div class="d-flex align-items-start gap-2 me-3">
                                <span class="badge rounded px-2 py-1 align-self-start text-dark bg-light border" style="font-size: 0.75rem; font-weight: 600;">
                                    {{ $item['qty'] }}×
                                </span>
                                <div>
                                    <span class="d-block small text-dark fw-semibold" style="font-size: 0.85rem; word-break: break-word;">{{ $item['name'] }}</span>
                                </div>
                            </div>
                            <span class="small fw-bold text-dark text-nowrap" style="font-size: 0.85rem;">KES {{ number_format($item['price'] * $item['qty']) }}</span>
                        </div>
                        @endforeach
                    </div>

                    <!-- Line Breakdown Summary -->
                    <div class="d-flex justify-content-between mb-2">
                        <span class="small text-muted">Subtotal</span>
                        <span class="small fw-semibold text-dark">KES {{ number_format($orderSummaryData['subtotal']) }}</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span class="small text-muted">Shipping</span>
                        <span class="small fw-semibold text-dark">
                            @if($orderSummaryData['shipping_fee'] > 0)
                                KES {{ number_format($orderSummaryData['shipping_fee']) }}
                            @else
                                <span class="text-success fw-bold">Free</span>
                            @endif
                        </span>
                    </div>
                    
                    @if($orderSummaryData['discount_applied'] > 0)
                    <div class="d-flex justify-content-between mb-2">
                        <span class="small text-success">Discount ({{ $orderSummaryData['promo_used'] }})</span>
                        <span class="small fw-semibold text-success">-KES {{ number_format($orderSummaryData['discount_applied']) }}</span>
                    </div>
                    @endif
                    
                    <hr class="my-3" style="border-color: var(--checkout-border);">
                    
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="fw-bold text-uppercase text-muted" style="font-size: 0.8rem;">Total Due</span>
                        <span class="fw-bold" style="font-size: 1.3rem; color: var(--checkout-dark);">
                            KES {{ number_format($orderSummaryData['net_total']) }}
                        </span>
                    </div>
                </div>

                <div class="mt-3 px-1">
                    <a href="{{ url('/shop') }}" class="text-decoration-none small fw-bold text-uppercase d-inline-flex align-items-center" style="color: var(--checkout-primary); font-size: 0.75rem;">
                        <i class="fas fa-chevron-left me-1.5"></i> Back to Products
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const submitBtnText = document.getElementById('checkout-button-text');

    const shippingFee = {{ $orderSummaryData['shipping_fee'] }};

    document.querySelectorAll('.payment-radio').forEach(radio => {

        radio.addEventListener('change', function() {

            // REMOVE ACTIVE STATES
            document.querySelectorAll('.payment-method-card').forEach(card => {
                card.classList.remove('option-active');
            });

            document.querySelectorAll('.collapsible-fields').forEach(field => {
                field.classList.add('d-none');
            });

            // ACTIVATE CURRENT
            const selectedWrapper = document.getElementById('wrapper-' + this.value);
            const selectedFields = document.getElementById('fields-' + this.value);

            if (selectedWrapper) {
                selectedWrapper.classList.add('option-active');
            }

            if (selectedFields) {
                selectedFields.classList.remove('d-none');
            }

            // BUTTON TEXT LOGIC
            if (this.value === 'cod') {

                submitBtnText.innerHTML =
                    `Pay Shipping Fee: KES ${shippingFee.toLocaleString()}`;

            } else {

                submitBtnText.innerHTML =
                    `Complete Payment: KES {{ number_format($orderSummaryData['net_total']) }}`;

            }
        });

    });

});
</script>
@endsection