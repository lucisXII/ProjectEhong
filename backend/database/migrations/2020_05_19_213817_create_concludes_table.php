<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConcludesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concludes', function (Blueprint $table) {
            $table->bigIncrements('cc_id');
            $table->unsignedBigInteger('br_id');
            $table->decimal('score' , 6,2);
            $table->dateTime('date', 0);
            $table->foreign('br_id')->references('br_id')->on('branches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('concludes');
    }
}
