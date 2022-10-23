<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Notification;

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
        for ($i = 0; $i < 10; $i++) {
            Notification::create([
                'name' => "Test Notification #{$i}",
                'body' => 'Lorem Ipsum Dolor Sit Amet',
                'receiver' => $receiver[mt_rand(0, 2)]
            ]);
        }
    }
}