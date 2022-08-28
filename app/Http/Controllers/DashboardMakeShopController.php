<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardMakeShopController extends Controller
{

    public function create(User $user)
    {
        $auth = auth()->user();
        if ($user->hasShop($auth->id))
            return redirect()->to('/dashboard/shop');

        return view('dashboard.create_shop', ['user' => $auth]);
    }

    public function store(Shop $shop, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'url' => 'required|unique:shops',
            'whatsapp' => 'required|min:8|max:14'
        ]);

        $otherData = [
            'user_id' => auth()->user()->id,
            'desc' => $request->desc,
            'link' => implode(',', [$request->link_1, $request->link_2]),
            'location' => implode('/', [$request->input('location.province'), $request->input('location.regency')]),
        ];

        $validatedData = array_merge($validatedData, $otherData);

        $shop->create($validatedData);

        return redirect()->back()->with('alert', 'Toko Telah Berhasil Dibuat!');
    }
}