<?php

namespace Database\Seeders;

use App\CustomerAddress;
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
    CustomerAddress::factory()->count(10)->create();
  }
}
