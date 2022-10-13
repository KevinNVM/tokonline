<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Shop;
use App\Models\User;
use App\Models\Product;
use App\Models\ShopCatalog;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // Order::create([
        //     'number' =>  mt_rand(10000000, 100000000),
        //     'user_id' => 2,
        //     'products_json' => json_encode([
        //         [
        //             'id' => 1,
        //             'name' => 'Lorem',
        //             'shop' => 'Made Store',
        //             'price' => 10000,
        //             'quantity' => 2,
        //             'url' => '/made-store/barang24480'
        //         ]
        //     ]),
        //     'total_price' => 270000,
        //     'payment_status' => 2
        // ]);

        // Order::create([
        //     'number' =>  mt_rand(10000000, 100000000),
        //     'user_id' => 2,
        //     'products_json' => json_encode([[
        //         'id' => 1,
        //         'name' => 'Lorem',
        //         'shop' => 'Made Store',
        //         'price' => 10000,
        //         'quantity' => 2,
        //         'url' => '/made-store/barang24480'
        //     ], [
        //         'id' => 1,
        //         'name' => 'Lorem',
        //         'shop' => 'Made Store',
        //         'price' => 10000,
        //         'quantity' => 2,
        //         'url' => '/made-store/barang24480'
        //     ], [
        //         'id' => 1,
        //         'name' => 'Lorem',
        //         'shop' => 'Made Store',
        //         'price' => 10000,
        //         'quantity' => 2,
        //         'url' => '/made-store/barang24480'
        //     ]]),
        //     'total_price' => 270000,
        //     'payment_status' => 2
        // ]);

        Order::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Made',
            'username' => 'made',
            'password' => bcrypt('password'),
            'email' => 'made@example.com',
            'phone' => '0812345699'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Kevin',
            'username' => 'kevin',
            'password' => bcrypt('password'),
            'email' => 'kevin@example.com',
            'phone' => '0812345699'
        ]);

        \App\Models\User::factory(10)->create();

        Shop::create([
            'user_id' => 1,
            'name' => 'Made Store',
            'location' => 'Bogor',
            'whatsapp' => '085904312300',
            'url' => 'made-store'
        ]);

        Shop::create([
            'user_id' => 2,
            'name' => 'Toko Kevin',
            'location' => 'Jakarta Timur',
            'whatsapp' => '085904312300',
            'url' => 'toko-kevin'
        ]);

        ShopCatalog::create([
            'shop_id' => 1,
            'slug' => 'barang-teknologi',
            'name' => 'Barang Teknologi',
            'desc' => 'Lorem Ipsum'
        ]);

        ShopCatalog::create([
            'shop_id' => 1,
            'slug' => 'barang-murah',
            'name' => 'Barang Murah',
            'desc' => 'Lorem Ipsum'
        ]);

        ShopCatalog::create([
            'shop_id' => 2,
            'slug' => 'barang-teknologi',
            'name' => 'Barang Teknologi',
            'desc' => 'Lorem Ipsum'
        ]);

        ShopCatalog::create([
            'shop_id' => 2,
            'slug' => 'barang-murah',
            'name' => 'Barang Murah',
            'desc' => 'Lorem Ipsum'
        ]);

        ProductCategory::create([
            'name' => 'Kebutuhan Sehari-hari',
            'slug' => 'kebutuhan-sehari-hari'
        ]);

        ProductCategory::create([
            'name' => 'Komputer',
            'slug' => 'komputer'
        ]);

        ProductCategory::create([
            'name' => 'Aksesoris Pria',
            'slug' => 'aksesoris-pria'
        ]);

        ProductSubCategory::create([
            'category_id' => 2,
            'name' => 'Laptop Gaming',
            'slug' => 'laptop-gaming'
        ]);

        ProductSubCategory::create([
            'category_id' => 2,
            'name' => 'Laptop Budget',
            'slug' => 'laptop-budget'
        ]);

        ProductSubCategory::create([
            'category_id' => 2,
            'name' => 'Laptop Sekolah',
            'slug' => 'laptop-sekolah'
        ]);

        ProductSubCategory::create([
            'category_id' => 3,
            'name' => 'Jam Tangan',
            'slug' => 'jam-tangan'
        ]);

        ProductSubCategory::create([
            'category_id' => 3,
            'name' => 'Baju Pria',
            'slug' => 'baju-pria'
        ]);


        Product::factory(75)->create();
    }
}