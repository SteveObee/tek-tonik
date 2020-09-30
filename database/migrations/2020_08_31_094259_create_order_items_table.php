<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_items', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('order_id')->index('fk_order_items_orders1_idx');
			$table->integer('product_id')->index('fk_order_items_products1_idx');
			$table->float('price_then', 10, 0);
			$table->text('description_then', 65535);
			$table->string('name', 100);
			$table->smallInteger('quantity');
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
		Schema::drop('order_items');
	}

}
