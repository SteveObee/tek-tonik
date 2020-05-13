<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ProductSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $dateNow = Carbon::now();

    # 5 phones for brand 1
    for ($i = 1; $i <= 5; $i++) {
      $randomDigit = rand(1, 9);
      $year = $i + 4;

      $date = "201{$year}-0{$randomDigit}-01 00:00:00";

      $product = factory(App\Product::class)->create([
        'name' => 'Atomic',
        'supplier_id' => 1,
        'brand_id' => 1,
        'model' => "A{$i}000",
        'created_at' => $date,
        'updated_at' => $date
      ]);

      for ($y = 1; $y <= $randomDigit; $y++) {
        $product->options()->attach(
          1,
          [
            'option_value_id' => $y
          ]
        );
      }
    }
  }
}
