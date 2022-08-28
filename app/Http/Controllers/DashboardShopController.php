<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;

class DashboardShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Shop $shop, Product $product)
    {
        return view('dashboard.shop.index', [
            'user' => auth()->user(),
            'shop' => $shop->find(auth()->user()->id)
        ]);
    }


    public function destroy(Shop $shop)
    {
        return true;
    }
}