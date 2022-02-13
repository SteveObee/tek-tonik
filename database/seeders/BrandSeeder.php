<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $names = [
      'Altech',
      'CaptiveCom',
      'Spark',
      'Bytestar',
      'Perricone'
    ];

    $date = Carbon::now();

    $brands = [];

    for ($supp = 0; $supp <= 4; $supp++) {
      $brands[] = [
        'name' => $names[$supp],
        'created_at' => $date,
        'updated_at' => $date
      ];
    };

    DB::table('brands')->insert($brands);
  }
}
