<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTotalcostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('totalcosts', function (Blueprint $table) {
            $table->bigIncrements('tcost_id');
            $table->unsignedBigInteger('br_id');
            $table->decimal('totalamount' , 9,2);
            $table->decimal('storefront' , 9,2);
            $table->dateTime('dateUpdate', 0);
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
        Schema::dropIfExists('totalcosts');
    }
}
