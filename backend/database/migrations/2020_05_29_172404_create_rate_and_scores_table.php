<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRateAndScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rate_and_scores', function (Blueprint $table) {
            $table->bigIncrements('rs_id');
            $table->unsignedBigInteger('sh_id');
            $table->unsignedBigInteger('br_id');
            $table->unsignedBigInteger('user_id');
            $table->decimal('score' , 6,2);
            $table->date('date');
            $table->foreign('sh_id')->references('sh_id')->on('subheadings')->onDelete('cascade');
            $table->foreign('br_id')->references('br_id')->on('branches')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rate_and_scores');
    }
}
