<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('Payments', function(Blueprint $table)
		{
			$table->foreign('invoices_id', 'fk_Payments_invoices1')->references('id')->on('invoices')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('Payments', function(Blueprint $table)
		{
			$table->dropForeign('fk_Payments_invoices1');
		});
	}

}
