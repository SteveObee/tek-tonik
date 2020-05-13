<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomerAddressesTable extends Migration
{

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('customer_addresses', function (Blueprint $table) {
      $table->integer('address_id')->index('fk_customer_addresses_addresses1_idx');
      $table->bigInteger('user_id')->index('fk_customer_addresses_users1_idx');
      $table->boolean('is_shipping')->nullable()->default(0);
      $table->boolean('is_billing')->nullable()->default(0);
      $table->boolean('is_active')->default(1);
      $table->timestamps();
      $table->primary(['address_id', 'user_id']);
    });
  }


  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('customer_addresses');
  }
}
