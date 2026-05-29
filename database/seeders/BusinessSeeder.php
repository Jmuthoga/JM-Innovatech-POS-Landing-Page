<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Business;

class BusinessSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'Supermarkets',
                'image' => 'https://images.unsplash.com/photo-1542838132-92c53300491e',
                'description' => 'Manage busy retail checkouts smoothly with fast barcode scanning, digital weighing scale integration, and live multi-till data synchronization.',
                'features' => ['Scale Integration', 'Multi-Till Sync', 'Wholesale Pricing', 'Loyalty Points', 'eTIMS Invoicing', 'Cashier Shift Audit']
            ],
            [
                'name' => 'Boutiques',
                'image' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8',
                'description' => 'Track fashion apparel inventory across complex sizes and color variants while monitoring retail staff sales commission structures automatically.',
                'features' => ['Size Matrix', 'Color Tracking', 'Custom Barcodes', 'Staff Commission Control', 'Return Management']
            ],
            [
                'name' => 'Pharmacies',
                'image' => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef',
                'description' => 'Secure sensitive medical retail workflows using batch tracking tools, prescription logging systems, and instant automated drug expiry notifications.',
                'features' => ['Expiry Alerts', 'Batch Tracking', 'Prescription Logs', 'M-Pesa STK Push', 'Supplier Reorder Sheets', 'Generic Drug Matching', 'B2C Refund Portal']
            ],
            [
                'name' => 'Hardware Stores',
                'image' => 'https://images.unsplash.com/photo-1581781894097-4130f89d493a',
                'description' => 'Handle heavy building material inventory using fractional units, professional client quotation tools, and detailed customer credit ledgers.',
                'features' => ['Fractional Sales', 'Quotation System', 'Stock Locations', 'Credit Ledger Accounts']
            ],
            [
                'name' => 'Restaurants',
                'image' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5',
                'description' => 'Optimize food hospitality services via interactive floor table maps, split-billing checkouts, and direct kitchen display screen order routing.',
                'features' => ['Kitchen Display Routing', 'Table Mapping', 'Split Billing', 'Recipe Ingredient Deductions', 'Tips Management']
            ],
            [
                'name' => 'Wines & Spirits',
                'image' => 'https://images.unsplash.com/photo-1510812431401-41d2bd2722f3',
                'description' => 'Monitor bulk liquor inventory down to crates, individual bottles, or counter shots while enforcing secure midnight cash audits.',
                'features' => ['Crate Tracking', 'Bottle Control', 'Night Audit Reports', 'Fast Barcode Scan', 'Loss Analytics System']
            ],
            [
                'name' => 'Agrovet Stores',
                'image' => 'https://images.unsplash.com/photo-1595855759920-86582396756a',
                'description' => 'Control chemical inventory codes, seasonal purchase trends, and feed scale weights while keeping transparent local farmer credit ledgers.',
                'features' => ['Feed Scaling Sync', 'Credit Ledger Accounts', 'Batch Control', 'Seasonal Trend Analytics', 'Reorder Alerts', 'KRA Tax Logs']
            ],
            [
                'name' => 'Cosmetics Stores',
                'image' => 'https://images.unsplash.com/photo-1596462502278-27bfdc403348',
                'description' => 'Maximize salon retail profit margins using smart product promotional bundling and automated beauty advisory commission calculation trackers.',
                'features' => ['Product Bundling', 'Staff Commission Tracking', 'Brand Analytics Tracker', 'SMS Promotion Broadcasts']
            ],
            [
                'name' => 'Salons & Spas',
                'image' => 'https://images.unsplash.com/photo-1560066984-138dadb4c035',
                'description' => 'Streamline styling salon bookings, track dynamic internal therapist service commissions, and audit precise chemical material backbar usage metrics.',
                'features' => ['Booking Engine', 'Therapist Commission', 'Material Consumption Tracking', 'Client History Cards']
            ],
            [
                'name' => 'Dry Cleaners',
                'image' => 'https://images.unsplash.com/photo-1545173168-9f18c821997a',
                'description' => 'Track laundry production items through sorting, washing, and iron racks while pushing automated SMS garment collection notifications.',
                'features' => ['Garment Tagging', 'SMS Alerts System', 'Rack Location Logs', 'Partial Payment Triggers']
            ],
            [
                'name' => 'Furniture Showrooms',
                'image' => 'https://images.unsplash.com/photo-1524758631624-e2822e304c36',
                'description' => 'Manage multi-stage customer layby payment deposits, track workshop production assembly costs, and generate structural home delivery logs.',
                'features' => ['Layby Management', 'Workshop Costing', 'Delivery Dispatch Logs', 'Custom Order Specifications', 'Installment Tracking']
            ],
            [
                'name' => 'Cyber Cafes',
                'image' => 'https://images.unsplash.com/photo-1562774053-401386d615f6',
                'description' => 'Control computer terminal user access times, track counter printing volumes accurately, and automate fast evening cashier sales reconciliations.',
                'features' => ['Time Billing Controller', 'Print Counter Tracking', 'Shift Cash Audit']
            ],
            [
                'name' => 'Movie Shops',
                'image' => 'https://images.unsplash.com/photo-1536440136628-849c177e76a1',
                'description' => 'Catalg large entertainment collections instantly, run multi-episode series package discounts, and balance quick daily terminal cash shift summaries.',
                'features' => ['Series Bundling Rules', 'Media Catalog System', 'Cashier Shift Reporting']
            ],
            [
                'name' => 'Gas Stations',
                'image' => 'https://images.unsplash.com/photo-1527018601619-a508a2be00cd',
                'description' => 'Monitor underground bulk fuel levels, sync pump nozzle meters with register screens, and reconcile mixed card payment types.',
                'features' => ['Fuel Tank Dipping', 'Pump Meter Interface', 'Attendant Shift Tracking', 'Fleet Card Portal']
            ],
            [
                'name' => 'Gyms & Fitness Centers',
                'image' => 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48',
                'description' => 'Process member subscription renewals, run front-desk biometric entry check-ins, and track secondary protein supplement point of sale merchandise.',
                'features' => ['Subscription Billing', 'Biometric Gate Link', 'Supplement Retail Module', 'Trainer Scheduling']
            ],
            [
                'name' => 'Pet & Vet Shops',
                'image' => 'https://images.unsplash.com/photo-1583337130417-3346a1be7dee',
                'description' => 'Track clinical animal supplement batches, weigh loose premium pet kibble, and receive early shelf expiration warning popups.',
                'features' => ['Loose Feed Scaling', 'Pet Medical Records', 'Batch Expiry Warnings']
            ],
            [
                'name' => 'Jewelry Stores',
                'image' => 'https://images.unsplash.com/photo-1515562141207-7a88fb7ce338',
                'description' => 'Secure precious metal assets using precision unique serialization tracking, tag items by weight, and manage customer trade-in valuations.',
                'features' => ['Precious Metal Pricing', 'Item Serialization', 'Repair Job Sheets', 'Trade-In Evaluation Logs']
            ],
            [
                'name' => 'Electrical Supplies',
                'image' => 'https://images.unsplash.com/photo-1558346490-a72e53ae2d4f',
                'description' => 'Track cable roll cutting measurements, manage wholesale multi-tier electrical pricing options, and handle building site supplier refund accounts.',
                'features' => ['Cable Meter Cutting', 'Wholesale Price Matrix', 'Project Order Logs', 'Supplier Refund Tracker', 'eTIMS Invoicing Core']
            ],
            [
                'name' => 'Bakeries',
                'image' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff',
                'description' => 'Deduct raw pastry ingredients automatically upon checkout, monitor custom design cake orders, and log daily kitchen waste items.',
                'features' => ['Material Deduction', 'Order Tracker', 'Waste Logs']
            ],
            [
                'name' => 'Butcheries',
                'image' => 'https://images.unsplash.com/photo-1602173574767-37ac01994b2a',
                'description' => 'Connect point of sale software directly to carcass hanging scales to calculate exact meat weights and deboning loss.',
                'features' => ['Weight Sync', 'Trim Loss Tracking', 'Cold Room Alerts', 'Wholesale Bulk Breakdown', 'Supplier Ledger Control']
            ],
            [
                'name' => 'Electronics Shops',
                'image' => 'https://images.unsplash.com/photo-1546868871-7041f2a55e12',
                'description' => 'Protect high-value electronic gadgets by tracking unique product IMEI numbers, processing repair deposits, and printing clear warranty logs.',
                'features' => ['IMEI Tracking', 'Warranty Logs', 'Repair History', 'Serial Number Auditing', 'Deposit Tracking System', 'Supplier Return Ledger']
            ],
            [
                'name' => 'Auto Spares',
                'image' => 'https://images.unsplash.com/photo-1486006920555-c77dce18193b',
                'description' => 'Organize extensive spare part shelves by searching vehicle model compatibility, printing bin tags, and issuing mechanic reward points.',
                'features' => ['Model Matching', 'Shelf Tags', 'Mechanic Rewards', 'Wholesale Price Tiers']
            ],
            [
                'name' => 'Bookshops',
                'image' => 'https://images.unsplash.com/photo-1526243128144-62b40c982642',
                'description' => 'Accelerate back-to-school checkout rushes using rapid book ISBN scanning alongside pre-configured wholesale stationery package bundle pricing structures.',
                'features' => ['ISBN Scan', 'Bundle Building', 'Inventory Control', 'Back-to-School Pricing Tiers']
            ],
            [
                'name' => 'LPG Gas Retailers',
                'image' => 'https://images.unsplash.com/photo-1527018601619-a508a2be00cd',
                'description' => 'Track empty gas cylinder pool deposits, manage local dispatch delivery drivers, and reconcile incoming mobile M-Pesa business payments.',
                'features' => ['Cylinder Deposit Tracking', 'Delivery Driver Logs', 'Weight Check Auditing']
            ],
            [
                'name' => 'Water Stations',
                'image' => 'https://images.unsplash.com/photo-1523362628745-0c100150b504',
                'description' => 'Verify water refill liters sold against mechanical flow meters while managing reusable bottle returns and customer prepaid digital wallets.',
                'features' => ['Liter Tracking', 'Bottle Returns', 'Meter Logs', 'Pre-Paid Client Wallets', 'Branch Tally Sync']
            ]
        ];

        foreach ($data as $item) {
            Business::create($item);
        }
    }
}