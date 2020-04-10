<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRefProductTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ref_product_types', function(Blueprint $table)
		{
			$table->foreign('ref_product_types_id', 'fk_ref_product_types_ref_product_types1')->references('id')->on('ref_product_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ref_product_types', function(Blueprint $table)
		{
			$table->dropForeign('fk_ref_product_types_ref_product_types1');
		});
	}

}
