<?php

namespace Database\Seeders;

use App\Category;
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
    Category::factory()->create([
      'name' => 'All',
      'category_id' => 1
    ]);

    Category::factory()->create([
      'name' => 'Electronics',
      'category_id' => 1
    ]);

    Category::factory()->create([
      'name' => 'Accesories',
      'category_id' => 1
    ]);

    Category::factory()->create([
      'name' => 'Phones',
      'category_id' => 2
    ]);

    Category::factory()->create([
      'name' => 'Tablets',
      'category_id' => 2
    ]);

    Category::factory()->create([
      'name' => 'Laptops',
      'category_id' => 2
    ]);
  }
}
