<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('orders', function(Blueprint $table)
		{
			$table->foreign('address_id', 'fk_orders_addresses1')->references('id')->on('addresses')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('ref_order_status_code_id', 'fk_orders_ref_order_status_codes1')->references('id')->on('ref_order_status_codes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'fk_orders_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('orders', function(Blueprint $table)
		{
			$table->dropForeign('fk_orders_addresses1');
			$table->dropForeign('fk_orders_ref_order_status_codes1');
			$table->dropForeign('fk_orders_users1');
		});
	}

}
