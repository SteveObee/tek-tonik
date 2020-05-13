<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Carbon;

class SupplierSeeder extends Seeder
{

  public function run()
  {
    $names = [
      'Scotts Suppliers',
      'Johnson Warehouses',
      'London logistics',
      'Downton',
      'Stobart supply services'
    ];

    $date = Carbon::now();

    $suppliers = [];

    $faker = Factory::create();

    for ($supp = 0; $supp <= 4; $supp++) {
      $suppliers[]  = [
        'name' => $names[$supp],
        'address_line_1' => $faker->streetAddress,
        'address_line_2' => $faker->secondaryAddress,
        'city' => $faker->city,
        'county' => $faker->state,
        'postcode' => $faker->postcode,
        'created_at' => $date,
        'updated_at' => $date
      ];
    };

    DB::table('suppliers')->insert($suppliers);
  }
}
