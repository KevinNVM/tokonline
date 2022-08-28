<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'shop_id' => mt_rand(1, 2),
            'catalog_id' => mt_rand(1, 4),
            'sub_category_id' => mt_rand(1, 5),
            'name' => "Barang " . mt_rand(1, 10e5),
            'slug' => \Illuminate\Support\Str::of('Barang' . mt_rand(1, 10e5))->slug('-'),
            'desc' => $this->faker->paragraph(10, 24),
            'weight' => mt_rand(1, 10),
            'condition' => mt_rand(0, 1),
            'stock' => mt_rand(1, 999),
            'price' => floor(mt_rand(1000, 10e5)),
            'sold' => mt_rand(1, 200)
        ];
    }
}