<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Image;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
  return [
    'url' => 'https://source.unsplash.com/random/400x400',
    'sort_order' => 1
  ];
});
