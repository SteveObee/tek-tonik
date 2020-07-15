<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBasketItemsTable extends Migration
{

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('basket_items', function (Blueprint $table) {
      $table->integer('id', true);
      $table->integer('quantity');
      $table->timestamps();
      $table->integer('basket_id')->nullable()->index('fk_basket_items_basket1');
      $table->integer('product_id')->index('fk_basket_items_products1_idx');
    });
  }


  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('basket_items');
  }
}
