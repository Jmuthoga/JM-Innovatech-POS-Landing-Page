<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\Product;
use App\Models\PromoCode;

class DatabaseRealDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Sliders
        $sliders = [
            ['title' => 'Order POS Hardware Now', 'desc' => 'Get high-quality POS machines delivered fast across Kenya.', 'image' => 'assets/images/poster.png'],
            ['title' => 'Get Starlink Internet', 'desc' => 'Fast, reliable satellite internet for your business anywhere in Kenya.', 'image' => 'assets/images/starlink.webp'],
            ['title' => 'ETIMS Devices Ready', 'desc' => 'Compliant eTIMS solutions for seamless tax integration.', 'image' => 'assets/images/etims.jpg']
        ];
        foreach ($sliders as $s) Slider::create($s);

        // 2. Seed Categories
        $categories = ['POS Systems', 'POS Accessories', 'Barcode Scanners', 'Receipt Printers', 'Cash Drawers', 'ETIMS Devices', 'Starlink Setup', 'Networking Equipment', 'Software Licenses', 'Refurbished Tech', 'Printers', 'Supplies', 'Toners', 'Thermal Printers'];
        $catModels = [];
        foreach ($categories as $cat) {
            $catModels[$cat] = Category::create(['name' => $cat]);
        }

        // 3. Seed Brands
        $brands = ['HP', 'Epson', 'Zebra', 'Honeywell', 'Canon'];
        $brandModels = [];
        foreach ($brands as $brand) {
            $brandModels[$brand] = Brand::create(['name' => $brand]);
        }

        // 4. Seed Promo Codes
        PromoCode::create(['code' => 'JMTECH10', 'type' => 'percentage', 'discount' => 10]);
        PromoCode::create(['code' => 'FREE500', 'type' => 'fixed', 'discount' => 500]);

        // 5. Seed Products (ALL HOMEPAGE SECTIONS)

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

        foreach ($hotNames as $name) {
            Product::create([
                'category_id' => $catModels['Refurbished Tech']->id,
                'name' => $name,
                'new_price' => rand(28000, 90000),
                'old_price' => rand(95000, 120000),
                'image' => 'assets/images/poster.png',
                'is_hot_deal' => true,
                'stock' => rand(5, 20)
            ]);
        }


        // ================= POS EQUIPMENT =================
        for ($i = 1; $i <= 12; $i++) {
            Product::create([
                'category_id' => $catModels['POS Systems']->id,
                'name' => 'POS Equipment ' . $i,
                'new_price' => rand(8000, 40000),
                'old_price' => rand(45000, 70000),
                'image' => 'assets/images/pos.png',
                'is_pos_equipment' => true,
                'stock' => rand(5, 30)
            ]);
        }


        // ================= PRINTERS =================
        for ($i = 1; $i <= 10; $i++) {
            Product::create([
                'category_id' => $catModels['Printers']->id,
                'brand_id' => $brandModels[array_rand($brandModels)]->id,
                'name' => 'Printer Model ' . $i,
                'new_price' => rand(12000, 35000),
                'old_price' => rand(40000, 50000),
                'image' => 'assets/images/starlink.webp',
                'features' => 'Fast thermal printing technology',
                'stock' => rand(5, 25)
            ]);
        }


        // ================= SUPPLIES =================
        for ($i = 1; $i <= 12; $i++) {
            Product::create([
                'category_id' => $catModels['Supplies']->id,
                'name' => 'Paper Roll ' . $i,
                'new_price' => rand(200, 800),
                'old_price' => rand(900, 1500),
                'image' => 'assets/images/poster.png',
                'features' => 'High quality thermal paper rolls',
                'is_supply_item' => true,
                'stock' => rand(50, 200)
            ]);
        }


        // ================= TONERS =================
        for ($i = 1; $i <= 10; $i++) {
            Product::create([
                'category_id' => $catModels['Toners']->id,
                'brand_id' => $brandModels[array_rand($brandModels)]->id,
                'name' => 'Toner Cartridge ' . $i,
                'new_price' => rand(2500, 9000),
                'old_price' => rand(10000, 15000),
                'image' => 'assets/images/pos.png',
                'features' => 'Original & compatible toner cartridge',
                'is_toner' => true,
                'stock' => rand(10, 60)
            ]);
        }

        // Mass seed loop for general / shop view products (60 items)
        $shopCategories = ['POS Systems', 'Thermal Printers', 'Barcode Scanners', 'Cash Drawers'];
        $shopBrands = ['HP', 'Epson', 'Zebra', 'Honeywell'];
        for ($i = 1; $i <= 60; $i++) {
            $cName = $shopCategories[array_rand($shopCategories)];
            $bName = $shopBrands[array_rand($shopBrands)];

            Product::create([
                'category_id' => $catModels[$cName]->id,
                'brand_id' => $brandModels[$bName]->id,
                'name' => 'POS Terminal Pro Gen ' . $i,
                'new_price' => rand(15000, 45000),
                'old_price' => rand(46000, 55000),
                'image' => 'assets/images/pos.png',
                'description' => 'High quality POS system suitable for retail environments.',
                'stock' => rand(3, 40),
                'thumbnails' => ['assets/images/poster.png', 'assets/images/pos.png'],
                'variants' => [
                    ['name' => 'Midnight Black', 'color' => '#1e293b'],
                    ['name' => 'Silver Mist', 'color' => '#e2e8f0']
                ],
                'flash_sale_ends' => now()->addHours(rand(3, 24))
            ]);
        }
    }
}
