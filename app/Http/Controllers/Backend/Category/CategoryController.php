<?php

namespace App\Http\Controllers\Backend\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        return view('backend.category.index');
    }

    // AJAX Data Source for DataTables
    public function getData(Request $request)
    {
        $categories = Category::select(['id', 'name', 'slug', 'created_at']);

        return datatables()->of($categories)
            ->editColumn('created_at', function ($row) {
                return $row->created_at ? $row->created_at->format('Y-m-d H:i') : '-';
            })
            ->addColumn('action', function ($row) {
                return '
                    <div class="d-flex gap-1">
                        <a href="' . route('categories.edit', $row->id) . '" class="btn btn-sm btn-primary">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="' . route('categories.destroy', $row->id) . '" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this category? All linked products will be deleted as well.\')">
                            ' . csrf_field() . ' ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return view('backend.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        return view('backend.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        // Based on your product migration schema rule `onDelete('cascade')`,
        // deleting a category will automatically remove its associated products.
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}