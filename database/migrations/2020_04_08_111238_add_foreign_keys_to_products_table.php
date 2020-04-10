<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('products', function(Blueprint $table)
		{
			$table->foreign('ref_product_types_id', 'fk_products_ref_product_types1')->references('id')->on('ref_product_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('suppliers_id', 'fk_products_suppliers1')->references('id')->on('suppliers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('products', function(Blueprint $table)
		{
			$table->dropForeign('fk_products_ref_product_types1');
			$table->dropForeign('fk_products_suppliers1');
		});
	}

}
