<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // ================= CATEGORIES =================
        $categories = [
            'POS Systems',
            'POS Accessories',
            'Barcode Scanners',
            'Receipt Printers',
            'Cash Drawers',
            'ETIMS Devices',
            'Starlink Setup',
            'Networking Equipment',
            'Software Licenses'
        ];

        // ================= SLIDERS =================
        $sliders = [
            [
                'title' => 'Order POS Hardware Now',
                'desc' => 'Get high-quality POS machines, printers, and accessories delivered fast across Kenya.',
                'btn_text' => 'Shop Now',
                'btn_link' => route('shop'),
                'image' => asset('assets/images/poster.png')
            ],
            [
                'title' => 'Get Starlink Internet',
                'desc' => 'Fast, reliable satellite internet for your business anywhere in Kenya.',
                'btn_text' => 'Get Starlink Now',
                'btn_link' => '#',
                'image' => asset('assets/images/starlink.webp')
            ],
            [
                'title' => 'ETIMS Devices Ready',
                'desc' => 'Compliant eTIMS solutions for seamless tax integration and reporting.',
                'btn_text' => 'Order Now',
                'btn_link' => '#',
                'image' => asset('assets/images/etims.jpg')
            ]
        ];

        // ================= IMAGE POOL (FROM SLIDERS ONLY) =================
        $sliderImages = collect($sliders)
            ->pluck('image')
            ->values()
            ->all();

        $image = function ($i, $offset = 0) use ($sliderImages) {
            return $sliderImages[($i + $offset) % count($sliderImages)];
        };

        // ================= HOT DEALS =================
        $hotNames = [
            'MacBook Pro Retina',
            'HP EliteBook 840',
            'Dell Latitude 7490',
            'Lenovo ThinkPad X1',
            'MacBook Air M1',
            'iPad Pro 11',
            'Surface Laptop 3',
            'Asus Zenbook 14'
        ];

        $hotDeals = [];
        for ($i = 0; $i < 8; $i++) {
            $hotDeals[] = [
                'name' => $hotNames[$i],
                'category' => 'Refurbished Tech',
                'new_price' => rand(28000, 90000),
                'old_price' => rand(95000, 120000),
                'image' => $image($i, 0),
            ];
        }

        // ================= POS EQUIPMENT =================
        $posEquipment = [];
        for ($i = 0; $i < 12; $i++) {
            $posEquipment[] = [
                'name' => 'POS Equipment ' . ($i + 1),
                'new_price' => rand(5000, 50000),
                'old_price' => rand(60000, 70000),
                'image' => $image($i, 1),
            ];
        }

        // ================= PRINTERS =================
        $printers = [];
        for ($i = 0; $i < 8; $i++) {
            $printers[] = [
                'name' => 'Printer Model ' . ($i + 1),
                'category' => 'Printers',
                'features' => 'PRINT • COPY • SCAN',
                'new_price' => rand(8000, 50000),
                'old_price' => rand(60000, 70000),
                'image' => $image($i, 2),
            ];
        }

        // ================= SUPPLIES =================
        $supplies = [];
        for ($i = 0; $i < 12; $i++) {
            $supplies[] = [
                'name' => 'Supply Item ' . ($i + 1),
                'features' => 'HIGH QUALITY • DURABLE',
                'new_price' => rand(100, 3000),
                'old_price' => rand(4000, 5000),
                'image' => $image($i, 3),
            ];
        }

        // ================= TONERS =================
        $toners = [];
        for ($i = 0; $i < 8; $i++) {
            $toners[] = [
                'name' => 'Toner Model ' . ($i + 1),
                'brand' => 'HP / Canon / Epson',
                'features' => 'HIGH YIELD • SHARP PRINT',
                'new_price' => rand(2000, 8000),
                'old_price' => rand(9000, 12000),
                'image' => $image($i, 4),
            ];
        }

        return view('frontend.home', compact(
            'categories',
            'sliders',
            'hotDeals',
            'posEquipment',
            'printers',
            'supplies',
            'toners'
        ));
    }
    public function shop(Request $request)
    {
        $brandsList = ['HP', 'Epson', 'Zebra', 'Honeywell'];
        $categoriesList = ['POS Systems', 'Thermal Printers', 'Barcode Scanners', 'Cash Drawers'];

        $allProducts = [];

        for ($i = 1; $i <= 60; $i++) {
            $allProducts[] = [
                'id' => $i,
                'name' => 'POS Terminal Pro Gen ' . $i,
                'new_price' => rand(15000, 45000),
                'old_price' => rand(46000, 55000),
                'category' => $categoriesList[array_rand($categoriesList)],
                'brand' => $brandsList[array_rand($brandsList)],
                'image' => asset('assets/images/pos.png'),
            ];
        }

        // Filters
        $maxPriceFilter = $request->get('max_price', 100000);
        $selectedBrands = $request->get('brands', []);
        $selectedCategory = $request->get('category');
        $searchTerm = $request->get('search');

        $filteredProducts = array_filter($allProducts, function ($product) use (
            $maxPriceFilter,
            $selectedBrands,
            $selectedCategory,
            $searchTerm
        ) {
            $priceMatch = $product['new_price'] <= $maxPriceFilter;
            $brandMatch = empty($selectedBrands) || in_array($product['brand'], $selectedBrands);
            $catMatch = empty($selectedCategory) || $product['category'] === $selectedCategory;

            $searchMatch = true;
            if (!empty($searchTerm)) {
                $searchMatch = stripos($product['name'], $searchTerm) !== false;
            }

            return $priceMatch && $brandMatch && $catMatch && $searchMatch;
        });

        $currentGrid = $request->get('grid', 4);
        $currentPage = $request->get('page', 1);
        $perPage = ($currentGrid == 3) ? 21 : 20;

        $offset = ($currentPage - 1) * $perPage;
        $products = array_slice($filteredProducts, $offset, $perPage);

        $totalPages = ceil(count($filteredProducts) / $perPage);

        $popularProducts = array_slice($allProducts, 0, 3);

        $categoryCounts = array_count_values(array_column($allProducts, 'category'));
        $brandCounts = array_count_values(array_column($allProducts, 'brand'));

        return view('frontend.pages.shop', compact(
            'products',
            'allProducts',
            'popularProducts',
            'brandsList',
            'categoriesList',
            'categoryCounts',
            'brandCounts',
            'currentGrid',
            'currentPage',
            'totalPages',
            'maxPriceFilter',
            'selectedBrands',
            'selectedCategory'
        ));
    }

    public function product($id)
    {
        $brandsList = ['HP', 'Epson', 'Zebra', 'Honeywell'];

        $categoriesList = [
            'POS Systems',
            'Thermal Printers',
            'Barcode Scanners',
            'Cash Drawers'
        ];

        $variants = [
            [
                'name' => 'Midnight Black',
                'color' => '#1e293b'
            ],
            [
                'name' => 'Silver Mist',
                'color' => '#e2e8f0'
            ],
            [
                'name' => 'Ocean Blue',
                'color' => '#0B4FA3'
            ],
        ];

        $products = [];

        for ($i = 1; $i <= 60; $i++) {

            $newPrice = rand(15000, 45000);
            $oldPrice = rand($newPrice + 2000, $newPrice + 12000);

            $products[] = [
                'id' => $i,

                'name' => 'POS Terminal Pro Gen ' . $i,

                'new_price' => $newPrice,

                'old_price' => $oldPrice,

                'category' => $categoriesList[array_rand($categoriesList)],

                'brand' => $brandsList[array_rand($brandsList)],

                'description' => 'High quality POS system suitable for retail environments.',

                'stock' => rand(3, 40),

                'flash_sale_ends' => now()->addHours(rand(3, 24))->timestamp,

                'image' => asset('assets/images/pos.png'),

                'thumbnails' => [
                    asset('assets/images/poster.png'),
                    asset('assets/images/pos.png'),
                    asset('assets/images/poster.png'),
                    asset('assets/images/pos.png'),
                ],

                'variants' => $variants,
            ];
        }

        $product = collect($products)->firstWhere('id', (int) $id);

        abort_if(!$product, 404);

        /**
         * AUTO DISCOUNT
         */
        $oldPrice = $product['old_price'] ?? 0;
        $newPrice = $product['new_price'] ?? 0;

        $discount = ($oldPrice > 0)
            ? round((($oldPrice - $newPrice) / $oldPrice) * 100)
            : 0;

        /**
         * RELATED PRODUCTS
         */
        $related_products = [];

        foreach ($products as $related) {

            if ($related['id'] != $product['id']) {

                $related_products[] = [
                    'name' => $related['name'],
                    'image' => $related['image'],
                    'new_price' => $related['new_price'],
                    'url' => route('product.show', $related['id']),
                ];
            }
        }

        $related_products = array_slice($related_products, 0, 16);

        return view('frontend.pages.product', compact(
            'product',
            'discount',
            'related_products'
        ));
    }

    // Add this helper logic inside your HomeController class
    private function calculateCartTotals($promoCode = '')
    {
        $shipping = [
            'standard_fee' => 250,
            'express_fee'  => 600,
            'free_shipping_minimum' => 50000,
        ];

        $promoCodes = [
            ['code' => 'JMTECH10', 'type' => 'percentage', 'discount' => 10],
            ['code' => 'FREE500', 'type' => 'fixed', 'discount' => 500],
        ];

        // 🔥 GET REAL CART FROM SESSION
        $cartItems = session()->get('cart', []);

        $subtotal = collect($cartItems)->sum(fn($i) => $i['price'] * $i['qty']);

        $shippingFee = ($subtotal >= $shipping['free_shipping_minimum'])
            ? 0
            : $shipping['standard_fee'];

        $discountAmount = 0;
        $appliedPromo = null;
        $promoError = null;

        $promoCode = trim($promoCode);

        if ($promoCode !== '') {

            if (strlen($promoCode) > 12) {
                $promoError = "Promo code is too long.";
            } else {

                $matched = collect($promoCodes)->first(function ($promo) use ($promoCode) {
                    return strtoupper($promo['code']) === strtoupper($promoCode);
                });

                if ($matched) {
                    $appliedPromo = $matched;

                    $discountAmount = $matched['type'] === 'percentage'
                        ? ($subtotal * $matched['discount']) / 100
                        : $matched['discount'];
                } else {
                    $promoError = "Invalid promo code.";
                }
            }
        }

        $total = max(($subtotal + $shippingFee) - $discountAmount, 0);

        return [
            'cartItems' => $cartItems,
            'shippingFee' => $shippingFee,
            'subtotal' => $subtotal,
            'discountAmount' => $discountAmount,
            'total' => $total,
            'appliedPromo' => $appliedPromo,
            'promoError' => $promoError
        ];
    }


    public function cart(Request $request)
    {
        $user = [
            'first_name' => 'John',
            'last_name'  => 'Muthoga',
            'email'      => 'john@gmail.com',
            'phone'      => '712345678',
            'address'    => 'Garden Estate Apartment B12',
            'county'     => 'nyeri',
            'town'       => 'Nyeri Town',
            'notes'      => 'Call before delivery',
        ];

        $promoCode = $request->input('promo_code', '');
        $totals = $this->calculateCartTotals($promoCode);

        return view('frontend.pages.cart', array_merge(['user' => $user], $totals));
    }

    // ================= CART CORE =================

    private function getCart()
    {
        return session()->get('cart', []);
    }

    private function saveCart($cart)
    {
        session()->put('cart', $cart);
    }

    private function cartCount($cart)
    {
        return collect($cart)->sum('qty');
    }

    private function cartTotal($cart)
    {
        return collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);
    }

    public function addToCart(Request $request)
    {
        $cart = $this->getCart();

        $id = $request->id;

        if (isset($cart[$id])) {

            $cart[$id]['qty'] += 1;
        } else {

            $cart[$id] = [
                'id' => $id,
                'name' => $request->name,
                'price' => $request->price,
                'old_price' => $request->old_price,
                'image' => $request->image,
                'qty' => 1
            ];
        }

        $this->saveCart($cart);

        return redirect()->back()
            ->with('success', 'Product added to cart successfully.');
    }

    public function increaseCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty']++;
        }

        session()->put('cart', $cart);

        return back();
    }

    public function decreaseCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty']--;

            if ($cart[$id]['qty'] <= 0) {
                unset($cart[$id]);
            }
        }

        session()->put('cart', $cart);

        return back();
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back();
    }

    // ================= WISHLIST CORE =================

    private function getWishlist()
    {
        return session()->get('wishlist', []);
    }

    private function saveWishlist($wishlist)
    {
        session()->put('wishlist', $wishlist);
    }

    private function wishlistCount($wishlist)
    {
        return collect($wishlist)->count();
    }

    public function __construct()
    {
        view()->share('wishlist', session()->get('wishlist', []));
        view()->share('wishlistCount', collect(session()->get('wishlist', []))->count());
    }

    public function addToWishlist(Request $request)
    {
        $wishlist = $this->getWishlist();
        $id = $request->id;

        if (!isset($wishlist[$id])) {
            $wishlist[$id] = [
                'id' => $id,
                'name' => $request->name,
                'price' => $request->price,
                'old_price' => $request->old_price,
                'image' => $request->image,
            ];
        }

        $this->saveWishlist($wishlist);

        return back()->with('success', 'Added to wishlist');
    }

    public function removeFromWishlist($id)
    {
        $wishlist = $this->getWishlist();

        if (isset($wishlist[$id])) {
            unset($wishlist[$id]);
        }

        $this->saveWishlist($wishlist);

        return back();
    }

    public function moveWishlistToCart($id)
    {
        $wishlist = $this->getWishlist();
        $cart = $this->getCart();

        if (isset($wishlist[$id])) {

            $item = $wishlist[$id];

            // add to cart (same logic as addToCart)
            if (isset($cart[$id])) {
                $cart[$id]['qty'] += 1;
            } else {
                $cart[$id] = [
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'old_price' => $item['old_price'],
                    'image' => $item['image'],
                    'qty' => 1
                ];
            }

            unset($wishlist[$id]);
        }

        $this->saveCart($cart);
        $this->saveWishlist($wishlist);

        return back()->with('success', 'Moved to cart');
    }

    public function moveAllWishlistToCart()
    {
        $wishlist = $this->getWishlist();
        $cart = $this->getCart();

        foreach ($wishlist as $id => $item) {

            if (isset($cart[$id])) {
                $cart[$id]['qty'] += 1;
            } else {
                $cart[$id] = [
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'old_price' => $item['old_price'],
                    'image' => $item['image'],
                    'qty' => 1
                ];
            }
        }

        // empty wishlist
        session()->forget('wishlist');

        $this->saveCart($cart);

        return back()->with('success', 'All wishlist items moved to cart');
    }

    public function applyPromo(Request $request)
    {
        // Rebuild user array using old submitted form input data
        $user = [
            'first_name' => $request->input('first_name'),
            'last_name'  => $request->input('last_name'),
            'email'      => $request->input('email'),
            'phone'      => $request->input('phone'),
            'address'    => $request->input('address'),
            'county'     => $request->input('county'),
            'town'       => $request->input('town'),
            'notes'      => $request->input('notes'),
        ];

        $promoCode = $request->input('promo_code', '');
        $totals = $this->calculateCartTotals($promoCode);

        // Flash data to input state so old() helper preserves inputs on return
        $request->flash();

        return view('frontend.pages.cart', array_merge(['user' => $user], $totals));
    }

    // Update your checkout tracking process

    public function checkoutProcess(Request $request)
    {
        $promoCode = $request->input('promo_code', '');
        $totals = $this->calculateCartTotals($promoCode);

        // Compile everything into a unified array
        $orderSummaryData = [
            'shipping_information' => $request->only(['first_name', 'last_name', 'email', 'phone', 'address', 'county', 'town', 'notes']),
            'cart_items'           => $totals['cartItems'],
            'subtotal'             => $totals['subtotal'],
            'shipping_fee'         => $totals['shippingFee'],
            'discount_applied'     => $totals['discountAmount'],
            'net_total'            => $totals['net_total'] ?? $totals['total'], // Fallback if keys mismatch
            'promo_used'           => $totals['appliedPromo'] ? $totals['appliedPromo']['code'] : null,
        ];

        // Put the data into the session safely
        session(['pending_order' => $orderSummaryData]);

        // REDIRECT to the secure GET payment view route
        return redirect()->route('checkout.payment');
    }

    // 2. Safely render the payment page (Refreshable via GET)
    public function paymentPage()
    {
        // Pull data from session
        $orderSummaryData = session('pending_order');

        // If the user directly types the URL or session expires, send them back to shop/cart safely
        if (!$orderSummaryData) {
            return redirect()->route('shop')->with('error', 'Your checkout session has expired. Please try again.');
        }

        // Return your isolated layout file
        return view('frontend.pages.payment', compact('orderSummaryData'));
    }

    // Add this new method to handle the final chosen payment submission
    public function paymentSubmit(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:mpesa,card,airtel,cod',
            'mpesa_phone'    => 'required_if:payment_method,mpesa',
        ]);

        $orderSummaryData = session('pending_order');

        if (!$orderSummaryData) {
            return redirect()->route('shop')
                ->with('error', 'Your session expired. Please try again.');
        }

        $paymentMethod = $request->payment_method;

        /*
    |--------------------------------------------------------------------------
    | PAY ON DELIVERY
    |--------------------------------------------------------------------------
    */

        if ($paymentMethod === 'cod') {

            // ONLY SHIPPING FEE IS PAID NOW
            $shippingFee = $orderSummaryData['shipping_fee'];

            // MOCK ORDER STORAGE
            $orders = session()->get('customer_orders', []);

            $orders[] = [
                'order_number' => 'ORD-' . rand(100000, 999999),
                'status' => 'Pending Delivery Payment',
                'payment_method' => 'Pay on Delivery',

                'payment_status' => 'pending',
                'delivery_status' => 'processing',
                'invoice_number' => 'INV-' . rand(10000, 99999),

                'shipping_paid' => $shippingFee,
                'amount_due_on_delivery' => $orderSummaryData['net_total'] - $shippingFee,
                'total_order_amount' => $orderSummaryData['net_total'],
                'created_at' => now()->format('d M Y H:i'),
                'items' => $orderSummaryData['cart_items'],

                'customer_note' => $orderSummaryData['shipping_information']['notes'] ?? null,
            ];

            session()->put('customer_orders', $orders);

            // CLEAR CART
            session()->forget('cart');
            session()->forget('pending_order');

            return redirect()->route('customer.account')
                ->with('success', 'Order placed successfully. Pay remaining balance after delivery.');
        }

        /*
    |--------------------------------------------------------------------------
    | MPESA
    |--------------------------------------------------------------------------
    */

        if ($paymentMethod === 'mpesa') {

            $phone = $request->mpesa_phone;

            // STK PUSH WILL COME HERE
        }

        /*
    |--------------------------------------------------------------------------
    | CARD / AIRTEL MOCK
    |--------------------------------------------------------------------------
    */

        $orders = session()->get('customer_orders', []);

        $orders[] = [
            'order_number' => 'ORD-' . rand(100000, 999999),
            'status' => 'Paid',
            'payment_method' => strtoupper($paymentMethod),

            'payment_status' => 'paid',
            'delivery_status' => 'processing',
            'invoice_number' => 'INV-' . rand(10000, 99999),

            'total_order_amount' => $orderSummaryData['net_total'],
            'created_at' => now()->format('d M Y H:i'),
            'items' => $orderSummaryData['cart_items'],
            'shipping_information' => $orderSummaryData['shipping_information'],
            'customer_note' => $orderSummaryData['shipping_information']['notes'] ?? null,
        ];

        session()->put('customer_orders', $orders);

        session()->forget('cart');
        session()->forget('pending_order');

        return redirect()->route('customer.account')
            ->with('success', 'Payment completed successfully.');
    }

}