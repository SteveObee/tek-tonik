<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProductOptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('product_options', function(Blueprint $table)
		{
			$table->foreign('option_id', 'fk_product_options_options1')->references('id')->on('options')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('option_value_id', 'fk_product_options_option_values1')->references('id')->on('option_values')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('product_id', 'fk_product_options_products1')->references('id')->on('products')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('product_options', function(Blueprint $table)
		{
			$table->dropForeign('fk_product_options_options1');
			$table->dropForeign('fk_product_options_option_values1');
			$table->dropForeign('fk_product_options_products1');
		});
	}

}
