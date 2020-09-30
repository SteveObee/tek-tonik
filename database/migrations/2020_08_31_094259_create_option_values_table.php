<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOptionValuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('option_values', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('option_id')->index('fk_option_values_options1_idx');
			$table->string('value', 45);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('option_values');
	}

}
