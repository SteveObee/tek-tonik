<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShipmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Shipments', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->timestamps();
			$table->integer('order_id')->index('fk_Shipments_orders1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Shipments');
	}

}
