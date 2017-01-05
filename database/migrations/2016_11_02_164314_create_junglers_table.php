<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJunglersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('junglers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('champion_id')->unsigned();
            $table->string('name');
            $table->string('pre_6_passivity')->nullable();
            $table->string('pre_6_activity')->nullable();
            $table->string('pre_6_predatory')->nullable();
            $table->string('post_6_passivity')->nullable();
            $table->string('post_6_activity')->nullable();
            $table->string('post_6_predatory')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('junglers');
    }
}
