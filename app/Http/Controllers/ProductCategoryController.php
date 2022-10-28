<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Http\Controllers\Controller;

class ProductCategoryController extends Controller
{
    public function index()
    {
        return view('category.index', [
            'title' => 'Category List',
            'categories' => ProductCategory::all()
        ]);
    }

    public function show(ProductCategory $category, ProductSubCategory $sub_category)
    {
        return view('category.show', [
            'title' => $sub_category->name . `'s Products`,
            'categories' => ProductCategory::all(),
            'sub_category' => $sub_category
        ]);
    }

    public function store(Request $request)
    {
        $valid = $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string|unique:product_categories',
            'desc' => 'max:2000'
        ]);

        ProductCategory::create($valid);

        return response('success', 200);
    }

    public function subcategory_store(Request $request)
    {
        $valid = $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|integer',
            'slug' => 'required|string|unique:product_categories',
            'desc' => 'max:2000'
        ]);

        ProductSubCategory::create($valid);

        return response('success', 200);
    }
}