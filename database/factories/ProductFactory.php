<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
  return [
    'name' => $faker->name,
    'price' => $faker->randomFloat(2, 50.99, 99.99),
    'description' => $faker->paragraphs(rand(1, 5), true),
    'weight' => $faker->numberBetween(140, 180),
    'thumbnail' => 'http://localhost:3002/storage/sm-mock.jpg',
    'stock' => $faker->numberBetween(10, 50)
  ];
});
