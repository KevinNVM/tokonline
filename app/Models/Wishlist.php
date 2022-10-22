<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    static public function createWishlist($user_id, $wishlist_name)
    {
        Wishlist::create([
            'user_id' => $user_id,
            'name' => $wishlist_name,
        ]);

        return response('', 200);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'wishlist_products', 'user_id', 'product_id')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getRouteKeyName()
    {
        return 'name';
    }
}