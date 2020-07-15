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
			$table->integer('supplier_id')->index('fk_products_suppliers1_idx');
			$table->integer('brand_id')->index('fk_products_brands1_idx');
			$table->integer('category_id')->nullable()->index('fk_products_categories1_idx');
			$table->string('name', 100);
			$table->float('price', 10, 0);
			$table->text('description', 65535);
			$table->integer('weight');
			$table->string('thumbnail', 100);
			$table->float('stock', 10, 0)->nullable();
			$table->string('model', 45)->nullable();
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
		Schema::drop('products');
	}

}
