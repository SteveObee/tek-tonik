<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $this->call([
      CustomerAddressSeeder::class,
      UsersTableSeeder::class,
      SupplierSeeder::class,
      BrandSeeder::class,
      OptionSeeder::class,
      ProductSeeder::class,
      BasketSeeder::class
    ]);
  }
}
