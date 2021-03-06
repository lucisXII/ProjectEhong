<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSparesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spares', function (Blueprint $table) {
            $table->bigIncrements('s_id');
            $table->unsignedBigInteger('br_id');
            $table->char('code',10);
            $table->char('brand',5);
            $table->string('name',70);
            $table->integer('remain');
            $table->decimal('costprice',9,2);
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
        Schema::dropIfExists('spares');
    }
}
