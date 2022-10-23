<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomSeeder1 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'god',
            'username' => 'god',
            'password' => bcrypt(''),
            'email' => 'user@god.heaven',
            'email_verified_at' => now(),
        ]);
    }
}