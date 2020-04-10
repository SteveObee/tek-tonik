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
      $table->dateTime('date_from')->useCurrent();
      $table->timestamps();
      $table->integer('ref_address_type_id')->index('fk_customer_addresses_ref_address_types1_idx');
      $table->integer('address_id')->index('fk_customer_addresses_addresses1_idx');
      $table->bigInteger('user_id')->index('fk_customer_addresses_users1_idx');
      $table->primary(['date_from', 'address_id', 'user_id']);
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
