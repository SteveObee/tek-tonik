<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCustomerAddressHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('customer_address_history', function(Blueprint $table)
		{
			$table->foreign('address_id', 'fk_customer_addresses_addresses10')->references('id')->on('addresses')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('user_id', 'fk_customer_addresses_users10')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('customer_address_history', function(Blueprint $table)
		{
			$table->dropForeign('fk_customer_addresses_addresses10');
			$table->dropForeign('fk_customer_addresses_users10');
		});
	}

}
