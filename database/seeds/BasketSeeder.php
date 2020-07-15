<?php

use App\Basket;
use App\BasketItem;
use App\BasketItemOption;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;


class BasketSeeder extends Seeder
{
  public function run()
  {
    $dateNow = Carbon::now();

    $basket = factory(Basket::class)->create([
      'user_id' => 11,
      'created_at' => $dateNow,
      'updated_at' => $dateNow
    ]);

    $basket->basketItems()->saveMany([
      $basketItem = new BasketItem(
        [
          'quantity' => 3,
          'product_id' => 1,
          'created_at' => $dateNow,
          'updated_at' => $dateNow
        ]
      ),
      $basketItem2 = new BasketItem(
        [
          'quantity' => 5,
          'product_id' => 3,
          'created_at' => $dateNow,
          'updated_at' => $dateNow
        ]
      )
    ]);

    App\BasketItemOption::firstOrNew(['basket_items_id' => $basketItem->id], [
      'name' => 'Color',
      'value' => 'yellow',
      'created_at' => $dateNow,
      'updated_at' => $dateNow
    ])->save();

    App\BasketItemOption::firstOrNew(['basket_items_id' => $basketItem2->id], [
      'name' => 'Color',
      'value' => 'black',
      'created_at' => $dateNow,
      'updated_at' => $dateNow
    ])->save();
  }
}
