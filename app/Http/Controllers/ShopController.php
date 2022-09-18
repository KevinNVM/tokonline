<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ShopCatalog;

class ShopController extends Controller
{
    public function all(Shop $shop, Request $request)
    {
        $data = [
            'title' => 'All Products',
            'shop' => $shop,
            'products' => Product::where('shop_id', $shop->id)->search($request->search)->orderBy('catalog_id', 'desc')->visibility('public')->get()
        ];

        if (request('orderBy') == 'latest') {
            $data['products'] = Product::where('shop_id', $shop->id)->latest()->visibility('public')->get();
        } elseif (request('orderBy') == 'oldest') {
            $data['products'] = Product::where('shop_id', $shop->id)->oldest()->visibility('public')->get();
        } elseif (request('orderBy') == 'best_selling') {
            $data['products'] = Product::where('shop_id', $shop->id)->best_selling()->visibility('public')->get();
        }

        return view('myshop.all', $data);
    }

    public function index(Shop $shop, Product $product)
    {
        return view('myshop.index', [
            'title' => $shop->name,
            'shop' => $shop,
            'catalogs' => $shop->catalog->all(),
            'products' => $product->where('shop_id', $shop->id)->latest()->visibility('public')->get(),
            'best_seller' => $product->where('shop_id', $shop->id)->orderBy('sold', 'desc')->visibility('public')->get(),
        ]);
    }

    public function show(Shop $shop, Product $product, Request $request)
    {
        try {
            $product = $shop->products->where('slug', $product->slug)->firstOrFail();
        } catch (\Illuminate\Support\ItemNotFoundException $e) {
            abort(404);
        }


        if (auth()->check()) {
            if (auth()->user()->username !== $product->shop->owner->username && !$product->visibility) return abort(403);
        } else if (!$product->visibility) return abort(403);
        return view('myshop.show', [
            'title' => $product->name,
            'product' => $product,
        ]);
    }

    public function catalog(Shop $shop, ShopCatalog $catalog)
    {
        return view('myshop.catalog', [
            'title' => $catalog->name,
            'shop' => $shop,
            'catalogs' => $catalog->where('shop_id', $shop->id)->get(),
            'selected' => $catalog
        ]);
    }
}