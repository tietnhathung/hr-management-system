<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('ad_menu', function (Blueprint $table) {
//            $table->bigIncrements('id');
//            $table->string('name');
//            $table->string('url')->default('')->nullable();
//            $table->integer('parent_id');
//            $table->string('icons')->default('')->nullable();
//            $table->string('model_type')->nullable();
//            $table->string('target')->default('_self')->nullable();
//            $table->string('order')->default(0);
//            $table->string('route')->nullable();
//            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ad_menu');
    }
}
