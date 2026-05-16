@extends('frontend.layouts.app')

@section('content')

<div class="container cart-container py-4">
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <div class="row g-3">
            
            <!-- LEFT: SHIPPING & ITEMS -->
            <div class="col-lg-8">
                
                <!-- 1. Expanded Shipping Information -->
                <div class="cart-card mb-3">
                    <div class="p-3 border-bottom">
                        <h2 class="section-title mb-0" style="font-size: 1.1rem;"><i class="fas fa-truck me-2"></i> 1. Shipping Details</h2>
                    </div>
                    <div class="p-3">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">First Name</label>
                                <input type="text" name="first_name" value="{{ old('first_name', $user['first_name']) }}" class="form-control form-control-sm shadow-none" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="last_name" value="{{ old('last_name', $user['last_name']) }}" class="form-control form-control-sm shadow-none" placeholder="Doe" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" value="{{ old('email', $user['email']) }}" class="form-control form-control-sm shadow-none" placeholder="john@gmail.com" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone Number</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-light text-muted">+254</span>
                                    <input type="tel" name="phone" value="{{ old('phone', $user['phone']) }}" class="form-control shadow-none" placeholder="712345678" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Street Address / Apartment / Estate</label>
                                <input type="text" name="address" value="{{ old('address', $user['address']) }}" class="form-control form-control-sm shadow-none" placeholder="e.g. Garden City, Apt 4B" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">County</label>

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
                                        'others' => 'Other',
                                    ];
                                @endphp

                                <select class="form-select form-select-sm shadow-none"
                                        name="county"
                                        required>

                                    <option value="">Select County</option>

                                    @foreach($counties as $value => $label)

                                        <option value="{{ $value }}"
                                            {{ old('county', $user['county']) == $value ? 'selected' : '' }}>

                                            {{ $label }}

                                        </option>

                                    @endforeach

                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Town / Area</label>
                                <input type="text" name="town" value="{{ old('town', $user['town']) }}" class="form-control form-control-sm shadow-none" placeholder="e.g. Westlands" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Order Notes (Optional)</label>
                                <textarea name="notes"
                                        class="form-control form-control-sm shadow-none"
                                        rows="2"
                                        placeholder="Instructions for delivery...">{{ old('notes', $user['notes']) }}</textarea>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. Cart Items -->
                <div class="cart-card">
                    <div class="p-3 border-bottom">
                        <h1 class="section-title mb-0" style="font-size: 1.1rem;"><i class="fas fa-shopping-cart me-2"></i> 2. Order Review ({{ count($cartItems) }})</h1>
                    </div>

                    @foreach($cartItems as $item)
                        @php
                            $discount = round((($item['old_price'] - $item['price']) / $item['old_price']) * 100);
                            $lineTotal = $item['price'] * $item['qty'];
                        @endphp
                        <div class="cart-item">
                            <div class="row align-items-center g-3">

                                <!-- IMAGE -->
                                <div class="col-auto">
                                    <img src="{{ $item['image'] }}"
                                        class="item-img border"
                                        alt="product">
                                </div>

                                <!-- PRODUCT -->
                                <div class="col">
                                    <span class="brand-tag">
                                        {{ $item['brand'] ?? 'Premium Product' }}
                                    </span>
                                    <a href="{{ route('product.show', $item['id']) }}"
                                        class="item-name mb-1 text-truncate"
                                        style="max-width: 250px;">
                                            {{ $item['name'] }}
                                    </a>
                                </div>

                                <!-- QUANTITY -->
                                <div class="col-auto">
                                    <div class="qty-box">

                                        <!-- DECREASE -->
                                        <form method="POST"
                                            action="{{ route('cart.decrease', $item['id']) }}"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit"
                                                    class="qty-btn">
                                                -
                                            </button>
                                        </form>

                                        <!-- QTY -->
                                        <input type="text"
                                            class="qty-input"
                                            value="{{ $item['qty'] }}"
                                            readonly>

                                        <!-- INCREASE -->
                                        <form method="POST"
                                            action="{{ route('cart.increase', $item['id']) }}"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit"
                                                    class="qty-btn">
                                                +
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- PRICE -->
                                <div class="col-auto text-end"
                                    style="min-width: 120px;">
                                    <span class="current-price">
                                        KES {{ number_format($lineTotal) }}
                                    </span>
                                    <div class="d-flex justify-content-end align-items-center gap-2">
                                        <span class="old-price">
                                            KES {{ number_format($item['old_price']) }}
                                        </span>
                                        <span class="discount-pill">
                                            -{{ $discount }}%
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- RIGHT: SUMMARY -->
            <div class="col-lg-4">
                <div class="summary-sidebar">
                    
                    <!-- Promo Code Section (Form tags removed) -->
                    <div class="cart-card p-3 mb-3">
                        <h2 class="section-title mb-3" style="font-size: 1rem;">Vouchers & Promos</h2>

                        <div class="input-group">
                            <input type="text"
                                name="promo_code"
                                value="{{ old('promo_code', $appliedPromo['code'] ?? request('promo_code')) }}"
                                class="form-control promo-input shadow-none"
                                placeholder="Enter Promo Code">

                            <!-- This button triggers a Javascript switch or alternative route submission -->
                            <button type="submit" 
                                    formaction="{{ route('checkout.apply_promo') }}" 
                                    formmethod="POST" 
                                    class="btn promo-btn shadow-none">
                                APPLY
                            </button>
                        </div>

                        @if(isset($appliedPromo) && $appliedPromo)
                            <div class="alert alert-success mt-3 mb-0 py-2 small">
                                Congratulations! Promo Applied: <strong>{{ $appliedPromo['code'] }}</strong>. Your special discount has been deducted from your order summary total.
                            </div>
                        @endif
                        
                        @if(isset($promoError) && $promoError)
                            <div class="alert alert-danger mt-3 mb-0 py-2 small">
                                {{ $promoError }}
                            </div>
                        @endif
                    </div>

                    <!-- Summary Details -->
                    <div class="cart-card p-3">
                        <h2 class="section-title mb-3" style="font-size: 1rem;">Order Summary</h2>

                        <div class="d-flex justify-content-between mb-2">
                            <span class="summary-label">Subtotal</span>
                            <span class="summary-value">KES {{ number_format($subtotal) }}</span>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span class="summary-label">Shipping Fee</span>
                            <span class="summary-value text-dark">KES {{ number_format($shippingFee) }}</span>
                        </div>

                        @if($discountAmount > 0)
                        <div class="d-flex justify-content-between mb-2">
                            <span class="summary-label text-success">Promo Discount</span>
                            <span class="summary-value text-success">-KES {{ number_format($discountAmount) }}</span>
                        </div>
                        @endif

                        <hr class="my-3">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span class="fw-bold text-uppercase" style="font-size: 1.1rem;">Total</span>
                            <span class="fw-bold" style="font-size: 1.3rem; color: var(--text-dark);">
                                KES {{ number_format($total) }}
                            </span>
                        </div>

                        <!-- Main Checkout Submission -->
                        <button type="submit" class="btn btn-checkout w-100 mb-3">
                            Complete Purchase
                        </button>

                        <div class="text-center pt-2 border-top">
                            <small class="text-muted" style="font-size: 0.75rem; font-weight: 600;">SECURE PAYMENT METHODS</small>
                            <div class="payment-icon-list">
                                <img src="{{ asset('assets/payments/mpesa-logo.svg') }}" alt="Mpesa">
                                <img src="{{ asset('assets/payments/visa-logo.svg') }}" alt="Visa">
                                <img src="{{ asset('assets/payments/airtel-logo.svg') }}" alt="Airtel">
                                <img src="{{ asset('assets/payments/mastercard-logo.svg') }}" alt="Mastercard">
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 px-1">
                        <a href="{{ url('/shop') }}" class="text-decoration-none small fw-bold text-uppercase" style="color: var(--brand-primary); font-size: 0.75rem;">
                            <i class="fas fa-chevron-left me-1"></i> Back to Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection