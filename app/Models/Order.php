<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $primaryKey = 'number';
    public $guarded = ['id'];

    static public function getTotalPrice($json)
    {
        $arr1 = collect(json_decode($json, false));
        $totalPrice = 0;
        foreach ($arr1 as $arr) {
            $totalPrice += $arr->price * $arr->quantity;
        }
        return $totalPrice;
    }

    public function getPaymentStatus($status)
    {
        switch ($status) {
            case 1:
                return 'Menunggu Pembayaran';
                break;
            case 2:
                return 'Berhasil';
                break;
            case 3:
                return 'Kadaluarsa';
                break;
            case 4:
            default:
                return 'Dibatalkan';
                break;
        }
    }
}