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

    public function cart()
    {
        // Dummy cart data (later replace with session/database cart)
        $cartItems = [
            [
                'id' => 1,
                'name' => 'Barcode Scanner',
                'brand' => 'Honeywell Voyager',
                'image' => asset('assets/images/pos.png'),
                'price' => 4500,
                'old_price' => 5300,
                'qty' => 1,
            ],
            [
                'id' => 2,
                'name' => 'POS Thermal Printer',
                'brand' => 'Epson TM-T20III',
                'image' => asset('assets/images/poster.png'),
                'price' => 12000,
                'old_price' => 15000,
                'qty' => 1,
            ],
            [
                'id' => 3,
                'name' => 'Cash Money Drawer',
                'brand' => 'Heavy Duty POS Drawer',
                'image' => asset('assets/images/pos.png'),
                'price' => 8500,
                'old_price' => 10000,
                'qty' => 1,
            ],
        ];

        return view('frontend.pages.cart', compact('cartItems'));
    }
}