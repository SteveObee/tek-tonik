<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->bigInteger('user_id')->index('fk_orders_users1_idx');
			$table->timestamps();
			$table->integer('ref_order_status_codes_id')->index('fk_orders_ref_order_status_codes1_idx');
			$table->integer('orders_id')->index('fk_orders_orders1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orders');
	}

}
