<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart_view(Cart $cart)
    {
        $cart = $cart->find(auth()->user()->id);
        if (!$cart) User::setCart(auth()->user()->id);
        if (request('token') !== csrf_token() && !Cart::find(auth()->user()->id)) return '<h3 class="text-danger text-center">Cart Failed To Load</h3>';
        return view('cart_view', [
            'title' => 'Keranjang',
            'carts' => $cart->products,
            'subtotal' => $cart->getTotalPrice(auth()->user()->id),
        ]);
    }
    public function cartView(Cart $cart, Request $request)
    {
        if (!Cart::find(auth()->user()->id)) {
            User::setStatus(auth()->user()->id, 0);
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/login')->with('alert', 'Your Information Was Handled Incorrectly, Please Re-Login With Your Legitimate Credentials.');
        }
        return view('cart', [
            'title' => 'Keranjang',
            'carts' => auth()->user()->cart->products,
            'subtotal' => $cart->getTotalPrice(auth()->user()->id),
        ]);
    }

    public function addToCart(Request $request, Cart $cart)
    {
        if ($request->_token !== csrf_token())
            return back()->with('alert', 'Something is wrong please try again later.');

        $new = $request->except('_token'); //  type array
        // return Product::find($new['product_id'])->disabled;
        if (Product::find($new['product_id'])->disabled) return back()->with('alert', 'Cannot Add Item to Cart Because Product is inactive.');

        $new['user_id'] = auth()->user()->id;
        $new['subtotal'] = $new['price'] * $new['count'];
        $old =  DB::table('cart_products')->where('product_id', $new['product_id']);

        // Insert Or Update;
        if ($old->get()->count()) {
            $cart->find($new['user_id'])->products()->updateExistingPivot($new['product_id'], [
                'count' => $old->sum('count') + $new['count'],
                'subtotal' => $old->sum('subtotal') + $new['subtotal'],
                'notes' => $new['notes']
            ]);
        } else {
            // return $cart->find($new['user_id']);
            $cart->find($new['user_id'])->products()->attach($new['product_id'], [
                'count' => $new['count'],
                'subtotal' => $new['subtotal'],
                'notes' => $new['notes']
            ]);
        }

        // update totalprice column on table carts
        Cart::setTotalPrice($new['user_id'], Cart::getTotalPrice($new['user_id']));

        return back()->with('alert', 'Ditambahkan Ke Keranjang');
    }

    public function editItem($id)
    {
        $product = User::find(auth()->user()->id)->cart->products()->where('product_id', $id)->get();
        if (!$product->count()) return redirect()->back();

        return view('editCart', [
            'title' => 'Edit ',
            'carts' => $product,
            'product' => $id
        ]);
    }

    public function updateItem(Request $request, Cart $cart, $id)
    {
        $product = $cart->find(auth()->user()->id)->products()->where('product_id', $id);
        $max_count = implode(':', ['integer|min:0|max', $product->sum('stock')]);

        $validatedData = $request->validate([
            'notes' => 'max:255',
            'count' => $max_count
        ]);
        $subtotal = $validatedData['count'] * $product->sum('price');

        $cart->find(auth()->user()->id)->products()->updateExistingPivot($id, [
            'notes' => $validatedData['notes'],
            'count' => $validatedData['count'],
            'subtotal' => $subtotal
        ]);

        return redirect('/cart');
    }

    public function deleteItem($slug, $id)
    {
        $id = base64_decode($id);
        Cart::deleteItem($id);

        return redirect()->back();
    }

    public function deleteAll()
    {
        if (request()->token !== csrf_token()) return back();
        Cart::snap();

        return redirect()->back();
    }
}