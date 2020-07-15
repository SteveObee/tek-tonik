<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBasketItemOptionsTable extends Migration
{

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('basket_item_options', function (Blueprint $table) {
      $table->integer('id', true);
      $table->string('name', 45);
      $table->string('value', 45);
      $table->timestamps();
      $table->integer('basket_items_id')->index('fk_basket_options_basket_items1_idx');
    });
  }


  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('basket_item_options');
  }
}
