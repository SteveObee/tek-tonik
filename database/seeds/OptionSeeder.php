<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class OptionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $currentDate = Carbon::now();

    factory(App\Option::class)->create([
      'name' => 'color'
    ]);

    $colors = ['black', 'silver', 'white', 'blue', 'pink', 'red', 'green', 'orange', 'yellow'];

    $optionValues = [];

    for ($i = 0; $i <= count($colors) - 1; $i++) {
      $optionValues[] = [
        'option_id' => 1,
        'value' => $colors[$i],
        'created_at' => $currentDate,
        'updated_at' => $currentDate
      ];
    }

    DB::table('option_values')->insert($optionValues);
  }
}
