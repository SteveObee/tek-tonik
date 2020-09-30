<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

$factory->define(Category::class, function (Faker $faker) {
  $dateNow = Carbon::now();

  return [
    'created_at' => $dateNow,
    'updated_at' => $dateNow
  ];
});
