<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\Midtrans\CallbackService;

class PaymentCallbackController extends Controller
{
    public function receive(Request $request)
    {
        if (!isset($request->merchant_id) && $request->merchant_id !== config('midtrans.merchant_id'))
            return abort(403, 'Invalid Request');

        $callback = new CallbackService;

        if ($callback->isSignatureKeyVerified()) {
            $notification = $callback->getNotification();
            $order = $callback->getOrder();

            if ($callback->isSuccess()) {
                Order::where('id', $order->id)->update([
                    'payment_status' => 2,
                ]);
                foreach (json_decode($order->products_json) as $product) {
                    $selected = Product::find($product->id);
                    $selected->stock = $selected->stock - $product->pivot->count;
                    if ($selected->stock < 0) $selected->stock = 0;
                    $selected->save();

                    //

                    OrderStatus::where([
                        ['product_id', $product->id],
                        ['shop_id', $product->shop_id]
                    ])->first()->update([
                        'status' => 'Confirmed & Paid'
                    ]);
                }
            }

            if ($callback->isExpire()) {
                Order::where('id', $order->id)->update([
                    'payment_status' => 3,
                ]);
            }

            if ($callback->isCancelled()) {
                Order::where('id', $order->id)->update([
                    'payment_status' => 4,
                ]);
            }

            return response()
                ->json([
                    'success' => true,
                    'message' => 'Notifikasi berhasil diproses',
                ]);
        } else {
            return response()
                ->json([
                    'error' => true,
                    'message' => 'Signature key tidak terverifikasi',
                ], 403);
        }
    }
}