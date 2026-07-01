<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index()
    {
        return view('backend.product.index');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::with(['category', 'brand'])->latest();

            return DataTables::of($products)
                ->addIndexColumn()
                ->editColumn('image', function ($row) {
                    $url = $row->image
                        ? asset('storage/' . $row->image)
                        : asset('images/no-image.png');

                    return '<img src="'.$url.'" width="60" class="img-thumbnail">';
                })
                ->addColumn('prices', function ($row) {
                    $price = '<strong>Ksh.'.number_format($row->new_price, 2).'</strong>';

                    if ($row->old_price) {
                        $price .= '<br><small class="text-decoration-line-through text-danger">Ksh.'
                            .number_format($row->old_price, 2).
                            '</small>';
                    }

                    return $price;
                })
                ->addColumn('badges', function ($row) {
                    $html = '';

                    if ($row->is_hot_deal) {
                        $html .= '<span class="badge bg-danger me-1">Hot</span>';
                    }
                    if ($row->is_pos_equipment) {
                        $html .= '<span class="badge bg-primary me-1">POS</span>';
                    }
                    if ($row->is_supply_item) {
                        $html .= '<span class="badge bg-warning text-dark me-1">Supply</span>';
                    }
                    if ($row->is_toner) {
                        $html .= '<span class="badge bg-dark">Toner</span>';
                    }

                    return $html ?: 'NULL';
                })
                ->addColumn('action', function ($row) {
                    return '
                        <a href="'.route('admin.products.edit', $row->id).'" class="btn btn-primary btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="'.route('admin.products.destroy', $row->id).'" method="POST" style="display:inline-block">
                            '.csrf_field().'
                            '.method_field('DELETE').'
                            <button class="btn btn-danger btn-sm" onclick="return confirm(\'Delete this product?\')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    ';
                })
                ->rawColumns(['image', 'prices', 'badges', 'action'])
                ->make(true);
        }
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('backend.product.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'category_id'   => 'required|exists:categories,id',
            'brand_id'      => 'nullable|exists:brands,id',
            'new_price'     => 'required|numeric|min:0',
            'old_price'     => 'nullable|numeric|min:0',
            'stock'         => 'required|integer|min:0',
            'image'         => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'thumbnails.*'  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        if ($request->hasFile('thumbnails')) {
            $thumbs = [];
            foreach ($request->file('thumbnails') as $file) {
                $thumbs[] = $file->store('products/thumbnails', 'public');
            }
            $data['thumbnails'] = json_encode($thumbs);
        }

        $data['variants'] = $request->variants ? json_encode($request->variants) : null;
        $data['is_hot_deal']      = $request->has('is_hot_deal');
        $data['is_pos_equipment'] = $request->has('is_pos_equipment');
        $data['is_supply_item']   = $request->has('is_supply_item');
        $data['is_toner']         = $request->has('is_toner');

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('backend.product.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'category_id'   => 'required|exists:categories,id',
            'brand_id'      => 'nullable|exists:brands,id',
            'new_price'     => 'required|numeric|min:0',
            'old_price'     => 'nullable|numeric|min:0',
            'stock'         => 'required|integer|min:0',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'thumbnails.*'  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        if ($request->hasFile('thumbnails')) {
            $thumbs = [];
            foreach ($request->file('thumbnails') as $file) {
                $thumbs[] = $file->store('products/thumbnails', 'public');
            }
            $data['thumbnails'] = json_encode($thumbs);
        }

        $data['variants'] = $request->variants ? json_encode($request->variants) : null;
        $data['is_hot_deal']      = $request->has('is_hot_deal');
        $data['is_pos_equipment'] = $request->has('is_pos_equipment');
        $data['is_supply_item']   = $request->has('is_supply_item');
        $data['is_toner']         = $request->has('is_toner');

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}