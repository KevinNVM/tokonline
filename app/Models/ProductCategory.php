<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    public function subcategory()
    {
        return $this->hasMany(ProductSubCategory::class, 'category_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}