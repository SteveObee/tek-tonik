<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBasketTable extends Migration
{

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('basket', function (Blueprint $table) {
      $table->integer('id', true);
      $table->timestamps();
      $table->bigInteger('user_id')->index('fk_basket_users1_idx');
    });
  }


  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('basket');
  }
}
