<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Notification;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $receiver = ['kevin', 'made', '*'];
        for ($i = 0; $i < 200; $i++) {
            Notification::create([
                'name' => "Test Notification #{$i}",
                'slug' => Str::of("Test Notification #{$i}")->slug,
                'body' => 'Lorem Ipsum Dolor Sit Amet',
                'receiver' => $receiver[mt_rand(0, 2)]
            ]);
        }
    }
}