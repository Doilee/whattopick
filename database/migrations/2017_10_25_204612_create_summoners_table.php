<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSummonersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('summoners', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('account_id');
            $table->string('name');
            $table->integer('soloq_wins');
            $table->integer('soloq_losses');
            $table->string('soloq_league');
            $table->string('soloq_division');
            $table->integer('soloq_lp');
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
        Schema::dropIfExists('summoners');
    }
}
