<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(Shop $shop, Product $product, ProductCategory $category)
    {
        $top_on_category = ProductCategory::find(mt_rand(1, $category->count()));
        return view('home', [
            'top_shops' => $shop->all(),
            'newest_products' => $product->latest()->visibility('public')->get(),
            'top_on_category' => $top_on_category ? $top_on_category->subcategory->first() : null,
            'best_seller' => $product->orderBy('sold', 'desc')->visibility('public')->get()
        ]);
    }

    public function searchProducts(Request $request)
    {
        // $products = Product::order()->search($request->search)->visibility('public')->get();
        // $products = $products->count() ? $products : Product::latest()->get();
        return view('search', [
            'title' => 'Semua Produk',
            'products' => Product::filters(request()->all())->query(request('search'))->visibility('public')->get(),
            'others' => Product::visibility('public')->get(),
            'store_location' => Shop::all()->pluck('location'),
        ]);
    }

    public function searchShops(Request $request)
    {
        $shops = Shop::latest()->search($request->search)->get();
        // $shops = $shops->count() ? $shops : Product::latest()->get();
        return view('search', [
            'title' => 'Cari Toko',
            'shops' => $shops,
            'store_location' => Shop::all()->pluck('location'),
        ]);
    }
}