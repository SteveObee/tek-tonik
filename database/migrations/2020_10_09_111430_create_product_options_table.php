<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductOptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_options', function(Blueprint $table)
		{
			$table->integer('product_id')->index('fk_product_options_products1_idx');
			$table->integer('option_id')->index('fk_product_options_options1_idx');
			$table->integer('option_value_id')->index('fk_product_options_option_values1_idx');
			$table->timestamps();
			$table->primary(['product_id','option_value_id','option_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('product_options');
	}

}
