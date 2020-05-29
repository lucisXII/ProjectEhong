<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costs', function (Blueprint $table) {
            $table->bigIncrements('cost_id');
            $table->unsignedBigInteger('br_id');
            $table->unsignedBigInteger('user_id');
            $table->decimal('totalamount' , 9,2);
            $table->decimal('storefront' , 9,2);
            $table->decimal('checkmoney' , 9,2);
            $table->string('receipt',50)->nullable();
            $table->string('agreement',50)->nullable();
            $table->string('comment')->nullable();
            $table->date('date');
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
        Schema::dropIfExists('costs');
    }
}
