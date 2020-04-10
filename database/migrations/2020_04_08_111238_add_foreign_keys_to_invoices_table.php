<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToInvoicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('invoices', function(Blueprint $table)
		{
			$table->foreign('invoice_status_code_id', 'fk_invoices_invoice_status_code1')->references('id')->on('invoice_status_code')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('orders_id', 'fk_invoices_orders1')->references('id')->on('orders')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('invoices', function(Blueprint $table)
		{
			$table->dropForeign('fk_invoices_invoice_status_code1');
			$table->dropForeign('fk_invoices_orders1');
		});
	}

}
