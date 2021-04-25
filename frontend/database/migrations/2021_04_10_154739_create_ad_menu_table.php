<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdMenuTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::drop('ad_menu');
		Schema::create('ad_menu', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('name', 191);
			$table->string('url', 191)->nullable()->default('');
			$table->integer('parent_id')->index('parent_id');
			$table->string('icons', 191)->nullable()->default('');
			$table->string('target', 191)->nullable()->default('_self');
			$table->integer('order')->default(0)->index('order');
			$table->string('route', 191)->nullable();
			$table->timestamps(6);
			$table->boolean('status')->default(0)->index('status');
			$table->softDeletes()->index('deleted_at');
			$table->boolean('menu_title')->nullable()->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ad_menu');
	}

}
