<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderStatus extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
}