<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;

class UtilitiesController extends Controller
{
    public function index()
    {
        return abort(404);
    }

    public function autocomplete(Request $request)
    {
        if (!$request->ajax()) return abort(404);
        elseif (request()->token !== csrf_token()) return abort(404);
        else $products = Product::select('name', 'slug')->query($request->search)->visibility('public')->get()->pluck('name');

        $categories = ProductCategory::select('name', 'slug')->where('name', 'LIKE', '%' . $request->search . '%')->get()->pluck('name');

        $shops = Shop::select('name', 'url')->where('name', 'LIKE', '%' . $request->search . '%')->get()->pluck('name');

        if (!empty($products) || !empty($categories) || !empty($shops))
            return [
                'product' => Product::select('name', 'slug')->query($request->search)->visibility('public')->get()->pluck('name'),
                'category' => ProductCategory::select('name', 'slug')->where('name', 'LIKE', '%' . $request->search . '%')->get()->pluck('name'),
                'shop' => Shop::select('name', 'url')->where('name', 'LIKE', '%' . $request->search . '%')->get()->pluck('name')
            ];

        return [];
    }

    public function infiniteItem(Product $product)
    {
        return response()->json([
            'status' => 200,
            'items' => $product->oldest()->with('shop')->paginate(12)
        ]);
    }

    public function getSlug(Request $request)
    {
        $result = [
            'msg' => 'Slug Generated',
            'original' => $request->string,
            'slug' => '',
        ];
        if (!strlen($request->string)) $result['msg'] = 'Required Parameter Is Empty';
        $slug = Str::of($request->string)->slug();
        $result['slug'] = $slug;

        return response()->json($result);
    }
}