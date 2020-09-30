<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('name', 100);
			$table->string('email', 100)->unique('email_UNIQUE');
			$table->string('password');
			$table->string('remember_token', 100)->nullable();
			$table->timestamp('email_verified_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
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
		Schema::drop('users');
	}

}
