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
        return view('home', [
            'top_shops' => $shop->all(),
            'newest_products' => $product->latest()->visibility('public')->get(),
            'top_on_category' => $category->find(mt_rand(2, 3))->subcategory->first(),
            'best_seller' => $product->orderBy('sold', 'desc')->visibility('public')->get()
        ]);
    }

    public function searchProducts(Request $request)
    {
        $products = Product::latest()->search($request->search)->visibility('public')->get();
        // $products = $products->count() ? $products : Product::latest()->get();
        return view('search', [
            'title' => 'Semua Produk',
            'products' => $products,
            'others' => Product::oldest()->visibility('public')->get(),
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