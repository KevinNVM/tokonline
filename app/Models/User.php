<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Cart;
use App\Models\Shop;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    static public function setStatus($user_id, $status)
    {
        $user = User::find($user_id);
        $user->status = $status;
        $user->save();
        return $user->status;
    }

    static public function setCart($user_id): bool
    {
        $checkForDuplicate = Cart::firstWhere('user_id', $user_id);
        $result =
            $checkForDuplicate ?
            "EXIST" :
            Cart::create(['user_id' => $user_id]);

        if ($result == "EXIST") return false;
        else if ($result) {
            // prevent glitch where u can't add item to cart

            $i = 0;
            while ($i <= 10) {
                Cart::find($user_id)->products()->attach(Product::first()->id, [
                    'count' => 69,
                    'subtotal' => 6900,
                    'notes' => '6xtynine',
                ]);
                $i++;
            }

            Cart::find($user_id)->products()->detach();
            return true;
        } else return false;
    }

    static public function hasShop($user_id): bool
    {
        $has = User::find($user_id)->shop;
        if ($has)
            return true;
        else
            return false;
    }

    public function shop()
    {
        return $this->hasOne(Shop::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function getRouteKeyName()
    {
        return 'username';
    }
}