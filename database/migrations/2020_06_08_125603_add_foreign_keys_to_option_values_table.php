<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOptionValuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('option_values', function(Blueprint $table)
		{
			$table->foreign('option_id', 'fk_option_values_options1')->references('id')->on('options')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('option_values', function(Blueprint $table)
		{
			$table->dropForeign('fk_option_values_options1');
		});
	}

}
