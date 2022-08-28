<?php

namespace App\Models;

use App\Models\Shop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShopCatalog extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'catalog_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}