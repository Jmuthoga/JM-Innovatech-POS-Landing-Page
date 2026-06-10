<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Business;
use App\Models\BusinessContact;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class PosSystemController extends Controller
{
    public function __construct()
    {
        $categoriesList = Category::orderBy('name')->pluck('name')->all();

        view()->share([
            'categoriesList' => $categoriesList,
        ]);
    }

    public function features()
    {
        $businesses = Business::latest()->paginate(10);

        $allSectors = Business::orderBy('name', 'asc')->get(['name']);

        return view('frontend.pos.features', compact('businesses', 'allSectors'));
    }
    // CONTACT FORM SAVE
    public function storeContact(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'sector' => 'nullable',
            'phone' => 'required'
        ]);

        BusinessContact::create([
            'name' => $request->name,
            'sector' => $request->sector,
            'phone' => $request->phone
        ]);

        return back()->with('success', 'Request submitted successfully!');
    }

    public function boot()
    {
        Paginator::useBootstrapFive();
    }

    // PRICING PAGE
    public function pricing()
    {
        // Fetch sectors just like you did in the features method
        $allSectors = Business::orderBy('name', 'asc')->get(['name']);

        return view('frontend.pos.pricing', compact('allSectors'));
    }

    // CUSTOMERS PAGE
    public function customers()
    {
        return view('frontend.pos.customers');
    }

    // ABOUT PAGE
    public function about()
    {
        return view('frontend.pos.about');
    }

    // SUPPORT PAGE
    public function support()
    {
        return view('frontend.pos.support');
    }

    // RETAIL POS PAGE
    public function retailPos()
    {
        return view('frontend.pos.retail-pos');
    }

    // INVENTORY MANAGEMENT PAGE
    public function inventoryManagement()
    {
        return view('frontend.pos.inventory-management');
    }

    // MULTI BRANCH PAGE
    public function multiBranch()
    {
        return view('frontend.pos.multi-branch');
    }

    // MPESA INTEGRATION
    public function mpesaIntegration()
    {
        return view('frontend.pos.mpesa-integration');
    }

    // ECOMMERCE INTEGRATION
    public function ecommerceIntegration()
    {
        return view('frontend.pos.ecommerce-integration');
    }

    // BARCODE SUPPORT
    public function barcodeSupport()
    {
        return view('frontend.pos.barcode-support');
    }

    // RECEIPT PRINTING
    public function receiptPrinting()
    {
        return view('frontend.pos.receipt-printing');
    }

    // LOYALTY SYSTEM
    public function loyaltySystem()
    {
        return view('frontend.pos.loyalty-system');
    }
}