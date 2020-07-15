<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBasketItemOptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('basket_item_options', function(Blueprint $table)
		{
			$table->foreign('basket_items_id', 'fk_basket_options_basket_items1')->references('id')->on('basket_items')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('basket_item_options', function(Blueprint $table)
		{
			$table->dropForeign('fk_basket_options_basket_items1');
		});
	}

}
