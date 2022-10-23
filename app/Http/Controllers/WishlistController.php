<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function wishlist_view()
    {
        return view('wishlist_view', [
            'wishlist' => Auth::user()->wishlist->first()->products
        ]);
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        if (!Wishlist::where('user_id', $user->id)->first()) {
            User::setStatus(auth()->user()->id, 0);
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/login')->with('alert', 'Your Information Was Handled Incorrectly, Please Re-Login With Your Legitimate Credentials.');
        }

        return view('wishlist', [
            'title' => 'Wishlist - General'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = Auth::user();
        if (!$request->isXmlHttpRequest()) return abort(404);
        if (!Wishlist::where('user_id', $user->id)) {
            User::setStatus(auth()->user()->id, 0);
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/login')->with('alert', 'Your Information Was Handled Incorrectly, Please Re-Login With Your Legitimate Credentials.');
        }
        $product = Product::where('slug', $request->product)->first();

        if ($user->wishlist()->first()->products()->where('id', $product->id)->count()) return response('Product Already Exist In Selected Wishlist', 400);
        else
            $user->wishlist->first()->products()->attach($product->id);

        return response([
            'statusMessage' => 'success'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function show(Wishlist $wishlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function edit(Wishlist $wishlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wishlist $wishlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wishlist $wishlist, Request $request)
    {
        $wishlist->products()->detach(Product::where('slug', $request->product)->first()->id);

        return response('Success', 200);
    }
}