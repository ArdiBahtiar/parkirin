<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ItemList>
 */
class ItemListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->sentence(),
            'harga' => fake()->numberBetween(10000, 200000),
            'detail_info' => fake()->paragraph(2, true),
            'ukuran' => fake()->randomElement(['kecil', 'sedang', 'besar']),
            'deskripsi' => fake()->sentence(),
            'lokasi' => 'https://www.google.com',
            'id_owner' => fake()->numberBetween(1, 3),
        ];
    }
}
