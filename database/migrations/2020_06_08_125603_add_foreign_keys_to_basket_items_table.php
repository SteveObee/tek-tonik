<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBasketItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('basket_items', function(Blueprint $table)
		{
			$table->foreign('basket_id', 'fk_basket_items_basket1')->references('id')->on('basket')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('product_id', 'fk_basket_items_products1')->references('id')->on('products')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('basket_items', function(Blueprint $table)
		{
			$table->dropForeign('fk_basket_items_basket1');
			$table->dropForeign('fk_basket_items_products1');
		});
	}

}
