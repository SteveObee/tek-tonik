<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToShipmentItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('shipment_items', function(Blueprint $table)
		{
			$table->foreign('order_items_id', 'fk_shipment_items_order_items1')->references('id')->on('order_items')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('shipments_id', 'fk_shipment_items_shipments1')->references('id')->on('shipments')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('shipment_items', function(Blueprint $table)
		{
			$table->dropForeign('fk_shipment_items_order_items1');
			$table->dropForeign('fk_shipment_items_shipments1');
		});
	}

}
