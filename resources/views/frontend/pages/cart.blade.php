@extends('frontend.layouts.app')

@section('content')

<div class="container cart-container py-4">
    <form action="{{ url('/checkout/process') }}" method="POST">
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
                                <input type="text" name="first_name" class="form-control form-control-sm shadow-none" placeholder="John" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control form-control-sm shadow-none" placeholder="Doe" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control form-control-sm shadow-none" placeholder="john@example.com" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone Number</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-light text-muted">+254</span>
                                    <input type="tel" name="phone" class="form-control shadow-none" placeholder="712345678" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Street Address / Apartment / Estate</label>
                                <input type="text" name="address" class="form-control form-control-sm shadow-none" placeholder="e.g. Garden City, Apt 4B" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">County</label>
                                <select class="form-select form-select-sm shadow-none" name="county" required>
                                    <option value="">Select County</option>
                                    <option value="baringo">Baringo</option>
                                    <option value="bomet">Bomet</option>
                                    <option value="bungoma">Bungoma</option>
                                    <option value="busia">Busia</option>
                                    <option value="elgeyo-marakwet">Elgeyo Marakwet</option>
                                    <option value="embu">Embu</option>
                                    <option value="garissa">Garissa</option>
                                    <option value="homa-bay">Homa Bay</option>
                                    <option value="isiolo">Isiolo</option>
                                    <option value="kajiado">Kajiado</option>
                                    <option value="kakamega">Kakamega</option>
                                    <option value="kericho">Kericho</option>
                                    <option value="kiambu">Kiambu</option>
                                    <option value="kilifi">Kilifi</option>
                                    <option value="kirinyaga">Kirinyaga</option>
                                    <option value="kisii">Kisii</option>
                                    <option value="kisumu">Kisumu</option>
                                    <option value="kitui">Kitui</option>
                                    <option value="kwale">Kwale</option>
                                    <option value="laikipia">Laikipia</option>
                                    <option value="lamu">Lamu</option>
                                    <option value="machakos">Machakos</option>
                                    <option value="makueni">Makueni</option>
                                    <option value="mandera">Mandera</option>
                                    <option value="marsabit">Marsabit</option>
                                    <option value="meru">Meru</option>
                                    <option value="migori">Migori</option>
                                    <option value="mombasa">Mombasa</option>
                                    <option value="muranga">Murang'a</option>
                                    <option value="nairobi">Nairobi</option>
                                    <option value="nakuru">Nakuru</option>
                                    <option value="nandi">Nandi</option>
                                    <option value="narok">Narok</option>
                                    <option value="nyamira">Nyamira</option>
                                    <option value="nyandarua">Nyandarua</option>
                                    <option value="nyeri">Nyeri</option>
                                    <option value="samburu">Samburu</option>
                                    <option value="siaya">Siaya</option>
                                    <option value="taita-taveta">Taita Taveta</option>
                                    <option value="tana-river">Tana River</option>
                                    <option value="tharaka-nithi">Tharaka-Nithi</option>
                                    <option value="trans-nzoia">Trans Nzoia</option>
                                    <option value="turkana">Turkana</option>
                                    <option value="uasin-gishu">Uasin Gishu</option>
                                    <option value="vihiga">Vihiga</option>
                                    <option value="wajir">Wajir</option>
                                    <option value="west-pokot">West Pokot</option>
                                    <option value="others">Other</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Town / Area</label>
                                <input type="text" name="town" class="form-control form-control-sm shadow-none" placeholder="e.g. Westlands" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Order Notes (Optional)</label>
                                <textarea name="notes" class="form-control form-control-sm shadow-none" rows="2" placeholder="Instructions for delivery..."></textarea>
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
                        @endphp
                        <div class="cart-item">
                            <div class="row align-items-center g-3">
                                <div class="col-auto">
                                    <img src="{{ $item['image'] }}" class="item-img border" alt="product">
                                </div>
                                <div class="col">
                                    <span class="brand-tag">{{ $item['brand'] }}</span>
                                    <a href="#" class="item-name mb-1 text-truncate" style="max-width: 250px;">{{ $item['name'] }}</a>
                                    <a href="#" class="remove-link"><i class="fas fa-trash-alt me-1"></i> Remove</a>
                                </div>
                                <div class="col-auto">
                                    <div class="qty-box">
                                        <button type="button" class="qty-btn">-</button>
                                        <input type="text" class="qty-input" value="{{ $item['qty'] }}" readonly>
                                        <button type="button" class="qty-btn">+</button>
                                    </div>
                                </div>
                                <div class="col-auto text-end" style="min-width: 120px;">
                                    <span class="current-price">KES {{ number_format($item['price']) }}</span>
                                    <div class="d-flex justify-content-end align-items-center gap-2">
                                        <span class="old-price">KES {{ number_format($item['old_price']) }}</span>
                                        <span class="discount-pill">-{{ $discount }}%</span>
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
                    
                <!-- Promo Code -->
                <div class="cart-card p-3 mb-3">
                    <h2 class="section-title mb-3" style="font-size: 1rem;">Vouchers & Promos</h2>
                    <div class="input-group">
                        <input type="text" class="form-control promo-input shadow-none" placeholder="Enter Promo Code">
                        <button type="button" class="btn promo-btn shadow-none">APPLY</button>
                    </div>
                </div>

                    <!-- Summary Details -->
                    <div class="cart-card p-3">
                        <h2 class="section-title mb-3" style="font-size: 1rem;">Order Summary</h2>
                        
                        @php
                            $subtotal = collect($cartItems)->sum(fn($i) => $i['price'] * $i['qty']);
                            $shipping_fee = 250; 
                            $total = $subtotal + $shipping_fee;
                        @endphp

                        <div class="d-flex justify-content-between mb-2">
                            <span class="summary-label">Subtotal</span>
                            <span class="summary-value">KES {{ number_format($subtotal) }}</span>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span class="summary-label">Shipping Fee</span>
                            <span class="summary-value text-dark">KES {{ number_format($shipping_fee) }}</span>
                        </div>

                        <hr class="my-3">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span class="fw-bold text-uppercase" style="font-size: 1.1rem;">Total</span>
                            <span class="fw-bold" style="font-size: 1.3rem; color: var(--text-dark);">
                                KES {{ number_format($total) }}
                            </span>
                        </div>

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