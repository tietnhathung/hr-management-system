<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoggingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('logging', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('userId')->nullable();
			$table->integer('level')->nullable();
			$table->string('method', 45)->nullable();
			$table->text('action')->nullable();
			$table->text('detail')->nullable();
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->integer('created_by')->nullable();
			$table->integer('type')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('logging');
	}

}
