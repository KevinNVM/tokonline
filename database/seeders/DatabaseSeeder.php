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
use App\Models\Wishlist;
use Auth;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Notification;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Kevin Darmawan',
            'username' => 'kevind',
            'email' => 'personal.kevindarmawan@gmail.com',
            'password' => bcrypt(''),
            'email_verified_at' => now()
        ]);

        Shop::create([
            'user_id' => 1,
            'name' => 'Toko Kevin',
            'url' => 'toko-kevin',
            'location' => '{"province":"DKI JAKARTA","regency":"KOTA JAKARTA TIMUR"}',
            'desc' => 'Toko Kevin Official
            @mkevin_1

            Creator Of This Websites',
            'link' => '["https:\/\/instagram.com\/mkevin_1","https:\/\/github.com\/kevinnvm"]'
        ]);

        ShopCatalog::create([
            'shop_id' => 1,
            'name' => 'Produk Lainnya',
            'slug' => 'produk-lainnya',
            'desc' => 'Produk Lainnya Dari Toko Ini.'
        ]);

        ShopCatalog::create([
            'shop_id' => 1,
            'name' => 'Keyboard Gaming',
            'slug' => 'keyboard-gaming',
            'desc' => 'Produk Gaming Keyboard'
        ]);

        ProductCategory::create([
            'name' => 'Semua Produk',
            'slug' => 'semua-produk',
            'desc' => 'Kategori untuk semua produk atau produk yang belum memiliki kategori-nya sendiri.',
        ]);

        ProductSubCategory::create([
            'category_id' => 1,
            'name' => 'Bagan 1',
            'slug' => 'bagan-1'
        ]);

        Product::create([
            'image' => '["25frZu7vnvzWEVcD0HICyzmaxDG8elqHeOitWfUL.jpg","hEHAC4hpd26zA2XMjCHtLymQFtoj6PUAMm5zz3Z9.jpg","3ufntBUhAHQ6WQI2XyPNDj4r7DBRJC5MC4ICphGG.jpg","PlrdsSrsQ5aucb56mcgR2x5iyvWu1z49D7OtwPDG.jpg"]',
            'shop_id' => 1,
            'catalog_id' => 2,
            'sub_category_id' => 1,
            'name' => 'GLORIOUS GMMK PRO 75% Barebone BLACK - Gaming Keyboard',
            'slug' => 'glorious-gmmk-pro-75-barebone-black-gaming-keyboard',
            'weight' => 3,
            'condition' => 1,
            'stock' => 200,
            'price' => 2845000,
            'sold' => mt_rand(1, 200),
            'visibility' => 1,
            'desc' => 'Noted penting :
            - Jika barang ada masalah / eror, langsung chat admin
            - Garansi tukar baru apabila barang diterima terdapat cacat fisik WAJIB VIDEO UNBOXING NO CUT / PAUSE
            - jumlah stock yang ready, sesuai dengan qty di tokopedia
            - barang yang kita jual BNIB + SEGEL (brand new in box)

            Batch terbaru , Sudah Bisa menggunakan Third Party Stabs / Durock dengan minim penyesuaian yg mudah hanya di bagian Screw.

            BAREBONE
            TECH SPECS
            ➡️ LAYOUT : US ANSI (83 keys, including clickable Rotary Encoder)
            ➡️ PLATE MOUNTING TYPE : Gasket mounted design
            ➡️ RGB : 16.8 million color RGB LED backlight (south-facing) and LED sidelights
            ➡️ KEYCAP PULLER TOOL : Included
            ➡️ SWITCH PULLER TOOL : Included
            ➡️ SWITCHES : Not Included
            ➡️ CASE MATERIAL : Aluminum
            ➡️ STABILIZERS : Pre-lubed Glorious GOAT stabilizers (screw-in)
            ➡️ CORD LENGTH : 6 feet
            ➡️ N-KEY ROLLOVER : Full NKRO
            ➡️ REMOVABLE KEYCAPS : Yes
            ➡️ REMOVABLE USB CORD :Yes
            ➡️ MODULAR (HOT SWAP) SWITCHES : Yes
            ➡️ INTERFACE : USB-C 2.0
            ➡️ TYPING ANGLE : 6 Degrees
            ➡️ DIMENSIONS : 332mm x 32mm x 135mm

            GLORIOUS CABLE
            TECH SPECS
            ➡️ GOLD PLATED USB 2.0 CABLE
            ➡️ USB-C (CONNECTS TO KEYBOARD) TO USB-A (CONNECTS TO PC)
            ➡️ 5-PIN DETACHABLE AVIATOR CONNECTOR
            ➡️ PLASTIC MOLDED USB HOUSING
            ➡️ CABLE ORIENTATION:DEVICE SIDE + 90-DEGREES
            ➡️ TOTAL CABLE LENGTH (INCLUDING COILS): 4.5FT
            ➡️ STRAIGHT CABLE LENGTH: 4FT
            ➡️ COIL LENGTH: 6 INCH'
        ]);
    }
}