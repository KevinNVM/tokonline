<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Services\Midtrans\CreateSnapTokenService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('orders.index', ['orders' => Order::get(), 'title' => 'Daftar Pesanan']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $products = json_decode($request->products_json, true);

        $products_json = [];
        foreach ($products as $product) {
            $product['quantity'] = $product['pivot']['count'];
            $product['shop'] = $product['shop']['url'];
            $product['url'] = "{$product['shop']}/{$product['slug']}";
            $products_json[] = $product;
        }
        $products_json = json_encode($products_json);
        $params = [
            'number' =>  mt_rand(10000000, 100000000),
            'user_id' => auth()->user()->id,
            'products_json' => $products_json,
            'total_price' => Cart::getTotalPrice(auth()->user()->id) . '.00',
            'payment_status' => 1
        ];

        try {
            Order::create($params);
        } catch (\Illuminate\Database\QueryException $err) {
            return back()->with('alert', 'Total Harga Terlalu Tinggi Dalam Satu Waktu! Harap Kurangi Barang Belanja Anda');
        }

        // Clear user's cart
        Cart::snap();
        Cart::setTotalPrice(auth()->user()->id, 0);


        return redirect()->to('/orders')->with('alert', 'Order Created');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        if (auth()->user()->id !== $order->user_id) return abort(404, 'Order Not Found');

        $snapToken = $order->snap_token;
        if (empty($snapToken)) {
            // Jika snap token masih NULL, buat token snap dan simpan ke database

            $midtrans = new CreateSnapTokenService($order);
            $snapToken = $midtrans->getSnapToken();

            $order->snap_token = $snapToken;
            $order->save();
        }

        return view('orders.show', ['snapToken' => $snapToken, 'order' => $order, 'title' => "Detail Pesanan"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}