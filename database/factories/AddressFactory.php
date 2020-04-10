<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
  return [
    'address_line_1' => $faker->streetAddress,
    'address_line_2' => $faker->secondaryAddress,
    'city' => $faker->city,
    'county' => $faker->state,
    'postcode' => $faker->postcode
  ];
});
