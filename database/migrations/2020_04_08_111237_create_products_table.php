<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 100);
			$table->float('price', 10, 0);
			$table->text('description', 65535);
			$table->integer('weight');
			$table->string('image', 100);
			$table->float('stock', 10, 0)->nullable();
			$table->timestamps();
			$table->integer('suppliers_id')->index('fk_products_suppliers1_idx');
			$table->integer('ref_product_types_id')->index('fk_products_ref_product_types1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('products');
	}

}
