<?php

use Illuminate\Database\Seeder;

class CustomerAddressSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    factory(App\CustomerAddress::class, 10)->create();
  }
}
