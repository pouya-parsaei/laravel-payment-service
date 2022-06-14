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
        $persianFaker = \Faker\Factory::create('fa_IR');
        return [
            'title' => $persianFaker->name(),
            'description' => $persianFaker->realText(),
            'price' => random_int(10000,99999),
            'image' => 'https://loremflickr.com/320/240?random=' . rand(1,99),
            'stock' => random_int(0,100)
        ];
    }
}
