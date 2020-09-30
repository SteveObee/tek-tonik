<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class CategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    factory(App\Category::class)->create([
      'name' => 'All',
      'category_id' => 1
    ]);

    factory(App\Category::class)->create([
      'name' => 'Electronics',
      'category_id' => 1
    ]);

    factory(App\Category::class)->create([
      'name' => 'Accesories',
      'category_id' => 1
    ]);

    factory(App\Category::class)->create([
      'name' => 'Phones',
      'category_id' => 2
    ]);

    factory(App\Category::class)->create([
      'name' => 'Tablets',
      'category_id' => 2
    ]);

    factory(App\Category::class)->create([
      'name' => 'Laptops',
      'category_id' => 2
    ]);
  }
}
