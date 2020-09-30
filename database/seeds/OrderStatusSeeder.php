<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class OrderStatusSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $currentDate = Carbon::now();

    $codes = ['Processing', 'Dispatched', 'Completed', 'Cancelled'];

    $statusCodes = [];

    for ($i = 0; $i <= count($codes) - 1; $i++) {
      $statusCodes[] = [
        'description' => $codes[$i],
        'created_at' => $currentDate,
        'updated_at' => $currentDate
      ];
    }

    DB::table('ref_order_status_codes')->insert($statusCodes);
  }
}
