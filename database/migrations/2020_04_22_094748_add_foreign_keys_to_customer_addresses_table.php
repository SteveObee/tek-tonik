<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCustomerAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('customer_addresses', function(Blueprint $table)
		{
			$table->foreign('address_id', 'fk_customer_addresses_addresses1')->references('id')->on('addresses')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('user_id', 'fk_customer_addresses_users1')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('customer_addresses', function(Blueprint $table)
		{
			$table->dropForeign('fk_customer_addresses_addresses1');
			$table->dropForeign('fk_customer_addresses_users1');
		});
	}

}
