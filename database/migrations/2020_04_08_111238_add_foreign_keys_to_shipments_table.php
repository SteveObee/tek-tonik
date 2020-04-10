<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToShipmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('shipments', function(Blueprint $table)
		{
			$table->foreign('invoices_id', 'fk_shipments_invoices1')->references('id')->on('invoices')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('orders_id', 'fk_shipments_orders1')->references('id')->on('orders')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('shipments', function(Blueprint $table)
		{
			$table->dropForeign('fk_shipments_invoices1');
			$table->dropForeign('fk_shipments_orders1');
		});
	}

}
