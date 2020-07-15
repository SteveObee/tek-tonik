<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShipmentItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shipment_items', function(Blueprint $table)
		{
			$table->timestamps();
			$table->integer('shipments_id');
			$table->integer('order_items_id')->index('fk_shipment_items_order_items1_idx');
			$table->primary(['shipments_id','order_items_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('shipment_items');
	}

}
