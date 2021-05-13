<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
			$table->bigInteger('id', true)->unsigned();
			$table->string('username')->nullable();
			$table->string('name', 191)->nullable();
			$table->string('fullname')->nullable();
			$table->string('email', 191)->nullable()->index('users_email_unique');
			$table->dateTime('email_verified_at')->nullable();
			$table->string('password', 191);
			$table->string('avatar')->nullable();
			$table->string('remember_token', 100)->nullable();
			$table->timestamps(6);
			$table->boolean('status')->default(0);
			$table->string('position')->nullable();
			$table->string('address')->nullable();
			$table->softDeletes();
			$table->integer('deleted_by')->nullable()->default(0);
			$table->integer('created_by')->nullable()->default(0);
			$table->integer('updated_by')->nullable()->default(0);
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
