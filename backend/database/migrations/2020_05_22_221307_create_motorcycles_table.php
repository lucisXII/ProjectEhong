<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMotorcyclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motorcycles', function (Blueprint $table) {
            $table->bigIncrements('m_id');
            $table->unsignedBigInteger('br_id');
            $table->char('brand',5);
            $table->char('name',10);
            $table->char('machineNumber',12);
            $table->char('condition',1);
            $table->string('color',20);
            $table->enum('status', ['0','1'])->default('1');
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
        Schema::dropIfExists('motorcycles');
    }
}
