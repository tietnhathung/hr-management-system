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
			$table->string('company_id', 191)->nullable();
			$table->boolean('status')->default(0);
			$table->string('position')->nullable();
			$table->string('address')->nullable();
			$table->string('mobile')->nullable();
			$table->softDeletes();
			$table->integer('type')->nullable()->default(1)->comment('1: người đánh giá; 0: mặc định');
			$table->string('accesstoken_app', 4000)->nullable();
			$table->integer('app')->nullable()->default(0);
			$table->string('firebase_token')->nullable();
			$table->boolean('is_notifications')->nullable()->default(0);
			$table->integer('default_monitor_id')->unsigned()->nullable();
			$table->integer('deleted_by')->nullable()->default(0);
			$table->integer('created_by')->nullable()->default(0);
			$table->integer('updated_by')->nullable()->default(0);
			$table->integer('section_id')->nullable()->default(0);
			$table->index(['id','status','deleted_at','app'], 'UserById');
			$table->index(['username','status','deleted_at','app'], 'Username');
			$table->index(['status','type'], 'type');
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
