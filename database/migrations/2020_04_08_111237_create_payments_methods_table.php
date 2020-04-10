<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsMethodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payments_methods', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->bigInteger('users_id')->index('fk_payments_users1_idx');
			$table->timestamps();
			$table->integer('ref_payment_method_types_id')->index('fk_payments_methods_ref_payment_method_types1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('payments_methods');
	}

}
