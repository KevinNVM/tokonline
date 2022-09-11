<?php

namespace App\Models;

use App\Models\Shop;
use App\Models\ShopCatalog;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    public function getVisibility($num)
    {
        switch ($num):
            case (1):
                return 'Public';
                break;

            case (2):
                return 'Unlisted';
                break;

            default:
                return 'Private';
        endswitch;
    }

    public function catalog()
    {
        return $this->belongsTo(ShopCatalog::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(ProductSubCategory::class, 'sub_category_id');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeOldest($query)
    {
        return $query->orderBy('created_at', 'asc');
    }

    public function scopeBest_selling($query)
    {
        return $query->orderBy('sold', 'desc');
    }

    public function scopeSearch($query, $search)
    {
        $query->when($search ?? false, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%")->orWhere('desc', 'LIKE', "%{$search}%");
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}