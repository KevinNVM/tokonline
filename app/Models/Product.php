<?php

namespace App\Models;

use App\Models\Shop;
use App\Models\ShopCatalog;
use Illuminate\Support\Str;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    public $guarded = ['id'];
    public $with = ['shop', 'subcategory'];

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

    public function scopeVisibility($query, $visibility)
    {
        switch (Str::lower($visibility)) {
            case 'public':
                $visibility = 1;
                break;
            case 'private':
                $visibility = 0;
                break;
            case 'unlisted':
                $visibility = 2;
                break;
        }
        return $query->where([['visibility', $visibility]]);
    }

    public function scopeFilters($query, $filters = [])
    {

        $query->when($filters['order'] ?? false, function ($query, $order) {
            $order = strtolower($order);
            if ($order == 'latest') $query->orderBy('created_at', 'desc');
            elseif ($order == 'oldest')  $query->orderBy('created_at', 'asc');
            elseif ($order == 'ratings')  $query->orderBy('ratings', 'asc');
            elseif ($order == 'lowest_price') $query->orderBy('price', 'asc');
            elseif ($order == 'highest_price') $query->orderBy('price', 'desc');
        });

        $query->when($filters['ratings'] ?? false, function ($query, $ratings) {
            for ($i = 0; $i < count($ratings); $i++) {
                $query->where('ratings', $ratings[$i])->orWhere('ratings', $ratings[$i]);
            }
        });

        $query->when($filters['location'] ?? false, function ($query, $location) {
            $query->whereHas('shop', function ($query) use ($location) {
                for ($i = 0; $i < count($location); $i++) {
                    $query->where('location', "%$location[$i]%");
                }
            });
        });

        $query->when($filters['shop'] ?? false, function ($query, $shop) {
            $query->whereHas('shop', function ($query) use ($shop) {
                $query->where('url', $shop)->orWhere('name', 'LIKE', "%{$shop}%");
            });
        });

        $query->when($filters['category'] ?? $filters['subcategory'] ?? false, function ($query, $subcategory) {
            $query->whereHas('subcategory', function ($query) use ($subcategory) {
                $query->where('slug', $subcategory);
            });
        });

        $query->when($filters['condition'] ?? false, function ($query, $condition) {
            if ($condition != 'all') $query->where('condition', $condition);
        });

        $query->when($filters['min_price'] ?? false, function ($query, $min_price) {
            $query->where('price', '>', $min_price);
        })->when($filters['max_price'] ?? false, function ($query, $max_price) {
            $query->where('price', '<=', $max_price);
        });
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

    public function scopeQuery($query, $search)
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