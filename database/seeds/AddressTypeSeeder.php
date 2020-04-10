<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AddressTypeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $createdDate = Carbon::now();

    $addressTypes = [
      [
        'description' => 'Billing',
        'created_at' => $createdDate,
        'updated_at' => $createdDate

      ],
      [
        'description' => 'Shipping',
        'created_at' => $createdDate,
        'updated_at' => $createdDate
      ]
    ];

    DB::table('ref_address_types')->insert($addressTypes);
  }
}
