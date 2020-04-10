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
			$table->foreign('address_id', 'fk_customer_addresses_addresses1')->references('id')->on('addresses')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('ref_address_type_id', 'fk_customer_addresses_ref_address_types1')->references('id')->on('ref_address_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'fk_customer_addresses_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
			$table->dropForeign('fk_customer_addresses_ref_address_types1');
			$table->dropForeign('fk_customer_addresses_users1');
		});
	}

}
