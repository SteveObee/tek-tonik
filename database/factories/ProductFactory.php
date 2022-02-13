<?php

namespace Database\Factories;

use App\Product;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
  public function definition()
  {
    return [
      'name' => $this->faker->name,
      'price' => $this->faker->randomFloat(2, 50.99, 99.99),
      'description' => $this->faker->paragraphs(rand(1, 5), true),
      'weight' => $this->faker->numberBetween(140, 180),
      'stock' => $this->faker->numberBetween(10, 50)
    ];
  }
}