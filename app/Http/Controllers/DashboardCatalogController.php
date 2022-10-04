<?php

namespace App\Http\Controllers;

use App\Models\ShopCatalog;
use Illuminate\Http\Request;

class DashboardCatalogController extends Controller
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
        return view('dashboard.shop.catalog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valid = $request->validate([
            'name' => ['required', 'string', 'max:75'],
            'slug' => ['required', 'string', 'unique:shop_catalogs'],
            'desc' => ['max:2000'],
        ]);

        $valid['shop_id'] = auth()->user()->shop->id;

        ShopCatalog::create($valid);

        return redirect('/shop')->with('msg', [
            'body' => "Katalog $request->name Telah Dibuat",
            'status' => 'success',
            'title' => 'Success!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShopCatalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function show(ShopCatalog $catalog)
    {
        return view('dashboard.shop.catalog.show', compact('catalog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShopCatalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function edit(ShopCatalog $catalog)
    {
        return view('dashboard.shop.catalog.edit', compact('catalog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShopCatalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShopCatalog $catalog)
    {
        $rules = [
            'name' => ['required', 'string', 'max:75'],
            'desc' => ['max:2000'],
        ];
        if ($request->slug === $catalog) $rules['slug'] = ['required', 'string', 'unique:shop_catalogs'];
        $request->validate($rules);

        $catalog->update($request->all());

        return redirect('/shop')->with('msg', [
            'body' => "Katalog $request->name Telah Diedit",
            'status' => 'success',
            'title' => 'Success!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShopCatalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShopCatalog $catalog)
    {
        $catalog->delete();

        return back()->with('alert', "Katalog {$catalog->name} Telah Dihapus.");
    }
}