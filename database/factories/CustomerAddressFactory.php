<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CustomerAddress;
use Faker\Generator as Faker;

$factory->define(CustomerAddress::class, function (Faker $faker) {
  return [
    'user_id' => factory(App\User::class),
    'address_id' => factory(App\Address::class)
  ];
});
