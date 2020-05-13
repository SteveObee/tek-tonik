<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomerAddressHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer_address_history', function(Blueprint $table)
		{
			$table->timestamp('date_audited')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->integer('address_id')->index('fk_customer_addresses_addresses1_idx');
			$table->bigInteger('user_id')->index('fk_customer_addresses_users1_idx');
			$table->dateTime('customer_address_created_at');
			$table->boolean('is_shipping')->default(0);
			$table->boolean('is_billing')->default(0);
			$table->boolean('is_active')->default(1);
			$table->primary(['date_audited','address_id','user_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('customer_address_history');
	}

}
