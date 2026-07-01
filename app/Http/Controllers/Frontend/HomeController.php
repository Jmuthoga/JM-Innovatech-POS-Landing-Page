<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\Product;
use App\Models\PromoCode;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $cart = session()->get('cart', []);
        $wishlist = session()->get('wishlist', []);

        $categoriesList = Category::orderBy('name')->pluck('name')->all();

        view()->share([
            'miniCart' => $cart,
            'miniCartCount' => collect($cart)->sum('qty'),
            'miniSubtotal' => collect($cart)->sum(fn($i) => $i['price'] * $i['qty']),

            'wishlist' => $wishlist,
            'wishlistCount' => count($wishlist),

            'categoriesList' => $categoriesList, 
        ]);
    }

    public function index()
    {
        $categories = Category::pluck('name')->all();
        $sliders = Slider::all()->map(function($slider) {
            return [
                'title' => $slider->title,
                'desc' => $slider->desc,
                'btn_text' => $slider->btn_text,
                'btn_link' => $slider->btn_link === 'route(shop)' ? route('shop') : $slider->btn_link,
                'image' => asset($slider->image)
            ];
        })->toArray();

        // Query segments structured via Database flags
        $hotDeals = Product::where('is_hot_deal', true)->take(8)->get()->map(fn($p) => $this->transformProduct($p));
        $posEquipment = Product::where('is_pos_equipment', true)->take(12)->get()->map(fn($p) => $this->transformProduct($p));
        $printers = Product::whereHas('category', fn($q) => $q->where('name', 'Printers'))->take(8)->get()->map(fn($p) => $this->transformProduct($p));
        $supplies = Product::where('is_supply_item', true)->take(12)->get()->map(fn($p) => $this->transformProduct($p));
        $toners = Product::where('is_toner', true)->take(8)->get()->map(fn($p) => $this->transformProduct($p));

        return view('frontend.home', compact('categories', 'sliders', 'hotDeals', 'posEquipment', 'printers', 'supplies', 'toners'));
    }

    public function shop(Request $request)
    {
        $brandsList = Brand::pluck('name')->all();
        $categoriesList = Category::orderBy('name')->pluck('name')->all();
        $latestProducts = Category::with(['products' => function ($query) {
            $query->latest()->limit(1);
        }])
            ->orderBy('name')
            ->get()
            ->map(function ($category) {
                $product = $category->products->first();

                return $product ? $this->transformProduct($product) : null;
            })
            ->filter()
            ->values()
            ->toArray();


        $query = Product::with(['category', 'brand']);

        // Database-driven Filter Mechanics
        if ($request->filled('max_price')) {
            $query->where('new_price', '<=', $request->max_price);
        }
        if ($request->filled('brands')) {
            $query->whereHas('brand', fn($q) => $q->whereIn('name', $request->brands));
        }
        if ($request->filled('category')) {
            $query->whereHas('category', fn($q) => $q->where('name', $request->category));
        }
        if ($request->filled('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $allProducts = Product::with(['category', 'brand'])->get()->map(fn($p) => $this->transformProduct($p))->toArray();

        $currentGrid = $request->get('grid', 4);
        $perPage = ($currentGrid == 3) ? 21 : 20;

        // Native DB Pagination substitution
        $paginator = $query->paginate($perPage)->appends($request->all());
        $products = collect($paginator->items())->map(fn($p) => $this->transformProduct($p))->toArray();

        $totalPages = $paginator->lastPage();
        $currentPage = $paginator->currentPage();

        $categoryCounts = array_count_values(array_column($allProducts, 'category'));
        $brandCounts = array_count_values(array_column($allProducts, 'brand'));

        // Fixed compact syntax crash by passing explicit array maps to view layers
        return view('frontend.pages.shop', [
            'products'         => $products,
            'allProducts'      => $allProducts,
            'brandsList'       => $brandsList,
            'categoriesList'   => $categoriesList,
            'categoryCounts'   => $categoryCounts,
            'brandCounts'      => $brandCounts,
            'currentGrid'      => $currentGrid,
            'currentPage'      => $currentPage,
            'totalPages'       => $totalPages,
            'totalProducts'    => $paginator->total(), // Extracted directly from your existing $paginator
            'perPage'          => $perPage,            // Passed to calculate layout splits dynamically
            'maxPriceFilter'   => $request->get('max_price', 100000),
            'selectedBrands'   => $request->get('brands', []),
            'selectedCategory' => $request->get('category'),
            'latestProducts'   => $latestProducts,
        ]);
    }

    public function product($id)
    {
        $productModel = Product::with(['category', 'brand'])->findOrFail($id);

        $product = $this->transformProduct($productModel);

        $product['description'] = $productModel->description;
        $product['stock'] = $productModel->stock;

        $product['flash_sale_ends'] = $productModel->flash_sale_ends
            ? $productModel->flash_sale_ends->timestamp
            : null;

        // Convert JSON string to an array safely if it isn't already cast
        $thumbnailsArray = is_string($productModel->thumbnails) 
            ? json_decode($productModel->thumbnails, true) 
            : $productModel->thumbnails;

        $product['thumbnails'] = !empty($thumbnailsArray) && is_array($thumbnailsArray)
            ? array_map(fn($t) => asset('storage/' . $t), $thumbnailsArray)
            : [asset('storage/' . $productModel->image)];

        $product['variants'] = $productModel->variants ?? [
            [
                'name' => 'Default Black',
                'color' => '#000000'
            ]
        ];

        $discount = ($productModel->old_price > 0)
            ? round((($productModel->old_price - $productModel->new_price) / $productModel->old_price) * 100)
            : 0;

        $related_products = Product::where('id', '!=', $id)
            ->where('category_id', $productModel->category_id)
            ->take(16)
            ->get()
            ->map(fn($p) => [
                'name' => $p->name,
                'image' => asset($p->image),
                'new_price' => $p->new_price,
                'url' => route('product.show', $p->id)
            ])->toArray();

        return view('frontend.pages.product', compact('product', 'discount', 'related_products'));
    }

    private function transformProduct($p) {
        return [
            'id' => $p->id,
            'name' => $p->name,
            'category' => $p->category->name ?? 'Uncategorized',
            'brand' => $p->brand->name ?? 'Generic',
            'new_price' => $p->new_price,
            'old_price' => $p->old_price,
            'features' => $p->features,
            'image' => $p->image ? asset('storage/' . $p->image) : asset('images/no-image.png'),
        ];
    }

    private function calculateCartTotals($promoCode = '')
    {
        $shipping = ['standard_fee' => 250, 'free_shipping_minimum' => 50000];
        $cartItems = session()->get('cart', []);
        $subtotal = collect($cartItems)->sum(fn($i) => $i['price'] * $i['qty']);
        $shippingFee = ($subtotal >= $shipping['free_shipping_minimum']) ? 0 : $shipping['standard_fee'];

        $discountAmount = 0;
        $appliedPromo = null;
        $promoError = null;
        $promoCode = trim($promoCode);

        if ($promoCode !== '') {
            if (strlen($promoCode) > 12) {
                $promoError = "Promo code is too long.";
            } else {
                $matched = PromoCode::where('code', $promoCode)->first();
                if ($matched) {
                    $appliedPromo = $matched->toArray();
                    $discountAmount = $matched->type === 'percentage' 
                        ? ($subtotal * $matched->discount) / 100 
                        : $matched->discount;
                } else {
                    $promoError = "Invalid promo code.";
                }
            }
        }

        return [
            'cartItems' => $cartItems, 'shippingFee' => $shippingFee, 'subtotal' => $subtotal,
            'discountAmount' => $discountAmount, 'total' => max(($subtotal + $shippingFee) - $discountAmount, 0),
            'appliedPromo' => $appliedPromo, 'promoError' => $promoError
        ];
    }

    public function cart(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login first');
        }

        $user = auth()->user();

        return view('frontend.pages.cart', array_merge(
            ['user' => $user],
            $this->calculateCartTotals($request->input('promo_code', ''))
        ));
    }

    public function addToCart(Request $request)
    {
        $request->validate(['id' => 'required|exists:products,id']);
        
        // Secured pricing against client manipulation by looking up DB definitions directly
        $product = Product::findOrFail($request->id);
        $cart = session()->get('cart', []);
        $id = $product->id;

        if (isset($cart[$id])) {
            $cart[$id]['qty'] += 1;
        } else {
            $cart[$id] = [
                'id' => $id, 
                'name' => $product->name, 
                'price' => $product->new_price, 
                'old_price' => $product->old_price, 
                'image' => asset($product->image), 
                'qty' => 1
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }

    public function increaseCart($id) {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) $cart[$id]['qty']++;
        session()->put('cart', $cart);
        return back();
    }

    public function decreaseCart($id) {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['qty']--;
            if ($cart[$id]['qty'] <= 0) unset($cart[$id]);
        }
        session()->put('cart', $cart);
        return back();
    }

    public function removeFromCart($id) {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) { unset($cart[$id]); session()->put('cart', $cart); }
        return back();
    }

    // ================= WISHLIST =================
    public function addToWishlist(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $wishlist = session()->get('wishlist', []);

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

        session()->put('wishlist', $wishlist);

        return back()->with('success', 'Added to wishlist');
    }

    public function removeFromWishlist($id)
    {
        $wishlist = session()->get('wishlist', []);

        if (isset($wishlist[$id])) {
            unset($wishlist[$id]);
            session()->put('wishlist', $wishlist);
        }

        return back()->with('success', 'Removed from wishlist');
    }

    public function moveWishlistToCart($id)
    {
        $wishlist = session()->get('wishlist', []);
        $cart = session()->get('cart', []);

        if (isset($wishlist[$id])) {
            $item = $wishlist[$id];

            // Add to cart or increase qty
            if (isset($cart[$id])) {
                $cart[$id]['qty'] += 1;
            } else {
                $cart[$id] = [
                    'id' => $id,
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'old_price' => $item['old_price'],
                    'image' => $item['image'],
                    'qty' => 1
                ];
            }

            unset($wishlist[$id]);
        }

        session()->put('wishlist', $wishlist);
        session()->put('cart', $cart);

        return back()->with('success', 'Item moved to cart');
    }

    public function moveAllWishlistToCart()
    {
        $wishlist = session()->get('wishlist', []);
        $cart = session()->get('cart', []);

        foreach ($wishlist as $id => $item) {

            if (isset($cart[$id])) {
                $cart[$id]['qty'] += 1;
            } else {
                $cart[$id] = [
                    'id' => $id,
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'old_price' => $item['old_price'],
                    'image' => $item['image'],
                    'qty' => 1
                ];
            }
        }

        session()->put('cart', $cart);
        session()->forget('wishlist');

        return back()->with('success', 'Wishlist moved to cart');
    }

    public function applyPromo(Request $request)
    {
        $user = auth()->user(); // ADD THIS LINE

        $totals = $this->calculateCartTotals($request->input('promo_code', ''));

        $request->flash();

        return view('frontend.pages.cart', array_merge([
            'user' => $user
        ], $totals));
    }

    public function checkoutProcess(Request $request)
    {
        $totals = $this->calculateCartTotals($request->input('promo_code', ''));

        $user = auth()->user();

        session(['pending_order' => [
            'shipping_information' => [
                'shipping_name'    => $user->shipping_name,
                'shipping_email'   => $user->shipping_email,
                'shipping_phone'   => $user->shipping_phone,
                'shipping_address' => $user->shipping_address,
                'shipping_county'  => $user->shipping_county,
                'shipping_town'    => $user->shipping_town,
            ],

            'cart_items' => $totals['cartItems'],
            'subtotal' => $totals['subtotal'],
            'shipping_fee' => $totals['shippingFee'],
            'discount_applied' => $totals['discountAmount'],
            'net_total' => $totals['total'],
            'promo_used' => $totals['appliedPromo']['code'] ?? null,
        ]]);

        return redirect()->route('checkout.payment');
    }

    public function paymentPage()
    {
        $orderSummaryData = session('pending_order');

        if (!$orderSummaryData) {
            return redirect()->route('shop')
                ->with('error', 'Your checkout session has expired.');
        }

        // Normalize shipping data safely (prevents undefined indexes)
        $orderSummaryData['shipping_information'] = array_merge([
            'shipping_name'    => '',
            'shipping_email'   => '',
            'shipping_phone'   => '',
            'shipping_address' => '',
            'shipping_county'  => '',
            'shipping_town'    => '',
        ], $orderSummaryData['shipping_information'] ?? []);

        return view('frontend.pages.payment', compact('orderSummaryData'));
    }

    public function paymentSubmit(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:mpesa,card,airtel,cod',
            'mpesa_phone' => 'required_if:payment_method,mpesa',
        ]);

        $orderSummaryData = session('pending_order');

        if (!$orderSummaryData) {
            return redirect()->route('shop')
                ->with('error', 'Your session expired.');
        }

        $user = auth()->user();

        DB::transaction(function () use ($request, $orderSummaryData, $user) {

            $shipping = $orderSummaryData['shipping_information'] ?? [];
            $isCod = $request->payment_method === 'cod';

            /**
             * =====================================================
             *  STRONG FALLBACK SYSTEM (NO NULLS ALLOWED)
             * =====================================================
             */
            $firstName = $user->first_name ?? 'Customer';
            $lastName  = $user->last_name ?? '';
            $email     = $user->email ?? 'N/A';
            $phone     = $user->phone ?? 'N/A';

            $address   = $shipping['shipping_address'] ?? $user->shipping_address ?? 'N/A';
            $county    = $shipping['shipping_county'] ?? $user->shipping_county ?? 'N/A';
            $town      = $shipping['shipping_town'] ?? $user->shipping_town ?? 'N/A';

            $order = Order::create([

                'user_id' => $user->id,

                'order_number' => 'ORD-' . rand(100000, 999999),
                'invoice_number' => 'INV-' . rand(10000, 99999),

                'status' => $isCod ? 'Pending Delivery Payment' : 'Paid',
                'payment_method' => $request->payment_method,
                'payment_status' => $isCod ? 'pending' : 'paid',
                'delivery_status' => 'processing',

                'subtotal' => $orderSummaryData['subtotal'],
                'shipping_fee' => $orderSummaryData['shipping_fee'],
                'discount_applied' => $orderSummaryData['discount_applied'],
                'total_order_amount' => $orderSummaryData['net_total'],

                'shipping_paid' => $isCod
                    ? $orderSummaryData['shipping_fee']
                    : $orderSummaryData['net_total'],

                'amount_due_on_delivery' => $isCod
                    ? ($orderSummaryData['net_total'] - $orderSummaryData['shipping_fee'])
                    : 0,

                /**
                 * =====================================================
                 *  PERSONAL DETAILS (NEVER NULL)
                 * =====================================================
                 */
                'first_name' => $firstName,
                'last_name'  => $lastName,
                'email'      => $email,
                'phone'      => $phone,

                /**
                 * =====================================================
                 *  SHIPPING DETAILS (NEVER NULL)
                 * =====================================================
                 */
                'shipping_name' => $shipping['shipping_name'] ?? $firstName . ' ' . $lastName,
                'shipping_phone' => $shipping['shipping_phone'] ?? $phone,
                'shipping_email' => $shipping['shipping_email'] ?? $email,
                'shipping_address' => $address,
                'shipping_county' => $county,
                'shipping_town' => $town,

                'promo_used' => $orderSummaryData['promo_used'] ?? null,
            ]);

            /**
             * =========================
             * ORDER ITEMS
             * =========================
             */
            foreach ($orderSummaryData['cart_items'] as $item) {
                $order->items()->create([
                    'product_id' => $item['id'],
                    'name'       => $item['name'],
                    'price'      => $item['price'],
                    'qty'        => $item['qty'],
                    'image'      => $item['image'],
                ]);
            }
        });

        session()->forget(['cart', 'pending_order']);

        return redirect()
            ->route('customer.account')
            ->with('success', 'Order recorded into database successfully.');
    }
}