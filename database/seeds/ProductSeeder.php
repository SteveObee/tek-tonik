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
    for ($productCount = 1; $productCount <= 5; $productCount++) {
      $randomDigit = rand(1, 9);
      $year = $productCount + 4;

      $date = "201{$year}-0{$randomDigit}-01 00:00:00";

      $product = factory(App\Product::class)->create([
        'name' => 'Atomic',
        'supplier_id' => 1,
        'brand_id' => 1,
        'model' => "A{$productCount}000",
        'thumbnail' => 'http://localhost:3002/storage/sm-mock.jpg',
        'category_id' => 4,
        'created_at' => $date,
        'updated_at' => $date
      ]);

      for ($optionCount = 1; $optionCount <= $randomDigit; $optionCount++) {
        $product->options()->attach(
          1,
          [
            'option_value_id' => $optionCount
          ]
        );
      }

      factory(App\Image::class)->create([
        'product_id' => $product->id,
        'sort_order' => 1,
        'url' => "http://localhost:3002/storage/sm-mock_400x400.jpg"
      ]);

      for ($imgCount = 2; $imgCount <= 8; $imgCount++) {
        factory(App\Image::class)->create([
          'product_id' => $product->id,
          'sort_order' => $imgCount,
          'url' => "https://source.unsplash.com/random/40{$imgCount}x40{$imgCount}"
        ]);
      }
    }

    # 5 tablets for brand 2
    for ($productCount = 1; $productCount <= 5; $productCount++) {
      $randomDigit = rand(1, 9);
      $year = $productCount + 4;

      $date = "201{$year}-0{$randomDigit}-01 00:00:00";

      $product = factory(App\Product::class)->create([
        'name' => 'Nova',
        'supplier_id' => 1,
        'brand_id' => 2,
        'model' => "StyleIte {$productCount}",
        'thumbnail' => 'http://localhost:3002/storage/tab-mock_300x300.jpg',
        'category_id' => 5,
        'created_at' => $date,
        'updated_at' => $date
      ]);

      for ($optionCount = 1; $optionCount <= $randomDigit; $optionCount++) {
        $product->options()->attach(
          1,
          [
            'option_value_id' => $optionCount
          ]
        );
      }

      factory(App\Image::class)->create([
        'product_id' => $product->id,
        'sort_order' => 1,
        'url' => "http://localhost:3002/storage/tab-mock_400x400.jpg"
      ]);

      for ($imgCount = 2; $imgCount <= 8; $imgCount++) {
        factory(App\Image::class)->create([
          'product_id' => $product->id,
          'sort_order' => $imgCount,
          'url' => "https://source.unsplash.com/random/40{$imgCount}x40{$imgCount}"
        ]);
      }
    }
  }
}
