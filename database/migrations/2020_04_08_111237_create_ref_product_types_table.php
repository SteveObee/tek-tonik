<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRefProductTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ref_product_types', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->timestamps();
			$table->integer('ref_product_types_id')->index('fk_ref_product_types_ref_product_types1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ref_product_types');
	}

}
