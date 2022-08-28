<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;

class DashboardProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.shop.products.create', [
            'shop' => Shop::where('user_id', auth()->user()->id)->firstOrFail(),
            'categories' => ProductCategory::latest()->get(),
        ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:256',
            'desc' => 'required',
            'weight' => 'required|integer|min:0',
            'price' => 'required',
            'condition' => 'required|integer',
            'stock' => 'required|integer',
            'catalog_id' => 'required|integer',
            'sub_category_id' => 'required|integer',
        ]);

        $validated['shop_id'] = Shop::where('user_id', auth()->user()->id)->sum('user_id');
        $validated['slug'] = Str::of($validated['name'])->slug();
        $validated['sold'] = 0;

        Product::create($validated);

        return redirect()->to('/dashboard/shop')->with('alert', 'Produk Berhasil Ditambahkan!');
    }


    public function show()
    {
        return back();
    }


    public function edit(Product $product)
    {
        return view('dashboard.shop.products.edit', [
            'product' => $product,
            'shop' => Shop::where('user_id', auth()->user()->id)->firstOrFail(),
            'categories' => ProductCategory::latest()->get(),
        ]);
    }


    public function update(Request $request, Product $product)
    {
        $valid = $request->validate([
            'name' => 'required|max:256',
            'desc' => 'required',
            'weight' => 'required|integer|min:0',
            'price' => 'required',
            'condition' => 'required|integer',
            'stock' => 'required|integer',
            'catalog_id' => 'required|integer',
            'sub_category_id' => 'required|integer',
        ]);

        $product->update($valid);

        return redirect()->to('/dashboard/shop')->with('alert', "Updated: $product->name");
    }

    public function destroy(Product $product)
    {
        $alert = "Deleted: $product->name";
        $product->delete();

        return back()->with('alert', $alert);
    }

    public function snap()
    {
        DB::table('products')->where('shop_id', auth()->user()->id)->delete();

        return redirect()->back()->with('alert', 'Deleted All Products');
    }
}