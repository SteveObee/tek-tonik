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
			$table->integer('ref_order_status_code_id')->default(1)->index('fk_orders_ref_order_status_codes1_idx');
			$table->integer('billing_id')->index('fk_orders_addresses1_idx');
			$table->integer('shipping_id')->index('fk_orders_addresses2_idx');
			$table->float('price_total', 10);
			$table->timestamps();
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
