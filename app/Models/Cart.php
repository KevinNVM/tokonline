<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;

class Cart extends Model
{
    use HasFactory;

    public $guarded = ['id'];
    protected $primaryKey = 'user_id';

    static public function getTotalPrice($user_id)
    {
        $subtotal = [];
        foreach (User::find($user_id)->cart->products as $item) {
            $subtotal[] = $item->price * $item->pivot->count;
        }
        $table = Cart::find($user_id)->pluck('totalprice');
        $collect = collect($subtotal)->sum();

        $total = $table !== $collect ?
            collect($subtotal)->sum() :
            Cart::find($user_id)->pluck('totalprice');

        return $total;
    }

    static public function setTotalPrice($user_id, $totalprice)
    {
        if (Cart::where('user_id', $user_id)->update(['totalprice' => $totalprice]))
            return true;
        else
            return false;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'cart_products', 'user_id', 'product_id')->withTimestamps()->withPivot(['count', 'notes', 'created_at', 'subtotal']);
    }
}