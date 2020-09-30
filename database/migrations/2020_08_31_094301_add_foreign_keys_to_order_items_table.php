<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOrderItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('order_items', function(Blueprint $table)
		{
			$table->foreign('order_id', 'fk_order_items_orders1')->references('id')->on('orders')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('product_id', 'fk_order_items_products1')->references('id')->on('products')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('order_items', function(Blueprint $table)
		{
			$table->dropForeign('fk_order_items_orders1');
			$table->dropForeign('fk_order_items_products1');
		});
	}

}
