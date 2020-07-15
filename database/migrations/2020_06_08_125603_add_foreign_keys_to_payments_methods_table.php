<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPaymentsMethodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('payments_methods', function(Blueprint $table)
		{
			$table->foreign('ref_payment_method_types_id', 'fk_payments_methods_ref_payment_method_types1')->references('id')->on('ref_payment_method_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('users_id', 'fk_payments_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('payments_methods', function(Blueprint $table)
		{
			$table->dropForeign('fk_payments_methods_ref_payment_method_types1');
			$table->dropForeign('fk_payments_users1');
		});
	}

}
