@extends('frontend.layouts.app')

@section('content')

<section class="product-details">
    <div class="container">
        <div class="row g-5">
            
            <!-- LEFT SIDE: PRODUCT INFO -->
            <div class="col-lg-7">
                <div class="card-custom">
                    <nav aria-label="breadcrumb" style="margin-bottom: 15px;">
                        <ol class="breadcrumb" style="font-size: 0.75rem; background: transparent; padding: 0;">
                            <li class="breadcrumb-item"><a href="/" style="color: var(--text-muted);">Home</a></li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('shop', ['category' => $product['category']]) }}" style="color: var(--text-muted);">
                                    {{ $product['category'] }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $product['brand'] ?? 'Product' }}</li>
                        </ol>
                    </nav>

                    <h1 class="product-title">{{ $product['name'] }}</h1>
                    
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 24px;">
                        <div class="star-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span class="rating-text">4.5 (128 Reviews)</span>
                        </div>
                    <span style="font-size: 0.85rem; color: var(--brand-green); font-weight: 600;">
                        <i class="fas fa-check-circle"></i>
                        {{ $product['stock'] }} In Stock
                    </span>
                    </div>

                    <div class="timer-box">
                        <span class="timer-text"><i class="fas fa-fire-alt"></i> FLASH SALE ENDS IN:</span>
                        <div id="timer" class="countdown">00:00:00</div>
                    </div>

                    <div class="price-wrapper">
                        <span class="price-main">KSh {{ number_format($product['new_price']) }}</span>
                        <span class="price-old">KSh {{ number_format($product['old_price']) }}</span>
                        @if($discount > 0)
                            <span class="discount-pill">{{ $discount }}% OFF</span>
                        @endif
                    </div>

                    <!-- SERVICES -->
                    <div class="service-grid">
                        <div class="service-item"><i class="fas fa-shield-check"></i> 1 Year Warranty</div>
                        <div class="service-item"><i class="fas fa-shipping-fast"></i> Free Delivery</div>
                        <div class="service-item"><i class="fas fa-sync-alt"></i> 7 Days Return</div>
                        <div class="service-item"><i class="fas fa-user-headset"></i> 24/7 Support</div>
                    </div>


                    <div style="margin-bottom: 24px;">
                        <label style="font-weight: 700; font-size: 0.85rem; display: block; margin-bottom: 10px;">Select Variant:</label>
                        <div style="display: flex; gap: 12px;">
                            @foreach(($product['variants'] ?? []) as $index => $variant)
                                <div
                                    title="{{ $variant['name'] }}"
                                    style="
                                        width: 32px;
                                        height: 32px;
                                        border-radius: 8px;
                                        background: {{ $variant['color'] }};
                                        cursor: pointer;
                                        border: {{ $index == 0 ? '2px solid var(--brand-blue)' : '1px solid var(--border-color)' }};
                                        {{ $index == 0 ? 'outline: 2px solid #fff; outline-offset: -4px;' : '' }}
                                    ">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div style="background: #f8fafc; padding: 15px; border-radius: 12px; border: 1px dashed var(--border-color); margin-bottom: 30px;">
                        <div style="display: flex; gap: 12px; align-items: flex-start;">
                            <i class="fas fa-map-marker-alt" style="color: var(--brand-blue); margin-top: 4px;"></i>
                            <div>
                                <p style="margin:0; font-size: 0.85rem; font-weight: 700;">
                                    Delivery to your location
                                </p>

                                <p style="margin:0; font-size: 0.8rem; color: var(--text-muted);">
                                    Arrives in 1–3 Days (Maximum) in Kenya (EAT): {{ date('D, d M', strtotime('+3 days')) }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- QUANTITY & TOTAL DISPLAY COMBINED -->
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 30px; background: #fff; padding: 15px; border-radius: 12px; border: 1px solid var(--border-color);">
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <label style="font-weight: 700; font-size: 0.85rem; margin-bottom: 0;">Qty:</label>
                            <div class="qty-box">
                                <button class="qty-btn" onclick="updateQty(-1)">-</button>
                                <input type="text" id="qty" value="1" class="qty-input" readonly>
                                <button class="qty-btn" onclick="updateQty(1)">+</button>
                            </div>
                        </div>
                        <div class="total-display-wrapper">
                            Total: <span id="total-display">KSh {{ number_format($product['new_price']) }}</span>
                        </div>
                    </div>

                    <!-- ACTION BUTTONS -->
                    <div class="action-buttons">

                        <!-- ADD TO CART -->
                        <form action="{{ route('cart.add') }}" method="POST" class="d-inline m-0 p-0">
                            @csrf

                            <input type="hidden" name="id" value="{{ $product['id'] }}">
                            <input type="hidden" name="name" value="{{ $product['name'] }}">
                            <input type="hidden" name="price" value="{{ $product['new_price'] }}">
                            <input type="hidden" name="old_price" value="{{ $product['old_price'] }}">
                            <input type="hidden" name="image" value="{{ $product['image'] }}">
                            <input type="hidden" name="qty" id="cartQty" value="1">

                            <button type="submit" class="btn-action btn-cart me-2">
                                <i class="fas fa-shopping-bag"></i>
                                Add To Cart
                            </button>
                        </form>

                        <!-- WHATSAPP ORDER -->
                        <a href="https://wa.me/254791446968?text={{ urlencode(
                            "Hello JM Innovatech 👋 I want to order this product:\n\n" .
                            "Product: " . $product['name'] . "\n" .
                            "Price: KES " . number_format($product['new_price']) . "\n" .
                            "Link: " . url()->current() . "\n\n" .
                            "Kindly confirm availability and delivery."
                        ) }}"
                        class="btn-action btn-buy me-2"
                        target="_blank">

                            <i class="fab fa-whatsapp"></i>
                            Order via WhatsApp
                        </a>

                        <!-- WISHLIST (UNCHANGED FUNCTIONALITY PLACEHOLDER) -->
                        <form action="{{ route('wishlist.add') }}" method="POST" style="display:inline;">
                            @csrf

                            <input type="hidden" name="id" value="{{ $product['id'] }}">
                            <input type="hidden" name="name" value="{{ $product['name'] }}">
                            <input type="hidden" name="price" value="{{ $product['new_price'] }}">
                            <input type="hidden" name="old_price" value="{{ $product['old_price'] }}">
                            <input type="hidden" name="image" value="{{ $product['image'] }}">

                            <button type="submit"
                                class="btn-action btn-outline me-2"
                                title="Add to Wishlist"
                                style="border: none; background: transparent;">
                                <i class="far fa-heart"></i>
                            </button>
                        </form>

                        <!-- SHARE PRODUCT -->
                        <a href="#"
                        class="btn-action btn-outline"
                        title="Share Product"
                        onclick="shareProduct(event)">
                            <i class="fas fa-share-alt"></i>
                        </a>

                    </div>
                </div>
            </div>

            <!-- RIGHT SIDE: PRODUCT IMAGES -->
            <div class="col-lg-5">
                <div style="position: sticky; top: 30px;">
                    <div class="main-image-wrapper">
                        <img id="mainImage" src="{{ $product['image'] }}" alt="{{ $product['name'] }}" style="width: 100%; height: auto; object-fit: contain;">
                    </div>
                    
                    <div class="thumb-grid">

                        @foreach(($product['thumbnails'] ?? []) as $index => $thumb)

                        <div class="thumb-item {{ $index == 0 ? 'active' : '' }}"
                            onclick="changeImg(this, '{{ $thumb }}')">

                            <img src="{{ $thumb }}"
                                style="width:100%; height:100%; object-fit:cover;">

                        </div>

                        @endforeach

                    </div>

                    <div style="margin-top: 30px; border-top: 1px solid var(--border-color); padding-top: 20px;">
                        <h5 style="font-size: 0.9rem; font-weight: 700; margin-bottom: 12px;">
                            Key Highlights:
                        </h5>

                        <p style="font-size: 0.85rem; color: var(--text-muted); margin: 0;">
                            {{ $product['description'] }}
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- RELATED PRODUCTS SECTION -->
<section class="related-section">
    <div class="container">
        <div class="section-header">
            <div>
                <h3 style="font-weight: 800; color: var(--brand-navy); margin: 0;">Related Products</h3>
                <p style="color: var(--text-muted); font-size: 0.85rem; margin: 0;">More items from this category</p>
            </div>
            <div style="display: flex; gap: 8px;">
                <button onclick="slideRelated(-300)" class="btn-action btn-outline" style="width: 35px; height: 35px;">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button onclick="slideRelated(300)" class="btn-action btn-outline" style="width: 35px; height: 35px;">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <div class="slider-container" id="relatedSlider">
            @foreach($related_products as $index => $rel)
            <div class="related-card" style="animation-delay: {{ $index * 0.1 }}s">
                <img src="{{ $rel['image'] }}" alt="{{ $rel['name'] }}" class="related-img">
                <h4 class="related-name">{{ $rel['name'] }}</h4>
                <div class="related-price">KSh {{ number_format($rel['new_price']) }}</div>
                <a href="{{ $rel['url'] ?? '#' }}" class="stretched-link"></a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<script>
    const basePrice = {{ $product['new_price'] }};

    // ================= TIMER =================
    let time = {{ max($product['flash_sale_ends'] - now()->timestamp, 0) }};
    const timerElement = document.getElementById('timer');

    function updateTimer() {
        let hours = Math.floor(time / 3600);
        let minutes = Math.floor((time % 3600) / 60);
        let seconds = time % 60;

        timerElement.innerText =
            `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

        if (time > 0) time--;
    }

    setInterval(updateTimer, 1000);
    updateTimer();

    // ================= QTY =================
    function updateQty(val) {
        let input = document.getElementById('qty');
        let totalDisplay = document.getElementById('total-display');
        let current = parseInt(input.value);

        if (current + val >= 1) {
            let newVal = current + val;
            input.value = newVal;

            let total = newVal * basePrice;
            totalDisplay.innerText = 'KSh ' + total.toLocaleString();
        }
    }

    // ================= IMAGE SWITCH =================
    function changeImg(el, src) {
        document.getElementById('mainImage').src = src;
        document.querySelectorAll('.thumb-item').forEach(item => item.classList.remove('active'));
        el.classList.add('active');
    }

    // ================= MANUAL SLIDER BUTTON =================
    function slideRelated(amount) {
        const slider = document.getElementById('relatedSlider');
        slider.scrollBy({
            left: amount,
            behavior: 'smooth'
        });
    }

    // ================= SMOOTH INFINITE AUTO SLIDER (RIGHT → LEFT) =================
    const slider = document.getElementById('relatedSlider');

    let speed = 0.8; // 🔥 balanced speed (adjust: 0.5 slow, 1 fast)

    let animationFrame;

    function startAutoSlide() {
        cancelAnimationFrame(animationFrame);

        function step() {
            slider.scrollLeft += speed;

            // seamless reset when reaching end
            if (slider.scrollLeft >= slider.scrollWidth - slider.clientWidth) {
                slider.scrollLeft = 0;
            }

            animationFrame = requestAnimationFrame(step);
        }

        animationFrame = requestAnimationFrame(step);
    }

    startAutoSlide();

    // Pause on hover (better UX)
    slider.addEventListener('mouseenter', () => {
        cancelAnimationFrame(animationFrame);
    });

    slider.addEventListener('mouseleave', () => {
        startAutoSlide();
    });
</script>

<script>
function shareProduct(e) {
    e.preventDefault();

    const url = window.location.href;

    const shareData = {
        title: @json($product['name']),
        text: "Check out this product: {{ $product['name'] }} for KSh {{ number_format($product['new_price']) }}",
        url: url
    };

    // Try native share (mobile)
    if (navigator.share) {
        navigator.share(shareData)
            .catch(err => console.log("Share cancelled", err));
        return;
    }

    // Fallback 1: Clipboard API
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(url)
            .then(() => {
                alert("Link copied! Share it anywhere.");
            })
            .catch(() => fallbackCopy(url));
    } else {
        fallbackCopy(url);
    }
}

// Fallback 2: older browsers
function fallbackCopy(text) {
    const temp = document.createElement("input");
    document.body.appendChild(temp);
    temp.value = text;
    temp.select();
    document.execCommand("copy");
    document.body.removeChild(temp);

    alert("Link copied to clipboard!");
}
</script>

@endsection