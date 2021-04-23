<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoggingActivityTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('logging_activity', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('userId')->nullable();
			$table->integer('level')->nullable();
			$table->string('method', 45)->nullable();
			$table->string('action', 5000)->nullable();
			$table->text('detail')->nullable();
			$table->integer('type')->nullable();
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('logging_activity');
	}

}
